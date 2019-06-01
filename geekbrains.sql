-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 31 2019 г., 02:23
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
  `price` int(11) NOT NULL DEFAULT '0' COMMENT 'Цена товара',
  `hide` tinyint(1) NOT NULL COMMENT 'скрыть товар'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `description`, `price`, `hide`) VALUES
(1, 'Boots', 'Sport shoes', 120, 0),
(2, 'Sneakers', 'Sport shoes', 300, 0),
(3, 'Кеды Сп', 'Кеды спортивные', 230, 0),
(4, 'Кеды', 'Кеды беговые', 260, 0),
(5, 'Сапоги', 'Сапоги летние модные', 80, 1),
(6, 'Тапки', 'Тапочки домашние', 55, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('Принят','В работе','Выполнен','Отменен') NOT NULL DEFAULT 'Принят' COMMENT 'статус заказа',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text,
  `order_items` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `date`, `comment`, `order_items`) VALUES
(4, 5, 'Выполнен', '2019-05-28 22:29:39', 'Адрес', '{\"2\":{\"price\":\"300\",\"name\":\"Sneakers\",\"count\":1}}'),
(5, 3, 'В работе', '2019-05-28 22:51:55', 'Домашний', '{\"1\":{\"price\":\"120\",\"name\":\"Boots\",\"count\":1}}'),
(6, 3, 'Выполнен', '2019-05-28 22:57:03', 'Адрес', '{\"3\":{\"price\":\"230\",\"name\":\"Кеды\",\"count\":2}}'),
(7, 5, 'В работе', '2019-05-30 23:42:11', 'Новый адрес', '{\"4\":{\"price\":\"260\",\"name\":\"Кеды\",\"count\":2},\"6\":{\"price\":\"55\",\"name\":\"Тапки\",\"count\":3}}'),
(8, 1, 'Принят', '2019-05-31 00:07:39', 'Адрес', '{\"4\":{\"price\":\"260\",\"name\":\"Кеды\",\"count\":1}}');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL COMMENT 'индекс',
  `name` varchar(50) NOT NULL DEFAULT 'anonimus' COMMENT 'имя пользователя',
  `text` text NOT NULL COMMENT 'текст отзыва',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'время отзыва'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `text`, `date`) VALUES
(1, 'Andrey', 'OK', '2019-05-20 23:30:12'),
(2, 'Ivan', 'Very good!', '2019-05-20 23:30:33'),
(3, 'Joe', 'Very bad!', '2019-05-20 23:37:50'),
(4, 'Андрей', 'Это отзыв на русском!', '2019-05-30 19:42:14');

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
  `is_admin` tinyint(1) NOT NULL COMMENT 'роль администратора'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `login`, `password`, `date`, `is_admin`) VALUES
(1, 'КЕнТ ро Пист', 'admin', 'f8a8075d7c724f18ddf01867a86366b1', '2019-05-14 17:39:12', 1),
(2, 'Alex Pro', 'Alex', 'd41a2e876cd74bb324b0e15380beae79', '2019-05-14 17:41:15', 0),
(3, 'Admin', 'admin32', 'd41a2e876cd74bb324b0e15380beae79', '2019-05-15 17:43:09', 0),
(5, 'Борман П.Г.', 'borman', 'd41a2e876cd74bb324b0e15380beae79', '2019-05-17 17:39:38', 0),
(23, 'anonim', 'Ivan', '61cb96405f2d8fcf6cc8d5b948e1d906', '2019-05-20 23:51:37', 0),
(24, 'Иванов Иван Иванович', 'ivanov', 'a424506f9ffc2d95ab2d90f0b23f27a3', '2019-05-30 18:13:29', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'индекс', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'индекс', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
