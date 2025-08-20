create database spacefinder; 
use spacefinder; 


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `corretor` (
  `creci` int(14) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `imoveis_alugar` (
  `id_casa` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `num_comodos` int(11) NOT NULL,
    `titulo_casa` varchar(100) NOT NULL,
  `tipo_de_imovel` varchar(100) NOT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `finalidade` enum('alugar','comprar') NOT NULL DEFAULT 'comprar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `imoveis_comprar` (
  `id_casa` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `num_comodos` int(11) NOT NULL,
    `titulo_casa` varchar(100) NOT NULL,
  `tipo_de_imovel` varchar(100) NOT NULL,
  `valor` decimal(15,2) DEFAULT NULL,
  `finalidade` enum('alugar','comprar') NOT NULL DEFAULT 'comprar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `imoveis_alugar` (`id_casa`, `bairro`, `rua`, `area`, `foto`, `num_comodos`, `titulo_casa`, `tipo_de_imovel`,  `valor`, `finalidade` ) VALUES
(1, 'Portal das Tipuamas', ' Av. Luiz Dosualdo', 186, 'imgs/home/casa 1/fachada.jpg', 8, 'Casa em condomínio de alto padrão','Casa', 4200.00, 'alugar'),
(2, 'Jardim Bandeirantes', 'Av. Alberto Benassi', 75.00, 'imgs/home/casa 2/entrada.jpg', 7, 'Apartamento Edifício Pitangueiras','Apartamento', 1200.00, 'alugar'),
(3, 'Vila Nova', 'Rua Afonso Pena', 90.00, 'imgs/home/casa 3/piscina.jpg', 5, 'Casa a venda no São José','Casa', 2800.00, 'alugar'),
(4, 'São José', 'Ru', 60.00, 'imgs/home/casa 4/entrada.jpg', 6, 'Casa no Jardim Santa Clara','Casa', 3200.00, 'alugar'),
(5, 'Vila Yamada', 'Rua São Bento', 150.00, 'imgs/home/casa 5/fachada 1.jpg', 6, 'Sobrado na Vila Yamada','Sobrado', 3000.00, 'alugar'),
(6, 'Santa Angelina', 'Rua João Goulart', 80.00, 'imgs/home/casa 6/fachada 2.jpg', 9, 'Casa com três dormitórios','Casa', 1500.00, 'alugar'),
(7, 'Jardim das Flores', 'av. 36', 250.50, 'imgs/home/casa 7/area 3.jpg', 8, 'Casa proxima ao Shooping Jaraguá','Casa', 2200.00, 'alugar'),
(8, 'Jardim Universal', 'Av. Brasil', 230.00, 'imgs/home/casa 8/fachada.jpg', 7, 'Casa recém reformada','Casa', 1400.00, 'alugar'),
(9, 'Vila Nova', 'Rua Afonso Pena', 90.00, 'imgs/home/casa 9/quarto 3.jpg', 4, 'Apartamento Resedencial','Apartamento', 800.00, 'alugar'),
(10, 'Centro', 'Rua João Pessoa', 51.00, 'imgs/home/apartamento 1/predio.jpg', 7, 'Apartamento Np Jardim Botânico ','Apartamento', 1000.00, 'alugar'),
(11, 'Jardim Paraíso', 'Rua São Bento', 150.00, 'imgs/home/foto-home.jpg', 5, 'Apartamento no Jardim Paraíso','Apartamento', 400000.00, 'alugar'),
(12, 'Santa Angelina', 'Rua João Goulart', 80.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 'Apartamento', 2400.00, 'alugar'),
(13, 'Centro', 'Rua das Palmeiras', 120.50, 'imgs/home/foto-home.jpg', 5, 'Casa com piscina', 'Casa', 3500.00, 'alugar'),
(14, 'Jardim Brasil', 'Av. Brasil', 75.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 'Apartamento', 2200.00, 'alugar'),
(15, 'Vila Nova', 'Rua Afonso Pena', 90.00, 'imgs/home/foto-home.jpg', 4, 'Casa', 'Casa',  2800.00, 'alugar'),
(16, 'Centro', 'Rua XV de Novembro', 85.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 'Apartamento', 1500.00, 'alugar'),
(17, 'Vila Nova', 'Rua das Flores', 120.00, 'imgs/home/foto-home.jpg', 4, 'Casa', 'Casa', 2500.00, 'alugar'),
(18, 'Jardim Brasil', 'Av. Independencia', 45.00, 'imgs/home/foto-home.jpg', 1, 'Studio mobiliado', 'Studio mobiliado', 800.00, 'alugar');

INSERT INTO `imoveis_comprar` (`id_casa`, `bairro`, `rua`, `area`, `foto`, `num_comodos`, `tipo_de_imovel`, `titulo_casa`, `valor`, `finalidade` ) VALUES
(1, 'Portal das Tipuamas', ' Av. Luiz Dosualdo', 186, 'imgs/home/casa 1/fachada.jpg', 8, 'Casa', 'Casa de alto padrão em condominio',  1590000.00, 'comprar'),
(2, 'Jardim Bandeirantes', 'Av. Alberto Benassi', 75.00, 'imgs/home/casa 2/varanda.jpg', 7, 'Apartamento' , 'Apartamento', 220000.00, 'comprar'),
(3, 'Vila Nova', 'Rua Afonso Pena', 90.00, 'imgs/home/foto-home.jpg', 4, 'Casa', 'Casa', 280000.00, 'comprar'),
(4, 'Centro', 'Rua João Pessoa', 60.00, 'imgs/home/foto-home.jpg', 2, 'Studio mobiliado', 'Studio mobiliado', 180000.00, 'comprar'),
(5, 'Vila Xavier', 'Rua São Bento', 150.00, 'imgs/home/foto-home.jpg', 6, 'Sobrado', 'Sobrado', 400000.00, 'comprar'),
(6, 'Santa Angelina', 'Rua João Goulart', 80.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 'Apartamento', 240000.00, 'comprar'),
(7, 'Centro', 'Rua das Palmeiras', 120.50, 'imgs/home/foto-home.jpg', 5, 'Casa com piscina',  'Casa com piscina', 350000.00, 'comprar'),
(8, 'Jardim Brasil', 'Av. Brasil', 75.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento',   'Apartamento', 220000.00, 'comprar'),
(9, 'Vila Nova', 'Rua Afonso Pena', 90.00, 'imgs/home/foto-home.jpg', 4, 'Casa',  'Casa', 280000.00, 'comprar'),
(10, 'Centro', 'Rua João Pessoa', 60.00, 'imgs/home/foto-home.jpg', 2, 'Studio mobiliado',  'Studio mobiliado', 180000.00, 'comprar'),
(11, 'Vila Xavier', 'Rua São Bento', 150.00, 'imgs/home/foto-home.jpg', 6, 'Sobrado', 'Sobrado',  400000.00, 'comprar'),
(12, 'Santa Angelina', 'Rua João Goulart', 80.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 'Apartamento', 240000.00, 'comprar'),
(13, 'Centro', 'Rua das Palmeiras', 120.50, 'imgs/home/foto-home.jpg', 5, 'Casa com piscina',  'Casa com piscina', 350000.00, 'comprar'),
(14, 'Jardim Brasil', 'Av. Brasil', 75.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 'Apartamento', 220000.00, 'comprar'),
(15, 'Vila Nova', 'Rua Afonso Pena', 90.00, 'imgs/home/foto-home.jpg', 4, 'Casa', 'Casa', 280000.00, 'comprar'),
(16, 'Centro', 'Rua XV de Novembro', 85.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 'Apartamento', 1500.00, 'comprar'),
(17, 'Vila Nova', 'Rua das Flores', 120.00, 'imgs/home/foto-home.jpg', 4, 'Casa', 'Casa', 2500.00, 'comprar'),
(18, 'Jardim Brasil', 'Av. Independencia', 45.00, 'imgs/home/foto-home.jpg', 1, 'Studio mobiliado', 'Studio mobiliado', 800.00, 'comprar');
		
ALTER TABLE `imoveis_alugar`
  ADD PRIMARY KEY (`id_casa`);
  
