<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Imóvel em Alphaville</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<body>
  <nav class="navbar">
    <div class="logo-container">
      <a href="../index.php"><img src="../imgs/logosf.png" alt="Logo" class="logo" /></a>
    </div>

    <ul class="nav-links">
      <li><a href="../index.php">Início</a></li>
      <li><a href="../alugar.php" class="active">Alugar</a></li>
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
  }
});

  </script>
</body>
</html>
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
}

@media (max-width: 885px) {
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
  color: #1f1f1f;
  font-size: 28px;
}

.main-info p {
  font-size: 20px;
  margin: 10px 0;
}

.local {
  color: #666;
  font-size: 15px;
}

/* Formulário lateral */
.form-box {
  flex: 1 1 30%;
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 8px rgba(0,0,0,0.1);
}

.corretor h4 {
  margin: 0 0 5px;
}

input, textarea {
  width: 90%;
  padding: 10px;
  margin: 10px 0;
  border-radius: 5px;
  border: 1px solid #ccc;
}

textarea { 
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: none;
  font-size: 14px;
   height: 130px;
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

.titulo-info {
  margin-top: 10%;
}
</style>