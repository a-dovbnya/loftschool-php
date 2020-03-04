-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 04 2020 г., 22:42
-- Версия сервера: 5.6.43
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `burger`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `payment` varchar(150) NOT NULL,
  `not_call` int(11) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `comment`, `payment`, `not_call`, `date`) VALUES
(31, 22, 'Улица Радищева, дом № 12, корпус 2, квартира 12, этаж 4', 'Как можно скорее!', 'Оплата по карте', 1, '04.03.2020'),
(32, 23, 'Улица Ленина, дом № 12, корпус 2, квартира 4, ', '', 'Потребуется сдача', 1, '04.03.2020'),
(33, 23, 'Улица Ленина, дом № 12, корпус 2, квартира 4, ', '', 'Потребуется сдача', 1, '04.03.2020'),
(34, 24, 'Улица Толстого, дом № 2, корпус 2, квартира 2', '', '', 0, '04.03.2020'),
(35, 25, 'Улица Зегеля, дом № 2, квартира 2', '', '', 0, '04.03.2020'),
(36, 26, 'Улица Фрунзе, дом № 2, квартира 2', 'Скорее!', '', 0, '04.03.2020'),
(37, 27, 'Улица Радищева, дом № 2, квартира 2, этаж 3', '', '', 0, '04.03.2020'),
(38, 27, 'Улица Ленина, дом № 2, квартира 2, этаж 3', 'Комментарий', 'Потребуется сдача', 0, '04.03.2020');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`) VALUES
(22, 'Василий', 'vasya1990@mail.ru', '+7 (905) 555 55 55'),
(23, 'Иван', 'vanya@yandex.ru', '+7 (904) 232 32 32'),
(24, 'Саша', 'sasha12@yandex.ru', '+7 (908) 565 65 65'),
(25, 'Толик', 'tolyan22@mail.ru', '+7 (905) 656 56 56'),
(26, 'Сергей', 'serg999@yandex.ru', '+7 (903) 545 44 54'),
(27, 'Алексей', 'aleksey@mail.ru', '+7 (905) 656 56 56');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
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
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
