<?php
$conn = new mysqli("localhost", "root", "", "spacefinder");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$busca = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

if ($busca) {
    // busca nos campos bairro, rua e tipo_de_imovel
    $sql = "SELECT * FROM imoveis 
            WHERE bairro LIKE '%$busca%' 
            OR rua LIKE '%$busca%' 
            OR tipo_de_imovel LIKE '%$busca%'";
} else {
    // imóveis em destaque padrão 
    $sql = "SELECT * FROM imoveis LIMIT 10";
}

$result = $conn->query($sql);
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
    </div>
  </section>

  <section class="carrossel">
    <h2>
      <?php echo $busca ? "Resultados para \"$busca\"" : "Imóveis em destaque"; ?></h2>

    <div class="carrossel-container">
      <button class="carrossel-btn left">&#10094;</button>
  
      <div class="carrossel-cards" id="carrosselCards" style="padding: 20px;">
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>

            <div class="card">
              <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Imagem do imóvel" />
              <div class="card-content">
                <h3><?php echo htmlspecialchars($row['tipo_de_imovel']); ?> em <?php echo htmlspecialchars($row['bairro']); ?></h3>
                <p><?php echo (int)$row['num_comodos']; ?> cômodos • <?php echo number_format($row['area'], 2, ',', '.'); ?> m²</p>
                <span>R$ <?php echo number_format($row['valor'], 2, ',', '.'); ?></span>
              </div>
            </div>

            
          <?php endwhile; ?>
        <?php else: ?>
          <p style="text-align:center;">Nenhum resultado encontrado.</p>
        <?php endif; ?>
      </div>

      <button class="carrossel-btn right">&#10095;</button>
    </div>
    
  </section>

  <!--  -->

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
</body>

</html>

<style>
  
  home-image {
    flex: 1;
    text-align: center;
}

.home-image img {
    max-width: 100%;
    height: auto;
}

.carrossel {
    padding: 60px 5%;
    background-color: #fff;
}

.carrossel h2 {
    font-size: 1.8rem;
    color: #1d4ed8;
    margin-bottom: 20px;
}

.carrossel-container {
    position: relative;
    overflow: hidden;
}

.carrossel-cards {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding-bottom: 10px;
}

.card {
    min-width: 250px;
    background: #f9fafb;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
    flex-shrink: 0;
}

.card:hover {
    transform: scale(1.02);
}

.card img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: 10px 10px 0 0;
}

.card-content {
    padding: 15px;
}

.card-content h3 {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 5px;
}

.card-content p {
    color: #666;
    margin-bottom: 10px;
}

.card-content span {
    font-weight: bold;
    color: #1d4ed8;
}

.carrossel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: white;
    border: 1px solid #ccc;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    font-size: 1.2rem;
    cursor: pointer;
    z-index: 1;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.carrossel-btn.left {
    left: 0;
}

.carrossel-btn.right {
    right: 0;
}
</style>