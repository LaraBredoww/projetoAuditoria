-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/09/2025 às 00:33
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `auditoria_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `auditoria`
--

CREATE TABLE `auditoria` (
  `auditoria_id` int(11) NOT NULL,
  `data_auditoria` date NOT NULL,
  `responsavel` varchar(100) NOT NULL,
  `observacao_geral` text DEFAULT NULL,
  `email_superior` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `auditoria`
--

INSERT INTO `auditoria` (`auditoria_id`, `data_auditoria`, `responsavel`, `observacao_geral`, `email_superior`) VALUES
(1, '2025-09-14', 'Gabriel João Conti', 'Auditoria de Elicitação de Requisitos - Projeto Tijucas Open', 'gabrielconti5563@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `resposta_auditoria`
--

CREATE TABLE `resposta_auditoria` (
  `resposta_id` int(11) NOT NULL,
  `auditoria_id` int(11) NOT NULL,
  `nome_item` varchar(255) NOT NULL,
  `conforme` enum('Sim','Não') NOT NULL DEFAULT 'Sim',
  `observacao` text DEFAULT NULL,
  `nc_status` enum('Aberta','Em Andamento','Resolvida') DEFAULT 'Aberta',
  `nc_responsavel` varchar(100) DEFAULT NULL,
  `nc_prazo` date DEFAULT NULL,
  `nc_data_resolucao` date DEFAULT NULL,
  `email_enviado` enum('Sim','Não','','') NOT NULL DEFAULT 'Não'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `resposta_auditoria`
--

INSERT INTO `resposta_auditoria` (`resposta_id`, `auditoria_id`, `nome_item`, `conforme`, `observacao`, `nc_status`, `nc_responsavel`, `nc_prazo`, `nc_data_resolucao`, `email_enviado`) VALUES
(1, 1, 'Os requisitos estão documentados de forma clara e compreensível?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(2, 1, 'Todos os requisitos funcionais foram identificados?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(3, 1, 'Todos os requisitos não funcionais foram identificados?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(4, 1, 'Os requisitos estão consistentes, sem contradições?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(5, 1, 'Cada requisito é rastreável a um objetivo de negócio?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(6, 1, 'Os requisitos são completos, sem lacunas importantes?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(7, 1, 'Cada requisito é testável?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(8, 1, 'Os requisitos priorizam funcionalidades críticas para o negócio?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(9, 1, 'Há aprovação formal dos requisitos pelos stakeholders?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(10, 1, 'Os requisitos atendem às normas ou regulamentações aplicáveis?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(11, 1, 'Há requisitos de desempenho bem definidos?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(12, 1, 'Requisitos de segurança e privacidade estão contemplados?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(13, 1, 'Há critérios de aceitação claros para cada requisito?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(14, 1, 'Os requisitos são viáveis tecnicamente?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não'),
(15, 1, 'Mudanças nos requisitos são registradas e controladas?', 'Sim', '', NULL, NULL, NULL, NULL, 'Não');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`auditoria_id`);

--
-- Índices de tabela `resposta_auditoria`
--
ALTER TABLE `resposta_auditoria`
  ADD PRIMARY KEY (`resposta_id`),
  ADD KEY `auditoria_id` (`auditoria_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `auditoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `resposta_auditoria`
--
ALTER TABLE `resposta_auditoria`
  MODIFY `resposta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `resposta_auditoria`
--
ALTER TABLE `resposta_auditoria`
  ADD CONSTRAINT `resposta_auditoria_ibfk_1` FOREIGN KEY (`auditoria_id`) REFERENCES `auditoria` (`auditoria_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
