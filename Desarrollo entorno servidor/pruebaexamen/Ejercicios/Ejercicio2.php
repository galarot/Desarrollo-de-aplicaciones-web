<?php
# 📝 EJERCICIO 2: Jerarquía de Personas (30 min)

## Contexto
En la biblioteca hay diferentes tipos de personas: socios normales, socios premium y bibliotecarios.

---

## Parte A: Clase abstracta Persona

Crea una clase abstracta `Persona` con:

### Propiedades:
- `id`: int
- `nombre`: string
- `email`: string

### Métodos:
- Constructor que reciba los 3 parámetros
- `abstract getRol(): string` - Devuelve el rol de la persona
- `getInfoCompleta(): string` - Devuelve "[ROL] Nombre (email)"

---

## Parte B: Clase Socio

Extiende `Persona` con:

### Propiedades adicionales:
- `fechaAlta`: DateTime
- `activo`: bool

### Métodos:
- `getRol()`: devuelve "Socio"
- `antiguedad(): int` - Meses desde la fecha de alta
- `estaActivo(): bool` - Getter del estado
- `darDeBaja(): void` - Pone activo a false
- `guardar(): bool` - INSERT o UPDATE en tabla `socios`
- `static buscarPorEmail(string $email): ?Socio` - Busca por email

---

## Parte C: Clase SocioPremium

Extiende `Socio` con:

### Propiedades adicionales:
- `limiteLibros`: int (máximo de libros simultáneos, default 10)

### Métodos:
- `getRol()`: devuelve "Socio Premium"
- `puedePrestar(int $librosActuales): bool` - True si librosActuales < limiteLibros

---

## Parte D: Clase Bibliotecario

Extiende `Persona` con:

### Propiedades adicionales:
- `seccion`: string (ej: "Infantil", "Adultos", "Consulta")

### Métodos:
- `getRol()`: devuelve "Bibliotecario - {seccion}"
- `guardar(): bool` - Puede simular (no hay tabla)

---

//clase abstracta persona.php
<?php

// 📝 EJERCICIO 2: Jerarquía de Personas

// ===============================
// Clase abstracta Persona
// ===============================
abstract class Persona{
    protected $id;       // identificador único
    protected $nombre;   // nombre de la persona
    protected $email;    // correo electrónico

    public function --construct(int $id, string $nombre, string $email){ // constructor base
        $this->id = $id; // asignar id
        $this->nombre = $nombre; // asignar nombre
        $this->email = $email; // asignar email
    }

    abstract function getRol():string; // método abstracto que define rol

    public function getInfoCompleta():string{ // devuelve info con formato
        return "[".$this->getRol()."]".$this->nombre."(".$this->email.")";
    }
}

require_once "./conexion.php";
require_once "./persona.php";

// ===============================
// Clase Socio
// ===============================
class Socio extends Persona{
    private PDO $pdo;          // conexión PDO
    public DateTime $fechaAlta; // fecha en la que se dio de alta
    public bool $activo;        // estado del socio

    public function __construct(int $id, string $nombre, string $email, bool $activo, DateTime $fechaAlta){
        $this->pdo = conectar();     // conectar a la BD
        parent::__construct($id,$nombre,$email); // llamar constructor padre
        $this->activo=$activo;        // estado actual
        $this->fechaAlta = $fechaAlta; // almacenar fecha alta
    }

    // devuelve el rol de socio
    public function getRol():string{
        return "Socio";
    }

    // calcula los meses de antigüedad desde la fecha de alta
    public function antiguedad():int{
        $intervalo = $this->fechaAlta->diff(new DateTime()); // diferencia con hoy
        $mesesAntiguedad = ($intervalo->y * 12) + $intervalo->m; // convertir a meses
        return $mesesAntiguedad;
    }

    // devuelve si sigue activo
    public function estaActivo(): bool{
        return $this->activo;
    }

    // desactiva al socio
    public function darDeBaja(): void{
        $this->activo = false;
    }

