<?php require_once "includes/banco.php";
require_once "includes/login.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central | Perdendo</title>
    <link rel="icon" href="./imgDeco/favi.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cabecalho.css">
    <link rel="stylesheet" href="banner.css">
    <link rel="stylesheet" href="destaque.css">
    <link rel="stylesheet" href="giftcards.css">
    <link rel="stylesheet" href="market.css">

    <meta name="description" content="Descubra os melhores jogos para PC, PlayStation, Xbox e Nintendo. Explore lançamentos, promoções, avaliações e encontre seu próximo game favorito.">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anton+SC&family=Inter:opsz@14..32&family=Karla&family=Roboto:ital,wght@0,100..900;1,100..900&family=VT323&display=swap');
    </style>
</head>

<body>


    <?php require_once "cabecalho.php"; ?>


    <?php

    $quantidadeBanner = rand(3, 6);

    $sqlBanner = "
SELECT
    j.cod,
    j.nome,
    j.nota,
    g.genero,
    p.produtora
FROM jogos j
JOIN generos g ON g.cod = j.genero
JOIN produtoras p ON p.cod = j.produtora
ORDER BY RANDOM()
LIMIT $quantidadeBanner
";

    $buscaBanner = pg_query($conn, $sqlBanner);

    $banners = [];

    while ($jogo = pg_fetch_assoc($buscaBanner)) {

        $pasta = "imgJogos/" . $jogo['nome'];

        $imagem = localizarImagem($pasta, "bannerE");

        if ($imagem) {

            $jogo["imagem"] = $imagem;

            $banners[] = $jogo;
        }
    }

    ?>
    <section class="banner">

        <div class="slides">

            <?php foreach ($banners as $banner) { ?>

                <img
                    src="<?= $banner["imagem"] ?>"
                    alt="<?= htmlspecialchars($banner["nome"]) ?>">

            <?php } ?>

        </div>

        <div class="indicadores">

            <?php foreach ($banners as $i => $banner) { ?>

                <div class="indicador <?= $i == 0 ? 'ativo' : '' ?>">

                    <span>
                        <?= htmlspecialchars(mb_strimwidth($banner['nome'], 0, 20, "...")) ?>
                    </span>

                </div>

            <?php } ?>

        </div>

    </section>

    <div class="EmDestaque">
        <h1>Em Destaque</h1>

        <div class="linhaJogos">

            <?php

            $sql = "
SELECT
    j.cod,
    j.nome,
    j.nota,
    g.genero,
    p.produtora
FROM jogos j
JOIN generos g ON g.cod = j.genero
JOIN produtoras p ON p.cod = j.produtora
ORDER BY RANDOM()
LIMIT 5
";

            $busca = pg_query($conn, $sql);

            while ($jogo = pg_fetch_assoc($busca)) {

                $pasta = "imgJogos/" . $jogo['nome'];

                $imagem = localizarImagem($pasta, "capa");

                if ($imagem == null) {
                    continue;
                }

            ?>

                <a href="detalhes.php?id=<?= $jogo['cod'] ?>" class="card-link">

                    <div class="Jogo">

                        <div class="ImagemJogo">
                            <img src="<?= $imagem ?>" alt="<?= htmlspecialchars($jogo['nome']) ?>">
                        </div>

                        <div class="InfoJogo">

                            <div class="NomeNota">

                                <h3 class="NomeJogo">
                                    <?= htmlspecialchars($jogo['nome']) ?>
                                </h3>

                                <div class="Nota">
                                    <img src="svg/starYellow.svg" alt="Estrela amarela">
                                    <span><?= number_format($jogo['nota'], 1) ?></span>
                                </div>

                            </div>

                            <div class="DataProd">
                                <p><?= htmlspecialchars($jogo['produtora']) ?></p>
                                <p><?= htmlspecialchars($jogo['genero']) ?></p>
                            </div>

                        </div>

                    </div>

                </a>

            <?php } ?>

        </div>
    </div>

    <section class="Gift">

        <div class="giftText">
            <span class="giftTag"><img src="svg/EstrelaBranca.svg" alt=""> GIFT CARDS</span>

            <h1>O presente perfeito para qualquer jogador.</h1>

            <p>
                Compre em poucos segundos e receba seu código rapidamente.
            </p>

            <div class="giftButtons">
                <button class="btnPrincipal" onclick="window.alert('Estamos re-abastecendo nosso estoque, volte mais tarde!')">Ver Gift Cards</button>
            </div>
        </div>

        <div class="giftWall">

            <img src="imgDeco/giftNintendo.png" alt="">
            <img src="imgDeco/giftLOL.webp" alt="">
            <img src="imgDeco/giftPlaystore.png" alt="">
            <img src="imgDeco/giftRoblox.png" alt="">
            <img src="imgDeco/giftValorant.png" alt="">
            <img src="imgDeco/giftXbox.png" alt="">

            <img src="imgDeco/giftSTEAM.webp" alt="">
            <img src="imgDeco/giftPlaystation.png" alt="">
            <img src="imgDeco/giftVBUCKS.jpg" alt="">
            <img src="imgDeco/giftRoblox.png" alt="">
            <img src="imgDeco/giftValorant.png" alt="">
            <img src="imgDeco/giftXbox.png" alt="">

            <img src="imgDeco/giftNintendo.png" alt="">
            <img src="imgDeco/giftPlaystation.png" alt="">
            <img src="imgDeco/giftVBUCKS.jpg" alt="">
            <img src="imgDeco/giftRoblox.png" alt="">
            <img src="imgDeco/giftValorant.png" alt="">
            <img src="imgDeco/giftXbox.png" alt="">

        </div>

    </section>
    <main class="Market">

        <aside class="filtros --promocional" onclick="window.location.href='market.php'">

          <h1>Confira a loja completa!</h1>

            <div class="promo-icons">
                <img src="./svg/PlayBtn.svg" alt="">
                <img src="./svg/PlayBtn.svg" alt="">
                <img src="./svg/PlayBtn.svg" alt="">
                <img src="./svg/PlayBtn.svg" alt="">
                <img src="./svg/PlayBtn.svg" alt="">
            </div>
        </aside>

        <section class="catalogo">

            <?php

            $pesquisa = trim($_GET['pesquisa'] ?? '');

            $plataformas = $_GET['plataforma'] ?? [];

            $sql = "
