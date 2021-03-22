-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 22-Mar-2021 às 07:55
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `desafio_gigapixel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `id_despesa` int(11) NOT NULL,
  `descricao` varchar(1500) NOT NULL,
  `valor` double NOT NULL,
  `data` date NOT NULL,
  `email_usuario` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`id_despesa`, `descricao`, `valor`, `data`, `email_usuario`) VALUES
(4, 'Compra do mês.', 900, '2021-03-24', 'nandamoreira945@gmail.com'),
(7, 'Farmácia', 78.5, '2021-03-08', 'nandamoreira945@gmail.com'),
(8, 'Médico', 150, '2021-03-16', 'nandamoreira945@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recebimentos`
--

CREATE TABLE `recebimentos` (
  `id_recebimento` int(11) NOT NULL,
  `proveniencia` varchar(1000) NOT NULL,
  `valor` double NOT NULL,
  `data` date NOT NULL,
  `email_usuario` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `recebimentos`
--

INSERT INTO `recebimentos` (`id_recebimento`, `proveniencia`, `valor`, `data`, `email_usuario`) VALUES
(6, 'Ambev', 2500, '2021-05-01', 'nandamoreira945@gmail.com'),
(7, 'Embraer', 5000, '2021-04-16', 'nandamoreira945@gmail.com'),
(8, 'Anatel', 1500, '2021-03-09', 'nandamoreira945@gmail.com'),
(12, 'Vivo', 15, '2021-04-03', 'nandamoreira945@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(250) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `data_nascimento` date NOT NULL,
  `profissao` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `frase_senha` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`email`, `nome`, `data_nascimento`, `profissao`, `senha`, `frase_senha`) VALUES
('juferreira@gmail.com', 'Júlia Ferreira', '2002-04-02', 'Técnica em Administração', '02042002', 'Meu aniversário!'),
('nandamoreira945@gmail.com', 'Amanda Moreira', '2002-05-06', 'Técnica em Informática', '1234', 'Sequência de quatro números e começa no 1!');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id_despesa`),
  ADD KEY `email_usuario` (`email_usuario`);

--
-- Índices para tabela `recebimentos`
--
ALTER TABLE `recebimentos`
  ADD PRIMARY KEY (`id_recebimento`),
  ADD KEY `email_usuario` (`email_usuario`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id_despesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `recebimentos`
--
ALTER TABLE `recebimentos`
  MODIFY `id_recebimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `despesas`
--
ALTER TABLE `despesas`
  ADD CONSTRAINT `despesas_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuarios` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `recebimentos`
--
ALTER TABLE `recebimentos`
  ADD CONSTRAINT `recebimentos_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuarios` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
