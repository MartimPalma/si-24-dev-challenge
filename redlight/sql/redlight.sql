-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jun-2024 às 13:12
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `redlight`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `id_cidades` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `ref_paises` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`id_cidades`, `nome`, `ref_paises`) VALUES
(1, 'Coimbra', 1),
(2, 'Porto', 1),
(3, 'Lisboa', 1),
(4, 'Braga', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `francesinhas`
--

CREATE TABLE `francesinhas` (
  `id_francesinhas` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(5,2) NOT NULL,
  `capa` varchar(45) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `deleted` int(1) DEFAULT 0,
  `pontuacao` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `francesinhas`
--

INSERT INTO `francesinhas` (`id_francesinhas`, `nome`, `preco`, `capa`, `descricao`, `deleted`, `pontuacao`) VALUES
(1, 'Tradicional', 9.99, 'fran_1.jpg', 'A Francesinha Tradicional é a essência da tradição portuense. Este prato icônico captura a verdadeira alma da gastronomia do Porto, oferecendo uma experiência rica e reconfortante com o seu sabor inconfundível.', 0, 1),
(2, 'Moderna', 14.99, 'fran_2.jpg', 'É uma variação sofisticada. É uma escolha perfeita para os amantes de comida contemporânea, proporcionando uma nova dimensão a esta tradicional delícia.', 0, 4),
(3, 'Á Porto', 8.50, 'fran_3.jpg', 'A Francesinha à Porto é o prato emblemático da cidade do Porto. Famosa pelo seu sabor robusto e reconfortante, esta versão captura a essência da culinária portuense, oferecendo uma experiência gastronômica autêntica e inesquecível.', 0, 5),
(4, 'Mega Francesinha', 13.99, 'fran_4.jpg', 'A Francesinha Mega é a escolha perfeita para quem tem um grande apetite. Esta versão ampliada do clássico prato portuense é carregada com porções generosas de cada ingrediente, proporcionando uma experiência gastronômica épica e satisfatória que fará qualquer um sair da mesa plenamente satisfeito.', 0, 3),
(5, 'Chicken Francesinha', 12.99, 'fran_5.jpg', 'A Francesinha à Porto de Frango é uma versão mais leve que preserva o sabor intenso da receita original. Perfeita para quem prefere uma opção mais leve, esta francesinha oferece uma combinação equilibrada e deliciosa.', 0, 4),
(6, 'Omelet francesinha', 12.99, 'fran_6.jpg', 'A Francesinha Omelete é uma interpretação única e criativa do clássico prato português. Nesta versão, a tradicional francesinha é complementada com uma deliciosa omelete, adicionando uma textura macia e um sabor reconfortante ao prato. Combinando o melhor de dois mundos culinários, esta criação oferece uma experiência gastronômica memorável e satisfatória.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 0, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `francesinhas_restaurantes`
--

CREATE TABLE `francesinhas_restaurantes` (
  `ref_francesinhas` int(11) NOT NULL,
  `ref_restaurantes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `francesinhas_restaurantes`
--

INSERT INTO `francesinhas_restaurantes` (`ref_francesinhas`, `ref_restaurantes`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 1),
(3, 2),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 5),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(6, 1),
(6, 3),
(6, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `francesinhas_votacao`
--

CREATE TABLE `francesinhas_votacao` (
  `ref_utilizadores` int(11) NOT NULL,
  `ref_francesinhas` int(11) NOT NULL,
  `data_insercao` datetime NOT NULL,
  `votacao` varchar(1) NOT NULL,
  `pontuacao` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `francesinhas_votacao`
--

INSERT INTO `francesinhas_votacao` (`ref_utilizadores`, `ref_francesinhas`, `data_insercao`, `votacao`, `pontuacao`) VALUES
(6, 1, '2024-05-27 22:19:49', '4', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id_ingredientes` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `ingredientes`
--

INSERT INTO `ingredientes` (`id_ingredientes`, `nome`) VALUES
(1, 'Pão'),
(2, 'Queijo'),
(3, 'Carne'),
(4, 'Fiambre'),
(5, 'Bacon'),
(6, 'Molho'),
(7, 'Salsicha'),
(8, 'Ovo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingredientes_francesinhas`
--

CREATE TABLE `ingredientes_francesinhas` (
  `ref_ingredientes` int(11) NOT NULL,
  `ref_francesinhas` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `ingredientes_francesinhas`
--

INSERT INTO `ingredientes_francesinhas` (`ref_ingredientes`, `ref_francesinhas`, `quantidade`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(2, 1, 1),
(2, 2, 1),
(2, 3, 1),
(3, 1, 1),
(3, 3, 1),
(4, 1, 1),
(4, 2, 1),
(4, 3, 1),
(5, 1, 1),
(6, 1, 1),
(6, 2, 1),
(6, 3, 1),
(7, 1, 1),
(7, 3, 1),
(8, 1, 1),
(8, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `paises`
--

CREATE TABLE `paises` (
  `id_paises` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `paises`
--

INSERT INTO `paises` (`id_paises`, `nome`) VALUES
(1, 'Portugal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

CREATE TABLE `perfis` (
  `id_perfis` int(11) NOT NULL,
  `perfil` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`id_perfis`, `perfil`) VALUES
(1, 'administrador'),
(2, 'utilizador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `restaurantes`
--

CREATE TABLE `restaurantes` (
  `id_restaurantes` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `ref_cidades` int(11) NOT NULL,
  `capa` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `pontuacao` float DEFAULT 0,
  `deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `restaurantes`
--

INSERT INTO `restaurantes` (`id_restaurantes`, `nome`, `endereco`, `ref_cidades`, `capa`, `descricao`, `pontuacao`, `deleted`) VALUES
(1, 'Francesinha Gourmet', 'Rua 25 de Abril', 1, 'res_1.jpg', ' No \"Francesinha Gourmet\", elevamos a icônica francesinha a novos patamares. Utilizando ingredientes premium e um toque de sofisticação, cada prato é uma obra de arte. Perfeito para quem procura uma experiência gastronômica única, o nosso ambiente acolhedor e moderno é o lugar ideal para saborear uma francesinha reinventada.', 3, 0),
(2, 'A Francesa ', 'Rua da Liberdade', 2, 'res_2.jpg', 'Bem-vindo ao \"A Francesa\", onde honramos a rica herança culinária do Porto. A nossa especialidade é a francesinha, feita com uma receita autêntica que passa de geração em geração. Com um molho secreto e ingredientes frescos, proporcionamos uma experiência gastronômica que vai além do paladar. Venha provar a verdadeira essência do Porto em cada mordida.', 4, 0),
(3, 'Sabor do Porto', 'Clérigos', 2, 'res_3.jpg', '\"Sabor do Porto\" é um tributo à tradicional francesinha, trazendo o sabor inconfundível desta delícia portuense para sua mesa. o nosso segredo está no molho caseiro, preparado com ingredientes frescos e temperos especiais. Venha nos visitar e descubra porque a nossa francesinha é tão apreciada pelos locais e turistas.', 2, 0),
(4, 'Francesinha & Companhia', 'Ponte de Maio', 3, 'res_4.jpg', 'Em \"Francesinha & Companhia\", celebramos a união de amigos, família e boa comida. Nossa francesinha, feita com amor e ingredientes selecionados, é o prato principal que une todos à mesa. Desfrute de um ambiente descontraído e acolhedor enquanto se delicia com uma das melhores francesinhas da cidade.', 5, 0),
(5, 'Cantinho das Francesinhas', 'Rua das Padeiras 88, 3000-311', 2, 'res_5.jpg', 'No coração da cidade, \"Cantinho das Francesinhas\" é o refúgio dos amantes da boa comida. Nossa francesinha é preparada com carinho e dedicação, garantindo sabores autênticos e inesquecíveis. Com um ambiente familiar e acolhedor, prometemos uma refeição que vai conquistar seu coração e seu paladar.', 3, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `restaurantes_votacao`
--

CREATE TABLE `restaurantes_votacao` (
  `ref_utilizadores` int(11) NOT NULL,
  `ref_restaurantes` int(11) NOT NULL,
  `data_insercao` datetime NOT NULL,
  `pontuacao` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id_utilizadores` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `data_insercao` datetime NOT NULL,
  `ref_perfis` int(11) NOT NULL DEFAULT 2,
  `login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id_utilizadores`, `nome`, `email`, `password_hash`, `data_insercao`, `ref_perfis`, `login`) VALUES
(6, 'Martim', 'martimpalma@ua.pt', '$2y$10$KjEqWi8LYF8T.n9kXXLISuj7B74GmJ0hAMsqN13ytKOaIxKPHnGT.', '0000-00-00 00:00:00', 2, 'Martimuser'),
(7, 'Martim', 'martimpalma222@ua.pt', '$2y$10$QPdXyxZIzgVqt5xmX4CW1e83kY6aGI8DbzCs7kqw5faOF25w.k0e2', '0000-00-00 00:00:00', 1, 'Martimadmin');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id_cidades`),
  ADD UNIQUE KEY `idcidades_UNIQUE` (`id_cidades`),
  ADD KEY `fk_cidades_paises1_idx` (`ref_paises`);

--
-- Índices para tabela `francesinhas`
--
ALTER TABLE `francesinhas`
  ADD PRIMARY KEY (`id_francesinhas`),
  ADD UNIQUE KEY `idfrancesinhas_UNIQUE` (`id_francesinhas`);

--
-- Índices para tabela `francesinhas_restaurantes`
--
ALTER TABLE `francesinhas_restaurantes`
  ADD PRIMARY KEY (`ref_francesinhas`,`ref_restaurantes`),
  ADD KEY `fk_francesinhas_has_restaurantes_restaurantes1_idx` (`ref_restaurantes`),
  ADD KEY `fk_francesinhas_has_restaurantes_francesinhas1_idx` (`ref_francesinhas`);

--
-- Índices para tabela `francesinhas_votacao`
--
ALTER TABLE `francesinhas_votacao`
  ADD PRIMARY KEY (`ref_utilizadores`,`ref_francesinhas`),
  ADD KEY `fk_utilizadores_has_francesinhas_francesinhas1_idx` (`ref_francesinhas`),
  ADD KEY `fk_utilizadores_has_francesinhas_utilizadores1_idx` (`ref_utilizadores`);

--
-- Índices para tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id_ingredientes`),
  ADD UNIQUE KEY `idingredientes_UNIQUE` (`id_ingredientes`);

--
-- Índices para tabela `ingredientes_francesinhas`
--
ALTER TABLE `ingredientes_francesinhas`
  ADD PRIMARY KEY (`ref_ingredientes`,`ref_francesinhas`),
  ADD KEY `fk_ingredientes_has_francesinhas_francesinhas1_idx` (`ref_francesinhas`),
  ADD KEY `fk_ingredientes_has_francesinhas_ingredientes1_idx` (`ref_ingredientes`);

--
-- Índices para tabela `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id_paises`),
  ADD UNIQUE KEY `idpaises_UNIQUE` (`id_paises`);

--
-- Índices para tabela `perfis`
--
ALTER TABLE `perfis`
  ADD PRIMARY KEY (`id_perfis`),
  ADD UNIQUE KEY `idperfis_UNIQUE` (`id_perfis`);

--
-- Índices para tabela `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id_restaurantes`),
  ADD UNIQUE KEY `idrestaurantes_UNIQUE` (`id_restaurantes`),
  ADD KEY `fk_restaurantes_cidades1_idx` (`ref_cidades`);

--
-- Índices para tabela `restaurantes_votacao`
--
ALTER TABLE `restaurantes_votacao`
  ADD PRIMARY KEY (`ref_utilizadores`,`ref_restaurantes`),
  ADD KEY `fk_utilizadores_has_restaurantes_restaurantes1_idx` (`ref_restaurantes`),
  ADD KEY `fk_utilizadores_has_restaurantes_utilizadores1_idx` (`ref_utilizadores`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id_utilizadores`),
  ADD UNIQUE KEY `idutilizadores_UNIQUE` (`id_utilizadores`),
  ADD KEY `fk_utilizadores_perfis_idx` (`ref_perfis`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id_cidades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `francesinhas`
--
ALTER TABLE `francesinhas`
  MODIFY `id_francesinhas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id_ingredientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `paises`
--
ALTER TABLE `paises`
  MODIFY `id_paises` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `perfis`
--
ALTER TABLE `perfis`
  MODIFY `id_perfis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `id_restaurantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id_utilizadores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cidades`
--
ALTER TABLE `cidades`
  ADD CONSTRAINT `fk_cidades_paises1` FOREIGN KEY (`ref_paises`) REFERENCES `paises` (`id_paises`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `francesinhas_restaurantes`
--
ALTER TABLE `francesinhas_restaurantes`
  ADD CONSTRAINT `fk_francesinhas_has_restaurantes_francesinhas1` FOREIGN KEY (`ref_francesinhas`) REFERENCES `francesinhas` (`id_francesinhas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_francesinhas_has_restaurantes_restaurantes1` FOREIGN KEY (`ref_restaurantes`) REFERENCES `restaurantes` (`id_restaurantes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `francesinhas_votacao`
--
ALTER TABLE `francesinhas_votacao`
  ADD CONSTRAINT `fk_utilizadores_has_francesinhas_francesinhas1` FOREIGN KEY (`ref_francesinhas`) REFERENCES `francesinhas` (`id_francesinhas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilizadores_has_francesinhas_utilizadores1` FOREIGN KEY (`ref_utilizadores`) REFERENCES `utilizadores` (`id_utilizadores`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ingredientes_francesinhas`
--
ALTER TABLE `ingredientes_francesinhas`
  ADD CONSTRAINT `fk_ingredientes_has_francesinhas_francesinhas1` FOREIGN KEY (`ref_francesinhas`) REFERENCES `francesinhas` (`id_francesinhas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ingredientes_has_francesinhas_ingredientes1` FOREIGN KEY (`ref_ingredientes`) REFERENCES `ingredientes` (`id_ingredientes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD CONSTRAINT `fk_restaurantes_cidades1` FOREIGN KEY (`ref_cidades`) REFERENCES `cidades` (`id_cidades`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `restaurantes_votacao`
--
ALTER TABLE `restaurantes_votacao`
  ADD CONSTRAINT `fk_utilizadores_has_restaurantes_restaurantes1` FOREIGN KEY (`ref_restaurantes`) REFERENCES `restaurantes` (`id_restaurantes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilizadores_has_restaurantes_utilizadores1` FOREIGN KEY (`ref_utilizadores`) REFERENCES `utilizadores` (`id_utilizadores`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD CONSTRAINT `fk_utilizadores_perfis` FOREIGN KEY (`ref_perfis`) REFERENCES `perfis` (`id_perfis`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
