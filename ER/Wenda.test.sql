SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `wenda` ;
CREATE SCHEMA IF NOT EXISTS `wenda` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `wenda` ;

-- -----------------------------------------------------
-- Table `wenda`.`sf_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wenda`.`sf_user` ;

CREATE  TABLE IF NOT EXISTS `wenda`.`sf_user` (
  `uid` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id' ,
  `username` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '用户名' ,
  `passwd` CHAR(32) NOT NULL DEFAULT '' COMMENT '用户密码' ,
  `ask` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '提问数' ,
  `answer` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '回答数' ,
  `accept` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '采纳数' ,
  `point` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '金币' ,
  `exp` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '经验值' ,
  `face` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '头像' ,
  `restime` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '注册时间' ,
  `logintime` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '登陆时间' ,
  `loginip` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '登陆ip' ,
  `lock` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '0没有被锁定，1为已经锁定' ,
  PRIMARY KEY (`uid`) )
ENGINE = MyISAM
COMMENT = 'sf问答系统用户表';


-- -----------------------------------------------------
-- Table `wenda`.`sf_admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wenda`.`sf_admin` ;

CREATE  TABLE IF NOT EXISTS `wenda`.`sf_admin` (
  `aid` INT UNSIGNED NOT NULL COMMENT '后台用户id' ,
  `username` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '用户名' ,
  `passwd` CHAR(32) NOT NULL DEFAULT '' COMMENT '密码' ,
  `logintime` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '登陆时间' ,
  `loginip` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '登陆ip' ,
  `lock` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'o为没有锁定，1为已经锁定' ,
  PRIMARY KEY (`aid`) )
ENGINE = MyISAM
COMMENT = '后台用户表';


-- -----------------------------------------------------
-- Table `wenda`.`sf_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wenda`.`sf_category` ;

CREATE  TABLE IF NOT EXISTS `wenda`.`sf_category` (
  `cid` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类id' ,
  `title` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '分类名称' ,
  `pid` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级id' ,
  PRIMARY KEY (`cid`) )
ENGINE = MyISAM
COMMENT = '问题分类表';


-- -----------------------------------------------------
-- Table `wenda`.`sf_ask`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wenda`.`sf_ask` ;

CREATE  TABLE IF NOT EXISTS `wenda`.`sf_ask` (
  `asid` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '问题id\n' ,
  `content` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '问题内容' ,
  `time` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '提问时间' ,
  `reward` SMALLINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '悬赏金币' ,
  `answer` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '回答数' ,
  `solve` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '0为没有解决，1为已经解决' ,
  `uid` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '所属用户id' ,
  `cid` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '所属分类id' ,
  PRIMARY KEY (`asid`) ,
  INDEX `fk_sf_ask_sf_user1_idx` (`uid` ASC) ,
  INDEX `fk_sf_ask_sf_category1_idx` (`cid` ASC) )
ENGINE = MyISAM
COMMENT = '提问表';


-- -----------------------------------------------------
-- Table `wenda`.`sf_answer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wenda`.`sf_answer` ;

CREATE  TABLE IF NOT EXISTS `wenda`.`sf_answer` (
  `anid` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '回答id' ,
  `content` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '回答内容' ,
  `time` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '回答时间' ,
  `accept` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '0是没有采纳，1是已经采纳' ,
  `uid` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '所属用户id' ,
  `asid` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '所属问题id' ,
  PRIMARY KEY (`anid`) ,
  INDEX `fk_sf_answer_sf_user_idx` (`uid` ASC) ,
  INDEX `fk_sf_answer_sf_ask1_idx` (`asid` ASC) )
ENGINE = MyISAM
COMMENT = '答案表';

USE `wenda` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
