-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-12 14:15:30
-- サーバのバージョン： 10.4.18-MariaDB
-- PHP のバージョン: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `youmacity_prototype`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `manual`
--

CREATE TABLE `manual` (
  `id` int(11) NOT NULL,
  `user_name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `contents` text COLLATE utf8mb4_bin NOT NULL,
  `youtube_thumbnail` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `manual`
--

INSERT INTO `manual` (`id`, `user_name`, `contents`, `youtube_thumbnail`, `updated_at`) VALUES
(35, 'takemoto', '<h1>G\'s紹介</h1>\r\n<p>山口校3</p>', 'https://www.youtube.com/watch?v=3GdMDYf_uN4', '2022-01-11 20:59:16'),
(38, 'takemoto', '<h2>G\'sアカデミー</h2>\r\n<div>福岡校<span style=\"color: #e03e2d;\">opening</span><br /><strong><span style=\"color: #000000;\">youtube動画</span></strong></div>\r\n<div>テスト6</div>\r\n<p>&nbsp;</p>', 'https://www.youtube.com/watch?v=vMK8bcZ6w3I', '2022-01-11 21:00:07'),
(40, 'takemoto', '<h2>自分でyoutubeに投稿</h2>\r\n<div><strong><span style=\"color: #e03e2d;\">思ったより簡単</span></strong></div>\r\n<div style=\"text-align: left;\"><span style=\"color: #000000; font-family: \'comic sans ms\', sans-serif;\">キャプチャ撮って投稿するだけ</span></div>', 'https://www.youtube.com/watch?v=mL4CNdmOhJw', '2022-01-12 22:12:42');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `user_name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `updated_at`) VALUES
(1, 'takemoto', '1111', '2022-01-09 12:51:58');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `manual`
--
ALTER TABLE `manual`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `manual`
--
ALTER TABLE `manual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
