<?php
// conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "spacefinder");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
  
// recebe os parâmetros de busca e filtros
$busca = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';
$bairro = isset($_GET['bairro']) ? $conn->real_escape_string($_GET['bairro']) : '';
$tipo = isset($_GET['tipo']) ? $conn->real_escape_string($_GET['tipo']) : '';
$comodos = isset($_GET['num_comodos']) ? intval($_GET['num_comodos']) : '';
$faixa_preco = isset($_GET['faixa_preco']) ? $_GET['faixa_preco'] : '';


// monta a busca SQL 
$sql = "SELECT * FROM imoveis_alugar WHERE 1=1";

// aplica busca geral 
if ($busca) {
    $sql .= " AND (bairro LIKE '%$busca%' 
             OR rua LIKE '%$busca%' 
             OR tipo LIKE '%$busca%'
             OR codigo LIKE '%$busca%')";
}

// aplica filtros específicos
if ($bairro) {
    $sql .= " AND bairro LIKE '%$bairro%'";
}

if ($tipo) {
    $sql .= " AND tipo = '$tipo'";
}

if ($comodos) {
    $sql .= " AND num_comodos = $comodos";
}

if ($faixa_preco) {
    $faixa_parts = explode('-', $faixa_preco);
    if (count($faixa_parts) == 2) {
        $min = intval($faixa_parts[0]);
        $max = intval($faixa_parts[1]);
        $sql .= " AND valor BETWEEN $min AND $max";
    }
}

// limita para 15 resultados
$sql .= " LIMIT 15";

$result = $conn->query($sql);

