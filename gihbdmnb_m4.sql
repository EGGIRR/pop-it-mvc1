-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 06 2024 г., 21:23
-- Версия сервера: 8.0.29-0ubuntu0.20.04.3
-- Версия PHP: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gihbdmnb_m4`
--

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `name`, `type`) VALUES
(3, 'Отдел математических наук', 'Внутренний'),
(4, 'Отдел истории', 'Внутренний'),
(5, 'Отдел биологии', 'Внутренний'),
(6, 'Дааа', 'Внутренний'),
(7, 'Отдел', 'Обособленный'),
(8, 'Отдел физра', 'Внутренний'),
(9, 'Отдел физраы', 'Внутренний'),
(10, 'Отдел физраыф', 'Внутренний'),
(11, 'Отдел физраыфы', 'Внутренний'),
(12, 'Отдел выф', 'Внутренний');

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `fname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `patronymic` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `post_id` int NOT NULL,
  `department_id` int NOT NULL,
  `structure_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `patronymic`, `gender`, `birthdate`, `address`, `avatar`, `post_id`, `department_id`, `structure_id`) VALUES
(2, 'Алексей', 'солдатов', 'Романович', 1, '2001-05-02', 'Южка 29', '', 2, 3, 2),
(3, 'Владислав', 'Гришаненко', 'Евгеньевич', 1, '2004-08-18', 'Красноярская 51', '', 2, 4, 4),
(4, 'Игорь', 'Комисаров', 'Андреевич', 1, '1991-02-20', 'Вахта 28', '1.png', 2, 5, 3),
(5, 'dsa', 'dsa', 'dsa', 1, '2231-02-22', 'dsadsa', 'Array', 2, 3, 2),
(6, 'dsada', 'dsada', 'dsad', 1, '1111-11-11', 'dsa', 'Array', 2, 3, 2),
(7, 'dsadas', 'dasd', 'asdas', 1, '0012-12-11', 'dasasd', 'Array', 2, 3, 2),
(8, 'dsa', 'dsa', 'dsa', 1, '0132-02-23', 'dsa', 'Array', 2, 3, 2),
(9, 'dsa', 'dsa', 'dsa', 1, '0213-02-12', 'dsa', 'Array', 2, 3, 2),
(10, 'выфв', 'выф', 'выф', 2, '0011-03-22', 'выф', 'Array', 2, 3, 2),
(11, 'выф', 'выфв', 'выф', 2, '0022-02-22', 'выф', 'Array', 2, 3, 2),
(12, 'выф', 'выф', 'выф', 2, '0022-02-22', 'вф', 'Array', 2, 3, 2),
(13, 'выф', 'выф', 'выф', 2, '0021-02-22', 'выф', 'images/211.png', 2, 3, 2),
(14, 'выфв', 'выф', 'выф', 2, '0002-02-22', 'выф', 'images/321312.png', 2, 3, 2),
(15, 'выфвыф', 'выфвыф', 'выфв', 2, '0021-12-31', 'выфвыф', 'images/321312.png', 2, 3, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `name`) VALUES
(2, 'Учёный'),
(3, 'Да');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Сотрудник О.К.'),
(2, 'Администратор');

-- --------------------------------------------------------

--
-- Структура таблицы `structures`
--

CREATE TABLE `structures` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `structures`
--

INSERT INTO `structures` (`id`, `name`) VALUES
(2, 'Математика'),
(3, 'Биология'),
(4, 'История'),
(5, 'Да'),
(6, 'Математика'),
(7, 'Математика'),
(8, 'Математика');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `role_id`, `token`) VALUES
(6, 'Владислав', 'eggirr', '202cb962ac59075b964b07152d234b70', 2, ''),
(11, 'Влад', 'vlad', '202cb962ac59075b964b07152d234b70', 1, ''),
(12, 'Ada', 'ada', '202cb962ac59075b964b07152d234b70', 2, ''),
(13, 'qwe', 'qwe', '202cb962ac59075b964b07152d234b70', 2, ''),
(14, 'Владик', 'vladik', '202cb962ac59075b964b07152d234b70', 2, ''),
(15, 'Да', 'eji', '202cb962ac59075b964b07152d234b70', 1, ''),
(23, 'Владислав', 'eggi', '202cb962ac59075b964b07152d234b70', 2, NULL),
(24, 'Владислав', 'eggi2', '202cb962ac59075b964b07152d234b70', 2, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `structure_id` (`structure_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `structures`
--
ALTER TABLE `structures`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `role_id` (`role_id`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `structures`
--
ALTER TABLE `structures`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
