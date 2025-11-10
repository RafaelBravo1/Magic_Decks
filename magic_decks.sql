-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/11/2025 às 19:22
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
-- Banco de dados: `magic_decks`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cartas`
--

CREATE TABLE `cartas` (
  `id_carta` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `raridade` int(11) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `tipo` varchar(250) NOT NULL,
  `custo` varchar(250) NOT NULL,
  `branco` tinyint(1) NOT NULL,
  `preto` tinyint(1) NOT NULL,
  `verde` tinyint(1) NOT NULL,
  `vermelho` tinyint(1) NOT NULL,
  `azul` tinyint(1) NOT NULL,
  `cinza` tinyint(1) NOT NULL,
  `preco` varchar(250) NOT NULL,
  `imagem` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cartas`
--

INSERT INTO `cartas` (`id_carta`, `nome`, `raridade`, `descricao`, `tipo`, `custo`, `branco`, `preto`, `verde`, `vermelho`, `azul`, `cinza`, `preco`, `imagem`) VALUES
(4, 'Ceasar, Legion’s Emperor', 1, 'Descrição: Sempre que atacar, voce pode sacrificar outra criatura. Quando fizer escolha dois: Crie dois Tokens Criaturas Soldados VERMELHO-BRANCO com impeto que estão viradas e atacando Você saca uma carta e perde 1 de vida. Ceasar, Legion’s Emperor causa dano igual ao numero de Tokens criatura que você controla ao oponente alvo', '7', '4', 1, 1, 0, 1, 0, 1, '90', 'cartas/cesar.jpg'),
(6, 'Butch DeLoria, Tunnel Snake', 3, 'Tunnel Snakes Rule! - Whenever Butch DeLoria, Tunnel Snake attacks, it gets +1/+1 until end of turn for each other Rogue and/or Snake you control. 1(incolor)1(black): Put a menance counter on another target creature. It becomes a Rogue in addition to its other types.', '1', '2', 0, 1, 0, 0, 0, 0, '1', 'cartas/6908fe2025b79.jpg'),
(7, 'Gary Clone', 3, 'Squad 2. Whenever Gary Clone attacks, each creature you control named Gary Clone gets +1/+0 until end of turn', '1', '2', 1, 0, 0, 0, 0, 0, '2', 'cartas/6908ff989f309.jpg'),
(8, 'General\'s Enforcer', 3, 'Legendary Humans you Control have indestructible. 2(incolor) 1(white)1(black):Exile target card from a graveyard. If it was a creature card, create a 1/1 white Human Soldier creature token.', '1', '2', 1, 1, 0, 0, 0, 0, '1', 'cartas/6909041b651d2.jpg'),
(10, 'Tântis, a Tecedora de Guerras', 1, 'Vigilancia, alcance. Todas as criaturas atacam a cada combate se estiver aptas. Toda vez que uma criatura atacar você ou um planeswalker que você controla, coloque um marcador +1/+1 em Tântis, a Tecedora de Guerras', '7', '6', 0, 1, 1, 1, 0, 1, '23', 'cartas/69121ef041776.jpg'),
(11, 'Arcane Signet', 3, '⤵️:add one mana of any color in your commander\'s color identity', '5', '2', 0, 0, 0, 0, 0, 1, '6', 'cartas/69121b0aa4280.jpg'),
(12, 'Colonel Autumn', 2, 'LIfe link. Exploit.  Other legendary creatures you control have exploit', '7', '3', 1, 1, 0, 0, 0, 1, '1', 'cartas/69121d8a6b652.jpg'),
(14, 'Carta Placeholder 1', 4, 'Descrição aleatória da carta número 1', '7', '8', 1, 1, 1, 0, 0, 0, '20', 'cartas/690b9280a8603.jpg'),
(15, 'Tainted Field', 3, '⤵️: add 1(incolor).⤵️add 1(white) or 1(black). Activate only if you control a Swamp )', '6', '0', 0, 0, 0, 0, 0, 0, '6', 'cartas/690e2d9039286.jpg'),
(16, 'Carta Placeholder 3', 1, 'Descrição aleatória da carta número 3', '1', '6', 1, 0, 0, 0, 0, 0, '5', 'cartas/690b9280a8603.jpg'),
(18, 'Carta Placeholder 5', 4, 'Descrição aleatória da carta número 5', '4', '10', 0, 1, 1, 1, 0, 0, '3', 'cartas/690b9280a8603.jpg'),
(19, 'Carta Placeholder 6', 4, 'Descrição aleatória da carta número 6', '4', '10', 0, 0, 0, 0, 0, 0, '18', 'cartas/690b9280a8603.jpg'),
(20, 'Carta Placeholder 7', 1, 'Descrição aleatória da carta número 7', '4', '6', 0, 0, 1, 1, 1, 0, '34', 'cartas/690b9280a8603.jpg'),
(21, 'Carta Placeholder 8', 6, 'Descrição aleatória da carta número 8', '1', '9', 1, 1, 0, 0, 0, 0, '2', 'cartas/690b9280a8603.jpg'),
(22, 'Carta Placeholder 9', 3, 'Descrição aleatória da carta número 9', '3', '4', 0, 1, 0, 0, 0, 0, '1', 'cartas/690b9280a8603.jpg'),
(23, 'Carta Placeholder 10', 4, 'Descrição aleatória da carta número 10', '5', '3', 1, 0, 1, 0, 1, 0, '2', 'cartas/690b9280a8603.jpg'),
(24, 'Carta Placeholder 11', 6, 'Descrição aleatória da carta número 11', '5', '5', 0, 1, 1, 0, 0, 0, '26', 'cartas/690b9280a8603.jpg'),
(25, 'Carta Placeholder 12', 2, 'Descrição aleatória da carta número 12', '5', '9', 1, 0, 1, 0, 1, 0, '25', 'cartas/690b9280a8603.jpg'),
(26, 'Carta Placeholder 13', 5, 'Descrição aleatória da carta número 13', '4', '4', 1, 1, 0, 1, 0, 0, '20', 'cartas/690b9280a8603.jpg'),
(27, 'Carta Placeholder 14', 6, 'Descrição aleatória da carta número 14', '2', '0', 1, 1, 0, 1, 0, 0, '37', 'cartas/690b9280a8603.jpg'),
(28, 'Carta Placeholder 15', 1, 'Descrição aleatória da carta número 15', '1', '1', 0, 0, 1, 0, 0, 0, '34', 'cartas/690b9280a8603.jpg'),
(29, 'Carta Placeholder 16', 6, 'Descrição aleatória da carta número 16', '3', '5', 0, 1, 0, 1, 1, 0, '30', 'cartas/690b9280a8603.jpg'),
(30, 'Carta Placeholder 17', 2, 'Descrição aleatória da carta número 17', '4', '7', 0, 0, 0, 0, 0, 0, '34', 'cartas/690b9280a8603.jpg'),
(31, 'Carta Placeholder 18', 4, 'Descrição aleatória da carta número 18', '4', '8', 0, 0, 0, 1, 1, 0, '1', 'cartas/690b9280a8603.jpg'),
(33, 'Carta Placeholder 20', 1, 'Descrição aleatória da carta número 20', '3', '5', 0, 0, 0, 0, 0, 0, '20', 'cartas/690b9280a8603.jpg'),
(34, 'Forest', 4, '🌲', '6', '1', 0, 0, 1, 0, 0, 0, '1', 'cartas/69121f8a4e9f1.jpg'),
(35, 'Carta Placeholder 22', 5, 'Descrição aleatória da carta número 22', '7', '8', 0, 0, 0, 0, 0, 0, '4', 'cartas/690b9280a8603.jpg'),
(36, 'Carta Placeholder 23', 6, 'Descrição aleatória da carta número 23', '7', '8', 0, 0, 0, 0, 0, 0, '27', 'cartas/690b9280a8603.jpg'),
(37, 'Carta Placeholder 24', 2, 'Descrição aleatória da carta número 24', '2', '8', 0, 0, 0, 1, 0, 0, '20', 'cartas/690b9280a8603.jpg'),
(38, 'Carta Placeholder 25', 2, 'Descrição aleatória da carta número 25', '3', '4', 1, 0, 0, 0, 0, 0, '18', 'cartas/690b9280a8603.jpg'),
(39, 'Carta Placeholder 26', 5, 'Descrição aleatória da carta número 26', '4', '10', 1, 1, 0, 1, 0, 0, '18', 'cartas/690b9280a8603.jpg'),
(40, 'Carta Placeholder 27', 5, 'Descrição aleatória da carta número 27', '1', '5', 0, 0, 0, 0, 0, 0, '45', 'cartas/690b9280a8603.jpg'),
(41, 'Carta Placeholder 28', 6, 'Descrição aleatória da carta número 28', '5', '8', 0, 0, 1, 1, 1, 0, '2', 'cartas/690b9280a8603.jpg'),
(42, 'Carta Placeholder 29', 6, 'Descrição aleatória da carta número 29', '1', '8', 0, 0, 0, 1, 1, 0, '20', 'cartas/690b9280a8603.jpg'),
(43, 'Carta Placeholder 30', 1, 'Descrição aleatória da carta número 30', '4', '5', 0, 0, 1, 0, 0, 0, '20', 'cartas/690b9280a8603.jpg'),
(44, 'Carta Placeholder 31', 1, 'Descrição aleatória da carta número 31', '2', '2', 0, 1, 1, 1, 0, 0, '14', 'cartas/690b9280a8603.jpg'),
(46, 'Carta Placeholder 33', 6, 'Descrição aleatória da carta número 33', '3', '8', 0, 1, 1, 1, 0, 0, '12', 'cartas/690b9280a8603.jpg'),
(47, 'Island', 4, 'Descrição aleatória da carta número 34', '6', '1', 0, 0, 0, 0, 1, 0, '1', 'cartas/691220188c29c.jpg'),
(48, 'Carta Placeholder 35', 2, 'Descrição aleatória da carta número 35', '2', '5', 0, 1, 1, 1, 0, 0, '16', 'cartas/690b9280a8603.jpg'),
(49, 'Montanha', 4, '🔥', '6', '1', 0, 0, 0, 1, 0, 0, '1', 'cartas/691221751cf77.jpg'),
(50, 'Carta Placeholder 37', 4, 'Descrição aleatória da carta número 37', '6', '6', 0, 0, 0, 0, 1, 0, '3', 'cartas/690b9280a8603.jpg'),
(51, 'Carta Placeholder 38', 6, 'Descrição aleatória da carta número 38', '4', '7', 0, 0, 0, 0, 0, 0, '19', 'cartas/690b9280a8603.jpg'),
(52, 'Carta Placeholder 39', 1, 'Descrição aleatória da carta número 39', '7', '6', 0, 0, 1, 0, 1, 0, '29', 'cartas/690b9280a8603.jpg'),
(53, 'Carta Placeholder 40', 1, 'Descrição aleatória da carta número 40', '3', '6', 0, 1, 0, 1, 0, 0, '39', 'cartas/690b9280a8603.jpg'),
(54, 'Carta Placeholder 41', 3, 'Descrição aleatória da carta número 41', '3', '7', 1, 0, 0, 0, 0, 0, '36', 'cartas/690b9280a8603.jpg'),
(55, 'Carta Placeholder 42', 6, 'Descrição aleatória da carta número 42', '1', '6', 0, 0, 0, 0, 0, 0, '2', 'cartas/690b9280a8603.jpg'),
(56, 'Carta Placeholder 43', 2, 'Descrição aleatória da carta número 43', '6', '1', 1, 0, 0, 0, 0, 0, '33', 'cartas/690b9280a8603.jpg'),
(57, 'Carta Placeholder 44', 1, 'Descrição aleatória da carta número 44', '3', '10', 0, 1, 0, 0, 1, 0, '40', 'cartas/690b9280a8603.jpg'),
(58, 'Carta Placeholder 45', 5, 'Descrição aleatória da carta número 45', '2', '10', 1, 0, 0, 0, 1, 0, '7', 'cartas/690b9280a8603.jpg'),
(59, 'Carta Placeholder 46', 3, 'Descrição aleatória da carta número 46', '6', '4', 1, 0, 0, 0, 1, 0, '6', 'cartas/690b9280a8603.jpg'),
(60, 'Carta Placeholder 47', 3, 'Descrição aleatória da carta número 47', '1', '4', 0, 0, 0, 0, 0, 0, '16', 'cartas/690b9280a8603.jpg'),
(61, 'Carta Placeholder 48', 4, 'Descrição aleatória da carta número 48', '4', '9', 0, 1, 1, 1, 0, 0, '8', 'cartas/690b9280a8603.jpg'),
(62, 'Carta Placeholder 49', 2, 'Descrição aleatória da carta número 49', '4', '8', 1, 0, 1, 1, 0, 0, '12', 'cartas/690b9280a8603.jpg'),
(63, 'Carta Placeholder 50', 4, 'Descrição aleatória da carta número 50', '2', '4', 0, 0, 0, 0, 0, 0, '42', 'cartas/690b9280a8603.jpg'),
(64, 'Carta Placeholder 51', 4, 'Descrição aleatória da carta número 51', '6', '1', 0, 0, 0, 0, 0, 1, '27', 'cartas/690b9280a8603.jpg'),
(65, 'Carta Placeholder 52', 3, 'Descrição aleatória da carta número 52', '3', '2', 0, 0, 1, 0, 0, 0, '37', 'cartas/690b9280a8603.jpg'),
(66, 'Carta Placeholder 53', 5, 'Descrição aleatória da carta número 53', '2', '4', 1, 0, 0, 1, 1, 0, '37', 'cartas/690b9280a8603.jpg'),
(67, 'Carta Placeholder 54', 5, 'Descrição aleatória da carta número 54', '6', '10', 0, 0, 0, 1, 1, 0, '22', 'cartas/690b9280a8603.jpg'),
(68, 'Carta Placeholder 55', 2, 'Descrição aleatória da carta número 55', '1', '5', 0, 0, 0, 0, 0, 0, '6', 'cartas/690b9280a8603.jpg'),
(69, 'Carta Placeholder 56', 1, 'Descrição aleatória da carta número 56', '1', '3', 0, 1, 0, 0, 1, 0, '9', 'cartas/690b9280a8603.jpg'),
(70, 'Carta Placeholder 57', 4, 'Descrição aleatória da carta número 57', '6', '10', 0, 0, 0, 1, 0, 0, '24', 'cartas/690b9280a8603.jpg'),
(71, 'Carta Placeholder 58', 3, 'Descrição aleatória da carta número 58', '7', '1', 1, 1, 0, 1, 0, 0, '10', 'cartas/690b9280a8603.jpg'),
(72, 'Carta Placeholder 59', 1, 'Descrição aleatória da carta número 59', '3', '7', 0, 0, 0, 0, 0, 0, '1', 'cartas/690b9280a8603.jpg'),
(73, 'Carta Placeholder 60', 1, 'Descrição aleatória da carta número 60', '7', '4', 1, 0, 0, 0, 0, 0, '1', 'cartas/690b9280a8603.jpg'),
(74, 'Carta Placeholder 61', 2, 'Descrição aleatória da carta número 61', '1', '6', 1, 0, 0, 1, 1, 0, '18', 'cartas/690b9280a8603.jpg'),
(75, 'Carta Placeholder 62', 2, 'Descrição aleatória da carta número 62', '6', '6', 0, 0, 0, 0, 0, 1, '6', 'cartas/690b9280a8603.jpg'),
(76, 'Carta Placeholder 63', 1, 'Descrição aleatória da carta número 63', '5', '1', 0, 1, 1, 1, 0, 0, '24', 'cartas/690b9280a8603.jpg'),
(77, 'Carta Placeholder 64', 3, 'Descrição aleatória da carta número 64', '4', '3', 0, 1, 0, 1, 0, 0, '3', 'cartas/690b9280a8603.jpg'),
(78, 'Carta Placeholder 65', 4, 'Descrição aleatória da carta número 65', '1', '4', 1, 0, 0, 1, 1, 0, '5', 'cartas/690b9280a8603.jpg'),
(79, 'Carta Placeholder 66', 5, 'Descrição aleatória da carta número 66', '6', '8', 0, 1, 1, 0, 0, 0, '5', 'cartas/690b9280a8603.jpg'),
(80, 'Carta Placeholder 67', 1, 'Descrição aleatória da carta número 67', '5', '7', 0, 0, 0, 1, 0, 0, '5', 'cartas/690b9280a8603.jpg'),
(81, 'Carta Placeholder 68', 4, 'Descrição aleatória da carta número 68', '3', '3', 0, 0, 0, 0, 0, 0, '7', 'cartas/690b9280a8603.jpg'),
(82, 'Carta Placeholder 69', 1, 'Descrição aleatória da carta número 69', '6', '2', 0, 0, 1, 1, 0, 0, '32', 'cartas/690b9280a8603.jpg'),
(83, 'Carta Placeholder 70', 4, 'Descrição aleatória da carta número 70', '2', '6', 0, 0, 1, 1, 1, 0, '49', 'cartas/690b9280a8603.jpg'),
(84, 'Carta Placeholder 71', 1, 'Descrição aleatória da carta número 71', '4', '4', 0, 0, 1, 0, 0, 0, '24', 'cartas/690b9280a8603.jpg'),
(85, 'Carta Placeholder 72', 6, 'Descrição aleatória da carta número 72', '4', '2', 1, 1, 0, 0, 1, 0, '30', 'cartas/690b9280a8603.jpg'),
(86, 'Carta Placeholder 73', 3, 'Descrição aleatória da carta número 73', '7', '9', 0, 0, 1, 0, 0, 0, '24', 'cartas/690b9280a8603.jpg'),
(87, 'Carta Placeholder 74', 5, 'Descrição aleatória da carta número 74', '7', '8', 0, 0, 0, 0, 0, 0, '27', 'cartas/690b9280a8603.jpg'),
(88, 'Carta Placeholder 75', 3, 'Descrição aleatória da carta número 75', '1', '4', 0, 0, 1, 1, 1, 0, '34', 'cartas/690b9280a8603.jpg'),
(89, 'Carta Placeholder 76', 5, 'Descrição aleatória da carta número 76', '1', '1', 1, 1, 1, 0, 0, 0, '36', 'cartas/690b9280a8603.jpg'),
(90, 'Carta Placeholder 77', 1, 'Descrição aleatória da carta número 77', '7', '9', 0, 1, 0, 0, 0, 0, '42', 'cartas/690b9280a8603.jpg'),
(91, 'Carta Placeholder 78', 3, 'Descrição aleatória da carta número 78', '4', '7', 0, 0, 1, 0, 0, 0, '16', 'cartas/690b9280a8603.jpg'),
(92, 'Carta Placeholder 79', 1, 'Descrição aleatória da carta número 79', '7', '1', 0, 1, 1, 0, 0, 0, '39', 'cartas/690b9280a8603.jpg'),
(93, 'Carta Placeholder 80', 4, 'Descrição aleatória da carta número 80', '5', '3', 0, 1, 1, 0, 0, 0, '46', 'cartas/690b9280a8603.jpg'),
(94, 'Carta Placeholder 81', 3, 'Descrição aleatória da carta número 81', '6', '7', 0, 0, 0, 0, 0, 1, '6', 'cartas/690b9280a8603.jpg'),
(95, 'Carta Placeholder 82', 2, 'Descrição aleatória da carta número 82', '6', '7', 1, 0, 1, 0, 1, 0, '18', 'cartas/690b9280a8603.jpg'),
(96, 'Carta Placeholder 83', 3, 'Descrição aleatória da carta número 83', '3', '9', 0, 0, 0, 0, 0, 0, '18', 'cartas/690b9280a8603.jpg'),
(97, 'Carta Placeholder 84', 6, 'Descrição aleatória da carta número 84', '4', '1', 0, 0, 0, 0, 0, 0, '16', 'cartas/690b9280a8603.jpg'),
(98, 'Carta Placeholder 85', 1, 'Descrição aleatória da carta número 85', '3', '5', 0, 0, 0, 0, 0, 0, '29', 'cartas/690b9280a8603.jpg'),
(99, 'Carta Placeholder 86', 2, 'Descrição aleatória da carta número 86', '7', '1', 0, 0, 0, 0, 0, 0, '9', 'cartas/690b9280a8603.jpg'),
(100, 'Carta Placeholder 87', 1, 'Descrição aleatória da carta número 87', '6', '3', 0, 1, 1, 0, 0, 0, '41', 'cartas/690b9280a8603.jpg'),
(101, 'Carta Placeholder 88', 4, 'Descrição aleatória da carta número 88', '1', '8', 1, 1, 1, 0, 0, 0, '14', 'cartas/690b9280a8603.jpg'),
(102, 'Carta Placeholder 89', 1, 'Descrição aleatória da carta número 89', '4', '1', 1, 1, 0, 1, 0, 0, '17', 'cartas/690b9280a8603.jpg'),
(103, 'Carta Placeholder 90', 6, 'Descrição aleatória da carta número 90', '4', '2', 0, 0, 1, 0, 0, 0, '28', 'cartas/690b9280a8603.jpg'),
(104, 'Carta Placeholder 91', 5, 'Descrição aleatória da carta número 91', '7', '6', 0, 1, 0, 0, 0, 0, '37', 'cartas/690b9280a8603.jpg'),
(105, 'Carta Placeholder 92', 5, 'Descrição aleatória da carta número 92', '7', '5', 1, 1, 0, 0, 0, 0, '10', 'cartas/690b9280a8603.jpg'),
(106, 'Carta Placeholder 93', 1, 'Descrição aleatória da carta número 93', '5', '8', 0, 0, 0, 0, 0, 1, '48', 'cartas/690b9280a8603.jpg'),
(107, 'Carta Placeholder 94', 1, 'Descrição aleatória da carta número 94', '5', '4', 0, 1, 0, 0, 0, 0, '18', 'cartas/690b9280a8603.jpg'),
(108, 'Carta Placeholder 95', 6, 'Descrição aleatória da carta número 95', '3', '3', 0, 0, 0, 0, 1, 0, '35', 'cartas/690b9280a8603.jpg'),
(109, 'Carta Placeholder 96', 5, 'Descrição aleatória da carta número 96', '2', '10', 0, 1, 1, 0, 1, 0, '21', 'cartas/690b9280a8603.jpg'),
(110, 'Carta Placeholder 97', 5, 'Descrição aleatória da carta número 97', '4', '3', 0, 0, 0, 0, 0, 0, '4', 'cartas/690b9280a8603.jpg'),
(111, 'Carta Placeholder 98', 5, 'Descrição aleatória da carta número 98', '1', '6', 1, 0, 0, 0, 0, 0, '4', 'cartas/690b9280a8603.jpg'),
(112, 'Carta Placeholder 99', 5, 'Descrição aleatória da carta número 99', '5', '1', 0, 0, 1, 0, 1, 0, '3', 'cartas/690b9280a8603.jpg'),
(113, 'Carta Placeholder 100', 4, 'Descrição aleatória da carta número 100', '5', '2', 0, 0, 0, 0, 0, 1, '33', 'cartas/690b9280a8603.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `decks`
--

CREATE TABLE `decks` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `commander_id` varchar(50) NOT NULL,
  `cartas_json` longtext NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `decks`
--

INSERT INTO `decks` (`id`, `nome`, `user_id`, `commander_id`, `cartas_json`, `data_criacao`) VALUES
(1, 'Cesar Teste', 2, '4', '{\"6\":{\"id\":\"6\",\"nome\":\"Butch DeLoria, Tunnel Snake\",\"imagem\":\"cartas\\/6908fe2025b79.jpg\",\"quantidade\":1},\"27\":{\"id\":\"27\",\"nome\":\"Carta Placeholder 14\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"63\":{\"id\":\"63\",\"nome\":\"Carta Placeholder 50\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"16\":{\"id\":\"16\",\"nome\":\"Carta Placeholder 3\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"40\":{\"id\":\"40\",\"nome\":\"Carta Placeholder 27\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"32\":{\"id\":\"32\",\"nome\":\"Carta Placeholder 19\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":7},\"60\":{\"id\":\"60\",\"nome\":\"Carta Placeholder 47\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"37\":{\"id\":\"37\",\"nome\":\"Carta Placeholder 24\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"55\":{\"id\":\"55\",\"nome\":\"Carta Placeholder 42\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"68\":{\"id\":\"68\",\"nome\":\"Carta Placeholder 55\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"21\":{\"id\":\"21\",\"nome\":\"Carta Placeholder 8\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"111\":{\"id\":\"111\",\"nome\":\"Carta Placeholder 98\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"7\":{\"id\":\"7\",\"nome\":\"Gary Clone\",\"imagem\":\"cartas\\/6908ff989f309.jpg\",\"quantidade\":1},\"8\":{\"id\":\"8\",\"nome\":\"General\",\"imagem\":\"cartas\\/6909041b651d2.jpg\",\"quantidade\":1},\"38\":{\"id\":\"38\",\"nome\":\"Carta Placeholder 25\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"33\":{\"id\":\"33\",\"nome\":\"Carta Placeholder 20\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"26\":{\"id\":\"26\",\"nome\":\"Carta Placeholder 13\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"80\":{\"id\":\"80\",\"nome\":\"Carta Placeholder 67\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"53\":{\"id\":\"53\",\"nome\":\"Carta Placeholder 40\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"113\":{\"id\":\"113\",\"nome\":\"Carta Placeholder 100\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"96\":{\"id\":\"96\",\"nome\":\"Carta Placeholder 83\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"106\":{\"id\":\"106\",\"nome\":\"Carta Placeholder 93\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"54\":{\"id\":\"54\",\"nome\":\"Carta Placeholder 41\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"22\":{\"id\":\"22\",\"nome\":\"Carta Placeholder 9\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"98\":{\"id\":\"98\",\"nome\":\"Carta Placeholder 85\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"94\":{\"id\":\"94\",\"nome\":\"Carta Placeholder 81\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":9},\"30\":{\"id\":\"30\",\"nome\":\"Carta Placeholder 17\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"107\":{\"id\":\"107\",\"nome\":\"Carta Placeholder 94\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"72\":{\"id\":\"72\",\"nome\":\"Carta Placeholder 59\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"81\":{\"id\":\"81\",\"nome\":\"Carta Placeholder 68\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"110\":{\"id\":\"110\",\"nome\":\"Carta Placeholder 97\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"15\":{\"id\":\"15\",\"nome\":\"Carta Placeholder 2\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"64\":{\"id\":\"64\",\"nome\":\"Carta Placeholder 51\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"70\":{\"id\":\"70\",\"nome\":\"Carta Placeholder 57\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":2},\"75\":{\"id\":\"75\",\"nome\":\"Carta Placeholder 62\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"56\":{\"id\":\"56\",\"nome\":\"Carta Placeholder 43\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":40},\"97\":{\"id\":\"97\",\"nome\":\"Carta Placeholder 84\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"49\":{\"id\":\"49\",\"nome\":\"Carta Placeholder 36\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":5},\"39\":{\"id\":\"39\",\"nome\":\"Carta Placeholder 26\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"51\":{\"id\":\"51\",\"nome\":\"Carta Placeholder 38\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"47\":{\"id\":\"47\",\"nome\":\"Carta Placeholder 34\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1}}', '2025-11-06 18:09:19'),
(2, 'Ceas', 2, '4', '{\"27\":{\"id\":\"27\",\"nome\":\"Carta Placeholder 14\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"63\":{\"id\":\"63\",\"nome\":\"Carta Placeholder 50\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"16\":{\"id\":\"16\",\"nome\":\"Carta Placeholder 3\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"40\":{\"id\":\"40\",\"nome\":\"Carta Placeholder 27\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"32\":{\"id\":\"32\",\"nome\":\"Carta Placeholder 19\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":7},\"60\":{\"id\":\"60\",\"nome\":\"Carta Placeholder 47\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"37\":{\"id\":\"37\",\"nome\":\"Carta Placeholder 24\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"55\":{\"id\":\"55\",\"nome\":\"Carta Placeholder 42\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"68\":{\"id\":\"68\",\"nome\":\"Carta Placeholder 55\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"21\":{\"id\":\"21\",\"nome\":\"Carta Placeholder 8\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"111\":{\"id\":\"111\",\"nome\":\"Carta Placeholder 98\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"7\":{\"id\":\"7\",\"nome\":\"Gary Clone\",\"imagem\":\"cartas\\/6908ff989f309.jpg\",\"quantidade\":1},\"38\":{\"id\":\"38\",\"nome\":\"Carta Placeholder 25\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"33\":{\"id\":\"33\",\"nome\":\"Carta Placeholder 20\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"26\":{\"id\":\"26\",\"nome\":\"Carta Placeholder 13\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"80\":{\"id\":\"80\",\"nome\":\"Carta Placeholder 67\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"53\":{\"id\":\"53\",\"nome\":\"Carta Placeholder 40\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"113\":{\"id\":\"113\",\"nome\":\"Carta Placeholder 100\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"96\":{\"id\":\"96\",\"nome\":\"Carta Placeholder 83\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"106\":{\"id\":\"106\",\"nome\":\"Carta Placeholder 93\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"54\":{\"id\":\"54\",\"nome\":\"Carta Placeholder 41\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"22\":{\"id\":\"22\",\"nome\":\"Carta Placeholder 9\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"98\":{\"id\":\"98\",\"nome\":\"Carta Placeholder 85\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"94\":{\"id\":\"94\",\"nome\":\"Carta Placeholder 81\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":9},\"30\":{\"id\":\"30\",\"nome\":\"Carta Placeholder 17\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"107\":{\"id\":\"107\",\"nome\":\"Carta Placeholder 94\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"72\":{\"id\":\"72\",\"nome\":\"Carta Placeholder 59\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"81\":{\"id\":\"81\",\"nome\":\"Carta Placeholder 68\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"110\":{\"id\":\"110\",\"nome\":\"Carta Placeholder 97\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"15\":{\"id\":\"15\",\"nome\":\"Carta Placeholder 2\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"64\":{\"id\":\"64\",\"nome\":\"Carta Placeholder 51\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"70\":{\"id\":\"70\",\"nome\":\"Carta Placeholder 57\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":2},\"75\":{\"id\":\"75\",\"nome\":\"Carta Placeholder 62\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"56\":{\"id\":\"56\",\"nome\":\"Carta Placeholder 43\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":40},\"97\":{\"id\":\"97\",\"nome\":\"Carta Placeholder 84\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"49\":{\"id\":\"49\",\"nome\":\"Carta Placeholder 36\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":5},\"39\":{\"id\":\"39\",\"nome\":\"Carta Placeholder 26\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"51\":{\"id\":\"51\",\"nome\":\"Carta Placeholder 38\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"47\":{\"id\":\"47\",\"nome\":\"Carta Placeholder 34\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"102\":{\"id\":\"102\",\"nome\":\"Carta Placeholder 89\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"77\":{\"id\":\"77\",\"nome\":\"Carta Placeholder 64\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1}}', '2025-11-06 18:09:57'),
(3, 'aaaa', 2, '4', '{\"27\":{\"id\":\"27\",\"nome\":\"Carta Placeholder 14\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"63\":{\"id\":\"63\",\"nome\":\"Carta Placeholder 50\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"16\":{\"id\":\"16\",\"nome\":\"Carta Placeholder 3\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"40\":{\"id\":\"40\",\"nome\":\"Carta Placeholder 27\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"32\":{\"id\":\"32\",\"nome\":\"Carta Placeholder 19\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":7},\"60\":{\"id\":\"60\",\"nome\":\"Carta Placeholder 47\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"37\":{\"id\":\"37\",\"nome\":\"Carta Placeholder 24\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"55\":{\"id\":\"55\",\"nome\":\"Carta Placeholder 42\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"68\":{\"id\":\"68\",\"nome\":\"Carta Placeholder 55\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"21\":{\"id\":\"21\",\"nome\":\"Carta Placeholder 8\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"111\":{\"id\":\"111\",\"nome\":\"Carta Placeholder 98\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"7\":{\"id\":\"7\",\"nome\":\"Gary Clone\",\"imagem\":\"cartas\\/6908ff989f309.jpg\",\"quantidade\":1},\"38\":{\"id\":\"38\",\"nome\":\"Carta Placeholder 25\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"33\":{\"id\":\"33\",\"nome\":\"Carta Placeholder 20\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"26\":{\"id\":\"26\",\"nome\":\"Carta Placeholder 13\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"80\":{\"id\":\"80\",\"nome\":\"Carta Placeholder 67\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"53\":{\"id\":\"53\",\"nome\":\"Carta Placeholder 40\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"113\":{\"id\":\"113\",\"nome\":\"Carta Placeholder 100\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"96\":{\"id\":\"96\",\"nome\":\"Carta Placeholder 83\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"106\":{\"id\":\"106\",\"nome\":\"Carta Placeholder 93\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"54\":{\"id\":\"54\",\"nome\":\"Carta Placeholder 41\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"22\":{\"id\":\"22\",\"nome\":\"Carta Placeholder 9\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"98\":{\"id\":\"98\",\"nome\":\"Carta Placeholder 85\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"94\":{\"id\":\"94\",\"nome\":\"Carta Placeholder 81\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":9},\"30\":{\"id\":\"30\",\"nome\":\"Carta Placeholder 17\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"107\":{\"id\":\"107\",\"nome\":\"Carta Placeholder 94\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"72\":{\"id\":\"72\",\"nome\":\"Carta Placeholder 59\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"81\":{\"id\":\"81\",\"nome\":\"Carta Placeholder 68\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"110\":{\"id\":\"110\",\"nome\":\"Carta Placeholder 97\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"15\":{\"id\":\"15\",\"nome\":\"Carta Placeholder 2\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"64\":{\"id\":\"64\",\"nome\":\"Carta Placeholder 51\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"70\":{\"id\":\"70\",\"nome\":\"Carta Placeholder 57\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":2},\"75\":{\"id\":\"75\",\"nome\":\"Carta Placeholder 62\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"56\":{\"id\":\"56\",\"nome\":\"Carta Placeholder 43\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":40},\"97\":{\"id\":\"97\",\"nome\":\"Carta Placeholder 84\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"49\":{\"id\":\"49\",\"nome\":\"Carta Placeholder 36\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":5},\"39\":{\"id\":\"39\",\"nome\":\"Carta Placeholder 26\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"51\":{\"id\":\"51\",\"nome\":\"Carta Placeholder 38\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"47\":{\"id\":\"47\",\"nome\":\"Carta Placeholder 34\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"102\":{\"id\":\"102\",\"nome\":\"Carta Placeholder 89\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"77\":{\"id\":\"77\",\"nome\":\"Carta Placeholder 64\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1}}', '2025-11-06 18:18:58'),
(4, 'aaa', 2, '4', '{\"27\":{\"id\":\"27\",\"nome\":\"Carta Placeholder 14\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"63\":{\"id\":\"63\",\"nome\":\"Carta Placeholder 50\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"16\":{\"id\":\"16\",\"nome\":\"Carta Placeholder 3\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"40\":{\"id\":\"40\",\"nome\":\"Carta Placeholder 27\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"32\":{\"id\":\"32\",\"nome\":\"Carta Placeholder 19\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":7},\"60\":{\"id\":\"60\",\"nome\":\"Carta Placeholder 47\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"37\":{\"id\":\"37\",\"nome\":\"Carta Placeholder 24\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"55\":{\"id\":\"55\",\"nome\":\"Carta Placeholder 42\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"68\":{\"id\":\"68\",\"nome\":\"Carta Placeholder 55\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"21\":{\"id\":\"21\",\"nome\":\"Carta Placeholder 8\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"111\":{\"id\":\"111\",\"nome\":\"Carta Placeholder 98\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"7\":{\"id\":\"7\",\"nome\":\"Gary Clone\",\"imagem\":\"cartas\\/6908ff989f309.jpg\",\"quantidade\":1},\"38\":{\"id\":\"38\",\"nome\":\"Carta Placeholder 25\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"33\":{\"id\":\"33\",\"nome\":\"Carta Placeholder 20\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"26\":{\"id\":\"26\",\"nome\":\"Carta Placeholder 13\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"80\":{\"id\":\"80\",\"nome\":\"Carta Placeholder 67\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"53\":{\"id\":\"53\",\"nome\":\"Carta Placeholder 40\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"113\":{\"id\":\"113\",\"nome\":\"Carta Placeholder 100\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"96\":{\"id\":\"96\",\"nome\":\"Carta Placeholder 83\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"106\":{\"id\":\"106\",\"nome\":\"Carta Placeholder 93\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"54\":{\"id\":\"54\",\"nome\":\"Carta Placeholder 41\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"22\":{\"id\":\"22\",\"nome\":\"Carta Placeholder 9\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"98\":{\"id\":\"98\",\"nome\":\"Carta Placeholder 85\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"94\":{\"id\":\"94\",\"nome\":\"Carta Placeholder 81\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":9},\"30\":{\"id\":\"30\",\"nome\":\"Carta Placeholder 17\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"107\":{\"id\":\"107\",\"nome\":\"Carta Placeholder 94\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"72\":{\"id\":\"72\",\"nome\":\"Carta Placeholder 59\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"81\":{\"id\":\"81\",\"nome\":\"Carta Placeholder 68\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"110\":{\"id\":\"110\",\"nome\":\"Carta Placeholder 97\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"15\":{\"id\":\"15\",\"nome\":\"Carta Placeholder 2\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"64\":{\"id\":\"64\",\"nome\":\"Carta Placeholder 51\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"70\":{\"id\":\"70\",\"nome\":\"Carta Placeholder 57\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":2},\"75\":{\"id\":\"75\",\"nome\":\"Carta Placeholder 62\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"56\":{\"id\":\"56\",\"nome\":\"Carta Placeholder 43\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":40},\"97\":{\"id\":\"97\",\"nome\":\"Carta Placeholder 84\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"49\":{\"id\":\"49\",\"nome\":\"Carta Placeholder 36\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":5},\"39\":{\"id\":\"39\",\"nome\":\"Carta Placeholder 26\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"51\":{\"id\":\"51\",\"nome\":\"Carta Placeholder 38\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"47\":{\"id\":\"47\",\"nome\":\"Carta Placeholder 34\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"102\":{\"id\":\"102\",\"nome\":\"Carta Placeholder 89\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"77\":{\"id\":\"77\",\"nome\":\"Carta Placeholder 64\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1}}', '2025-11-06 18:19:26'),
(5, 'agora vai', 2, '4', '{\"27\":{\"id\":\"27\",\"nome\":\"Carta Placeholder 14\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"63\":{\"id\":\"63\",\"nome\":\"Carta Placeholder 50\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"16\":{\"id\":\"16\",\"nome\":\"Carta Placeholder 3\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"40\":{\"id\":\"40\",\"nome\":\"Carta Placeholder 27\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"32\":{\"id\":\"32\",\"nome\":\"Carta Placeholder 19\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":7},\"60\":{\"id\":\"60\",\"nome\":\"Carta Placeholder 47\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"37\":{\"id\":\"37\",\"nome\":\"Carta Placeholder 24\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"55\":{\"id\":\"55\",\"nome\":\"Carta Placeholder 42\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"68\":{\"id\":\"68\",\"nome\":\"Carta Placeholder 55\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"21\":{\"id\":\"21\",\"nome\":\"Carta Placeholder 8\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"111\":{\"id\":\"111\",\"nome\":\"Carta Placeholder 98\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"7\":{\"id\":\"7\",\"nome\":\"Gary Clone\",\"imagem\":\"cartas\\/6908ff989f309.jpg\",\"quantidade\":1},\"38\":{\"id\":\"38\",\"nome\":\"Carta Placeholder 25\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"33\":{\"id\":\"33\",\"nome\":\"Carta Placeholder 20\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"26\":{\"id\":\"26\",\"nome\":\"Carta Placeholder 13\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"80\":{\"id\":\"80\",\"nome\":\"Carta Placeholder 67\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"53\":{\"id\":\"53\",\"nome\":\"Carta Placeholder 40\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"113\":{\"id\":\"113\",\"nome\":\"Carta Placeholder 100\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"96\":{\"id\":\"96\",\"nome\":\"Carta Placeholder 83\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"106\":{\"id\":\"106\",\"nome\":\"Carta Placeholder 93\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"54\":{\"id\":\"54\",\"nome\":\"Carta Placeholder 41\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"22\":{\"id\":\"22\",\"nome\":\"Carta Placeholder 9\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"98\":{\"id\":\"98\",\"nome\":\"Carta Placeholder 85\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"94\":{\"id\":\"94\",\"nome\":\"Carta Placeholder 81\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":9},\"30\":{\"id\":\"30\",\"nome\":\"Carta Placeholder 17\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"107\":{\"id\":\"107\",\"nome\":\"Carta Placeholder 94\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"72\":{\"id\":\"72\",\"nome\":\"Carta Placeholder 59\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"81\":{\"id\":\"81\",\"nome\":\"Carta Placeholder 68\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"110\":{\"id\":\"110\",\"nome\":\"Carta Placeholder 97\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"15\":{\"id\":\"15\",\"nome\":\"Carta Placeholder 2\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"64\":{\"id\":\"64\",\"nome\":\"Carta Placeholder 51\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"70\":{\"id\":\"70\",\"nome\":\"Carta Placeholder 57\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":2},\"75\":{\"id\":\"75\",\"nome\":\"Carta Placeholder 62\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"56\":{\"id\":\"56\",\"nome\":\"Carta Placeholder 43\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":40},\"97\":{\"id\":\"97\",\"nome\":\"Carta Placeholder 84\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"49\":{\"id\":\"49\",\"nome\":\"Carta Placeholder 36\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":5},\"39\":{\"id\":\"39\",\"nome\":\"Carta Placeholder 26\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"51\":{\"id\":\"51\",\"nome\":\"Carta Placeholder 38\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"47\":{\"id\":\"47\",\"nome\":\"Carta Placeholder 34\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"102\":{\"id\":\"102\",\"nome\":\"Carta Placeholder 89\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"77\":{\"id\":\"77\",\"nome\":\"Carta Placeholder 64\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1}}', '2025-11-06 18:21:18'),
(6, 'teste 2', 2, '10', '{\"58\":{\"id\":\"58\",\"nome\":\"Carta Placeholder 45\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"83\":{\"id\":\"83\",\"nome\":\"Carta Placeholder 70\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"49\":{\"id\":\"49\",\"nome\":\"Carta Placeholder 36\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":97}}', '2025-11-06 18:41:46'),
(7, 'Teste 2', 3, '10', '{\"27\":{\"id\":\"27\",\"nome\":\"Carta Placeholder 14\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"48\":{\"id\":\"48\",\"nome\":\"Carta Placeholder 35\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"58\":{\"id\":\"58\",\"nome\":\"Carta Placeholder 45\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"79\":{\"id\":\"79\",\"nome\":\"Carta Placeholder 66\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":95},\"16\":{\"id\":\"16\",\"nome\":\"Carta Placeholder 3\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1}}', '2025-11-07 17:07:54'),
(8, 'terrenos', 3, '10', '{\"32\":{\"id\":\"32\",\"nome\":\"Carta Placeholder 19\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":99}}', '2025-11-07 17:12:38'),
(9, 'teste professor salvo', 2, '4', '{\"8\":{\"id\":\"8\",\"nome\":\"General\'s Enforcer\",\"imagem\":\"cartas\\/6909041b651d2.jpg\",\"quantidade\":1},\"15\":{\"id\":\"15\",\"nome\":\"Tainted Field\",\"imagem\":\"cartas\\/690e2d9039286.jpg\",\"quantidade\":92},\"40\":{\"id\":\"40\",\"nome\":\"Carta Placeholder 27\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"37\":{\"id\":\"37\",\"nome\":\"Carta Placeholder 24\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"63\":{\"id\":\"63\",\"nome\":\"Carta Placeholder 50\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"16\":{\"id\":\"16\",\"nome\":\"Carta Placeholder 3\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"27\":{\"id\":\"27\",\"nome\":\"Carta Placeholder 14\",\"imagem\":\"cartas\\/690b9280a8603.jpg\",\"quantidade\":1},\"7\":{\"id\":\"7\",\"nome\":\"Gary Clone\",\"imagem\":\"cartas\\/6908ff989f309.jpg\",\"quantidade\":1}}', '2025-11-07 18:02:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id_usuario` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `nome_de_usuario` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `hash` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`id_usuario`, `nivel`, `nome_de_usuario`, `email`, `hash`) VALUES
(1, 1, 'a', 'a@aa', '$2y$10$6xM/ky4/r9QhvqHspaqt4O2tdw9TEKWJWz3kquf8tZWrpEc/WP10O'),
(2, 1, 'teste', 'teste@teste', '$2y$10$GdctPMZ87JNCsdIyeIQaRuHfYo5NZz1n1VW7P47NWox2mKvjFs70y'),
(3, 3, 'testeadm', 'teste@adm', '$2y$10$gCgCgwZFIw2ikBaHSNFg0e7l/ulvf8teaV2b43EJQDfGux3tRJDGK');

-- --------------------------------------------------------

--
-- Estrutura para tabela `raridade`
--

CREATE TABLE `raridade` (
  `id_raridade` int(11) NOT NULL,
  `raridade` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `raridade`
--

INSERT INTO `raridade` (`id_raridade`, `raridade`) VALUES
(1, 'Mítica'),
(2, 'Rara'),
(3, 'Incomum'),
(4, 'Comum'),
(5, 'Especial'),
(6, 'Token');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL,
  `Tipo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `Tipo`) VALUES
(1, 'Criatura'),
(2, 'Planeswalker'),
(3, 'Mágica Instantânea'),
(4, 'Feitiço'),
(5, 'Artefatos'),
(6, 'Terreno'),
(7, 'Criatura Lendária');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cartas`
--
ALTER TABLE `cartas`
  ADD PRIMARY KEY (`id_carta`);

--
-- Índices de tabela `decks`
--
ALTER TABLE `decks`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nome_de_usuario` (`nome_de_usuario`);

--
-- Índices de tabela `raridade`
--
ALTER TABLE `raridade`
  ADD PRIMARY KEY (`id_raridade`);

--
-- Índices de tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cartas`
--
ALTER TABLE `cartas`
  MODIFY `id_carta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de tabela `decks`
--
ALTER TABLE `decks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `raridade`
--
ALTER TABLE `raridade`
  MODIFY `id_raridade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
