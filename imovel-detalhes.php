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

//array de imagens baseado no ID do imóvel e tipo
$tipo_pasta = strtolower($imovel['tipo_de_imovel']) == 'apartamento' ? 'apartamento' : 'casa';
$pasta_imovel = "imgs/home/" . $tipo_pasta . " " . $id_imovel . "/";

clearstatcache(); //limpa cache do PHP

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

//verifica se a pasta existe 
if (is_dir($pasta_imovel)) {
    foreach($imagens_disponiveis as $imagem) {
        $caminho_completo = realpath($pasta_imovel . $imagem);
        if ($caminho_completo && file_exists($caminho_completo)) {
            //tempo para limpar cache navegador
            $imagens_imovel[] = $pasta_imovel . $imagem . "?v=" . filemtime($caminho_completo);
        }
    }
}

//se não encontrar imagens OU a pasta não existir, usa foto padrão
if (empty($imagens_imovel)) {

    //verifica se a foto padrão existe
    if (file_exists($imovel['foto'])) {
        $imagens_imovel = [$imovel['foto'] . "?v=" . filemtime($imovel['foto'])];
    } else {

        //se a foto padrão nao existe, usa placeholder
        $imagens_imovel = ["imgs/placeholder.jpg"];
    }
}
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

        <!-- carrossel -->
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

        <!-- informações principais -->
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
        
        <!-- formulário lateral -->
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

    <!-- footer -->
    <footer class="footer">
    <div class="footer-container">
      <div class="footer-content">
        <div class="footer-section">
          <h3 class="footer-title">Space Finder</h3>
          <p class="footer-text">Conectando você ao seu próximo lar</p>
          <div class="social-links">
            <a href="https://instagram.com.br" target="_blank" class="social-link">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
              </svg>
            </a>
            <a href="https://www.facebook.com/" target="_blank" class="social-link">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
            </a>
            <a href="https://www.linkedin.com/feed/" target="_blank" class="social-link">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
              </svg>
            </a>
          </div>
        </div>
        
        <div class="footer-section">
          <h4 class="footer-subtitle">Contato</h4>
          <p class="contact-item">spacefinder@space.com.br</p>
          <p class="contact-item">(16) 3333-0005</p>
          <p class="contact-item">Av. Bandeirantes, 505<br>Centro, Araraquara - SP<br>14801-120</p>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>© 2024 Space Finder. Todos os direitos reservados.</p>
      </div>
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

        /* carrossel */
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

        /* informações principais */
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

        /* formulário lateral */
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

      /* footer */
    .footer {
      background: #010d2dff;
      color:rgb(240, 240, 240);
    }

    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 3rem 2rem 1rem;
    }

    .footer-content {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 3rem;
      margin-bottom: 2rem;
    }

    .footer-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: white;
      margin-bottom: 1rem;
    }

    .footer-subtitle {
      font-size: 1.125rem;
      font-weight: 600;
      color: white;
      margin-bottom: 1rem;
    }

    .footer-text {
      margin-bottom: 1.5rem;
    }

    .social-links {
      display: flex;
      gap: 1rem;
    }

    .social-link {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: #010d2dff;
      color: #b4b9c1ff;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.2s ease;
      border: 1px solid #1e40af;  
    }

    .social-link:hover {
      background: #3061ffff;
      color: white;
      transform: translateY(-2px);
    }

    .contact-item {
      margin-bottom: 0.5rem;
    }

    .footer-bottom {
      padding-top: 2rem;
      border-top: 1px solid #fafbff49;
      text-align: center;
      color: #fafbff9e;
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
