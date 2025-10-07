CREATE DATABASE spacefinder; 
USE spacefinder;

CREATE TABLE `corretor` (
  `creci` int(14) PRIMARY KEY,
  `nome` varchar(100) DEFAULT NULL
);

CREATE TABLE `imoveis_alugar` (
  `id_casa` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `codigo` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `num_comodos` int(11) NOT NULL,
  `banheiro` int(11) NOT NULL,
  `quarto` int(11) NOT NULL,
  `titulo_casa` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `finalidade` enum('alugar','comprar') NOT NULL DEFAULT 'comprar'
);

CREATE TABLE `imoveis_comprar` (
  `id_casa` int(11) NOT NULL PRIMARY KEY,
  `codigo` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `num_comodos` int(11) NOT NULL,
  `banheiro` int(11) NOT NULL,
  `quarto` int(11) NOT NULL,
  `titulo_casa` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `finalidade` enum('alugar','comprar') NOT NULL DEFAULT 'comprar'
);

INSERT INTO `imoveis_alugar` (`id_casa`, `codigo`, `bairro`, `rua`, `area`, `foto`, `num_comodos`, `banheiro`, `quarto`, `titulo_casa`, `tipo`, `valor`, `finalidade`) VALUES
(1, 'SF0001', 'Portal das Tipuamas', ' Av. Luiz Dosualdo', 186, 'imgs/home/casa 1/fachada.jpg', 10, 3, 4, 'Casa em condomínio de alto padrão', 'Casa', 5200.00, 'alugar'),
(2, 'SF0002', 'Jardim Bandeirantes', 'Av. Alberto Benassi', 75.00, 'imgs/home/casa 2/varanda.jpg', 5, 1, 2, 'Casa no Jardim Bandeirantes', 'Casa', 1200.00, 'alugar'),
(3, 'SF0003', 'Parque Gramado', 'Rua Afonso Pena', 202.00, 'imgs/home/casa 3/piscina.jpg', 7, 2, 3, 'Casa Parque Gramado com Piscina', 'Casa', 2800.00, 'alugar'),
(4, 'SF0004', 'Jardim Santa Clara', 'Av. Éllio Polez', 180.00, 'imgs/home/casa 4/entrada.jpg', 8, 2, 4, 'Casa no Jardim Santa Clara', 'Casa', 3200.00, 'alugar'),
(5, 'SF0005', 'Vila Yamada', 'Rua São Bento', 170.00, 'imgs/home/casa 5/fachada 1.jpg', 7, 2, 3, 'Casa na Vila Yamada', 'Casa', 3000.00, 'alugar'),
(6, 'SF0006', 'VIla Xavier', 'Rua Treze de Maio', 180.00, 'imgs/home/casa 6/fachada 2.jpg', 7, 2, 4, 'Casa na Vila Xavier', 'Casa', 1800.00, 'alugar'),
(7, 'SF0007', 'Jardim das Flores', 'Av. João Soares e Arruda', 250.50, 'imgs/home/casa 7/area 3.jpg', 6	, 1, 2, 'Casa proxima ao Shooping Jaraguá', 'Casa', 2200.00, 'alugar'),
(8, 'SF0008', 'Jardim Universal', 'Av. Brasil', 230.00, 'imgs/home/casa 8/fachada.jpg', 6, 1, 2, 'Casa Recém Reformada Jardim Universal', 'Casa', 1500.00, 'alugar'),
(9, 'SF0009', 'Vila Nova', 'Rua Afonso Pena', 75.00, 'imgs/home/apartamento 9/quarto 3.jpg', 5, 1, 2, 'Apartamento Resedencial no Villa Nova', 'Apartamento', 800.00, 'alugar'),
(10, 'SF0010', 'Centro', 'Rua João Pessoa', 261.00, 'imgs/home/casa 10/entrada.jpg', 8, 2, 4, 'Casa no Centro ', 'Casa', 3100.00, 'alugar'),
(11, 'SF0011', 'Parque São Paulo', 'Rua Ennio Rodrigues Caraça', 150.00, 'imgs/home/casa 11/area.jpg', 6, 1, 2, 'Casa no Parque São Paulo', 'Casa', 1500.00, 'alugar'),
(12, 'SF0012', 'Santa Angelina', 'Rua João Goulart', 100.00, 'imgs/home/casa 12/area.jpg', 7, 3, 2, 'Casa em Santa Angelina', 'Casa', 1800.00, 'alugar'),
(13, 'SF0013', 'Chácara Flora ', 'Rua João Evangelista Rodrigues Primiano', 300.50, 'imgs/home/casa 13/fachada.jpg', 10, 3, 4, 'Chácara com Piscina', 'Chácara', 4100.00, 'alugar'),
(14, 'SF0014', 'Jardim Bandeirantes', 'Av. Alberto Benassi', 75.00, 'imgs/home/apartamento 14/predio.jpg', 5, 1, 2, 'Apartamento no Jardim Brasil', 'Apartamento', 900.00, 'alugar'),
(15, 'SF0015', 'Jardim Residencial Paraíso', 'Rua Bento Ramalho Machado', 70.00, 'imgs/home/apartamento 15/corredor.jpg', 5, 1, 1, 'Apartamento no Jardim Paraíso', 'Apartamento', 700.00, 'alugar');

