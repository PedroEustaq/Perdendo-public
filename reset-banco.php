<?php


$arquivo = "ultimo_reset.txt";


// Verifica último reset
$ultimoReset = file_exists($arquivo)
    ? filemtime($arquivo)
    : 0;


// Tempo mínimo entre resets (15 minutos)
$tempoReset = 300;


if (time() - $ultimoReset < $tempoReset) {
    return;
}



// ===============================
// RESET USUARIO
// ===============================

pg_query($conn, "TRUNCATE TABLE usuario RESTART IDENTITY CASCADE");


$usuarios = [

    [
        "admin",
        "Pedro Eustáquio",
        // Troque pelo hash real do CSV
        '$2y$10$NywjCDQoo17esTSxh/gwoeAGSZRgJTqOjMQv2Aidjx9pYaHEXgr1S',
        "admin"
    ]

];


foreach ($usuarios as $u) {

    $sql = "
        INSERT INTO usuario
        (
            usuario,
            nome,
            senha,
            tipo
        )
        VALUES
        ($1,$2,$3,$4)
    ";

    pg_query_params($conn, $sql, $u);

}



// ===============================
// RESET JOGOS
// ===============================

pg_query($conn, "TRUNCATE TABLE jogos RESTART IDENTITY CASCADE");


$jogos = [

[
10,
"Metal Gear Solid V",
1,
9,
"Snake enfrenta conspirações em um mundo aberto de guerra tática, onde furtividade, estratégia e liberdade de abordagem definem o sucesso das missões.",
9,
99.9,
2
],

[
2,
"Call of Duty Black Ops",
1,
5,
"Entre na Guerra Fria em missões secretas repletas de ação, conspirações e batalhas intensas, com um modo multiplayer icônico e o famoso modo zumbis.",
4,
89.99,
2
],

[
5,
"Sonic the Hedgehog",
4,
7,
"O ouriço azul mais rápido do mundo corre contra o tempo para impedir os planos do vilão Dr. Eggman, coletando anéis e enfrentando desafios cheios de velocidade.",
9,
49.9,
2
],

[
6,
"God of War",
1,
4,
"Kratos busca vingança contra os deuses do Olimpo em uma jornada brutal cheia de combates épicos, mitologia grega e uma narrativa intensa sobre ódio e redenção.",
10,
10.9,
3
],

[
1,
"Super Mario Odyssey",
2,
3,
"Mario viaja por reinos fantásticos ao lado de Cappy para resgatar Peach, explorando mundos criativos, coletando luas e usando seu chapéu para possuir inimigos.",
10,
329.9,
1
],

[
7,
"Counter-Strike",
1,
11,
"Clássico FPS tático entre terroristas e contraterroristas, onde estratégia, reflexos rápidos e trabalho em equipe são essenciais para vencer as partidas competitivas.",
9,
0,
2
],

[
12,
"Super Smash Bros. Ultimate",
11,
3,
"Personagens icônicos se enfrentam na luta definitiva, que você poderá jogar a qualquer hora, em qualquer lugar!",
9,
329.9,
1
],

[
8,
"Resident Evil 6",
3,
13,
"Quatro campanhas interligadas trazem ação e terror em uma batalha contra armas biológicas, enquanto heróis clássicos enfrentam zumbis e criaturas mutantes.",
8,
82.9,
2
],

[
3,
"League of Legends",
5,
2,
"Jogo de estratégia e ação onde times batalham para destruir a base inimiga, usando campeões com habilidades únicas e jogabilidade competitiva em equipe.",
9,
0,
2
],

[
4,
"Donkey Kong Tropical Freeze",
4,
3,
"Ajude Donkey Kong e sua turma a recuperar sua ilha dos invasores vikings, enfrentando desafios de plataforma criativos e belíssimos cenários congelados.",
8,
299.9,
1
],

[
9,
"Grand Theft Auto V",
1,
15,
"Três criminosos vivem uma história cheia de ação, roubos e traições em Los Santos, um enorme mundo aberto repleto de atividades e liberdade para explorar.",
10,
149.9,
2
],

[
11,
"Assassins Creed III",
2,
9,
"Lute na Revolução Americana como Connor, um assassino meio nativo, meio inglês, enfrentando templários e explorando um mundo aberto cheio de batalhas e intrigas.",
8,
145.99,
2
]

];



foreach ($jogos as $j) {

    $sql = "
        INSERT INTO jogos
        (
            cod,
            nome,
            genero,
            produtora,
            descricao,
            nota,
            preco,
            plataforma
        )
        VALUES
        ($1,$2,$3,$4,$5,$6,$7,$8)
    ";


    pg_query_params($conn, $sql, $j);

}



// ===============================
// MARCA RESET
// ===============================

file_put_contents(
    $arquivo,
    date("Y-m-d H:i:s")
);




?>