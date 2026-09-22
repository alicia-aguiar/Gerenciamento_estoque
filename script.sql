
CREATE DATABASE IF NOT EXISTS `gerenciamento_estoque` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `gerenciamento_estoque`;

-- 1. TABELA DE USUÁRIOS 
CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. TABELA DE PRODUTOS 
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL,
  `valor` DECIMAL(10,2) DEFAULT 0.00,
  `caracteristicas` VARCHAR(255) DEFAULT NULL, -- Cor, Peso, Textura
  `observacao` VARCHAR(255) DEFAULT NULL,      -- Unidade de medida
  `aplicacao` VARCHAR(255) NOT NULL,          -- Fundação, Acabamento, Estrutura
  `qtd_estoque` INT DEFAULT 0,
  `qtd_minima` INT NOT NULL,                   -- Gatilho do alerta automático
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. TABELA DE MOVIMENTAÇÕES 
CREATE TABLE IF NOT EXISTS `movimentacaos` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `produto_id` BIGINT UNSIGNED NOT NULL,
  `user_id` BIGINT UNSIGNED NOT NULL,          -- Identifica o responsável da operação
  `tipo` ENUM('entrada', 'saída') NOT NULL,
  `quantidade` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`produto_id`) REFERENCES `produtos`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Alicia Aguiar', 'alicia@gmail.com', '\$2y\$10\$7R9f6L6w3m1w4m2w5m3w4ueK9bFw9w8w7w6w5w4w3w2w1w0w9w8w7'),
(2, 'Almoxarife Teste', 'almoxarife@gmail.com', '\$2y\$10\$7R9f6L6w3m1w4m2w5m3w4ueK9bFw9w8w7w6w5w4w3w2w1w0w9w8w7');

-- Populando os Produtos (Incluindo variações complexas e estados de estoque)
INSERT INTO `produtos` (`id`, `nome`, `valor`, `caracteristicas`, `observacao`, `aplicacao`, `qtd_estoque`, `qtd_minima`) VALUES
-- Cimento: Caso crítico com estoque regular
(1, 'Cimento CP II Votoran', 35.50, 'Peso: 50kg | Validade: 08/11/2027', 'Saco', 'Fundação', 45, 10),

-- Tinta: Caso crítico com estoque ABAIXO do mínimo (Vai disparar o alerta na interface!)
(2, 'Tinta Acrílica Suvinil Fosca', 280.00, 'Cor: Branco Gelo | Textura: Lisa | Litros: 18L', 'Lata', 'Acabamento', 2, 5),

-- Argamassa: Caso regular
(3, 'Argamassa AC-III Quartzolit', 42.90, 'Peso: 20kg | Cor: Cinza', 'Saco', 'Acabamento', 30, 8),

-- Ferragem: Caso crítico com estoque zerado (Dispara alerta!)
(4, 'Vergalhão de Aço CA-50 Gerdau', 55.00, 'Espessura: 10mm | Comprimento: 12m', 'Barra', 'Estrutura', 0, 15);

-- Populando o Histórico de Movimentações (Rastreabilidade e Auditoria)
INSERT INTO `movimentacaos` (`produto_id`, `user_id`, `tipo`, `quantidade`, `created_at`) VALUES
(1, 1, 'entrada', 50, '2026-09-20 08:30:00'),
(1, 2, 'saída', 5, '2026-09-21 14:15:00'),
(2, 1, 'entrada', 10, '2026-09-18 10:00:00'),
(2, 2, 'saída', 8, '2026-09-22 11:00:00'), -- Movimentação que derrubou o estoque abaixo do mínimo
(3, 1, 'entrada', 30, '2026-09-19 09:45:00');
