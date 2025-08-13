
    CREATE database spacefinder; 
    use spacefinder; 


		CREATE TABLE `corretor` (
		  `numero` int(14) DEFAULT NULL,
		  `nome` varchar(100) DEFAULT NULL
		);


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
		) ;


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


		ALTER TABLE `imoveis`
		  ADD PRIMARY KEY (`id_casa`);


		ALTER TABLE `imoveis`
		  MODIFY `id_casa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
		COMMIT;
