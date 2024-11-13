-- Proyecto Paradigmas/ Base de datos
CREATE DATABASE proyecto;
use proyecto;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    correo VARCHAR(100) UNIQUE,
    contraseña VARCHAR(100)
);

CREATE TABLE generos (
    id_genero INT AUTO_INCREMENT PRIMARY KEY,
    nombre_genero VARCHAR(50)
);
select * from generos;
CREATE TABLE peliculas (
    id_pelicula INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    imagen VARCHAR(100),
    descripcion TEXT,
    id_genero INT,
    anio INT,
    trailer VARCHAR(255),
    FOREIGN KEY (id_genero) REFERENCES generos(id_genero)
);

CREATE TABLE sugerencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comentarios TEXT NOT NULL,
    usuario_id INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuario)  -- Relación con la tabla usuarios
);


INSERT INTO generos (nombre_genero) VALUES
('Accion'),
('Drama'),
('Comedia'),
('Ciencia Ficcion'),
('Terror'),
('Romance'),
('Basadas en Libros');

INSERT INTO peliculas (titulo, imagen, descripcion, id_genero, anio, trailer) VALUES
('Alerta Roja', '../imagenes/alertaroja.jpg', 'Descripción: Un agente del FBI impecable. Los dos ladrones de arte más buscados del planeta. Tres reliquias invaluables. Comienza un juego de gato y ratón que dará la vuelta al mundo. Dirigido por: Rawson Marshall Thurber. Reparto: Dwayne Johnson, Ryan Reynolds, Gal Gadot, más.', 1, 2021, 'https://www.youtube.com/watch?v=_L0DMAFBEjs'),
('Escuadrón 6', '../imagenes/escuadron6.jpg', 'Descripción: Ryan Reynolds encarna a un genio multimillonario que finge su propia muerte y conforma un equipo internacional de justicieros para erradicar algunos males del mundo. Dirigido por: Michael Bay. Reparto: Ryan Reynolds, Mélanie Laurent, Manuel Garcia-Rulfo, más.', 1, 2020, 'https://www.youtube.com/watch?v=aVfxMcGrKm4&t=8s'),
('Rápidos y furiosos: Hobbs & Shaw', '../imagenes/rapidosyfuriosos.webp', 'Descripción: Dos machos alfa rivales deben buscar a un agente corrupto del MI6 que trae consigo una infección mortal, pero sus personalidades opuestas podrían afectar la misión. Dirigido por: David Leitch. Reparto: Dwayne Johnson, Jason Statham, Idris Elba, más.', 1, 2019, 'https://www.youtube.com/watch?v=10R6Nku7DrI'),
('La sociedad de la Nieve', '../imagenes/lasociedad.jpg', 'Descripción: El ganador del premio Goya J. A. Bayona (“Lo imposible”) dirige este emocionante relato del accidente aéreo del equipo de rugby uruguayo en 1972. Dirigido por: Juan Antonio Bayona. Reparto: Enzo Vogrincic, Matías Recalt, Agustín Pardella, más.', 2, 2023, 'https://www.youtube.com/watch?v=l9tP4M8URhQ'),
('Fractura', '../imagenes/fractura.jpg', 'Descripción: Fueron a la sala de emergencias con su hija, que tuvo un accidente. La esposa la lleva a hacerse una tomografía mientras él espera, pero nunca vuelven. Dirigido por: Brad Anderson. Reparto: Sam Worthington, Lily Rabe, Stephen Tobolowsky, más.', 2, 2020, 'https://www.youtube.com/watch?v=dEw_cB2_7Rk&t=3s'),
('El niño que domó el viento', '../imagenes/elniño.webp', 'Descripción: Basado en la historia real de un joven que intenta salvar su pueblo en Malaui. Dirigido por: Chiwetel Ejiofor. Reparto: Maxwell Simba, Chiwetel Ejiofor.', 2, 2019, 'https://www.youtube.com/watch?v=nPkr9HmglG0'),
('Son como niños', '../imagenes/soncn.jpg', 'Descripción: Cinco amigos ganan un campeonato juvenil y se reencuentran 30 años después para pasar un tiempo juntos. Dirigido por: Dennis Dugan. Reparto: Adam Sandler, Kevin James, Chris Rock, más.', 3, 2010, 'https://www.youtube.com/watch?v=yMEDiKD7cyE'),
('Jumanji: en la selva', '../imagenes/jumanji.jpg', 'Descripción: Cuatro estudiantes son absorbidos en un videojuego y deben sobrevivir en la selva. Dirigido por: Jake Kasdan. Reparto: Dwayne Johnson, Jack Black, Kevin Hart, más.', 3, 2017, 'https://www.youtube.com/watch?v=leIrosWRbYQ'),
('Una esposa de mentira', '../imagenes/unaesposa.webp', 'Descripción: Un cirujano plástico finge estar casado y pide a su asistente que se haga pasar por su exesposa. Dirigido por: Dennis Dugan. Reparto: Adam Sandler, Jennifer Aniston, Nicole Kidman, más.', 3, 2018, 'https://www.youtube.com/watch?v=xuZnmYjAKww'),
('Godzilla vs Kong: el nuevo imperio', '../imagenes/godzillakong.png', 'Descripción: Godzilla y Kong se enfrentan a una amenaza colosal oculta en el planeta. Dirigido por: Adam Wingard. Reparto: Dan Stevens, Rebecca Hall, Brian Tyree Henry, más.', 4, 2021, 'https://www.youtube.com/watch?v=Y5nq2APYURE'),
('Indiana Jones y el reino de la calavera de cristal', '../imagenes/indianajones.jpg', 'Descripción: Indy y un joven aventurero buscan un artefacto poderoso antes que una agente soviética. Dirigido por: Steven Spielberg. Reparto: Harrison Ford, Cate Blanchett, Shia LaBeouf, más.', 4, 2008, 'https://www.youtube.com/watch?v=s942xnT-Lhs'),
('Amor y monstruos', '../imagenes/amorymonstruos.jpg', 'Descripción: Joel viaja 150 km para reencontrarse con su novia en un mundo lleno de monstruos. Dirigido por: Michael Matthews. Reparto: Dylan O’Brien, Jessica Henwick, Michael Rooker, más.', 4, 2020, 'https://www.youtube.com/watch?v=xX9jNWVel0Y'),
('SAW', '../imagenes/saw.jpg', 'Descripción: Dos hombres deben responder a la pregunta de si matarían para vivir. Dirigido por: James Wan, Leigh Whannell. Reparto: Tobin Bell, Cary Elwes, más.', 5, 2004, 'https://www.youtube.com/watch?v=S-1QgOMQ-ls'),
('La noche del demonio: la última llave', '../imagenes/demonio.jpg', 'Descripción: Una parapsicóloga enfrenta al demonio que liberó en su infancia. Dirigido por: Adam Robitel. Reparto: Lin Shaye, Angus Sampson, Leigh Whannell, más.', 5, 2018, 'https://www.youtube.com/watch?v=lUwaosQZkHU&t=7s'),
('Fragmentado', '../imagenes/fragmentado.jpeg', 'Descripción: Kevin, con 23 personalidades, secuestra a tres chicas en un sótano. Dirigido por: M. Night Shyamalan. Reparto: James McAvoy, Anya Taylor-Joy, Betty Buckley, más.', 5, 2016, 'https://www.youtube.com/watch?v=mIggnAKLWIE'),
('Yo antes de ti', '../imagenes/yoantesdeti.webp', 'Descripción: Louisa cuida a un joven millonario paralítico y surge una conexión especial. Dirigido por: Thea Sharrock. Reparto: Emilia Clarke, Sam Claflin, Jenna Coleman, más.', 6, 2016, 'https://www.youtube.com/watch?v=FRrc2X4Uzm4'),
('Love Rosie', '../imagenes/loverosie.jpg', 'Descripción: Rosie y Alex intentan mantener vivo su amor a pesar de la distancia. Dirigido por: Christian Ditter. Reparto: Lily Collins, Sam Claflin, Tamsin Egerton, más.', 6, 2014, 'https://www.youtube.com/watch?v=dOMTh9Jd81w'),
('Titanic', '../imagenes/titanic.webp', 'Descripción: Una joven de alta sociedad se enamora de un artista humilde a bordo del Titanic. Dirigido por: James Cameron. Reparto: Leonardo DiCaprio, Kate Winslet, Billy Zane, más.', 6, 1997, 'https://www.youtube.com/watch?v=dOMTh9Jd81w'),
('Las crónicas de Narnia', '../imagenes/narnia.jpeg', 'Descripción: Basada en la serie de novelas de C.S. Lewis sobre un mundo mágico. Dirigido por: Andrew Adamson. Reparto: Liam Neeson, Tilda Swinton, Skandar Keynes, más.', 7, 2005, 'https://www.youtube.com/watch?v=usEkWtuNn-w'),
('Ciudades de Papel', '../imagenes/ciudadesdepapel.jpg', 'Descripción: Quentin busca a su enigmática vecina después de una noche de aventuras. Dirigido por: Jake Schreier. Reparto: Nat Wolff, Cara Delevingne, Halston Sage, más.', 7, 2015, 'https://www.youtube.com/watch?v=5dPnKbvO5xQ&t=6s'),
('El niño con el pijama a rayas', '../imagenes/elniñorayas.jpg', 'Descripción: Un niño desarrolla una amistad prohibida con un niño judío en la Segunda Guerra Mundial. Dirigido por: Mark Herman. Reparto: Vera Farmiga, David Thewlis, Rupert Friend, más.', 7, 2008, 'https://www.youtube.com/watch?v=rzow19gyNqQ');

drop table usuarios;
select * from sugerencias;
select * from usuarios;
select * from peliculas;
select * from generos;





