-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 17. Februari 2016 jam 10:35
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opos_taufik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
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
-- Dumping data untuk tabel `account`
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
-- Struktur dari tabel `app_setting`
--

CREATE TABLE IF NOT EXISTS `app_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `val` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data untuk tabel `app_setting`
--

INSERT INTO `app_setting` (`id`, `code`, `val`) VALUES
(1, 'product_last_sync', '2015-07-01 09:04:05'),
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
(12, 'shop_name', 'Kantor Pusat'),
(13, 'company_name', 'VITRAINING'),
(14, 'openerp_admin_user', 'admin'),
(15, 'openerp_admin_pwd', '1'),
(16, 'oe_summary_mode', '1'),
(17, 'sales_account_id', '873'),
(18, 'hpp_account_id', '895'),
(19, 'account_last_sync', '2015-04-21 03:53:51'),
(20, 'other_income_coa_id', '890'),
(21, 'autopost_interval', '5'),
(22, 'pos_journal_id', '10'),
(23, 'source_location_id', '31'),
(24, 'dest_location_id', '9'),
(25, 'discount_account_id', '893'),
(26, 'user_last_sync', '2015-04-21 07:05:39'),
(27, 'auth_oe', '0'),
(28, 'printer_name', 'sijapra'),
(29, 'shop_id', '31'),
(30, 'major_version', '1'),
(31, 'minor_version', '36'),
(32, 'ppn_account_id', '839'),
(33, 'kitchen_printer_name', 'pos'),
(34, 'show_discount_waiter', '0'),
(35, 'show_amount_waiter', '0'),
(36, 'show_sub_total', '0'),
(37, 'product_view_type', 'list'),
(38, 'pos_mode', 'retail'),
(39, 'special_discount', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cashbox_line`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `cashbox_line`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `customer_type`
--

CREATE TABLE IF NOT EXISTS `customer_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `field` varchar(50) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `customer_type`
--

INSERT INTO `customer_type` (`id`, `name`, `field`, `discount`) VALUES
(1, 'reguler', 'list_price', 0),
(2, 'owner', 'cost_price', 0),
(3, 'owner friend', 'list_price', 20),
(4, 'pejabat', 'list_price', 30),
(5, 'lain-lain', 'list_price', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `join_payment`
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
-- Dumping data untuk tabel `join_payment`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `join_payment_detail`
--

CREATE TABLE IF NOT EXISTS `join_payment_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `join_payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `join_payment_detail`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `join_payment_payment`
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
-- Dumping data untuk tabel `join_payment_payment`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `journal`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `journal`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `notification`
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
-- Dumping data untuk tabel `notification`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `order`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `order_detail`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `order_payment`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `order_payment`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_type`
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
-- Dumping data untuk tabel `payment_type`
--

