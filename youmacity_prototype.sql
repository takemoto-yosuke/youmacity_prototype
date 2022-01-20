-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-20 15:07:54
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
-- テーブルの構造 `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(128) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `groups`
--

INSERT INTO `groups` (`id`, `group_name`) VALUES
(1, 'test1'),
(2, 'test2'),
(4, '1部'),
(5, '2部'),
(6, '3部'),
(7, '4部'),
(8, '5部'),
(9, '6部'),
(10, '7部'),
(11, '8部');

-- --------------------------------------------------------

--
-- テーブルの構造 `manual`
--

CREATE TABLE `manual` (
  `id` int(11) NOT NULL,
  `user_name_id` int(11) NOT NULL,
  `contents` text COLLATE utf8mb4_bin NOT NULL,
  `youtube_thumbnail` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `manual`
--

INSERT INTO `manual` (`id`, `user_name_id`, `contents`, `youtube_thumbnail`, `updated_at`) VALUES
(58, 4, '<p>test</p>', 'https://www.youtube.com/watch?v=tRG8Qa8vPX4', '2022-01-19 22:01:14'),
(60, 5, '<p>s</p>', 'https://www.youtube.com/watch?v=gky-qLG5Xvg', '2022-01-19 22:03:39'),
(61, 6, '<p>s</p>', 'https://www.youtube.com/watch?v=FOQdmdw9Jjo', '2022-01-19 22:11:08'),
(62, 7, '<p>a</p>', 'https://www.youtube.com/watch?v=gSV2s-B6pgY', '2022-01-19 22:17:19'),
(63, 5, '<p>1</p>', 'https://www.youtube.com/watch?v=6vSQhbYn4Bc', '2022-01-19 22:23:20'),
(64, 10, '<p>ああ</p>', 'https://www.youtube.com/watch?v=2gftA8CqWv0', '2022-01-19 22:45:36');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `user_name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `group_id` int(11) NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `user_name`, `group_id`, `password`, `updated_at`) VALUES
(1, 'takemoto', 0, '1111', '2022-01-09 12:51:58'),
(2, '竹本', 0, '1111', '2022-01-16 21:08:05'),
(3, 'たけもと', 1, '1111', '2022-01-18 21:26:29'),
(4, 'ジョナサン', 4, '1', '2022-01-19 21:52:49'),
(5, 'ジョセフ', 5, '1', '2022-01-19 21:53:04'),
(6, '承太郎', 6, '1', '2022-01-19 21:54:17'),
(7, '仗助', 7, '1', '2022-01-19 21:54:43'),
(8, 'ジョルノ', 8, '1', '2022-01-19 21:55:44'),
(9, 'ジョリーン', 9, '1', '2022-01-19 21:56:09'),
(10, '吉良吉影', 7, '1', '2022-01-19 22:25:16');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

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
-- テーブルの AUTO_INCREMENT `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- テーブルの AUTO_INCREMENT `manual`
--
ALTER TABLE `manual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
