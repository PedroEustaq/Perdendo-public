<?php

require_once "includes/banco.php";
require_once "includes/login.php";
$id = $_GET['id'] ?? null;


if (!$id) {
    die("Jogo não encontrado");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && editor()) {

 $nome = $_POST["nome"];
$preco = $_POST["preco"];
$descricao = $_POST["descricao"];
$nota = $_POST["nota"];

    $sql = "
    UPDATE jogos
    SET
        nome = $1,
        preco = $2,
        descricao = $3,
        nota = $4
    WHERE cod = $5
";

    $resultado = pg_query_params(
        $conn,
        $sql,
       [$nome, $preco, $descricao, $nota, $id]
    );

    if (!$resultado) {
        die(pg_last_error($conn));
    }

    header("Location: detalhes.php?id=$id");
    exit();
}


$sql = "SELECT * FROM jogos WHERE cod = $1";

$resultado = pg_query_params($conn, $sql, [$id]);


$jogo = pg_fetch_assoc($resultado);


if (!$jogo) {
    die("Jogo não encontrado");
}



$nome = $jogo['nome'];
$preco = $jogo['preco'];
$descricao = $jogo['descricao'];
$nota = $jogo['nota'];
$plataforma = $jogo['plataforma'];
$produtora = $jogo['produtora'];
$genero = $jogo['genero'];



$sqlProdutora = "SELECT * FROM produtoras WHERE cod = $1";

$resultaprodutora = pg_query_params($conn, $sqlProdutora, [$produtora]);

if (!$resultaprodutora) {
    die(pg_last_error($conn));
}

$tabela_produtora = pg_fetch_assoc($resultaprodutora);

$nome_produtora = $tabela_produtora['produtora'] ?? "Desconhecida";


##################
$sqlPlataforma = "SELECT * FROM plataforma WHERE id = $1";

$resultaplataforma = pg_query_params($conn, $sqlPlataforma, [$plataforma]);

if (!$resultaplataforma) {
    die(pg_last_error($conn));
}

$tabela_plataforma = pg_fetch_assoc($resultaplataforma);

$nome_plataforma = $tabela_plataforma['plataforma'] ?? "Desconhecida";


##################
$sqlGenero = "SELECT * FROM generos WHERE cod = $1";

$resultagenero = pg_query_params($conn, $sqlGenero, [$genero]);

if (!$resultagenero) {
    die(pg_last_error($conn));
}

$tabela_genero = pg_fetch_assoc($resultagenero);

$nome_genero = $tabela_genero['genero'] ?? "Desconhecida";


$editar = isset($_GET["editar"]) && editor();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nome ?> | Perdendo</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="sobre.css">
    <link rel="stylesheet" href="cabecalho.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="pagina-produto" style="--fundo: url('imgJogos/<?= $nome ?>/background.avif');">



    <?php require_once "cabecalho.php"; ?>
    <main class="produto-page">
        <form method="post">
            <section class="produto-card">

                <div class="produto-esquerda">

                    <nav class="breadcrumb">

                        <a href="index.php">Central</a>

                        <span class="material-icons">chevron_right</span>

                        <a href="market.php">Catálogo</a>

                        <span class="material-icons">chevron_right</span>

                        <span class="pagina-atual"><?= htmlspecialchars($nome) ?></span>

                    </nav>

                    <div class="produto-imagem-principal">
                        <img
                            src="imgJogos/<?= $nome ?>/banner1.avif"
                            alt="<?= $nome ?>"
                            id="imagemPrincipal">
                    </div>

                    <div class="produto-bolinhas" aria-hidden="true">
                        <span class="ativa"></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div class="produto-miniaturas">




                        <?php

                        for ($i = 1; $i <= 5; $i++) {

                            echo "

    <div class='miniatura " . ($i == 1 ? "ativa" : "") . "'>

        <img src='imgJogos/$nome/banner$i.avif'>

    </div>

    ";
                        }

                        ?>










                    </div>

                </div>

                <aside class="produto-direita">


                    <?php if (editor()) { ?>

                        <div class="acoes-admin">

                            <a href="?id=<?= $id ?>&editar=1">

                               <span class="material-icons edit-icon">edit</span>

                            </a>


                            <?php if ($editar) { ?>

                                <button type="submit">

                                    Salvar Alterações

                                </button>

                            <?php } ?>
                        </div>

                    <?php } ?>
                    <?php if ($editar) { ?>

                        <input
                            type="text"
                            name="nome"
                            value="<?= htmlspecialchars($nome) ?>">

                    <?php } else { ?>

                        <h1><?= htmlspecialchars($nome) ?></h1>

                    <?php } ?>

                    <div class="linha-preco">
                        <?php if ($editar) { ?>

                            <input
                                type="number"
                                step="0.01"
                                name="preco"
                                value="<?= $preco ?>">

                        <?php } else { ?>

                            <h2 class="produto-preco">
                                R$<?= number_format($preco, 2, ",", ".") ?>
                            </h2>

                        <?php } ?>

                        <div class="nota-produto">

    <img src="./svg/starYellow.svg" alt="">

    <?php if ($editar) { ?>

        <input 
            type="number"
            name="nota"
            min="0"
            max="10"
            step="0.1"
            value="<?= $nota ?>">

    <?php } else { ?>

        <span><?= number_format($nota, 1) ?></span>

    <?php } ?>

</div>
                    </div>

                    <?php if ($editar) { ?>

                        <textarea
                            name="descricao"
                            rows="8"><?= htmlspecialchars($descricao) ?></textarea>

                    <?php } else { ?>

                        <p class="produto-descricao">
                            <?= htmlspecialchars($descricao) ?>
                        </p>

                    <?php } ?>

                    <div class="produto-acoes">
                        <a href="#" class="btn-principal">Botar no carrinho</a>
                        <a href="#" class="btn-secundario">Embrulhar para presente</a>
                    </div>

                    <div class="produto-dados">
                        <div>
                            <span>Gênero</span>
                            <strong><?= $nome_genero ?></strong>
                        </div>

                        <div>
                            <span>Plataforma</span>
                            <strong><?= $nome_plataforma ?></strong>
                        </div>

                        <div>
                            <span>Fornecedor</span>
                            <strong><?= $nome_produtora ?></strong>
                        </div>


                    </div>

                </aside>

            </section>
        </form>
    </main>

    <script>
        const imagemPrincipal = document.querySelector("#imagemPrincipal");
        const miniaturas = document.querySelectorAll(".miniatura");
        const bolinhas = document.querySelectorAll(".produto-bolinhas span");

        let atual = 0;

        function mostrarImagem(indice) {
            const miniatura = miniaturas[indice];
            const novaImagem = miniatura.querySelector("img").src;

            imagemPrincipal.src = novaImagem;

            miniaturas.forEach((item) => item.classList.remove("ativa"));
            bolinhas.forEach((item) => item.classList.remove("ativa"));

            miniatura.classList.add("ativa");
            bolinhas[indice].classList.add("ativa");

            atual = indice;
        }

        miniaturas.forEach((item, indice) => {
            item.addEventListener("click", () => {
                mostrarImagem(indice);
            });
        });

        bolinhas.forEach((item, indice) => {
            item.addEventListener("click", () => {
                mostrarImagem(indice);
            });
        });

        setInterval(() => {
            atual++;
            if (atual >= miniaturas.length) {
                atual = 0;
            }
            mostrarImagem(atual);
        }, 4000);
    </script>

</body>

</html>