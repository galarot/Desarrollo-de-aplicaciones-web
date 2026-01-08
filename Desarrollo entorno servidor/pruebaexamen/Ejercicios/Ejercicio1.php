<?php
# 📝 EJERCICIO 1: Conexión y Clase Libro (20 min)

## Parte A: Conexión PDO

Crea un archivo `conexion.php` con una función `conectar()` que:
- Devuelva un objeto PDO conectado a la base de datos `biblioteca`
- Configure el modo de errores como excepciones
- Use charset `utf8mb4`
- Maneje errores con try-catch

**Credenciales:**
- Host: `localhost`
- Puerto: `3307`
- BD: `biblioteca`
- Usuario: `estudiante`
- Password: `estudiante123`

---

## Parte B: Clase Libro

Crea la clase `Libro` con:

### Propiedades (usa Property Hooks donde tenga sentido):
- `id`: int (solo lectura)
- `titulo`: string (sin espacios al inicio/final)
- `autorId`: int
- `generoId`: int
- `isbn`: string
- `ejemplares`: int (mínimo 0)
- `disponibles`: int (mínimo 0, máximo = ejemplares)

### Métodos:
- `estaDisponible(): bool` - True si disponibles > 0
- `prestar(): bool` - Reduce disponibles en 1 si hay stock
- `devolver(): bool` - Aumenta disponibles en 1 (sin pasar de ejemplares)
- `toArray(): array` - Devuelve array asociativo con todas las propiedades

### Métodos estáticos:
- `buscarPorId(int $id): ?Libro` - Busca un libro por ID en la BD
- `buscarTodos(): array` - Devuelve todos los libros como objetos Libro

---




function conectar(){
    try{
        $pdo = new PDO('mysql:host=localhost;port=3307;dbname=biblioteca;charset=utf8mb4', 'estudiante','estudiante123');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'conexion realizada';
    } catch (PDOException $e) {
        echo "Error" . $e->getMessage();
    }
}
conectar();

class libro{
    public int $id;

    public string $titulo{
        set =>this->titulo = tim($this->titulo);
    }
    public int $autorId{
        set => $this->autorId = $value;
    }
    public int $generoId{
        set => $this->generiUd = $value;
    }
    public string $isbn{
        set => $this->isbn = $value;
    }
    public int $ejemplares{
        set {
            if ($value <0){
                throw new Exception("El precio no debe ser inferior a 0");
            }
            $this->ejemplares = $value;
        }
        get => $this->ejemplares
    }
    public int $disponibles;{
        set{
            if ($value < 0){
                throw new Exception ("No puede ser negativo");
            } 
            if($value > $this->ejemplares){
                throw new Exception("No mas disponibles que ejemplares")
            }
        }
    }
    public function __construct(int $id,string $titulo, int $autorId,
    int $generoId,int $ejemplares,int $disponibles, string $isbn) {
        $this->id = $id;
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->autorId = $autorId;
        $this->generoId = $generoId;
        $this->ejemplares = $ejemplares;
        $this->disponibles = $disponibles;
    }
    public function estarDisponible():bool{
        if ($this->disponibles > 0){
            return true;
        }
    }
    public function prestar():bool{
        if($this->estarDisponible()){
            $this->disponibles --;
            return true;
        }
        throw new Exception("No ejemplares disponibles")
    }

    public function devolver():bool{ //si quisiera sumar mas de uno es: (int $cantidad +X)
        if($this ->disponibles +1 <= $this->ejemplares){
            $this->disponibles ++; //y aqui disponibles += $cantidad
            return true;
        }
        throw nex Exception ("No mas devueltos que ejemplares");
    }

    public function toArray():array{
        return [ //al devolver un array con info siempre return []
            'id' =>$this->id,
            'titulo' => $this->titulo,
            'autorId' => $this->autorId,
            'generoId' => $this->generoId,
            'isbn' => $this->isbn,
            'ejemplares' => $this->ejemplares,
            'disponibles' => $this->disponibles
        ];
    }


    //al buscar algo en la base de datos se llama a la funcion para conectar
    public static function buscarPorId(int $id):?libro{
        $pdo = conectar();
        $sql = "SELECT * FROM libros WHERE id = :id";
        $stmt = $pdo->prepare($sql); //primero se prepara y luego se ejecuta con stmt
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function buscarTodos():array{
        $pdo = conectar();
        $sql = "SELECT * FROM libros";
        $stmt = $pdo-prepare($sql);
        $stmt-execute();
        return $stmt-fetchAll(PDO::FETCH__ASSOC);
    }


}



$libros = new Libro();