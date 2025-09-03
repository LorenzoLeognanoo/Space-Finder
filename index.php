<?php
$conn = new mysqli("localhost", "root", "", "spacefinder");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$busca = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

if ($busca) {
    //busca combinada em ambas as tabelas alugar e comprar
    $sql_alugar = "SELECT *, 'alugar' as tipo_transacao FROM imoveis_alugar
                   WHERE bairro LIKE '%$busca%' 
                   OR rua LIKE '%$busca%' 
                   OR tipo_de_imovel LIKE '%$busca%'
                   OR titulo_casa LIKE '%$busca%'
                   LIMIT 5";
    
    $sql_comprar = "SELECT *, 'comprar' as tipo_transacao FROM imoveis_comprar
                    WHERE bairro LIKE '%$busca%' 
                    OR rua LIKE '%$busca%' 
                    OR tipo_de_imovel LIKE '%$busca%'
                    OR titulo_casa LIKE '%$busca%'
                    LIMIT 5";
    
    //executa ambas as consultas
    $result_alugar = $conn->query($sql_alugar);
    $result_comprar = $conn->query($sql_comprar);
    
    //combina os resultados
    $imoveis_encontrados = [];
    
    if ($result_alugar && $result_alugar->num_rows > 0) {
        while($row = $result_alugar->fetch_assoc()) {
            $imoveis_encontrados[] = $row;
        }
    }
    
    if ($result_comprar && $result_comprar->num_rows > 0) {
        while($row = $result_comprar->fetch_assoc()) {
            $imoveis_encontrados[] = $row;
        }
    }
    
} else {
    //imóveis em destaque misturando alugar e comprar
    $sql_destaque = "
        (SELECT *, 'alugar' as tipo_transacao FROM imoveis_alugar LIMIT 5)
        UNION ALL
        (SELECT *, 'comprar' as tipo_transacao FROM imoveis_comprar LIMIT 5)
        ORDER BY RAND()
        LIMIT 10
    ";
    
    $result = $conn->query($sql_destaque);
    $imoveis_encontrados = [];
    
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $imoveis_encontrados[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Space Finder</title>
  <link rel="shortcut icon" href="imgs/logo-icon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <nav class="navbar">
    <div class="logo-container">
      <a href="index.php"><img src="imgs/logosf.png" alt="Logo" class="logo" /></a>
    </div>

    <ul class="nav-links">
      <li><a href="index.php" class="active">Início</a></li>
      <li><a href="alugar.php">Alugar</a></li>
      <li><a href="comprar.php">Comprar</a></li>
      <li><a href="sobre.php">Sobre Nós</a></li>
      <li><a href="contato.php">Contato</a></li>
    </ul>

    <div class="menu-toggle" id="menu-toggle">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>

  <section class="card-principal">
    <div>
      <h1 class="titulo-principal">SPACE FINDER</h1>
      <p class="subtitulo-principal">Alugue ou compre imóveis de forma fácil, rápida e segura com a SpaceFinder.</p>

      <form class="search-box" method="GET" action="index.php">
        <input type="text" name="q" placeholder="Digite uma localização ou tipo de imóvel..." value="<?php echo htmlspecialchars($busca); ?>" />
        <button type="submit">Buscar</button>
      </form>

      <!-- Links rápidos -->
      <div class="links-imoveis">
        <a href="alugar.php" class="link-rapido">Imóveis para Alugar</a>
        <a href="comprar.php" class="link-rapido">Imóveis para Comprar</a>
      </div>
    </div>
  </section>

  <section class="carrossel">
    <div class="section-header">
      <h2>
        <?php 
        if ($busca) {
            $total_encontrados = count($imoveis_encontrados);
            echo "Resultados para \"$busca\" ($total_encontrados encontrados)";
        } else {
            echo "Imóveis em destaque";
        }
        ?>
      </h2>
      <?php if (!$busca): ?>
        <p class="section-subtitulo">Confira algumas das melhores opções disponíveis</p>
      <?php endif; ?>
    </div>

    <div class="carrossel-container">
      <button class="carrossel-btn left">&#10094;</button>
  
      <div class="carrossel-cards" id="carrosselCards">
        <?php if (!empty($imoveis_encontrados)): ?>
          <?php foreach ($imoveis_encontrados as $row): ?>
            <div class="card" onclick="verDetalhes(<?php echo $row['id_casa']; ?>, '<?php echo $row['tipo_transacao']; ?>')">
              <div class="card-image">
                <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Imagem do imóvel" />
                <div class="card-badge"><?php echo ucfirst($row['tipo_transacao']); ?></div>
              </div>
              <div class="card-content">
                <div class="card-preço">
                  R$ <?php echo number_format($row['valor'], 2, ',', '.'); ?>
                  <?php echo ($row['tipo_transacao'] == 'alugar') ? '<span class="period">/mês</span>' : ''; ?>
                </div>
                <h3 class="card-titulo"><?php echo htmlspecialchars($row['titulo_casa']); ?></h3>
                <div class="card-location">
                  <?php echo htmlspecialchars($row['bairro']); ?><?php if(!empty($row['rua'])): ?> - <?php echo htmlspecialchars($row['rua']); ?><?php endif; ?>
                </div>
                <div class="card-info">
                  <span><?php echo (int)$row['num_comodos']; ?> cômodos</span>
                  <span><?php echo number_format($row['area'], 0, ',', '.'); ?> m²</span>
                  <span><?php echo htmlspecialchars($row['tipo_de_imovel']); ?></span>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="sem-resultado">
            <div class="sem-resultado-content">
              <h3><?php echo $busca ? "Nenhum resultado encontrado" : "Nenhum imóvel disponível"; ?></h3>
              <p>
                <?php if ($busca): ?>
                  Não encontramos imóveis para "<?php echo htmlspecialchars($busca); ?>". Tente outros termos de busca.
                <?php else: ?>
                  No momento não há imóveis disponíveis.
                <?php endif; ?>
              </p>
              <?php if ($busca): ?>
                <div class="sem-resultado-actions">
                  <a href="alugar.php" class="btn-secundario">Ver Aluguel</a>
                  <a href="comprar.php" class="btn-secundario">Ver Venda</a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <button class="carrossel-btn right">&#10095;</button>
    </div>
  </section>

  <!--footer-->
  <footer>
    <div class="footer-container">
      <div class="footer-social">
        <p>Conheça nossas<br />redes sociais</p>
        <div class="footer-social">
          <div class="icons" style="display: flex; gap: 10px; margin-top: 10px;">
            <a href="https://instagram.com.br" target="_blank"><img
                src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/instagram.svg" style="width: 24px; filter: invert(1);"
                alt="Instagram" /></a>
            <a href="https://www.facebook.com/" target="_blank"><img
                src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/facebook.svg" style="width: 24px; filter: invert(1);"
                alt="Facebook" /></a>
            <a href="https://x.com/home/" target="_blank"><img
                src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/x.svg" style="width: 24px; filter: invert(1);" alt="X" /></a>
            <a href="https://www.linkedin.com/feed/" target="_blank"><img
                src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/linkedin.svg" style="width: 24px; filter: invert(1);"
                alt="LinkedIn" /></a>
          </div>
        </div>
      </div>
      <div class="footer-contact">
        <p><strong>Entre em contato<br />com a Space Finder</strong></p>
        <p>spacefinder@space.com.br</p>
        <p>(16) 3333-0005</p>
        <p>Av. Bandeirantes, 505 -<br />Centro, Araraquara - SP,<br />14801-120</p>
      </div>
    </div>
    <div class="footer-bottom">
      © Todos direitos reservados - SpaceFinder
    </div>
  </footer>

  <script src="script.js"></script>
  <script>
    // função para redirecionar para detalhes do imóvel
    function verDetalhes(id, tipo) {
        window.location.href = `imovel-detalhes.php?id=${id}&tipo=${tipo}`;
    }
  </script>
</body>

</html>

<style>


  /*  links rapido alugar e comprar */
  .links-imoveis {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 25px;
  }

  .link-rapido {
    background: #1d4ed8;
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .link-rapido:hover {
    background:rgba(29, 79, 216, 0.54);
    text-decoration: none;
    color: white;
    transform: translateY(-2px);
  }

  /*  section header */
  .section-header {
    text-align: center;
    margin-bottom: 30px;
  }

  .section-header h2 {
    font-size: 1.8rem;
    color:#1d4ed8;
    margin-bottom: 10px;
  }

  .section-subtitulo {
    color: #6c757d;
    font-size: 1rem;
    margin: 0;
  }

  .carrossel {
    padding: 60px 5%;
    background-color: #fff;
  }

  .carrossel-container {
    position: relative;
    overflow: hidden;
  }

  .carrossel-cards {
    display: flex;
    gap: 25px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 20px 10px;
  }

  /* cards */
  .card { 
    width: 320px;
    max-width: 320px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    flex-shrink: 0;
    cursor: pointer;
    border: 1px solid #f1f3f4;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
  }

  .card-image {
    position: relative;
    height: 180px;
    overflow: hidden;
    border-radius: 12px 12px 0 0;
  }

  .card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .card:hover img {
    transform: scale(1.05);
  }

  .card-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: #1d4ed8;
    color: white;
    padding: 4px 10px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
  }

  .card-content {
    padding: 20px;
  }

  .card-preço {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1d4ed8;
    margin-bottom: 8px;
  }

  .card-preço .period {
    font-size: 0.75rem;
    color: #6c757d;
    font-weight: 400;
  }

  .card-titulo {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    line-height: 1.3;
  }

  .card-location {
    color: #6c757d;
    font-size: 13px;
    margin-bottom: 15px;
  }

  .card-info {
    display: flex;
    gap: 12px;
    font-size: 12px;
    color: #6c757d;
  }

  .card-info span {
    background: #f8f9fa;
    padding: 3px 8px;
    border-radius: 10px;
  }

  /* sem resultado busca */
  .sem-resultado {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 300px;
  }

  .sem-resultado-content {
    text-align: center;
    max-width: 400px;
    padding: 40px 20px;
  }

  .sem-resultado-content h3 {
    color: #343a40;
    margin-bottom: 15px;
  }

  .sem-resultado-content p {
    color: #6c757d;
    margin-bottom: 25px;
  }


  .btn-secundario {
    background: #6c757d;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .btn-secundario:hover {
    background: #5a6268;
    text-decoration: none;
    color: white;
  }

  /* botões do carrossel */
  .carrossel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 1.2rem;
    cursor: pointer;
    z-index: 10;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #495057;
  }

  .carrossel-btn:hover {
    background: #1d4ed8;
    color: white;
    border-color: #1d4ed8;
  }

  .carrossel-btn.left {
    left: -20px;
  }

  .carrossel-btn.right {
    right: -20px;
  }

 
  /* responsividade */
  @media (max-width: 768px) {
    .links-imoveis {
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .carrossel-cards {
      gap: 15px;
      padding: 20px 5px;
    }

    .card {
      width: 280px;
      max-width: 280px;
    }

    .carrossel-btn {
      width: 35px;
      height: 35px;
    }

    .carrossel-btn.left {
      left: -10px;
    }

    .carrossel-btn.right {
      right: -10px;
    }

    .categorias-grid {
      grid-template-columns: 1fr;
      gap: 20px;
    }

    .sem-resultado-actions {
      flex-direction: column;
    }
  }

  @media (max-width: 480px) {
    .links-imoveis {
      margin-top: 20px;
    }

    .link-rapido {
      padding: 8px 16px;
      font-size: 13px;
    }
  }
</style>

<?php
$conn->close();
?>