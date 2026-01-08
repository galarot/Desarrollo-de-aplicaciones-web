# 📝 EJERCICIO 5: Gestión de Inventario (15 min)

## Clase GestorInventario

Crea una clase para gestionar el inventario de la biblioteca:

### Método librosAgotados(): array
1. `SELECT * FROM libros`
2. Filtra con PHP los que tienen `disponibles = 0`
3. Devuelve el array

### Método librosPocoStock(int $minimo = 2): array
1. `SELECT * FROM libros`
2. Filtra con PHP los que tienen `disponibles < $minimo`
3. Devuelve el array

### Método agregarEjemplares(int $libroId, int $cantidad): bool
1. `SELECT * FROM libros WHERE id = ?`
2. Calcula nuevos valores: ejemplares + cantidad, disponibles + cantidad
3. `UPDATE libros SET ejemplares = ?, disponibles = ? WHERE id = ?`
4. Devuelve true si OK

### Método librosPorGenero(): array
1. `SELECT * FROM generos`
2. `SELECT * FROM libros`
3. Agrupa con PHP: para cada género, cuenta cuántos libros hay
4. Devuelve: `['Novela' => 5, 'Cuento' => 2, ...]`

### Método buscarPorAutor(string $nombreAutor): array
1. `SELECT * FROM autores`
2. Busca el autor que contenga $nombreAutor (usa `stripos()`)
3. `SELECT * FROM libros WHERE autor_id = ?`
4. Devuelve los libros de ese autor

---

## Tu código:

```php
<?php
require_once 'conexion.php';

// Clase GestorInventario
class GestorInventario
{
    private PDO $pdo;

    // Recibe la conexión PDO al crear el objeto
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    // Devuelve los libros con 0 disponibles
    public function librosAgotados():array{
        $sql = "SELECT * FROM libros";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        // Filtra libros donde disponibles = 0
        return array_filter($stmt->fetchAll(PDO::FETCH_ASSOC), function($libro){
            return $libro['disponibles'] == 0;
        });
    }

    // Devuelve libros con stock por debajo del mínimo
    public function librosPocoStock(int $min = 2):array{
        $sql = "SELECT * FROM libros";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        // Filtra libros con disponibles < mínimo
        return array_filter($stmt->fetchAll(PDO::FETCH_ASSOC), function($libro) use ($min) {
            return $libro['disponibles'] < $min;
        });
    }

    // Aumenta ejemplares y disponibles de un libro dado
    public function agregarEjemplares(int $libroId, int $cantidad):bool{
        try{
            // Comienza transacción
            $this->pdo->beginTransaction();

            // Buscar el libro por ID
            $sql = "SELECT * FROM libros WHERE id = :libroId";
            $stmt = $this->pdo->prepare($sql);
            $parametros = ["libroId" => $libroId];
            $stmt->execute($parametros);
            $libro = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si no existe, se lanza error
            if(!$libro) throw new PDOException("Libro no encontrado");

            // Sumar cantidad a ejemplares y disponibles
            $ejemplaresFinales = $libro['ejemplares'] + $cantidad;
            $disponiblesFinales = $libro['disponibles'] + $cantidad;

            // Actualizar los valores en la BD
            $sql = "UPDATE libros SET ejemplares = :ejemplaresFinales, disponibles = :disponiblesFinales WHERE id = :libroId";
            $stmt = $this->pdo->prepare($sql);
            $parametros = [
                "ejemplaresFinales" => $ejemplaresFinales,
                "disponiblesFinales" => $disponiblesFinales,
                "libroId" => $libroId
            ];

            // Si la ejecución falla, lanza error
            if(!$stmt->execute($parametros)) throw new PDOException("No se pudieron editar las cantidades");

            // Confirmar cambios
            $this->pdo->commit();
            return true;

        }catch(PDOException $e){
            // Mostrar error y revertir cambios
            echo $e->getMessage();
            $this->pdo->rollBack();
            return false;
        }
    }

    // Cuenta cuántos libros existen por cada género
    public function librosPorGenero():array{
        // Obtener lista de géneros
        $sql = "SELECT * FROM generos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $generos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener lista de libros
        $sql = "SELECT * FROM libros";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $agrupadosPorGenero = [];

        // Contar cuántos libros hay por cada género
        foreach($generos as $genero){
            $count = 0;

            foreach($libros as $libro){
                if($libro['genero_id'] == $genero['id']){
                    $count++;
                }
            }

            // Asociar género con cantidad
            $agrupadosPorGenero[$genero['nombre']] = $count;
        }

        return $agrupadosPorGenero;
    }

    // Devuelve los libros cuyo autor coincida con el nombre indicado
    public function buscarPorAutor(string $nombreAutor): array{
        // Obtener lista de autores
        $sql = "SELECT * FROM autores";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $autores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Buscar el autor que coincida EXACTAMENTE con el nombre
        if($autores){
            $autorId = array_filter($autores, function($autor) use ($nombreAutor){
                return $autor['nombre'] == $nombreAutor; // Comparación literal
            })['id']; // Obtiene el id del autor encontrado
        }
        else return []; // Si no hay autores, devolver vacío

        // Obtener libros cuyo autor_id coincide
        $sql = "SELECT * FROM libros WHERE autor_id = :autorId";
        $stmt = $this->pdo->prepare($sql);
        $parametros = ["autorId" => $autorId];
        $stmt->execute($parametros);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}



// Pruebas




```
