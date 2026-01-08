<?php
require_once './src/conexion.php';

// ================================
// Interface Prestable
// ================================
// Define los métodos obligatorios que debe implementar cualquier clase
// que gestione préstamos.
interface Prestable {
    public function registrarPrestamo(int $socioId, int $libroId): int;
    public function registrarDevolucion(int $prestamoId): bool;
    public function getPrestamosActivos(int $socioId): array;
    public function getHistorial(int $socioId): array;
}



// ================================
// Clase GestorPrestamos
// ================================
require_once ('Prestable.php');
require_once ('conexion.php');

class GestorPrestamos implements Prestable
{
    // Conexión PDO para trabajar con la base de datos
    private PDO $pdo{
        set => $this->pdo = $value;
    }

    // El constructor recibe la conexión PDO
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    // ================================================
    // Registrar un préstamo
    // ================================================
    public function registrarPrestamo(int $socioId, int $libroId): int
    {
        try{
            // Iniciar transacción
            $this->pdo->beginTransaction();

            // 1. Verificar disponibilidad del libro
            $sql = "SELECT disponibles FROM libros WHERE id = :libroId";
            $parametros = [':libroId' => $libroId];
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);

            $disponible = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si no existe el libro o no hay ejemplares
            if (!$disponible || $disponible['disponibles'] < 1) {
                throw new PDOException("No hay ejemplares disponibles o el libro no existe.");
            }

            // 2. Registrar préstamo en la tabla "prestamos"
            $sql = "INSERT INTO prestamos (socio_id, libro_id, fecha_prestamo, devuelto) 
                    VALUES (:socioId, :libroId, NOW(), FALSE)";
            $parametros = [
                ':socioId' => $socioId,
                ':libroId' => $libroId,
            ];

            $stmt = $this->pdo->prepare($sql);
            if(!$stmt->execute($parametros))
                throw new PDOException("No se pudo registrar el préstamo.");

            echo "\nSe ha registrado el préstamo";

            // 3. Actualizar libros: reducir disponibles en 1
            $sql = "UPDATE libros SET disponibles = disponibles - 1 WHERE id = :libroId";
            $parametros = [':libroId' => $libroId];
            $stmt = $this->pdo->prepare($sql);

            if(!$stmt->execute($parametros))
                throw new PDOException("No se pudo actualizar la disponibilidad.");

            echo "\nSe ha actualizado el registro en tabla LIBROS";

            // 4. Confirmar la transacción
            $this->pdo->commit();

            // Retornar ID del préstamo insertado
            return $this->pdo->lastInsertId();

        }catch(PDOException $e){
            // Si algo falla, revertir cambios
            $this->pdo->rollBack();
            echo $e->getMessage();
        }

        return -1; // Si falla, devolver -1
    }

    // ================================================
    // Registrar devolución de un préstamo
    // ================================================
    public function registrarDevolucion(int $prestamoId): bool
    {
        try{
            // Iniciar transacción
            $this->pdo->beginTransaction();

            // 1. Verificar que el préstamo exista
            $sql = "SELECT libro_id, devuelto FROM prestamos WHERE id = :prestamoId";
            $parametros = [':prestamoId' => $prestamoId];
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);

            $prestamo = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$prestamo)
                throw new PDOException("ID del préstamo no encontrado");

            $libroId = $prestamo['libro_id'];

            // 2. Actualizar préstamo: marcar devuelto + fecha de devolución
            $sql = "UPDATE prestamos 
                    SET devuelto = 1, fecha_devolucion = :fecha_devolucion 
                    WHERE id = :prestamoId";

            $parametros = [
                ':prestamoId' => $prestamoId,
                ':fecha_devolucion' => date('Y-m-d')
            ];

            $stmt = $this->pdo->prepare($sql);
            if(!$stmt->execute($parametros))
                throw new PDOException("No se pudo actualizar el préstamo.");

            // 3. Devolver libro: aumentar disponibles en 1
            $sql = "UPDATE libros SET disponibles = disponibles + 1 WHERE id = :libroId";
            $parametros = [':libroId' => $libroId];
            $stmt = $this->pdo->prepare($sql);

            if(!$stmt->execute($parametros))
                throw new PDOException("No se pudo actualizar el registro en tabla LIBROS");

            // Confirmar cambios
            $this->pdo->commit();
            echo "\nSe ha actualizado el registro en tabla LIBROS";
            return true;

        }catch (PDOException $e){
            // Revertir si falla
            $this->pdo->rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    // ================================================
    // Obtener préstamos activos de un socio
    // ================================================
    public function getPrestamosActivos(int $socioId): array
    {
        // Seleccionar préstamos con devuelto = FALSE
        $sql = "SELECT * FROM prestamos WHERE socio_id = :socioId AND devuelto = FALSE";
        $parametros = [':socioId' => $socioId];

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parametros);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ================================================
    // Obtener historial completo de un socio
    // ================================================
    public function getHistorial(int $socioId): array
    {
        $sql = "SELECT * FROM prestamos WHERE socio_id = :socioId";
        $parametros = [':socioId' => $socioId];

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parametros);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}



// ================================
// Archivo de pruebas: test_prestamos.php
// ================================

require_once ('GestorPrestamos.php');

$pdo = conectar();

// Crear instancia del gestor
$prestamo = 0;
if($pdo) $prestamo = new GestorPrestamos($pdo);
else echo "error al conectar a la base de datos";

// 1. Registrar un préstamo (libro 5 → socio 2)
$prestamo->registrarPrestamo(2,5);

// 2. Mostrar préstamos activos del socio 2
echo "\nPréstamos del socio n2: ".print_r($prestamo->getPrestamosActivos(2), true);

// 3. Registrar devolución del préstamo con ID = 5
$prestamo->registrarDevolucion(5);

// 4. Mostrar historial completo del socio 2
echo "\nHistorial completo: ".print_r($prestamo->getHistorial(2), true);
