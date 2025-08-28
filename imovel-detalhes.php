<?php 
//conexao com o banco de dados
$conn = new mysqli("localhost", "root", "", "spacefinder");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}   

//recebe os parâmetros
$id_imovel = isset($_GET['id']) ? intval($_GET['id']) : 0;
$tipo_transacao = isset($_GET['tipo']) ? $_GET['tipo'] : '';

//valida os paremetros 
if ($id_imovel <= 0 || !in_array($tipo_transacao, ['alugar', 'comprar'])) {
    header("Location: index.php.");
    exit;
}

//determina a tabela e texto baseado no tipo
$tabela = $tipo_transacao === 'alugar' ? 'imoveis_alugar' : 'imoveis_comprar';
$titulo_pagina = ($tipo_transacao === 'alugar')? 'Aluguel' : 'Compra';
$texto_acao = ($tipo_transacao === 'alugar')? 'ALUGAR' : 'COMPRAR';
$periodo_preco = ($tipo_transacao === 'alugar')? '/mês' : '';

//busca os dados do imovel
$sql = "SELECT * FROM $tabela WHERE id_casa = $id_imovel";
$result = $conn->query($sql);
if (!$result || $result->num_rows == 0) {
    header("Location: " . $tipo_transacao . ".php");
    exit;
}
$imovel = $result->fetch_assoc();

// Array de imagens baseado no ID do imóvel e tipo
$tipo_pasta = strtolower($imovel['tipo_de_imovel']) == 'apartamento' ? 'apartamento' : 'casa';
$pasta_imovel = "imgs/home/" . $tipo_pasta . " " . $id_imovel . "/";

clearstatcache(); // Limpa cache do PHP

$imagens_disponiveis = [
    "varanda.jpg",
    "fachada.jpg",
    "entrada.jpg", 
    "entrada 2.jpg", 
    "cozinha.jpg",
    "cozinha 2.jpg",
    "cozinha 3.jpg",
    "banheiro.jpg", 
    "banheiro 1.jpg",         
    "sala.jpg",
    "sala 2.jpg",
    "sala 3.jpg",
    "sala-estar.jpg",
    "corredor.jpg",
    "quarto.jpg",
    "quarto 2.jpg",
    "quarto 3.jpg",
    "area.jpg",
    "area 2.jpg",
    "area 3.jpg",
    "garagem.jpg",
    "garagem 2.jpg",
    "quintal.jpg",
    "quintal 2.jpg",
    "fundo.jpg",
    "fundo 1.jpg",
    "area-churrasqueira.jpg",
    "piscina.jpg",
    "lavanderia.jpg",
   
];

$imagens_imovel = [];

// verifica se a pasta existe 
if (is_dir($pasta_imovel)) {
    foreach($imagens_disponiveis as $imagem) {
        $caminho_completo = realpath($pasta_imovel . $imagem);
        if ($caminho_completo && file_exists($caminho_completo)) {
            // Adiciona timestamp para quebrar cache do navegador
            $imagens_imovel[] = $pasta_imovel . $imagem . "?v=" . filemtime($caminho_completo);
        }
    }
}

// Se não encontrar imagens OU a pasta não existir, usa foto padrão
if (empty($imagens_imovel)) {
    // Verifica se a foto padrão existe
    if (file_exists($imovel['foto'])) {
        $imagens_imovel = [$imovel['foto'] . "?v=" . filemtime($imovel['foto'])];
    } else {
        // Se nem a foto padrão existe, usa placeholder
        $imagens_imovel = ["imgs/placeholder.jpg"];
    }
}

// DEBUG TEMPORÁRIO - remova depois
echo "<!-- DEBUG: Pasta: " . $pasta_imovel . " | Existe: " . (is_dir($pasta_imovel) ? 'SIM' : 'NÃO') . " | Total imagens: " . count($imagens_imovel) . " -->";
?>

