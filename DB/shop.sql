-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2024 a las 19:42:03
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cashorder`
--

CREATE TABLE `cashorder` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cashorder`
--

INSERT INTO `cashorder` (`id`, `username`, `date`, `completed`) VALUES
(30, 'user', '2024-11-04 13:29:14', 1),
(31, 'user', '2024-11-04 13:36:28', 1),
(32, 'user', '2024-11-04 13:37:39', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productline`
--

CREATE TABLE `productline` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_cashorder` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productline`
--

INSERT INTO `productline` (`id`, `id_product`, `id_cashorder`, `name`, `price`, `amount`) VALUES
(15, 13, 30, 'Pantalon', 20, 100),
(16, 13, 31, 'Pantalon', 20, 100),
(17, 13, 32, 'Pantalon', 20, 100),
(18, 14, 32, 'camiseta', 10, 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(20) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `stock`, `price`) VALUES
(13, 'Pantalon', 'a', 'pantalones.png', 100, 20),
(14, 'camiseta', 'b', 'camiseta.png', 57, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`username`, `password`, `type`) VALUES
('admin', 'admin', 'admin'),
('user', 'user', 'user'),
('user1', 'user1', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cashorder`
--
ALTER TABLE `cashorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cashorder_username` (`username`);

--
-- Indices de la tabla `productline`
--
ALTER TABLE `productline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productline_id_product` (`id_product`),
  ADD KEY `fk_productline_id_cashorder` (`id_cashorder`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cashorder`
--
ALTER TABLE `cashorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `productline`
--
ALTER TABLE `productline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cashorder`
--
ALTER TABLE `cashorder`
  ADD CONSTRAINT `fk_cashorder_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
