
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- banca
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `banca`;


CREATE TABLE `banca`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`abi` VARCHAR(255) default 'null' NOT NULL,
	`cab` VARCHAR(255) default 'null' NOT NULL,
	`cin` VARCHAR(255) default 'null' NOT NULL,
	`iban` VARCHAR(255) default 'null' NOT NULL,
	`numero_conto` VARCHAR(255) default 'null' NOT NULL,
	`nome_banca` VARCHAR(255) default 'null' NOT NULL,
	PRIMARY KEY (`id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `banca_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- bug
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `bug`;


CREATE TABLE `bug`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`priorita` VARCHAR(255) default 'null' NOT NULL,
	`modulo` VARCHAR(255) default 'null' NOT NULL,
	`testo` TEXT  NOT NULL,
	`data` DATE,
	`stato` VARCHAR(255) default 'null' NOT NULL,
	PRIMARY KEY (`id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `bug_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- contatto
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `contatto`;


CREATE TABLE `contatto`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`azienda` CHAR default '' NOT NULL,
	`ragione_sociale` VARCHAR(255),
	`via` VARCHAR(255),
	`citta` VARCHAR(100),
	`provincia` VARCHAR(5),
	`cap` VARCHAR(5),
	`nazione` VARCHAR(255),
	`piva` VARCHAR(20),
	`cf` VARCHAR(50),
	`cognome` VARCHAR(50),
	`nome` VARCHAR(50),
	`telefono` VARCHAR(20),
	`fax` VARCHAR(20),
	`cellulare` VARCHAR(20),
	`email` VARCHAR(100),
	`modo_pagamento_id` INTEGER,
	`stato` CHAR default 'a' NOT NULL,
	`contatto` VARCHAR(255),
	`id_tema_fattura` INTEGER,
	`id_banca` INTEGER,
	`calcola_ritenuta_acconto` CHAR default 'a' NOT NULL,
	`includi_tasse` CHAR default '' NOT NULL,
	`calcola_tasse` CHAR default 's' NOT NULL,
	`cod` VARCHAR(255),
	`note` TEXT,
	`class_key` INTEGER default 1,
	PRIMARY KEY (`id`),
	KEY `cliente_cognome_index`(`cognome`),
	KEY `cliente_id_banca_index`(`id_banca`),
	KEY `cliente_FI_1`(`modo_pagamento_id`),
	KEY `id_utente`(`id_utente`),
	KEY `piva`(`piva`),
	KEY `id_tema_fattura`(`id_tema_fattura`),
	CONSTRAINT `contatto_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `contatto_FK_2`
		FOREIGN KEY (`modo_pagamento_id`)
		REFERENCES `modo_pagamento` (`id`)
		ON UPDATE CASCADE
		ON DELETE SET NULL,
	CONSTRAINT `contatto_FK_3`
		FOREIGN KEY (`id_tema_fattura`)
		REFERENCES `tema_fattura` (`id`)
		ON UPDATE CASCADE
		ON DELETE SET NULL,
	CONSTRAINT `contatto_FK_4`
		FOREIGN KEY (`id_banca`)
		REFERENCES `banca` (`id`)
		ON UPDATE CASCADE
		ON DELETE SET NULL
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- codice_iva
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `codice_iva`;


CREATE TABLE `codice_iva`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER,
	`nome` VARCHAR(255) default 'null' NOT NULL,
	`valore` INTEGER default 0 NOT NULL,
	`descrizione` TEXT  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `codice_iva_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- dettagli_fattura
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `dettagli_fattura`;


CREATE TABLE `dettagli_fattura`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`fattura_id` INTEGER default 0 NOT NULL,
	`descrizione` TEXT,
	`qty` VARCHAR(10) default '0' NOT NULL,
	`sconto` VARCHAR(10) default '0' NOT NULL,
	`iva` INTEGER default 0 NOT NULL,
	`prezzo` VARCHAR(50) default '0' NOT NULL,
	PRIMARY KEY (`id`),
	KEY `dettagli_fattura_FI_1`(`fattura_id`),
	CONSTRAINT `dettagli_fattura_FK_1`
		FOREIGN KEY (`fattura_id`)
		REFERENCES `fattura` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- fattura
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `fattura`;


CREATE TABLE `fattura`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`num_fattura` VARCHAR(10) default '0' NOT NULL,
	`cliente_id` INTEGER default 0 NOT NULL,
	`data` DATE  NOT NULL,
	`data_stato` DATE,
	`modo_pagamento_id` INTEGER,
	`sconto` INTEGER default 0,
	`vat` INTEGER default 20,
	`spese_anticipate` FLOAT default 0,
	`imposte` FLOAT,
	`imponibile` FLOAT,
	`stato` CHAR default 'n',
	`iva_pagata` CHAR default 'n',
	`iva_depositata` CHAR default 'n',
	`commercialista` CHAR default 'n',
	`note` TEXT,
	`calcola_ritenuta_acconto` CHAR default 'a',
	`includi_tasse` CHAR default '',
	`calcola_tasse` CHAR default 's',
	`class_key` INTEGER default 1,
	PRIMARY KEY (`id`),
	KEY `fattura_num_fattura_index`(`num_fattura`),
	KEY `fattura_FI_1`(`cliente_id`),
	KEY `fattura_FI_2`(`modo_pagamento_id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `fattura_FK_1`
		FOREIGN KEY (`modo_pagamento_id`)
		REFERENCES `modo_pagamento` (`id`)
		ON UPDATE CASCADE
		ON DELETE SET NULL,
	CONSTRAINT `fattura_FK_2`
		FOREIGN KEY (`cliente_id`)
		REFERENCES `contatto` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `fattura_FK_3`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- impostazione
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `impostazione`;


CREATE TABLE `impostazione`
(
	`id_utente` INTEGER default 0 NOT NULL,
	`num_clienti` INTEGER default 20 NOT NULL,
	`num_fatture` INTEGER default 20 NOT NULL,
	`righe_dettagli` INTEGER default 5 NOT NULL,
	`ritenuta_acconto` VARCHAR(255) default '20/100' NOT NULL,
	`tipo_ritenuta` VARCHAR(255) default 'debito' NOT NULL,
	`riepilogo_home` CHAR default '' NOT NULL,
	`consegna_commercialista` CHAR default '' NOT NULL,
	`deposita_iva` CHAR default '' NOT NULL,
	`fattura_automatica` CHAR default 's' NOT NULL,
	`codice_cliente` CHAR default '' NOT NULL,
	`label_imponibile` VARCHAR(255) default 'Imponibile' NOT NULL,
	`label_spese` VARCHAR(255) default 'Spese Anticipate' NOT NULL,
	`label_imponibile_iva` VARCHAR(255) default 'Imponibile ai fini iva' NOT NULL,
	`label_iva` VARCHAR(255) default 'Iva' NOT NULL,
	`label_totale_fattura` VARCHAR(255) default 'Totale Fattura' NOT NULL,
	`label_ritenuta_acconto` VARCHAR(255) default 'Ritenuta d\'acconto' NOT NULL,
	`label_netto_liquidare` VARCHAR(255) default 'Netto da liquidare' NOT NULL,
	`label_quantita` VARCHAR(255) default 'Qty' NOT NULL,
	`label_descrizione` VARCHAR(255) default 'Descrizione' NOT NULL,
	`label_prezzo_singolo` VARCHAR(255) default 'Prezzo Singolo' NOT NULL,
	`label_prezzo_totale` VARCHAR(255) default 'Prezzo Totale' NOT NULL,
	`label_sconto` VARCHAR(255) default 'Sconto' NOT NULL,
	PRIMARY KEY (`id_utente`),
	CONSTRAINT `impostazione_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- invitation_code
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `invitation_code`;


CREATE TABLE `invitation_code`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`codice` VARCHAR(10) default 'null' NOT NULL,
	`inviato` CHAR default '' NOT NULL,
	`email` VARCHAR(255),
	PRIMARY KEY (`id`),
	UNIQUE KEY `codice` (`codice`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- modo_pagamento
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `modo_pagamento`;


CREATE TABLE `modo_pagamento`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER,
	`num_giorni` INTEGER default 0 NOT NULL,
	`descrizione` VARCHAR(50),
	PRIMARY KEY (`id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `modo_pagamento_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- pagina
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `pagina`;


CREATE TABLE `pagina`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`titolo` VARCHAR(255) default 'null' NOT NULL,
	`corpo` TEXT  NOT NULL,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- paypal
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `paypal`;


CREATE TABLE `paypal`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`date` DATETIME,
	`item_name` VARCHAR(130),
	`receiver_email` VARCHAR(125),
	`item_number` VARCHAR(130),
	`quantity` SMALLINT,
	`id_utente` INTEGER,
	`payment_status` CHAR,
	`pending_reason` CHAR,
	`payment_gross` FLOAT,
	`payment_fee` FLOAT,
	`payment_type` CHAR,
	`payment_date` VARCHAR(50) default '0' NOT NULL,
	`txn_id` VARCHAR(20),
	`payer_email` VARCHAR(125),
	`payer_status` VARCHAR(255) default 'unverified' NOT NULL,
	`txn_type` VARCHAR(255) default 'subscr_payment' NOT NULL,
	`first_name` VARCHAR(35),
	`last_name` VARCHAR(60),
	`address_city` VARCHAR(60),
	`address_street` VARCHAR(60),
	`address_state` VARCHAR(60),
	`address_zip` VARCHAR(15),
	`address_country` VARCHAR(60),
	`address_status` VARCHAR(255) default 'unconfirmed' NOT NULL,
	`subscr_date` VARCHAR(50),
	`period1` VARCHAR(20) default 'UNK' NOT NULL,
	`period2` VARCHAR(20) default 'UNK' NOT NULL,
	`period3` VARCHAR(20) default 'UNK' NOT NULL,
	`amount1` FLOAT default 0 NOT NULL,
	`amount2` FLOAT default 0 NOT NULL,
	`amount3` FLOAT default 0 NOT NULL,
	`recurring` TINYINT default 1 NOT NULL,
	`reattempt` TINYINT default 0 NOT NULL,
	`retry_at` VARCHAR(50),
	`recur_times` SMALLINT default 0 NOT NULL,
	`subscr_id` VARCHAR(20),
	`entirepost` TEXT,
	`paypal_verified` VARCHAR(255) default 'INVALID' NOT NULL,
	`verify_sign` VARCHAR(125),
	PRIMARY KEY (`id`),
	KEY `txn_type`(`txn_type`),
	KEY `payment_status`(`payment_status`),
	KEY `pending_reason`(`pending_reason`),
	KEY `payer_status`(`payer_status`),
	KEY `payment_type`(`payment_type`),
	KEY `retry_at`(`retry_at`),
	KEY `receiver_email`(`receiver_email`),
	KEY `date`(`date`),
	KEY `id_utente`(`id_utente`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- prodotto
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `prodotto`;


CREATE TABLE `prodotto`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`codice` VARCHAR(255),
	`nome` VARCHAR(255) default 'null' NOT NULL,
	`prezzo` FLOAT default 0 NOT NULL,
	PRIMARY KEY (`id`),
	KEY `codice`(`codice`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `prodotto_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- tags_fattura
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tags_fattura`;


CREATE TABLE `tags_fattura`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_fattura` INTEGER default 0 NOT NULL,
	`id_utente` INTEGER default 0 NOT NULL,
	`tag` VARCHAR(255) default 'null' NOT NULL,
	`tag_normalizzato` VARCHAR(255) default 'null' NOT NULL,
	`data` DATE  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `id_fattura_2` (`id_fattura`, `id_utente`, `tag_normalizzato`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `tags_fattura_FK_1`
		FOREIGN KEY (`id_fattura`)
		REFERENCES `fattura` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `tags_fattura_FK_2`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- tassa
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tassa`;


CREATE TABLE `tassa`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`nome` VARCHAR(255) default 'null' NOT NULL,
	`valore` VARCHAR(255) default 'null' NOT NULL,
	`descrizione` VARCHAR(255) default 'null' NOT NULL,
	PRIMARY KEY (`id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `tassa_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- tema_fattura
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tema_fattura`;


CREATE TABLE `tema_fattura`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`nome` VARCHAR(100) default 'null' NOT NULL,
	`template` TEXT  NOT NULL,
	`css` TEXT  NOT NULL,
	`logo` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `tema_fattura_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- utente
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `utente`;


CREATE TABLE `utente`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_invitation_code` INTEGER,
	`username` VARCHAR(255) default 'null' NOT NULL,
	`nome` VARCHAR(255) default 'null' NOT NULL,
	`cognome` VARCHAR(255) default 'null' NOT NULL,
	`ragione_sociale` VARCHAR(255) default 'null' NOT NULL,
	`partita_iva` VARCHAR(255) default 'null' NOT NULL,
	`codice_fiscale` VARCHAR(255) default 'null' NOT NULL,
	`email` VARCHAR(255) default 'null' NOT NULL,
	`password` VARCHAR(255) default 'null' NOT NULL,
	`data_attivazione` DATE  NOT NULL,
	`data_rinnovo` DATE  NOT NULL,
	`tipo` VARCHAR(255)  NOT NULL,
	`stato` VARCHAR(255) default 'attivo' NOT NULL,
	`fattura` CHAR default '' NOT NULL,
	`lastlogin` DATETIME  NOT NULL,
	`approva_contratto` INTEGER default 0 NOT NULL,
	`approva_policy` INTEGER default 0 NOT NULL,
	`sconto` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `username` (`username`),
	KEY `id_invitation_code`(`id_invitation_code`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- cash_flow_row
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cash_flow_row`;


CREATE TABLE `cash_flow_row`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`date` DATETIME,
	`model_id` INTEGER,
	`model_class` VARCHAR(255),
	`imponibile` FLOAT,
	`imposte` FLOAT,
	`description` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
