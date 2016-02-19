SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databáza: `d30267_ondris`
--

-- --------------------------------------------------------

--
-- Štruktúra pre tabu¾ku `dodavatelia`
--

CREATE TABLE IF NOT EXISTS `dodavatelia` (
  `id_dodavatela` int(11) NOT NULL AUTO_INCREMENT,
  `nazovdodavatela` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `adresa` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `telefon` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `casdorucenia` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_dodavatela`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=4 ;

--
-- Naplnenie tabu¾ky `dodavatelia` testovacími dátami
--

INSERT INTO `dodavatelia` (`id_dodavatela`, `nazovdodavatela`, `adresa`, `email`, `telefon`, `casdorucenia`) VALUES
(1, 'AEL-Umenie, a.s', 'Štefánikova 32 421 08 Košice', 'ael@ael-umenie.sk', '+421 918 321 654', '4 dni'),
(2, 'AIVEL', 'Námestie Oslobodite¾ov 201, Banská Bystrica 302 04', 'admin@aivel.sk', '+421 902 102 154', '3 dni'),
(3, 'ALL PAINTS, s.r.o.', 'Športová 85,  054 32 Trenèín ', 'support@allpaints.sk', '+421 908 442 754', '2 dni');

-- --------------------------------------------------------

--
--  Štruktúra pre tabu¾ku `kategoria`
--

CREATE TABLE IF NOT EXISTS `kategoria` (
  `id_kategorie` int(11) NOT NULL,
  `kategoria` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_kategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Naplnenie tabu¾ky `kategoria` testovacími dátami
--

INSERT INTO `kategoria` (`id_kategorie`, `kategoria`) VALUES
(1, 'Farby'),
(2, 'Ceruzky'),
(3, 'Voskovky'),
(4, 'Kriedy'),
(5, 'Vıkresy');

-- --------------------------------------------------------

--
-- Štruktúra pre tabu¾ku `kosik`
--

CREATE TABLE IF NOT EXISTS `kosik` (
  `id_kosika` int(11) NOT NULL AUTO_INCREMENT,
  `pocetkusov` int(11) NOT NULL,
  `cenaspolu` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `datumpridania` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kosika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra pre tabu¾ku `naskladnenie`
--

CREATE TABLE IF NOT EXISTS `naskladnenie` (
  `id_naskladnenia` int(11) NOT NULL AUTO_INCREMENT,
  `prih_meno` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `poznamka` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  `datumvytvorenia` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `celkovacena` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `stav` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_naskladnenia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=6 ;

--
-- Naplnenie tabu¾ky `naskladnenie` testovacími dátami 
--

INSERT INTO `naskladnenie` (`id_naskladnenia`, `prih_meno`, `poznamka`, `datumvytvorenia`, `celkovacena`, `stav`) VALUES
(1, 'administrator', '', '2015-11-29 14:28:22', '8', 'Naskladnená'),
(2, 'administrator', '', '2015-11-28 15:55:23', '7', 'Objednaná');

-- --------------------------------------------------------

--
-- Štruktúra pre tabu¾ku `naskladnenytovar`
--

CREATE TABLE IF NOT EXISTS `naskladnenytovar` (
  `id_naskladnenia` int(11) NOT NULL,
  `id_tovaru` int(11) NOT NULL,
  `mnozstvo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Naplnenie tabu¾ky `naskladnenytovar` testovacími dátami  
--

INSERT INTO `naskladnenytovar` (`id_naskladnenia`, `id_tovaru`, `mnozstvo`) VALUES
(1, 16, 1),
(1, 1, 1),
(1, 5, 2),
(2, 11, 5),
(2, 1, 1),
(2, 4, 1),
(2, 3, 1);



-- --------------------------------------------------------

--
-- Štruktúra pre tabu¾ku `objednanytovar`
--

CREATE TABLE IF NOT EXISTS `objednanytovar` (
  `id_objednavky` int(11) NOT NULL,
  `id_tovaru` int(11) NOT NULL,
  `mnozstvo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Naplnenie tabu¾ky `objednanytovar` testovacími dátami   
--

INSERT INTO `objednanytovar` (`id_objednavky`, `id_tovaru`, `mnozstvo`) VALUES
(35, 1, 5),
(35, 3, 2),
(36, 1, 5),
(36, 11, 3),
(36, 20, 3),
(37, 10, 3);

-- --------------------------------------------------------

--
-- Štruktúra pre tabu¾ku `objednavka`
--

CREATE TABLE IF NOT EXISTS `objednavka` (
  `id_objednavky` int(10) NOT NULL AUTO_INCREMENT,
  `prih_meno` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `poznamka` varchar(200) COLLATE utf8_czech_ci DEFAULT NULL,
  `celkovacena` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `zlavovykupon` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `datumvytvorenia` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stav` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `sposob_dopravy` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `sposob_platby` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_objednavky`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=38 ;

--
-- Naplnenie tabu¾ky `objednavka` testovacími dátami 
--

INSERT INTO `objednavka` (`id_objednavky`, `prih_meno`, `poznamka`, `celkovacena`, `zlavovykupon`, `datumvytvorenia`, `stav`, `sposob_dopravy`, `sposob_platby`) VALUES
(35, 'uzivatel1', 'poprosil by som co najrychlejsie', '7', NULL, '2015-11-28 11:41:22', 'Zaevidovaná', 'pošta', 'dobierka'),
(36, 'uzivatel1', 'to som ja edo', '5', NULL, '2015-11-25 22:10:15', 'Zaevidovaná', 'pošta', 'dobierka'),
(37, 'uzivatel1', '', '25', NULL, '2015-1-22 15:24:35', 'Zaevidovaná', '', '');

-- --------------------------------------------------------

--
-- Štruktúra pre tabu¾ku `recenziehodnotenia`
--

CREATE TABLE IF NOT EXISTS `recenziehodnotenia` (
  `id_recenzie` int(11) NOT NULL AUTO_INCREMENT,
  `hodnotenie` varchar(1) COLLATE utf8_czech_ci NOT NULL,
  `recenzie` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `meno` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `produkt` int(5) NOT NULL,
  PRIMARY KEY (`id_recenzie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=23 ;

--
-- Naplnenie tabu¾ky `recenziehodnotenia` testovacími dátami 
--

INSERT INTO `recenziehodnotenia` (`id_recenzie`, `hodnotenie`, `recenzie`, `datum`, `meno`, `email`, `ip`, `produkt`) VALUES
(1, '4', 'Som spokojnı s kvalitou tovaru', '2015-11-28 22:13:33', 'Ondro', 'matusondris@centrum.sk', '10.10.10.219', 2),
(2, '5', 'Je to prestne to co chcem za bezkonkurencnu cenu', '2015-11-25 09:48:52', 'lolo', 'matusondris@centrum.sk', '10.10.10.219', 1),
(3, '5', 'Dokonale prestne to co chcem', '2015-11-26 10:10:10', 'imrich', 'atusondris@centrum.sk', '10.10.10.219', 3),
(4, '2', 'nic moc nepaci sa mi to tu', '2015-11-29 12:36:53', 'xxx', 'anonym@centrum.sk', '10.10.10.219', 5);

-- --------------------------------------------------------

--
-- Štruktúra pre tabu¾ku `tovar`
--

CREATE TABLE IF NOT EXISTS `tovar` (
  `id_tovaru` int(11) NOT NULL AUTO_INCREMENT,
  `nazovtovaru` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `kategoria` int(2) unsigned NOT NULL,
  `id_dodavatela` int(11) NOT NULL,
  `popisproduktu` varchar(500) COLLATE utf8_czech_ci NOT NULL,
  `cena` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `obrazok` varchar(30) COLLATE utf8_czech_ci DEFAULT NULL,
  `skladom` int(11) NOT NULL,
  PRIMARY KEY (`id_tovaru`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=20 ;

--
-- Naplnenie tabu¾ky `tovar` testovacími dátami
--

INSERT INTO `tovar` (`id_tovaru`, `nazovtovaru`, `kategoria`, `id_dodavatela`, `popisproduktu`, `cena`, `obrazok`, `skladom`) VALUES
(1, 'Farba na sklo 60 ml - ltá', 1, 1, 'Farba na sklo v plastovej nádobke s aplikátorom, objem 60 ml.', '1.5', 'zltaf.jpg', 21),
(2, 'Farba na sklo 60 ml - èervená', 1, 1, 'Transparentná farba so špeciálnou vlastnosou. Po uschnutí vytvorı hrubú vrstvu, ktorú mono aj opakovane nalepi na hladkı povrch. Vıborná pre dekorácie na okná, rámèeky fotografií, vázy, f¾aše, lampáše, a mnoho inıch hladkıch objektov.', '1.5', 'cervenaf.jpg', 15),
(3, 'Farba na sklo 60 ml - svetlomodrá', 1, 1, 'Transparentná farba so špeciálnou vlastnosou. Po uschnutí vytvorı hrubú vrstvu, ktorú mono aj opakovane nalepi na hladkı povrch. Vıborná pre dekorácie na okná, rámèeky fotografií, vázy, f¾aše, lampáše, a mnoho inıch hladkıch objektov.', '1.5', 'modraf.jpg', 5),
(4, 'Špecifikácia Farba na sklo sada 12 x 10,5 ml', 1, 1, '12-kusová sada farieb na sklo, dodávaná v plastovom obale s eurozávesom, objem jednej farby 10,5 ml.', '7', 'sklof.jpg', 12),
(5, 'Temperové farby Faber-Castell v tube 12 ml, 12 farieb', 1, 1, 'Školské temperové farby.Pouívajte na papier, lepenku, keramiku. Rozpustné vo vode, iarivé a intenzívne farby.Prispôsobené vzdelávacím potrebám detí. Neobmedzené monosti miešania farieb.12 farieb v tube. Upozornenie: Nevhodn120901é pre deti do 3. rokov. Balenie obsahuje malé èasti, hrozí nebezpeèenstvo prehltnutia a udusenia.', '9', 'temperf.jpg', 15),
(6, 'Faber-Castell Vodové farby 21 farebné', 1, 1, 'Vodové farby. iarivé a jasné farby s dobrou krycou schopnosou.Neobmedzené monosti miešania farieb. Dobré krycie vısledky na papieri a inıch povrchoch. Pre zábavné ma¾ovanie.Súèasou balenia je štetec.Tablety s priemerom 30 mm. 21 farebné. Garancia:Faber-Castell garantuje spokojnos zákazníkov od roku 1761. Ak nie ste úplne spokojnı s vırobkom, pošlite ho prosím na bezplatnú vımenu.', '6', 'vodaf.jpg', 18),
(7, 'Pastelky akvarelové MILAN 24ks so štetcom', 2, 2, 'Ergonomické trojhranné, vo vode rozpustné farebné pastelky so systémom LPS - ochrany proti polámaniu. Hladko sa nanášajú a pridaním malého mnostva vody je moné ich roztiera priloenım štetcom aj na väèšie plochy. Pastelky sú vyhotovené z odolného dreva. Súprava obsahuje 24 ks.', '5', 'pastels.jpg', 18),
(8, 'Adeland Grafitové ceruzky HB s gumou box 72 ks', 2, 2, 'Ceruzky sú urèená pre rôzne nároènıch zákazníkov, keïe balenie obsahuje 72ks nachádzajú sa v òom ceruzkı rôznych tvrdostí a tım pádom sú vhodné ako na obyèajnú geometriu v matematike, technické kresby , ale dokonca aj na umelecké práce.', '18.5', 'ceruz.jpg', 8),
(9, 'CRT ceruzka artist black chalk 2', 2, 2, 'Umelecká ceruzka Black Pastel je ideálna pre skicovanie a kreslenie. Pouíva sa samostatne alebo zmiešaná s vodou v kombinácii s ceruzkami z radu CRETACOLOR Sanguine, Sepia a ïalších produktov. K dispozícii v strednej tvrdosti. Obalená v kvalitnom cédrovom dreve - taká je ceruzka od Cretacolor.', '1', 'cb.jpg', 50),
(10, 'CRT ceruzka artist white chalk oil 1', 2, 2, 'Biela umelecká pastelka je vynikajúca pre kombinovanie s uhlíkmi: Sanguine a Seppia os renomovanej rakúskej firmy CRETACOLOR a pre zosvetlenie farebnıch tónov. K dispozícii v dvoch rôznych stupòoch tvrdosti.', '1', 'bielacer.jpg', 50),
(11, 'Magické trojboké voskovky mix 26 farieb + 4 metallic', 3, 3, 'Magické trojboké voskovky sú vyrobené z vèelieho vosku a prírodnıch pigmentov. Tvar voskovky umoòuje dobrı úchop. Voskovky sú nelámavej, vysoko odolné, nefarbí prsty a nie sú toxické. Nanášaním jednotlivıch farieb na seba vzniká dúhovı efekt. Na hotové vıtvory mono písa fixkou alebo perom. Voskovky sa na papieri lesknú. S voskovkami môete vytvára elanie, fotoknihy pod. Mono ich tie poui na textil, ale je nutné ich zaehli cez papier na peèenie. V balení nájdete 26 rôznofarebnıch voskoviek a 4 metalické Materiál: vèelí vosk a prírodné pigment Odporúèanı vek: 3 +', '19', 'vosmag.jpg', 14),
(12, 'Crayola trojhranné voskovky 16ks', 3, 3, 'Sada trojhrannıch voskoviek, ich ergonomickı tvar je vhodnı pre malé ruky. Voskovky sú ¾ahko uchopite¾né. Pre vlastnú tvorbu slúi 16 rôznych farieb. Kreslenie s malımi voskovkymi bude jednoduché, kreslia rovnomerne a priebene, nemrvia sa a zachovávajú si aj iarivé farby. Rozvíjaj svoju kreativitu a fantáziu!', '5', 'voskovkylast.jpg', 16),
(13, 'Voskovky do vody s penovou podlokou', 3, 3, 'Špeciálne voòavé voskovky do vane zabavia vašich malıch neposedníkov pri kúpaní. Deti môu plávajúce oma¾ovánky vyfarbi voskovkami, ktoré sú ¾ahko zmıvate¾né vodou', '7', 'vosvod.jpg', 4),
(14, 'Voskovky Faber-Castell triangular 12 farieb', 3, 3, 'Trojuholníkové voskovky. Hrubı, trojuholníkovı tvar zaruèuje vıvoj správneho uchopenia. Lepšia kontrola pri kreslení a ma¾ovaní. Trojuholníkové voskovky zlepšujú motorické zruènosti a koordináciu rúk a oèí. Dåka 90 mm, priemer 11 mm. 12 farieb v papierovej krabièke.', '2.5', 'vos12.jpg', 18),
(15, 'Umelı uhlík', 4, 2, 'Balenie obsahuje 6 kusov umelého uhlíka na kreslenie. Priemer tuhy je 5,6 mm a dåka je 120mm.', '2', 'uhlik.jpg', 8),
(16, 'OKRÚHLA KRIEDA COLOR & CO SET10 - BIELA', 4, 3, 'Sada pozostáva z 10 kusov bielej okrúhlej kriedy. Okrúhle kriedy na kreslenie sú bezprašné a nedrobivé, nešpinia ruky. Znaèka Color & Co spája produkty predovšetkım pre "malého" umelca. Farby sú bezpeèné pre deti v súlade s európskymi normami. Ponuka zahàòa akrylové a temperové farby, farby a gély s trblietkami, kriedy, zásterky na ma¾ovanie, atï.', '1', 'kriedab.jpg', 23),
(17, 'Krieda na ma¾ovanie', 4, 1, 'Rôznofarebné kriedy na písanie a ma¾ovanie na tabu¾u sú uloená v prieh¾adnej nádobe s krytom a dradlom. Diea s òou zaije ve¾a zábavy a prejaví svoju kreativitu. Krieda je dos ve¾ká aj na ma¾ovanie na chodník.', '5', 'kriedam.jpg', 17),
(18, 'FAREBNÉ KRIEDY NA TABU¼U', 4, 2, 'Farebné kriedy na doma, do školy alebo len tak na hranie.', '0.5', 'kriedaf.jpg', 60),
(19, 'Vıkres A4 180g farebnı', 5, 3, 'Vıkresy formátu A4, Balenie: 200ks Kartón urèenı pre ma¾ovanie pastelkami, uhlíkom, vodovımi farbami aj ako kreatívny materiál pre detskú fantáziu.', '12', 'vykres4f.jpg', 6),
(20, 'Vıkres A2 50 ks - biely', 5, 2, 'Vıkresy technické formát A2.  vhodné na grafiky, kresby a osnovy 180 g/m2', '5', 'vykres2b.jpg', 0),
(21, 'Vıkres A3 10ks 190g - biely', 5, 1, 'Balenie obsahuje 10 ks.  Formát: A3.', '1', 'vykres3b.jpg', 10),
(22, 'ŠKOLSKİ VİKRES A3 Balenie', 5, 1, 'Kresliaci školskı kartón A3, 180g. Balenie obsahuje vıkresy farieb znázornenıch na obrázku , dokopy 50ks v balení.', '5', 'vykres3f.jpg', 10);


-- --------------------------------------------------------

--
-- Štruktúra pre tabu¾ku `zakaznik`
--

CREATE TABLE IF NOT EXISTS `zakaznik` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nazov_firmy` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `meno_priezvisko` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `telefon` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `adresa` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `ico` varchar(11) COLLATE utf8_czech_ci NOT NULL,
  `dic` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `prih_meno` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `ip` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `reg_session` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `prava` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `prih_meno` (`prih_meno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=22 ;

--
-- Naplnenie tabu¾ky `zakaznik` testovacími dátami
--

INSERT INTO `zakaznik` (`id`, `nazov_firmy`, `meno_priezvisko`, `email`, `telefon`, `adresa`, `ico`, `dic`, `prih_meno`, `heslo`, `ip`, `reg_session`, `prava`) VALUES
(20, 'admin a.s', 'ucet_admina', 'matus.ondris@gmail.com', '+421 910 483 342', 'Mánesova 13, 612 00 Brno', '467 653 ', 'SK467 653', 'administrator', '7fcf4ba391c48784edde599889d6e3', '192.168.2.6', '8babb644c3383527382065bfab380bf1', 1),
(21, 'niekto s.r.o.', 'niekto nejaky', 'hodnota1@gmail.com', '+421 903 425 451', 'Boetechova 15, 612 00 Brno', '456 789', 'SK123 456', 'uzivatel1', '70e9b857aca8d91bc6407f76262723', '192.168.16.35', '8babb644c3383527382065bfab380bf1', 0);

