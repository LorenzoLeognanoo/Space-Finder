<?php
// conexao com o banco de dados
$conn = new mysqli("localhost", "root", "", "spacefinder");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$busca = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

if ($busca) {
    // busca combinada em ambas as tabelas alugar e comprar
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
    
    // executa as duas consultas
    $result_alugar = $conn->query($sql_alugar);
    $result_comprar = $conn->query($sql_comprar);
    
    // combina os resultados
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
    // imóveis em destaque alugar e comprar
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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <nav class="navbar">
    <div class="logo-container">
      <a href="index.php"><img src="imgs/logosf.png" alt="Logo" class="logo" /></a>
    </div>

    <ul class="nav-links">
      <li><a href="index.php" class="nav-link active">Início</a></li>
      <li><a href="alugar.php" class="nav-link">Alugar</a></li>
      <li><a href="comprar.php" class="nav-link">Comprar</a></li>
      <li><a href="sobre.php" class="nav-link">Sobre</a></li>
      <li><a href="contato.php" class="nav-link">Contato</a></li>
    </ul>

    <div class="menu-toggle" id="menu-toggle">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>

  <section class="hero-section">
    <div class="hero-container">
      <h1 class="hero-titulo">Encontre seu espaço ideal</h1>
      <p class="hero-subtitulo">Alugue ou compre imóveis de forma fácil, rápida e segura com a  <strong class="space-negrito"> SPACE FINDER </strong>.</p>

      <form class="search-container" method="GET" action="index.php">
        <div class="search-box">
          <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <path d="21 21l-4.35-4.35"/>
          </svg>
          <input type="text" name="q" placeholder="Digite uma localização ou tipo de imóvel..." class="search-input" value="<?php echo htmlspecialchars($busca); ?>" />
          <button type="submit" class="search-btn">Buscar</button>
        </div>
      </form>

      <!-- links rápidos -->
      <div class="links-rapidos">
        <a href="alugar.php" class="link-rapido">Imóveis para Alugar</a>
        <a href="comprar.php" class="link-rapido">Imóveis para Comprar</a>
      </div>
    </div>
    <div class="hero-fundo"></div>
  </section>

  <section class="properties-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-titulo">
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
          <p class="section-subtitulo">Descubra as melhores opções para você</p>
        <?php endif; ?>
      </div>

      <div class="properties-grid">
        <?php if (!empty($imoveis_encontrados)): ?>
          <?php foreach ($imoveis_encontrados as $row): ?>
            <div class="property-card" onclick="verDetalhes(<?php echo $row['id_casa']; ?>, '<?php echo $row['tipo_transacao']; ?>')">
              <div class="property-image">
                <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Imagem do imóvel" class="property-img" />
                <div class="property-etiqueta <?php echo ($row['tipo_transacao'] == 'alugar') ? 'etiqueta-alugar' : 'etiqueta-comprar'; ?>">
                  <?php echo ($row['tipo_transacao'] == 'alugar') ? 'Alugar' : 'Comprar'; ?>
                </div>
              </div>
              <div class="property-info">
                <h3 class="property-titulo"><?php echo htmlspecialchars($row['titulo_casa']); ?></h3>
                <div class="property-localização">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10 c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                  </svg>
                  <?php echo htmlspecialchars($row['bairro']); ?><?php if(!empty($row['rua'])): ?> - <?php echo htmlspecialchars($row['rua']); ?><?php endif; ?>
                </div>
                <div class="property-detalhes">
                  <span class="itens-detalhes">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                      <polyline points="9,22 9,12 15,12 15,22"/>
                    </svg>
                    <?php echo (int)$row['num_comodos']; ?> cômodos
                  </span>
                  <span class="itens-detalhes">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                      <line x1="9" y1="9" x2="15" y2="15"/>
                      <line x1="15" y1="9" x2="9" y2="15"/>
                    </svg>
                    <?php echo number_format($row['area'], 0, ',', '.'); ?> m²
                  </span>
                  <span class="itens-detalhes">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    </svg>
                    <?php echo htmlspecialchars($row['tipo_de_imovel']); ?>
                  </span>
                </div>
                <div class="property-preço">
                  R$ <?php echo number_format($row['valor'], 2, ',', '.'); ?>
                  <?php echo ($row['tipo_transacao'] == 'alugar') ? '<span class="period">/mês</span>' : ''; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="sem-resultado">
            <div class="sem-resultado-content">
              <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="sem-resultado-icon">
                <circle cx="11" cy="11" r="8"/>
                <path d="M21 21l-4.35-4.35"/>
              </svg>
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
    </div>
  </section>

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

  <script src="script.js"></script>
  <script>
    // função para redirecionar para detalhes do imóvel
    function verDetalhes(id, tipo) {
        window.location.href = `imovel-detalhes.php?id=${id}&tipo=${tipo}`;
    }
  </script>

  <style>

      .space-negrito {
      color: #1e40af ;
    }

      /* hero section */
      .hero-section {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      padding: 8rem 2rem 4rem;
      position: relative;
      overflow: hidden;
    }

    .hero-fundo {
      position: absolute;
      top: -50%;
      right: -20%;
      width: 80%;
      height: 200%;
      background: linear-gradient(45deg,rgb(0, 68, 255) 0%, #8b5cf6 100%);
      opacity: 0.05;
      border-radius: 50%;
      transform: rotate(-15deg);
    }

    .hero-container {
      max-width: 800px;
      margin: 0 auto;
      text-align: center;
      position: relative;
      z-index: 2;
    }

    .hero-titulo {
      font-size: 3.5rem;
      font-weight: 700;
      color: #1e40af;
      margin-bottom: 1.5rem;
      line-height: 1.2;
    }

    .hero-subtitulo {
      font-size: 1.25rem;
      color: #64748b;
      margin-bottom: 3rem;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    .search-container {
      max-width: 600px;
      margin: 0 auto;
    }

    .search-box {
      display: flex;
      align-items: center;
      background: white;
      border-radius: 16px;
      padding: 0.5rem;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      border: 1px solid #e2e8f0;
    }

    .search-icon {
      color: #64748b;
      margin-left: 1rem;
      flex-shrink: 0;
    }

    .search-input {
      flex: 1;
      border: none;
      outline: none;
      padding: 1rem;
      font-size: 1rem;
      color: #1e293b;
    }

    .search-input::placeholder {
      color: #94a3b8;
    }

    .search-btn {
      background: #3b82f6;
      color: white;
      border: none;
      padding: 1rem 2rem;
      border-radius: 12px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .search-btn:hover {
      background: #2563eb;
      transform: translateY(-1px);
    }


    /* links rapidos */
    .links-rapidos {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 2rem;
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
      background: #1e40af;
      text-decoration: none;
      color: white;
      transform: translateY(-2px);
    }

    /* properties section */
    .properties-section {
      padding: 5rem 2rem;
      background: #f8fafc;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
    }

    .section-header {
      text-align: center;
      margin-bottom: 3rem;
    }

    .section-titulo {
      font-size: 2.5rem;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 1rem;
    }

    .section-subtitulo {
      font-size: 1.125rem;
      color: #64748b;
    }

    .properties-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 2rem;
    }

    .property-card {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #f1f5f9;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .property-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .property-image {
      position: relative;
      height: 220px;
      overflow: hidden;
    }

    .property-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .property-card:hover .property-img {
      transform: scale(1.05);
    }

    .property-etiqueta {
      position: absolute;
      top: 1rem;
      left: 1rem;
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.875rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .etiqueta-alugar {
      background: #10b981;
      color: white;
    }

    .etiqueta-comprar {
      background: #f59e0b;
      color: white;
    }

    .property-info {
      padding: 1.5rem;
    }

    .property-titulo {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1e293b;
      margin-bottom: 0.75rem;
      line-height: 1.3;
    }

    .property-localização {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: #64748b;
      font-size: 0.9rem;
      margin-bottom: 1rem;
    }

    .property-detalhes {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .itens-detalhes {
      display: flex;
      align-items: center;
      gap: 0.25rem;
      color: #64748b;
      font-size: 0.85rem;
    }

    .property-preço {
      font-size: 1.5rem;
      font-weight: 700;
      color: #3b82f6;
    }

    .property-preço .period {
      font-size: 0.9rem;
      color: #64748b;
      font-weight: 400;
    }

    /* sem resultado */
    .sem-resultado {
      grid-column: 1 / -1;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 300px;
    }

    .sem-resultado-content {
      text-align: center;
      max-width: 400px;
      padding: 2rem;
    }

    .sem-resultado-icon {
      color: #94a3b8;
      margin-bottom: 1rem;
    }

    .sem-resultado-content h3 {
      color: #1e293b;
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }

    .sem-resultado-content p {
      color: #64748b;
      margin-bottom: 2rem;
    }

    .sem-resultado-actions {
      display: flex;
      gap: 1rem;
      justify-content: center;
    }

    .btn-secundario {
      background: #64748b;
      color: white;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-secundario:hover {
      background: #475569;
      text-decoration: none;
      color: white;
      transform: translateY(-1px);
    }

    /* footer */
    .footer {
      background:rgb(14, 50, 148);
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
      background: #1e40af;
      color: #94a3b8;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .social-link:hover {
      background: #3b82f6;
      color: white;
      transform: translateY(-2px);
    }

    .contact-item {
      margin-bottom: 0.5rem;
    }

    .footer-bottom {
      padding-top: 2rem;
      border-top: 1px solid #334155;
      text-align: center;
      color:rgba(231, 231, 231, 0.59);
    }

    /* responsividade mobile */
    @media (max-width: 768px) {
      .hero-titulo {
        font-size: 2.5rem;
      }

      .hero-subtitulo {
        font-size: 1.125rem;
      }

      .search-box {
        flex-direction: column;
        gap: 1rem;
        padding: 1rem;
      }

      .search-input {
        padding: 0.75rem;
      }

      .links-rapidos {
        flex-direction: column;
        align-items: center;
        gap: 10px;
      }

      .section-titulo {
        font-size: 2rem;
      }

      .properties-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }

      .property-detalhes {
        flex-direction: column;
        gap: 0.5rem;
      }

      .footer-content { 
        grid-template-columns: 1fr;
        gap: 2