-- Adminer 4.8.1 MySQL 5.5.5-10.3.11-MariaDB-1:10.3.11+maria~bionic dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `username` varchar(64) NOT NULL,
  `passwd` varchar(256) NOT NULL,
  `refresh_token` varchar(128) DEFAULT NULL,
  `level` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `email`, `username`, `passwd`, `refresh_token`, `level`, `created_at`, `updated_at`) VALUES
(1,	'Michelle.Boucher@live.com',	'Michelle Boucher',	'$2y$10$8Tn6NvvQ2ZUFLxE4xu6QCObRFlWyqeM.QrJy9VlxFY4JVE4kdvky6',	'c95e601cd01f32a2ed244fd23abe8eef2a31a0e6e032650d87ff63f41fd58d56',	10,	'2022-03-04 15:40:02',	'2022-03-04 16:17:31'),
(2,	'Frédéric.Bigot@noos.fr',	'Frédéric Bigot',	'$2y$10$q5nJ3Fc3AMz3BiaMF44GpObXyOvrbl1td12TGl.r.Q6dxJXIFrS/u',	NULL,	10,	'2022-03-04 15:40:02',	'2022-03-04 15:40:02'),
(3,	'Camille.Marchand@hotmail.fr',	'Camille Marchand',	'$2y$10$Gq6UQhaRWHRFjiQsO6FinuAMAhASysNWTiRabPXppTK6WKVmaHeRa',	NULL,	5,	'2022-03-04 15:40:02',	'2022-03-04 15:40:02'),
(4,	'Margot.Klein@tele2.fr',	'Margot Klein',	'$2y$10$4CPbr40hg5P22XBBaL/MDe.CzkhRcPp4Xnroqh5sgfTfKXGSLPJ8e',	NULL,	9,	'2022-03-04 15:40:02',	'2022-03-04 15:40:02'),
(5,	'Maryse.Charles@club-internet.fr',	'Maryse Charles',	'$2y$10$dwYOOXiTqgaajIlVYi0vK.wIws/wKmy/ky3VbCfTLmFqxBCYOFFsi',	NULL,	2,	'2022-03-04 15:40:02',	'2022-03-04 15:40:02'),
(6,	'René.Chevalier@tele2.fr',	'René Chevalier',	'$2y$10$NKuYQ3qCWmgW1uog1NxfV.S3olrh2U9et4PcReZ3DtNnTq0U1907C',	NULL,	9,	'2022-03-04 15:40:02',	'2022-03-04 15:40:02'),
(7,	'Luc.Lecoq@gmail.com',	'Luc Lecoq',	'$2y$10$S/N2jPnCSLaZisf2XLXi7.WrDJ57dHgJ7ATO3K63dnnWReD7hPo/S',	NULL,	8,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(8,	'Xavier.Barbe@live.com',	'Xavier Barbe',	'$2y$10$I1DFfQtF4dXlnhRFN1ts8OQq3TwSfCcv3a6juZn.3qdDeHbTnoCDu',	NULL,	3,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(9,	'Luce.Briand@free.fr',	'Luce Briand',	'$2y$10$Yb.dDp.56x2MpzFw2Rbgru8CV5kxjDZ4V.NG7jBvka6ZeFlm6PIA.',	NULL,	9,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(10,	'Valérie.Perrot@hotmail.fr',	'Valérie Perrot',	'$2y$10$pGaq81gUpdzzZSxZ30RXD.0qmw7AiqHUrl4jWErqXCqcWd8N5FGYu',	NULL,	3,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(11,	'Claire.Renaud@hotmail.fr',	'Claire Renaud',	'$2y$10$NAvhPm4Ja/IH5Zup2yq8iu.rpjXMty7VWtBYdUl7GixBulewzZYlS',	NULL,	5,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(12,	'Agnès.Lebon@wanadoo.fr',	'Agnès Lebon',	'$2y$10$wWOMnI72tSQtCqM8yc6zx.PwVVdY1vKdIkapI2Me6Nko.QUuZFOnW',	NULL,	4,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(13,	'Alexandria.Lemonnier@dbmail.com',	'Alexandria Lemonnier',	'$2y$10$/1aYXOX/d7f3jckfB7GMyOe0g02c9WP2CFTxqQst1Hym9ab1wgoD2',	NULL,	8,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(14,	'Roger.Riou@hotmail.fr',	'Roger Riou',	'$2y$10$VUJnt9RFypq78PsKNe7GEeFD0Lm1uY15N6zPwEPK29oBKExqlr2Bu',	NULL,	2,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(15,	'Céline.Besnard@sfr.fr',	'Céline Besnard',	'$2y$10$NbViIJxErGKRA1DPThhpQOY9azU.oocNLJ/jXercDr5ekABrotkPy',	NULL,	10,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(16,	'Alphonse.Benard@gmail.com',	'Alphonse Benard',	'$2y$10$V7gqwLWsxmjbXyt4IDwpBObdK7Su0TazIACQGee0jFHqMAYtqIULa',	NULL,	6,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(17,	'Émilie.Vidal@free.fr',	'Émilie Vidal',	'$2y$10$P1Qp8Ta0Sg6lzZOKv2gTJ.SbjpN1j8MXxPH8Tkm5mdnJtjsw3TCJy',	NULL,	3,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(18,	'Céline.Michaud@live.com',	'Céline Michaud',	'$2y$10$IuY58cIown.pKULfAjjXNu.EItW2o4CruxPp.c6sCxZ8r9b2mw6UK',	NULL,	10,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(19,	'Raymond.Giraud@orange.fr',	'Raymond Giraud',	'$2y$10$TO8xdUNH2Aw/WQ5BsD.0feUTipoXy/D5dgpACfJq4RXSw1ejQ7KvK',	NULL,	9,	'2022-03-04 15:40:03',	'2022-03-04 15:40:03'),
(20,	'Guillaume.Roussel@laposte.net',	'Guillaume Roussel',	'$2y$10$wr3l9G225AeD0fL8vMKRXuFHXMzgbcZ3BzpU9kV0jnQWcFeFpvNB2',	NULL,	6,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(21,	'Henriette.Barre@free.fr',	'Henriette Barre',	'$2y$10$qRK2jcR24XC3OQuSYqMNwuuTyf1IbQHTffv0jtRF86m4TbnEOdrii',	NULL,	6,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(22,	'Lorraine.Lopez@wanadoo.fr',	'Lorraine Lopez',	'$2y$10$28WtidLhgTvqbxe2k1g7xem1wChTniIgWWtaKm8X5sS1l/7MjiiaO',	NULL,	1,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(23,	'Robert.Lelievre@laposte.net',	'Robert Lelievre',	'$2y$10$G.Dc69rIfOS4iPjXnHdApOKJhRsO9O1/qzpGR/1KjnhnXjBOqebaC',	NULL,	3,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(24,	'Danielle.Delorme@tele2.fr',	'Danielle Delorme',	'$2y$10$29v.qxytbgJFAscE3OAO5eaPRLxgnGWH8LY1U5.zR/vx0YiPEtWXO',	NULL,	8,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(25,	'Théodore.Blin@wanadoo.fr',	'Théodore Blin',	'$2y$10$Ph3dn9rC8BPJy4rDiuX2ueyaLw8ebAdb6mBjU8c7VwKnjyh25tqC2',	NULL,	10,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(26,	'Margaux.Fernandez@laposte.net',	'Margaux Fernandez',	'$2y$10$R0osCovRWwz3k0XJHY0a7ecrVbQ1N1NGRbNjnwiPw6nJB5IEJhH6G',	NULL,	4,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(27,	'Audrey.Mallet@sfr.fr',	'Audrey Mallet',	'$2y$10$mNOvrJtN.5mpyZDixmqNWuzAy/mrzG/bSjX9act285F//tx1zmWg2',	NULL,	8,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(28,	'François.Lacombe@yahoo.fr',	'François Lacombe',	'$2y$10$.Fd835JpbbjX9UMFDaHjhe4fDnh/ErrAEDqBmElY3yBSms9x4y3Cu',	NULL,	8,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(29,	'Juliette.Jean@tele2.fr',	'Juliette Jean',	'$2y$10$dRbn9vx1op2wiV7g.vOuE.2DRd23dIXXtYzwGl9Z1946RTFEymDJa',	NULL,	7,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(30,	'Adèle.Hoareau@sfr.fr',	'Adèle Hoareau',	'$2y$10$GLsXJ5SnBCvoALTxhv9WN.KlJ1wgL4SgkVS9RqGSqyJu1NstbYJbi',	NULL,	9,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(31,	'Timothée.Regnier@noos.fr',	'Timothée Regnier',	'$2y$10$CJiSkSatUbKian35UZID/OIKUe9K7gJuQhNbpNsFxKCIie8il2KzC',	NULL,	8,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(32,	'Margot.Gallet@orange.fr',	'Margot Gallet',	'$2y$10$el79R/jy0iJ1vYip0hqNk.hF07/ns5uhTDsoq5nDVJUaTevST5cvq',	NULL,	1,	'2022-03-04 15:40:04',	'2022-03-04 15:40:04'),
(33,	'Philippe.Cordier@laposte.net',	'Philippe Cordier',	'$2y$10$B6WIbLKE40nR0zwPJBA2fu7JnhRAgCjntjmns6VaZMrghSuq0ZXhW',	NULL,	10,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(34,	'Élise.Samson@club-internet.fr',	'Élise Samson',	'$2y$10$BDJmcuCaCvu8zS/HIv3ZsOHW8i1TvRir3zby.xXTuRgCvGEFB5GnG',	NULL,	4,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(35,	'Margaux.Lopez@free.fr',	'Margaux Lopez',	'$2y$10$ZLgmj8/vvDfTec1Ldla3S.cjzqTdasGNkKAqj9.9XI7Dd5RjvFMRm',	NULL,	6,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(36,	'Alexandrie.Dias@gmail.com',	'Alexandrie Dias',	'$2y$10$G/BI.lLlpaoX0/bH6puKQexmlRv0MKvy76nh0bbSqtie0Z3cW4WNi',	NULL,	8,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(37,	'Adèle.Antoine@tele2.fr',	'Adèle Antoine',	'$2y$10$QZYgHSAm.iHwzfPocOhzI.P42xV6GrZ5eqqPB3KDJJ4pU5BpBlb4W',	NULL,	1,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(38,	'Renée.Dupont@club-internet.fr',	'Renée Dupont',	'$2y$10$om42uaLsPCdLnRzgNhvHYuPtchvV3BQNnrixYfbOOkecKtB7rnvbi',	NULL,	4,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(39,	'Denise.Bazin@sfr.fr',	'Denise Bazin',	'$2y$10$2xUtM1Sx0x19kn2T4IgUceoa1FdFEE3j8qUA2No59hNtkfs7dR9We',	NULL,	1,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(40,	'Michel.Lemonnier@laposte.net',	'Michel Lemonnier',	'$2y$10$mF2CNbmuJJv9/u315GyG5OyU.ahToLOm4WGNHL7jLk6JmQG9eMjiq',	NULL,	10,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(41,	'Auguste.Blanchard@noos.fr',	'Auguste Blanchard',	'$2y$10$Outf2mwEpwaYuZhsJ.tHN.mvHkw3w5PSIMNFrUua.Q1LagbRuJDVS',	NULL,	7,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(42,	'Denis.Bailly@wanadoo.fr',	'Denis Bailly',	'$2y$10$AHOjf9yC33ZdSjhizPOEoeLzrmFYTqWw2q6eQhaulS2fW.JWlmblK',	NULL,	6,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(43,	'Noémi.Guillon@live.com',	'Noémi Guillon',	'$2y$10$p.0kYpE/b98rFenVfPVWlu1dyBWnhEVu3fpchcfOb4HuXoM8cZrFu',	NULL,	2,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(44,	'Christiane.Dos Santos@gmail.com',	'Christiane Dos Santos',	'$2y$10$gxbmiH5SBqBQMVdVqBHyMe/y8hXCShVYmjKkz5WViET57InUDDYH.',	NULL,	10,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(45,	'Lucas.Vallet@tele2.fr',	'Lucas Vallet',	'$2y$10$WdSS8CE71VCUuA1ag2qeCOtrkkPjrPpwCIsFLG0G2PhwRFEWVQYPG',	NULL,	3,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(46,	'Emmanuel.Gomes@dbmail.com',	'Emmanuel Gomes',	'$2y$10$yhbYDiS8AXUM7NKCZl3fX./JujuybPKRzqJ64Ep4SHk1dUJ9nAhZG',	NULL,	10,	'2022-03-04 15:40:05',	'2022-03-04 15:40:05'),
(47,	'Josette.Merle@club-internet.fr',	'Josette Merle',	'$2y$10$oAwMkdlyVvblKFtwR8wuzuN2Dn1XwqHyoZPfoqHSb10p6IG94uI/2',	NULL,	8,	'2022-03-04 15:40:06',	'2022-03-04 15:40:06'),
(48,	'Sébastien.Merle@tele2.fr',	'Sébastien Merle',	'$2y$10$sUeRSQlfR73TSPoEwaP3DOomVHqjLS2/3uqg8FTh0rrEmJD6L1wJ.',	NULL,	2,	'2022-03-04 15:40:06',	'2022-03-04 15:40:06'),
(49,	'Georges.Letellier@free.fr',	'Georges Letellier',	'$2y$10$T5gXCnGIOGTq3/5yUYc/QuDFVdKJ5M6PPimO640lmsNRmwGpY.XFO',	NULL,	3,	'2022-03-04 15:40:06',	'2022-03-04 15:40:06'),
(50,	'Sylvie.Dumas@laposte.net',	'Sylvie Dumas',	'$2y$10$ZnEciI7rogCOKcwqIVIzVeR5FXONBWTMeCxLfRmcS46c3Uyy33Jaa',	NULL,	2,	'2022-03-04 15:40:06',	'2022-03-04 15:40:06');

-- 2022-03-06 16:02:13
