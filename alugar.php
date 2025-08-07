
<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "spacefinder");

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Recebe os filtros
$bairro = $_GET['bairro'] ?? '';
$tipo = $_GET['tipo_de_imovel'] ?? '';
$quartos = $_GET['quartos'] ?? '';
$faixa_preco = $_GET['faixa_preco'] ?? '';
$busca = $_GET['search'] ?? ''; // caso você quiser adicionar campo de busca também

// Monta a consulta SQL com filtros
$sql = "SELECT * FROM imoveis WHERE 1=1";

if (!empty($bairro)) {
    $sql .= " AND bairro LIKE '%" . $conn->real_escape_string($bairro) . "%'";
}

if (!empty($tipo)) {
    $sql .= " AND tipo = '" . $conn->real_escape_string($tipo) . "'";
}

if (!empty($quartos)) {
    $sql .= " AND quartos = " . intval($quartos);
}

if (!empty($faixa_preco)) {
    [$min, $max] = explode('-', $faixa_preco);
    $sql .= " AND preco BETWEEN $min AND $max";
}

if (!empty($busca)) {
    $sql .= " AND (titulo LIKE '%" . $conn->real_escape_string($busca) . "%' OR descricao LIKE '%" . $conn->real_escape_string($busca) . "%')";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Space</title>
  <link rel="shortcut icon" href="imgs/logo-icon.ico" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="script.js">
</head>

<body>
 <nav class="navbar">
    <div class="logo-container">
      <a href="index.php"><img src="imgs/logosf.png" alt="Logo" class="logo" /></a>
    </div>

    <ul class="nav-links">
      <li><a href="index.php">Início</a></li>
      <li><a href="alugar.php" class="active">Alugar</a></li>
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
    <h1 class="titulo-principal">ALUGUE SEU IMÓVEL</h1>
    <p class="subtitulo-principal">Alugue imóveis de forma fácil, rápida e segura com a SpaceFinder.</p>

    <form class="search-box" method="GET" action="index.php">
        <input type="text" name="q" placeholder="Digite uma localização ou tipo de imóvel..." value="<?php echo htmlspecialchars($busca); ?>" />
        <button type="submit">Buscar</button>
      </form>
    </div>

  
</section>

      
  <section class="carrossel">
    <div class="carrossel-container">
      <div class="carrossel-cards" id="carrosselCards">
        
        <!-- Card 1 -->
           <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel0.jpg" alt="Casa 1">
          <div class="card-content">
            <h3>Casa moderna</h3>
            <p>Aluguel • 3 quartos</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>
  
        <!-- Card 2 -->
          <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel1.jpg" alt="Casa 2">
          <div class="card-content">
            <h3>Apartamento no centro</h3>
            <p>Venda • 2 quartos</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>
  
        <!-- Card 3 -->
           <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel2.jpg" alt="Casa 3">
          <div class="card-content">
            <h3>Casa com piscina</h3>
            <p>Aluguel • 4 quartos</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>
  
        <!-- Card 4 -->
          <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel3.jpg" alt="Casa 4">
          <div class="card-content">
            <h3>Studio mobiliado</h3>
            <p>Venda • 1 quarto</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>

    <!-- Card 5 -->
      <a class="linkinfo" href="infos/index.php">
    <div class="card">
        <img src="imgs/aluguel/aluguel4.jpg" alt="Casa 4">
        <div class="card-content">
          <h3>Studio mobiliado</h3>
          <p>Venda • 1 quarto</p>
          <span>R$ 2.300 / mês</span>
        </div>
      </div>
      </a>
      </div>
    </div>
    
  </section>
  <section class="carrossel">
    <div class="carrossel-container">
      <div class="carrossel-cards" id="carrosselCards">
        
        <!-- Card 1 -->
          <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel5.jpg" alt="Casa 1">
          <div class="card-content">
            <h3>Casa moderna</h3>
            <p>Aluguel • 3 quartos</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>
  
        <!-- Card 2 -->
          <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel6.jpg" alt="Casa 2">
          <div class="card-content">
            <h3>Apartamento no centro</h3>
            <p>Venda • 2 quartos</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>
  
        <!-- Card 3 -->
          <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel7.jpg" alt="Casa 3">
          <div class="card-content">
            <h3>Casa com piscina</h3>
            <p>Aluguel • 4 quartos</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>
  
        <!-- Card 4 -->
          <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel8.jpg" alt="Casa 4">
          <div class="card-content">
            <h3>Studio mobiliado</h3>
            <p>Venda • 1 quarto</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>

    <!-- Card 5 -->
      <a class="linkinfo" href="infos/index.php">
    <div class="card">
        <img src="imgs/aluguel/aluguel9.jpg" alt="Casa 4">
        <div class="card-content">
          <h3>Studio mobiliado</h3>
          <p>Venda • 1 quarto</p>
          <span>R$ 2.300 / mês</span>
        </div>
      </div>
      </a>
      </div>
    </div>
  </section>
  <section class="carrossel">
    <div class="carrossel-container">
      <div class="carrossel-cards" id="carrosselCards">
        
        <!-- Card 1 -->
          <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel10.jpg" alt="Casa 1">
          <div class="card-content">
            <h3>Casa moderna</h3>
            <p>Aluguel • 3 quartos</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>
  
        <!-- Card 2 -->
          <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel11.jpg" alt="Casa 2">
          <div class="card-content">
            <h3>Apartamento no centro</h3>
            <p>Venda • 2 quartos</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>
  
        <!-- Card 3 -->
          <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel12.jpg" alt="Casa 3">
          <div class="card-content">
            <h3>Casa com piscina</h3>
            <p>Aluguel • 4 quartos</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>
  
        <!-- Card 4 -->
          <a class="linkinfo" href="infos/index.php">
        <div class="card">
          <img src="imgs/aluguel/aluguel13.jpg" alt="Casa 4">
          <div class="card-content">
            <h3>Studio mobiliado</h3>
            <p>Venda • 1 quarto</p>
            <span>R$ 2.300 / mês</span>
          </div>
        </div>
        </a>

    <!-- Card 5 -->
    <a class="linkinfo" href="infos/index.php">
    <div class="card">
        <img src="imgs/aluguel/aluguel14.jpg" alt="Casa 4">
        <div class="card-content">
          <h3>Studio mobiliado</h3>
          <p>Venda • 1 quarto</p>
          <span>R$ 2.300 / mês</span>
        </div>
      </div>
      </a>
      
      </div>
    </div>
  </section>
  
      <!-- footer pagina -->
<footer>
  <div class="footer-container">
    <div class="footer-social">
      <p>Conheça nossas<br>redes sociais</p>
      <div class="footer-social">
  <div class="icons" style="display: flex; gap: 10px; margin-top: 10px;">
    <a  href="https://instagram.com.br" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/instagram.svg" style="width: 24px; filter: invert(1);" alt="Instagram"> </a>
    <a  href="https://www.facebook.com/" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/facebook.svg" style="width: 24px; filter: invert(1);" alt="Facebook"></a> 
    <a  href="https://x.com/home/" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/x.svg" style="width: 24px; filter: invert(1);" alt="X"></a>
    <a  href="https://www.linkedin.com/feed/" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/linkedin.svg" style="width: 24px; filter: invert(1);" alt="LinkedIn"></a>
  </div>
</div>
    </div>
    <div class="footer-contact">
      <p><strong>Entre em contato<br>com a Space Finder</strong></p>
      <p> spacefinder@space.com.br</p>
      <p>(16) 3333-0005</p>
      <p> Av. Bandeirantes, 505 -<br>Centro, Araraquara - SP,<br>14801-120</p>
    </div>
  </div>
  <div class="footer-bottom">
    © Todos direitos reservados - SpaceFinder
  </div>
</footer> 
</body>
</html>
<style>
  
.linkinfo {
  text-decoration: none
}


    /* carrosel de imagens*/
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
  gap: 60px;
  overflow-x: auto;
  scroll-behavior: smooth;
  padding-bottom: 10px;
}

.card {
  display: block;
  align-items: center;
  justify-content: center;
  min-width: 150px;
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
.search-and-filters {
  display: flex;
  flex-direction: column;
  align-items: center; /* centraliza horizontalmente */
  gap: 60px; /* espaçamento entre search box e filtros */
  margin-top: 20px; /* distanciamento da search box do texto acima */

}

.filters-form {
  display: flex;
  gap: 60px;
  flex-wrap: wrap;
  margin-bottom: 30px;
}

.filters-form input,
.filters-form select {
  padding: 10px;
  border-radius: 6px;
  border: 1px solid #ccc;
  min-width: 150px;
  font-size: 1rem;
}

.filters-form button {
  background-color: #1d4ed8;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
}

.filters-form button:hover {
  background-color: #2563eb;
}



</style>