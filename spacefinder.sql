	create database spacefinder; 
	use spacefinder;
 
	CREATE TABLE `corretor` (
	  `creci` int(14) PRIMARY KEY,
	  `nome` varchar(100) DEFAULT NULL
	);
 
 
	CREATE TABLE `imoveis_alugar` (
	  `id_casa` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	  `bairro` varchar(100) NOT NULL,
	  `rua` varchar(100) NOT NULL,
	  `area` decimal(10,2) NOT NULL,
	  `foto` varchar(225) NOT NULL,
	  `num_comodos` int(11) NOT NULL,
		`titulo_casa` varchar(100) NOT NULL,
	  `tipo_de_imovel` varchar(100) NOT NULL,
	  `valor` decimal(15,2) DEFAULT NULL,
	  `finalidade` enum('alugar','comprar') NOT NULL DEFAULT 'comprar'
	);
 
	CREATE TABLE `imoveis_comprar` (
	  `id_casa` int(11) NOT NULL PRIMARY KEY,
	  `bairro` varchar(100) NOT NULL,
	  `rua` varchar(100) NOT NULL,
	  `area` decimal(10,2) NOT NULL,
	  `foto` varchar(225) NOT NULL,
	  `num_comodos` int(11) NOT NULL,
		`titulo_casa` varchar(100) NOT NULL,
	  `tipo_de_imovel` varchar(100) NOT NULL,
	  `valor` decimal(15,2) DEFAULT NULL,
	  `finalidade` enum('alugar','comprar') NOT NULL DEFAULT 'comprar'
	);
 
	INSERT INTO `imoveis_alugar` (`id_casa`, `bairro`, `rua`, `area`, `foto`, `num_comodos`, `titulo_casa`, `tipo_de_imovel`,  `valor`, `finalidade` ) VALUES
	(1, 'Portal das Tipuamas', ' Av. Luiz Dosualdo', 186, 'imgs/home/casa 1/fachada.jpg', 8, 'Casa em condomínio de alto padrão','Casa', 4200.00, 'alugar'),
	(2, 'Jardim Bandeirantes', 'Av. Alberto Benassi', 75.00, 'imgs/home/casa 2/varanda.jpg', 7, 'Casa no Jardim Bandeirantes','Casa', 1200.00, 'alugar'),
	(3, 'Parque Gramado', 'Rua Afonso Pena', 90.00, 'imgs/home/casa 3/piscina.jpg', 9, 'Casa Parque Gramado com Piscina','Casa', 2800.00, 'alugar'),
	(4, 'Jardim Santa Clara', 'Av. Éllio Polez', 60.00, 'imgs/home/casa 4/entrada.jpg', 6, 'Casa no Jardim Santa Clara','Casa', 3200.00, 'alugar'),
	(5, 'Vila Yamada', 'Rua São Bento', 150.00, 'imgs/home/casa 5/fachada 1.jpg', 6, 'Sobrado na Vila Yamada','Sobrado', 3000.00, 'alugar'),
	(6, 'VIla Xavier', 'Rua Treze de Maio', 80.00, 'imgs/home/casa 6/fachada 2.jpg', 9, 'Casa na Vila Xavier','Casa', 1500.00, 'alugar'),
	(7, 'Jardim das Flores', 'Av. João Soares e Arruda', 250.50, 'imgs/home/casa 7/area 3.jpg', 6, 'Casa proxima ao Shooping Jaraguá','Casa', 2200.00, 'alugar'),
	(8, 'Jardim Universal', 'Av. Brasil', 230.00, 'imgs/home/casa 8/fachada.jpg', 7, 'Casa Recém Reformada Jardim Universal','Casa', 1400.00, 'alugar'),
	(9, 'Vila Nova', 'Rua Afonso Pena', 90.00, 'imgs/home/apartamento 9/quarto 3.jpg', 5, 'Apartamento Resedencial no Villa Nova', 'Apartamento', 800.00, 'alugar'),
	(10, 'Centro', 'Rua João Pessoa', 51.00, 'imgs/home/casa 10/entrada.jpg', 7, 'Casa no Centro ','Casa', 1000.00, 'alugar'),
	(11, 'Parque São Paulo', 'Rua Ennio Rodrigues Caraça', 150.00, 'imgs/home/casa 11/area.jpg', 5, 'Casa no Parque São Paulo','Casa', 400000.00, 'alugar'),
	(12, 'Santa Angelina', 'Rua João Goulart', 80.00, 'imgs/home/casa 12/area.jpg', 3, 'Casa em Santa Angelina', 'Casa', 2400.00, 'alugar'),
	(13, 'Chácara Flora ', 'Rua João Evangelista Rodrigues Primiano', 120.50, 'imgs/home/casa 13/fachada.jpg', 10, 'Chácara com Piscina', 'Chácara', 3500.00, 'alugar'),
	(14, 'Jardim Bandeirantes', 'Av. Alberto Benassi', 75.00, 'imgs/home/apartamento 14/predio.jpg', 5, 'Apartamento no Jardim Brasil', 'Apartamento', 2200.00, 'alugar'),
	(15, 'Jardim Residencial Paraíso', 'Rua Bento Ramalho Machado', 90.00, 'imgs/home/apartamento 15/corredor.jpg', 5, 'Apartamento no Jardim Paraíso', 'Apartamento',  2800.00, 'alugar');
 
	INSERT INTO `imoveis_comprar` (`id_casa`, `bairro`, `rua`, `area`, `foto`, `num_comodos`,`titulo_casa`, `tipo_de_imovel`,  `valor`, `finalidade` ) VALUES
	(1, 'Portal das Tipuamas', ' Av. Luiz Dosualdo', 186, 'imgs/home/casa 1/fachada.jpg', 8, 'Casa de alto padrão condominio', 'Casa', 1590000.00, 'comprar'),
	(2, 'Jardim Bandeirantes', 'Av. Alberto Benassi', 75.00, 'imgs/home/casa 2/varanda.jpg', 7, 'Casa no Jardim Bandeirantes','Casa', 220000.00, 'comprar'),
	(3, 'Parque Gramado', 'Rua Afonso Pena', 90.00, 'imgs/home/casa 3/piscina.jpg', 9, 'Casa Parque Gramado com Piscina','Casa', 280000.00, 'comprar'),
	(4, 'Jardim Santa Clara', 'Av. Éllio Polez', 60.00, 'imgs/home/casa 4/entrada.jpg', 6, 'Casa no Jardim Santa Clara','Casa', 180000.00, 'comprar'),
	(5, 'Vila Yamada', 'Rua São Bento', 150.00, 'imgs/home/casa 5/fachada 1.jpg', 6, 'Sobrado na Vila Yamada','Sobrado', 400000.00, 'comprar'),
	(6, 'VIla Xavier', 'Rua Treze de Maio', 80.00, 'imgs/home/casa 6/fachada 2.jpg', 9, 'Casa na Vila Xavier','Casa', 240000.00, 'comprar'),
	(7, 'Jardim das Flores', 'Av. João Soares e Arruda', 250.50, 'imgs/home/casa 7/area 3.jpg', 6, 'Casa proxima ao Shooping Jaraguá','Casa', 350000.00, 'comprar'),
	(8, 'Jardim Universal', 'Av. Brasil', 230.00, 'imgs/home/casa 8/fachada.jpg', 7, 'Casa Recém Reformada Jardim Universal','Casa', 220000.00, 'comprar'),
	(9, 'Vila Nova', 'Rua Afonso Pena', 90.00, 'imgs/home/apartamento 9/quarto 3.jpg', 5, 'Apartamento Resedencial no Villa Nova','Apartamento', 280000.00, 'comprar'),
	(10, 'Centro', 'Rua João Pessoa', 51.00, 'imgs/home/casa 10/entrada.jpg', 7, 'Casa no Centro ','Casa', 180000.00, 'comprar'),
	(11, 'Parque São Paulo', 'Rua Ennio Rodrigues Caraça', 150.00, 'imgs/home/casa 11/area.jpg', 5, 'Casa no Parque São Paulo','Casa',  400000.00, 'comprar'),
	(12, 'Santa Angelina', 'Rua João Goulart', 80.00, 'imgs/home/casa 12/area.jpg', 3, 'Casa em Santa Angelina', 'Casa', 240000.00, 'comprar'),
	(13, 'Chácara Flora ', 'Rua João Evangelista Rodrigues Primiano', 120.50, 'imgs/home/casa 13/fachada.jpg', 10, 'Chácara com Piscina', 'Chácara', 350000.00, 'comprar'),
	(14, 'Jardim Bandeirantes', 'Av. Alberto Benassi', 75.00, 'imgs/home/apartamento 14/predio.jpg', 5, 'Apartamento no Jardim Brasil', 'Apartamento', 220000.00, 'comprar'),
	(15, 'Jardim Residencial Paraíso', 'Rua Bento Ramalho Machado', 90.00, 'imgs/home/apartamento 15/corredor.jpg', 5, 'Apartamento no Jardim Paraíso','Apartamento', 280000.00, 'comprar');
    
