-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 21 2019 г., 02:05
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `geekbrains`
--

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL COMMENT 'индекс',
  `name` varchar(100) NOT NULL DEFAULT 'noname' COMMENT 'наименование товара',
  `description` text NOT NULL COMMENT 'описание товара',
  `image` varchar(255) NOT NULL COMMENT 'ссылка на изображение товара'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `description`, `image`) VALUES
(1, 'Boots', 'Sport shoes', ''),
(2, 'Sneakers', 'Sport shoes', '');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL COMMENT 'индекс',
  `url` varchar(255) NOT NULL DEFAULT '#' COMMENT 'адрес на сервере',
  `name` varchar(255) NOT NULL DEFAULT 'noname' COMMENT 'имя изображения',
  `click_count` int(10) NOT NULL DEFAULT '0' COMMENT 'количество просмотров'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `url`, `name`, `click_count`) VALUES
(1, 'img/week1_700.jpg', 'best photo of the week 1', 0),
(2, 'img/week2_700.jpg', 'best photo of the week 2', 1),
(3, 'img/week3_700.jpg', 'best photo of the week 3', 7),
(4, 'img/week4_700.jpg', 'best photo of the week 4', 3),
(5, 'img/week5_700.jpg', 'best photo of the week 5', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL COMMENT 'индекс',
  `name` varchar(50) NOT NULL DEFAULT 'anonimus' COMMENT 'имя пользователя',
  `text` text NOT NULL COMMENT 'текст отзыва',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'время отзыва'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `text`, `date`) VALUES
(1, 'Andrey', 'OK', '2019-05-20 23:30:12'),
(2, 'Ivan', 'Very good!', '2019-05-20 23:30:33'),
(3, 'Joe', 'Very bad!', '2019-05-20 23:37:50');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fio` varchar(50) DEFAULT 'anonim',
  `login` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата первой регистрации',
  `count` int(11) NOT NULL DEFAULT '0' COMMENT 'Количество просмотров'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `login`, `password`, `date`, `count`) VALUES
(1, 'КЕнТ ро Пист', 'admin1', 'admin21', '2019-05-14 17:39:12', 2),
(2, 'Alex Pro', 'Alex', 'admin', '2019-05-14 17:41:15', 0),
(3, 'Admin', 'admin1', 'admin1', '2019-05-15 17:43:09', 0),
(4, NULL, 'admin', '123', '2019-05-17 17:37:40', 0),
(5, NULL, 'qqwe', '123', '2019-05-17 17:39:38', 0),
(6, 'anonim', 'qqwe', '123', '2019-05-17 17:40:19', 0),
(7, 'anonim', 'qqwe', '123', '2019-05-17 17:40:36', 0),
(12, 'anonim', 'asd', '123', '2019-05-17 17:44:02', 0),
(13, 'anonim', '123', '123', '2019-05-17 17:44:11', 0),
(14, 'anonim', '111111', '2222222', '2019-05-17 17:44:25', 0),
(15, 'anonim', '124', '124', '2019-05-17 17:46:06', 0),
(16, 'anonim', '124', '124', '2019-05-17 17:46:28', 0),
(17, 'anonim', '124', '111', '2019-05-17 17:46:54', 0),
(22, 'anonim', 'user Max', '123456', '2019-05-20 21:15:19', 0),
(23, 'anonim', 'Ivan', '34234', '2019-05-20 23:51:37', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'индекс', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'индекс', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'индекс', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
