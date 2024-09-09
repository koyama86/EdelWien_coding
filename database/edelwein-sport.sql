-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1:3308
-- 生成日時: 2024-09-05 04:55:45
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `edelwein-sport`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `detail`
--

CREATE TABLE `detail` (
  `post_id` int(11) NOT NULL,
  `detail_no` int(11) NOT NULL,
  `detail_cd` int(1) NOT NULL,
  `detail_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `detail`
--

INSERT INTO `detail` (`post_id`, `detail_no`, `detail_cd`, `detail_text`) VALUES
(23, 0, 0, 'これはテストです'),
(23, 1, 2, 'images/hudounotaki.jpg'),
(23, 2, 1, 'aa'),
(23, 3, 2, 'images/'),
(24, 0, 0, 'aaa'),
(24, 1, 2, 'images/nanatugama.jpg'),
(24, 2, 1, 'aa'),
(24, 3, 2, 'images/hudounotaki.jpg'),
(25, 0, 0, 'イベントが始まります'),
(25, 1, 2, 'images/スクリーンショット 2024-09-01 233155.png'),
(25, 2, 1, '詳細'),
(25, 3, 2, 'images/437798238_18234202009265662_2554440584065821932_n.jpg'),
(26, 0, 0, 'イベントです'),
(26, 1, 2, 'images/313172378_663141908845559_7733439823107260108_n.jpg'),
(26, 2, 1, 'bb'),
(26, 3, 2, 'images/419667550_18223509511265662_8567938481805412870_n.jpg');

-- --------------------------------------------------------

--
-- テーブルの構造 `detail-type`
--

CREATE TABLE `detail-type` (
  `detail_cd` int(1) NOT NULL,
  `detail_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `detail-type`
--

INSERT INTO `detail-type` (`detail_cd`, `detail_type`) VALUES
(0, 'subtitle'),
(1, 'text'),
(2, 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `page`
--

CREATE TABLE `page` (
  `page_cd` int(1) NOT NULL,
  `page` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `page`
--

INSERT INTO `page` (`page_cd`, `page`) VALUES
(0, 'grass'),
(1, 'hotel'),
(2, 'restaurant');

-- --------------------------------------------------------

--
-- テーブルの構造 `page-detail`
--

CREATE TABLE `page-detail` (
  `page_cd` int(1) NOT NULL,
  `image_no` int(11) NOT NULL,
  `image_url` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `post_cd` int(1) NOT NULL,
  `detail_cnt` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `edit_date` date NOT NULL,
  `post_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `post`
--

INSERT INTO `post` (`post_id`, `title`, `post_cd`, `detail_cnt`, `post_date`, `edit_date`, `post_flg`) VALUES
(1, '0', 0, 0, '2024-09-04', '2024-09-04', 1),
(2, '0', 0, 0, '2024-09-04', '2024-09-04', 1),
(3, 'これはテストです', 0, 0, '2024-09-04', '2024-09-04', 1),
(4, 'これはテストです', 0, 0, '2024-09-05', '2024-09-05', 1),
(5, 'これはテストです', 0, 0, '2024-09-05', '2024-09-05', 1),
(6, 'これはテストです', 0, 0, '2024-09-05', '2024-09-05', 1),
(7, 'これはテストです', 0, 0, '2024-09-05', '2024-09-05', 1),
(8, 'これはテストです', 0, 0, '2024-09-05', '2024-09-05', 1),
(9, 'これはテストです', 0, 0, '2024-09-05', '2024-09-05', 1),
(10, 'これはテストです', 0, 0, '2024-09-05', '2024-09-05', 1),
(11, 'これはテストです', 0, 0, '2024-09-05', '2024-09-05', 1),
(12, 'フォームの再送信はなくなっていますか？', 0, 0, '2024-09-05', '2024-09-05', 1),
(13, 'フォームの再送信はなくなっていますか？', 0, 0, '2024-09-05', '2024-09-05', 1),
(14, 'これはテストです', 0, 0, '2024-09-05', '2024-09-05', 1),
(15, 'これはテストです', 0, 0, '2024-09-05', '2024-09-05', 1),
(16, 'これはテストです', 0, 0, '2024-09-05', '2024-09-05', 1),
(17, 'これはテストです', 1, 0, '2024-09-05', '2024-09-05', 1),
(18, 'これはテストです', 1, 0, '2024-09-05', '2024-09-05', 1),
(19, 'テスト', 1, 0, '2024-09-05', '2024-09-05', 1),
(20, 'テスト', 1, 0, '2024-09-05', '2024-09-05', 1),
(21, 'テスト', 1, 0, '2024-09-05', '2024-09-05', 1),
(22, 'テスト', 1, 0, '2024-09-05', '2024-09-05', 1),
(23, 'これはテストです', 1, 4, '2024-09-05', '2024-09-05', 1),
(24, 'テスト', 1, 4, '2024-09-05', '2024-09-05', 1),
(25, 'イベント', 0, 4, '2024-09-05', '2024-09-05', 1),
(26, 'test11', 1, 4, '2024-09-05', '2024-09-05', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `post-type`
--

CREATE TABLE `post-type` (
  `post_cd` int(1) NOT NULL,
  `post_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `post-type`
--

INSERT INTO `post-type` (`post_cd`, `post_type`) VALUES
(0, 'notice'),
(1, 'event');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- テーブルのインデックス `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`post_id`,`detail_no`);

--
-- テーブルのインデックス `detail-type`
--
ALTER TABLE `detail-type`
  ADD PRIMARY KEY (`detail_cd`);

--
-- テーブルのインデックス `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_cd`);

--
-- テーブルのインデックス `page-detail`
--
ALTER TABLE `page-detail`
  ADD PRIMARY KEY (`page_cd`,`image_no`);

--
-- テーブルのインデックス `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- テーブルのインデックス `post-type`
--
ALTER TABLE `post-type`
  ADD PRIMARY KEY (`post_cd`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
