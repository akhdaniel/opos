-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2015 at 01:36 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opos`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `oe_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oe_id` (`oe_id`),
  KEY `oe_id_2` (`oe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=224 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `code`, `name`, `oe_id`) VALUES
(1, '0', 'Your Company', 1),
(2, '1-000000', 'Aktiva ', 765),
(3, '1-100000', 'Aktiva Lancar', 766),
(4, '1-110000', 'Kas Dan Setara Kas', 767),
(5, '1-111000', 'Kas', 768),
(6, '1-111001', 'Kas Kecil', 769),
(7, '1-111002', 'Kas Belum Disetor', 770),
(8, '1-112000', 'Bank', 771),
(9, '1-112001', 'Mandiri Personal', 772),
(10, '1-112002', 'Mandiri Bisnis', 773),
(11, '1-112003', 'Muamalat', 774),
(12, '1-112004', 'BNI', 775),
(13, '1-112005', 'BCA', 776),
(14, '1-112006', 'BNI Giro', 777),
(15, '1-112007', 'Mandiri Giro', 778),
(16, '1-120000', 'Piutang', 779),
(17, '1-121001', 'Piutang Usaha', 780),
(18, '1-121002', 'Piutang Karyawan', 781),
(19, '1-130000', 'Persediaan', 784),
(20, '1-130001', 'Persediaan Daging', 785),
(21, '1-130002', 'Persediaan Ikan', 786),
(22, '1-130003', 'Persediaan Sayuran', 787),
(23, '1-130004', 'Persediaan Keringan', 788),
(24, '1-130005', 'Persediaan Buah', 789),
(25, '1-130006', 'Persediaan Fresh Drink', 790),
(26, '1-130007', 'Persediaan Rokok', 791),
(27, '1-130008', 'Persediaan Makanan', 792),
(28, '1-130009', 'Persediaan Minuman', 793),
(29, '1-130010', 'Persediaan Makanan Olahan', 794),
(30, '1-130011', 'Persediaan Toiletries', 795),
(31, '1-130012', 'Persediaan Buku, ATK ,Asesoris', 796),
(32, '1-130013', 'Persediaan Fashion & Textil', 797),
(33, '1-130014', 'Persediaan Perlengkapan Kebersihan', 798),
(34, '1-130015', 'Persediaan Perlengkapan Rumah Tangga', 799),
(35, '1-130016', 'Persediaan Elektronik', 800),
(36, '1-130017', 'Persediaan Mainan', 801),
(37, '1-130018', 'Persediaan Lainnya', 802),
(38, '1-140000', 'Biaya Dibayar Dimuka', 803),
(39, '1-141001', 'Sewa Bangunan', 804),
(40, '1-141002', 'Asuransi Dibayar Dimuka', 805),
(41, '1-141003', 'Beban Iklan Dibayar Dimuka', 806),
(42, '1-150000', 'Pajak Dibayar Dimuka', 808),
(43, '1-151001', 'Pajak Dibayar Dimuka PPH 22', 809),
(44, '1-151002', 'Pajak Dibayar Dimuka PPH 23', 810),
(45, '1-151003', 'Pajak Dibayar Dimuka PPH 25', 811),
(46, '1-180000', 'Uang Muka Pembelian', 807),
(47, '1-200000', 'Aktiva Tidak Lancar', 812),
(48, '1-211003', 'Piutang Owner', 782),
(49, '1-211004', 'Piutang lainnya', 783),
(50, '1-220000', 'Aktiva Tetap', 813),
(51, '1-221001', 'Tanah ', 814),
(52, '1-221002', 'Bangunan Kantor', 815),
(53, '1-221003', 'Kendaraan', 816),
(54, '1-221004', 'Perlatan Kantor', 817),
(55, '1-221005', 'Software', 818),
(56, '1-221006', 'Furnitur Kantor', 819),
(57, '1-228000', 'Akumulasi Penyusutan Aktiva Tetap', 820),
(58, '1-228101', 'Akum Peny Bangunan Kantor', 821),
(59, '1-228102', 'Akum Peny Kendaraan Kendaraan', 822),
(60, '1-228103', 'Akum Peny Peralatan Kantor', 823),
(61, '1-228104', 'Akum Peny Software', 824),
(62, '1-228105', 'Akum Peny Furnitur Kantor', 825),
(63, '2-000000', 'Hutang', 826),
(64, '2-100000', 'Hutang Jangka Pendek', 827),
(65, '2-110001', 'Hutang Usaha', 828),
(66, '2-110002', 'Hutang Pemegang Saham', 829),
(67, '2-110003', 'Hutang Pihak Ketiga', 830),
(68, '2-110004', 'Hutang Gaji', 831),
(69, '2-120000', 'Hutang Pajak', 832),
(70, '2-121001', 'Hutang Pajak PPh 21', 833),
(71, '2-121002', 'Hutang Pajak PPh 23', 834),
(72, '2-121003', 'Hutang Pajak PPh 25', 835),
(73, '2-121004', 'Hutang Pajak Pasal 4 (2)', 836),
(74, '2-121005', 'Hutang Pajak PPh 29', 837),
(75, '2-122000', 'Hutang PPN', 838),
(76, '2-122101', 'PPN Keluaran', 839),
(77, '2-122102', 'PPN Masukan', 840),
(78, '2-200000', 'Hutang Jangka Panjang', 841),
(79, '2-211001', 'Hutang Bank', 842),
(80, '2-211002', 'Hutang Leasing', 843),
(81, '2-500000', 'Biaya Yang Masih Harus Dibayar', 844),
(82, '2-511001', 'BYMHD Listrik ', 845),
(83, '2-511002', 'BYMHD Jamsostek ', 846),
(84, '2-511003', 'BYMHD Air', 847),
(85, '2-511004', 'BYMHD Telepon ', 848),
(86, '2-511005', 'BYMHD Jasa Pengelola Keamanan', 849),
(87, '2-511006', 'BYMHD Bank', 850),
(88, '2-511007', 'BYMHD PBB', 851),
(89, '2-511008', 'BYMHD Izin Usaha', 852),
(90, '2-511009', 'BYMHD Asuransi', 853),
(91, '2-511010', 'BYMHD Pendidikan dan Latihan', 854),
(92, '2-511011', 'BYMHD Jaminan Kesehatan/BPJS', 855),
(93, '2-800000', 'Uang Muka, Deposit, Poin Bonus', 856),
(94, '2-811001', 'Uang Muka Penjualan', 857),
(95, '2-811002', 'Deposit Customer', 858),
(96, '2-811003', 'Poin Bonus', 859),
(97, '2-900000', 'Stock Interim', 860),
(98, '3-000000', 'EKUITAS', 861),
(99, '3-110001', 'Modal Dasar', 862),
(100, '3-110002', 'Modal Yang Disetor', 863),
(101, '3-110003', 'Modal Yang Belum Disetor', 864),
(102, '3-110004', 'Prive (Pengambilan Pribadi)', 865),
(103, '3-120000', 'Cadangan Modal', 866),
(104, '3-121001', 'Cadangan Modal', 867),
(105, '3-150000', 'Laba Rugi', 868),
(106, '3-151001', 'Laba Rugi Tahun Lalu', 869),
(107, '3-151002', 'Laba Rugi Tahun Berjalan', 870),
(108, '3-900000', 'Historical Balance', 871),
(109, '4-000000', 'Penjualan', 872),
(110, '4-100001', 'Penjualan Daging', 873),
(111, '4-100002', 'Penjualan Ikan', 874),
(112, '4-100003', 'Penjualan Sayuran', 875),
(113, '4-100004', 'Penjualan Keringan', 876),
(114, '4-100005', 'Penjualan Buah', 877),
(115, '4-100006', 'Penjualan Fresh Drink', 878),
(116, '4-100007', 'Penjualan Rokok', 879),
(117, '4-100008', 'Penjualan Makanan', 880),
(118, '4-100009', 'Penjualan Minuman', 881),
(119, '4-100010', 'Penjualan Makanan Olahan', 882),
(120, '4-100011', 'Penjualan Toiletries', 883),
(121, '4-100012', 'Penjualan Buku, ATK ,Asesoris', 884),
(122, '4-100013', 'Penjualan Fashion & Textil', 885),
(123, '4-100014', 'Penjualan Perlengkapan Kebersihan', 886),
(124, '4-100015', 'Penjualan Perlengkapan Rumah Tangga', 887),
(125, '4-100016', 'Penjualan Elektronik', 888),
(126, '4-100017', 'Penjualan Mainan', 889),
(127, '4-100018', 'Penjualan Lainnya', 890),
(128, '4-20005', 'Pendapatan Biaya Kirim', 891),
(129, '4-20006', 'Retur Penjualan', 892),
(130, '4-20007', 'Discount Penjualan', 893),
(131, '5-000000', 'Harga Pokok Penjualan (HPP)', 894),
(132, '5-100001', 'HPP Daging', 895),
(133, '5-100002', 'HPP Ikan', 896),
(134, '5-100003', 'HPP Sayuran', 897),
(135, '5-100004', 'HPP Keringan', 898),
(136, '5-100005', 'HPP Buah', 899),
(137, '5-100006', 'HPP Fresh Drink', 900),
(138, '5-100007', 'HPP Rokok', 901),
(139, '5-100008', 'HPP Makanan', 902),
(140, '5-100009', 'HPP Minuman', 903),
(141, '5-100010', 'HPP Makanan Olahan', 904),
(142, '5-100011', 'HPP Toiletries', 905),
(143, '5-100012', 'HPP Buku, ATK ,Asesoris', 906),
(144, '5-100013', 'HPP Fashion & Textil', 907),
(145, '5-100014', 'HPP Perlengkapan Kebersihan', 908),
(146, '5-100015', 'HPP Perlengkapan Rumah Tangga', 909),
(147, '5-100016', 'HPP Elektronik', 910),
(148, '5-100017', 'HPP Mainan', 911),
(149, '5-100018', 'HPP Lainnya', 912),
(150, '6-000000', 'Beban Administrasi dan Umum', 913),
(151, '6-100000', 'Beban Gaji & Upah', 914),
(152, '6-110001', 'Gaji Karyawan', 915),
(153, '6-110002', 'Tunjangan/ Bonus Karyawan', 916),
(154, '6-110003', 'Tunjangan Kesehatan Karyawan', 917),
(155, '6-110004', 'Pangan karyawan (catering)', 918),
(156, '6-110005', 'Lembur Karyawan ', 919),
(157, '6-110006', 'Fee Jasa Keamanan', 920),
(158, '6-110007', 'Pakaian Kerja', 921),
(159, '6-110008', 'Tunjangan Ulang Tahun Karyawan', 922),
(160, '6-110009', 'Tunjangan Melahirkan Karyawan', 923),
(161, '6-110010', 'Tunjangan PPH Pasal 21', 924),
(162, '6-200000', 'Beban Marketing dan Penjualan', 925),
(163, '6-211001', 'Free Gift', 926),
(164, '6-211002', 'Event ', 927),
(165, '6-211003', 'Advertising', 928),
(166, '6-211004', 'Pengiriman Barang Dagang', 929),
(167, '6-300000', 'Keperluan Kantor', 930),
(168, '6-311001', 'Air Minum', 931),
(169, '6-311002', 'Keperluan Olahraga', 932),
(170, '6-311003', 'Iuran Bulanan', 933),
(171, '6-311004', 'Sumbangan', 934),
(172, '6-311005', 'Internet', 935),
(173, '6-311006', 'Telepon', 936),
(174, '6-311007', 'Pulsa ', 937),
(175, '6-311008', 'Listrik', 938),
(176, '6-311009', 'PDAM', 939),
(177, '6-311010', 'Research & Development', 940),
(178, '6-311011', 'Keperluan Dapur', 941),
(179, '6-311012', 'Perlengkapan Kantor', 942),
(180, '6-311013', 'P3K', 943),
(181, '6-311014', 'Keperluan Lain-lain', 944),
(182, '6-311015', 'K3 (Pemadam Kebakaran)', 945),
(183, '6-311016', 'Perlengkapan Kebersihan', 946),
(184, '6-311018', 'Keperluan Owner', 947),
(185, '6-400000', 'Biaya Kantor', 948),
(186, '6-411001', 'Alat Tulis Kantor', 949),
(187, '6-411002', 'Keperluan Pos', 950),
(188, '6-411003', 'Jilid & Photocopy', 951),
(189, '6-411004', 'Iklan Lowongan Kerja', 952),
(190, '6-411005', 'Materai', 953),
(191, '6-500000', 'Biaya Kantor Lainnya', 954),
(192, '6-511001', 'Biaya Perizinan', 955),
(193, '6-511002', 'Biaya Administrasi Bank', 956),
(194, '6-511003', 'Biaya Konsultan', 957),
(195, '6-511004', 'Biaya Sewa', 958),
(196, '6-511006', 'Biaya Pemeliharaan & Perawatan Gedung', 959),
(197, '6-511007', 'Biaya Perawatan Instalasi Listrik, telepon, internet', 960),
(198, '6-511008', 'Pajak', 961),
(199, '6-511009', 'Akomodasi Tamu', 962),
(200, '6-511010', 'Biaya Pemeliharaan & Perawatan Aset', 963),
(201, '6-511011', 'Biaya Pengiriman Dokumen/Barang', 964),
(202, '6-600000', 'Biaya Kendaraan', 965),
(203, '6-611001', 'BBM kendaraan', 966),
(204, '6-611002', 'Service kendaraan', 967),
(205, '6-611003', 'Parkir & tol kendaraan', 968),
(206, '6-611004', 'Pajak Kendaraan', 969),
(207, '6-611005', 'Asuransi Kendaraan', 970),
(208, '6-700000', 'Beban Penyusutan', 971),
(209, '6-710001', 'Tanah ', 972),
(210, '6-710002', 'Bangunan Kantor', 973),
(211, '6-710003', 'Kendaraan', 974),
(212, '6-710004', 'Perlatan Kantor', 975),
(213, '6-710005', 'Software', 976),
(214, '6-710006', 'Furnitur Kantor', 977),
(215, '6-900000', 'Biaya Lain-lain', 978),
(216, '8-000000', 'Pendapatan Lain - lain', 979),
(217, '8-110001', 'Pendapatan Bunga', 980),
(218, '8-110002', 'Pendapatan Deposit', 981),
(219, '8-110009', 'Keuntungan Atas Penjualan Aktiva Tetap', 982),
(220, '9-000000', 'Beban Lain - lain', 983),
(221, '9-110001', 'Beban Bunga', 984),
(222, '9-110002', 'Beban Administrasi Bank', 985),
(223, '9-110009', 'Kerugian Atas Penjualan Aktiva Tetap', 986);