<!-- E adicione esta meta tag no <head> do HTML para evitar cache: -->
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0"><?php
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Space Finder - <?php echo htmlspecialchars($imovel['titulo_casa']); ?></title>
    <link rel="shortcut icon" href="imgs/logo-icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo-container">
            <a href="index.php"><img src="imgs/logosf.png" alt="Logo" class="logo" /></a>
        </div>

        <ul class="nav-links">
            <li><a href="index.php">Início</a></li>
            <li><a href="alugar.php" <?php echo ($tipo_transacao == 'alugar') ? 'class="active"' : ''; ?>>Alugar</a></li>
            <li><a href="comprar.php" <?php echo ($tipo_transacao == 'comprar') ? 'class="active"' : ''; ?>>Comprar</a></li>
            <li><a href="sobre.php">Sobre Nós</a></li>
            <li><a href="contato.php">Contato</a></li>
        </ul>

        <div class="menu-toggle" id="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <div class="container">

        <!-- Carrossel -->
        <div class="carousel-box">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach($imagens_imovel as $index => $imagem): ?>
                        <div class="swiper-slide">
                            <img src="<?php echo !empty($imagem) ? htmlspecialchars($imagem) : 'imgs/placeholder.jpg'; ?>" 
                                 alt="Foto <?php echo $index + 1; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-prev"></div>  
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- Informações principais -->
        <div class="main-info">
            <h2>R$ <?php echo number_format($imovel['valor'], 2, ',', '.'); ?><?php echo $periodo_preco; ?></h2>
            <p><?php echo number_format($imovel['area'], 0, ',', '.'); ?>m² • <?php echo intval($imovel['num_comodos']); ?> cômodos • <?php echo htmlspecialchars($imovel['tipo_de_imovel']); ?></p>
            <p class="local"><?php echo htmlspecialchars($imovel['bairro']); ?><?php if(!empty($imovel['rua'])): ?> - <?php echo htmlspecialchars($imovel['rua']); ?><?php endif; ?>, Araraquara - SP</p>
            
            <div class="titulo-info">
                <h1><?php echo htmlspecialchars($imovel['titulo_casa']); ?></h1>
                <ul>
                    <li>Tipo: <?php echo htmlspecialchars($imovel['tipo_de_imovel']); ?></li>
                    <li>Área: <?php echo number_format($imovel['area'], 0, ',', '.'); ?>m²</li>
                    <li>Cômodos: <?php echo intval($imovel['num_comodos']); ?></li>
                    <li>Bairro: <?php echo htmlspecialchars($imovel['bairro']); ?></li>
                    <?php if (!empty($imovel['rua'])): ?>
                    <li>Endereço: <?php echo htmlspecialchars($imovel['rua']); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($imovel['descricao'])): ?>
                    <li>Descrição: <?php echo htmlspecialchars($imovel['descricao']); ?></li>
                    <?php endif; ?>
                    
                    <?php if ($tipo_transacao == 'alugar'): ?>
                    <li>Disponível para locação</li>
                    <li>Contrato de locação</li>
                    <?php else: ?>
                    <li>Disponível para venda</li>
                    <li>Financiamento disponível</li>
                    <li>FGTS aceito</li>
                    <?php endif; ?>
                    
                    <li>Documentação em dia</li>
                    <li>Visitas agendadas</li>
                </ul>
            </div>
        </div>
        
        <!-- Formulário lateral -->
        <aside class="form-box">
            <div class="corretor">
                <h4>Ricardo Sena Magnavita</h4>
                <p>Creci: 09334-F-BA</p>
            </div>

            <a class="whatsapp-button" href="https://wa.me/5516333330005?text=Olá, tenho interesse no imóvel: <?php echo urlencode($imovel['titulo_casa']); ?>" target="_blank">
                <i class="fab fa-whatsapp"></i> 
                Fale no WhatsApp
            </a>
        </aside>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-social">
                <p>Conheça nossas<br>redes sociais</p>
                <div class="icons" style="display: flex; gap: 10px; margin-top: 10px;">
                    <a href="https://instagram.com.br" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/instagram.svg" style="width: 24px; filter: invert(1);" alt="Instagram"></a>
                    <a href="https://www.facebook.com/" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/facebook.svg" style="width: 24px; filter: invert(1);" alt="Facebook"></a> 
                    <a href="https://x.com/home/" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/x.svg" style="width: 24px; filter: invert(1);" alt="X"></a>
                    <a href="https://www.linkedin.com/feed/" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/linkedin.svg" style="width: 24px; filter: invert(1);" alt="LinkedIn"></a>
                </div>
            </div>
            <div class="footer-contact">
                <p><strong>Entre em contato<br>com a Space Finder</strong></p>
                <p>spacefinder@space.com.br</p>
                <p>(16) 3333-0005</p>
                <p>Av. Bandeirantes, 505 -<br>Centro, Araraquara - SP,<br>14801-120</p>
            </div>
        </div>
        <div class="footer-bottom">
            © Todos direitos reservados - SpaceFinder
        </div>
    </footer>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        function verDetalhes(id, tipo) {
            window.location.href = `imovel-detalhes.php?id=${id}&tipo=${tipo}`;
        }

        const swiper = new Swiper('.swiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            }
        });
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: white;
            margin: 0;
            padding: 0;
        }

        .navbar {
            margin-top: 10px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
            padding: 0 20px;
            background: white;
        }

        /* logo */
        .logo {  
            height: 70px;
            width: auto;
            object-fit: contain;
        }

        /* links navbar */
        .nav-links {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            gap: 25px;
            list-style: none;
            margin-top: -2px;
        }

        .nav-links a {
            text-decoration: none;
            color: black;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #1d4ed8;
        }

        .nav-links a.active {
            border-bottom: 2px solid #1d4ed8;
            color: #153eb5;
        }

        /* menu hamburguer para mobile */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;        
            gap: 5px;
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background: black;
            transition: 0.3s ease;
        }

        /* responsividade site */
        @media (max-width: 885px) {
            .nav-links {
                position: absolute;
                top: 60px;
                left: 0;
                right: 0;
                transform: none;
                display: none;
                flex-direction: column;
                background-color: white;
                text-align: center;
                padding: 15px 0;
            }

            .nav-links.show {
                display: flex;
            }

            .menu-toggle {
                display: flex;
            }
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: auto;
            gap: 30px;
            padding: 20px;
        }

        /* Carrossel */
        .carousel-box {
            flex: 1 1 60%;
            min-width: 300px;
        }

        .swiper-slide img {
            width: 100%;
            height: 650px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Informações principais */
        .main-info {
            flex: 1 1 60%;
            background: white;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            padding: 20px;
            border-radius: 10px;
        }

        .main-info h2 {
            color: #1d4ed8;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .main-info p {
            font-size: 18px;
            margin: 10px 0;
            color: #495057;
        }

        .local {
            color: #666;
            font-size: 15px;
        }

        .titulo-info {
            margin-top: 20px;
        }

        .titulo-info h1 {
            color: #343a40;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .titulo-info ul {
            list-style: none;
            padding: 0;
        }

        .titulo-info li {
            padding: 8px 0;
            border-bottom: 1px solid #f1f3f4;
            color: #495057;
        }

        /* Formulário lateral */
        .form-box {
            flex: 1 1 30%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            height: fit-content;
        }

        .corretor h4 {
            margin: 0 0 5px;
            color: #343a40;
            font-size: 18px;
        }

        .corretor p {
            color: #6c757d;
            margin-bottom: 20px;
        }
        
        .whatsapp-button {
            display: block;
            text-align: center;
            background-color: #25d366;
            color: white;
            padding: 12px;
            margin-top: 15px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 10px;
            transition: background-color 0.3s;
            width: 90%;
        }

        .whatsapp-button:hover {
            background-color: #1ebe5d;
            text-decoration: none;
        }

       
        /* Footer */
        footer {
            background: #343a40;
            color: white;
            padding: 30px 0 15px;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #495057;
            color: #adb5bd;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                gap: 20px;
            }

            .carousel-box, .main-info, .form-box {
                flex: 1 1 100%;
            }

            .swiper-slide img {
                height: 300px;
            }

            .main-info h2 {
                font-size: 24px;
            }

            .footer-container {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
</body>
</html>

<?php
$conn->close();
?>
