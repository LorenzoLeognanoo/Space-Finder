<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Space</title>
  <link rel="shortcut icon" href="imgs/logo-icon.ico" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="script.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
      <li><a href="sobre.php" >Sobre Nós</a></li>
      <li><a href="contato.php" class="active">Contato</a></li>
    </ul>

    <div class="menu-toggle" id="menu-toggle">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>
<section class="container">
    <div class="titulo">
      <h1>CONTATE - NOS</h1>
    </div>
    <p class="subtitulo">
      Tem alguma pergunta ou quer falar conosco? Preencha o formulário abaixo ou entre em contato pelos nossos canais de atendimento.
    </p>
<br><br>

    <div class="form-container">
      <form class="formulario">
        <label for="nome">Envie nos uma mensagem!</label>
        <input type="text" id="nome" placeholder="Nome" required>

        <input type="email" id="email" placeholder="E-mail" required>

        <textarea id="mensagem" placeholder="Mensagem" required></textarea>

        <button type="submit">Enviar</button>
      </form>

      <div class="contato">
        <h3>Entre em contato</h3>
        <p> <a img href="mailto:spacefinder@space.com.br"> spacefinder@space.com.br</a></p><br>
        <p class="telefone"> (16) 3333-0005</p><br>
        <p> <a href="https://maps.google.com/?q=Av.+Bandeirantes,+503,+Araraquara" target="_blank">
          Av. Bandeirantes, 503 - Centro, Araraquara - SP, 14801-180
        </a></p><br>
        <a href="https://api.whatsapp.com/send?phone=5516933005886&text=Ola%2C%20estou%20interessado%20em%20um%20im%C3%B3vel%20do%20site%20Space%20Finder!" target="_blank" class="whatsapp-button">
       <i class="fab fa-whatsapp"></i> WhatsApp
</a>
      </div>
    </div>
  </section><br><br>

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

@import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
  body {
  margin: 0;
  background-color: #ffffff;
  font-family: 'Inter', sans-serif;
  color: #333;
}

.container {
  max-width: 900px;
  margin: 0 auto;
  padding: 20px;
  text-align: center;
}

.titulo {
  max-width: 800px;
  margin: 10px auto;
  padding: 0 10px;
  text-align: center;
}

.titulo h1 {
  background-color: #1d3682; 
  color: white;              
  padding: 40px 100px;      
  border-radius: 12px;      
  font-weight: 800;         
  font-size: 50px;          
  margin-top: 40px;      
}

.subtitulo {
  font-size: 20px;
  margin-bottom: 30px;
  padding: 0 10px;
}

.form-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 60px;
}

.formulario {
  flex: 1;
  min-width: 300px;
  display: flex;
  flex-direction: column;
  text-align: left;
}

.formulario label {
  font-weight: bold;
  font-size: 20px;
  margin-bottom: 10px;
  color: #1f3e8a;
}

.formulario input,
.formulario textarea {
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: none;
  font-size: 14px;
}

.formulario textarea {
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: none;
  font-size: 14px;
   height: 130px;
}


.formulario button {
  background-color: #1f3e8a;
  color: white;
  padding: 15px 15px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: background-color 0.3s;
  font-size: 15px;
}

.formulario button:hover {
  background-color: #163173;
}

.contato {
  flex: 1;
  min-width: 250px;
  text-align: left;
}

.contato h3 {
  color: #1f3e8a;
  margin-bottom: 15px;
  font-size: 25px;
}

.contato a:hover {
  text-decoration: underline;
}
.telefone {
    color:  #1d3682     ;
}

.contato a {    
  text-decoration: none;
}


.whatsapp-button {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background-color: #25D366;
  color: white;
  padding: 15px 70px;
  border-radius: 10px;
  text-decoration: none;
  font-weight: bold;
  margin-top: 10px;
  transition: background-color 0.3s;
}

.whatsapp-button:hover {
  background-color: #1ebe5d;
  text-decoration: none;
}


        </style>