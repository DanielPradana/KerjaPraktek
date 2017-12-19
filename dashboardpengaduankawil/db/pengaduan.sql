-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2017 at 05:11 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(100) NOT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `idofcomplaintrecord` varchar(100) DEFAULT NULL,
  `usercomplaint` varchar(100) DEFAULT NULL,
  `numberofcomplaintrecord` varchar(100) DEFAULT NULL,
  `complaintdate` date DEFAULT NULL,
  `complaintrecord` date NOT NULL,
  `complainttitle` text,
  `complaintreceivedby` varchar(100) DEFAULT NULL,
  `complaintmedia` varchar(100) DEFAULT NULL,
  `complainttype` varchar(100) DEFAULT NULL,
  `complaintinformation` text,
  `photo` varchar(100) NOT NULL,
  `video` varchar(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `opencount` int(100) NOT NULL,
  `datefinished` date NOT NULL,
  `totalhari` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`id`, `userid`, `idofcomplaintrecord`, `usercomplaint`, `numberofcomplaintrecord`, `complaintdate`, `complaintrecord`, `complainttitle`, `complaintreceivedby`, `complaintmedia`, `complainttype`, `complaintinformation`, `photo`, `video`, `status`, `opencount`, `datefinished`, `totalhari`) VALUES
(1, 'PE154870', 'DPPE15487020171128061123', 'abcde', '12345', '2017-11-29', '2017-11-29', 'abcd', 'KACAB AMBON', 'Mobile Phone (Voice Call)', 'JP1.Permintaan Informasi (INQUIRY)', '<p>abcd</p>', '', '', 'onprogress', 3, '0000-00-00', 0),
(2, 'PE154870', 'DPPE15487020171128061123', 'abcde', '12345', '2017-11-29', '2017-11-29', 'aaa', 'KACAB AMBON', 'Mobile Phone (Voice Call)', 'JP1.Permintaan Informasi (INQUIRY)', '<p>abcd</p>', '', '', 'onprogress', 3, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(100) NOT NULL,
  `complaintonprogress` int(100) NOT NULL,
  `complaintdelete` int(100) NOT NULL,
  `complaintfinished` int(100) NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `userid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `complaintonprogress`, `complaintdelete`, `complaintfinished`, `tahun`, `bulan`, `userid`) VALUES
(1, 1, 0, 0, '2017', '11', 'PE154870');

-- --------------------------------------------------------

--
-- Table structure for table `tindakanpenanganan`
--

CREATE TABLE `tindakanpenanganan` (
  `idpenanganan` int(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `idofcomplaintrecord` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tindakanpenanganan`
--

INSERT INTO `tindakanpenanganan` (`idpenanganan`, `userid`, `idofcomplaintrecord`, `tujuan`, `keterangan`, `tanggal`) VALUES
(1, 'PE154870', 'DPPE15487020171128061123', 'KACAB AMBON', 'testing', '2017-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `iduser` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `divisi` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `iduser`, `username`, `password`, `divisi`, `jabatan`, `image`, `lokasi`) VALUES
(1, 'PE154870', 'ALLEKZANDRO PETRA MAY FERNOWO', 'admin', 'DIVISI PELAYANAN DAN PENGADUAN', 'PENATA MADYA PENGADUAN', '', 'kapu'),
(2, 'PE154871', 'DANIEL', 'admin1', 'PENGADUAN', 'PELAYANAN', '', 'kawil'),
(3, 'PE154872', 'USER1', 'admin', 'PENGADUAN', 'PELAYANAN', '', 'kapu'),
(4, 'PE154873', 'USER2', 'admin', 'PENGADUAN', 'PELAYANAN', '', 'kapu'),
(5, 'PE154874', 'USER3', 'admin', 'PENGADUAN', 'PELAYANAN', '', 'kapu'),
(6, 'PE154875', 'USER4', 'admin', 'PENGADUAN', 'PELAYANAN', '', 'kapu'),
(7, 'PE154875', 'USER5', 'admin', 'PENGADUAN', 'PELAYANAN', '', 'kapu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tindakanpenanganan`
--
ALTER TABLE `tindakanpenanganan`
  ADD PRIMARY KEY (`idpenanganan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tindakanpenanganan`
--
ALTER TABLE `tindakanpenanganan`
  MODIFY `idpenanganan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
