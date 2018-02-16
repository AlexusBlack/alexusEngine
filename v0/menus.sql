-- phpMyAdmin SQL Dump
-- version 3.3.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 24 2013 г., 19:36
-- Версия сервера: 5.1.49
-- Версия PHP: 5.3.3-1ubuntu9.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `siteEngine`
--

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`id`, `name`, `content`) VALUES
(1, 'main', '[{"sort":"1","text":"\\u0413\\u043b\\u0430\\u0432\\u043d\\u0430\\u044f","src":"\\/siteEngine\\/"},{"sort":"2","text":"\\u041e \\u043a\\u043e\\u043c\\u043f\\u0430\\u043d\\u0438\\u0438","src":"\\/siteEngine\\/about"},{"sort":"3","text":"\\u041d\\u0430\\u0448\\u0438 \\u0443\\u0441\\u043b\\u0443\\u0433\\u0438","src":"\\/siteEngine\\/nashi-uslugi"},{"sort":"4","text":"\\u041e\\u0442\\u0437\\u044b\\u0432\\u044b","src":"\\/siteEngine\\/otzivi"},{"sort":"5","text":"\\u041e\\u0431\\u0440\\u0430\\u0442\\u043d\\u0430\\u044f \\u0441\\u0432\\u044f\\u0437\\u044c","src":"\\/siteEngine\\/contacts"}]'),
(3, 'LeftMenu', '[{"sort":"1","text":"\\u0414\\u043e\\u0441\\u0442\\u0430\\u0432\\u043a\\u0430\\u00a0\\u0438\\u0437\\u00a0\\u041a\\u0438\\u0442\\u0430\\u044f","src":"dostavka-iz-kitaya"},{"sort":"2","text":"\\u0422\\u043e\\u0432\\u0430\\u0440\\u044b\\u00a0\\u0438\\u0437\\u00a0\\u041a\\u0438\\u0442\\u0430\\u044f","src":"tovar-iz-kitaya"}]'),
(4, 'BottomMenu', '[{"sort":"5","text":"\\u041e\\u0431\\u0440\\u0430\\u0442\\u043d\\u0430\\u044f \\u0441\\u0432\\u044f\\u0437\\u044c","src":"contacts"},{"sort":"2","text":"\\u041e \\u043d\\u0430\\u0441","src":"about"},{"sort":"1","text":"\\u0413\\u043b\\u0430\\u0432\\u043d\\u0430\\u044f","src":""},{"sort":"4","text":"\\u0423\\u0441\\u043b\\u0443\\u0433\\u0438","src":"nashi-uslugi"},{"sort":"5","text":"\\u041e\\u0442\\u0437\\u044b\\u0432\\u044b","src":"otzivi"}]');
