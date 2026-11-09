# Sistema de Registro de Estudiantes

Proyecto desarrollado para la Actividad Integradora 3 de Diseño Web de ECOTEC.

## Descripción

Aplicación web dinámica para registrar y consultar estudiantes mediante PHP, PDO y MySQL.

## Tecnologías utilizadas

- PHP 8
- MySQL / MariaDB
- PDO
- HTML5
- CSS3
- Git y GitHub

## Estructura del proyecto

- `conexion.php`: conexión segura con la base de datos.
- `index.php`: formulario de registro de estudiantes.
- `estudiantes.php`: consulta de estudiantes registrados.
- `database/db_sistema_web.sql`: estructura de la base de datos.

## Requisitos

- XAMPP
- PHP 8 o superior
- MySQL o MariaDB
- Navegador web

## Instalación

1. Copiar la carpeta `sistema_estudiantes` dentro de `htdocs` de XAMPP.
2. Iniciar Apache y MySQL desde XAMPP.
3. Abrir phpMyAdmin en `http://localhost/phpmyadmin`.
4. Importar el archivo `database/db_sistema_web.sql`.
5. Verificar las credenciales de conexión en `conexion.php`.
6. Abrir `http://localhost/sistema_estudiantes/index.php`.

## Seguridad implementada

- Consultas preparadas con PDO.
- Validación de datos del formulario.
- Manejo de errores mediante try-catch.
- Protección contra XSS mediante htmlspecialchars().
- Uso de archivo independiente para la conexión.

## Autor

Thiago André Coronel Rodas