-- MySQL dump 10.16  Distrib 10.1.31-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: laravel_spp
-- ------------------------------------------------------
-- Server version	10.1.31-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `kas`
--

DROP TABLE IF EXISTS `kas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kas` (
  `id_kas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `pemasukan` int(11) NOT NULL,
  `pengeluaran` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `operator` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kas`),
  KEY `kas_id_user_foreign` (`operator`),
  CONSTRAINT `kas_id_user_foreign` FOREIGN KEY (`operator`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kas`
--

LOCK TABLES `kas` WRITE;
/*!40000 ALTER TABLE `kas` DISABLE KEYS */;
INSERT INTO `kas` (`id_kas`, `tanggal`, `pemasukan`, `pengeluaran`, `keterangan`, `operator`, `created_at`, `updated_at`) VALUES (1,'2018-08-08',200000,0,'Sumbangan Masjid',1,'2018-08-08 05:48:54','2018-08-08 05:48:54'),(2,'2018-08-08',20000,0,'asd',1,'2018-08-08 05:50:20','2018-08-08 05:50:20'),(3,'2018-08-10',225,0,'1Pembayaran Samodraas',1,'2018-08-09 18:18:26','2018-08-09 18:18:26'),(4,'2018-08-10',675000,0,'3 BulanPembayaran Samodraas',1,'2018-08-09 18:21:14','2018-08-09 18:21:14');
/*!40000 ALTER TABLE `kas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kelas` (
  `id_kelas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=11222 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` (`id_kelas`, `kelas`, `jurusan`, `letter`, `keterangan`, `created_at`, `updated_at`) VALUES (11111,'XI','Rekayasa Perangkat Lunak','C','asdsad','2018-08-07 04:56:24','2018-08-07 04:56:24'),(11126,'X','Rekayasa Perangkat Lunak','A','X Rekayasa Perangkat Lunak A','2018-08-16 20:25:07','2018-08-16 20:25:07'),(11127,'X','Rekayasa Perangkat Lunak','B','X Rekayasa Perangkat Lunak B','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11128,'X','Rekayasa Perangkat Lunak','C','X Rekayasa Perangkat Lunak C','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11130,'X','Teknik Gambar Bangunan','A','X Teknik Gambar Bangunan A','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11131,'X','Teknik Gambar Bangunan','B','X Teknik Gambar Bangunan B','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11132,'X','Teknik Gambar Bangunan','C','X Teknik Gambar Bangunan C','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11134,'X','Teknik Elektronika Industri','A','X Teknik Elektronika Industri A','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11135,'X','Teknik Elektronika Industri','B','X Teknik Elektronika Industri B','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11138,'X','Teknik Otomasi Industri','A','X Teknik Otomasi Industri A','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11139,'X','Teknik Otomasi Industri','B','X Teknik Otomasi Industri B','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11142,'X','Teknik Sepeda Motor','A','X Teknik Sepeda Motor A','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11143,'X','Teknik Sepeda Motor','B','X Teknik Sepeda Motor B','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11146,'X','Teknik Las','A','X Teknik Las A','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11150,'X','Teknik Permesinan','A','X Teknik Permesinan A','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11151,'X','Teknik Permesinan','B','X Teknik Permesinan B','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11152,'X','Teknik Permesinan','C','X Teknik Permesinan C','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11153,'X','Teknik Permesinan','D','X Teknik Permesinan D','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11154,'X','Teknik Konstruksi Kayu','A','X Teknik Konstruksi Kayu A','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11155,'X','Teknik Konstruksi Kayu','B','X Teknik Konstruksi Kayu B','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11158,'XI','Rekayasa Perangkat Lunak','A','XI Rekayasa Perangkat Lunak A','2018-08-16 20:25:08','2018-08-16 20:25:08'),(11159,'XI','Rekayasa Perangkat Lunak','B','XI Rekayasa Perangkat Lunak B','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11162,'XI','Teknik Gambar Bangunan','A','XI Teknik Gambar Bangunan A','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11163,'XI','Teknik Gambar Bangunan','B','XI Teknik Gambar Bangunan B','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11164,'XI','Teknik Gambar Bangunan','C','XI Teknik Gambar Bangunan C','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11166,'XI','Teknik Elektronika Industri','A','XI Teknik Elektronika Industri A','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11167,'XI','Teknik Elektronika Industri','B','XI Teknik Elektronika Industri B','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11170,'XI','Teknik Otomasi Industri','A','XI Teknik Otomasi Industri A','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11171,'XI','Teknik Otomasi Industri','B','XI Teknik Otomasi Industri B','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11174,'XI','Teknik Sepeda Motor','A','XI Teknik Sepeda Motor A','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11175,'XI','Teknik Sepeda Motor','B','XI Teknik Sepeda Motor B','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11178,'XI','Teknik Las','A','XI Teknik Las A','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11182,'XI','Teknik Permesinan','A','XI Teknik Permesinan A','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11183,'XI','Teknik Permesinan','B','XI Teknik Permesinan B','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11184,'XI','Teknik Permesinan','C','XI Teknik Permesinan C','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11185,'XI','Teknik Permesinan','D','XI Teknik Permesinan D','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11186,'XI','Teknik Konstruksi Kayu','A','XI Teknik Konstruksi Kayu A','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11187,'XI','Teknik Konstruksi Kayu','B','XI Teknik Konstruksi Kayu B','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11190,'XII','Rekayasa Perangkat Lunak','A','XII Rekayasa Perangkat Lunak A','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11191,'XII','Rekayasa Perangkat Lunak','B','XII Rekayasa Perangkat Lunak B','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11192,'XII','Rekayasa Perangkat Lunak','C','XII Rekayasa Perangkat Lunak C','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11194,'XII','Teknik Gambar Bangunan','A','XII Teknik Gambar Bangunan A','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11195,'XII','Teknik Gambar Bangunan','B','XII Teknik Gambar Bangunan B','2018-08-16 20:25:09','2018-08-16 20:25:09'),(11196,'XII','Teknik Gambar Bangunan','C','XII Teknik Gambar Bangunan C','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11198,'XII','Teknik Elektronika Industri','A','XII Teknik Elektronika Industri A','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11199,'XII','Teknik Elektronika Industri','B','XII Teknik Elektronika Industri B','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11202,'XII','Teknik Otomasi Industri','A','XII Teknik Otomasi Industri A','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11203,'XII','Teknik Otomasi Industri','B','XII Teknik Otomasi Industri B','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11206,'XII','Teknik Sepeda Motor','A','XII Teknik Sepeda Motor A','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11207,'XII','Teknik Sepeda Motor','B','XII Teknik Sepeda Motor B','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11210,'XII','Teknik Las','A','XII Teknik Las A','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11214,'XII','Teknik Permesinan','A','XII Teknik Permesinan A','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11215,'XII','Teknik Permesinan','B','XII Teknik Permesinan B','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11216,'XII','Teknik Permesinan','C','XII Teknik Permesinan C','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11217,'XII','Teknik Permesinan','D','XII Teknik Permesinan D','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11218,'XII','Teknik Konstruksi Kayu','A','XII Teknik Konstruksi Kayu A','2018-08-16 20:25:10','2018-08-16 20:25:10'),(11219,'XII','Teknik Konstruksi Kayu','B','XII Teknik Konstruksi Kayu B','2018-08-16 20:25:10','2018-08-16 20:25:10');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_08_01_002845_create_tahun_table',1),(4,'2018_08_01_002954_create_kelas_table',1),(5,'2018_08_01_003025_create_siswa_table',1),(6,'2018_08_01_003103_create_transaksi_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa` (
  `id_siswa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_induk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int(10) unsigned NOT NULL,
  `id_tahun` int(10) unsigned NOT NULL,
  `nama_wali` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_spp` int(11) NOT NULL DEFAULT '2700000',
  `status` enum('Lunas','Belum Lunas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Lunas',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_siswa`),
  UNIQUE KEY `siswa_no_induk_unique` (`no_induk`),
  KEY `siswa_id_kelas_foreign` (`id_kelas`),
  KEY `siswa_id_tahun_foreign` (`id_tahun`),
  CONSTRAINT `siswa_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `siswa_id_tahun_foreign` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa`
--

LOCK TABLES `siswa` WRITE;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` (`id_siswa`, `no_induk`, `nama`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `alamat`, `id_kelas`, `id_tahun`, `nama_wali`, `telepon`, `total_spp`, `status`, `keterangan`, `foto`, `created_at`, `updated_at`) VALUES (11111,'123123','Samodra','Ponorogo','2017-07-06','Laki-Laki','Islam','sdasd',11111,1,'asd','123',2500000,'Belum Lunas','sdasd','Cover Belakang.png','2018-08-07 04:58:54','2018-08-12 07:49:56'),(11112,'12312323','Samodraas','Ponorogo','2017-07-06','Laki-Laki','Islam','sdasd',11111,1,'asd','123',1824775,'Lunas','sdasd','Cover Belakang.png','2018-08-07 04:58:54','2018-08-12 07:49:56'),(11113,'12343','Test','Ponorogo','2017-07-06','Laki-Laki','Islam','sdasd',11111,1,'asd','123',2500000,'Belum Lunas','sdasd','Cover Belakang.png','2018-08-07 04:58:54','2018-08-12 07:49:56'),(11114,'13213','Aimer','Ponorogo','2016-10-09','Perempuan','Kristen','asd',11111,1,'Test0','2819379123',2700000,'Belum Lunas','daksjd','ca0c89723dc5dff84d58b7c4ca72ae23.png','2018-08-11 03:26:24','2018-08-12 07:49:56');
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tahun`
--

DROP TABLE IF EXISTS `tahun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tahun` (
  `id_tahun` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahun` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahun`
--

LOCK TABLES `tahun` WRITE;
/*!40000 ALTER TABLE `tahun` DISABLE KEYS */;
INSERT INTO `tahun` (`id_tahun`, `tahun`, `status`, `created_at`, `updated_at`) VALUES (1,'2017/2018','Aktif','2018-08-07 04:55:55','2018-08-12 03:38:50'),(3,'2018/2019','Tidak Aktif','2018-08-07 04:59:54','2018-08-08 04:42:04'),(7,'2010/2011','Tidak Aktif','2018-08-16 20:39:26','2018-08-16 20:39:26'),(8,'2011/2012','Tidak Aktif','2018-08-16 20:39:26','2018-08-16 20:39:26'),(9,'2012/2013','Tidak Aktif','2018-08-16 20:39:26','2018-08-16 20:39:26'),(10,'2013/2014','Tidak Aktif','2018-08-16 20:39:26','2018-08-16 20:39:26'),(11,'2014/2015','Tidak Aktif','2018-08-16 20:39:26','2018-08-16 20:39:26'),(12,'2015/2016','Tidak Aktif','2018-08-16 20:39:26','2018-08-16 20:39:26'),(13,'2016/2017','Tidak Aktif','2018-08-16 20:41:08','2018-08-16 20:41:08');
/*!40000 ALTER TABLE `tahun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `id_transaksi` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_siswa` int(10) unsigned NOT NULL,
  `id_kelas` int(10) unsigned NOT NULL,
  `id_tahun` int(10) unsigned NOT NULL,
  `bayar` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `operator` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `transaksi_id_siswa_foreign` (`id_siswa`),
  KEY `transaksi_id_tahun_foreign` (`id_tahun`),
  KEY `transaksi_id_user_foreign` (`operator`),
  KEY `transaksi_id_kelas_foreign` (`id_kelas`),
  CONSTRAINT `transaksi_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `transaksi_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `transaksi_id_tahun_foreign` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id_tahun`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `transaksi_id_user_foreign` FOREIGN KEY (`operator`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` (`id_transaksi`, `id_siswa`, `id_kelas`, `id_tahun`, `bayar`, `tgl_bayar`, `keterangan`, `operator`, `created_at`, `updated_at`) VALUES (1,11112,11111,3,225,'2018-08-10',NULL,1,'2018-08-09 18:18:25','2018-08-09 18:18:25'),(2,11112,11111,3,675000,'2018-08-10',NULL,1,'2018-08-09 18:21:14','2018-08-09 18:21:14');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `level`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES (1,'admin','admin@admin.com','admin','$2y$10$Do6tgj6uj3.WjOPiB2cXN.EnAo613.HAYgpGUe8Jfai54ZT6ecyJu','default.jpg','wU5DGtvDOcRYk2kOOQe39EXDuIoDZAfhdIGUD2otPRGPkMvx7xebaW3ROzx3','2018-08-07 04:55:41','2018-08-07 04:55:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-17 10:41:58
