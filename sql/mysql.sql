-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2019 m. Kov 11 d. 15:58
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knygos`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `knygos`
--

DROP TABLE IF EXISTS `knygos`;
CREATE TABLE IF NOT EXISTS `knygos` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(2000) COLLATE utf8_lithuanian_ci NOT NULL,
  `autorius` varchar(2000) COLLATE utf8_lithuanian_ci NOT NULL,
  `zanras` varchar(2000) COLLATE utf8_lithuanian_ci NOT NULL,
  `metai` int(11) NOT NULL,
  `raktai` varchar(5000) COLLATE utf8_lithuanian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Sukurta duomenų kopija lentelei `knygos`
--

INSERT INTO `knygos` (`id`, `pavadinimas`, `autorius`, `zanras`, `metai`, `raktai`) VALUES
(1, 'Skudurinė lėlė', 'Daniel Cole', 'Detektyvas', 2017, ''),
(2, 'Kaip bėga laikas', 'Mary Higgins Clark', 'Detektyvas', 2017, ''),
(3, 'Sirakūzai', 'Delia Ephron', 'Detektyvas', 2017, 'romanas apie kelionę į Sirakūzus ir santuokos gelmes'),
(4, 'Sugrįžimas', 'Hakan Nesser', 'Detektyvas', 2017, 'vieno skaitomiausių švedų kriminalinių istorijų autoriaus detektyvas'),
(5, 'Ydingas ratas', 'Sarah Pinborough', 'Detektyvas', 2017, 'Ydingas ratas: manipuliatyvus psichologinis trileris ir velniškai genialus žaidimas jūsų mintimis, kurį rekomenduoja Stephen King!'),
(6, 'Vienas šūvis', 'Lee Child', 'Detektyvas', 2017, 'įtampos kupinas siužetas, neleisiantis atsipalaiduoti iki pat romano pabaigos'),
(7, 'Mergina traukiny', 'Paula Hawkins', 'Detektyvas', 2016, ''),
(8, 'Persekiotojas', 'Lars Kepler', 'Detektyvas', 2015, 'kone paranoją keliantis Larso Keplerio trileris, kuris dar ilgai neleis užmigti naktimis'),
(9, 'Kartais aš meluoju', 'Alice Feeney', 'Detektyvas', 2017, 'meistriškai sunarpliotas įtempto siužeto psichologinis trileris, kuris privers suabejoti tuo, ką nuoširdžiai laikei tiesa'),
(10, 'Mano sesers kaulai', 'Nuala Ellwood', 'Detektyvas', 2017, ''),
(11, 'Šerloko Holmso ir daktaro Džono H. Vatsono istorijos', 'Artur Conan Doyle', 'Detektyvas', 2017, 'kolekcinis leidimas su originaliomis Sidney Paget ir kt. iliustracijomis. 2 tomai 1-oje knygoje'),
(12, 'Nesidairyk atgal', 'Lee Child', 'Detektyvas', 2017, 'į praeitį nugrimzdusios paslaptys pasivys tada, kai mažiausiai to tikėsies. Įtampos ir netikėtumų kupinas trileris apie Džeką Ryčerį, kurį kine įkūnija pats Tomas'),
(13, 'Fazanų žudikai', 'Jussi Adler-Olsen', 'Detektyvas', 2017, ''),
(14, 'Lūžio taškas, sąmonės akis', 'Hakan Nesser', 'Detektyvas', 2016, ''),
(15, 'Sprogdintoja', 'Liza Marklund', 'Detektyvas', 2017, 'dinamiškas siužetas ir iki paskutinės akimirkos išlaikoma įtampa – naujas populiariausios Skandinavijos detektyvų autorės romanas'),
(16, 'Mergina, kuri žaidė su ugnimi', 'Stieg Larsson', 'Detektyvas', 2017, 'Millennium trilogijos II dalis, pasaulinis fenomenas ir didžiausias detektyvų bestseleris Europoje'),
(17, 'Gelmės', 'Michael Katz Krefeld', 'Detektyvas', 2017, ''),
(18, 'Nematomas žmogus', 'Herbert George Wells', 'Fantastika', 2017, 'mokslinės fantastikos kūrinys, pralenkęs laiką ir jau 140 metų audrinantis skaitytojų protą ir fantaziją. Vėlesnes fantastų kartas įkvėpusi knyga, kurią turi perskaityti kiekvienas išsilavinęs žmogus'),
(19, 'Marsietis', 'Andy Weir', 'Fantastika', 2017, 'pasaulinis superbestseleris, kurį į didžiuosius ekranus ką tik perkėlė Ridley Scottas. Fantastinė knyga, tačiau realistinė iki mažiausių smulkmenų'),
(20, 'Assassins Creed. Renesansas', 'Oliver Bowden', 'Fantastika', 2016, 'romanas pagal vieną geriausių vaizdo žaidimų, kurio įvairioms platformoms parduota per 80 milijonų kopijų'),
(21, 'Musių valdovas', 'William Golding', 'Fantastika', 2016, ''),
(22, 'Džiterburgo kvepalai', 'Tom Robbins', 'Fantastika', 2006, 'populiaraus JAV rašytojo Tomo Robinso įmantriu stiliumi parašytas romanas apie amžiną žmogaus nemirtingumo troškimą'),
(23, 'Moteris juodais drabužiais', 'Susan Hill', 'Fantastika', 2016, 'šiurpinantis pasakojimas apie grėsmingą šmėklą, besivaidenančią mažame Anglijos miestelyje. Klasikinė vaiduoklių istorija, įrodanti, kad šis žanras vis dar gyvas'),
(24, 'Amžinoji naktis', 'Guillermo del Toro, Chuck Hogan', 'Fantastika', 2015, 'Trečioji kūną ir protą prikaustančios istorijos dalis'),
(25, 'Bėgantis labirintu', 'James Dashner', 'Fantastika', 2013, ''),
(26, 'Kaulų ir dūmų duktė', 'Laini Taylor', 'Fantastika', 2012, ''),
(27, 'Žarijos miestas', 'Jeanne DuPrau', 'Fantastika', 2008, ''),
(28, 'Širdies formos dėžutė', 'Joe Hill', 'Fantastika', 2007, ''),
(29, 'Jo didenybės drakonas', 'Naomi Novik', 'Fantastika', 2008, ''),
(30, 'Naktinis filmas', 'Marisha Pessl', 'Fantastika', 2018, ''),
(31, 'Neleisk man išeiti', 'Kazuo Ishiguro', 'Fantastika', 2018, ''),
(32, 'Kainas ir Abelis', 'Jeffrey Archer', 'istoriniai_romanai', 2017, 'per pakilimus ir triumfo akimirkas Kainas su Abeliu siekia pergalės, kuri skirta tik vienam iš jų. Lieka tik klausimas, kada pasikartos Pradžios knygos istorija'),
(33, 'Pirmykštė moteris: Arklių slėnis. 2 knyga', 'Jean M. Auel', 'istoriniai_romanai', 2013, ''),
(34, 'Pirmykštė moteris', 'Jean M. Auel', 'istoriniai_romanai', 2015, 'Išpieštų urvų kraštas - 6-oji pasaulį užkariavusios sagos ŽEMĖS VAIKAI knyga. Net ir dešimtys tūkstančių metų negali pakeisti jaunos moters dramos, plėšančios tarp meilės ir pareigos'),
(35, 'Pirmykštė moteris: Urvinio lokio gentis', 'Jean M. Auel', 'istoriniai_romanai', 2012, ''),
(36, 'Karalienės palikimas', 'Philippa Gregory', 'istoriniai_romanai', 2008, ''),
(37, 'Karalienės juokdarė', 'Philippa Gregory', 'istoriniai_romanai', 2008, ''),
(38, 'Raudonoji karalienė', 'Philippa Gregory', 'istoriniai_romanai', 2011, ''),
(39, 'Atstumtoji karalienė', 'Philippa Gregory', 'istoriniai_romanai', 2009, ''),
(40, 'Karalienės meilužis', 'Philippa Gregory', 'istoriniai_romanai', 2008, ''),
(41, 'Samarkandas', 'Amin Maalouf', 'istoriniai_romanai', 2017, ''),
(42, 'Ponas Zy', 'Gerimantas Statinis', 'istoriniai_romanai', 2017, ''),
(43, 'Dr. Kvadratas: Greimas ir jo semiotika', 'Miglė Anušauskaitė', 'Humoras', 2017, 'Naujas Miglės Anušauskaitės komiksas suaugusiesiems'),
(44, 'Sibiro haiku', 'Jurga Vilė, Lina Itagaki', 'Humoras', 2017, ''),
(45, 'Leičiai. Laiškas karaliui', 'Karolis Zikaras, Tomas Mitkus', 'Humoras', 2016, ''),
(46, 'Leičiai. Dievų ženklas', 'Tomas Mitkus, Karolis Zikaras', 'Humoras', 2016, ''),
(47, 'Leičiai. Dvikova', 'Tomas Mitkus', 'Humoras', 2016, ''),
(48, 'Leičiai. Pirmieji vyrai', 'Tomas Mitkus, Karolis Zikaras', 'Humoras', 2016, ''),
(49, 'Kelionių užrašai', 'Pulgis Andriušis', 'Humoras', 2012, ''),
(50, 'Laivas linksmybių', 'Pulgis Andriušis', 'Humoras', 2014, ''),
(51, 'Vilko valanda. Sidabras. Nuotykai Arizonoje', 'Andrius Tapinas, Tomas Mitkus', 'Humoras', 2015, ''),
(52, 'Kita stotelė', 'Žydrūnas Drungilas', 'Humoras', 2014, ''),
(53, 'Baigtas kriukis', 'Aleksas Dabulskis', 'Humoras', 2014, ''),
(54, 'Sofogramos', 'Aleksandras Bosas', 'Humoras', 2011, ''),
(55, 'Tūla', 'Jurgis Kučinskas', 'lietuviu_proza', 2017, ''),
(56, 'Vyvenimas', 'Beata Tiškevič', 'lietuviu_proza', 2018, 'pirmoji ir itin atvira Beatos Tiškevič knyga'),
(57, 'Laiškas iš praeities', 'Andrėja', 'lietuviu_proza', 2017, 'net ir didžiausios paslaptys vieną dieną iškyla į šviesą. Jaudinanti meilės istorija apie jausmus, kurie gyvena per amžius'),
(58, 'Draugas', 'Darius Tauginas', 'lietuviu_proza', 2017, ''),
(59, 'Meilėje kaip kare', 'Lavisa Spell', 'lietuviu_proza', 2017, 'naujas ir labai jausmingas BŪTI (SU) RAGANA autorės romanas apie meilę, kurioje kaip kare – galima viskas'),
(60, 'Pragaro ambulatorija', 'Andrius Černiauskas', 'lietuviu_proza', 2016, 'dienos ir naktys Skubiosios pagalbos skyriuje'),
(61, 'Nebijok', 'Indrė Vakarė', 'lietuviu_proza', 2016, 'kartais pagalbos sulaukiame iš tų, iš kurių mažiausiai tikimės. Naujausias knygų Juodvilkio dvaras ir Geriausias draugas autorės Indrės Vakarės romanas'),
(62, 'Geriausias draugas', 'Indrė Vakarė', 'lietuviu_proza', 2015, 'ar du artimi žmonės gali būti tik draugais? Karštas romanas – naujausias knygos Juodvilkio dvaras autorės kūrinys'),
(63, 'Aš - Mb = nauja pradžia', 'Jurga Adomo', 'lietuviu_proza', 2014, 'Jurgos Adomo tikrų neištikimybės išgyvenimų bestselerio tęsinys'),
(64, 'Meilės įkaitė', 'Jolita Pamedytytė', 'lietuviu_proza', 2018, 'kur nuneš jauną romano heroję pavojingas aistų verpetas? Naujas intriguojantis lietuvių autorės romanas apie tai, kad meilėje kaip kare – galima viskas! Pagrobimas Brazilijoje, narkotikų barono meilė, netikėti siužeto vingiai'),
(65, 'Minčių srautas', 'Andrius Užkalnis', 'lietuviu_proza', 2018, 'Andrius Užkalnis sugrįžta su geriausias visų laikų tekstais – jų nebuvo knygose, portaluose, žurnaluose! Viskas, ką verta žinoti apie maistą, keliones ir gyvenimą – vienoje ypatingo riboto tiražo net 544 psl. XXL knygoje'),
(66, 'Besielė', 'Aistė Vilkaitė', 'lietuviu_proza', 2017, ''),
(67, '7 metai už grotų', 'Edvinas Krocas', 'lietuviu_proza', 2017, 'necenzūruota kalėjimo realybė. Be cenzūros apie uždarą kalėjimo gyvenimą ir nesuvokiamomis taisyklėmis pagrįstus kalinių tarpusavio santykius');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
