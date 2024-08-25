-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql213.infinityfree.com
-- Generation Time: Aug 25, 2024 at 04:01 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36250918_calculator`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_requests`
--

CREATE TABLE `balance_requests` (
  `id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `amount` int(200) NOT NULL DEFAULT 0,
  `person_name` varchar(255) NOT NULL,
  `status` enum('pending','confirmed','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balance_requests`
--

INSERT INTO `balance_requests` (`id`, `dealer_id`, `request_date`, `amount`, `person_name`, `status`) VALUES
(15, 7, '2024-08-24', 2500, 'sandro pircxalava', 'confirmed'),
(16, 7, '2024-08-23', 2000, 'agshin ahmadzade 145212', 'pending'),
(17, 7, '2024-08-25', 500, 'Bonus', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `code` int(11) NOT NULL,
  `auction` text NOT NULL,
  `auctionuser` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `user_id`, `code`, `auction`, `auctionuser`) VALUES
(1, 7, 2123423, 'Copart', 'test'),
(2, 7, 12345, 'IAAI', 'testwerw'),
(3, 7, 123423423, 'Copart', 'tyyy'),
(4, 7, 23445353, 'IAAI', 'sss'),
(5, 7, 123, 'Copart', 'test1'),
(7, 7, 879508, 'Copart', '879508');

-- --------------------------------------------------------

--
-- Table structure for table `consignee`
--

CREATE TABLE `consignee` (
  `id` int(11) NOT NULL,
  `status` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL,
  `address` varchar(70) NOT NULL,
  `saddress` varchar(70) NOT NULL,
  `zip` int(11) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `type` varchar(40) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `consignee`
--

INSERT INTO `consignee` (`id`, `status`, `firstname`, `lastname`, `country`, `city`, `address`, `saddress`, `zip`, `phone`, `email`, `personal_id`, `type`, `comment`, `user_id`, `company`) VALUES
(1, 'company', 'sandro', 'pirtskhalava', 'AD', 'dsdfs', 'dsfs', 'dsf', 344, '232', 'sdfs@gmail.com', 3333, '0', 'sdfsfs', 1, ''),
(2, 'company', '', '', 'GP', 'dsf', 'sdf 55', 'sdfsdfsd 4', 333, '3333', 'sdfs@gmail.com', 3333, 'Personal', 'sdfsfd', 1, 'sds'),
(3, 'company', '', '', 'HU', 'dd', 'sdf', 'sdf', 444, '444', 'dfs@gmail.com', 444, 'Personal', 'ddd', 1, 'sdf'),
(4, 'company', '', '', 'IQ', 'sdf', 'sdf', 'sdf', 4, '3', 'fsfs@gmail.com', 333, 'Personal', 'sdfs', 1, 'sdfs'),
(5, 'company', '', '', 'AD', 'sdfs', 'asd', 'sdfs', 444, '44', 'dfsfs@gmail.com', 44, 'Personal', 'dfdgdd', 1, 'sds'),
(6, 'company', '', '', 'AE', 'sdf', 'ssdfs 4', 'df', 333, '3333', 'sdfs@gmail.com', 34444, 'Personal', 'sfs', 1, 'sdfs'),
(7, 'private', 'john', 'smith', 'GS', 'fsd', 'sfds 3', 'asfsdfd', 444, '444', 'sandro1211@gmail.com', 44444, 'Personal', 'sdfsfs', 1, ''),
(8, 'private', 'abc', 'ddd', 'AO', 'ssd', 'sdfdsf 4', 'dsfsfs', 344, '4444', 'nugop61@yahoo.com', 4444, 'Personal', 'sdsfs', 1, 's'),
(9, 'private', 'zuzu', 'asfsdfs', 'CG', 'dfd', 'dsf', 'sdfs', 444, '0', 'nugop61@yahoo.com', 33333, 'Business', 'asd', 1, ''),
(10, 'private', 'John', 'Smith', 'AD', 'Andora', 'Test', '', 186, '555555', 'test@gmail.com', 3242, 'Personal', 'ghfhrt', 7, ''),
(11, 'private', 'tural', 'mamedov', 'AZ', 'Baku', 'rastapovic', 'sdadasd', 10001, '834', 'turalmdasdasd', 3453, 'Personal', '', 7, ''),
(12, 'private', 'test', 'test', 'AF', 'sdfsd', 'sdfsdsfd', 'ertdsrffgd', 123, '454444444', 'dasfs@gmail.com', 23453453, 'Personal', 'sdfsdsdf', 7, ''),
(13, 'private', 'sandro', 'mamedov', 'AZ', 'Baku', 'rastapovich', '', 1000, '45451266', 'turallsdasd', 12541231, 'Personal', '', 7, ''),
(14, 'private', 'tural', 'mamedov', 'AZ', 'Baku', 'rastapovich', '', 10001, '995514666683', 'turalmamedovh@gmail.com', 0, 'Personal', '', 8, 's'),
(15, 'private', 'agshin', 'ahmadzade', 'AZ', 'Baku', 'rastapovich', '', 10001, '9595552121', 'tagshiun', 0, '', '', 7, '');

-- --------------------------------------------------------

--
-- Table structure for table `containers`
--

CREATE TABLE `containers` (
  `container_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `container_from` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `containers`
--

INSERT INTO `containers` (`container_id`, `id`, `container_from`, `destination`, `price`) VALUES
(1, 1, 'CHICAGO', 'POTI', 2075),
(2, 2, 'HOUSTON', 'POTI', 1975),
(3, 3, 'LOS ANGELES', 'POTI', 2575),
(4, 4, 'MIAMI', 'POTI', 1875),
(5, 5, 'NEW YORK', 'POTI', 1825),
(6, 6, 'NORFOLK', 'POTI', 1800),
(7, 7, 'SAVANNAH', 'POTI', 1775),
(8, 8, 'SEATTLE', 'POTI', 2575),
(9, 9, 'TORONTO', 'POTI', 2125);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_code` char(2) NOT NULL,
  `country_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_code`, `country_name`) VALUES
('AD', 'Andorra'),
('AE', 'United Arab Emirates'),
('AF', 'Afghanistan'),
('AG', 'Antigua and Barbuda'),
('AI', 'Anguilla'),
('AL', 'Albania'),
('AM', 'Armenia'),
('AN', 'Netherlands Antilles'),
('AO', 'Angola'),
('AQ', 'Antarctica'),
('AR', 'Argentina'),
('AS', 'American Samoa'),
('AT', 'Austria'),
('AU', 'Australia'),
('AW', 'Aruba'),
('AZ', 'Azerbaijan'),
('BA', 'Bosnia and Herzegovina'),
('BB', 'Barbados'),
('BD', 'Bangladesh'),
('BE', 'Belgium'),
('BF', 'Burkina Faso'),
('BG', 'Bulgaria'),
('BH', 'Bahrain'),
('BI', 'Burundi'),
('BJ', 'Benin'),
('BM', 'Bermuda'),
('BN', 'Brunei Darussalam'),
('BO', 'Bolivia'),
('BR', 'Brazil'),
('BS', 'Bahamas'),
('BT', 'Bhutan'),
('BV', 'Bouvet Island'),
('BW', 'Botswana'),
('BY', 'Belarus'),
('BZ', 'Belize'),
('CA', 'Canada'),
('CC', 'Cocos (Keeling) Islands'),
('CD', 'Congo, The Democratic Republic of The'),
('CF', 'Central African Republic'),
('CG', 'Congo'),
('CH', 'Switzerland'),
('CI', 'Cote D\'ivoire'),
('CK', 'Cook Islands'),
('CL', 'Chile'),
('CM', 'Cameroon'),
('CN', 'China'),
('CO', 'Colombia'),
('CR', 'Costa Rica'),
('CS', 'Serbia and Montenegro'),
('CU', 'Cuba'),
('CV', 'Cape Verde'),
('CX', 'Christmas Island'),
('CY', 'Cyprus'),
('CZ', 'Czech Republic'),
('DE', 'Germany'),
('DJ', 'Djibouti'),
('DK', 'Denmark'),
('DM', 'Dominica'),
('DO', 'Dominican Republic'),
('DZ', 'Algeria'),
('EC', 'Ecuador'),
('EE', 'Estonia'),
('EG', 'Egypt'),
('EH', 'Western Sahara'),
('ER', 'Eritrea'),
('ES', 'Spain'),
('ET', 'Ethiopia'),
('FI', 'Finland'),
('FJ', 'Fiji'),
('FK', 'Falkland Islands (Malvinas)'),
('FM', 'Micronesia, Federated States of'),
('FO', 'Faroe Islands'),
('FR', 'France'),
('GA', 'Gabon'),
('GB', 'United Kingdom'),
('GD', 'Grenada'),
('GE', 'Georgia'),
('GF', 'French Guiana'),
('GH', 'Ghana'),
('GI', 'Gibraltar'),
('GL', 'Greenland'),
('GM', 'Gambia'),
('GN', 'Guinea'),
('GP', 'Guadeloupe'),
('GQ', 'Equatorial Guinea'),
('GR', 'Greece'),
('GS', 'South Georgia and The South Sandwich Islands'),
('GT', 'Guatemala'),
('GU', 'Guam'),
('GW', 'Guinea-bissau'),
('GY', 'Guyana'),
('HK', 'Hong Kong'),
('HM', 'Heard Island and Mcdonald Islands'),
('HN', 'Honduras'),
('HR', 'Croatia'),
('HT', 'Haiti'),
('HU', 'Hungary'),
('ID', 'Indonesia'),
('IE', 'Ireland'),
('IL', 'Israel'),
('IN', 'India'),
('IO', 'British Indian Ocean Territory'),
('IQ', 'Iraq'),
('IR', 'Iran, Islamic Republic of'),
('IS', 'Iceland'),
('IT', 'Italy'),
('JM', 'Jamaica'),
('JO', 'Jordan'),
('JP', 'Japan'),
('KE', 'Kenya'),
('KG', 'Kyrgyzstan'),
('KH', 'Cambodia'),
('KI', 'Kiribati'),
('KM', 'Comoros'),
('KN', 'Saint Kitts and Nevis'),
('KP', 'Korea, Democratic People\'s Republic of'),
('KR', 'Korea, Republic of'),
('KW', 'Kuwait'),
('KY', 'Cayman Islands'),
('KZ', 'Kazakhstan'),
('LA', 'Lao People\'s Democratic Republic'),
('LB', 'Lebanon'),
('LC', 'Saint Lucia'),
('LI', 'Liechtenstein'),
('LK', 'Sri Lanka'),
('LR', 'Liberia'),
('LS', 'Lesotho'),
('LT', 'Lithuania'),
('LU', 'Luxembourg'),
('LV', 'Latvia'),
('LY', 'Libyan Arab Jamahiriya'),
('MA', 'Morocco'),
('MC', 'Monaco'),
('MD', 'Moldova, Republic of'),
('MG', 'Madagascar'),
('MH', 'Marshall Islands'),
('MK', 'Macedonia, The Former Yugoslav Republic of'),
('ML', 'Mali'),
('MM', 'Myanmar'),
('MN', 'Mongolia'),
('MO', 'Macao'),
('MP', 'Northern Mariana Islands'),
('MQ', 'Martinique'),
('MR', 'Mauritania'),
('MS', 'Montserrat'),
('MT', 'Malta'),
('MU', 'Mauritius'),
('MV', 'Maldives'),
('MW', 'Malawi'),
('MX', 'Mexico'),
('MY', 'Malaysia'),
('MZ', 'Mozambique'),
('NA', 'Namibia'),
('NC', 'New Caledonia'),
('NE', 'Niger'),
('NF', 'Norfolk Island'),
('NG', 'Nigeria'),
('NI', 'Nicaragua'),
('NL', 'Netherlands'),
('NO', 'Norway'),
('NP', 'Nepal'),
('NR', 'Nauru'),
('NU', 'Niue'),
('NZ', 'New Zealand'),
('OM', 'Oman'),
('PA', 'Panama'),
('PE', 'Peru'),
('PF', 'French Polynesia'),
('PG', 'Papua New Guinea'),
('PH', 'Philippines'),
('PK', 'Pakistan'),
('PL', 'Poland'),
('PM', 'Saint Pierre and Miquelon'),
('PN', 'Pitcairn'),
('PR', 'Puerto Rico'),
('PS', 'Palestinian Territory, Occupied'),
('PT', 'Portugal'),
('PW', 'Palau'),
('PY', 'Paraguay'),
('QA', 'Qatar'),
('RE', 'Reunion'),
('RO', 'Romania'),
('RU', 'Russian Federation'),
('RW', 'Rwanda'),
('SA', 'Saudi Arabia'),
('SB', 'Solomon Islands'),
('SC', 'Seychelles'),
('SD', 'Sudan'),
('SE', 'Sweden'),
('SG', 'Singapore'),
('SH', 'Saint Helena'),
('SI', 'Slovenia'),
('SJ', 'Svalbard and Jan Mayen'),
('SK', 'Slovakia'),
('SL', 'Sierra Leone'),
('SM', 'San Marino'),
('SN', 'Senegal'),
('SO', 'Somalia'),
('SR', 'Suriname'),
('ST', 'Sao Tome and Principe'),
('SV', 'El Salvador'),
('SY', 'Syrian Arab Republic'),
('SZ', 'Swaziland'),
('TC', 'Turks and Caicos Islands'),
('TD', 'Chad'),
('TF', 'French Southern Territories'),
('TG', 'Togo'),
('TH', 'Thailand'),
('TJ', 'Tajikistan'),
('TK', 'Tokelau'),
('TL', 'Timor-leste'),
('TM', 'Turkmenistan'),
('TN', 'Tunisia'),
('TO', 'Tonga'),
('TR', 'Turkey'),
('TT', 'Trinidad and Tobago'),
('TV', 'Tuvalu'),
('TW', 'Taiwan, Province of China'),
('TZ', 'Tanzania, United Republic of'),
('UA', 'Ukraine'),
('UG', 'Uganda'),
('UM', 'United States Minor Outlying Islands'),
('US', 'United States'),
('UY', 'Uruguay'),
('UZ', 'Uzbekistan'),
('VA', 'Holy See (Vatican City State)'),
('VC', 'Saint Vincent and The Grenadines'),
('VE', 'Venezuela'),
('VG', 'Virgin Islands, British'),
('VI', 'Virgin Islands, U.S.'),
('VN', 'Viet Nam'),
('VU', 'Vanuatu'),
('WF', 'Wallis and Futuna'),
('WS', 'Samoa'),
('YE', 'Yemen'),
('YT', 'Mayotte'),
('ZA', 'South Africa'),
('ZM', 'Zambia'),
('ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `from_title` varchar(100) NOT NULL,
  `destination_id` int(11) DEFAULT 0,
  `price` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `from_title`, `destination_id`, `price`) VALUES
(1, 'EDGEWOOD - Maryland - BELAIR AUTO AUCTION', 6, 300),
(2, 'ABILENE - Texas - Copart', 2, 350),
(3, 'ADELANTO - California - Copart', 3, 300),
(4, 'ADP TOWING MAUI - Hawaii - Copart', 3, 2250),
(5, 'ALBANY - New York - Copart', 5, 275),
(6, 'ALBUQUERQUE - New Mexico - Copart', 2, 600),
(7, 'ALTOONA - Pennsylvania - Copart', 5, 450),
(8, 'AMARILLO - Texas - Copart', 2, 525),
(9, 'ANDREWS - Texas - Copart', 2, 425),
(10, 'ANTELOPE - California - Copart', 3, 400),
(11, 'APPLETON - Wisconsin - Copart', 1, 325),
(12, 'ATLANTA EAST - Georgia - Copart', 7, 300),
(13, 'ATLANTA NORTH - Georgia - Copart', 7, 325),
(14, 'ATLANTA SOUTH - Georgia - Copart', 7, 300),
(15, 'ATLANTA WEST - Georgia - Copart', 7, 300),
(16, 'AUSTIN - Texas - Copart', 2, 250),
(17, 'Augusta - Georgia - Copart', 7, 275),
(18, 'BAKERSFIELD - California - Copart', 3, 350),
(19, 'BALTIMORE - Maryland - Copart', 6, 325),
(20, 'BALTIMORE EAST - Maryland - Copart', 6, 325),
(21, 'BATON ROUGE - Louisiana - Copart', 7, 425),
(22, 'BILLINGS - Montana - Copart', 8, 850),
(23, 'BIRMINGHAM - Alabama - Copart', 7, 375),
(24, 'BOISE - Idaho - Copart', 8, 450),
(25, 'Buffalo - New York - Copart', 5, 500),
(26, 'CALGARY - Alberta - Copart', 9, 1450),
(27, 'CANDIA - New Hampshire - Copart', 5, 400),
(28, 'CARTERSVILLE - Georgia - Copart', 7, 300),
(29, 'CHAMBERSBURG - Pennsylvania - Copart', 5, 350),
(30, 'CHARLESTON - West Virginia - Copart', 6, 625),
(31, 'CHICAGO NORTH - Illinois - Copart', 1, 180),
(32, 'CHICAGO SOUTH - Illinois - Copart', 1, 180),
(33, 'CHICAGO SOUTH-Woodmar/Heights sublot - Illinois - Copart', 1, 180),
(34, 'CHINA GROVE - North Carolina - Copart', 6, 300),
(35, 'CICERO - Indiana - Copart', 1, 300),
(36, 'CLEVELAND EAST - Ohio - Copart', 6, 550),
(37, 'CLEVELAND WEST - Ohio - Copart', 6, 550),
(38, 'COLORADO SPRINGS - Colorado - Copart', 1, 650),
(39, 'COLUMBUS - Ohio - Copart', 6, 550),
(40, 'CONCORD - North Carolina - Copart', 6, 300),
(41, 'CORPUS CHRISTI - Texas - Copart', 2, 275),
(42, 'CRASHEDTOYS ATLANTA - Georgia - Copart', 7, 275),
(43, 'CRASHEDTOYS DALLAS - Texas - Copart', 2, 275),
(44, 'CRASHEDTOYS SACRAMENTO - California - Copart', 3, 300),
(45, 'DALLAS - Texas - Copart', 2, 275),
(46, 'DALLAS SOUTH - Texas - Copart', 2, 275),
(47, 'DANVILLE - Virginia - Copart', 6, 300),
(48, 'DAVENPORT - 169 Davenport sublot - Iowa - Copart', 1, 325),
(49, 'DAVENPORT - Iowa - Copart', 1, 325),
(50, 'DAYTON - Ohio - Copart', 6, 550),
(51, 'DENVER - Colorado - Copart', 1, 650),
(52, 'DENVER CENTRAL - Colorado - Copart', 1, 650),
(53, 'DENVER SOUTH - Colorado - Copart', 1, 650),
(54, 'DES MOINES - Iowa - Copart', 1, 400),
(55, 'DETROIT - Michigan - Copart', 1, 400),
(56, 'DK TOWING KAUAI - Hawaii - Copart', 3, 2750),
(57, 'DK TOWING KAUAI - Hawaii - Copart', 10, 1750),
(58, 'DOTHAN - Alabama - Copart', 7, 375),
(59, 'DYER - Indiana - Copart', 1, 180),
(60, 'EARLINGTON - Kentucky - Copart', 7, 550),
(61, 'EDMONTON - Alberta - Copart', 9, 1450),
(62, 'EL PASO - Texas - Copart', 2, 425),
(63, 'EUGENE - Oregon - Copart', 8, 375),
(64, 'EXETER - Rhode Island - Copart', 5, 350),
(65, 'FAIRBURN - Georgia - Copart', 7, 275),
(66, 'FAYETTEVILLE - Arkansas - Copart', 2, 475),
(67, 'FLINT - Michigan - Copart', 1, 450),
(68, 'FORT WAYNE - Indiana - Copart', 1, 300),
(69, 'FREDERICKSBURG - Virginia - Copart', 6, 250),
(70, 'FREETOWN - Massachusetts - Copart', 5, 375),
(71, 'FRESNO - California - Copart', 3, 375),
(72, 'FT. PIERCE - Florida - Copart', 4, 200),
(73, 'FT. WORTH - Texas - Copart', 2, 275),
(74, 'GASTONIA - North Carolina - Copart', 6, 325),
(75, 'GLASSBORO EAST - New Jersey - Copart', 5, 200),
(76, 'GLASSBORO WEST - New Jersey - Copart', 5, 200),
(77, 'GRAHAM - Washington - Copart', 8, 150),
(78, 'Grenada - Mississippi - Copart', 7, 425),
(79, 'HALIFAX - Nova Scotia - Copart', 9, 1200),
(80, 'HAMPTON - Virginia - Copart', 6, 150),
(81, 'HARRISBURG - Pennsylvania - Copart', 5, 275),
(82, 'HARTFORD - Connecticut - Copart', 5, 225),
(83, 'HARTFORD SPRINGFIELD - Connecticut - Copart', 5, 250),
(84, 'HAYWARD - California - Copart', 3, 400),
(85, 'HELENA - Montana - Copart', 8, 750),
(86, 'HONOLULU - Hawaii - Copart', 10, 120),
(87, 'HOUSTON - Texas - Copart', 2, 180),
(88, 'HOUSTON EAST - Texas - Copart', 2, 180),
(89, 'INDIANAPOLIS - Indiana - Copart', 1, 300),
(90, 'IONIA - Michigan - Copart', 1, 400),
(91, 'JACKSON - Mississippi - Copart', 7, 425),
(92, 'JACKSONVILLE EAST - Florida - Copart', 7, 225),
(93, 'JACKSONVILLE NORTH - Florida - Copart', 7, 225),
(94, 'JACKSONVILLE WEST - Florida - Copart', 7, 225),
(95, 'KANSAS CITY - Kansas - Copart', 7, 625),
(96, 'KENS TOWING HILO - Hawaii - Copart', 3, 2100),
(97, 'KINCHELOE - Michigan - Copart', 1, 750),
(98, 'KNOXVILLE - Tennessee - Copart', 7, 400),
(99, 'LANSING - Michigan - Copart', 1, 400),
(100, 'LAS VEGAS - Nevada - Copart', 3, 325),
(101, 'LAS VEGAS WEST - Nevada - Copart', 3, 375),
(102, 'LEXINGTON EAST - Kentucky - Copart', 7, 550),
(103, 'LEXINGTON WEST - Kentucky - Copart', 7, 550),
(104, 'LINCOLN - Nebraska - Copart', 1, 450),
(105, 'LITTLE ROCK - Arkansas - Copart', 2, 450),
(106, 'LONDON - Ontario - Copart', 9, 250),
(107, 'LONG BEACH - California - Copart', 3, 150),
(108, 'LONG ISLAND - New York - Copart', 5, 250),
(109, 'LONGVIEW - Texas - Copart', 2, 275),
(110, 'LOS ANGELES - California - Copart', 3, 160),
(111, 'LOUISVILLE - Kentucky - Copart', 7, 550),
(112, 'LUFKIN - Texas - Copart', 2, 275),
(113, 'LUMBERTON - North Carolina - Copart', 6, 300),
(114, 'LYMAN - Maine - Copart', 5, 475),
(115, 'MACON - Georgia - Copart', 7, 250),
(116, 'MADISON - Wisconsin - Copart', 1, 300),
(117, 'MADISON SOUTH - Wisconsin - Copart', 1, 300),
(118, 'MARTINEZ - California - Copart', 3, 400),
(119, 'MCALLEN - Texas - Copart', 2, 350),
(120, 'MEBANE - North Carolina - Copart', 6, 300),
(121, 'MEMPHIS - Tennessee - Copart', 7, 500),
(122, 'MENTONE - California - Copart', 3, 300),
(123, 'MIAMI CENTRAL - Florida - Copart', 4, 125),
(124, 'MIAMI NORTH - Florida - Copart', 4, 125),
(125, 'MIAMI SOUTH - Florida - Copart', 4, 150),
(126, 'MILWAUKEE - Wisconsin - Copart', 1, 225),
(127, 'MILWAUKEE NORTH - Wisconsin - Copart', 1, 225),
(128, 'MILWAUKEE SOUTH - Wisconsin - Copart', 1, 225),
(129, 'MINNEAPOLIS - Minnesota - Copart', 1, 450),
(130, 'MINNEAPOLIS NORTH - Minnesota - Copart', 1, 450),
(131, 'MO - COLUMBIA - Missouri - Copart', 7, 625),
(132, 'MOBILE - Alabama - Copart', 7, 400),
(133, 'MOBILE SOUTH - Alabama - Copart', 7, 400),
(134, 'MOCKSVILLE - North Carolina - Copart', 6, 300),
(135, 'MONCTON - New Brunswick - Copart', 9, 1275),
(136, 'MONTGOMERY - Alabama - Copart', 7, 400),
(137, 'MONTREAL - Quebec - Copart', 9, 500),
(138, 'N.Boston-ROWLEY Sublot - Massachusetts - Copart', 5, 450),
(139, 'NASHVILLE - Tennessee - Copart', 7, 400),
(140, 'NEW ORLEANS - Louisiana - Copart', 7, 425),
(141, 'NEWBURGH - New York - Copart', 5, 225),
(142, 'NORTH BOSTON - Massachusetts - Copart', 5, 375),
(143, 'NORTH CHARLESTON - South Carolina - Copart', 7, 275),
(144, 'NORTH SEATTLE - Washington - Copart', 8, 200),
(145, 'OCALA - Florida - Copart', 4, 300),
(146, 'OGDEN - Utah - Copart', 3, 550),
(147, 'OKLAHOMA CITY - Oklahoma - Copart', 2, 400),
(148, 'ORLANDO - Florida - Copart', 4, 250),
(149, 'ORLANDO NORTH - Florida - Copart', 4, 250),
(150, 'ORLANDO SOUTH - Florida - Copart', 4, 250),
(151, 'OTTAWA - Ontario - Copart', 9, 475),
(152, 'PASCO - Washington - Copart', 8, 350),
(153, 'PEORIA - Illinois - Copart', 1, 300),
(154, 'PHILADELPHIA - Pennsylvania - Copart', 5, 200),
(155, 'PHILADELPHIA EAST-SUBLOT - Pennsylvania - Copart', 5, 200),
(156, 'PHOENIX - Arizona - Copart', 3, 350),
(157, 'PITTSBURGH EAST - Pennsylvania - Copart', 5, 400),
(158, 'PITTSBURGH NORTH - Pennsylvania - Copart', 5, 450),
(159, 'PITTSBURGH SOUTH - Pennsylvania - Copart', 5, 450),
(160, 'PITTSBURGH WEST - Pennsylvania - Copart', 5, 450),
(161, 'PORTLAND NORTH - Oregon - Copart', 8, 250),
(162, 'PORTLAND SOUTH - Oregon - Copart', 8, 300),
(163, 'PUNTA GORDA - Florida - Copart', 4, 225),
(164, 'PUNTA GORDA SOUTH - Florida - Copart', 4, 275),
(165, 'RALEIGH - North Carolina - Copart', 6, 300),
(166, 'RANCHO CUCAMONGA - California - Copart', 3, 200),
(167, 'REDDING - California - Copart', 3, 800),
(168, 'RENO - Nevada - Copart', 3, 550),
(169, 'RICHMOND - Virginia - Copart', 6, 175),
(170, 'RICHMOND EAST - Virginia - Copart', 6, 175),
(171, 'ROCHESTER - New York - Copart', 5, 450),
(172, 'RUTLAND - Vermont - Copart', 5, 500),
(173, 'SACRAMENTO - California - Copart', 3, 400),
(174, 'SALT LAKE CITY - Utah - Copart', 3, 650),
(175, 'SALT LAKE CITY NORTH - Utah - Copart', 3, 550),
(176, 'SAN ANTONIO - Texas - Copart', 2, 300),
(177, 'SAN BERNARDINO - California - Copart', 3, 200),
(178, 'SAN DIEGO - California - Copart', 3, 300),
(179, 'SAN JOSE - California - Copart', 3, 400),
(180, 'SAVANNAH - Georgia - Copart', 7, 125),
(181, 'SAVANNAH / VERTIA SUBLOT-Georgia Copart - Georgia - Copart', 7, 175),
(182, 'SC - COLUMBIA - South Carolina - Copart', 7, 275),
(183, 'SCRANTON - Pennsylvania - Copart', 5, 250),
(184, 'SEAFORD - Delaware - Copart', 5, 325),
(185, 'SHREVEPORT - Louisiana - Copart', 2, 315),
(186, 'SIKESTON - Missouri - Copart', 1, 475),
(187, 'SO SACRAMENTO - California - Copart', 3, 400),
(188, 'SOMERVILLE - New Jersey - Copart', 5, 150),
(189, 'SOUTH BOSTON - Massachusetts - Copart', 5, 375),
(190, 'SPARTANBURG - South Carolina - Copart', 7, 300),
(191, 'SPOKANE - Washington - Copart', 8, 350),
(192, 'SPRINGFIELD - Missouri - Copart', 7, 625),
(193, 'ST. CLOUD - Minnesota - Copart', 1, 500),
(194, 'ST. JOHN\'S - Newfoundland and Lab - Copart', 9, 1850),
(195, 'ST. LOUIS - Missouri - Copart', 7, 575),
(196, 'SUN VALLEY - California - Copart', 3, 200),
(197, 'SYRACUSE - New York - Copart', 5, 325),
(198, 'Southern Illinois - Illinois - Copart', 7, 575),
(199, 'TALLAHASSEE - Florida - Copart', 7, 325),
(200, 'TAMPA SOUTH - Florida - Copart', 4, 250),
(201, 'TAMPA SOUTH - Mulberry Sublot - Florida - Copart', 4, 275),
(202, 'TANNER - Alabama - Copart', 7, 425),
(203, 'TIFTON - Georgia - Copart', 7, 275),
(204, 'TORONTO - Ontario - Copart', 9, 225),
(205, 'TOW GUYS KAMUELA - Hawaii - Copart', 3, 2300),
(206, 'TRENTON - New Jersey - Copart', 5, 150),
(207, 'TUCSON - Arizona - Copart', 3, 400),
(208, 'TULSA - Oklahoma - Copart', 2, 475),
(209, 'VALLEJO - California - Copart', 3, 400),
(210, 'VAN NUYS - California - Copart', 3, 200),
(211, 'WACO - Texas - Copart', 2, 325),
(212, 'WALTON - Kentucky - Copart', 7, 550),
(213, 'WASHINGTON DC - Maryland - Copart', 6, 300),
(214, 'WAYLAND - Michigan - Copart', 1, 400),
(215, 'WEBSTER - New Hampshire - Copart', 5, 400),
(216, 'WEST PALM BEACH - Florida - Copart', 4, 170),
(217, 'WEST WARREN - Massachusetts - Copart', 5, 375),
(218, 'WHEELING - Illinois - Copart', 1, 180),
(219, 'WICHITA - Kansas - Copart', 2, 550),
(220, 'Windham - Maine - Copart', 5, 475),
(221, 'YORK HAVEN - Pennsylvania - Copart', 5, 275),
(222, 'Dyer Auto Auction - Indiana - Dyer Auto Auction', 1, 180),
(223, 'ABILENE - Texas - IAAI', 2, 350),
(224, 'ACE - Carson - California - IAAI', 3, 160),
(225, 'ACE - PERRIS 2 - California - IAAI', 3, 275),
(226, 'ACE - Perris - California - IAAI', 3, 250),
(227, 'AKRON-CANTON - Ohio - IAAI', 6, 550),
(228, 'ALBANY - New York - IAAI', 5, 275),
(229, 'ALBUQUERQUE - New Mexico - IAAI', 2, 600),
(230, 'ALTOONA - Pennsylvania - IAAI', 5, 450),
(231, 'AMARILLO - Texas - IAAI', 2, 525),
(232, 'ANAHEIM - California - IAAI', 3, 200),
(233, 'ANCHORAGE - Alaska - IAAI', 11, 0),
(234, 'APPLETON - Wisconsin - IAAI', 1, 325),
(235, 'ASHEVILLE - North Carolina - IAAI', 6, 400),
(236, 'ASHLAND - Kentucky - IAAI', 1, 0),
(237, 'ATLANTA - Georgia - IAAI', 7, 300),
(238, 'ATLANTA EAST - Georgia - IAAI', 7, 325),
(239, 'ATLANTA NORTH - Georgia - IAAI', 7, 300),
(240, 'ATLANTA SOUTH - Georgia - IAAI', 7, 300),
(241, 'AUSTIN - Texas - IAAI', 2, 250),
(242, 'AVENEL NEW JERSEY - New Jersey - IAAI', 5, 125),
(243, 'BALTIMORE - Maryland - IAAI', 6, 350),
(244, 'BATON ROUGE - Louisiana - IAAI', 7, 475),
(245, 'BILLINGS - Montana - IAAI', 8, 850),
(246, 'BIRMINGHAM - Alabama - IAAI', 7, 375),
(247, 'BOISE - Idaho - IAAI', 8, 450),
(248, 'BOSTON - SHIRLEY - Massachusetts - IAAI', 5, 375),
(249, 'BOWLING GREEN - Kentucky - IAAI', 1, 0),
(250, 'BRIDGEPORT - Pennsylvania - IAAI', 5, 200),
(251, 'BUCKHANNON - West Virginia - IAAI', 6, 625),
(252, 'BUFFALO - New York - IAAI', 5, 500),
(253, 'BURLINGTON - Vermont - IAAI', 5, 500),
(254, 'BZ Trucking - Hawaii - IAAI', 3, 2300),
(255, 'CENTRAL NEW JERSEY - New Jersey - IAAI', 5, 150),
(256, 'CHARLESTON - South Carolina - IAAI', 7, 275),
(257, 'CHARLOTTE - North Carolina - IAAI', 6, 300),
(258, 'CHATTANOOGA - Tennessee - IAAI', 7, 475),
(259, 'CHICAGO-NORTH - Illinois - IAAI', 1, 180),
(260, 'CHICAGO-SOUTH - Illinois - IAAI', 1, 180),
(261, 'CHICAGO-WEST - Illinois - IAAI', 1, 180),
(262, 'CINCINNATI - Ohio - IAAI', 6, 550),
(263, 'CINCINNATI SOUTH - Ohio - IAAI', 6, 550),
(264, 'CLEARWATER - Florida - IAAI', 4, 250),
(265, 'CLEVELAND - Ohio - IAAI', 6, 550),
(266, 'COLTON - California - IAAI', 3, 200),
(267, 'COLUMBIA - South Carolina - IAAI', 7, 275),
(268, 'COLUMBUS - Ohio - IAAI', 6, 550),
(269, 'CONCORD - North Carolina - IAAI', 6, 300),
(270, 'CORPUS CHRISTI - Texas - IAAI', 2, 275),
(271, 'CULPEPER - Virginia - IAAI', 6, 250),
(272, 'Colorado Springs - Colorado - IAAI', 1, 650),
(273, 'D&D TOWING INC MAUI - Hawaii - IAAI', 3, 2400),
(274, 'DALLAS - Texas - IAAI', 2, 275),
(275, 'DAVENPORT - Iowa - IAAI', 1, 325),
(276, 'DAYTON - Ohio - IAAI', 6, 550),
(277, 'DC TOWING HILO - Hawaii - IAAI', 3, 2100),
(278, 'DENVER - Colorado - IAAI', 1, 650),
(279, 'DENVER EAST - Colorado - IAAI', 1, 650),
(280, 'DES MOINES - Iowa - IAAI', 1, 400),
(281, 'DETROIT - Michigan - IAAI', 1, 400),
(282, 'DOTHAN - Alabama - IAAI', 7, 375),
(283, 'DUNDALK - Maryland - IAAI', 6, 300),
(284, 'Dallas/Ft Worth - Texas - IAAI', 2, 275),
(285, 'EAST BAY - California - IAAI', 3, 400),
(286, 'EL PASO - Texas - IAAI', 2, 425),
(287, 'ERIE - Pennsylvania - IAAI', 5, 500),
(288, 'EUGENE - Oregon - IAAI', 8, 375),
(289, 'Elkton - Maryland - IAAI', 6, 350),
(290, 'Englishtown - New Jersey - IAAI', 5, 150),
(291, 'FARGO - North Dakota - IAAI', 1, 650),
(292, 'FAYETTEVILLE - Arkansas - IAAI', 2, 475),
(293, 'FLINT - Michigan - IAAI', 1, 450),
(294, 'FONTANA - California - IAAI', 3, 200),
(295, 'FORT MYERS - Florida - IAAI', 4, 250),
(296, 'FORT PIERCE - Florida - IAAI', 4, 200),
(297, 'FREMONT - California - IAAI', 3, 400),
(298, 'FRESNO - California - IAAI', 3, 375),
(299, 'Fort Wayne - Indiana - IAAI', 1, 300),
(300, 'Fort Worth North - Texas - IAAI', 2, 275),
(301, 'Fredericksburg-South - Virginia - IAAI', 6, 250),
(302, 'GRAND RAPIDS - Michigan - IAAI', 1, 400),
(303, 'GREENSBORO - North Carolina - IAAI', 6, 300),
(304, 'GREENVILLE - South Carolina - IAAI', 7, 300),
(305, 'GRENADA - Mississippi - IAAI', 7, 425),
(306, 'GULF COAST - Mississippi - IAAI', 7, 400),
(307, 'HARTFORD - Connecticut - IAAI', 5, 225),
(308, 'HARTFORD-SOUTH - Connecticut - IAAI', 5, 225),
(309, 'HIGH DESERT - California - IAAI', 3, 300),
(310, 'HIGH POINT - North Carolina - IAAI', 6, 300),
(311, 'HONOLULU - Hawaii - IAAI', 10, 120),
(312, 'HOUSTON - Texas - IAAI', 2, 180),
(313, 'HOUSTON SOUTH - Texas - IAAI', 2, 180),
(314, 'HOUSTON-NORTH - Texas - IAAI', 2, 165),
(315, 'HUNTSVILLE - Alabama - IAAI', 7, 450),
(316, 'INDIANAPOLIS - Indiana - IAAI', 1, 300),
(317, 'Indianapolis South - Indiana - IAAI', 7, 600),
(318, 'JACKSON - Mississippi - IAAI', 7, 425),
(319, 'JACKSONVILLE - Florida - IAAI', 7, 225),
(320, 'KANSAS CITY - Kansas - IAAI', 7, 625),
(321, 'KNOXVILLE - Tennessee - IAAI', 7, 400),
(322, 'Kansas City East - Missouri - IAAI', 7, 625),
(323, 'LAFAYETTE - Louisiana - IAAI', 7, 400),
(324, 'LAS VEGAS - (OLD) - Nevada - IAAI', 3, 325),
(325, 'LAS VEGAS - Nevada - IAAI', 3, 375),
(326, 'LAUREL - Maryland - IAAI', 6, 300),
(327, 'LEE\'S TOWING KAUAI - Hawaii - IAAI', 10, 1750),
(328, 'LEE\'S TOWING KAUAI - Hawaii - IAAI', 3, 2750),
(329, 'LINCOLN - Illinois - IAAI', 1, 300),
(330, 'LITTLE ROCK - Arkansas - IAAI', 2, 450),
(331, 'LONG ISLAND - New York - IAAI', 5, 250),
(332, 'LONGVIEW - Texas - IAAI', 2, 275),
(333, 'LOS ANGELES - California - IAAI', 3, 160),
(334, 'LOUISVILLE - Kentucky - IAAI', 7, 550),
(335, 'LOUISVILLE NORTH - Kentucky - IAAI', 7, 550),
(336, 'LUBBOCK - Texas - IAAI', 2, 450),
(337, 'Lexington - South Carolina - IAAI', 7, 250),
(338, 'Los Angeles South - California - IAAI', 3, 150),
(339, 'MACON - Georgia - IAAI', 7, 275),
(340, 'MANCHESTER - New Hampshire - IAAI', 5, 400),
(341, 'MCALLEN - Texas - IAAI', 2, 350),
(342, 'MEMPHIS - Tennessee - IAAI', 7, 500),
(343, 'METRO DC - Maryland - IAAI', 6, 300),
(344, 'MIAMI - Florida - IAAI', 4, 125),
(345, 'MIAMI-NORTH - Florida - IAAI', 4, 150),
(346, 'MILWAUKEE - Wisconsin - IAAI', 1, 225),
(347, 'MINNEAPOLIS/ST. PAUL - Minnesota - IAAI', 1, 450),
(348, 'MISSOULA - Montana - IAAI', 8, 600),
(349, 'Minneapolis South - Minnesota - IAAI', 1, 450),
(350, 'NASHVILLE - Tennessee - IAAI', 7, 400),
(351, 'NEW CASTLE - Delaware - IAAI', 5, 250),
(352, 'NEW ORLEANS - Louisiana - IAAI', 7, 425),
(353, 'NEW ORLEANS EAST - Louisiana - IAAI', 7, 425),
(354, 'NEWBURGH - New York - IAAI', 5, 225),
(355, 'NORTH HOLLYWOOD - California - IAAI', 3, 200),
(356, 'NORTHERN NEW JERSEY - New Jersey - IAAI', 5, 125),
(357, 'NORTHERN VIRGINIA - Virginia - IAAI', 6, 250),
(358, 'New Orleans and Louisiana Flood - Louisiana - IAAI', 7, 425),
(359, 'OKLAHOMA CITY - Oklahoma - IAAI', 2, 400),
(360, 'OMAHA - Nebraska - IAAI', 1, 450),
(361, 'ORLANDO - Florida - IAAI', 4, 250),
(362, 'ORLANDO-NORTH - Florida - IAAI', 4, 250),
(363, 'PADUCAH - Kentucky - IAAI', 1, 0),
(364, 'PENSACOLA - Florida - IAAI', 4, 400),
(365, 'PERMIAN BASIN - Texas - IAAI', 2, 450),
(366, 'PHILADELPHIA - Pennsylvania - IAAI', 5, 200),
(367, 'PHOENIX - Arizona - IAAI', 3, 350),
(368, 'PITTSBURGH - Pennsylvania - IAAI', 5, 450),
(369, 'PITTSBURGH-NORTH - Pennsylvania - IAAI', 5, 450),
(370, 'PORT MURRAY - New Jersey - IAAI', 5, 175),
(371, 'PORTAGE - Wisconsin - IAAI', 1, 300),
(372, 'PORTLAND - GORHAM - Maine - IAAI', 5, 475),
(373, 'PORTLAND - Oregon - IAAI', 8, 250),
(374, 'PORTLAND SOUTH - Oregon - IAAI', 8, 300),
(375, 'PROVIDENCE - Rhode Island - IAAI', 5, 350),
(376, 'PULASKI - Virginia - IAAI', 6, 400),
(377, 'Philadelphia East - Pennsylvania - IAAI', 5, 200),
(378, 'Portland West - Oregon - IAAI', 8, 250),
(379, 'RALEIGH - North Carolina - IAAI', 6, 300),
(380, 'RENO - Nevada - IAAI', 3, 550),
(381, 'RICHMOND - Virginia - IAAI', 6, 200),
(382, 'ROANOKE - Virginia - IAAI', 6, 375),
(383, 'ROCHESTER - New York - IAAI', 5, 450),
(384, 'ROSEDALE - Maryland - IAAI', 6, 350),
(385, 'SACRAMENTO - California - IAAI', 3, 400),
(386, 'SALT LAKE CITY - Utah - IAAI', 3, 550),
(387, 'SAN ANTONIO - Texas - IAAI', 2, 300),
(388, 'SAN ANTONIO-SOUTH - Texas - IAAI', 2, 300),
(389, 'SAN BERNARDINO - California - IAAI', 3, 250),
(390, 'SAN DIEGO - California - IAAI', 3, 300),
(391, 'SAVANNAH - Georgia - IAAI', 7, 125),
(392, 'SCRANTON - Pennsylvania - IAAI', 5, 250),
(393, 'SEATTLE - Washington - IAAI', 8, 175),
(394, 'SHADY SPRING - West Virginia - IAAI', 6, 625),
(395, 'SHREVEPORT - Louisiana - IAAI', 2, 315),
(396, 'SIOUX FALLS - South Dakota - IAAI', 1, 650),
(397, 'SOUTH BEND - Indiana - IAAI', 1, 250),
(398, 'SOUTHERN NEW JERSEY - New Jersey - IAAI', 5, 200),
(399, 'SPOKANE - Washington - IAAI', 8, 350),
(400, 'SPRINGFIELD - Missouri - IAAI', 7, 625),
(401, 'ST. LOUIS - Illinois - IAAI', 7, 575),
(402, 'SYRACUSE - New York - IAAI', 5, 325),
(403, 'Sayreville - New Jersey - IAAI', 5, 150),
(404, 'Suffolk - Virginia - IAAI', 6, 150),
(405, 'TAMPA - Florida - IAAI', 4, 250),
(406, 'TAUNTON - Massachusetts - IAAI', 5, 375),
(407, 'TIDEWATER - Virginia - IAAI', 6, 150),
(408, 'TIFTON - Georgia - IAAI', 7, 275),
(409, 'TUCSON - Arizona - IAAI', 3, 400),
(410, 'TULSA - Oklahoma - IAAI', 2, 475),
(411, 'Tampa North - Florida - IAAI', 4, 275),
(412, 'Templeton - Massachusetts - IAAI', 5, 375),
(413, 'WEST PALM BEACH - Florida - IAAI', 4, 180),
(414, 'WESTERN COLORADO - Colorado - IAAI', 1, 0),
(415, 'WICHITA - Kansas - IAAI', 2, 550),
(416, 'WILMINGTON - North Carolina - IAAI', 6, 375),
(417, 'YORK SPRINGS - Pennsylvania - IAAI', 5, 275);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `user_id`, `discount`) VALUES
(1, 7, 500),
(2, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fines`
--

CREATE TABLE `fines` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `debt` decimal(10,0) NOT NULL DEFAULT 0,
  `comment` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `fines`
--

INSERT INTO `fines` (`id`, `vehicle_id`, `debt`, `comment`) VALUES
(42, 67, '1825', 'Shipping'),
(43, 67, '100', 'test'),
(44, 67, '20', 'test'),
(45, 68, '1825', 'Shipping'),
(46, 69, '1750', 'Shipping');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `details` varchar(500) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action`, `details`, `timestamp`) VALUES
(33, 0, 'DISCOUNT', '20 was gifted to root vehicle 1G11H5SL2EF143790', '2024-08-24 19:34:23'),
(34, 7, 'Payment', 'User \'root\' paid 1000 for vehicle with VIN \'1G11H5SL2EF143790\'', '2024-08-24 20:06:30'),
(35, 7, 'Payment', 'User \'root\' paid 825 for vehicle with VIN \'JF2SJAAC5EH529443\'', '2024-08-24 20:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('dealer','admin','accountant') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `pbalance` int(200) NOT NULL DEFAULT 0,
  `nbalance` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `name`, `phone`, `pbalance`, `nbalance`) VALUES
(1, 'admin', 'sandro', 'e2fc714c4727ee9395f324cd2e7f331f', 'sandro pirtskhalava', '', 100, 0),
(7, 'dealer', 'root', '2c6db08891fd412aaaf76587520787a9', 'root', NULL, 3325, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `auction` varchar(50) NOT NULL,
  `branch` varchar(80) NOT NULL,
  `dest` text NOT NULL,
  `vin` varchar(80) NOT NULL,
  `year` int(11) NOT NULL,
  `lot` int(11) NOT NULL,
  `price` int(20) NOT NULL,
  `dt` date NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `consigne_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` text NOT NULL,
  `image_paths` varchar(500) DEFAULT NULL,
  `debt` int(11) DEFAULT 0,
  `booking_id` int(100) DEFAULT 0,
  `container_id` int(200) DEFAULT NULL,
  `has_key` text DEFAULT NULL,
  `container_name` text DEFAULT NULL,
  `pickup` varchar(500) DEFAULT NULL,
  `warehouse` varchar(500) DEFAULT NULL,
  `georgia` varchar(500) DEFAULT NULL,
  `insurance` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `make`, `model`, `auction`, `branch`, `dest`, `vin`, `year`, `lot`, `price`, `dt`, `buyer_id`, `consigne_id`, `user_id`, `status`, `image_paths`, `debt`, `booking_id`, `container_id`, `has_key`, `container_name`, `pickup`, `warehouse`, `georgia`, `insurance`) VALUES
(67, 'Chevrolet', 'Malibu', 'Copart', 'ABILENE - Texas - Copart', '', '1G11H5SL2EF143790', 2014, 111, 5000, '2024-08-05', 0, 11, 7, 'Pending', '', 705, 0, 0, '', 'MIAMI', NULL, NULL, NULL, 'No'),
(68, 'Subaru', 'Forester', 'IAAI', 'BUFFALO - New York - IAAI', '', 'JF2SJAAC5EH529443', 2014, 40018263, 16000, '0000-00-00', 879508, 13, 7, 'New', 'https://i.ibb.co/YQtq2Lb/php-J5-UAe9.jpg', 1000, 0, 0, 'Yes', 'HOUSTON', NULL, NULL, NULL, 'No'),
(69, 'BMW', '5 Series', 'Copart', 'DALLAS - Texas - Copart', '', 'WBA53BH05PWY22584', 2023, 59747704, 19000, '2024-08-22', 0, 7, 7, 'Pending', NULL, 1750, 0, 0, NULL, '', NULL, NULL, NULL, 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance_requests`
--
ALTER TABLE `balance_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dealer_id` (`dealer_id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consignee`
--
ALTER TABLE `consignee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `containers`
--
ALTER TABLE `containers`
  ADD PRIMARY KEY (`container_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_code`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fines`
--
ALTER TABLE `fines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance_requests`
--
ALTER TABLE `balance_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `consignee`
--
ALTER TABLE `consignee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `containers`
--
ALTER TABLE `containers`
  MODIFY `container_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fines`
--
ALTER TABLE `fines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balance_requests`
--
ALTER TABLE `balance_requests`
  ADD CONSTRAINT `balance_requests_ibfk_1` FOREIGN KEY (`dealer_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
