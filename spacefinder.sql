-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/08/2025 às 19:17
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `spacefinder`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `corretor`
--

CREATE TABLE `corretor` (
  `numero` int(14) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis`
--

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

--
-- Despejando dados para a tabela `imoveis`
--

INSERT INTO `imoveis` (`id_casa`, `bairro`, `rua`, `area`, `foto`, `num_comodos`, `tipo_de_imovel`, `valor`, `finalidade`) VALUES
(1, 'Centro', 'Rua das Palmeiras', 120.50, 'imgs/home/foto-home.jpg', 5, 'Casa com piscina', 350000.00, 'comprar'),
(2, 'Jardim Brasil', 'Av. Brasil', 75.00, 'imgs/home/foto-home.jpg', 3, 'Apartamento', 220000.00, 'comprar'),
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
--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `imoveis`
--
ALTER TABLE `imoveis`
  ADD PRIMARY KEY (`id_casa`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `imoveis`
--
ALTER TABLE `imoveis`
  MODIFY `id_casa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
