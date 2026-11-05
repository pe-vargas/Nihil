<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$qtd_carrinho = array_sum(array_column($_SESSION['carrinho'], 'qtd'));
$pagina_atual = basename($_SERVER['PHP_SELF']);

$resultado_titulo = "";
$resultado_texto = "";
$produtos_recomendados = [];

// Processamento lógico simplificado (Sem BD, apenas comparando as alternativas)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['q1'], $_POST['q2'], $_POST['q3'])) {
    $respostas = [$_POST['q1'], $_POST['q2'], $_POST['q3']];
    $contagem = array_count_values($respostas);

    $vencedor = 'A';
    $max = 0;
    foreach ($contagem as $chave => $valor) {
        if ($valor > $max) {
            $max = $valor;
            $vencedor = $chave;
        }
    }

    if ($vencedor == 'A') {
        $resultado_titulo = "Cyber-Goth / Dark Industrial";
        $resultado_texto = "Sua preferência está em peças utilitárias pesadas, calçados robustos e estruturas com forte apelo industrial tático.";
        // Apenas produtos reais existentes do seu index e masculino
        $produtos_recomendados = [
            ['nome' => 'Platform Boots "Infernum" Cyber-Goth', 'preco' => 1150.00, 'estilo' => 'Cyber-Goth / Dark Industrial', 'img' => 's1.jpg'],
            ['nome' => 'Leather Bomber "Overlord" High-Neck', 'preco' => 920.00, 'estilo' => 'Cyberpunk / Dark Industrial', 'img' => 'roupa1.jpg'],
            ['nome' => 'Cargo Trousers "Draconis" Chain-Rigged', 'preco' => 640.00, 'estilo' => 'Cyber-Goth / Dark Industrial', 'img' => 'm2.jpg']
        ];
    } elseif ($vencedor == 'B') {
        $resultado_titulo = "Avant-Garde / Dark Elegance";
        $resultado_texto = "Seu foco é a alfaiataria conceitual, silhuetas com cortes assimétricos marcantes e detalhes visuais sofisticados.";
        // Apenas produtos reais existentes das suas páginas f.php e m.php
        $produtos_recomendados = [
            ['nome' => 'Sculptural Dress "Elysium"', 'preco' => 840.00, 'estilo' => 'Editorial Classic / Avant-Garde', 'img' => 'f4.jpg'],
            ['nome' => 'Asymmetric Collared Jacket "Equinox"', 'preco' => 720.00, 'estilo' => 'Avant-Garde / Minimalist Industrial', 'img' => 'm1.jpg'],
            ['nome' => 'Wide-Leg Trousers "Requiem" Asymmetric', 'preco' => 480.00, 'estilo' => 'Editorial Classic / Avant-Garde', 'img' => 'r4.jpg']
        ];
    } else {
        $resultado_titulo = "Gothic Streetwear / Darkwear";
        $resultado_texto = "Você prioriza o conforto do caimento oversized, tecidos amaciados, estampas gráficas e a cultura urbana desconstruída.";
        // Apenas produtos reais existentes do seu drop index e f.php
        $produtos_recomendados = [
            ['nome' => 'Zip Hoodie "Sigil" Cyber-Goth', 'preco' => 390.00, 'estilo' => 'Darkwear / Cyber-Sigilism', 'img' => 'r3.jpg'],
            ['nome' => 'Oversized Crewneck "Ignis"', 'preco' => 360.00, 'estilo' => 'Gothic Streetwear / Grunge', 'img' => 'pitayaq2.png'],
            ['nome' => 'Graphic Tee "Judgement XX" Aether', 'preco' => 190.00, 'estilo' => 'Gothic Streetwear', 'img' => 'r5.png']
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIHIL | Quiz de Estilo</title>
    <link rel="icon" type="image/png" href="img/logo2.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/quiz.css">
    <style>
        .nav-carrinho {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #55524f;
            padding-bottom: 6px;
            border-bottom: 1px solid transparent;
            transition: all 0.3s ease;
        }
        .nav-carrinho:hover {
            color: #ffffff;
            border-bottom-color: #ffffff;
        }
        .carrinho-badge {
            display: inline-block;
            background-color: #8c1a20;
            color: #fff;
            font-size: 8px;
            letter-spacing: 0;
            padding: 1px 5px;
            margin-left: 6px;
            vertical-align: middle;
        }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <a href="index.php">
            <img src="img/logo2.png" alt="NIHIL" class="logo-img">
        </a>
    </div>
    <nav>
        <ul>
            <li><a href="index.php"   class="<?php echo ($pagina_atual == 'index.php')   ? 'ativo' : ''; ?>">Loja</a></li>
            <li><a href="f.php"       class="<?php echo ($pagina_atual == 'f.php')       ? 'ativo' : ''; ?>">Feminino</a></li>
            <li><a href="m.php"       class="<?php echo ($pagina_atual == 'm.php')       ? 'ativo' : ''; ?>">Masculino</a></li>
            <li><a href="quiz.php"    class="<?php echo ($pagina_atual == 'quiz.php')    ? 'ativo' : ''; ?>">Quiz</a></li>
            <li><a href="contato.php" class="<?php echo ($pagina_atual == 'contato.php') ? 'ativo' : ''; ?>">Contato</a></li>
            <li>
                <a href="carrinho.php" class="nav-carrinho">
                    Carrinho<?php if ($qtd_carrinho > 0): ?><span class="carrinho-badge"><?php echo $qtd_carrinho; ?></span><?php endif; ?>
                </a>
            </li>
        </ul>
    </nav>
</header>

<div class="quiz-container">
    <h1>Quiz de Estilo</h1>
    <span class="quiz-sub">Filtro Técnico de Modelagem e Vestuário</span>

    <?php if (!empty($resultado_titulo)): ?>
        <!-- Painel de Resultados com Vitrine Injetada -->
        <div class="resultado-box" id="resultado">
            <div class="corner-deco tl"></div>
            <div class="corner-deco tr"></div>
            <div class="corner-deco bl"></div>
            <div class="corner-deco br"></div>
            <span class="resultado-sub">Estilo Recomendado</span>
            <h2><?php echo $resultado_titulo; ?></h2>
            <p class="resultado-text"><?php echo $resultado_texto; ?></p>
            
            <div class="quiz-vitrine-titulo">Peças indicadas para você:</div>
            <div class="vitrine">
                <?php foreach ($produtos_recomendados as $item): ?>
                <div class="produto-card">
                    <div class="img-placeholder">
                        <img src="img/<?php echo htmlspecialchars($item['img']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>">
                    </div>
                    <div class="produto-info">
                        <span class="estilo-tag"><?php echo htmlspecialchars($item['estilo']); ?></span>
                        <h3><?php echo htmlspecialchars($item['nome']); ?></h3>
                        <p class="preco">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
                        <form method="POST" action="carrinho.php">
                            <input type="hidden" name="acao"   value="adicionar">
                            <input type="hidden" name="nome"   value="<?php echo htmlspecialchars($item['nome']); ?>">
                            <input type="hidden" name="preco"  value="<?php echo $item['preco']; ?>">
                            <input type="hidden" name="img"    value="<?php echo htmlspecialchars($item['img']); ?>">
                            <input type="hidden" name="origem" value="quiz.php">
                            <button type="submit" class="btn-buy">Adicionar ao carrinho</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div style="margin-top: 30px;">
                <a href="quiz.php" class="btn-secundario" style="display: inline-block; padding: 10px 20px;">Refazer Filtro</a>
            </div>
        </div>
    <?php endif; ?>

    <form method="POST" action="quiz.php#resultado">
        <!-- Pergunta 1 -->
        <div class="pergunta-box">
            <h3 class="pergunta-titulo">1. Qual tipo de peça superior te agrada mais no caimento?</h3>
            <label class="opcao-label">
                <input type="radio" name="q1" value="A" required> Jaquetas pesadas de couro high-neck ou coletes estruturados.
            </label>
            <label class="opcao-label">
                <input type="radio" name="q1" value="B"> Blazers e casacos com golas assimétricas ou capuzes volumosos.
            </label>
            <label class="opcao-label">
                <input type="radio" name="q1" value="C"> Moletons fechados confortáveis com capuz ou camisetas com estampas gráficas.
            </label>
        </div>

        <!-- Pergunta 2 -->
        <div class="pergunta-box">
            <h3 class="pergunta-titulo">2. Qual proposta de design você busca em calças e saias?</h3>
            <label class="opcao-label">
                <input type="radio" name="q2" value="A" required> Calças táticas cargo equipadas com tiras, fivelas ou correntes.
            </label>
            <label class="opcao-label">
                <input type="radio" name="q2" value="B"> Calças wide-leg de alfaiataria ou saias longas com modelagem fluida.
            </label>
            <label class="opcao-label">
                <input type="radio" name="q2" value="C"> Calças jeans retas ou saias utilitárias com acabamento estonado e desgastado.
            </label>
        </div>

        <!-- Pergunta 3 -->
        <div class="pergunta-box">
            <h3 class="pergunta-titulo">3. Qual acabamento têxtil chama mais a sua atenção?</h3>
            <label class="opcao-label">
                <input type="radio" name="q3" value="A" required> Materiais sintéticos rígidos, couro legítimo e costuras industriais reforçadas.
            </label>
            <label class="opcao-label">
                <input type="radio" name="q3" value="B"> Tecidos lisos de alta gramatura, pregas precisas e linhas arquitetônicas limpas.
            </label>
            <label class="opcao-label">
                <input type="radio" name="q3" value="C"> Detalhes estonados (distressed), barras desfiadas a fio e texturas amaciadas.
            </label>
        </div>

        <button type="submit" class="btn-buy btn-quiz">Filtrar Meu Estilo</button>
    </form>
</div>

<footer>
    <span class="footer-logo">NIHIL</span>
    <p class="footer-copy">
        &copy; 2026 NIHIL &mdash; Faculdade Tuiuti &middot; ADS &middot; Pedro Vargas
    </p>
    <nav class="footer-links">
        <a href="quiz.php">Style Quiz</a>
        <a href="contato.php">Contato</a>
    </nav>
</footer>

</body>
</html>