-- --------------------------------------------------------

--
-- Table structure for table `app_setting`
--

CREATE TABLE IF NOT EXISTS `app_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `val` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `app_setting`
--

INSERT INTO `app_setting` (`id`, `code`, `val`) VALUES
(1, 'product_last_sync', '2015-04-23 06:55:18'),
(2, 'payment_type_last_sync', '2015-04-21 04:29:55'),
(3, 'ar_account_id', '780'),
(4, 'openerp_server', 'http://mlm.vitraining.com:8069/xmlrpc/'),
(5, 'openerp_database', 'retail'),
(6, 'pos_config_id', '2'),
(7, 'create_order_online', '0'),
(8, 'tmp_dir', '/tmp/'),
(9, 'print_cmd', 'cp'),
(10, 'printer_port', '/dev/null'),
(11, 'admin_pwd', '81dc9bdb52d04dc20036dbd8313ed055'),
(12, 'shop_name', 'Valkenet Cafe'),
(13, 'company_name', 'VITRAINING'),
(14, 'openerp_admin_user', 'admin'),
(15, 'openerp_admin_pwd', '1'),
(16, 'oe_summary_mode', '1'),
(17, 'sales_account_id', '872'),
(18, 'hpp_account_id', '894'),
(19, 'account_last_sync', '2015-04-21 03:53:51'),
(20, 'other_income_coa_id', '890'),
(21, 'autopost_interval', '5'),
(22, 'pos_journal_id', '10'),
(23, 'source_location_id', '31'),
(24, 'dest_location_id', '9'),
(25, 'discount_account_id', '893'),
(26, 'user_last_sync', '2015-04-21 07:05:39'),
(27, 'auth_oe', '0'),
(28, 'printer_name', 'KASIR'),
(29, 'shop_id', '31'),
(30, 'major_version', '1'),
(31, 'minor_version', '36'),
(32, 'ppn_account_id', '839'),
(33, 'kitchen_printer_name', 'KASIR'),
(34, 'show_discount_waiter', '0'),
(35, 'show_amount_waiter', '0'),
(36, 'show_sub_total', '0'),
(37, 'product_view_type', 'list'),
(38, 'pos_mode', 'resto'),
(39, 'special_discount', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cashbox_line`
--

