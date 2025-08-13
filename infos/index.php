<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Imóvel em Alphaville</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
  <body>
    <nav class="navbar">
       <div class="logo-container">
         <a href="../index.php"><img src="../imgs/logosf.png" alt="Logo" class="logo" /></a>
       </div>
   
       <ul class="nav-links">
         <li><a href="../index.php">Início</a></li>
         <li><a href="../alugar.php">Alugar</a></li>
         <li><a href="../comprar.php">Comprar</a></li>
         <li><a href="../sobre.php">Sobre Nós</a></li>
         <li><a href="../contato.php">Contato</a></li>
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
          <div class="swiper-slide"><img src="imgs/casa 1/fachada.jpg" alt="Foto 1"></div>
          <div class="swiper-slide"><img src="imgs/casa 1/entrada.jpg" alt="Foto 2"></div>
          <div class="swiper-slide"><img src="imgs/casa 1/banheiro.jpg" alt="Foto 3"></div>
          <div class="swiper-slide"><img src="imgs/casa 1/cozinha.jpg" alt="Foto 4"></div>
          <div class="swiper-slide"><img src="imgs/casa 1/sala.jpg" alt="Foto 5"></div>
          <div class="swiper-slide"><img src="imgs/casa 1/piscina.jpg" alt="Foto 6"></div>
          <div class="swiper-slide"><img src="imgs/casa 1/area.jpg" alt="Foto 7"></div>
        </div>
        <div class="swiper-button-prev"></div>  
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <!-- Informações principais -->
    <div class="main-info">
      <h2>R$ 1.590.000</h2>
      <p>336m² • 4 quartos • 4 banheiros • 3 suítes • Piscina • Garagem </p>
      <p class="local">Portal das Tipunas, quadra 8 lote 7 Araraquara - SP</p>
      <div class="titulo-info">
        <h1>Venda Imóvel Alto Padrão Araraquara</h1>
        <ul>
          <li>3 suítes</li>
          <li>Área do lote: 336m²</li>
          <li>Área construída: 186m² + 9m² de piscina</li>
          <li>Ambientes integrados: Sala, copa e cozinha</li>
          <li>Lavanderia</li>
          <li>Lavabos: Interno e externo</li>
          <li>Garagem para 2 carros</li>
          <li>Piscina com aquecimento</li>
          <li>Bancadas: Quartzo cinza e Granito São Gabriel</li>
          <li>Pisos: Portinari e Vilagres</li>
          <li>Esquadrias: Pretas, automatizadas, com persianas blackout nos dormitórios</li>
          <li>Porta de entrada: Alumínio na cor aço corten</li>
          <li>Eletrodomésticos inclusos: Forno, micro-ondas e cooktop</li>
          <li>Móveis planejados em todos os ambientes</li>
          <li>Ar condicionado Midea em todos os ambientes</li>
          <li>Banheiros entregues com box e espelhos</li>
          <li>Jardinagem e iluminação completas</li>
          <li>Calçamento externo em Fulget</li>
        </ul>
      </div>
    </div>
    

    <!-- Formulário lateral -->
    <aside class="form-box">
      <div class="corretor">
        <h4>Ricardo Sena Magnavita</h4>
        <p>Creci: 09334-F-BA</p>

      </div>

      <form>
        <input type="text" placeholder="Insira seu nome" required>
        <input type="email" placeholder="Insira seu e-mail" required>
        <input type="tel" placeholder="Insira seu telefone" required>
        <textarea rows="4">Olá, gostaria de ter mais informações para comprar essa casa.</textarea>
      </form>

      <a class="whatsapp-button" href="https://wa.me/5571999999999" target="_blank"><i class="fab fa-whatsapp"></i> Fale no Whatssap</a>
   
    </a>

    </aside>

  </div>

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
