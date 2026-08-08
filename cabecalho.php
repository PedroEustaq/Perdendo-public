<?php


require_once "includes/funcoes.php";
require_once "reset-banco.php";
?>

<header class="cabecalho">

    <div class="menu-esquerda">

        <div class="logo">
            <img src="imgDeco/PERDENDOLogo.png" alt="">
        </div>

        <a href="index.php">
            <img src="svg/HomeVermelho.svg" alt="">
            Central
        </a>

        <a href="market.php">
            <img src="svg/BagVermelha.svg" alt="">
            Catálogo
        </a>

    </div>

    <div class="Direito">

        <div class="pesquisa">

            <img src="svg/LoopaCinza.svg" alt="">

            <input type="text" placeholder="Pesquisar">

        </div>

        <div class="login">

            <img src="svg/ContaIcone.svg" alt="User Icon">

            <?php if (logado()) { ?>

                <div class="usuario-logado">

                    <strong><?= htmlspecialchars($_SESSION["nome"]) ?></strong><br>

                    <small>
                        <?= admin() ? "Administrador" : "Usuário" ?>
                    </small>

                </div>

                <a href="user-edit.php">
                    Meus Dados
                </a>

                <?php if (admin()) { ?>

                    <a href="user-new.php">
                        Registrar Usuário
                    </a>

                <?php } ?>

                <a href="user-logout.php">
                    Sair
                </a>

            <?php } else { ?>

            

                <a href="user-login.php">
                    Iniciar Sessão
                </a>

            <?php } ?>

        </div>

    </div>

</header>