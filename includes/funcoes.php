<?php 

function msg_aviso($m) {
    $resp = "<div class='aviso'><i class='material-icons'>info</i>$m</div>";
    return $resp;
}
function msg_sucesso($m) {
    $resp = "<div class='sucesso'><i class='material-icons'>check_circle</i>$m</div>";
    return $resp;
}
function msg_erro($m) {
    $resp = "<div class='erro'><i class='material-icons'>error</i>$m</div>";
    return $resp;
}



function testarHash($senha, $hash) {
    return password_verify($senha, $hash);
}

function gerarHash($senha)
{
    return password_hash($senha, PASSWORD_DEFAULT);
}
?>