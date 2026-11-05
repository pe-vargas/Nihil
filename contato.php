<?php
session_start(); // Inicia a sessão para conseguir ler o carrinho nesta página

$pagina_atual = basename($_SERVER['PHP_SELF']);

$enviado = false;
$erro    = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome']     ?? '');
    $email    = trim($_POST['email']    ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($nome && $email && $mensagem && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $enviado = true;
    } else {
        $erro = true;
    }
}

// Garante o cálculo da quantidade para exibir no menu dinâmico
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}
$qtd_carrinho = array_sum(array_column($_SESSION['carrinho'], 'qtd'));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIHIL | Contato</title>
    <link rel="icon" type="image/png" href="img/logo2.png"> <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contato.css">
</head>
<body>

<div class="ticker" aria-hidden="true">
    <div class="ticker-inner">
        <span>Nihil! Nihil! Nihil!</span><span class=\"ticker-sep\">⛧</span>
        <span>New Drop Out - Unholy</span><span class=\"ticker-sep\">⛧</span>
        <span>Nihil! Nihil! Nihil!</span><span class=\"ticker-sep\">⛧</span>
    </div>
</div>

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

<section class="contato-hero">
    <p class="hero-eyebrow">Contato &nbsp;·&nbsp; NIHIL</p>
    <h1><strong>Speak<br>To The<br><em>Void</em></strong></h1>
    <p class="hero-desc">
        Dúvidas sobre pedidos, colabs ou imprensa.
    </p>
</section>

<div class="contato-wrapper">

    <?php if ($enviado): ?>
    <div class="form-feedback sucesso">
        <span class="feedback-label">Mensagem enviada</span>
        <p>Recebemos o seu contato. Respondemos em até 2 dias úteis.</p>
        <a href="contato.php" class="btn-secundario">Enviar outra</a>
    </div>

    <?php else: ?>

    <?php if ($erro): ?>
    <div class="form-feedback falha">
        <span class="feedback-label">Erro</span>
        <p>Preencha todos os campos corretamente antes de enviar.</p>
    </div>
    <?php endif; ?>

    <form class="contato-form" method="POST" action="contato.php">

        <div class="form-row">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    placeholder="Seu nome"
                    value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>"
                    required
                >
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="seu@email.com"
                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                    required
                >
            </div>
        </div>

        <div class="form-group">
            <label for="mensagem">Mensagem</label>
            <textarea
                id="mensagem"
                name="mensagem"
                rows="6"
                placeholder="Escreva aqui..."
                required
            ><?php echo htmlspecialchars($_POST['mensagem'] ?? ''); ?></textarea>
        </div>

        <button type="submit" class="btn-submit">Enviar mensagem</button>

    </form>
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