-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2023 at 08:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-konseling`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `konselor`
--

CREATE TABLE `konselor` (
  `id_konselor` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `spesialisasi` varchar(255) NOT NULL,
  `foto_konselor` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konselor`
--

INSERT INTO `konselor` (`id_konselor`, `username`, `password`, `nama`, `spesialisasi`, `foto_konselor`) VALUES
(11, 'konselor_aldous', 'konselor_aldous', 'aldous gember S.H., M.Pr., Dp.R', 'demo', 'foto11681054883.png'),
(12, 'konselor_stepanus', 'konselor_stepanus', 'stepanus, Kor.P., M.Pu', 'ngintip', 'foto11681054996.jpg'),
(13, 'konselor_sungkoco', 'konselor_sungkoco', 'sungkoco, Ph.D', 'smackdown', 'foto11681055154.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `id_konselor` int(5) NOT NULL,
  `id_konseling` int(5) NOT NULL,
  `jenis_konsultasi` varchar(55) NOT NULL,
  `tanggal` varchar(25) NOT NULL,
  `jam` varchar(11) NOT NULL,
  `no_wa` varchar(15) NOT NULL,
  `permasalahan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id`, `id_konselor`, `id_konseling`, `jenis_konsultasi`, `tanggal`, `jam`, `no_wa`, `permasalahan`) VALUES
(1, 1, 2, 'individu (1 orang)', '2023-04-14', '18:42', '08312322', 'stress'),
(2, 1, 2, 'kelompok', '2023-04-09', '19:55', '34342134214', 'pusing');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_konseling`
--

CREATE TABLE `pengguna_konseling` (
  `id_konseling` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna_konseling`
--

INSERT INTO `pengguna_konseling` (`id_konseling`, `username`, `password`, `nama`, `no_telp`) VALUES
(2, 'aldous1', 'aldous1', 'aldous', '08231231');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konselor`
--
ALTER TABLE `konselor`
  ADD PRIMARY KEY (`id_konselor`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna_konseling`
--
ALTER TABLE `pengguna_konseling`
  ADD PRIMARY KEY (`id_konseling`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konselor`
--
ALTER TABLE `konselor`
  MODIFY `id_konselor` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengguna_konseling`
--
ALTER TABLE `pengguna_konseling`
  MODIFY `id_konseling` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
