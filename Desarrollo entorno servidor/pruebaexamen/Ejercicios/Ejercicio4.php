# 📝 EJERCICIO 4: Trait y Estadísticas (25 min)

## Parte A: Trait Auditable

Crea un trait `Auditable` que permita registrar acciones:

### Propiedades:
- `array $registros = []`

### Métodos:
- `registrar(string $accion): void` - Añade "[Y-m-d H:i:s] $accion" al array
- `getRegistros(): array` - Devuelve todos los registros
- `limpiarRegistros(): void` - Vacía el array

---

## Parte B: Clase EstadisticasBiblioteca

Crea una clase que use el trait `Auditable`:

### Método librosDisponibles(): array
1. Obtén todos los libros: `SELECT * FROM libros`
2. Usa `array_filter()` para quedarte con los que tienen `disponibles > 0`
3. Registra la acción: "Consultados libros disponibles"
4. Devuelve el array filtrado

### Método sociosActivos(): array
1. Obtén todos los socios: `SELECT * FROM socios`
2. Filtra con PHP los que tienen `activo = true`
3. Registra la acción
4. Devuelve el resultado

### Método librosPopulares(int $limite = 3): array
1. Obtén todos los préstamos: `SELECT * FROM prestamos`
2. Cuenta cuántas veces aparece cada libro_id usando `foreach` y un array contador
3. Ordena el array de mayor a menor con `arsort()`
4. Devuelve los primeros $limite con `array_slice()`
5. Registra la acción

### Método prestamosPorMes(): array
1. Obtén todos los préstamos: `SELECT * FROM prestamos`
2. Agrupa por mes (formato "Y-m") usando `foreach`
3. Devuelve array asociativo: ['2025-11' => 4, '2025-10' => 2, ...]
4. Registra la acción

---

## Tu código:

```php
<?php
require_once 'conexion.php';

// Trait Auditable
trait Auditable
{
    // Array donde se guardarán los registros de acciones
    private array $registros = [];

    // Método para añadir un registro con la fecha y hora actual
    public function registrar(string $accion):void
    {
        $this->registros[] = "[".date('Y-m-d H:i:s')."] ".$accion;
    }

    // Devuelve el array completo de registros
    public function getRegistros():array
    {
        return $this->registros;
    }

    // Limpia todos los registros almacenados
    public function limpiarRegistros():void
    {
        $this->registros = [];
    }
}



// Clase EstadisticasBiblioteca
require_once ('Auditable.php');

class EstadisticasBiblioteca
{
    use Auditable; // Incluye el trait en la clase

    private PDO $pdo;

    // Se recibe la conexión PDO al crear la clase
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    // Devuelve los libros que tienen ejemplares disponibles
    public function librosDisponibles():array{
        // Consulta para obtener todos los libros
        $sql = "SELECT * FROM libros";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Se registra la acción
        $this->registrar("Consultados libros disponibles");

        // Filtra libros con disponibles > 0
        return array_filter($libros, function($libro){
            return $libro['disponibles'] > 0;
        });
    }

    // Devuelve los socios activos
    public function sociosActivos():array{
        // Obtener todos los socios
        $sql = "SELECT * FROM socios";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $socios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Registrar la acción
        $this->registrar("Consultados socios activos");

        // Filtrar socios con activo = true
        return array_filter($socios, function($socio){
            return $socio['activo'] == true;
        });
    }

    // Devuelve los libros más prestados
    public function librosPopulares(int $limite = 3):array{
        // Obtener todos los préstamos (solo libro_id)
        $sql = "SELECT libro_id FROM prestamos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Array para contar apariciones
        $apariciones = [];

        // Contar cuántas veces aparece cada libro_id
        foreach($libros as $libro){
            if(array_key_exists($libro['libro_id'], $apariciones)){
                $apariciones[$libro['libro_id']] ++;
            } else {
                $apariciones[$libro['libro_id']] = 1;
            }
        }

        // Ordenar de mayor a menor
        arsort($apariciones);

        // Registrar la acción
        $this->registrar("Consultados libros populares");

        // Devolver solo los primeros $limite
        return array_slice($apariciones, 0, $limite);
    }

    // Devuelve la cantidad de préstamos agrupados por mes
    public function prestamosPorMes(): array
    {
        // Obtener todos los préstamos
        $sql = "SELECT * FROM prestamos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conteoMensual = [];

        // Recorrer préstamos para agruparlos por mes
        foreach ($prestamos as $prestamo) {
            $fecha = new DateTime($prestamo['fecha_prestamo']);
            $mesClave = $fecha->format('Y-m'); // Ej: "2025-11"

            // Incrementar el contador del mes
            $conteoMensual[$mesClave] = ($conteoMensual[$mesClave] ?? 0) + 1;
        }

        // Ordenar los meses del más reciente al más antiguo
        krsort($conteoMensual);

        // Registrar la acción
        $this->registrar("Consultados préstamos agrupados por mes");

        return $conteoMensual;
    }
}



// Prueba las estadísticas
$pdo = conectar(); // Establecer conexión
if(!$pdo){
    die("Error al conectar");
}

$stats = new EstadisticasBiblioteca($pdo);

// Mostrar resultados por pantalla
echo "\nLIBROS DISPONIBLES:\n";
print_r($stats->librosDisponibles());

echo "\nSOCIOS ACTIVOS:\n";
print_r($stats->sociosActivos());

echo "\nLIBROS POPULARES:\n";
print_r($stats->librosPopulares());

echo "\nPRÉSTAMOS POR MES:\n";
print_r($stats->prestamosPorMes());

echo "\nREGISTROS AUDITABLES:\n";
print_r($stats->getRegistros());


// Fin del archivo
