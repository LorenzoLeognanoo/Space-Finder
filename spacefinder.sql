create database spacefinder; 
use spacefinder; 


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `corretor` (
  `numero` int(14) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `imoveis` (
  `id_casa` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `num_comodos` int(11) NOT NULL,
  `tipo_de_imovel` varchar(100) NOT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `finalidade` enum('alugar','comprar') NOT NULL DEFAULT 'comprar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `imoveis` (`id_casa`, `bairro`, `rua`, `area`, `foto`, `num_comodos`, `tipo_de_imovel`, `valor`, `finalidade`) VALUES
(1, 'Portal das Tipuamas', ' Av. Luiz Dosualdo', 186, 'imgs/home/casa 1/fachada.jpg', 8, 'Casa em condomínio', 1590000.00, 'comprar'),
(2, 'Jardim Bandeirantes', 'Av. Alberto Benassi', 75.00, 'imgs/home/casa 2/entrada.jpg', 7, 'Apartamento', 220000.00, 'comprar'),
(3, 'Vila Nova', 'Rua Afonso Pena', 90.00, 'imgs/home/foto-home.jpg', 4, 'Casa', 280000.00, 'comprar'),
(4, 'Centro', 'Rua João Pessoa', 60.00, 'imgs/home/foto-home.jpg', 2, 'Studio mobiliado', 180000.00, 'comprar'),
(5, 'Vila Xavier', 'Rua São Bento', 150.00, 'imgs/home/foto-home.jpg', 6, 'Sobrado', 400000.00, 'comprar'),
(6, 'Santa Angelina', 'Rua João Goulart', 80.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 240000.00, 'comprar'),
(7, 'Centro', 'Rua das Palmeiras', 120.50, 'imgs/home/foto-home.jpg', 5, 'Casa com piscina', 350000.00, 'comprar'),
(8, 'Jardim Brasil', 'Av. Brasil', 75.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 220000.00, 'comprar'),
(9, 'Vila Nova', 'Rua Afonso Pena', 90.00, 'imgs/home/foto-home.jpg', 4, 'Casa', 280000.00, 'comprar'),
(10, 'Centro', 'Rua João Pessoa', 60.00, 'imgs/home/foto-home.jpg', 2, 'Studio mobiliado', 180000.00, 'comprar'),
(11, 'Vila Xavier', 'Rua São Bento', 150.00, 'imgs/home/foto-home.jpg', 6, 'Sobrado', 400000.00, 'comprar'),
(12, 'Santa Angelina', 'Rua João Goulart', 80.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 240000.00, 'comprar'),
(13, 'Centro', 'Rua das Palmeiras', 120.50, 'imgs/home/foto-home.jpg', 5, 'Casa com piscina', 350000.00, 'comprar'),
(14, 'Jardim Brasil', 'Av. Brasil', 75.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 220000.00, 'alugar'),
(15, 'Vila Nova', 'Rua Afonso Pena', 90.00, 'imgs/home/foto-home.jpg', 4, 'Casa', 280000.00, 'comprar');

INSERT INTO `imoveis` (`bairro`, `rua`, `area`, `foto`, `num_comodos`, `tipo_de_imovel`, `valor`, `finalidade`) VALUES 
('Centro', 'Rua XV de Novembro', 85.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 1500.00, 'alugar'),
('Vila Nova', 'Rua das Flores', 120.00, 'imgs/home/foto-home.jpg', 4, 'Casa', 2500.00, 'alugar'),
('Jardim Brasil', 'Av. Independencia', 45.00, 'imgs/home/foto-home.jpg', 1, 'Studio mobiliado', 800.00, 'alugar');

ALTER TABLE `imoveis`
  ADD PRIMARY KEY (`id_casa`);
  
  