// busca dados para os filtros 
$bairros_result = $conn->query("SELECT DISTINCT bairro FROM imoveis_alugar WHERE bairro != '' ORDER BY bairro");
$tipos_result = $conn->query("SELECT DISTINCT tipo FROM imoveis_alugar WHERE tipo != '' ORDER BY tipo");
$comodos_result = $conn->query("SELECT DISTINCT num_comodos FROM imoveis_alugar WHERE num_comodos > 0 ORDER BY num_comodos");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Space Finder - Aluguel</title>
  <link rel="shortcut icon" href="imgs/logo-icon.ico" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
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

  <!-- seção principal site -->
  <section class="card-principal">
    <div>
      <h1 class="titulo-principal">ALUGUE SEU IMÓVEL</h1>
      <p class="subtitulo-principal">Alugue imóveis de forma fácil, rápida e segura com a SpaceFinder.</p>

      <!-- barra de pesquisa principal site -->
      <form class="search-box" method="GET" action="alugar.php">
        <input type="text" name="q" placeholder="Digite uma localização ou tipo de imóvel..." value="<?php echo htmlspecialchars($busca); ?>" />
        <button type="submit">Buscar</button>
      </form>
    </div>
  </section>

  <!-- seção filtros -->
  <section class="secao-filtros">
    <div class="container">
      <div class="cards-filtros">
        <form class="formulario-filtros" method="GET" action="alugar.php">

          <!-- mantém a busca principal -->
          <input type="hidden" name="q" value="<?php echo htmlspecialchars($busca); ?>">
          <div class="grade-filtros">

            <!-- filtro bairro -->
            <div class="grupo-filtro">
              <label for="bairro">
                <i class="fas fa-map-marker-alt"></i>
                Bairro
              </label>
              <select name="bairro" id="bairro">
                <option value="">Todos os bairros</option>
                <?php if ($bairros_result && $bairros_result->num_rows > 0): ?>
                  <?php while($row = $bairros_result->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['bairro']); ?>" 
                            <?php echo ($bairro == $row['bairro']) ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($row['bairro']); ?>
                    </option>
                  <?php endwhile; ?>
                <?php endif; ?>
              </select>
            </div>

            <!-- filtro tipo de imóvel -->
            <div class="grupo-filtro">
              <label for="tipo">
                <i class="fas fa-home"></i>
                Tipo
              </label>
              <select name="tipo" id="tipo">
                <option value="">Todos os tipos</option>
                <?php if ($tipos_result && $tipos_result->num_rows > 0): ?>
                  <?php while($row = $tipos_result->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['tipo']); ?>"
                            <?php echo ($tipo == $row['tipo']) ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($row['tipo']); ?>
                    </option>
                  <?php endwhile; ?>
                <?php endif; ?>
              </select>
            </div>

            <!-- filtro cômodos -->
            <div class="grupo-filtro">
              <label for="num_comodos">
                <i class="fas fa-bed"></i>
                Cômodos
              </label>
              <select name="num_comodos" id="num_comodos">
                <option value="">Qualquer</option>
                <?php if ($comodos_result && $comodos_result->num_rows > 0): ?>
                  <?php while($row = $comodos_result->fetch_assoc()): ?>
                    <option value="<?php echo $row['num_comodos']; ?>"
                            <?php echo ($comodos == $row['num_comodos']) ? 'selected' : ''; ?>>
                      <?php echo $row['num_comodos']; ?> cômodo<?php echo ($row['num_comodos'] > 1) ? 's' : ''; ?>
                    </option>
                  <?php endwhile; ?>
                <?php endif; ?>
              </select>
            </div>

            <!-- filtro faixa de preço -->
            <div class="grupo-filtro">
              <label for="faixa_preco">
                <i class="fas fa-dollar-sign"></i>
                Preço
              </label>
              <select name="faixa_preco" id="faixa_preco">
                <option value="">Qualquer valor</option>
                <option value="0-1000" <?php echo ($faixa_preco == '0-1000') ? 'selected' : ''; ?>>Até R$ 1.000</option>
                <option value="1000-2000" <?php echo ($faixa_preco == '1000-2000') ? 'selected' : ''; ?>>R$ 1.000 - R$ 2.000</option>
                <option value="2000-3000" <?php echo ($faixa_preco == '2000-3000') ? 'selected' : ''; ?>>R$ 2.000 - R$ 3.000</option>
                <option value="3000-5000" <?php echo ($faixa_preco == '3000-5000') ? 'selected' : ''; ?>>R$ 3.000 - R$ 5.000</option>
                <option value="5000-10000" <?php echo ($faixa_preco == '5000-10000') ? 'selected' : ''; ?>>R$ 5.000 - R$ 10.000</option>
                <option value="10000-999999" <?php echo ($faixa_preco == '10000-999999') ? 'selected' : ''; ?>>Acima de R$ 10.000</option>
              </select>
            </div>

            <!-- botões filtro -->
            <div class="acoes-filtros">
              <button type="submit" class="botao-filtrar">
                <i class="fas fa-search"></i>
                Filtrar
              </button>
              <a href="alugar.php" class="botao-limpar">
                <i class="fas fa-times"></i>
                Limpar
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- resultados busca -->
  <section class="secao-resultados">
    <div class="container">
      <h2>
        <?php 
        if ($result) {
          $total_results = $result->num_rows;
          echo $busca ? "Resultados para \"$busca\"" : "Imóveis disponíveis";
          echo " ($total_results encontrados)";
        }
        ?>
      </h2>
      
        <!-- cards alugar -->
      <?php if ($result && $result->num_rows > 0): ?>
        <div class="grade-resultados">
          <?php while($row = $result->fetch_assoc()): ?>
            <div class="cards-imovel" onclick="verDetalhes(<?php echo $row['id_casa']; ?>)">
              <div class="container-imagem-cards">
                <img src="<?php echo !empty($row['foto']) ? htmlspecialchars($row['foto']) : 'imgs/placeholder.jpg'; ?>" 
                     alt="<?php echo htmlspecialchars($row['tipo']); ?>" class="imagem-cards">
                <div class="etiqueta-cards"><?php echo htmlspecialchars($row['tipo']); ?></div>
              </div>
              
              <div class="conteudo-cards">
                <div class="preco-cards">
                  R$ <?php echo number_format($row['valor'], 2, ',', '.'); ?><span class="periodo">/mês</span>
                </div>
                
                <h3 class="titulo-cards">
                  <?php echo htmlspecialchars($row['titulo_casa']); ?>
                </h3>

                <div class="localizacao-cards">
                  <i class="fas fa-map-marker-alt"></i>
                  <?php echo htmlspecialchars($row['bairro']); ?><?php if(!empty($row['rua'])): ?> - <?php echo htmlspecialchars($row['rua']); ?><?php endif; ?>
                </div>
                
                <div class="caracteristicas-cards">
                <div class="caracteristica">
                <i class="fas fa-th-large"></i> 
                <span><?php echo intval($row['num_comodos']); ?> cômodos</span>
                </div>

                <div class="caracteristica">
                <i class="fas fa-bed"></i> 
                <span><?php echo intval($row['quarto']); ?> Quarto<?php echo intval($row['quarto']) > 1 ? 's' : ''; ?></span>
                </div>

                <div class="caracteristica">
                <i class="fas fa-bath"></i> 
                <span><?php echo intval($row['banheiro']); ?> Banheiro<?php echo intval($row['banheiro']) > 1 ? 's' : ''; ?></span>
               </div>

                <div class="caracteristica">
                <i class="fas fa-ruler-combined"></i>
                <span><?php echo number_format($row['area'], 0, ',', '.'); ?> m²</span>
                </div>
                </div>


                <div class="rodape-cards">
                  <button class="botao-detalhes">
                    <span>Ver Detalhes</span>
                    <i class="fas fa-arrow-right"></i>
                  </button>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>

        <div class="sem-resultados">
          <p>Nenhum imóvel encontrado com os filtros selecionados.</p>

         <a href="alugar.php" class="botao-ver-imoveis">Ver todos os imóveis</a>

        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- footer -->
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-content">
        <div class="seção-footer">
          <h3 class="titulo-footer">Space Finder</h3>
          <p class="texto-footer">Conectando você ao seu próximo lar</p>
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
        
        <div class="seção-footer">
          <h4 class="subtitulo-footer">Contato</h4>
          <p class="info-contato">spacefinder@space.com.br</p>
          <p class="info-contato">(16) 3333-0005</p>
          <p class="info-contato">Av. Bandeirantes, 503<br>Centro, Araraquara - SP<br>14801-120</p>
        </div>
      </div>
      
      <div class="botao-footer">
        <p>© 2025 Space Finder. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>
  </body>
  </html>

  <script>
    function verDetalhes(id) {
        window.location.href = `imovel-detalhes.php?id=${id}&tipo=alugar`;
    }
  </script>

  <style>
  /* topo page */
 .card-principal {
  justify-content: center;
  align-items: center;
  display: flex;
  margin-top: 40px;
  }

 .titulo-principal {
  justify-content: center;
  display: flex;
  font-weight: 900;
  font-size: 60px;
  color: #153eb5;
  margin-top: 30px;
  }

 .subtitulo-principal {
  justify-content: center;
  display: flex;
  margin-top: 15px;
 }

  /* caixa de pesquisa*/ 
  .search-box {
    display: flex;
    gap: 10px;
    margin-top: 30px;
  }

  .search-box input {
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    flex: 1;
    font-size: 1rem;
 }

   .search-box button {
    padding: 15px 25px;
    background-color: #1d4ed8;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
  }

  .search-box button:hover {
    background-color: #153eb5;
   }


  /* seção filtros */
    .secao-filtros {
      padding: 25px 30px;
    }

    .cards-filtros {
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
      border: 1px solid #e9ecef;
      max-width: 1200px;
      margin: 0 auto;
    }

    .grade-filtros {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr 1fr auto auto;
      gap: 15px;
      align-items: end;
    }

    .grupo-filtro {
      display: flex;
      flex-direction: column;
    }

    .grupo-filtro label {
      display: flex;
      align-items: center;
      gap: 6px;
      font-weight: 500;
      color: #495057;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .grupo-filtro label i {
      color: #1d4ed8;
    }

    .grupo-filtro select {
      padding: 10px 12px;
      border: 1px solid #dee2e6;
      border-radius: 6px;
      background: white;
      font-size: 14px;
      color: #495057;
      transition: border-color 0.2s;
      min-width: 140px;
    }

    .grupo-filtro select:focus {
      outline: none;
      border-color: #1d4ed8;
    }

    .acoes-filtros {
      display: flex;
      gap: 10px;
    }

    .botao-filtrar, .botao-limpar {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 10px 16px;
      border-radius: 6px;
      font-weight: 500;
      text-decoration: none;
      font-size: 14px;
      border: none;
      cursor: pointer;
    }

    .botao-filtrar {
      background: #1d4ed8;
      color: white;
    }

    .botao-filtrar:hover {
      background: #1e40af;
    }

    .botao-limpar {
      background: #6c757d;
      color: white;
    }

    .botao-limpar:hover {
      background: #5a6268;
      text-decoration: none;
    }

   .botao-ver-imoveis{
      background: #1e40af;
      color: white;
      width: 30%;
      padding: 12px;
      border-radius: 10px;
      text-decoration: none;
      margin-top: 15px;
      display: inline-block; 
    }


  /* resultado busca */
    .secao-resultados {
      padding: 40px 30px;
    }

    .secao-resultados h2 {
      color: #1d4ed8;
      margin-bottom: 30px;
      font-size: 1.6rem;
      display: flex;
      justify-content:center;
    }

    .grade-resultados {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 30px;
      max-width: 1400px;
      margin: 0 auto;
    }


  /* cards */
    .cards-imovel {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      cursor: pointer;
      border: 1px solid #e9ecef;
    }

    .cards-imovel:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .container-imagem-cards {
      position: relative;
      height: 220px;
      overflow: hidden;
    }

    .imagem-cards {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .etiqueta-cards {
      position: absolute;
      top: 12px;
      left: 12px;
      background: #1d4ed8;
      color: white;
      padding: 6px 12px;
      border-radius: 12px;
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .conteudo-cards {
      padding: 25px 20px;
    }

    .preco-cards {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1d4ed8;
      margin-bottom: 10px;
      font-weight: 800;
    }

    .preco-cards .periodo {
      font-size: 0.75rem;
      color: #6c757d;
      font-weight: 400;
    }

    .titulo-cards {
      font-size: 1.1rem;
      font-weight: 600;
      color: #343a40;
      margin-bottom: 12px;
      line-height: 1.3;
    }

    .localizacao-cards {
      display: flex;
      align-items: center;
      gap: 6px;
      color: #6c757d;
      margin-bottom: 15px;
      font-size: 14px;
    }

    .localizacao-cards i {
      color: #1d4ed8;
    }

    .caracteristicas-cards {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
      padding-top: 15px;
      border-top: 1px solid #f1f3f4;
    }


    .caracteristica {
      display: flex;
      align-items: center;
      gap: 6px;
      color: #6c757d;
      font-size: 13px;
    }

    .caracteristica i {
      color: #1d4ed8;
    }

    .botao-detalhes {
      width: 100%;
      background: #1d4ed8;
      color: white;
      border: none;
      padding: 12px 18px;
      border-radius: 6px;
      font-weight: 500;
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .botao-detalhes:hover {
      background: #1e40af;
    }
    
  /* busca sem resultados */
    .sem-resultados {
      text-align: center;
      padding: 60px 30px;
      color: #6c757d;
    }
  </style>


<?php
$conn->close();
?>