CREATE TABLE IF NOT EXISTS `cashbox_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_payment_id` int(11) NOT NULL,
  `number_opening` int(11) NOT NULL,
  `number_closing` int(11) NOT NULL,
  `pieces` int(11) NOT NULL,
  `oe_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `session_payment_id` (`session_payment_id`),
  KEY `oe_id` (`oe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `cashbox_line`
--

INSERT INTO `cashbox_line` (`id`, `session_payment_id`, `number_opening`, `number_closing`, `pieces`, `oe_id`) VALUES
(56, 11, 2, 3, 100000, 0),
(57, 11, 0, 0, 50000, 0),
(58, 11, 0, 0, 20000, 0),
(59, 11, 0, 0, 10000, 0),
(60, 11, 0, 0, 5000, 0),
(61, 11, 0, 0, 2000, 0),
(62, 11, 0, 0, 1000, 0),
(63, 11, 0, 0, 500, 0),
(64, 11, 0, 0, 200, 0),
(65, 11, 0, 0, 100, 0),
(66, 11, 0, 0, 50, 0),
(67, 13, 0, 0, 100000, 0),
(68, 13, 0, 0, 50000, 0),
(69, 13, 0, 0, 20000, 0),
(70, 13, 0, 0, 10000, 0),
(71, 13, 0, 0, 5000, 0),
(72, 13, 0, 0, 2000, 0),
(73, 13, 0, 0, 1000, 0),
(74, 13, 0, 0, 500, 0),
(75, 13, 0, 0, 200, 0),
(76, 13, 0, 0, 100, 0),
(77, 13, 0, 0, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE IF NOT EXISTS `customer_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `field` varchar(50) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer_type`
--

INSERT INTO `customer_type` (`id`, `name`, `field`, `discount`) VALUES
(1, 'reguler', 'list_price', 0),
(2, 'owner', 'cost_price', 0),
(3, 'owner friend', 'list_price', 20),
(4, 'pejabat', 'list_price', 30),
(5, 'lain-lain', 'list_price', 10);

-- --------------------------------------------------------

--
-- Table structure for table `join_payment`
--

CREATE TABLE IF NOT EXISTS `join_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `join_number` varchar(100) NOT NULL,
  `join_date` datetime NOT NULL,
  `total_paid` decimal(20,2) NOT NULL,
  `total_change` decimal(20,2) NOT NULL,
  `state` enum('UNPAID','PAID') NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `join_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `join_payment_detail`
--

CREATE TABLE IF NOT EXISTS `join_payment_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `join_payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `join_payment_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `join_payment_payment`
--

CREATE TABLE IF NOT EXISTS `join_payment_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `join_payment_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `card_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `join_payment_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE IF NOT EXISTS `journal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL,
  `account_id` int(11) NOT NULL,
  `debit` decimal(20,2) NOT NULL,
  `credit` decimal(20,2) NOT NULL,
  `reference` varchar(200) DEFAULT NULL,
  `state` enum('UNPOSTED','POSTED') NOT NULL DEFAULT 'UNPOSTED',
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  KEY `session_id` (`session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`id`, `session_id`, `name`, `datetime`, `account_id`, `debit`, `credit`, `reference`, `state`) VALUES
(1, 1, 'S/0004/00001', '2015-07-04 16:39:34', 770, '1061000.00', '0.00', 'Cash', 'UNPOSTED'),
(2, 1, 'S/0004/00001', '2015-07-04 16:39:34', 872, '0.00', '1061000.00', 'Sales Non PPN', 'UNPOSTED'),
(3, 1, 'S/0004/00001', '2015-07-08 11:42:45', 902, '758000.00', '0.00', 'HPP Persediaan Makanan', 'UNPOSTED'),
(4, 1, 'S/0004/00001', '2015-07-04 16:39:34', 792, '0.00', '758000.00', 'Persediaan Makanan', 'UNPOSTED'),
(5, 1, 'S/0004/00001', '2015-07-08 11:42:45', 903, '303000.00', '0.00', 'HPP Persediaan Minuman', 'UNPOSTED'),
(6, 1, 'S/0004/00001', '2015-07-04 16:39:34', 793, '0.00', '303000.00', 'Persediaan Minuman', 'UNPOSTED'),
(7, 1, 'S/0004/00001', '2015-07-04 16:39:34', 890, '961000.00', '0.00', 'Difference Minus', 'UNPOSTED'),
(8, 1, 'S/0004/00001', '2015-07-04 16:39:34', 770, '0.00', '961000.00', 'Difference Minus', 'UNPOSTED');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_detail_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` decimal(20,3) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `notification`
--


-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL,
  `customer_type` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `total_paid` decimal(20,2) NOT NULL,
  `total_change` decimal(20,2) NOT NULL,
  `discount_special` decimal(20,2) DEFAULT NULL,
  `state` enum('NEW','CONFIRM','PAID','POSTED','CANCEL') NOT NULL DEFAULT 'NEW',
  `session_id` int(11) NOT NULL,
  `oe_id` int(11) NOT NULL,
  `notes` varchar(200) NOT NULL,
  `order_notes` text,
  PRIMARY KEY (`id`),
  KEY `state` (`state`),
  KEY `session_id` (`session_id`),
  KEY `oe_id` (`oe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `number`, `order_date`, `customer_type`, `table_id`, `salesman_id`, `total_paid`, `total_change`, `discount_special`, `state`, `session_id`, `oe_id`, `notes`, `order_notes`) VALUES
(3, 'Order/20150703174200', '2015-07-03 17:42:00', 1, 1, 2, '0.00', '0.00', NULL, 'CANCEL', 1, 0, 'POS/0002/00001', NULL),
(4, 'Order/20150703182349', '2015-07-03 18:23:49', 1, 9, 2, '729000.00', '0.00', '0.00', 'PAID', 1, 0, 'POS/0002/00002', NULL),
(5, 'Order/20150703191008', '2015-07-03 19:10:08', 1, 7, 2, '332000.00', '0.00', '0.00', 'PAID', 1, 0, 'POS/0002/00003', NULL),
(6, 'Order/20150703230858', '2015-07-03 23:08:58', 1, 0, 4, '0.00', '0.00', NULL, 'CANCEL', 1, 0, 'POS/0004/00001', NULL),
(7, 'Order/20150703234508', '2015-07-03 23:45:09', 1, 0, 2, '0.00', '0.00', NULL, 'CANCEL', 1, 0, 'POS/0002/00004', NULL),
(8, 'Order/20150705181118', '2015-07-05 18:11:18', 1, 0, 2, '0.00', '0.00', NULL, 'CANCEL', 2, 0, 'POS/0002/00005', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` decimal(20,3) NOT NULL,
  `unit_price` decimal(20,2) NOT NULL,
  `list_price` decimal(20,2) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `tax` int(11) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `paid_status` enum('UNPAID','PAID') DEFAULT 'UNPAID',
  `is_print` int(11) DEFAULT '0',
  `insert_date` datetime DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `qty`, `unit_price`, `list_price`, `amount`, `tax`, `status`, `paid_status`, `is_print`, `insert_date`, `note`) VALUES
(16, 3, 4, '2.000', '29000.00', '29000.00', '58000.00', 0, 1, 'UNPAID', 1, '2015-07-03 17:42:09', NULL),
(17, 3, 5, '1.000', '20000.00', '20000.00', '20000.00', 0, 1, 'UNPAID', 1, '2015-07-03 17:42:10', NULL),
(18, 3, 1, '1.000', '29000.00', '29000.00', '29000.00', 0, 1, 'UNPAID', 1, '2015-07-03 17:42:11', NULL),
(19, 3, 7, '1.000', '29000.00', '29000.00', '29000.00', 0, 1, 'UNPAID', 1, '2015-07-03 17:45:21', NULL),
(20, 3, 25, '1.000', '10000.00', '10000.00', '10000.00', 0, 1, 'UNPAID', 1, '2015-07-03 17:47:15', NULL),
(21, 3, 10, '1.000', '21000.00', '21000.00', '21000.00', 0, 1, 'UNPAID', 1, '2015-07-03 17:47:57', NULL),
(22, 3, 11, '1.000', '115000.00', '115000.00', '115000.00', 0, 1, 'UNPAID', 1, '2015-07-03 17:48:40', NULL),
(23, 3, 34, '1.000', '22000.00', '22000.00', '22000.00', 0, 1, 'UNPAID', 1, '2015-07-03 18:09:43', NULL),
(24, 4, 19, '3.000', '45000.00', '45000.00', '135000.00', 0, 1, 'PAID', 1, '2015-07-03 18:24:18', NULL),
(25, 4, 16, '1.000', '24000.00', '24000.00', '24000.00', 0, 1, 'PAID', 1, '2015-07-03 18:24:37', NULL),
(26, 4, 14, '3.000', '41000.00', '41000.00', '123000.00', 0, 1, 'PAID', 1, '2015-07-03 18:24:47', NULL),
(27, 4, 15, '1.000', '42000.00', '42000.00', '42000.00', 0, 1, 'PAID', 1, '2015-07-03 18:24:58', NULL),
(28, 4, 7, '2.000', '29000.00', '29000.00', '58000.00', 0, 1, 'PAID', 1, '2015-07-03 18:25:08', NULL),
(29, 4, 8, '3.000', '19000.00', '19000.00', '57000.00', 0, 1, 'PAID', 1, '2015-07-03 18:25:22', NULL),
(30, 4, 25, '1.000', '10000.00', '10000.00', '10000.00', 0, 1, 'PAID', 1, '2015-07-03 18:25:44', NULL),
(31, 4, 29, '2.000', '19000.00', '19000.00', '38000.00', 0, 1, 'PAID', 1, '2015-07-03 18:26:02', NULL),
(32, 4, 49, '8.000', '8000.00', '8000.00', '64000.00', 0, 1, 'PAID', 1, '2015-07-03 18:26:16', NULL),
(33, 4, 27, '4.000', '17000.00', '17000.00', '68000.00', 0, 1, 'PAID', 1, '2015-07-03 18:28:23', NULL),
(35, 4, 44, '3.000', '23000.00', '23000.00', '69000.00', 0, 1, 'PAID', 1, '2015-07-03 18:47:48', NULL),
(36, 5, 10, '1.000', '21000.00', '21000.00', '21000.00', 0, 1, 'PAID', 1, '2015-07-03 19:10:42', NULL),
(37, 5, 14, '1.000', '41000.00', '41000.00', '41000.00', 0, 1, 'PAID', 1, '2015-07-03 19:10:53', NULL),
(38, 5, 16, '1.000', '24000.00', '24000.00', '24000.00', 0, 1, 'PAID', 1, '2015-07-03 19:10:55', NULL),
(39, 5, 21, '1.000', '139000.00', '139000.00', '139000.00', 0, 1, 'PAID', 1, '2015-07-03 19:11:03', NULL),
(40, 5, 27, '1.000', '17000.00', '17000.00', '17000.00', 0, 1, 'PAID', 1, '2015-07-03 19:11:14', NULL),
(41, 5, 30, '1.000', '19000.00', '19000.00', '19000.00', 0, 1, 'PAID', 1, '2015-07-03 19:11:22', NULL),
(42, 5, 32, '1.000', '22000.00', '22000.00', '22000.00', 0, 1, 'PAID', 1, '2015-07-03 19:11:25', NULL),
(43, 5, 29, '1.000', '19000.00', '19000.00', '19000.00', 0, 1, 'PAID', 0, '2015-07-03 20:38:47', NULL),
(44, 5, 22, '1.000', '30000.00', '30000.00', '30000.00', 0, 1, 'PAID', 0, '2015-07-03 20:39:21', NULL),
(45, 4, 32, '1.000', '22000.00', '22000.00', '22000.00', 0, 1, 'PAID', 0, '2015-07-03 20:40:35', NULL),
(46, 4, 39, '1.000', '19000.00', '19000.00', '19000.00', 0, 1, 'PAID', 0, '2015-07-03 20:40:47', NULL),
(47, 8, 15, '1.000', '42000.00', '42000.00', '42000.00', 0, 1, 'UNPAID', 0, '2015-07-05 18:11:39', NULL),
(48, 8, 11, '2.000', '115000.00', '115000.00', '230000.00', 0, 1, 'UNPAID', 0, '2015-07-05 18:12:19', NULL),
(49, 8, 8, '3.000', '19000.00', '19000.00', '57000.00', 0, 1, 'UNPAID', 0, '2015-07-05 18:12:40', NULL),
(50, 8, 13, '3.000', '59000.00', '59000.00', '177000.00', 0, 1, 'UNPAID', 0, '2015-07-05 18:12:48', NULL),
(51, 8, 35, '1.000', '25000.00', '25000.00', '25000.00', 0, 1, 'UNPAID', 0, '2015-07-05 18:15:24', NULL),
(52, 8, 29, '1.000', '19000.00', '19000.00', '19000.00', 0, 1, 'UNPAID', 0, '2015-07-05 18:15:54', NULL),
(54, 8, 4, '1.000', '29000.00', '29000.00', '29000.00', 0, 1, 'UNPAID', 0, '2015-07-05 18:19:52', NULL),
(55, 8, 16, '1.000', '24000.00', '24000.00', '24000.00', 0, 1, 'UNPAID', 0, '2015-07-05 18:20:05', NULL),
(56, 8, 10, '1.000', '21000.00', '21000.00', '21000.00', 0, 1, 'UNPAID', 0, '2015-07-05 18:21:05', NULL),
(57, 8, 45, '1.000', '23000.00', '23000.00', '23000.00', 0, 1, 'UNPAID', 0, '2015-07-05 18:21:17', NULL),
(58, 8, 49, '8.000', '8000.00', '8000.00', '64000.00', 0, 1, 'UNPAID', 0, '2015-07-05 18:23:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_payment`
--

CREATE TABLE IF NOT EXISTS `order_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `card_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`payment_type_id`),
  KEY `payment_id` (`payment_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_payment`
--

INSERT INTO `order_payment` (`id`, `order_id`, `payment_type_id`, `amount`, `card_no`) VALUES
(1, 5, 1, '332000.00', ''),
(2, 4, 1, '729000.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE IF NOT EXISTS `payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `oe_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `oe_debit_account_id` int(11) NOT NULL,
  `oe_credit_account_id` int(11) NOT NULL,
  `sorting` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `oe_id` (`oe_id`),
  KEY `code` (`code`),
  KEY `oe_debit_account_id` (`oe_debit_account_id`),
  KEY `oe_credit_account_id` (`oe_credit_account_id`),
  KEY `sorting` (`sorting`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`id`, `name`, `type`, `oe_id`, `code`, `oe_debit_account_id`, `oe_credit_account_id`, `sorting`) VALUES
(1, 'Cash', 'cash', 7, 'cash', 770, 770, 0),
(2, 'Bank', 'bank', 8, 'BNK2', 775, 775, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prepare_barcode`
--

CREATE TABLE IF NOT EXISTS `prepare_barcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `prepare_barcode`
--


-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `cost_price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `list_price` decimal(20,2) NOT NULL,
  `discount_price` decimal(20,2) NOT NULL,
  `default_code` varchar(50) DEFAULT NULL,
  `ean13` varchar(50) DEFAULT NULL,
  `oe_id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL,
  `oe_stock_account_id` int(11) NOT NULL,
  `oe_income_account_id` int(11) NOT NULL,
  `oe_expense_account_id` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `uom` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `tax` int(11) NOT NULL DEFAULT '0',
  `image_url` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `default_code` (`default_code`,`ean13`),
  KEY `oe_id` (`oe_id`),
  KEY `ccategory` (`category`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `cost_price`, `list_price`, `discount_price`, `default_code`, `ean13`, `oe_id`, `category`, `oe_stock_account_id`, `oe_income_account_id`, `oe_expense_account_id`, `active`, `uom`, `is_active`, `tax`, `image_url`, `status`) VALUES
(1, 'OKONOMIYAKI', '29000.00', '29000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(4, 'SINGKONG KEJU', '29000.00', '29000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(5, 'KUE CUBIT GREEN TEA', '20000.00', '20000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(6, 'KUE CUBIT RED VELVET', '20000.00', '20000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(7, 'KANI SALAD', '29000.00', '29000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(8, 'YUFETO SALAD', '19000.00', '19000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(9, 'CREAM CHICKEN SOUP', '21000.00', '21000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(10, 'CREAM MUSHROOM SOUP', '21000.00', '21000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(11, 'AUSTRALIAN TENDERLOIN STEAK', '115000.00', '115000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(12, 'BLINDE VINKEN', '54000.00', '54000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(13, 'GINDARA BATAYAKI', '59000.00', '59000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(14, 'GYUDON', '41000.00', '41000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(15, 'KAMBING GULING', '42000.00', '42000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(16, 'NASI GORENG VALKENET', '24000.00', '24000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(17, 'SATE AYAM', '31000.00', '31000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(18, 'SPAGHETI BOLOGNAISE', '24000.00', '24000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(19, 'SUKIYAKI', '45000.00', '45000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(20, 'WAGYU MELIQUE STEAK 160', '125000.00', '125000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(21, 'WAGYU MELIQUE STEAK 200', '139000.00', '139000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(22, 'CHOCO LAVA', '30000.00', '30000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(23, 'SUMMER BREEZE', '20000.00', '20000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(24, 'POTTIE', '35000.00', '35000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1),
(25, 'HOT/COLD REGULAR TEA', '10000.00', '10000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(26, 'HOT SPECIAL HOLLAND TEA', '20000.00', '20000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(27, 'LYCHEE ICE TEA', '17000.00', '17000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(28, 'STRAWBERRY ICED TEA', '17000.00', '17000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(29, 'THAI ICE TEA', '19000.00', '19000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(30, 'ICE GREEN TEA', '19000.00', '19000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(31, 'AFFOGATE', '19000.00', '19000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(32, 'CAPPUCINNO', '22000.00', '22000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(33, 'ESPRESSO', '15000.00', '15000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(34, 'FLAT WHITE', '22000.00', '22000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(35, 'GREEN TEA LATTE', '25000.00', '25000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(36, 'ICED CAPPUCINNO', '22000.00', '22000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(37, 'ICED TEA', '22000.00', '22000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(38, 'HOT COFFEE LATTE', '22000.00', '22000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(39, 'LONG BLACK', '19000.00', '19000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(40, 'MACHIATO', '22000.00', '22000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(41, 'RED VELVET LATTE', '25000.00', '25000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(42, 'STRAWBERRY SMOOTHIES', '23000.00', '23000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(43, 'MANGO SMOOTHIES', '23000.00', '23000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(44, 'PEACH SMOOTHIES', '23000.00', '23000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(45, 'KIWI SMOOTHIES', '23000.00', '23000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(46, 'CHOCHOLATE MILKSHAKE', '25000.00', '25000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(47, 'STRAWBERRY MILKSHAKE', '25000.00', '25000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(48, 'VANILLA MILKSHAKE', '25000.00', '25000.00', '0.00', NULL, NULL, 0, 'Persediaan Minuman', 793, 881, 903, 1, 1, 1, 0, NULL, 1),
(49, 'MINERAL WATER', '8000.00', '8000.00', '0.00', NULL, NULL, 0, 'Persediaan Makanan', 792, 880, 902, 1, 1, 1, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_discount`
--

CREATE TABLE IF NOT EXISTS `product_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `nominal` decimal(20,2) NOT NULL DEFAULT '0.00',
  `percent` decimal(20,2) NOT NULL DEFAULT '0.00',
  `enable` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product_discount`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_gift`
--

CREATE TABLE IF NOT EXISTS `product_gift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `buy_qty` int(11) NOT NULL,
  `gift_product_id` int(11) NOT NULL,
  `get_qty` int(11) NOT NULL,
  `enable` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`,`gift_product_id`),
  KEY `gift_product_id` (`gift_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product_gift`
--


-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `open_date` datetime NOT NULL,
  `close_date` datetime DEFAULT NULL,
  `total_sales` decimal(20,2) NOT NULL DEFAULT '0.00',
  `total_drawer` decimal(20,2) NOT NULL DEFAULT '0.00',
  `difference` decimal(20,2) NOT NULL DEFAULT '0.00',
  `user_id` int(11) NOT NULL,
  `oe_id` int(11) DEFAULT NULL,
  `state` enum('OPENING_CONTROL','OPEN','CLOSING_CONTROL','CLOSED','POSTED') NOT NULL DEFAULT 'OPEN',
  PRIMARY KEY (`id`),
  UNIQUE KEY `oe_id` (`oe_id`),
  KEY `open_date` (`open_date`),
  KEY `close_date` (`close_date`),
  KEY `user_id` (`user_id`),
  KEY `state_id` (`state`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `name`, `open_date`, `close_date`, `total_sales`, `total_drawer`, `difference`, `user_id`, `oe_id`, `state`) VALUES
(1, 'S/0004/00001', '2015-07-03 17:41:35', '2015-07-04 16:39:34', '1061000.00', '300000.00', '-961000.00', 4, NULL, 'CLOSED'),
(2, 'S/0004/00002', '2015-07-04 16:39:50', NULL, '0.00', '0.00', '0.00', 4, NULL, 'OPEN');

-- --------------------------------------------------------

--
-- Table structure for table `session_payment`
--

CREATE TABLE IF NOT EXISTS `session_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `oe_statement_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`,`payment_type_id`,`oe_statement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `session_payment`
--

INSERT INTO `session_payment` (`id`, `session_id`, `payment_type_id`, `oe_statement_id`) VALUES
(11, 1, 1, 0),
(12, 1, 2, 0),
(13, 2, 1, 0),
(14, 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_move`
--

CREATE TABLE IF NOT EXISTS `stock_move` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` decimal(20,2) NOT NULL,
  `name` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL,
  `source_location_id` int(11) NOT NULL,
  `dest_location_id` int(11) NOT NULL,
  `state` enum('UNPOSTED','POSTED') NOT NULL DEFAULT 'UNPOSTED',
  `reference` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `product_id` (`product_id`),
  KEY `datetime` (`datetime`),
  KEY `source_location_id` (`source_location_id`),
  KEY `dest_location_id` (`dest_location_id`),
  KEY `state` (`state`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `stock_move`
--

INSERT INTO `stock_move` (`id`, `session_id`, `product_id`, `qty`, `name`, `datetime`, `source_location_id`, `dest_location_id`, `state`, `reference`, `is_active`) VALUES
(1, 1, 0, '3.00', 'S/0004/00001', '2015-07-04 16:39:34', 31, 9, 'UNPOSTED', 'YUFETO SALAD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE IF NOT EXISTS `table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `table`
--

INSERT INTO `table` (`id`, `table_name`, `status`) VALUES
(1, 'Meja 1', 0),
(2, 'Meja 2', 1),
(3, 'Meja 3', 1),
(4, 'Meja 4', 1),
(5, 'Meja 5', 1),
(6, 'Meja 6', 1),
(7, 'Meja 7', 1),
(8, 'Meja 8', 1),
(9, 'Meja 9', 1),
(10, 'Meja 10', 1),
(11, 'Meja 11', 1),
(12, 'Meja 12', 1),
(13, 'Meja 13', 1),
(14, 'Meja 14', 1),
(15, 'Meja 15', 1),
(16, 'Meja 16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `oe_id` int(11) NOT NULL,
  `group_name` enum('ADMIN','KITCHEN','WAITER','CASHIER') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oe_id` (`oe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `login`, `password`, `oe_id`, `group_name`) VALUES
(1, 'Administrator', 'admin', '1', 1, 'ADMIN'),
(2, 'waiter', 'waiter', 'waiter', 2, 'WAITER'),
(3, 'kitchen', 'kitchen', 'kitchen', 3, 'KITCHEN'),
(4, 'cashier', 'cashier', 'cashier', 4, 'CASHIER');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cashbox_line`
--
ALTER TABLE `cashbox_line`
  ADD CONSTRAINT `cashbox_line_ibfk_1` FOREIGN KEY (`session_payment_id`) REFERENCES `session_payment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `journal_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`oe_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_payment`
--
ALTER TABLE `order_payment`
  ADD CONSTRAINT `order_payment_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_payment_ibfk_4` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prepare_barcode`
--
ALTER TABLE `prepare_barcode`
  ADD CONSTRAINT `prepare_barcode_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_discount`
--
ALTER TABLE `product_discount`
  ADD CONSTRAINT `product_discount_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_gift`
--
ALTER TABLE `product_gift`
  ADD CONSTRAINT `product_gift_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_gift_ibfk_2` FOREIGN KEY (`gift_product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `session_payment`
--
ALTER TABLE `session_payment`
  ADD CONSTRAINT `session_payment_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_move`
--
ALTER TABLE `stock_move`
  ADD CONSTRAINT `stock_move_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_move_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`oe_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
