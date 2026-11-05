<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Adicionar item
if (isset($_POST['acao']) && $_POST['acao'] === 'adicionar') {
    $nome  = $_POST['nome']  ?? '';
    $preco = (float)($_POST['preco'] ?? 0);
    $img   = $_POST['img']   ?? '';

    $chave = md5($nome);

    if (isset($_SESSION['carrinho'][$chave])) {
        $_SESSION['carrinho'][$chave]['qtd']++;
    } else {
        $_SESSION['carrinho'][$chave] = [
            'nome'  => $nome,
            'preco' => $preco,
            'img'   => $img,
            'qtd'   => 1
        ];
    }

    header('Location: ' . $_POST['origem']);
    exit;
}

// Remover item
if (isset($_GET['remover'])) {
    unset($_SESSION['carrinho'][$_GET['remover']]);
    header('Location: carrinho.php');
    exit;
}

// Limpar carrinho
if (isset($_GET['limpar'])) {
    $_SESSION['carrinho'] = [];
    header('Location: carrinho.php');
    exit;
}

$pagina_atual = basename($_SERVER['PHP_SELF']);
$total = 0;
foreach ($_SESSION['carrinho'] as $item) {
    $total += $item['preco'] * $item['qtd'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIHIL | Carrinho</title>
    <link rel="icon" type="image/png" href="img/logo2.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/carrinho.css">
</head>
<body>

<?php
$qtd_carrinho = array_sum(array_column($_SESSION['carrinho'], 'qtd'));
?>

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
                <a href="carrinho.php" class="nav-carrinho <?php echo ($pagina_atual == 'carrinho.php') ? 'ativo' : ''; ?>">
                    Carrinho<?php if ($qtd_carrinho > 0): ?><span class="carrinho-badge"><?php echo $qtd_carrinho; ?></span><?php endif; ?>
                </a>
            </li>
        </ul>
    </nav>
</header>

<section class="carrinho-hero">
    <p class="hero-eyebrow">Carrinho &nbsp;·&nbsp; NIHIL</p>
    <h1><strong>Your<br><em>Selection</em></strong></h1>
</section>

<div class="carrinho-wrapper">

    <?php if (empty($_SESSION['carrinho'])): ?>

    <div class="carrinho-vazio">
        <p>Nenhum item adicionado.</p>
        <a href="index.php" class="btn-primario">Voltar à loja</a>
    </div>

    <?php else: ?>

    <div class="carrinho-itens">
        <?php foreach ($_SESSION['carrinho'] as $chave => $item): ?>
        <div class="carrinho-item">
            <div class="item-img">
                <img src="img/<?php echo htmlspecialchars($item['img']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>">
            </div>
            <div class="item-info">
                <h3><?php echo htmlspecialchars($item['nome']); ?></h3>
                <p class="item-preco">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
                <p class="item-qtd">Qtd: <?php echo (int)$item['qtd']; ?></p>
            </div>
            <div class="item-acoes">
                <p class="item-subtotal">R$ <?php echo number_format($item['preco'] * $item['qtd'], 2, ',', '.'); ?></p>
                <a href="carrinho.php?remover=<?php echo urlencode($chave); ?>" class="btn-remover">Remover</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="carrinho-resumo">
        <div class="resumo-linha">
            <span>Total</span>
            <span class="resumo-total">R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
        </div>
        <div class="resumo-acoes">
            <a href="carrinho.php?limpar=1" class="btn-limpar">Limpar carrinho</a>
            <a href="contato.php" class="btn-primario">Finalizar pedido</a>
        </div>
    </div>

    <?php endif; ?>

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