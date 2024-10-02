CREATE TABLE `medico`
(
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `createdAt` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updatedAt` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `usuario`   INT          NOT NULL UNIQUE,
    `crm`       VARCHAR(254) NOT NULL UNIQUE,
    CONSTRAINT fk_medico_usuario_usuario FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`)
);

CREATE TABLE `farmaceutico`
(
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `createdAt` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updatedAt` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `usuario`   INT          NOT NULL UNIQUE,
    `empresa`   VARCHAR(254) NOT NULL UNIQUE,
    CONSTRAINT fk_farmaceutico_usuario_usuario FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`)
);

CREATE TABLE `paciente`
(
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `usuario`   INT       NOT NULL UNIQUE,
    CONSTRAINT fk_paciente_usuario_usuario FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`)
);
