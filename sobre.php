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
      <li><a href="alugar.php">Alugar</a></li>
      <li><a href="comprar.php">Comprar</a></li>
      <li><a href="sobre.php" class="active">Sobre Nós</a></li>
      <li><a href="contato.php">Contato</a></li>
    </ul>

    <div class="menu-toggle" id="menu-toggle">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>

</body>

<div class="container" >
  <h1 class="titulo">QUEM SOMOS</h1>
    <p class="subtitulo">A Space Finder nasceu com o propósito de transformar a busca pelo imóvel ideal em uma experiência simples, segura e inovadora.
      Somos uma imobiliária moderna, que une tecnologia, atendimento personalizado e transparência para conectar pessoas aos melhores imóveis do mercado.
      Com uma plataforma intuitiva e uma equipe dedicada, buscamos facilitar a jornada de quem sonha em encontrar o espaço perfeito para viver, trabalhar ou investir.
      Mais do que vender imóveis, nosso compromisso é construir histórias, realizar sonhos e tornar cada conquista inesquecível.</p>
            <h2 class="sub-texto">
          Facilitar o acesso a imóveis residenciais e comerciais de forma rápida e descomplicada!
        </h2>
          <p class="sub-legenda">
          Nosso compromisso vai além da intermediação de imóveis.<br>
          Trabalhamos todos os dias para proporcionar:
        </p><br><br>

        <ul class="lista">
          <li>
            <strong style="color: #1d3682;">Atendimento de excelência</strong>, com profissionalismo e atenção, estamos ao lado de nossos clientes em todas as etapas.
          </li>
          <li>
            <strong style="color: #1d3682;">Processos claros e seguros</strong>, priorizando a transparência e agilidade em cada negociação.
          </li>
          <li>
            <strong style="color: #1d3682;">Soluções inovadoras</strong>, unimos experiência e tecnologia para oferecer uma plataforma intuitiva e completa.
          </li>
        </ul>
      
        <p class="assinatura">
          <strong>SPACE FINDER – Encontre seu espaço. Viva sua conquista!</strong>
        </p>
      </div>
</div>


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
</html>

<style>
.container {
  max-width: 800px;
  margin: 10px auto;
  padding: 0 10px;
  text-align: center;
}

.titulo{
  background-color: #1d3682; 
  color: white;              
  padding: 40px 100px;      
  border-radius: 12px;      
  font-weight: 800;         
  font-size: 50px;          
  margin-top: 40px;         
}

.subtitulo{
  margin-top: 30px;
  font-size: 20px;
  margin-bottom: 60px;
}

.sub-texto {
  color: #1d3682;
  font-size: 24 px;
  font-weight: bold;
  margin-top: 30px;
  margin-bottom: 20px;
}

.sub-legenda {
  font-size: 18px;
  margin-bottom: 15px;

}

.lista {
    font-size: 18px;
    list-style: none;
    margin-bottom: 80px;
    text-align: left;
  max-width: 700px;
}

.lista li {
    margin-bottom: 20px;
  line-height: 1.5;
}

.assinatura {
  font-size: 20px;
  font-weight: bold;
  color: #1d3682;
  margin-bottom: 130px;
}

</style>