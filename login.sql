-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2024 a las 22:42:03
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
-- Base de datos: `login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`) VALUES
(4, 'Coctel de camaron', 'Este cóctel de camarones pacotilla, es ideal para esta temporada de calor', 198.00, 'https://media.discordapp.net/attachments/913864200110104589/1240748892773941351/31115.png?ex=66490274&is=6647b0f4&hm=cea9f785c21baa89ea0cbe0041cde7acea948a80a7b6e381869dd8f0bc5b5bab&=&format=webp&quality=lossless&width=473&height=473'),
(5, 'Langosta asada rellena', 'Deliciosa Langosta asada rellena', 399.00, 'https://media.discordapp.net/attachments/913864200110104589/1240773725268475914/Langosta-a-la-parrilla-para-catering-Madrid.png?ex=6647c814&is=66467694&hm=e63f00dfd8553120be8aee5a0d4961dc3579eee0abef0dc92d82c4789715682c&=&format=webp&quality=lossless&widt'),
(7, 'Caldo de Mariscos', 'Exquisito caldo de mariscos tradicional del estado de Veracruz; Camarón, pescado y otros', 455.00, 'https://media.discordapp.net/attachments/913864200110104589/1240774218900308069/caldo-de-mariscos.png?ex=6647c88a&is=6646770a&hm=9a8b43c03ff0ffb87a3512f77f7f62370c02df951b40df7ff4220057c6b2a8fd&=&format=webp&quality=lossless'),
(8, 'Caldo de Pescado con Verduras', 'Pescado bagre en postas, suavecito y cocinado a la perfección en caldo de jitomate, chiles guajillo y chipotle, y verduras.', 115.00, 'https://media.discordapp.net/attachments/913864200110104589/1240776326646988861/maxresdefault.png?ex=6647ca80&is=66467900&hm=9ee77e8e6798bfc2b4976a2fee4e1d4fce778d188d3dd40d1308eeb3f70d1acd&=&format=webp&quality=lossless&width=1202&height=676'),
(9, 'Pulpo a la parrilla', 'Delicioso Pulpo a la parrilla', 132.00, 'https://media.discordapp.net/attachments/913864200110104589/1240778282039775343/PULPO-A-LA-PARRILLA.png?ex=6647cc52&is=66467ad2&hm=a8ced9e44dabbea4533b438ace801bd9f1225f628bf0bb6e2d947e8ad4f48b41&=&format=webp&quality=lossless&width=530&height=350');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('admin','usuario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasena`, `rol`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'usuario', '401cec94d3ed586d8cb895c10c0f7db6', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
