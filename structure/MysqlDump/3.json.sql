CREATE TABLE `agenda`
(
    `id`           INT AUTO_INCREMENT PRIMARY KEY,
    `createdAt`    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updatedAt`    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `paciente`     INT       NOT NULL,
    `dataConsulta` TIMESTAMP NOT NULL,
    CONSTRAINT fk_agenda_paciente_paciente FOREIGN KEY (`paciente`) REFERENCES `paciente` (`id`)
);

CREATE TABLE `receita`
(
    `id`           INT AUTO_INCREMENT PRIMARY KEY,
    `createdAt`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updatedAt`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `codigoUnico`  VARCHAR(32)  NOT NULL,
    `dataEmissao`  TIMESTAMP    NOT NULL,
    `tipoEspecial` VARCHAR(254) NULL,
    `observacoes`  VARCHAR(254) NULL,
    `resgatada`    BOOLEAN      NOT NULL
);

CREATE TABLE `lembrete`
(
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `createdAt` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updatedAt` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `dataHora`  TIMESTAMP    NOT NULL,
    `mensagem`  VARCHAR(254) NOT NULL
);

CREATE TABLE `paciente_receita`
(
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `paciente`  INT       NOT NULL,
    `receita`   INT       NOT NULL,
    CONSTRAINT fk_paciente_receita_paciente_paciente FOREIGN KEY (`paciente`) REFERENCES `paciente` (`id`),
    CONSTRAINT fk_paciente_receita_receita_receita FOREIGN KEY (`receita`) REFERENCES `receita` (`id`)
);

CREATE TABLE `paciente_lembrete`
(
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `paciente`  INT       NOT NULL,
    `lembrete`  INT       NOT NULL,
    CONSTRAINT fk_paciente_lembrete_paciente_paciente FOREIGN KEY (`paciente`) REFERENCES `paciente` (`id`),
    CONSTRAINT fk_paciente_lembrete_lembrete_lembrete FOREIGN KEY (`lembrete`) REFERENCES `lembrete` (`id`)
);
