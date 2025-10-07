<?php
// conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "spacefinder");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// recebe os parâmetros
$id_imovel = isset($_GET['id']) ? intval($_GET['id']) : 0;
$tipo_transacao = isset($_GET['tipo']) ? $_GET['tipo'] : '';

// valida os parâmetros 
if ($id_imovel <= 0 || !in_array($tipo_transacao, ['alugar', 'comprar'])) {
    header("Location: index.php.");
    exit;
}

// determina a tabela e texto baseado no tipo
$tabela = $tipo_transacao === 'alugar' ? 'imoveis_alugar' : 'imoveis_comprar';
$titulo_pagina = ($tipo_transacao === 'alugar') ? 'Aluguel' : 'Compra';
$texto_acao = ($tipo_transacao === 'alugar') ? 'ALUGAR' : 'COMPRAR';
$periodo_preco = ($tipo_transacao === 'alugar') ? '/mês' : '';

// busca os dados do imovel
$sql = "SELECT * FROM $tabela WHERE id_casa = $id_imovel";
$result = $conn->query($sql);
if (!$result || $result->num_rows == 0) {
    header("Location: " . $tipo_transacao . ".php");
    exit;
}
$imovel = $result->fetch_assoc();

// mensagem personalizada whatsApp
$mensagem_whatsapp = "Olá, tenho interesse no imóvel\n" . $imovel['titulo_casa'] . "\nCódigo: " . $imovel['codigo'] . "\nValor: R$ " . number_format($imovel['valor'], 2, ',', '.') . $periodo_preco . "\nGostaria obter mais informações do imóvel e agendar uma visita.\nAguardo Contato.";


// array de imagens baseado no ID do imóvel e tipo
$tipo_pasta = strtolower($imovel['tipo']) == 'apartamento' ? 'apartamento' : 'casa';
$pasta_imovel = "imgs/home/" . $tipo_pasta . " " . $id_imovel . "/";

clearstatcache();

$imagens_disponiveis = [
<<<<<<< HEAD
    "varanda.jpg", "fachada.jpg", "entrada.jpg", "entrada 2.jpg",
    "cozinha.jpg", "cozinha 2.jpg", "cozinha 3.jpg",
    "banheiro.jpg", "banheiro 1.jpg",
    "sala.jpg", "sala 2.jpg", "sala 3.jpg", "sala-estar.jpg",
    "corredor.jpg", "quarto.jpg", "quarto 2.jpg", "quarto 3.jpg",
    "area.jpg", "area 2.jpg", "area 3.jpg",
    "garagem.jpg", "garagem 2.jpg",
    "quintal.jpg", "quintal 2.jpg",
    "fundo.jpg", "fundo 1.jpg",
    "area-churrasqueira.jpg", "piscina.jpg", "lavanderia.jpg",
=======
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

>>>>>>> 748ade84aadc36a84a513595fbf8f4146e25e203
];

$imagens_imovel = [];

if (is_dir($pasta_imovel)) {
    foreach ($imagens_disponiveis as $imagem) {
        $caminho_completo = realpath($pasta_imovel . $imagem);
        if ($caminho_completo && file_exists($caminho_completo)) {
            $imagens_imovel[] = $pasta_imovel . $imagem . "?v=" . filemtime($caminho_completo);
        }
    }
}

