-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 21 2020 г., 15:49
-- Версия сервера: 5.7.28
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `market`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `sort_order`, `status`) VALUES
(1, 'ELECTRONICS', 1, 1),
(2, 'CLOTHES', 1, 1),
(3, 'FOODS AND BEVERAGES', 1, 1),
(4, 'HEALTH & BEAUTY\r\n', 1, 1),
(5, 'SPORTS & LEISURE', 1, 1),
(6, 'BOOKS & ENTERTAINMENTS2', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `availability` int(11) NOT NULL,
  `is_featured` int(11) NOT NULL,
  `is_new` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `code`, `brand`, `price`, `title`, `description`, `category_id`, `sub_category_id`, `availability`, `is_featured`, `is_new`, `image`, `status`) VALUES
(1, 'Iphone 7', '34561', 'Apple', 500, NULL, 'Just Apple Phone', 1, 1, 1, 1, 1, NULL, 1),
(2, 'Samsung S8', '23411', 'Samsung', 700, NULL, 'Samsung is the best', 1, 1, 1, 1, 1, NULL, 1),
(3, 'LG', '178375', 'LG', 565, NULL, 'LG is okey', 1, 1, 1, 1, 1, NULL, 1),
(4, 'Rasper', '28341', 'Rasper', 1000, NULL, 'Rasper is inovation in the world', 1, 1, 1, 1, 1, NULL, 1),
(5, 'Lenovo R33', '234141', 'Lenovo', 145, NULL, 'Lenovo', 1, 1, 1, 1, 0, NULL, 1),
(6, 'Fly A38', '32424', 'Fly', 180, NULL, 'Fly', 1, 1, 1, 1, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

DROP TABLE IF EXISTS `product_order`;
CREATE TABLE IF NOT EXISTS `product_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`id`, `user_name`, `user_phone`, `user_comment`, `user_id`, `date`, `products`, `status`) VALUES
(1, 'John', '38035828858', 'Call me.', 0, '2020-05-18 15:25:17', '{\"52\":3,\"51\":1}', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `sort_order`, `category_id`, `status`) VALUES
(1, 'Mobile Phone', 1, 1, 1),
(2, 'Computers, Tablets & Laptop', 1, 1, 1),
(3, 'Cameras', 1, 1, 1),
(4, 'Sound & Vision', 1, 1, 1),
(5, 'Women\'s Clothing', 1, 2, 1),
(6, 'Women\'s Shoes', 1, 2, 1),
(7, 'Women\'s Hand Bags', 1, 2, 1),
(8, 'Men\'s Clothing', 1, 2, 1),
(9, 'Men\'s Shoes', 1, 2, 1),
(10, 'Kids Clothing', 1, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth` varchar(55) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postcode` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `additional_info` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `birth`, `company`, `address`, `city`, `state`, `postcode`, `country`, `additional_info`, `phone`, `date`, `status`, `role`) VALUES
(1, 'rosy', 'last', 'rosy@gma.co', '123456', '', 'Rosy', 'street 222', 'New York', 'Alsa', 2858285, 'USA', 'Addon', '322222355235', '2020-05-14 09:05:42', 1, 'admin'),
(2, 'Rop', 'Loco', 'loco@mga.com', '123456', '2008-01-12', 'Cop', 'street 282', 'San Diego', '[\"5\"]', 18385, '[\"1\"]', 'Additional information', '123456789123', '2020-05-14 12:38:02', 1, NULL),
(3, 'Test', 'Test', 'test@gmail.com', '123456', '2011-11-11', 'Test', 'test', 'Test', '[\"1\"]', 1341516, '[\"1\"]', 'test', '12345678912', '2020-05-14 14:49:46', 1, NULL),
(4, 'Rony', 'Locky', 'rony@gma.com', '123456', '2012-12-12', 'Rony', 'street 211', 'New York', '[\"1\"]', 1315151, '[\"1\"]', 'TEST', '123456789121', '2020-05-14 14:51:56', 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;