CREATE DATABASE IF NOT EXISTS `saveme` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `saveme`;



CREATE TABLE `power_user` (
                              `id` int(11) NOT NULL,
                              `nome` int(35) NOT NULL,
                              `cognome` int(45) NOT NULL,
                              `email` int(120) NOT NULL,
                              `passwd` varchar(128) NOT NULL,
                              `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                              `status` enum('ACTIVE','DISABLED','PENDING') NOT NULL,
                              `distretto` int(11) NOT NULL,
                              `citta` int(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `segnalazioni` (
                                `segnalazione_id` int(11) NOT NULL,
                                `user_id` int(11) NOT NULL,
                                `lat` decimal(10,8) NOT NULL,
                                `lon` decimal(11,8) NOT NULL,
                                `direzione` varchar(10) NOT NULL,
                                `dettaglio` text NOT NULL,
                                `main_photo` longtext NOT NULL,
                                `stato_segnalazione` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Appena Inserita | 2 = Presa In Carico | 3 = Animale Preso in consegna | 4 = Animale non Presente | 5 = Annullata | 6 = Conclusa',
                                `data_segnalazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
                         `user_id` int(11) NOT NULL,
                         `nome` varchar(35) NOT NULL,
                         `cognome` varchar(45) NOT NULL,
                         `cellulare` varchar(25) NOT NULL,
                         `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                         `account_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `power_user`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `segnalazioni`
    ADD PRIMARY KEY (`segnalazione_id`);

ALTER TABLE `users`
    ADD PRIMARY KEY (`user_id`);


ALTER TABLE `power_user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `segnalazioni`
    MODIFY `segnalazione_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;