if (empty($imagens_imovel)) {
    if (file_exists($imovel['foto'])) {
        $imagens_imovel = [$imovel['foto'] . "?v=" . filemtime($imovel['foto'])];
    } else {
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<<<<<<< HEAD
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
=======
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
>>>>>>> 748ade84aadc36a84a513595fbf8f4146e25e203
</head>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="logo-container">
            <a href="index.php"><img src="imgs/logosf.png" alt="Logo" class="logo" /></a>
        </div>

        <ul class="nav-links">
            <li><a href="index.php">Início</a></li>
            <li><a href="alugar.php" <?php echo ($tipo_transacao == 'alugar') ? 'class="active"' : ''; ?>>Alugar</a></li>
            <li><a href="comprar.php" <?php echo ($tipo_transacao == 'comprar') ? 'class="active"' : ''; ?>>Comprar</a>
            </li>
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
                    <?php foreach ($imagens_imovel as $index => $imagem): ?>
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

<<<<<<< HEAD
        <!-- conteúdo principal -->
        <div class="main-content">
            <!-- informações principais -->
            <div class="main-info">
                <div class="info-header">   
                    <div class="badge-destaque">
                        <?php echo $tipo_transacao === 'alugar' ? 'Para Alugar' : 'Para Comprar'; ?>
                    </div>
                    
                    <h1 class="titulo-imovel"><?php echo htmlspecialchars($imovel['titulo_casa']); ?></h1>
                    
                    <p class="local">
                        <i class="fas fa-map-marker-alt"></i>
                        <?php echo htmlspecialchars($imovel['bairro']); ?><?php if (!empty($imovel['rua'])): ?> - <?php echo htmlspecialchars($imovel['rua']); ?><?php endif; ?>, Araraquara - SP
                    </p>
                </div>

                <div class="preco-principal">
                    <div class="preco-valor">
                        <span class="preco-label"><?php echo $tipo_transacao === 'alugar' ? 'Aluguel' : 'Valor'; ?></span>
                        <h2>R$ <?php echo number_format($imovel['valor'], 2, ',', '.'); ?><?php echo $periodo_preco; ?></h2>
                    </div>
                    <?php if ($tipo_transacao === 'alugar' && strtolower($imovel['tipo']) == 'apartamento'): ?>
                    <div class="preco-extra">
                        <span class="preco-label">Condomínio</span>
                        <p>R$ 350,00/mês</p>
                    </div>
                    <div class="preco-extra">
                        <span class="preco-label">IPTU</span>
                        <p>R$ 150,00/mês</p>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- características principais -->
                <div class="caracteristicas-principais">
                    <div class="principal-item">
                        <i class="fas fa-ruler-combined"></i>
                        <div>
                            <span class="principal-valor"><?php echo number_format($imovel['area'], 0, ',', '.'); ?>m²</span>
                            <span class="label-item">Área</span>
                        </div>
                    </div>
                    <div class="principal-item">
                        <i class="fas fa-bed"></i>
                        <div>
                            <span class="principal-valor"><?php echo intval($imovel['quarto']); ?></span>
                            <span class="label-item">Quartos</span>
                        </div>
                    </div>
                    <div class="principal-item">
                        <i class="fas fa-bath"></i>
                        <div>
                            <span class="principal-valor"><?php echo intval($imovel['banheiro']); ?></span>
                            <span class="label-item">Banheiros</span>
                        </div>
                    </div>
                    <div class="principal-item">
                        <i class="fas fa-door-open"></i>
                        <div>
                            <span class="principal-valor"><?php echo intval($imovel['num_comodos']); ?></span>
                            <span class="label-item">Cômodos</span>
                        </div>
                    </div>
                </div>

                  <!-- descrição -->
                <?php if (!empty($imovel['descricao'])): ?>
                <div class="secao-descricao">
                    <h3><i class="fas fa-align-left"></i> Descrição</h3>
                    <p><?php echo nl2br(htmlspecialchars($imovel['descricao'])); ?></p>
                </div>
                <?php endif; ?>

                <!-- características detalhadas -->
                <div class="secao-caracteristicas">
                    <h3><i class="fas fa-list-ul"></i> Características do Imóvel</h3>
                    <div class="caracteristicas-grid">
                        <div class="caracteristica-imovel">
                            <i class="fas fa-home"></i>
                            <span>Tipo: <?php echo htmlspecialchars($imovel['tipo']); ?></span>
                        </div>
                        <div class="caracteristica-imovel">
                            <i class="fas fa-expand-arrows-alt"></i>
                            <span>Área: <?php echo number_format($imovel['area'], 0, ',', '.'); ?>m²</span>
                        </div>
                        <div class="caracteristica-imovel">
                            <i class="fas fa-door-closed"></i>
                            <span><?php echo intval($imovel['num_comodos']); ?> Cômodos</span>
                        </div>
                        <div class="caracteristica-imovel">
                            <i class="fas fa-bed"></i>
                            <span><?php echo intval($imovel['quarto']); ?> Quartos</span>
                        </div>
                        <div class="caracteristica-imovel">
                            <i class="fas fa-bath"></i>
                            <span><?php echo intval($imovel['banheiro']); ?> Banheiros</span>
                        </div>
                        <div class="caracteristica-imovel">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Bairro: <?php echo htmlspecialchars($imovel['bairro']); ?></span>
                        </div>
                        <?php if (!empty($imovel['rua'])): ?>
                        <div class="caracteristica-imovel">
                            <i class="fas fa-road"></i>
                            <span><?php echo htmlspecialchars($imovel['rua']); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- diferenciais -->
                <div class="secao-diferenciais">
                    <h3><i class="fas fa-star"></i> Diferenciais</h3>
                    <div class="diferenciais-grid">
                        <?php if ($tipo_transacao == 'alugar'): ?>
                            <div class="diferencial-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Disponível para alugar</span>
                            </div>
                            <div class="diferencial-item">
                                <i class="fas fa-file-contract"></i>
                                <span>Contrato de locação</span>
                            </div>
                        <?php else: ?>
                            <div class="diferencial-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Disponível para venda</span>
                            </div>
                            <div class="diferencial-item">
                                <i class="fas fa-hand-holding-usd"></i>
                                <span>Financiamento disponível</span>
                            </div>
                            <div class="diferencial-item">
                                <i class="fas fa-building"></i>
                                <span>FGTS aceito</span>
                            </div>
                        <?php endif; ?>
                        <div class="diferencial-item">
                            <i class="fas fa-file-alt"></i>
                            <span>Documentação em dia</span>
                        </div>
                        <div class="diferencial-item">
                            <i class="fas fa-calendar-check"></i>
                            <span>Visitas agendadas</span>
                        </div>
                    </div>
                </div>
            </div>

                <!-- descrição -->
                <?php if (!empty($imovel['descricao'])): ?>
                <div class="secao-descricao">
                    <h3><i class="fas fa-align-left"></i> Descrição</h3>
                    <p><?php echo nl2br(htmlspecialchars($imovel['descricao'])); ?></p>
                </div>
                <?php endif; ?>


            <!-- formulário lateral -->
            <aside class="formulario">
                <div class="corretor-card">
                    <div class="corretor-avatar">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="corretor-info">
                        <h4>Flávio Donizete da Silva Moreno</h4>
                        <p><i class="fas fa-id-card"></i> Creci: 200.250-SP</p>
                    </div>
                </div>

                <a class="botao-whatssap"
                    href="https://wa.me/5516933005886?text=<?php echo urlencode($mensagem_whatsapp); ?>"
                    target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Fale no WhatsApp
                </a>

                
                    <a class="botao-email" href="mailto:spacefinder@space.com.br?subject=Interesse%20no%20im%C3%B3vel%20-%20C%C3%B3d.%20<?php 
                    echo $imovel['codigo']; ?>&body=Ol%C3%A1%2C%20tenho%20interesse%20no%20im%C3%B3vel%3A%0A%0A<?php 
                    echo urlencode($imovel['titulo_casa']); ?>%0A%0AC%C3%B3digo%3A%20<?php 
                    echo $imovel['codigo']; ?>%0ABairro%3A%20<?php 
                    echo urlencode($imovel['bairro']); ?>%0AValor%3A%20R%24%20<?php 
                    echo number_format($imovel['valor'], 2, ',', '.'); ?><?php 
                    echo urlencode($periodo_preco); ?>%0A%0AGostaria%20de%20agendar%20uma%20visita%20e%20obter%20mais%20informa%C3%A7%C3%B5es.%0A%0AAguardo%20contato.">
                    <i class="fas fa-envelope"></i>
                    Enviar E-mail
                    </a>

                <div class="imovel-codigo">
                    <i class="fas fa-hashtag"></i>
                    <span>Código: <?php echo $imovel['codigo']; ?></span>
                </div>
            </aside>
        </div>
=======
        <!-- informações principais -->
        <div class="main-info">
            <h2>R$ <?php echo number_format($imovel['valor'], 2, ',', '.'); ?><?php echo $periodo_preco; ?></h2>
            <p><?php echo number_format($imovel['area'], 0, ',', '.'); ?>m² •
                <?php echo intval($imovel['num_comodos']); ?> cômodos • <?php echo intval($imovel['banheiro']); ?>
                Banheiros • <?php echo intval($imovel['quarto']); ?> Quartos </p>
            <p class="local"><?php echo htmlspecialchars($imovel['bairro']); ?><?php if (!empty($imovel['rua'])): ?> -
                    <?php echo htmlspecialchars($imovel['rua']); ?><?php endif; ?>, Araraquara - SP</p>

            <div class="titulo-info">
                <h1><?php echo htmlspecialchars($imovel['titulo_casa']); ?></h1>
                <ul>
                    <li><?php echo htmlspecialchars($imovel['tipo']); ?></li>
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
                        <li>Disponível para alugar</li>
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
                <h4>Flávio Donizete da Silva Moreno</h4>
                <p>Creci: 200.250-SP</p>
            </div>

            <a class="whatsapp-button"
                href="https://wa.me/5516333330005?text=Olá, tenho interesse no imóvel: <?php echo urlencode($imovel['titulo_casa']); ?>"
                target="_blank">
                <i class="fab fa-whatsapp"></i>
                Fale no WhatsApp
            </a>
        </aside>
>>>>>>> 748ade84aadc36a84a513595fbf8f4146e25e203
    </div>

    <!-- footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="secao-footer">
                    <h3 class="titulo-footer">Space Finder</h3>
                    <p class="texto-footer">Conectando você ao seu próximo lar</p>
                    <div class="social-links">
                        <a href="https://instagram.com.br" target="_blank" class="social-link">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
<<<<<<< HEAD
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
=======
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
>>>>>>> 748ade84aadc36a84a513595fbf8f4146e25e203
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/" target="_blank" class="social-link">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
<<<<<<< HEAD
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
=======
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
>>>>>>> 748ade84aadc36a84a513595fbf8f4146e25e203
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/feed/" target="_blank" class="social-link">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
<<<<<<< HEAD
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
=======
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
>>>>>>> 748ade84aadc36a84a513595fbf8f4146e25e203
                            </svg>
                        </a>
                    </div>
                </div>
<<<<<<< HEAD

                <div class="secao-footer">
                    <h4 class="subtitulo-footer">Contato</h4>
                    <p class="contato-footer">spacefinder@space.com.br</p>
                    <p class="contato-footer">(16) 3333-0005</p>
                    <p class="contato-footer">Av. Bandeirantes, 503<br>Centro, Araraquara - SP<br>14801-120</p>
                </div>
            </div>

            <div class="botao-footer">
                <p>© 2024 Space Finder. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
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
=======

                <div class="secao-footer">
                    <h4 class="subtitulo-footer">Contato</h4>
                    <p class="contato-footer">spacefinder@space.com.br</p>
                    <p class="contato-footer">(16) 3333-0005</p>
                    <p class="contato-footer">Av. Bandeirantes, 503<br>Centro, Araraquara - SP<br>14801-120</p>
                </div>
            </div>

            <div class="botao-footer">
                <p>© 2024 Space Finder. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
>>>>>>> 748ade84aadc36a84a513595fbf8f4146e25e203
</body>

</html>

<<<<<<< HEAD
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: #f5f7fa;
        color: #333;
    }

    /* container page */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px 15px;
=======
<!-- carrosel destaques -->
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
    /* container page */
    .container {
        display: flex;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: auto;
        gap: 30px;
        padding: 20px;
>>>>>>> 748ade84aadc36a84a513595fbf8f4146e25e203
    }

    /* carrossel */
    .carousel-box {
<<<<<<< HEAD
        width: 100%;
        margin-bottom: 30px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
=======
        flex: 1 1 60%;
        min-width: 300px;
>>>>>>> 748ade84aadc36a84a513595fbf8f4146e25e203
    }

    .swiper-slide img {
        width: 100%;
<<<<<<< HEAD
        height: 600px;
        object-fit: cover;
    }

    /* layout principal */
    .main-content {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 25px;
        align-items: start;
=======
        height: 650px;
        object-fit: cover;
        border-radius: 10px;
>>>>>>> 748ade84aadc36a84a513595fbf8f4146e25e203
    }

    /* informações principais */
    .main-info {
<<<<<<< HEAD
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .main-info > div {
        padding: 30px;
        border-bottom: 1px solid #e9ecef;
    }

    .main-info > div:last-child {
        border-bottom: none;
    }

    .info-header {
        padding: 30px !important;
    }

    .badge-destaque {
        display: inline-block;
        background: #1d4ed8;
        color: white;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .titulo-imovel {
        font-size: 28px;
        color: #1a1a1a;
        margin-bottom: 12px;
        font-weight: 700;
        line-height: 1.3;
    }

    .local {
        color: #666;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 0;
    }

    .local i {
        color: #1d4ed8;
    }

    /* preço */
    .preco-principal {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
        padding: 25px 30px !important;
        background: #eff2ffff;
    }

    .preco-valor h2 {
        color: #1d4ed8;
        font-size: 32px;
        font-weight: 800;
        margin-top: 5px;
    }

    .preco-label {
        display: block;
        color: #6c757d;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .preco-extra p {
        color: #495057;
        font-size: 18px;
        font-weight: 600;
        margin-top: 5px;
    }

    /* características principais */
    .caracteristicas-principais {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 20px;
    }

    .principal-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        transition: transform 0.2s;
    }

    .principal-item:hover {
        transform: translateY(-2px);
    }

    .principal-item i {
        font-size: 28px;
        color: #1d4ed8;
    }

    .principal-valor {
        display: block;
        font-size: 22px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .label-item {
        display: block;
        font-size: 13px;
        color: #6c757d;
        margin-top: 2px;
    }

    /* seções */
    .secao-descricao h3,
    .secao-caracteristicas h3,
    .secao-diferenciais h3 {
        font-size: 20px;
        color: #1a1a1a;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .secao-descricao h3 i,
    .secao-caracteristicas h3 i,
    .secao-diferenciais h3 i {
        color: #1d4ed8;
    }

    .secao-descricao p {
        color: #495057;
        line-height: 1.8;
        font-size: 15px;
    }

    /* características detalhadas */
    .caracteristicas-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 15px;
    }

    .caracteristica-imovel {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .caracteristica-imovel:hover {
        transform: translateY(-1px);
    }

    .caracteristica-imovel i {
        color: #1d4ed8;
        font-size: 18px;
        width: 24px;
    }

    .caracteristica-imovel span {
        color: #495057;
        font-size: 14px;
    }

    /* diferenciais */
    .diferenciais-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
    }

    .diferencial-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
    }

    .diferencial-item i {
        color: #28a745;
        font-size: 16px;
    }

    .diferencial-item span {
        color: #495057;
        font-size: 14px;
    }

    /* formulário lateral */
    .formulario {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 20px;
    }

    .corretor-card {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e9ecef;
    }

    .corretor-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .corretor-avatar i {
        color: white;
        font-size: 26px;
    }

    .corretor-info h4 {
        font-size: 16px;
        color: #1a1a1a;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .corretor-info p {
        color: #6c757d;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
    }

    .corretor-info i {
        font-size: 12px;
    }

    .botao-whatssap,
    .botao-email {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 14px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 12px;
    }

    .botao-whatssap {
        background: #25d366;
        color: white;
    }

    .botao-whatssap:hover {
        background: #1ebe5d;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        text-decoration: none;
    }

    .botao-email {
        background: #f8f9fa;
        color: #495057;
        border: 2px solid #dee2e6;
    }

    .botao-email:hover {
        background: #e9ecef;
        border-color: #adb5bd;
    }

    .imovel-codigo {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 8px;
        margin-top: 15px;
    }

    .imovel-codigo i {
        color: #1d4ed8;
    }

    .imovel-codigo span {
        color: #495057;
        font-size: 13px;
        font-weight: 600;
=======
        flex: 1 1 60%;
        background: white;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 10px;
    }

    .main-info h2 {
        color: #1d4ed8;
        font-size: 28px;
        margin-bottom: 10px;
        font-weight: 800;
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
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
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
        color: rgb(240, 240, 240);
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

    .titulo-footer {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
    }

    .subtitulo-footer {
        font-size: 1.125rem;
        font-weight: 600;
        color: white;
        margin-bottom: 1rem;
    }

    .texto-footer {
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

    .contato-footer {
        margin-bottom: 0.5rem;
    }

    .botao-footer {
        padding-top: 2rem;
        border-top: 1px solid #fafbff49;
        text-align: center;
        color: #fafbff9e;
>>>>>>> 748ade84aadc36a84a513595fbf8f4146e25e203
    }
</style>

<?php
$conn->close();
?>