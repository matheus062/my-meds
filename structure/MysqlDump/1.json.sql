CREATE TABLE `usuario`
(
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `createdAt` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updatedAt` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `nome`      VARCHAR(150) NOT NULL,
    `rg`        VARCHAR(25)  NULL UNIQUE,
    `cpf`       VARCHAR(14)  NOT NULL UNIQUE,
    `endereco`  TEXT         NULL,
    `telefone`  VARCHAR(254) NULL,
    `email`     VARCHAR(254) NULL,
    `username`  VARCHAR(254) NOT NULL UNIQUE,
    `password`  VARCHAR(254) NOT NULL
);
