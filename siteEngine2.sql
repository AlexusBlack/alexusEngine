-- phpMyAdmin SQL Dump
-- version 3.3.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 03 2013 г., 15:08
-- Версия сервера: 5.1.49
-- Версия PHP: 5.3.3-1ubuntu9.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `siteEngine2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `category`) VALUES
(1, 'main', -1),
(4, 'blog', -1),
(5, 'soft', -1),
(6, 'news', -1);

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`id`, `name`, `content`) VALUES
(1, 'main', '[{"sort":1,"text":"Ð“Ð»Ð°Ð²Ð½Ð°Ñ","src":"/siteEngine2/"},{"sort":2,"text":"Ð‘Ð»Ð¾Ð³","src":"/siteEngine2/blog"},{"sort":3,"text":"Ð¡Ð¾Ñ„Ñ‚","src":"/siteEngine2/soft"},{"sort":4,"text":"ÐšÐ¾Ð½Ñ‚Ð°ÐºÑ‚Ñ‹","src":"/siteEngine2/contacts"}]');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` text COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `small_content` text COLLATE utf8_unicode_ci NOT NULL,
  `big_content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `path`, `category`, `title`, `keywords`, `description`, `small_content`, `big_content`) VALUES
(1, 'main', 1, '%D0%93%D0%BB%D0%B0%D0%B2%D0%BD%D0%B0%D1%8F', '%D0%B2%D1%81%D1%8F%D0%BA%D0%B8%D0%B5+%D0%BA%D0%BB%D1%8E%D1%87%D0%B5%D0%B2%D0%B8%D0%BA%D0%B8', '%D0%BF%D1%80%D0%BE%D0%B1%D0%BD%D0%BE%D0%B5+%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5', '', '%3Cdiv%3E%0A%3Ch3%3E%D0%97%D0%B0%D0%B3%D0%BE%D0%BB%D0%BE%D0%B2%D0%BE%D0%BA%3C%2Fh3%3E%0A%D0%A2%D0%B5%D0%BA%D1%81%D1%82+%D0%B4%D0%BB%D1%8F+%D0%B3%D0%BB%D0%B0%D0%B2%D0%BD%D0%BE%D0%B9+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D1%8B%0A%3C%2Fdiv%3E%0A%5BCOMPONENT%3ApageList%7Cdefault%7C%7B%22category%22%3A%22news%22%2C%22sort%22%3A%22DESC%22%2C%22parseImage%22%3A%22true%22%7D%5D%3Cbr%3E%3Cbr%3E%0A%5BCOMPONENT%3Aform%7Cdefault%7C%7B%22handler%22%3A%22Mail%22%2C%22handler_params%22%3A%7B%22to%22%3A%22alexusblack%40gmail.com%22%2C%22mailTemplate%22%3A%22default%22%7D%7D%5D'),
(6, 'blog', 1, '%D0%91%D0%BB%D0%BE%D0%B3', '%D0%9D%D0%BE%D0%B2%D1%8B%D0%B5+%D0%BA%D0%BB%D1%8E%D1%87%D0%B5%D0%B2%D1%8B%D0%B5+%D1%81%D0%BB%D0%BE%D0%B2%D0%B0', '%D0%9D%D0%BE%D0%B2%D0%BE%D0%B5+%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5', '%D0%9A%D1%80%D0%B0%D1%82%D0%BA%D0%B8%D0%B9+%D1%82%D0%B5%D0%BA%D1%81%D1%82+%D0%BD%D0%BE%D0%B2%D0%BE%D0%B9+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D1%8B', '%D0%A2%D1%83%D1%82+%D1%82%D0%B5%D0%BA%D1%81%D1%82+%D0%B8+%D0%B2%D1%8B%D0%B2%D0%BE%D0%B4+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86+%D0%B8%D0%B7+%D0%BA%D0%B0%D1%82%D0%B5%D0%B3%D0%BE%D1%80%D0%B8%D0%B8+%D0%B1%D0%BB%D0%BE%D0%B3%3Cbr%3E'),
(7, 'soft', 1, '%D0%A1%D0%BE%D1%84%D1%82', '%D0%9D%D0%BE%D0%B2%D1%8B%D0%B5+%D0%BA%D0%BB%D1%8E%D1%87%D0%B5%D0%B2%D1%8B%D0%B5+%D1%81%D0%BB%D0%BE%D0%B2%D0%B0', '%D0%9D%D0%BE%D0%B2%D0%BE%D0%B5+%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5', '%D0%9A%D1%80%D0%B0%D1%82%D0%BA%D0%B8%D0%B9+%D1%82%D0%B5%D0%BA%D1%81%D1%82+%D0%BD%D0%BE%D0%B2%D0%BE%D0%B9+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D1%8B', '%D1%82%D1%83%D1%82+%D1%82%D0%B5%D0%BA%D1%81%D1%82+%D0%B8+%D0%B2%D1%8B%D0%B2%D0%BE%D0%B4+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86+%D0%B8%D0%B7+%D0%BA%D0%B0%D1%82%D0%B5%D0%B3%D0%BE%D1%80%D0%B8%D0%B8+%D1%81%D0%BE%D1%84%D1%82%3Cbr%3E'),
(8, 'contacts', 1, '%D0%9A%D0%BE%D0%BD%D1%82%D0%B0%D0%BA%D1%82%D1%8B', '%D0%9D%D0%BE%D0%B2%D1%8B%D0%B5+%D0%BA%D0%BB%D1%8E%D1%87%D0%B5%D0%B2%D1%8B%D0%B5+%D1%81%D0%BB%D0%BE%D0%B2%D0%B0', '%D0%9D%D0%BE%D0%B2%D0%BE%D0%B5+%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5', '%D0%9A%D1%80%D0%B0%D1%82%D0%BA%D0%B8%D0%B9+%D1%82%D0%B5%D0%BA%D1%81%D1%82+%D0%BD%D0%BE%D0%B2%D0%BE%D0%B9+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D1%8B%3Cbr%3E%3Cimg+src%3D%22http%3A%2F%2Fa-l-e-x-u-s.ru%2Fimg%2Flogo.jpg%22%3E', '%D0%A2%D1%83%D1%82+%D0%BA%D0%BE%D0%BD%D1%82%D0%BA%D1%82%D0%BD%D0%B0%D1%8F+%D0%B8%D0%BD%D1%84%D0%BE%D1%80%D0%BC%D0%B0%D1%86%D0%B8%D1%8F+%D0%B8+%D1%84%D0%BE%D1%80%D0%BC%D0%B0+%D1%81%D0%B2%D1%8F%D0%B7%D0%B8%3Cbr%3E'),
(9, 'new_site', 6, '%D0%9E%D0%B1%D0%BD%D0%BE%D0%B2%D0%BB%D0%B5%D0%BD%D0%B8%D0%B5+%D1%81%D0%B0%D0%B9%D1%82%D0%B0', '%D0%9D%D0%BE%D0%B2%D1%8B%D0%B5+%D0%BA%D0%BB%D1%8E%D1%87%D0%B5%D0%B2%D1%8B%D0%B5+%D1%81%D0%BB%D0%BE%D0%B2%D0%B0', '%D0%9D%D0%BE%D0%B2%D0%BE%D0%B5+%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5', '%D0%9A%D1%80%D0%B0%D1%82%D0%BA%D0%B8%D0%B9+%D1%82%D0%B5%D0%BA%D1%81%D1%82+%D0%BD%D0%BE%D0%B2%D0%BE%D0%B9+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D1%8B%3Cbr%3E%3Cimg+src%3D%22http%3A%2F%2Fa-l-e-x-u-s.ru%2FsiteEngine2%2Fupload%2FThe_Yes_Guy.png%22%3E', '%D0%9F%D0%BE%D0%B4%D1%80%D0%BE%D0%B1%D0%BD%D0%B0%D1%8F+%D0%B8%D0%BD%D1%84%D0%BE%D1%80%D0%BC%D0%B0%D1%86%D0%B8%D1%8F+%D0%BE%D0%B1+%D0%BE%D0%B1%D0%BD%D0%BE%D0%B2%D0%BB%D0%B5%D0%BD%D0%B8%D0%B8+%D1%81%D0%B0%D0%B9%D1%82%D0%B0'),
(10, 'test_news', 6, '%D0%97%D0%B0%D0%B3%D0%BE%D0%BB%D0%BE%D0%B2%D0%BE%D0%BA+%D0%BD%D0%BE%D0%B2%D0%BE%D0%B9+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D1%8B', '%D0%9D%D0%BE%D0%B2%D1%8B%D0%B5+%D0%BA%D0%BB%D1%8E%D1%87%D0%B5%D0%B2%D1%8B%D0%B5+%D1%81%D0%BB%D0%BE%D0%B2%D0%B0', '%D0%9D%D0%BE%D0%B2%D0%BE%D0%B5+%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5', '%D0%9A%D1%80%D0%B0%D1%82%D0%BA%D0%B8%D0%B9+%D1%82%D0%B5%D0%BA%D1%81%D1%82+%D0%BD%D0%BE%D0%B2%D0%BE%D0%B9+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D1%8B', '%D0%91%D0%BE%D0%BB%D1%8C%D1%88%D0%BE%D0%B9+%D1%82%D0%B5%D0%BA%D1%81%D1%82+%D0%BD%D0%BE%D0%B2%D0%BE%D0%B9+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D1%8B'),
(11, '404', 1, '404+-+%D0%A1%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D0%B0+%D0%BD%D0%B5+%D0%BD%D0%B0%D0%B9%D0%B4%D0%B5%D0%BD%D0%B0', '%D0%9D%D0%BE%D0%B2%D1%8B%D0%B5+%D0%BA%D0%BB%D1%8E%D1%87%D0%B5%D0%B2%D1%8B%D0%B5+%D1%81%D0%BB%D0%BE%D0%B2%D0%B0', '%D0%9D%D0%BE%D0%B2%D0%BE%D0%B5+%D0%BE%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5', '%D0%9A%D1%80%D0%B0%D1%82%D0%BA%D0%B8%D0%B9+%D1%82%D0%B5%D0%BA%D1%81%D1%82+%D0%BD%D0%BE%D0%B2%D0%BE%D0%B9+%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D1%8B', '%D0%A1%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D0%B0+%D0%BD%D0%B5+%D0%BD%D0%B0%D0%B9%D0%B4%D0%B5%D0%BD%D0%B0%3Cbr%3E');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`name`, `value`) VALUES
('template', 'alexus'),
('defaultPage', 'main'),
('postfix', '');
