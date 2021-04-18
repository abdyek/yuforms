
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- member
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `confirmed_email` TINYINT(1) NOT NULL,
    `password_hash` VARCHAR(60) NOT NULL,
    `activation_code` VARCHAR(6) NOT NULL,
    `recovery_code` VARCHAR(10),
    `have_to_2fa` TINYINT(1) DEFAULT 0 NOT NULL,
    `sign_up_date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- form
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `form`;

CREATE TABLE `form`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `create_date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_edit_date_time` DATETIME,
    `is_template` TINYINT(1) DEFAULT 0 NOT NULL,
    `member_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `form_fi_672062` (`member_id`),
    CONSTRAINT `form_fk_672062`
        FOREIGN KEY (`member_id`)
        REFERENCES `member` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- share
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `share`;

CREATE TABLE `share`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `start_date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `stop_date_time` DATETIME,
    `onlyMember` TINYINT(1) DEFAULT 1 NOT NULL,
    `submit_count` INTEGER DEFAULT 0 NOT NULL,
    `form_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `share_fi_ee8551` (`form_id`),
    CONSTRAINT `share_fk_ee8551`
        FOREIGN KEY (`form_id`)
        REFERENCES `form` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- submit
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `submit`;

CREATE TABLE `submit`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `response` VARCHAR(256) NOT NULL,
    `multi_response` TINYINT(1) DEFAULT 0 NOT NULL,
    `ip_address` VARCHAR(15),
    `form_item_id` INTEGER NOT NULL,
    `share_id` INTEGER NOT NULL,
    `member_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `submit_fi_2b1f8a` (`form_item_id`),
    INDEX `submit_fi_97be49` (`share_id`),
    INDEX `submit_fi_672062` (`member_id`),
    CONSTRAINT `submit_fk_2b1f8a`
        FOREIGN KEY (`form_item_id`)
        REFERENCES `form_item` (`id`),
    CONSTRAINT `submit_fk_97be49`
        FOREIGN KEY (`share_id`)
        REFERENCES `share` (`id`),
    CONSTRAINT `submit_fk_672062`
        FOREIGN KEY (`member_id`)
        REFERENCES `member` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- form_item
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `form_item`;

CREATE TABLE `form_item`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `form_id` INTEGER NOT NULL,
    `question_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `form_item_fi_ee8551` (`form_id`),
    INDEX `form_item_fi_3ff0cc` (`question_id`),
    CONSTRAINT `form_item_fk_ee8551`
        FOREIGN KEY (`form_id`)
        REFERENCES `form` (`id`),
    CONSTRAINT `form_item_fk_3ff0cc`
        FOREIGN KEY (`question_id`)
        REFERENCES `question` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- form_component
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `form_component`;

CREATE TABLE `form_component`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(256) NOT NULL,
    `form_component_name` VARCHAR(256) NOT NULL,
    `has_options` TINYINT(1) DEFAULT 0 NOT NULL,
    `multi_response` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- question
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `text` VARCHAR(255) NOT NULL,
    `form_component_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `question_fi_8cc29b` (`form_component_id`),
    CONSTRAINT `question_fk_8cc29b`
        FOREIGN KEY (`form_component_id`)
        REFERENCES `form_component` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- option
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `option`;

CREATE TABLE `option`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `value` VARCHAR(256) NOT NULL,
    `text` VARCHAR(256) NOT NULL,
    `question_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `option_fi_3ff0cc` (`question_id`),
    CONSTRAINT `option_fk_3ff0cc`
        FOREIGN KEY (`question_id`)
        REFERENCES `question` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- template
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `template`;

CREATE TABLE `template`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `form_id` INTEGER NOT NULL,
    `is_public` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `template_fi_ee8551` (`form_id`),
    CONSTRAINT `template_fk_ee8551`
        FOREIGN KEY (`form_id`)
        REFERENCES `form` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- authentication_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `authentication_code`;

CREATE TABLE `authentication_code`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `member_id` INTEGER NOT NULL,
    `type` VARCHAR(20) NOT NULL,
    `code` VARCHAR(10) NOT NULL,
    `trial_count` INTEGER DEFAULT 0 NOT NULL,
    `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `authentication_code_fi_672062` (`member_id`),
    CONSTRAINT `authentication_code_fk_672062`
        FOREIGN KEY (`member_id`)
        REFERENCES `member` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
