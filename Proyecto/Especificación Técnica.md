# Especificación Técnica: Juego estilo Wordle

## 1. Introducción
El documento que se describe a continuación describe aquellas especificaciones técnicas destinadas al desarrollo de una página web orientada al tipo de juego Wordle, con temática del juego Dragon Ball Legends, la finalidad y funcionalidad básica de este se centra en adivinar el personaje como objetivo diario, con información de atributos varios como afinidad o estilo de combate.

En este caso no existe competencia alguna pues no se encuentra en la web una página de la temática dle orientada a tal juego, por ende tiene gran capacidad de diferenciarse, ademas de que tiene como objetivo breves momentos de entretenimiento y desafío diario a aquellos fanáticos de este, lo que en varios casos asegure una constancia y en consecuencia visitas diarias a la página.

## 2. Objetivos
* **Crear una experiencia diaria e interactiva** para la comunidad de Dragon Ball Legends.

* **Desarrollar barra de búsqueda con auto completado** de todos los personajes existentes en el juego (mas de 700).

* **Guardar los datos mediante sistema de guardado en navegador** para el progreso diario, es decir, si el usuario se vuelve a meter en la web tras adivinar el personaje diario, tras cerrar la página, debería aparecer que ya había adivinado el personaje de hoy.

* **Crear un sistema de racha** en la que cada día que pase y adivine el personaje diario de forma seguida, se sume +1 a la racha diaria.

* **Apartado en el que describa último día de actualización de la web** pues el juego se actualiza con nuevos personajes o actualización a personajes de forma semanal, por lo que en lo que se añaden estos a la base de datos, señalar último día de actualización para que el usuario se cerciore de las características de los personajes en aquel entonces.

* **Seleccionar las categorías necesarias** para la adivinanza del personaje, pues hay una cantidad abrumadora de características, categorías y aspectos que pueda tener un personaje, por ende se han de escoger con cuidado estas mismas, siendo las justas y necesarias para que se pueda adivinar el personaje, por ejemplo: genero, afinidad, rareza, estilo de pelea, episodio, etiqueta de raza y año.

* **El personaje diario** se elige de manera aleatoria entre todos los que hay.

## 3. Mecánica y atributos
La mecánica principal de la web consiste en lo siguiente:
El usuario selecciona escribe un personaje en la barra de búsqueda, en esta se muestran según vaya escribiendo gracias al auto completado de la misma, tras seleccionar el primer personaje, se muestran todas las características que este tiene y un color en cada uno que indica si el personaje del día coincide (verde) o no (rojo) con el seleccionado, por ende el usuario va buscando coincidencias hasta llegar al personaje del día.

Ejemplo de atributos:
**Atributos**   **Personaje ej: Bardock**
**Genero**      Hombre
**Afinidad**    Rojo
**Rareza**      Sparking
**Estilo**      Físico
**Episodio**    Original del anime
**Raza**        Saiyan
**Año**         2020
Además de todos los atributos del personaje, siempre saldrá al lado de este el art cart del personaje seleccionado en cuestión.

## 4. Arquitectura del sistema
Se opta por una aplicacion tipo SPA, siento Single Page Application, pues esencialmente no requiere mas de esto siendo un juego de navegador tipo Wordle.
* **Frontend:** se desarrollará con React.js y JSX, siendo una interfaz en la que los componentes se actualizan de forma constante a la par que instantánea.
* **Backend:** 
