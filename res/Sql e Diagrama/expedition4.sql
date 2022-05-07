-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `tipo_perfil` INT NULL,
  `login` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cod_cliente` VARCHAR(45) NOT NULL,
  `nome_empresa` VARCHAR(255) NOT NULL,
  `cidade` VARCHAR(255) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `palete`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `palete` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cod_palete` VARCHAR(45) NOT NULL,
  `status` INT NOT NULL,
  `qnt_vagas` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cod_pedido` VARCHAR(45) NOT NULL,
  `horario_entrada` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rota` VARCHAR(45) NULL,
  `palete_id` INT NOT NULL,
  `cliente_id` INT NOT NULL,
  PRIMARY KEY (`id`, `palete_id`, `cliente_id`),
  INDEX `fk_pedido_palete1_idx` (`palete_id` ASC),
  INDEX `fk_pedido_cliente1_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_pedido_palete1`
    FOREIGN KEY (`palete_id`)
    REFERENCES `palete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `doca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `doca` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cod_doca` VARCHAR(45) NOT NULL,
  `status` INT NOT NULL,
  `qnt_vagas` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `docamista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `docamista` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cod_area` VARCHAR(45) NOT NULL,
  `status` INT NOT NULL,
  `qnt_vagas` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rota`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rota` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cod_rota` VARCHAR(45) NOT NULL,
  `origem` VARCHAR(255) NOT NULL,
  `destino` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cod_rota_UNIQUE` (`cod_rota` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `palete_has_doca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `palete_has_doca` (
  `palete_id` INT NOT NULL,
  `doca_id` INT NOT NULL,
  PRIMARY KEY (`palete_id`, `doca_id`),
  INDEX `fk_palete_has_doca_doca1_idx` (`doca_id` ASC),
  INDEX `fk_palete_has_doca_palete1_idx` (`palete_id` ASC),
  CONSTRAINT `fk_palete_has_doca_palete1`
    FOREIGN KEY (`palete_id`)
    REFERENCES `palete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_palete_has_doca_doca1`
    FOREIGN KEY (`doca_id`)
    REFERENCES `doca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `palete_has_docamista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `palete_has_docamista` (
  `palete_id` INT NOT NULL,
  `docamista_id` INT NOT NULL,
  PRIMARY KEY (`palete_id`, `docamista_id`),
  INDEX `fk_palete_has_docamista_docamista1_idx` (`docamista_id` ASC),
  INDEX `fk_palete_has_docamista_palete1_idx` (`palete_id` ASC),
  CONSTRAINT `fk_palete_has_docamista_palete1`
    FOREIGN KEY (`palete_id`)
    REFERENCES `palete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_palete_has_docamista_docamista1`
    FOREIGN KEY (`docamista_id`)
    REFERENCES `docamista` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
