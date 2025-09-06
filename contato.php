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
        <a href="https://api.whatsapp.com/send?phone=5516933005886&text=Ola%2C%20eu%20quero%20falar%20com%20o%20suporte%20da%20Space%20Finder!%20%E2%98%9D%EF%B8%8F%F0%9F%98%8E" target="_blank" class="whatsapp-button">
       <i class="fab fa-whatsapp"></i> WhatsApp
</a>
      </div>
    </div>
  </section><br><br>

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

    /* footer */
    .footer {
      background:#001f72ff;
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
      background: #001f72ff;
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
        </style>