CREATE TABLE UsersDatabase (
  idUser INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  fName VARCHAR(30) NOT NULL,
  lName VARCHAR(30) NOT NULL,
  direccion VARCHAR(150) NOT NULL,
  username VARCHAR(50) NOT NULL,
  passwrd VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  country VARCHAR(20) NOT NULL,
  gender VARCHAR(15) NOT NULL,
  UNIQUE (username)
);
CREATE TABLE Arreglos (
  idArreglo INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  tipo VARCHAR(200) NOT NULL,
  nombre VARCHAR(200) NOT NULL,
  precio INT(8) NOT NULL
);
CREATE TABLE IF NOT EXISTS `Pedidos` (
  idUser1 INT(8) UNSIGNED NOT NULL,
  idArreglo1 INT(8) UNSIGNED NOT NULL,
  status VARCHAR(50) NOT NULL,
  FOREIGN KEY(idUser1) REFERENCES UsersDatabase(idUser),
  FOREIGN KEY(idArreglo1) REFERENCES Arreglos(idArreglo)
);
ALTER TABLE `Pedidos`
ADD UNIQUE KEY `pedidosID` (`idUser1`, `idArreglo1`);


INSERT INTO `UsersDatabase` (`idUser`,`fName`, `lName`, `direccion` , `username`, `passwrd`, `email`, `country`, `gender`) VALUES
(1, 'Joel', 'Cantu','diego de almagro 143', 'joelmcg', 'joelmcg93', 'joelcantu@hotmail.com', 'Mexico', 'M'),
(2, 'Egga', 'Sena', 'fuentes del valle 605','maciano', 'alanpoe', 'eggasenna@hotmail.com', 'Mexico', 'M'),
(3, 'July', 'Orozco', 'rio orinoco 101','julz', 'huevo', 'july@hotmail.com', 'Mexico', 'M'),
(4, 'admin', 'admin', 'admin','admin', 'admin', 'admin', 'Mexico', 'M');


INSERT INTO `Arreglos` (`idArreglo`, `tipo`, `nombre`, `precio`) VALUES
(1, 'Circular', 'Canasta Rosas y Lilies', 850),
(2, 'Circular', 'Hermoso arreglo de 100 Rosas Rojas con toques de Campana', 1200),
(3, 'Circular', 'Bello arreglo floral Pimaveral Rosas de varios colores, Astromelia, Lilie, Campana y solidago fino follaje', 800),
(4, 'Circular', 'Magnifico Arreglo floral de Rosas Rojas en espiral.', 850),
(5, 'Triangular', 'Rosas Exotico', 1000),
(6, 'Triangular', 'Rosas y Ginger', 850),
(7, 'Triangular', 'Topiario de Rosas Y Girasoles', 900),
(8, 'Triangular', 'Espiral Moderno', 1000),
(9, 'Abanico', 'Canastillo de 50 rosas rojas y blancas en abanico ', 900),
(10, 'Abanico', 'Abanico de rosas', 600),
(11, 'Abanico', 'Canastillo de 40 rosas blancas en Abanico', 700),
(12, 'Abanico', 'Cesta de Conejos Tu y Yo', 900);


INSERT INTO `Pedidos` (`idUser1`, `idArreglo1`, `status`) VALUES
(1, 2, 1);






