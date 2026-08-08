-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/02/2025 às 18:22
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

create database if not exists sitejogos;

use sitejogos;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sitejogos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `generos`
--

CREATE TABLE `generos` (
  `cod` int(11) NOT NULL,
  `genero` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `generos`
--

INSERT INTO `generos` (`cod`, `genero`) VALUES
(1, 'Ação'),
(2, 'Aventura'),
(3, 'Terror'),
(4, 'Plataforma'),
(5, 'Estratégia'),
(6, 'RPG'),
(7, 'Esporte'),
(8, 'Corrida'),
(9, 'Tabuleiro'),
(10, 'Puzzle'),
(11, 'Luta'),
(12, 'Musical');

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogos`
--

CREATE TABLE `jogos` (
  `cod` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `produtora` int(11) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `capa` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `jogos`
--

INSERT INTO `jogos` (`cod`, `nome`, `genero`, `produtora`, `descricao`, `nota`, `capa`) VALUES
(1, 'Mario Odissey', 2, 3, 'Mario viaja por reinos fantásticos ao lado de Cappy para resgatar Peach, explorando mundos criativos, coletando luas e usando seu chapéu para possuir inimigos.', 10, 'mario.png'),
(2, 'Call of Dutty: Black Ops', 1, 5, 'Entre na Guerra Fria em missões secretas repletas de ação, conspirações e batalhas intensas, com um modo multiplayer icônico e o famoso modo zumbis.', 4, 'cod.png'),
(3, 'League of Legends', 1, 2, 'Jogo de estratégia e ação onde times batalham para destruir a base inimiga, usando campeões com habilidades únicas e jogabilidade competitiva em equipe.', 9, 'lol.png'),
(4, 'Donkey Kong Tropical Freeze', 2, 3, 'Ajude Donkey Kong e sua turma a recuperar sua ilha dos invasores vikings, enfrentando desafios de plataforma criativos e belíssimos cenários congelados.', 8, 'donkey.png'),
(5, 'Sonic the Hedgehog', 2, 7, 'O ouriço azul mais rápido do mundo corre contra o tempo para impedir os planos do vilão Dr. Eggman, coletando anéis e enfrentando desafios cheios de velocidade.', 9, 'sonic.png'),
(6, 'God of War', 1, 4, 'Kratos busca vingança contra os deuses do Olimpo em uma jornada brutal cheia de combates épicos, mitologia grega e uma narrativa intensa sobre ódio e redenção.\r\n\r\n', 10, 'gow.png'),
(7, 'Counter-Strike', 1, 11, 'Clássico FPS tático entre terroristas e contraterroristas, onde estratégia, reflexos rápidos e trabalho em equipe são essenciais para vencer as partidas competitivas.', 9, 'cs.png'),
(8, 'Resident Evil 6', 3, 14, 'Quatro campanhas interligadas trazem ação e terror em uma batalha contra armas biológicas, enquanto heróis clássicos enfrentam zumbis e criaturas mutantes.', 8, 'resident.png'),
(9, 'Grand Theft Auto V', 2, 13, 'Três criminosos vivem uma história cheia de ação, roubos e traições em Los Santos, um enorme mundo aberto repleto de atividades e liberdade para explorar.', 10, 'gta.png'),
(10, 'Metal Gear Solid V', 6, 9, 'Snake enfrenta conspirações em um mundo aberto de guerra tática, onde furtividade, estratégia e liberdade de abordagem definem o sucesso das missões.', 9, 'metal.png'),
(11, 'Assassins Creed III', 1, 10, 'Lute na Revolução Americana como Connor, um assassino meio nativo, meio inglês, enfrentando templários e explorando um mundo aberto cheio de batalhas e intrigas.', 8, 'assassin.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtoras`
--

CREATE TABLE `produtoras` (
  `cod` int(11) NOT NULL,
  `produtora` varchar(30) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtoras`
--

INSERT INTO `produtoras` (`cod`, `produtora`, `pais`) VALUES
(1, 'Microsoft', 'EUA'),
(2, 'Tencent', 'China'),
(3, 'Nintendo', 'Japão'),
(4, 'Sony', 'Japão'),
(5, 'Activision', 'EUA'),
(6, 'EA', 'EUA'),
(7, 'Sega', 'Japão'),
(8, 'Namco Bandai', 'Japão'),
(9, 'Ubisoft', 'EUA'),
(10, 'Valve', 'EUA'),
(11, 'Valve', 'Japão'),
(12, 'Take Two', 'EUA'),
(13, 'Capcom', 'EUA'),
(14, 'Konami', 'Japão');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(30) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` varchar(20) NOT NULL DEFAULT 'editor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`usuario`, `nome`, `senha`, `tipo`) VALUES
('admin', 'Gustavo S', '$2y$10$6NKwQnOHa9Bc8P9XxoBrVekziOWDhbG4ufnIP366NjYKcCx/V2OAu', 'admin'),
('Garoto Legal', 'Garotinho', '$2y$10$e9NK0kNltJ95aaOSfb0Wr.fAnTLU8vN25YOKyxEwPDDHsFvy4yca2', 'editor'),
('Pedro', 'Pedro Paulo', '$2y$10$rREcWpRMKgYKjqDySrIsZuzvBHFye6buQRhRoiH20wvkWzZm2hz.q', 'editor'),
('teste', 'João da Silva', '$2y$10$w7on7cjLKNtmJ', 'editor'),
('teste1', 'teste1', '$2y$10$rVoJtKZKiBwTU7fTFJ.Bs.MjKsaQU29dSRa20LOEw4a9IjJDz93Gy', 'editor');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `genero` (`genero`),
  ADD KEY `produtora` (`produtora`);

--
-- Índices de tabela `produtoras`
--
ALTER TABLE `produtoras`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `generos`
--
ALTER TABLE `generos`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `jogos`
--
ALTER TABLE `jogos`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `produtoras`
--
ALTER TABLE `produtoras`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `jogos`
--
ALTER TABLE `jogos`
  ADD CONSTRAINT `jogos_ibfk_1` FOREIGN KEY (`genero`) REFERENCES `generos` (`cod`),
  ADD CONSTRAINT `jogos_ibfk_2` FOREIGN KEY (`produtora`) REFERENCES `produtoras` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
