<?php
//conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "spacefinder");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
  
//recebe os parâmetros de busca e filtros
$busca = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';
$bairro = isset($_GET['bairro']) ? $conn->real_escape_string($_GET['bairro']) : '';
$tipo = isset($_GET['tipo_de_imovel']) ? $conn->real_escape_string($_GET['tipo']) : '';
$comodos = isset($_GET['num_comodos']) ? intval($_GET['num_comodos']) : '';
$faixa_preco = isset($_GET['faixa_preco']) ? $_GET['faixa_preco'] : '';

//monta a consulta SQL - APENAS IMÓVEIS PARA ALUGAR
$sql = "SELECT * FROM imoveis_alugar WHERE 1=1";

//aplica busca geral 
if ($busca) {
    $sql .= " AND (bairro LIKE '%$busca%' 
             OR rua LIKE '%$busca%' 
             OR tipo_de_imovel LIKE '%$busca%')";
}

//aplica filtros específicos
if ($bairro) {
    $sql .= " AND bairro LIKE '%$bairro%'";
}

if ($tipo) {
    $sql .= " AND tipo_de_imovel = '$tipo'";
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

//limita para 20 resultados
$sql .= " LIMIT 20";

$result = $conn->query($sql);

//busca dados para os filtros 
$bairros_result = $conn->query("SELECT DISTINCT bairro FROM imoveis_alugar WHERE bairro != '' ORDER BY bairro");
$tipos_result = $conn->query("SELECT DISTINCT tipo_de_imovel FROM imoveis_alugar WHERE tipo_de_imovel != '' ORDER BY tipo_de_imovel");
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

  <!--seção principal site -->
  <section class="card-principal">
    <div>
      <h1 class="titulo-principal">ALUGUE SEU IMÓVEL</h1>
      <p class="subtitulo-principal">Alugue imóveis de forma fácil, rápida e segura com a SpaceFinder.</p>

      <!--barra de pesquisa principal site-->
      <form class="search-box" method="GET" action="alugar.php">
        <input type="text" name="q" placeholder="Digite uma localização ou tipo de imóvel..." value="<?php echo htmlspecialchars($busca); ?>" />
        <button type="submit">Buscar</button>
      </form>
    </div>
  </section>

  <!--seção filtros-->
  <section class="secao-filtros">
    <div class="container">
      <div class="cartao-filtros">
        <form class="formulario-filtros" method="GET" action="alugar.php">

          <!--mantém a busca principal -->
          <input type="hidden" name="q" value="<?php echo htmlspecialchars($busca); ?>">
          <div class="grade-filtros">

            <!--filtro bairro-->
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

            <!--filtro tipo de imóvel-->
            <div class="grupo-filtro">
              <label for="tipo">
                <i class="fas fa-home"></i>
                Tipo
              </label>
              <select name="tipo" id="tipo">
                <option value="">Todos os tipos</option>
                <?php if ($tipos_result && $tipos_result->num_rows > 0): ?>
                  <?php while($row = $tipos_result->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['tipo_de_imovel']); ?>"
                            <?php echo ($tipo == $row['tipo_de_imovel']) ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($row['tipo_de_imovel']); ?>
                    </option>
                  <?php endwhile; ?>
                <?php endif; ?>
              </select>
            </div>

            <!--filtro cômodos-->
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

            <!--filtro faixa de preço-->
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

            <!--botões filtro-->
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

  <!--resultados busca-->
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
      
        <!--cards alugar-->
      <?php if ($result && $result->num_rows > 0): ?>
        <div class="grade-resultados">
          <?php while($row = $result->fetch_assoc()): ?>
            <div class="cartao-imovel" onclick="verDetalhes(<?php echo $row['id_casa']; ?>)">
              <div class="container-imagem-cartao">
                <img src="<?php echo !empty($row['foto']) ? htmlspecialchars($row['foto']) : 'imgs/placeholder.jpg'; ?>" 
                     alt="<?php echo htmlspecialchars($row['tipo_de_imovel']); ?>" class="imagem-cartao">
                <div class="etiqueta-cartao"><?php echo htmlspecialchars($row['tipo_de_imovel']); ?></div>
              </div>
              
              <div class="conteudo-cartao">
                <div class="preco-cartao">
                  R$ <?php echo number_format($row['valor'], 2, ',', '.'); ?><span class="periodo">/mês</span>
                </div>
                
                <h3 class="titulo-cartao">
                  <?php echo htmlspecialchars($row['titulo_casa']); ?>
                </h3>
                
                <div class="localizacao-cartao">
                  <i class="fas fa-map-marker-alt"></i>
                  <?php echo htmlspecialchars($row['bairro']); ?><?php if(!empty($row['rua'])): ?> - <?php echo htmlspecialchars($row['rua']); ?><?php endif; ?>
                </div>
                
                <div class="caracteristicas-cartao">
                  <div class="caracteristica">
                    <i class="fas fa-bed"></i>
                    <span><?php echo intval($row['num_comodos']); ?> cômodos</span>
                  </div>
                  <div class="caracteristica">
                    <i class="fas fa-ruler-combined"></i>
                    <span><?php echo number_format($row['area'], 0, ',', '.'); ?> m²</span>
                  </div>
                </div>
                
                <div class="rodape-cartao">
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
          <center> 
         <br><br><a href="alugar.php" class="botao-ver-imoveis">Ver todos os imóveis</a>
          </center>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!--footer-->
  <footer>
    <div class="footer-container">
      <div class="footer-social">
        <p>Conheça nossas<br>redes sociais</p>
        <div class="icons" style="display: flex; gap: 10px; margin-top: 10px;">
          <a href="https://instagram.com.br" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/instagram.svg" style="width: 24px; filter: invert(1);" alt="Instagram"></a>
          <a href="https://www.facebook.com/" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/facebook.svg" style="width: 24px; filter: invert(1);" alt="Facebook"></a> 
          <a href="https://x.com/home/" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/x.svg" style="width: 24px; filter: invert(1);" alt="X"></a>
          <a href="https://www.linkedin.com/feed/" target="_blank"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/linkedin.svg" style="width: 24px; filter: invert(1);" alt="LinkedIn"></a>
        </div>
      </div>
      <div class="footer-contact">
        <p><strong>Entre em contato<br>com a Space Finder</strong></p>
        <p>spacefinder@space.com.br</p>
        <p>(16) 3333-0005</p>
        <p>Av. Bandeirantes, 505 -<br>Centro, Araraquara - SP,<br>14801-120</p>
      </div>
    </div>
    <div class="footer-bottom">
      © Todos direitos reservados - SpaceFinder
    </div>
  </footer>

  <script>
    function verDetalhes(id) {
        window.location.href = `imovel-detalhes.php?id=${id}&tipo=alugar`;
    }
  </script>

  <style>
    .secao-filtros {
      padding: 25px 30px;
    }

    .cartao-filtros {
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
      padding: 12px 80px;
      border-radius: 10px;
      justify-content: center;
      text-decoration: none;
    }

    .secao-resultados {
      padding: 40px 30px;
    }

    .secao-resultados h2 {
      color: #1d4ed8;
      margin-bottom: 30px;
      font-size: 1.6rem;
    }

    .grade-resultados {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 30px;
      max-width: 1400px;
      margin: 0 auto;
    }

    .cartao-imovel {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      cursor: pointer;
      border: 1px solid #e9ecef;
    }

    .cartao-imovel:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .container-imagem-cartao {
      position: relative;
      height: 220px;
      overflow: hidden;
    }

    .imagem-cartao {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .etiqueta-cartao {
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

    .conteudo-cartao {
      padding: 25px 20px;
    }

    .preco-cartao {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1d4ed8;
      margin-bottom: 10px;
    }

    .preco-cartao .periodo {
      font-size: 0.75rem;
      color: #6c757d;
      font-weight: 400;
    }

    .titulo-cartao {
      font-size: 1.1rem;
      font-weight: 600;
      color: #343a40;
      margin-bottom: 12px;
      line-height: 1.3;
    }

    .localizacao-cartao {
      display: flex;
      align-items: center;
      gap: 6px;
      color: #6c757d;
      margin-bottom: 15px;
      font-size: 14px;
    }

    .localizacao-cartao i {
      color: #1d4ed8;
    }

    .caracteristicas-cartao {
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

    .sem-resultados {
      text-align: center;
      padding: 60px 30px;
      color: #6c757d;
    }
  </style>

</body>
</html>

<?php
$conn->close();
?>