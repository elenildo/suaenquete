-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 19/02/2017 às 22:43
-- Versão do servidor: 10.1.13-MariaDB
-- Versão do PHP: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `suaenquete`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `enquetes`
--

CREATE TABLE `enquetes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `autor` varchar(64) NOT NULL,
  `data` date NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `enquetes`
--

INSERT INTO `enquetes` (`id`, `autor`, `data`, `titulo`, `status`) VALUES
(1, 'Elenildo Carvalho', '2017-02-13', 'Em quem vocÃª votaria para presidente em 2018?', 'Publicado'),
(5, 'Elenildo Santos', '2017-02-16', 'Qual seu time brasileiro favorito?', 'Publicado'),
(6, 'Elenildo Santos', '2017-02-16', 'Qual sua cor favorita?', 'Publicado'),
(12, 'Elenildo Santos', '2017-02-16', 'Qual sua fruta favorita?', 'Publicado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `opcoes`
--

CREATE TABLE `opcoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_enquete` int(11) NOT NULL,
  `opcao` varchar(64) NOT NULL,
  `votos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `opcoes`
--

INSERT INTO `opcoes` (`id`, `id_enquete`, `opcao`, `votos`) VALUES
(24, 6, 'Verde', 7),
(25, 6, 'Amarelo', 3),
(26, 6, 'Azul', 4),
(27, 6, 'Branco', 2),
(28, 5, 'Santos', 1),
(29, 5, 'SÃ£o Paulo', 3),
(30, 5, 'Corinthians', 2),
(31, 5, 'Palmeiras', 1),
(32, 5, 'Chapecoense', 2),
(33, 5, 'TaubatÃ© FC', 0),
(34, 1, 'Jair Bolsomito', 6),
(35, 1, 'JoÃ£o Doria', 2),
(36, 1, 'Levi Fidelix', 2),
(37, 1, 'Sérgio Moro', 3),
(38, 1, 'Geraldo Ackmin', 0),
(39, 12, 'Manga', 2),
(40, 12, 'MaÃ§Ã£', 1),
(41, 12, 'Laranja', 2),
(42, 12, 'Banana', 2),
(43, 12, 'Morango', 2),
(44, 12, 'Uva', 3),
(45, 12, 'MelÃ£o', 3),
(46, 12, 'Abacate', 6),
(47, 12, 'Pera', 0),
(48, 12, 'Melancia', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `login` varchar(64) NOT NULL,
  `senha` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `login`, `senha`) VALUES
(1, 'Elenildo Santos', 'elenildo.dev@gmail.com', 'elenildo', '123');

-- --------------------------------------------------------

--
-- Estrutura para tabela `votacao`
--

CREATE TABLE `votacao` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_enquete` int(11) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `enquetes`
--
ALTER TABLE `enquetes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `opcoes`
--
ALTER TABLE `opcoes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `votacao`
--
ALTER TABLE `votacao`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `enquetes`
--
ALTER TABLE `enquetes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `opcoes`
--
ALTER TABLE `opcoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `votacao`
--
ALTER TABLE `votacao`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
