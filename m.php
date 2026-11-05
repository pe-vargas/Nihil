<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$qtd_carrinho = array_sum(array_column($_SESSION['carrinho'], 'qtd'));

$produtos_masculino = [
    [
        'nome'   => 'Full Set "Berserker" Armor-Sculpted',
        'preco'  => 2800.00,
        'estilo' => 'Dark Fantasy / Gothic Armour',
        'img'    => 'oli.jpg'
    ],
    [
        'nome'   => 'Bomber Jacket "Crusader" Panelled Leather',
        'preco'  => 1480.00,
        'estilo' => 'Dark Elegance / Gothic Armour',
        'img'    => 'm4.jpg'
    ],
    [
        'nome'   => 'Denim Jacket "Wraith" Fur-Collar Distressed',
        'preco'  => 1150.00,
        'estilo' => 'Cyber-Goth / Dark Fantasy',
        'img'    => 'm5.png'
    ],
    [
        'nome'   => 'Asymmetric Collared Jacket "Equinox"',
        'preco'  => 720.00,
        'estilo' => 'Avant-Garde / Minimalist Industrial',
        'img'    => 'm1.jpg'
    ],
    [
        'nome'   => 'Cargo Trousers "Draconis" Chain-Rigged',
        'preco'  => 640.00,
        'estilo' => 'Cyber-Goth / Dark Industrial',
        'img'    => 'm2.jpg'
    ],
    [
        'nome'   => 'Tie "Memento" Skull-Damask Print',
        'preco'  => 180.00,
        'estilo' => 'Dark Elegance / Gothic Formal',
        'img'    => 'm3.jpg'
    ]
];

$pagina_atual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIHIL | Masculino</title>
    <link rel="icon" type="image/png" href="img/logo2.png">
    <link rel="stylesheet" href="css/style.css">
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

<div class="ticker" aria-hidden="true">
    <div class="ticker-inner">
        <span>Nihil! Nihil! Nihil!</span><span class="ticker-sep">⛧</span>
        <span>New Drop Out - Unholy</span><span class="ticker-sep">⛧</span>
        <span>Nihil! Nihil! Nihil!</span><span class="ticker-sep">⛧</span>
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
                <a href="carrinho.php" class="nav-carrinho">
                    Carrinho<?php if ($qtd_carrinho > 0): ?><span class="carrinho-badge"><?php echo $qtd_carrinho; ?></span><?php endif; ?>
                </a>
            </li>
        </ul>
    </nav>
</header>

<section class="hero hero-masculino">
    <div class="hero-col-left">
        <p class="hero-eyebrow">Coleção Permanente &nbsp;·&nbsp; Masculino &nbsp;·&nbsp; NIHIL</p>
        <h1>
            <strong>Sovereign<br>
            Carved In<br>
            <em>Shadow</em></strong>
        </h1>
        <p class="hero-desc">
            Estruturas pesadas e silhuetas que recusam a simetria ordinária.<br>
            Peças forjadas em linho denso, lona resinada e cortes utilitários, 
            desenhadas para corpos que habitam a margem do silêncio.
        </p>
        <div class="hero-actions">
            <a href="#vitrine-m" class="btn-primario">Ver a Coleção</a>
            <a href="quiz.php" class="btn-secundario">Faça o seu quiz de estilo</a>
        </div>
    </div>
    <div class="hero-col-right"></div>
</section>

<div class="faixa-marquee" aria-hidden="true">
    <div class="faixa-inner">
        <span>Peças exclusivas da coleção permanente da NIHIL, vendidas por tempo limitado (até acabar o estoque) e fora dos drops sazonais...</span>
    </div>
</div>

<section class="vitrine-section" id="vitrine-m">
    <div class="section-header">
        <div>
            <p class="section-label">Coleção permanente</p>
            <h2 class="section-title">Masculino</h2>
        </div>
        <a href="index.php" class="section-link">Ver drops ativos</a>
    </div>

    <div class="vitrine">
        <?php foreach ($produtos_masculino as $item): ?>
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
                    <input type="hidden" name="origem" value="m.php">
                    <button type="submit" class="btn-buy">Adicionar ao carrinho</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="banner-colecao">
    <div>
        <p class="banner-eyebrow">Em breve</p>
        <h2 class="banner-titulo">Killing Obsession<br>AW26</h2>
        <p class="banner-desc">
            26 peças. Edição única.<br><br>
            Uma crônica visual sobre o silêncio da madrugada, obsessão e o gélido aço do horror cinematográfico.<br>
            Cortes cirúrgicos desenhados para os sobreviventes do escuro.
        </p>
        <a href="contato.php" class="btn-secundario">Avisar quando sair</a>
    </div>
    <div class="banner-visual">
        <div class="corner-deco tl"></div>
        <div class="corner-deco tr"></div>
        <div class="corner-deco bl"></div>
        <div class="corner-deco br"></div>
        <img src="img/ko.jpg" alt="Preview Killing Obsession" class="drop-preview-img">
    </div>
</section>

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