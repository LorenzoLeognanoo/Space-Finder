<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "spacefinder");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Pega o ID do imóvel e o tipo (alugar/comprar) da URL
$id_imovel = isset($_GET['id']) ? intval($_GET['id']) : 0;
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'alugar';

// Define a tabela baseada no tipo
$tabela = ($tipo === 'comprar') ? 'imoveis_comprar' : 'imoveis_alugar';

// Busca as informações do imóvel
$sql = "SELECT * FROM $tabela WHERE id_casa = $id_imovel";
$result = $conn->query($sql);

// Verifica se o imóvel existe
if (!$result || $result->num_rows == 0) {
    $redirect_page = ($tipo === 'comprar') ? 'comprar.php' : 'alugar.php';
    header("Location: $redirect_page");
    exit();
}

$imovel = $result->fetch_assoc();

// Busca as fotos do imóvel (assumindo que há uma tabela de fotos)
$sql_fotos = "SELECT * FROM fotos_imovel WHERE id_imovel = $id_imovel ORDER BY ordem";
$result_fotos = $conn->query($sql_fotos);

// Se não houver tabela de fotos, usar a foto principal
$fotos = [];
if ($result_fotos && $result_fotos->num_rows > 0) {
    while($foto = $result_fotos->fetch_assoc()) {
        $fotos[] = $foto['caminho_foto'];
    }
} else {
    // Se não houver fotos específicas, usar a foto principal ou fotos padrão
    if (!empty($imovel['foto'])) {
        $fotos[] = $imovel['foto'];
    }
    // Adicionar fotos genéricas se necessário
    $fotos = array_merge($fotos, [
        'imgs/placeholder.jpg',
        'imgs/placeholder2.jpg',
        'imgs/placeholder3.jpg'
    ]);
}