SELECT
    j.cod,
    j.nome,
    j.nota,
    g.genero,
    p.produtora,
    j.plataforma
FROM jogos j
JOIN generos g ON g.cod = j.genero
JOIN produtoras p ON p.cod = j.produtora
WHERE 1=1
";

            if ($pesquisa != "") {

                $pesquisa = pg_escape_string($conn, $pesquisa);

                $sql .= "
        AND j.nome ILIKE '%$pesquisa%'
    ";
            }

            if (!empty($plataformas)) {

                $lista = [];

                foreach ($plataformas as $p) {

                    $lista[] = (int)$p;
                }

                $sql .= "
        AND j.plataforma IN(" . implode(",", $lista) . ")
    ";
            }

            $sql .= "
ORDER BY j.nome
";

            $busca = pg_query($conn, $sql);

            // Contador dos cards exibidos
            $contador = 0;

            function localizarImagem($pasta, $nomeArquivo)
            {
                $extensoes = [
                    "png",
                    "jpg",
                    "jpeg",
                    "webp",
                    "avif",
                    "gif"
                ];

                foreach ($extensoes as $ext) {

                    $arquivo = "$pasta/$nomeArquivo.$ext";

                    if (file_exists($arquivo)) {
                        return $arquivo;
                    }
                }

                return null;
            }

            while ($jogo = pg_fetch_assoc($busca)) {

                // Wide, Normal, Normal, Wide, Normal, Normal...
                $wide = ($contador % 5 == 0);

                $pasta = "imgJogos/" . $jogo['nome'];

                $imagem = $wide
                    ? localizarImagem($pasta, "banner1")
                    : localizarImagem($pasta, "capa");

                // Se não existir nenhuma imagem, não mostra este jogo
                if ($imagem === null) {
                    continue;
                }

            ?>

                <a href="detalhes.php?id=<?= $jogo['cod'] ?>" class="card-link">

                    <article class="card <?= $wide ? 'card--wide' : '' ?>">

                        <img
                            src="<?= $imagem ?>"
                            alt="<?= htmlspecialchars($jogo['nome']) ?>"
                            loading="lazy">

                        <div class="card-info">

                            <div class="card-topo">
                                <h3><?= htmlspecialchars($jogo['nome']) ?></h3>
                                <span><img src="./svg/starYellow.svg" alt="Estrela amarela"> <?= number_format($jogo['nota'], 1) ?></span>
                            </div>
                            <div class="DataProd">
                                <p>
                                    <?= htmlspecialchars($jogo['produtora']) ?>

                                </p>
                                <p>
                                    <?= htmlspecialchars($jogo['genero']) ?>
                                </p>
                            </div>
                        </div>

                    </article>

                </a>

            <?php

                // alterna entre banner1 e capa
                // alterna entre banner1 e capa
                $contador++;
            }

            ?>

        </section>

    </main>


</body>
<?php require_once 'rodape.php';



?>

<script>
    const form = document.getElementById("formFiltros");

    // Quando a página carregar
    window.addEventListener("load", () => {

        const scroll = sessionStorage.getItem("scroll");

        if (scroll !== null) {

            window.scrollTo({
                top: Number(scroll),
                behavior: "instant" // pode trocar por "smooth" se preferir
            });

            sessionStorage.removeItem("scroll");

        }

    });

    // Função que salva a posição e envia o formulário
    function enviarFormulario() {

        form.submit();

    }

    // Checkboxes
    document.querySelectorAll("input[type=checkbox]").forEach(check => {

        check.addEventListener("change", enviarFormulario);

    });

    // Campo de pesquisa
    document.getElementById("pesquisa").addEventListener("keydown", function(e) {

        if (e.key === "Enter") {

            e.preventDefault();

            const texto = this.value.trim();

            window.location.href =
                "market.php?pesquisa=" + encodeURIComponent(texto);

        }

    });
</script>
<script src="script.js"></script>

</html>