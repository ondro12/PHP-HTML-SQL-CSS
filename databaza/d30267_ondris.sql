SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datab�za: `d30267_ondris`
--

-- --------------------------------------------------------

--
-- �trukt�ra pre tabu�ku `dodavatelia`
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
-- Naplnenie tabu�ky `dodavatelia` testovac�mi d�tami
--

INSERT INTO `dodavatelia` (`id_dodavatela`, `nazovdodavatela`, `adresa`, `email`, `telefon`, `casdorucenia`) VALUES
(1, 'AEL-Umenie, a.s', '�tef�nikova 32 421 08 Ko�ice', 'ael@ael-umenie.sk', '+421 918 321 654', '4 dni'),
(2, 'AIVEL', 'N�mestie Oslobodite�ov 201, Bansk� Bystrica 302 04', 'admin@aivel.sk', '+421 902 102 154', '3 dni'),
(3, 'ALL PAINTS, s.r.o.', '�portov� 85,  054 32 Tren��n ', 'support@allpaints.sk', '+421 908 442 754', '2 dni');

-- --------------------------------------------------------

--
--  �trukt�ra pre tabu�ku `kategoria`
--

CREATE TABLE IF NOT EXISTS `kategoria` (
  `id_kategorie` int(11) NOT NULL,
  `kategoria` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_kategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Naplnenie tabu�ky `kategoria` testovac�mi d�tami
--

INSERT INTO `kategoria` (`id_kategorie`, `kategoria`) VALUES
(1, 'Farby'),
(2, 'Ceruzky'),
(3, 'Voskovky'),
(4, 'Kriedy'),
(5, 'V�kresy');

-- --------------------------------------------------------

--
-- �trukt�ra pre tabu�ku `kosik`
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
-- �trukt�ra pre tabu�ku `naskladnenie`
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
-- Naplnenie tabu�ky `naskladnenie` testovac�mi d�tami 
--

INSERT INTO `naskladnenie` (`id_naskladnenia`, `prih_meno`, `poznamka`, `datumvytvorenia`, `celkovacena`, `stav`) VALUES
(1, 'administrator', '', '2015-11-29 14:28:22', '8', 'Naskladnen�'),
(2, 'administrator', '', '2015-11-28 15:55:23', '7', 'Objednan�');

-- --------------------------------------------------------

--
-- �trukt�ra pre tabu�ku `naskladnenytovar`
--

CREATE TABLE IF NOT EXISTS `naskladnenytovar` (
  `id_naskladnenia` int(11) NOT NULL,
  `id_tovaru` int(11) NOT NULL,
  `mnozstvo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Naplnenie tabu�ky `naskladnenytovar` testovac�mi d�tami  
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
-- �trukt�ra pre tabu�ku `objednanytovar`
--

CREATE TABLE IF NOT EXISTS `objednanytovar` (
  `id_objednavky` int(11) NOT NULL,
  `id_tovaru` int(11) NOT NULL,
  `mnozstvo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Naplnenie tabu�ky `objednanytovar` testovac�mi d�tami   
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
-- �trukt�ra pre tabu�ku `objednavka`
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
-- Naplnenie tabu�ky `objednavka` testovac�mi d�tami 
--

INSERT INTO `objednavka` (`id_objednavky`, `prih_meno`, `poznamka`, `celkovacena`, `zlavovykupon`, `datumvytvorenia`, `stav`, `sposob_dopravy`, `sposob_platby`) VALUES
(35, 'uzivatel1', 'poprosil by som co najrychlejsie', '7', NULL, '2015-11-28 11:41:22', 'Zaevidovan�', 'po�ta', 'dobierka'),
(36, 'uzivatel1', 'to som ja edo', '5', NULL, '2015-11-25 22:10:15', 'Zaevidovan�', 'po�ta', 'dobierka'),
(37, 'uzivatel1', '', '25', NULL, '2015-1-22 15:24:35', 'Zaevidovan�', '', '');

-- --------------------------------------------------------

--
-- �trukt�ra pre tabu�ku `recenziehodnotenia`
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
-- Naplnenie tabu�ky `recenziehodnotenia` testovac�mi d�tami 
--

INSERT INTO `recenziehodnotenia` (`id_recenzie`, `hodnotenie`, `recenzie`, `datum`, `meno`, `email`, `ip`, `produkt`) VALUES
(1, '4', 'Som spokojn� s kvalitou tovaru', '2015-11-28 22:13:33', 'Ondro', 'matusondris@centrum.sk', '10.10.10.219', 2),
(2, '5', 'Je to prestne to co chcem za bezkonkurencnu cenu', '2015-11-25 09:48:52', 'lolo', 'matusondris@centrum.sk', '10.10.10.219', 1),
(3, '5', 'Dokonale prestne to co chcem', '2015-11-26 10:10:10', 'imrich', 'atusondris@centrum.sk', '10.10.10.219', 3),
(4, '2', 'nic moc nepaci sa mi to tu', '2015-11-29 12:36:53', 'xxx', 'anonym@centrum.sk', '10.10.10.219', 5);

-- --------------------------------------------------------

--
-- �trukt�ra pre tabu�ku `tovar`
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
-- Naplnenie tabu�ky `tovar` testovac�mi d�tami
--

INSERT INTO `tovar` (`id_tovaru`, `nazovtovaru`, `kategoria`, `id_dodavatela`, `popisproduktu`, `cena`, `obrazok`, `skladom`) VALUES
(1, 'Farba na sklo 60 ml - �lt�', 1, 1, 'Farba na sklo v plastovej n�dobke s aplik�torom, objem 60 ml.', '1.5', 'zltaf.jpg', 21),
(2, 'Farba na sklo 60 ml - �erven�', 1, 1, 'Transparentn� farba so �peci�lnou vlastnos�ou. Po uschnut� vytvor� hrub� vrstvu, ktor� mo�no aj opakovane nalepi� na hladk� povrch. V�born� pre dekor�cie na okn�, r�m�eky fotografi�, v�zy, f�a�e, lamp�e, a mnoho in�ch hladk�ch objektov.', '1.5', 'cervenaf.jpg', 15),
(3, 'Farba na sklo 60 ml - svetlomodr�', 1, 1, 'Transparentn� farba so �peci�lnou vlastnos�ou. Po uschnut� vytvor� hrub� vrstvu, ktor� mo�no aj opakovane nalepi� na hladk� povrch. V�born� pre dekor�cie na okn�, r�m�eky fotografi�, v�zy, f�a�e, lamp�e, a mnoho in�ch hladk�ch objektov.', '1.5', 'modraf.jpg', 5),
(4, '�pecifik�cia Farba na sklo sada 12 x 10,5 ml', 1, 1, '12-kusov� sada farieb na sklo, dod�van� v plastovom obale s euroz�vesom, objem jednej farby 10,5 ml.', '7', 'sklof.jpg', 12),
(5, 'Temperov� farby Faber-Castell v tube 12 ml, 12 farieb', 1, 1, '�kolsk� temperov� farby.Pou��vajte na papier, lepenku, keramiku. Rozpustn� vo vode, �iariv� a intenz�vne farby.Prisp�soben� vzdel�vac�m potreb�m det�. Neobmedzen� mo�nosti mie�ania farieb.12 farieb v tube. Upozornenie: Nevhodn120901� pre deti do 3. rokov. Balenie obsahuje mal� �asti, hroz� nebezpe�enstvo prehltnutia a udusenia.', '9', 'temperf.jpg', 15),
(6, 'Faber-Castell Vodov� farby 21 farebn�', 1, 1, 'Vodov� farby. �iariv� a jasn� farby s dobrou krycou schopnos�ou.Neobmedzen� mo�nosti mie�ania farieb. Dobr� krycie v�sledky na papieri a in�ch povrchoch. Pre z�bavn� ma�ovanie.S��as�ou balenia je �tetec.Tablety s priemerom 30 mm. 21 farebn�. Garancia:Faber-Castell garantuje spokojnos� z�kazn�kov od roku 1761. Ak nie ste �plne spokojn� s v�robkom, po�lite ho pros�m na bezplatn� v�menu.', '6', 'vodaf.jpg', 18),
(7, 'Pastelky akvarelov� MILAN 24ks so �tetcom', 2, 2, 'Ergonomick� trojhrann�, vo vode rozpustn� farebn� pastelky so syst�mom LPS - ochrany proti pol�maniu. Hladko sa nan�aj� a pridan�m mal�ho mno�stva vody je mo�n� ich roztiera� prilo�en�m �tetcom aj na v��ie plochy. Pastelky s� vyhotoven� z odoln�ho dreva. S�prava obsahuje 24 ks.', '5', 'pastels.jpg', 18),
(8, 'Adeland Grafitov� ceruzky HB s gumou box 72 ks', 2, 2, 'Ceruzky s� ur�en� pre r�zne n�ro�n�ch z�kazn�kov, ke�e balenie obsahuje 72ks nach�dzaj� sa v �om ceruzk� r�znych tvrdost� a t�m p�dom s� vhodn� ako na oby�ajn� geometriu v matematike, technick� kresby , ale dokonca aj na umeleck� pr�ce.', '18.5', 'ceruz.jpg', 8),
(9, 'CRT ceruzka artist black chalk 2', 2, 2, 'Umeleck� ceruzka Black Pastel je ide�lna pre skicovanie a kreslenie. Pou��va sa samostatne alebo zmie�an� s vodou v kombin�cii s ceruzkami z radu CRETACOLOR Sanguine, Sepia a �al��ch produktov. K dispoz�cii v strednej tvrdosti. Obalen� v kvalitnom c�drovom dreve - tak� je ceruzka od Cretacolor.', '1', 'cb.jpg', 50),
(10, 'CRT ceruzka artist white chalk oil 1', 2, 2, 'Biela umeleck� pastelka je vynikaj�ca pre kombinovanie s uhl�kmi: Sanguine a Seppia os renomovanej rak�skej firmy CRETACOLOR a pre zosvetlenie farebn�ch t�nov. K dispoz�cii v dvoch r�znych stup�och tvrdosti.', '1', 'bielacer.jpg', 50),
(11, 'Magick� trojbok� voskovky mix 26 farieb + 4 metallic', 3, 3, 'Magick� trojbok� voskovky s� vyroben� z v�elieho vosku a pr�rodn�ch pigmentov. Tvar voskovky umo��uje dobr� �chop. Voskovky s� nel�mavej, vysoko odoln�, nefarb� prsty a nie s� toxick�. Nan�an�m jednotliv�ch farieb na seba vznik� d�hov� efekt. Na hotov� v�tvory mo�no p�sa� fixkou alebo perom. Voskovky sa na papieri leskn�. S voskovkami m��ete vytv�ra� �elanie, fotoknihy pod. Mo�no ich tie� pou�i� na textil, ale je nutn� ich za�ehli� cez papier na pe�enie. V balen� n�jdete 26 r�znofarebn�ch voskoviek a 4 metalick� Materi�l: v�el� vosk a pr�rodn� pigment Odpor��an� vek: 3 +', '19', 'vosmag.jpg', 14),
(12, 'Crayola trojhrann� voskovky 16ks', 3, 3, 'Sada trojhrann�ch voskoviek, ich ergonomick� tvar je vhodn� pre mal� ruky. Voskovky s� �ahko uchopite�n�. Pre vlastn� tvorbu sl��i 16 r�znych farieb. Kreslenie s mal�mi voskovkymi bude jednoduch�, kreslia rovnomerne a priebe�ne, nemrvia sa a zachov�vaj� si aj �iariv� farby. Rozv�jaj svoju kreativitu a fant�ziu!', '5', 'voskovkylast.jpg', 16),
(13, 'Voskovky do vody s penovou podlo�kou', 3, 3, '�peci�lne vo�av� voskovky do vane zabavia va�ich mal�ch neposedn�kov pri k�pan�. Deti m��u pl�vaj�ce oma�ov�nky vyfarbi� voskovkami, ktor� s� �ahko zm�vate�n� vodou', '7', 'vosvod.jpg', 4),
(14, 'Voskovky Faber-Castell triangular 12 farieb', 3, 3, 'Trojuholn�kov� voskovky. Hrub�, trojuholn�kov� tvar zaru�uje v�voj spr�vneho uchopenia. Lep�ia kontrola pri kreslen� a ma�ovan�. Trojuholn�kov� voskovky zlep�uj� motorick� zru�nosti a koordin�ciu r�k a o��. D�ka 90 mm, priemer 11 mm. 12 farieb v papierovej krabi�ke.', '2.5', 'vos12.jpg', 18),
(15, 'Umel� uhl�k', 4, 2, 'Balenie obsahuje 6 kusov umel�ho uhl�ka na kreslenie. Priemer tuhy je 5,6 mm a d�ka je 120mm.', '2', 'uhlik.jpg', 8),
(16, 'OKR�HLA KRIEDA COLOR & CO SET10 - BIELA', 4, 3, 'Sada pozost�va z 10 kusov bielej okr�hlej kriedy. Okr�hle kriedy na kreslenie s� bezpra�n� a nedrobiv�, ne�pinia ruky. Zna�ka Color & Co sp�ja produkty predov�etk�m pre "mal�ho" umelca. Farby s� bezpe�n� pre deti v s�lade s eur�pskymi normami. Ponuka zah��a akrylov� a temperov� farby, farby a g�ly s trblietkami, kriedy, z�sterky na ma�ovanie, at�.', '1', 'kriedab.jpg', 23),
(17, 'Krieda na ma�ovanie', 4, 1, 'R�znofarebn� kriedy na p�sanie a ma�ovanie na tabu�u s� ulo�en� v prieh�adnej n�dobe s krytom a dr�adlom. Die�a s �ou za�ije ve�a z�bavy a prejav� svoju kreativitu. Krieda je dos� ve�k� aj na ma�ovanie na chodn�k.', '5', 'kriedam.jpg', 17),
(18, 'FAREBN� KRIEDY NA TABU�U', 4, 2, 'Farebn� kriedy na doma, do �koly alebo len tak na hranie.', '0.5', 'kriedaf.jpg', 60),
(19, 'V�kres A4 180g farebn�', 5, 3, 'V�kresy form�tu A4, Balenie: 200ks Kart�n ur�en� pre ma�ovanie pastelkami, uhl�kom, vodov�mi farbami aj ako kreat�vny materi�l pre detsk� fant�ziu.', '12', 'vykres4f.jpg', 6),
(20, 'V�kres A2 50 ks - biely', 5, 2, 'V�kresy technick� form�t A2.  vhodn� na grafiky, kresby a osnovy 180 g/m2', '5', 'vykres2b.jpg', 0),
(21, 'V�kres A3 10ks 190g - biely', 5, 1, 'Balenie obsahuje 10 ks.  Form�t: A3.', '1', 'vykres3b.jpg', 10),
(22, '�KOLSK� V�KRES A3 Balenie', 5, 1, 'Kresliaci �kolsk� kart�n A3, 180g. Balenie obsahuje v�kresy farieb zn�zornen�ch na obr�zku , dokopy 50ks v balen�.', '5', 'vykres3f.jpg', 10);


-- --------------------------------------------------------

--
-- �trukt�ra pre tabu�ku `zakaznik`
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
-- Naplnenie tabu�ky `zakaznik` testovac�mi d�tami
--

INSERT INTO `zakaznik` (`id`, `nazov_firmy`, `meno_priezvisko`, `email`, `telefon`, `adresa`, `ico`, `dic`, `prih_meno`, `heslo`, `ip`, `reg_session`, `prava`) VALUES
(20, 'admin a.s', 'ucet_admina', 'matus.ondris@gmail.com', '+421 910 483 342', 'M�nesova 13, 612 00 Brno', '467 653 ', 'SK467 653', 'administrator', '7fcf4ba391c48784edde599889d6e3', '192.168.2.6', '8babb644c3383527382065bfab380bf1', 1),
(21, 'niekto s.r.o.', 'niekto nejaky', 'hodnota1@gmail.com', '+421 903 425 451', 'Bo�etechova 15, 612 00 Brno', '456 789', 'SK123 456', 'uzivatel1', '70e9b857aca8d91bc6407f76262723', '192.168.16.35', '8babb644c3383527382065bfab380bf1', 0);