// Busca informações do corretor (assumindo que há um campo corretor_id ou similar)
$corretor = [
    'nome' => 'Ricardo Sena Magnavita',
    'creci' => '09334-F-BA',
    'telefone' => '5571999999999'
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($imovel['titulo_casa']); ?> - SpaceFinder</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="imgs/logo-icon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

  <?php
  // Exibe mensagens de sucesso ou erro
  if (isset($_GET['sucesso'])) {
    echo '<div class="alert alert-success">Mensagem enviada com sucesso! Entraremos em contato em breve.</div>';
  }
  if (isset($_GET['erro'])) {
    $erro = $_GET['erro'];
    switch ($erro) {
      case 'campos_obrigatorios':
        echo '<div class="alert alert-error">Por favor, preencha todos os campos obrigatórios.</div>';
        break;
      case 'email_invalido':
        echo '<div class="alert alert-error">Por favor, insira um email válido.</div>';
        break;
      case 'falha_envio':
        echo '<div class="alert alert-error">Erro ao enviar mensagem. Tente novamente.</div>';
        break;
      default:
        echo '<div class="alert alert-error">Erro no sistema. Tente novamente mais tarde.</div>';
    }
  }
  ?>

  <div class="container">

    <!-- Carrossel -->
    <div class="carousel-box">
      <div class="swiper">
        <div class="swiper-wrapper">
          <?php foreach($fotos as $index => $foto): ?>
            <div class="swiper-slide">
              <img src="<?php echo htmlspecialchars($foto); ?>" alt="Foto <?php echo $index + 1; ?>" onerror="this.src='imgs/placeholder.jpg'">
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
      <h2>R$ <?php echo number_format($imovel['valor'], 2, ',', '.'); ?><?php echo ($tipo === 'alugar') ? '/mês' : ''; ?></h2>
      <p>
        <?php echo number_format($imovel['area'], 0, ',', '.'); ?>m² • 
        <?php echo intval($imovel['num_comodos']); ?> cômodos • 
        <?php echo htmlspecialchars($imovel['tipo_de_imovel']); ?>
      </p>
      <p class="local">
        <?php echo htmlspecialchars($imovel['bairro']); ?>
        <?php if (!empty($imovel['rua'])): ?>
          , <?php echo htmlspecialchars($imovel['rua']); ?>
        <?php endif; ?>
        - Araraquara - SP
      </p>
      
      <div class="titulo-info">
        <h1><?php echo htmlspecialchars($imovel['titulo_casa']); ?></h1>
        
        <!-- Informações básicas do imóvel -->
        <div class="detalhes-imovel">
          <h3>Detalhes do Imóvel</h3>
          <ul>
            <li><strong>Finalidade:</strong> <?php echo ucfirst($imovel['finalidade']); ?></li>
            <li><strong>Tipo:</strong> <?php echo htmlspecialchars($imovel['tipo_de_imovel']); ?></li>
            <li><strong>Área:</strong> <?php echo number_format($imovel['area'], 2, ',', '.'); ?>m²</li>
            <li><strong>Cômodos:</strong> <?php echo intval($imovel['num_comodos']); ?></li>
            <li><strong>Bairro:</strong> <?php echo htmlspecialchars($imovel['bairro']); ?></li>
            <li><strong>Rua:</strong> <?php echo htmlspecialchars($imovel['rua']); ?></li>
            <li><strong>Valor:</strong> R$ <?php echo number_format($imovel['valor'], 2, ',', '.'); ?><?php echo ($tipo === 'alugar') ? '/mês' : ''; ?></li>
          </ul>
        </div>
      </div>
    </div>
    
    <!-- Formulário lateral -->
    <aside class="form-box">
      <div class="corretor">
        <h4><?php echo htmlspecialchars($corretor['nome']); ?></h4>
        <p>Creci: <?php echo htmlspecialchars($corretor['creci']); ?></p>
      </div>

      <form action="enviar-contato.php" method="POST">
        <input type="hidden" name="id_imovel" value="<?php echo $id_imovel; ?>">
        <input type="hidden" name="tipo_imovel" value="<?php echo $tipo; ?>">
        <input type="text" name="nome" placeholder="Insira seu nome" required>
        <input type="email" name="email" placeholder="Insira seu e-mail" required>
        <input type="tel" name="telefone" placeholder="Insira seu telefone" required>
        <textarea name="mensagem" rows="4">Olá, gostaria de ter mais informações sobre este imóvel: <?php echo htmlspecialchars($imovel['titulo_casa']); ?> para <?php echo $tipo; ?>.</textarea>
        <button type="submit" class="botao-enviar">
          <i class="fas fa-envelope"></i>
          Enviar Mensagem
        </button>
      </form>

      <a class="whatsapp-button" href="https://wa.me/<?php echo $corretor['telefone']; ?>?text=Olá, tenho interesse no imóvel: <?php echo urlencode($imovel['titulo_casa']); ?> para <?php echo $tipo; ?>" target="_blank">
        <i class="fab fa-whatsapp"></i> 
        Fale no WhatsApp
      </a>
    </aside>

  </div>

  <!-- Botão de voltar -->
  <div class="voltar-container">
    <a href="<?php echo ($tipo === 'comprar') ? 'comprar.php' : 'alugar.php'; ?>" class="botao-voltar">
      <i class="fas fa-arrow-left"></i>
      Voltar para resultados
    </a>
  </div>

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
    // Menu mobile
    document.getElementById('menu-toggle').addEventListener('click', function() {
      document.querySelector('.nav-links').classList.toggle('show');
    });

    // Inicializar Swiper
    const swiper = new Swiper('.swiper', {
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      }
    });
  </script>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f9fa;
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
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .logo {  
      height: 70px;
      width: auto;
      object-fit: contain;
    }
    
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
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
      margin: 30px auto;
      gap: 30px;
      padding: 20px;
    }

    .carousel-box {
      flex: 1 1 65%;
      min-width: 300px;
    }

    .swiper-slide img {
      width: 100%;
      height: 500px;
      object-fit: cover;
      border-radius: 12px;
    }

    .main-info {
      flex: 1 1 65%;
      background: white;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      padding: 30px;
      border-radius: 12px;
      margin-top: 20px;
    }

    .main-info h2 {
      color: #1d4ed8;
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .main-info > p {
      font-size: 18px;
      margin: 15px 0;
      color: #495057;
    }

    .local {
      color: #6c757d !important;
      font-size: 16px !important;
      margin-bottom: 25px !important;
    }

    .titulo-info h1 {
      color: #343a40;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .descricao-imovel {
      margin: 20px 0;
      padding: 20px;
      background: #f8f9fa;
      border-radius: 8px;
      border-left: 4px solid #1d4ed8;
    }

    .detalhes-imovel h3 {
      color: #343a40;
      margin-top: 30px;
      margin-bottom: 15px;
      font-size: 20px;
    }

    .detalhes-imovel ul {
      list-style: none;
      padding: 0;
    }

    .detalhes-imovel li {
      padding: 8px 0;
      border-bottom: 1px solid #e9ecef;
      color: #495057;
    }

    .caracteristicas-detalhadas {
      margin-top: 30px;
    }

    .caracteristicas-detalhadas h3 {
      color: #343a40;
      margin-bottom: 15px;
      font-size: 20px;
    }

    .lista-caracteristicas {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .tag-caracteristica {
      background: #e3f2fd;
      color: #1d4ed8;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 500;
    }

    .form-box {
      flex: 1 1 30%;
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      height: fit-content;
      position: sticky;
      top: 20px;
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

    input, textarea {
      width: 90%;
      padding: 12px;
      margin: 8px 0;
      border-radius: 6px;
      border: 1px solid #dee2e6;
      font-size: 14px;
      transition: border-color 0.3s;
    }

    input:focus, textarea:focus {
      outline: none;
      border-color: #1d4ed8;
    }

    textarea { 
      resize: vertical;
      height: 100px;
      font-family: inherit;
    }

    .botao-enviar {
      width: 95%;
      background: #28a745;
      color: white;
      border: none;
      padding: 12px;
      margin: 10px 0;
      border-radius: 6px;
      font-weight: 500;
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: background-color 0.3s;
    }

    .botao-enviar:hover {
      background: #218838;
    }

    .whatsapp-button {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      background-color: #25d366;
      color: white;
      padding: 12px;
      margin-top: 15px;
      text-decoration: none;
      font-weight: 500;
      border-radius: 6px;
      transition: background-color 0.3s;
      width: 90%;
    }

    .whatsapp-button:hover {
      background-color: #1ebe5d;
      text-decoration: none;
      color: white;
    }

    .voltar-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .botao-voltar {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #6c757d;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 500;
      transition: background-color 0.3s;
    }

    .botao-voltar:hover {
      background: #5a6268;
      text-decoration: none;
      color: white;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        padding: 15px;
        gap: 20px;
      }
      
      .carousel-box, .main-info, .form-box {
        flex: 1 1 100%;
      }
      
      .form-box {
        position: relative;
        top: auto;
      }
    }
  </style>

</body>
</html>

<?php
$conn->close();
?>