INSERT INTO `imoveis_comprar` (`id_casa`, `codigo`, `bairro`, `rua`, `area`, `foto`, `num_comodos`, `banheiro`, `quarto`, `titulo_casa`, `tipo`, `valor`, `finalidade`) VALUES
(1, 'SF0001', 'Portal das Tipuamas', ' Av. Luiz Dosualdo', 186, 'imgs/home/casa 1/fachada.jpg', 10, 3, 4, 'Casa em condominio de alto padrão', 'Casa', 1590000.00, 'comprar'),
(2, 'SF0002', 'Jardim Bandeirantes', 'Av. Alberto Benassi', 75.00, 'imgs/home/casa 2/varanda.jpg', 5, 1, 2, 'Casa no Jardim Bandeirantes', 'Casa', 220000.00, 'comprar'),
(3, 'SF0003', 'Parque Gramado', 'Rua Afonso Pena', 202.00, 'imgs/home/casa 3/piscina.jpg', 7, 2, 3, 'Casa Parque Gramado com Piscina', 'Casa', 590000.00, 'comprar'),
(4, 'SF0004', 'Jardim Santa Clara', 'Av. Éllio Polez', 180.00, 'imgs/home/casa 4/entrada.jpg', 8, 2, 4, 'Casa no Jardim Santa Clara', 'Casa', 750000.00, 'comprar'),
(5, 'SF0005', 'Vila Yamada', 'Rua São Bento', 170.00, 'imgs/home/casa 5/fachada 1.jpg', 7, 2, 3, 'Casa na Vila Yamada', 'Casa', 610000.00, 'comprar'),
(6, 'SF0006', 'VIla Xavier', 'Rua Treze de Maio', 180.00, 'imgs/home/casa 6/fachada 2.jpg', 7, 2, 4, 'Casa na Vila Xavier', 'Casa', 500000.00, 'comprar'),
(7, 'SF0007', 'Jardim das Flores', 'Av. João Soares e Arruda', 250.50, 'imgs/home/casa 7/area 3.jpg', 6, 1, 2, 'Casa proxima ao Shooping Jaraguá', 'Casa', 450000.00, 'comprar'),
(8, 'SF0008', 'Jardim Universal', 'Av. Brasil', 230.00, 'imgs/home/casa 8/fachada.jpg', 6, 1, 2, 'Casa Recém Reformada Jardim Universal', 'Casa', 420000.00, 'comprar'),
(9, 'SF0009', 'Vila Nova', 'Rua Afonso Pena', 75.00, 'imgs/home/apartamento 9/quarto 3.jpg', 5, 1, 2, 'Apartamento Resedencial no Villa Nova', 'Apartamento', 200000.00, 'comprar'),
(10, 'SF0010', 'Centro', 'Rua João Pessoa', 261.00, 'imgs/home/casa 10/entrada.jpg', 8, 2, 4, 'Casa no Centro ', 'Casa', 680000.00, 'comprar'),
(11, 'SF0011', 'Parque São Paulo', 'Rua Ennio Rodrigues Caraça', 150.00, 'imgs/home/casa 11/area.jpg', 6, 1, 2, 'Casa no Parque São Paulo', 'Casa', 400000.00, 'comprar'),
(12, 'SF0012', 'Santa Angelina', 'Rua João Goulart', 100.00, 'imgs/home/casa 12/area.jpg', 7, 3, 2, 'Casa em Santa Angelina', 'Casa', 400000.00, 'comprar'),
(13, 'SF0013', 'Chácara Flora ', 'Rua João Evangelista Rodrigues Primiano', 300.50, 'imgs/home/casa 13/fachada.jpg', 10, 3, 4, 'Chácara com Piscina', 'Chácara', 1200000.00, 'comprar'),
(14, 'SF0014', 'Jardim Bandeirantes', 'Av. Alberto Benassi', 75.00, 'imgs/home/apartamento 14/predio.jpg', 5, 1, 2, 'Apartamento no Jardim Brasil', 'Apartamento', 210000.00, 'comprar'),
(15, 'SF0015', 'Jardim Residencial Paraíso', 'Rua Bento Ramalho Machado', 70.00, 'imgs/home/apartamento 15/corredor.jpg', 5, 1, 1, 'Apartamento no Jardim Paraíso', 'Apartamento', 190000.00, 'comprar');