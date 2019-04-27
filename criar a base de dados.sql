-- MySQL Workbench Synchronization
-- Generated: 2019-04-25 16:12
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: rosan

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE TABLE IF NOT EXISTS `mydb`.`Categoria` (
  `Numero_Categoria` INT(11) NOT NULL,
  `Nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Numero_Categoria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Produto` (
  `Numero_Produto` INT(11) NOT NULL,
  `Nome_Produto` VARCHAR(45) NOT NULL,
  `Categoria_Numero_Categoria` INT(11) NOT NULL,
  PRIMARY KEY (`Numero_Produto`),
  INDEX `fk_Produto_Categoria1_idx` (`Categoria_Numero_Categoria` ASC),
  CONSTRAINT `fk_Produto_Categoria1`
    FOREIGN KEY (`Categoria_Numero_Categoria`)
    REFERENCES `mydb`.`Categoria` (`Numero_Categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Produtos_Reservados` (
  `Preço` DECIMAL NOT NULL,
  `Medidas` FLOAT(11) NOT NULL,
  `Quantidade` INT(11) NOT NULL,
  `Produto_Nome_Produto` INT(11) NOT NULL,
  `Reserva_Numero_Reserva` INT(11) NOT NULL,
  INDEX `fk_Produtos_Reservados_Produto1_idx` (`Produto_Nome_Produto` ASC),
  INDEX `fk_Produtos_Reservados_Reserva1_idx` (`Reserva_Numero_Reserva` ASC),
  PRIMARY KEY (`Produto_Nome_Produto`, `Reserva_Numero_Reserva`),
  CONSTRAINT `fk_Produtos_Reservados_Produto1`
    FOREIGN KEY (`Produto_Nome_Produto`)
    REFERENCES `mydb`.`Produto` (`Numero_Produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produtos_Reservados_Reserva1`
    FOREIGN KEY (`Reserva_Numero_Reserva`)
    REFERENCES `mydb`.`Reserva` (`Numero_Reserva`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Reserva` (
  `Numero_Reserva` INT(11) NOT NULL,
  `Data/Hora` DATE NOT NULL,
  `Mensagem_Numero_Mensagem` INT(11) NOT NULL,
  PRIMARY KEY (`Numero_Reserva`),
  INDEX `fk_Reserva_Mensagem1_idx` (`Mensagem_Numero_Mensagem` ASC),
  CONSTRAINT `fk_Reserva_Mensagem1`
    FOREIGN KEY (`Mensagem_Numero_Mensagem`)
    REFERENCES `mydb`.`Mensagem` (`Numero_Mensagem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Utilizador` (
  `Numero_Utilizador` INT(11) NOT NULL,
  `Nome` VARCHAR(45) NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `Endereço` VARCHAR(45) NOT NULL,
  `Tipo_de_Utilizador` VARCHAR(45) NOT NULL,
  `NIF` DECIMAL(9) NOT NULL,
  `Password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Numero_Utilizador`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Mensagem` (
  `Numero_Mensagem` INT(11) NOT NULL,
  `Assunto` VARCHAR(45) NOT NULL,
  `Utilizador_Numero_Utilizador` INT(11) NOT NULL,
  `Data` DATE NOT NULL,
  PRIMARY KEY (`Numero_Mensagem`),
  INDEX `fk_Pedido_Utilizador1_idx` (`Utilizador_Numero_Utilizador` ASC),
  CONSTRAINT `fk_Pedido_Utilizador1`
    FOREIGN KEY (`Utilizador_Numero_Utilizador`)
    REFERENCES `mydb`.`Utilizador` (`Numero_Utilizador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