    // guarda o actualiza un socio en BD
    public function guardar(): bool{
        $pdo = $this->pdo; // obtener conexión

        $sql = "SELECT id FROM socios WHERE id = :id"; // comprobar si existe
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $this->id]);

        $existe = $stmt->fetch(); // resultado de existencia

        try {
            if ($existe) { // si existe → UPDATE
                $sql = "UPDATE socios 
                        SET nombre = :nombre, email = :email, fecha_alta = :fecha_alta 
                        WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $params = [
                    'nombre'     => $this->nombre,
                    'email'      => $this->email,
                    'fecha_alta' => $this->fechaAlta->format('Y-m-d'),
                    'id'         => $this->id
                ];

            } else { // si no existe → INSERT
                $sql = "INSERT INTO socios (nombre, email, fecha_alta) 
                        VALUES (:nombre, :email, :fecha_alta)";
                $stmt = $pdo->prepare($sql);
                $params = [
                    'nombre'     => $this->nombre,
                    'email'      => $this->email,
                    'fecha_alta' => $this->fechaAlta->format('Y-m-d')
                ];
            }

            $resultado = $stmt->execute($params); // ejecutar sentencia

            if (!$existe && $resultado) { // si era nuevo, asignar el nuevo id
                $this->id = $pdo->lastInsertId();
            }
            return $resultado;

        } catch (PDOException $e) { // error en BD
            error_log("Error al guardar: " . $e->getMessage());
            return false;
        }
    }

    // busca un socio por email y devuelve objeto o null
    public static function buscarPorEmail(string $email): ?Socio{
        $pdo = conectar(); // conectar BD

        $stmt = $pdo->prepare("SELECT * FROM socios WHERE email = :email"); // preparar búsqueda
        $stmt->execute([":email" => strtolower(trim($email))]); // ejecutar con email normalizado

        $fila = $stmt->fetch(PDO::FETCH_ASSOC); // obtener fila

        if (!$fila) return null; // si no existe, devolver null

        return new Socio( // reconstruir el objeto socio con datos BD
            intval($fila["id"]),
            $fila["nombre"],
            $fila["email"],
            new DateTime($fila["fecha_alta"]),
            boolval($fila["activo"])
        );
    }
}

// ===============================
// Clase SocioPremium
// ===============================
require_once("Socio.php");
class SocioPremiumextends Socio{
    
    public int $limiteLibros{ // propiedad del límite de libros
        get=> $this->limiteLibros; // getter automático
        set=> $this->limiteLibros = $value; // setter automático
    }

    public function __construct(
        int $id,
        string $nombre,
        string $email,
        bool $activo,
        DateTime $fechaAlta,
        int $limiteLibros = 10 // valor por defecto
    ){
        parent::__construct($id,$nombre,$email); // llama constructor de socio
        $this->activo = $activo; // estado
        $this->fechaAlta = $fechaAlta; // fecha alta
    }

    // rol específico de socio premium
    public function getRol():string{
        return "Socio Premium";
    }

    // devuelve si puede prestar más libros
    public function puedePrestar(int $librosActuales):bool{
        return $librosActuales < $this->limiteLibros;
    }
}

// ===============================
// Clase Bibliotecario
// ===============================
require_once ("Bibliotecario.php");
class Bibliotecario extends Persona{

    public string $seccion{ // sección de la biblioteca
        set=> $this->seccion = $value; // setter
    }

    public function getRol():string{
        return "Bibliotecario - $this->seccion"; // rol con sección incluida
    }

    // simula guardar bibliotecario (similar a socios)
    public function guardar() {
        $pdo = conectar(); // conectar BD

        $sql = "SELECT id FROM bibliotecario WHERE id = :id"; // comprobar si existe
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $this->id]);

        $existe = $stmt->fetch(); // resultado

        try {
            if ($existe) { // si existe → UPDATE
                $sql = "UPDATE bibliotecario 
                        SET nombre = :nombre, 
                            email = :email, 
                            fecha_alta = :fecha_alta ,
                            seccion = :seccion
                        WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $params = [
                    'nombre'     => $this->nombre,
                    'email'      => $this->email,
                    'fecha_alta' => $this->fechaAlta->format('Y-m-d'),
                    'id'         => $this->id,
                    'seccion'   => $this->seccion
                ];

            } else { // si no existe → INSERT
                $sql = "INSERT INTO bibliotecario (nombre, email, fecha_alta) 
                        VALUES (:nombre, :email, :fecha_alta, :seccion)";
                $stmt = $pdo->prepare($sql);
                $params = [
                    'nombre'     => $this->nombre,
                    'email'      => $this->email,
                    'fecha_alta' => $this->fechaAlta->format('Y-m-d'),
                    'seccion'   => $this->seccion
                ];
            }

            $resultado = $stmt->execute($params); // ejecutar sentencia

            if (!$existe && $resultado) { // si era nuevo → asignar ID
                $this->id = $pdo->lastInsertId();
            }

            return $resultado;

        } catch (PDOException $e) { // error SQL
            error_log("Error al guardar: " . $e->getMessage());
            return false;
        }
    }
}

?>
