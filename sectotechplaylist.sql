-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Jan-2022 às 16:23
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sectotechplaylist`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin_usuarios`
--

CREATE TABLE `tb_admin_usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_admin_usuarios`
--

INSERT INTO `tb_admin_usuarios` (`id`, `usuario`, `senha`, `img`, `nome`, `id_perfil`, `order_id`) VALUES
(8, 'contato@dropscode.com.br', 'admin', '612e69c3552e1.jpg', 'Drops.code', 1, 1),
(9, 'edmurgsjr@hotmail.com', 'admin', '612e677b7de10.jpg', 'Edmur G Silva Jr', 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site_conteudos`
--

CREATE TABLE `tb_site_conteudos` (
  `id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `urldescricao` varchar(255) NOT NULL,
  `author` varchar(150) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_site_conteudos`
--

INSERT INTO `tb_site_conteudos` (`id`, `playlist_id`, `title`, `urldescricao`, `author`, `order_id`, `created_at`, `updated_at`) VALUES
(21, 4, 'titulo01', 'url01', 'autor01', 1, '2022-01-12 23:45:06', '2022-01-12 23:49:58'),
(22, 7, 'titulo02', 'url02', 'autor02', 3, '2022-01-12 23:45:06', '2022-01-12 23:49:58'),
(23, 8, 'titulo03', 'url03', 'autor03', 4, '2022-01-12 23:45:06', '2022-01-13 00:29:14'),
(24, 9, 'titulo04', 'url04', 'autor04', 6, '2022-01-12 23:45:06', '2022-01-12 23:49:58'),
(25, 4, 'titulo05', 'url05', 'autor05', 2, '2022-01-12 23:45:06', '2022-01-13 00:34:04'),
(26, 8, 'titulo06', 'url06', 'autor06', 5, '2022-01-12 23:46:48', '2022-01-12 23:49:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site_perfis`
--

CREATE TABLE `tb_site_perfis` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_site_perfis`
--

INSERT INTO `tb_site_perfis` (`id`, `descricao`) VALUES
(1, 'Administrador'),
(2, 'Usuário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site_playlists`
--

CREATE TABLE `tb_site_playlists` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `author` varchar(150) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_site_playlists`
--

INSERT INTO `tb_site_playlists` (`id`, `title`, `description`, `author`, `order_id`, `created_at`, `updated_at`) VALUES
(4, 'teste01', 'descricao01', 'autor01', 1, '2022-01-12 19:04:38', '2022-01-12 22:45:43'),
(7, 'teste02', 'descrição02', 'autor02', 2, '2022-01-12 19:04:38', '2022-01-12 21:11:56'),
(8, 'teste03', 'descrição03', 'autor03', 3, '2022-01-12 19:04:38', '2022-01-13 00:29:25'),
(9, 'teste04', 'dewcrição04', 'autor04', 4, '2022-01-12 19:18:42', '2022-01-12 20:50:53'),
(10, 'teste05', 'descrição05', 'autor05', 5, '2022-01-12 19:27:28', '2022-01-12 20:51:17'),
(11, 'teste06', 'descrição06', 'autor06', 6, '2022-01-12 19:48:28', '2022-01-12 20:51:41'),
(12, 'teste08', 'descrição08', 'autor08', 8, '2022-01-12 20:13:52', '2022-01-12 20:52:34'),
(13, 'teste07', 'descrição07', 'autor07', 7, '2022-01-12 20:17:10', '2022-01-12 20:52:08'),
(14, 'titulo09', 'descrição09', 'autor09', 9, '2022-01-12 20:53:56', '2022-01-12 20:53:56'),
(15, 'titulo10', 'descrição10', 'autor10', 10, '2022-01-12 20:54:20', '2022-01-13 13:25:13'),
(17, 'titulo11', 'descrição11', 'autor11', 11, '2022-01-13 13:25:34', '2022-01-13 13:25:34');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_admin_usuarios`
--
ALTER TABLE `tb_admin_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site_conteudos`
--
ALTER TABLE `tb_site_conteudos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site_perfis`
--
ALTER TABLE `tb_site_perfis`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site_playlists`
--
ALTER TABLE `tb_site_playlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_admin_usuarios`
--
ALTER TABLE `tb_admin_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_site_conteudos`
--
ALTER TABLE `tb_site_conteudos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `tb_site_perfis`
--
ALTER TABLE `tb_site_perfis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_site_playlists`
--
ALTER TABLE `tb_site_playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
