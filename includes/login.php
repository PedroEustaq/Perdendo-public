<?php

require_once "funcoes.php";
require_once "banco.php";


function autenticar($usuario, $senha)
{
    global $conn;

    $sql = "SELECT usuario, nome, senha, tipo
            FROM usuario
            WHERE usuario = $1
            LIMIT 1";

    $resultado = pg_query_params($conn, $sql, [$usuario]);

    if (!$resultado || pg_num_rows($resultado) == 0) {
        return false;
    }

    $dados = pg_fetch_assoc($resultado);

    if (!password_verify($senha, $dados["senha"])) {
        return false;
    }

    session_regenerate_id(true);

    $_SESSION["usuario"] = $dados["usuario"];
    $_SESSION["nome"] = $dados["nome"];
    $_SESSION["tipo"] = $dados["tipo"];

    return true;
}

session_start();

function logado()
{
    return isset($_SESSION["user"]);
}

function admin()
{
    return logado() && $_SESSION["tipo"] == "admin";
}

function logout()
{
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {

        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            "",
            time() - 3600,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();
}

function editor()
{
    return logado() &&
        ($_SESSION["tipo"] == "admin" || $_SESSION["tipo"] == "editor");
}