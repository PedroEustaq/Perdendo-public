<?php
require_once "includes/banco.php";
require_once "includes/login.php";

$listaGeneros = pg_query($conn, "
    SELECT cod, genero
    FROM generos
    ORDER BY genero
");

$listaProdutoras = pg_query($conn, "
    SELECT cod, produtora
    FROM produtoras
    ORDER BY produtora
");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo | Perdendo</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cabecalho.css">
    <link rel="stylesheet" href="market.css">
<meta name="description" content="Descubra os melhores jogos para PC, PlayStation, Xbox e Nintendo. Explore lançamentos, promoções, avaliações e encontre seu próximo game favorito.">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <?php require_once "cabecalho.php"; ?>
    <main class="Market">

        <aside class="filtros">

            <h2>Filtros</h2>
            <form id="formFiltros" method="GET">
                <div class="campoBusca">
                    <img src="svg/LoopaCinza.svg">

                    <input
                        id="pesquisa"
                        type="text"
                        name="pesquisa"
                        placeholder="Pesquisar jogo..."
                        autocomplete="off"
                        value="<?= htmlspecialchars($_GET['pesquisa'] ?? '') ?>">
                </div>

                <h3>Nota mínima</h3>

                <input
                    type="range"
                    id="nota"
                    name="nota"
                    min="0"
                    max="10"
                    step="0.1"
                    value="<?= htmlspecialchars($_GET['nota'] ?? '0') ?>">

                <p class="valorNota">
                    <img src="svg/starYellow.svg" alt=""> <span id="notaValor"><?= htmlspecialchars($_GET['nota'] ?? '0') ?></span>
                </p>

                <h3>Produtora</h3>

                <select name="produtora">

                    <option value="">Todas</option>

                    <?php while ($p = pg_fetch_assoc($listaProdutoras)): ?>

                        <option
                            value="<?= $p['cod'] ?>"
                            <?= ($_GET['produtora'] ?? '') == $p['cod'] ? 'selected' : '' ?>>

                            <?= htmlspecialchars($p['produtora']) ?>

                        </option>

                    <?php endwhile; ?>

                </select>

                <h3>Gênero</h3>

                <select name="genero">

                    <option value="">Todos</option>

                    <?php while ($g = pg_fetch_assoc($listaGeneros)): ?>

                        <option
                            value="<?= $g['cod'] ?>"
                            <?= ($_GET['genero'] ?? '') == $g['cod'] ? 'selected' : '' ?>>

                            <?= htmlspecialchars($g['genero']) ?>

                        </option>

                    <?php endwhile; ?>

                </select>
            </form>
        </aside>

        <section class="catalogo">

            <?php

            $pesquisa = trim($_GET['pesquisa'] ?? '');
            $nota = $_GET['nota'] ?? '';
            $produtora = $_GET['produtora'] ?? '';
            $genero = $_GET['genero'] ?? '';



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


            if ($nota != "") {

                $nota = (float)$nota;

                $sql .= "
        AND j.nota >= $nota
    ";
            }

            if ($produtora != "") {

                $produtora = (int)$produtora;

                $sql .= "
        AND j.produtora = $produtora
    ";
            }

            if ($genero != "") {

                $genero = (int)$genero;

                $sql .= "
        AND j.genero = $genero
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
                                <span><img src="./svg/starYellow.svg" alt=""> <?= number_format($jogo['nota'], 1) ?></span>
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

    <?php
    require_once "rodape.php";
    ?>

    <script src="script.js"></script>
    <script>
        const form = document.getElementById("formFiltros");

       

        form.querySelectorAll("select").forEach(select => {
            select.addEventListener("change", () => {
                form.submit();
            });
        });

        const slider = document.getElementById("nota");
        const notaValor = document.getElementById("notaValor");

        slider.addEventListener("input", () => {
            notaValor.textContent = slider.value;
        });

        slider.addEventListener("change", () => {
            form.submit();
        });
    </script>
</body>

</html>