INSERT INTO `payment_type` (`id`, `name`, `type`, `oe_id`, `code`, `oe_debit_account_id`, `oe_credit_account_id`, `sorting`) VALUES
(1, 'Cash', 'cash', 7, 'cash', 770, 770, 0),
(2, 'Bank', 'bank', 8, 'BNK2', 775, 775, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `prepare_barcode`
--

CREATE TABLE IF NOT EXISTS `prepare_barcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `prepare_barcode`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=200 ;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `name`, `cost_price`, `list_price`, `discount_price`, `default_code`, `ean13`, `oe_id`, `category`, `oe_stock_account_id`, `oe_income_account_id`, `oe_expense_account_id`, `active`, `uom`, `is_active`, `tax`, `image_url`, `status`) VALUES
(1, 'Pro Mild', '9000.00', '10000.00', '0.00', '13160-0001', NULL, 573, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, 'http://localhost/vitraining/opos/images/logo.png', 0),
(2, 'Avolution Mrh', '14327.00', '16000.00', '0.00', '13160-0002', NULL, 574, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(3, 'Dji Sam Soe 12', '11753.00', '13000.00', '0.00', '13160-0003', NULL, 575, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(4, 'G Mild', '10313.00', '11000.00', '0.00', '13160-0004', NULL, 576, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(5, 'Gudang Garam Filter 12', '10695.00', '12000.00', '0.00', '13160-0005', NULL, 577, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(6, 'Marlboro Ice Blex', '15100.00', '17000.00', '0.00', '13160-0006', NULL, 578, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(7, 'Marlboro Menthol Like', '13750.00', '15000.00', '0.00', '13160-0007', NULL, 579, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(8, 'Marlboro Mrh 500', '14129.00', '16500.00', '0.00', '13160-0008', NULL, 580, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(9, 'Marlboro Putih 500', '13980.00', '16000.00', '0.00', '13160-0009', NULL, 581, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(10, 'Promild 16 Kretek', '12396.00', '10000.00', '0.00', '13160-0010', NULL, 582, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(11, 'Sampoerna Mild', '13451.00', '15500.00', '0.00', '13160-0011', NULL, 583, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(12, 'Surya 12', '10590.00', '12500.00', '0.00', '13160-0012', NULL, 584, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(13, 'Surya 16', '14109.00', '15500.00', '0.00', '13160-0013', NULL, 585, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(14, 'U-Mild', '9016.00', '10000.00', '0.00', '13160-0014', NULL, 586, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(15, 'Wafer Tango Pandan 171 Gr', '7168.00', '12916.00', '0.00', '13170-0001', NULL, 392, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(16, 'Yuppy Apple 120G', '6450.00', '7700.00', '0.00', '13170-0002', NULL, 393, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(17, 'Alfredo 4 Season 200Gr', '72000.00', '86000.00', '0.00', '13170-0003', NULL, 394, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(18, 'Alfredo Choco Milk & Dark 110G', '43000.00', '50400.00', '0.00', '13170-0004', NULL, 395, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(19, 'Alpenliebble Original With Mil', '4650.00', '5725.00', '0.00', '13170-0005', NULL, 396, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(20, 'Apollo Roka Reff 480Gr', '44000.00', '50600.00', '0.00', '13170-0006', NULL, 397, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(21, 'Apollo Roka Toples', '50000.00', '61200.00', '0.00', '13170-0007', NULL, 398, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(22, 'Astor Double 330 G', '23850.00', '27500.00', '0.00', '13170-0008', NULL, 399, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(23, 'Biskitop Durian 400Gr', '29167.00', '33000.00', '0.00', '13170-0009', NULL, 400, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(24, 'Biskitop Traditional 1500G', '395833.00', '69000.00', '0.00', '13170-0010', NULL, 401, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(25, 'Cadbury Dairi Milk Almond Nut', '47290.00', '52019.00', '0.00', '13170-0011', NULL, 402, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(26, 'Cavalier Choco Milk 44 Gr', '28000.00', '31000.00', '0.00', '13170-0012', NULL, 403, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(27, 'Cha Cha Coklat 85G', '11990.00', '15000.00', '0.00', '13170-0013', NULL, 404, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(28, 'Champ Hicken Ball 200G', '8175.00', '17175.00', '0.00', '13170-0014', NULL, 405, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(29, 'Chitato Chicken Bbq 40G', '4500.00', '6500.00', '0.00', '13170-0015', NULL, 406, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(30, 'Chitato Chicken Bbq 75G', '7833.00', '10500.00', '0.00', '13170-0016', NULL, 407, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(31, 'Coco Almonds 100 Gr', '25052.00', '30000.00', '0.00', '13170-0017', NULL, 408, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(32, 'Coco Creamy Milk 100Gr', '25000.00', '30000.00', '0.00', '13170-0018', NULL, 409, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(33, 'Coco Fruit & Nuts 100Gr', '25139.00', '30000.00', '0.00', '13170-0019', NULL, 410, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(34, 'Coco Hazelnuts 100Gr', '25000.00', '30000.00', '0.00', '13170-0020', NULL, 411, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(35, 'Coco Multi Pack 3X50Gr', '40000.00', '48000.00', '0.00', '13170-0021', NULL, 412, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(36, 'Coco Multi Pack Assorted 100G', '48000.00', '55000.00', '0.00', '13170-0022', NULL, 413, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(37, 'Coco Multi Pak Assor Bar 100Gr', '71399.00', '84000.00', '0.00', '13170-0023', NULL, 414, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(38, 'Cornet Beef Cip 198G', '11688.00', '13500.00', '0.00', '13170-0024', NULL, 415, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(39, 'Magnum Mini Clasic', '48360.00', '35236.00', '0.00', '13170-0025', NULL, 416, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(40, 'Mentos Anggur', '3927.00', '5301.00', '0.00', '13170-0026', NULL, 417, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(41, 'Mentos Buah', '2277.00', '2504.00', '0.00', '13170-0027', NULL, 418, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(42, 'Mentos Mint', '2277.00', '2504.00', '0.00', '13170-0028', NULL, 419, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(43, 'Milna Ayam Sayur 120 G', '22707.00', '23845.00', '0.00', '13170-0029', NULL, 420, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(44, 'Milna Biscuit Aple+Orange 65G', '6161.00', '7000.00', '0.00', '13170-0030', NULL, 421, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(45, 'Mini Black Orange 45G', '1816.00', '3566.00', '0.00', '13170-0031', NULL, 422, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(46, 'Mio Fullo Coklat', '410.00', '1000.00', '0.00', '13170-0032', NULL, 423, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(47, 'Mlkuat Tiger Straw 170 Ml', '3601.00', '4500.00', '0.00', '13170-0033', NULL, 424, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(48, 'Mr Bamboe Daun Kemangi 20Gr', '16305.00', '18805.00', '0.00', '13170-0034', NULL, 425, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(49, 'Much Better Vanila', '792.00', '1000.00', '0.00', '13170-0035', NULL, 426, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(50, 'Nestle Cereal Cbl Brown R. 120', '8303.00', '8750.00', '0.00', '13170-0036', NULL, 427, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(51, 'Nestle Cerelac Serealia Oats 1', '14541.00', '16500.00', '0.00', '13170-0037', NULL, 428, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(52, 'Nestle Cruch Chips Orange 14G', '842.00', '1500.00', '0.00', '13170-0038', NULL, 429, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(53, 'Nestle Crunch Chios Orng 60Gr', '4576.00', '6000.00', '0.00', '13170-0039', NULL, 430, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(54, 'Nestle Crunch Chip Peanut 60Gr', '4576.00', '6000.00', '0.00', '13170-0040', NULL, 431, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(55, 'Nestle Crunch Chips 30G', '2377.00', '3500.00', '0.00', '13170-0041', NULL, 432, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(56, 'Nestle Crunch Chips 60G', '4576.00', '6000.00', '0.00', '13170-0042', NULL, 433, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(57, 'Nestle Crunch Chips Sac 14G', '842.00', '1500.00', '0.00', '13170-0043', NULL, 434, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(58, 'Nestle Crunch Chips Straw 30G', '2377.00', '3500.00', '0.00', '13170-0044', NULL, 435, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(59, 'Nestle Crunch Chips Straw 60G', '4576.00', '6000.00', '0.00', '13170-0045', NULL, 436, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(60, 'Nissin Wafer Blueberry 100 Gr', '13000.00', '15000.00', '0.00', '13170-0046', NULL, 437, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(61, 'Panner Pie 168G', '15750.00', '17500.00', '0.00', '13170-0047', NULL, 438, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(62, 'Permen Mintz Tpl/C', '15256.00', '17000.00', '0.00', '13170-0048', NULL, 439, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(63, 'Piatos Ayam Panggang 55 G', '4439.00', '6000.00', '0.00', '13170-0049', NULL, 440, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(64, 'Piatos Keju 55 Gr', '4334.00', '6000.00', '0.00', '13170-0050', NULL, 441, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(65, 'Piatos Sapi Panggang 55Gr', '4388.00', '6000.00', '0.00', '13170-0051', NULL, 442, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(66, 'Piatos Sapi Panggang 85 Gr', '6066.00', '8500.00', '0.00', '13170-0052', NULL, 443, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(67, 'Plum Candy 340G', '20000.00', '21500.00', '0.00', '13170-0053', NULL, 444, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(68, 'Qtela Garlic Chicken 185G', '11667.00', '14000.00', '0.00', '13170-0054', NULL, 445, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(69, 'Qtela Grilled Cheese 185 Gr', '11667.00', '14000.00', '0.00', '13170-0055', NULL, 446, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(70, 'Ratafa Permen Tusuk', '600.00', '810.00', '0.00', '13170-0056', NULL, 447, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(71, 'Rich & Rich Choco Cookies', '104827.00', '6539.00', '0.00', '13170-0057', NULL, 448, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(72, 'Rich & Rich Cookies 80Gr', '21235.00', '7550.00', '0.00', '13170-0058', NULL, 449, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(73, 'Roma Chees Kress 72G', '3150.00', '3950.00', '0.00', '13170-0059', NULL, 450, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(74, 'Roma Marie Susu 115 Gr/40', '5131.00', '5500.00', '0.00', '13170-0060', NULL, 451, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(75, 'Roma Sari Gandum 39G', '1681.00', '2200.00', '0.00', '13170-0061', NULL, 452, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(76, 'Roma Super Keju 11Gr', '393.00', '1000.00', '0.00', '13170-0062', NULL, 453, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(77, 'Silver Queen Caramel 54 G', '9341.00', '10742.00', '0.00', '13170-0063', NULL, 454, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(78, 'Silver Queen Bites Almond 45 Gr', '5542.00', '6133.00', '0.00', '13170-0064', NULL, 455, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(79, 'Soy Joy Strawberry 30G', '4462.00', '5500.00', '0.00', '13170-0065', NULL, 456, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(80, 'Sponge Bob Super Suprise 10G', '13531.00', '16500.00', '0.00', '13170-0066', NULL, 457, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(81, 'Sq Crispy 60 Gr', '5452.00', '4983.00', '0.00', '13170-0067', NULL, 458, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(82, 'Sq Crispy Dark  35Gr', '5365.00', '5199.00', '0.00', '13170-0068', NULL, 459, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(83, 'Sq Montes 55 Gr', '9295.00', '10100.00', '0.00', '13170-0069', NULL, 460, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(84, 'Sq O Nut 44Gr', '69113.00', '7999.00', '0.00', '13170-0070', NULL, 461, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(85, 'Sq Rocker Orange 22 Gr', '3208.00', '3849.00', '0.00', '13170-0071', NULL, 462, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(86, 'Sukro Kribo 70Gr', '3035.00', '2632.00', '0.00', '13170-0072', NULL, 463, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(87, 'Sun Kacang Hijau Box 120 Gr', '7291.00', '7885.00', '0.00', '13170-0073', NULL, 464, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(88, 'Super Bubur Abon 45 Gr', '2603.00', '3000.00', '0.00', '13170-0074', NULL, 465, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(89, 'Super Bubur Ayam 45 Gr', '2526.00', '3000.00', '0.00', '13170-0075', NULL, 466, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(90, 'Tango Wafer Cappucino 76 Gr', '3800.00', '5000.00', '0.00', '13170-0076', NULL, 467, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(91, 'Taro Cheese Blast 40G', '4625.00', '5555.00', '0.00', '13170-0077', NULL, 468, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(92, 'Taro Curly Fries 40G', '4693.00', '5550.00', '0.00', '13170-0078', NULL, 469, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(93, 'Tim Tam Biskuit Vanilla 60Gr', '5800.00', '7000.00', '0.00', '13170-0079', NULL, 470, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(94, 'Top Strawberry 20Gr', '983.00', '1327.00', '0.00', '13170-0080', NULL, 471, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(95, 'Twisko Premium 48 Gr', '2345.00', '2675.00', '0.00', '13170-0081', NULL, 472, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(96, 'Twisko Premium 80G', '5588.00', '7000.00', '0.00', '13170-0082', NULL, 473, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(97, 'Twister Minis Black 80Gr', '6600.00', '7200.00', '0.00', '13170-0083', NULL, 474, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(98, 'Ubm Mini Assorted', '3566.00', '4200.00', '0.00', '13170-0084', NULL, 475, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(99, 'Ubm Pineaple 24', '7708.00', '8625.00', '0.00', '13170-0085', NULL, 476, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(100, 'Van Houten Choco Almound 150G', '48000.00', '55000.00', '0.00', '13170-0086', NULL, 477, 'Persediaan Makanan', 792, 0, 0, 1, 1, 1, 0, NULL, 1),
(101, 'Adem Sari Hanger 24', '1235.00', '1875.00', '0.00', '13180-0001', NULL, 478, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(102, 'Wong Coco Nata De Coco Cp 1000', '17500.00', '21000.00', '0.00', '13180-0002', NULL, 479, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(103, 'Wong Coco Nata De Coco Lc 1000', '17500.00', '21000.00', '0.00', '13180-0003', NULL, 480, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(104, 'Anmum Materna 400G', '70000.00', '73500.00', '0.00', '13180-0004', NULL, 481, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(105, 'Anmum Materna Coklat 400Gr', '70000.00', '77000.00', '0.00', '13180-0005', NULL, 482, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(106, 'Chil Mil Platinum 400G', '112420.00', '118040.00', '0.00', '13180-0006', NULL, 483, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(107, 'Chil School Coklat 200Gr', '29467.00', '30205.00', '0.00', '13180-0007', NULL, 484, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(108, 'Chil School Coklat 800Gr', '182859.00', '191153.00', '0.00', '13180-0008', NULL, 485, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(109, 'Chil School Plat Choco 400Gr', '57575.00', '59715.00', '0.00', '13180-0009', NULL, 486, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(110, 'Chil School Plat Coklat 400Gr', '93500.00', '98175.00', '0.00', '13180-0010', NULL, 487, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(111, 'Chil School Plat Madu 800Gr', '184621.00', '191153.00', '0.00', '13180-0011', NULL, 488, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(112, 'Chil School Straw 200Gr', '123111.00', '32011.00', '0.00', '13180-0012', NULL, 489, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(113, 'Coca Cola Zero', '5484.00', '6500.00', '0.00', '13180-0013', NULL, 490, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(114, 'Cornet Beef Cip Mushroom 340G', '16250.00', '19000.00', '0.00', '13180-0014', NULL, 491, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(115, 'Cornetto Disk Strwchesse 120Ml', '8840.00', '10120.00', '0.00', '13180-0015', NULL, 492, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(116, 'Cornetto Mini Bscoth&Cho 28Ml', '16517.00', '35910.00', '0.00', '13180-0016', NULL, 493, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(117, 'Cornetto Mini Choc&Tirami 28Ml', '28728.00', '37800.00', '0.00', '13180-0017', NULL, 494, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(118, 'Cornetto Mini Mango&Berry 28', '28728.00', '37800.00', '0.00', '13180-0018', NULL, 495, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(119, 'Marjan Fruit Punch 600 Ml', '17793.00', '19573.00', '0.00', '13180-0019', NULL, 496, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(120, 'Marjan Jambu Squash', '17881.00', '19669.00', '0.00', '13180-0020', NULL, 497, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(121, 'Marjan Leci', '17793.00', '19573.00', '0.00', '13180-0021', NULL, 498, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(122, 'Marjan Lemon', '9440.00', '12744.00', '0.00', '13180-0022', NULL, 499, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(123, 'Marjan Milk Rose 600Ml', '17535.00', '16243.00', '0.00', '13180-0023', NULL, 500, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(124, 'Marjan Moca 600 Ml', '17793.00', '24021.00', '0.00', '13180-0024', NULL, 501, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(125, 'Milo 3 In 1 Pilybag 35Gr', '82313.00', '60000.00', '0.00', '13180-0025', NULL, 502, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(126, 'Milo 3In 1 Sac 35 Gr', '1249.00', '14500.00', '0.00', '13180-0026', NULL, 503, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(127, 'Milo Act-E 150G', '12037.00', '13240.00', '0.00', '13180-0027', NULL, 504, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(128, 'Milo Act-E Sas 14G', '5496.00', '6000.00', '0.00', '13180-0028', NULL, 505, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(129, 'Milo Choco Bar 12 G', '2966.00', '3559.00', '0.00', '13180-0029', NULL, 506, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(130, 'Milo Sereal 32Gr', '5392.00', '6500.00', '0.00', '13180-0030', NULL, 507, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(131, 'Mizone Isotonic Cocopina 500Ml', '3400.00', '4750.00', '0.00', '13180-0031', NULL, 508, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(132, 'Nescafe Clasic Pack', '4648.00', '5113.00', '0.00', '13180-0032', NULL, 509, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(133, 'New Item', '4378.00', '5378.00', '0.00', '13180-0033', NULL, 510, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(134, 'New Vitalac 1 Van 800Gr', '100620.00', '105651.00', '0.00', '13180-0034', NULL, 511, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(135, 'New Vitalac 3+ Madu 800Ml', '70761.00', '95527.00', '0.00', '13180-0035', NULL, 512, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(136, 'Nutrilon 4 Soya Vanila 400 G', '82216.00', '85999.00', '0.00', '13180-0036', NULL, 513, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(137, 'Nutrilon Royal 3 Madu 400', '101474.00', '136990.00', '0.00', '13180-0037', NULL, 514, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(138, 'Nutrilon Royal 3 Van 400Gr', '93121.00', '98302.00', '0.00', '13180-0038', NULL, 515, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(139, 'Nutrisari American Orange 14Gr', '10946.00', '12985.00', '0.00', '13180-0039', NULL, 516, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(140, 'Nutrisari Swet Guava 11Gr', '849.00', '12396.00', '0.00', '13180-0040', NULL, 517, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(141, 'Nutrisari Swet Mango 11Gr', '5410.00', '7500.00', '0.00', '13180-0041', NULL, 518, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(142, 'Nutrive Benecol Orange 100Ml', '5208.00', '6250.00', '0.00', '13180-0042', NULL, 519, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(143, 'Pocari Sweet Pet 500 Ml', '5335.00', '7202.00', '0.00', '13180-0043', NULL, 520, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(144, 'Pondan Ice Cream Neopolitan', '23744.00', '28493.00', '0.00', '13180-0044', NULL, 521, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(145, 'Pondan Ice Cream Tiramissu 150', '17287.00', '19200.00', '0.00', '13180-0045', NULL, 522, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(146, 'Pop Drink Blackberry 8G', '2662.00', '4662.00', '0.00', '13180-0046', NULL, 523, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(147, 'Pop Drink Grape', '2662.00', '4662.00', '0.00', '13180-0047', NULL, 524, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(148, 'Pop Drink Kelapa Muda', '2662.00', '4662.00', '0.00', '13180-0048', NULL, 525, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(149, 'Pop Drink Srtrawberry', '2662.00', '4662.00', '0.00', '13180-0049', NULL, 526, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(150, 'Pop Drink Tamarin', '2662.00', '4662.00', '0.00', '13180-0050', NULL, 527, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(151, 'Pop Ice Avocado Cappuccino 25G', '4007.00', '4609.00', '0.00', '13180-0051', NULL, 528, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(152, 'Pop Ice Blender Vanila Late 25', '4007.00', '5409.00', '0.00', '13180-0052', NULL, 529, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(153, 'Pop Ice Capucino Durian 25 Gr', '4007.00', '4609.00', '0.00', '13180-0053', NULL, 530, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(154, 'Pop Ice Coffee Moccacino 25G', '4340.00', '6590.00', '0.00', '13180-0054', NULL, 531, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(155, 'Pop Ice Fruity Pop Orange Flav', '4315.00', '4609.00', '0.00', '13180-0055', NULL, 532, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(156, 'Pren Mommy Mocha 200 Gr', '36266.00', '35050.00', '0.00', '13180-0056', NULL, 533, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(157, 'Prenagen Emisis Cho 200Gr', '36762.00', '38700.00', '0.00', '13180-0057', NULL, 534, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(158, 'Prenagen Esensis Coklat 180G', '27809.00', '29500.00', '0.00', '13180-0058', NULL, 535, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(159, 'Prenagen Mommy Cho 400 Gr', '66529.00', '69500.00', '0.00', '13180-0059', NULL, 536, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(160, 'Prenagen Mommy Coklat 200 G', '34905.00', '36905.00', '0.00', '13180-0060', NULL, 537, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(161, 'Prenagen Mommy Strawberry 400', '65968.00', '69500.00', '0.00', '13180-0061', NULL, 538, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(162, 'Prengen Mommy Straw 600Gr', '80352.00', '100000.00', '0.00', '13180-0062', NULL, 539, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(163, 'Pulpy Aloe Vera 350 Ml', '5501.00', '7000.00', '0.00', '13180-0063', NULL, 540, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(164, 'S-26 Procal Gold 1-3 14Kg', '363583.00', '381762.00', '0.00', '13180-0064', NULL, 541, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(165, 'S-26 Procal Gold 1-3 400Gr', '78474.00', '67899.00', '0.00', '13180-0065', NULL, 542, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(166, 'S-26 Procal Gold 1-3 900Gr', '230333.00', '253366.00', '0.00', '13180-0066', NULL, 543, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(167, 'S-26 Promise Gold 1.4 Kg', '326416.00', '329652.00', '0.00', '13180-0067', NULL, 544, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(168, 'S26 Promise Gold 700G', '165920.00', '174216.00', '0.00', '13180-0068', NULL, 545, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(169, 'Sari Asem Asli 250Ml', '2504.00', '2880.00', '0.00', '13180-0069', NULL, 546, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(170, 'Sgm Soya 4 Madu 400Gr', '46346.00', '62567.00', '0.00', '13180-0070', NULL, 547, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(171, 'Siropen Telasih Manggis', '28325.00', '38239.00', '0.00', '13180-0071', NULL, 548, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(172, 'Tebs Pet Maroon 500 Ml', '5958.00', '7050.00', '0.00', '13180-0072', NULL, 549, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(173, 'Tebs Pet Reguler 500 Ml', '5967.00', '7050.00', '0.00', '13180-0073', NULL, 550, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(174, 'Teh Bendera Celup 25 S', '3979.00', '4818.00', '0.00', '13180-0074', NULL, 551, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(175, 'Teh Botol Sosro Jasmine 500Ml', '5585.00', '6500.00', '0.00', '13180-0075', NULL, 552, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(176, 'Teh Cap Btl Hijau Celup', '4200.00', '5400.00', '0.00', '13180-0076', NULL, 553, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(177, 'Teh Celup 25 Black Tea 10 Ball', '3100.00', '4000.00', '0.00', '13180-0077', NULL, 554, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(178, 'Teh Celup Sosro Black Tea', '15396.00', '5000.00', '0.00', '13180-0078', NULL, 555, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(179, 'Teh Celup Sosro Black Tea 36', '12000.00', '15000.00', '0.00', '13180-0079', NULL, 556, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(180, 'Teh Celup Sosro Black Tea 50', '6000.00', '7200.00', '0.00', '13180-0080', NULL, 557, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(181, 'Teh Gelas Jumbo 330Ml', '2622.00', '4000.00', '0.00', '13180-0081', NULL, 558, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(182, 'Teh Poci Vanila 25Gr', '3300.00', '3378.00', '0.00', '13180-0082', NULL, 559, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(183, 'Teh Poci Vanila 50', '1600.00', '2100.00', '0.00', '13180-0083', NULL, 560, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(184, 'Teh Serr Teh Kundur', '2076.00', '1200.00', '0.00', '13180-0084', NULL, 561, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(185, 'Teh Serr Teh Seger', '37819.00', '1200.00', '0.00', '13180-0085', NULL, 562, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(186, 'Teh Sisri Apel', '2782.00', '3756.00', '0.00', '13180-0086', NULL, 563, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(187, 'Tipco Kiwi 1 L', '30616.00', '32500.00', '0.00', '13180-0087', NULL, 564, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(188, 'Top Black & White', '937.00', '1125.00', '0.00', '13180-0088', NULL, 565, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(189, 'Top Ice Kacang Hijau', '2821.00', '3245.00', '0.00', '13180-0089', NULL, 566, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(190, 'Top Ice Kopi', '2821.00', '3245.00', '0.00', '13180-0090', NULL, 567, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(191, 'Ultra Milk Chocolate 250 Ml', '4000.00', '5500.00', '0.00', '13180-0091', NULL, 568, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(192, 'Ultra Milk Mocca 250 Ml', '3518.00', '5500.00', '0.00', '13180-0092', NULL, 569, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(193, 'Ultra Milk Plain 250Ml', '3813.00', '5500.00', '0.00', '13180-0093', NULL, 570, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(194, 'Ultra Milk Strawberry 250Ml', '3935.00', '5500.00', '0.00', '13180-0094', NULL, 571, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(195, 'Vitalac Vanila 900G', '100620.00', '135837.00', '0.00', '13180-0095', NULL, 572, 'Persediaan Minuman', 793, 0, 0, 1, 1, 1, 0, NULL, 1),
(196, 'Service', '30.00', '75.00', '0.00', '', NULL, 1, 'All products', 0, 872, 948, 1, 1, 1, 0, NULL, 1),
(197, 'Pro Mild jaya', '9000.00', '10000.00', '0.00', '13160-0001', NULL, 573, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1),
(198, 'Unreferenced Products', '0.00', '1.00', '0.00', '', NULL, 587, 'All products', 0, 0, 0, 1, 1, 1, 0, NULL, 1),
(199, 'Pro Mild jaya 1', '9000.00', '10000.00', '0.00', '13160-0001', NULL, 573, 'Persediaan Rokok', 791, 0, 0, 1, 1, 1, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_discount`
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
-- Dumping data untuk tabel `product_discount`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `product_gift`
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
-- Dumping data untuk tabel `product_gift`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `session`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `session`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `session_payment`
--

CREATE TABLE IF NOT EXISTS `session_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `oe_statement_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`,`payment_type_id`,`oe_statement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `session_payment`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_move`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `stock_move`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `table`
--

CREATE TABLE IF NOT EXISTS `table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `table`
--

INSERT INTO `table` (`id`, `table_name`, `status`) VALUES
(1, 'Meja 1', 0),
(2, 'Meja 2', 1),
(3, 'Meja 3', 0),
(4, 'Meja 4', 1),
(5, 'Meja 5', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `login`, `password`, `oe_id`, `group_name`) VALUES
(1, 'Administrator', 'admin', '1', 1, 'ADMIN'),
(2, 'waiter', 'waiter', 'waiter', 2, 'WAITER'),
(3, 'kitchen', 'kitchen', 'kitchen', 3, 'KITCHEN'),
(4, 'cashier', 'cashier', 'cashier', 4, 'CASHIER');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cashbox_line`
--
ALTER TABLE `cashbox_line`
  ADD CONSTRAINT `cashbox_line_ibfk_1` FOREIGN KEY (`session_payment_id`) REFERENCES `session_payment` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `journal_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`oe_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_payment`
--
ALTER TABLE `order_payment`
  ADD CONSTRAINT `order_payment_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_payment_ibfk_4` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `prepare_barcode`
--
ALTER TABLE `prepare_barcode`
  ADD CONSTRAINT `prepare_barcode_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_discount`
--
ALTER TABLE `product_discount`
  ADD CONSTRAINT `product_discount_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_gift`
--
ALTER TABLE `product_gift`
  ADD CONSTRAINT `product_gift_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_gift_ibfk_2` FOREIGN KEY (`gift_product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `session_payment`
--
ALTER TABLE `session_payment`
  ADD CONSTRAINT `session_payment_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock_move`
--
ALTER TABLE `stock_move`
  ADD CONSTRAINT `stock_move_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_move_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`oe_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
