# Sistema GLP - MVC (formato tipo WinRAR/flat)

Estructura MVC plana:
- core/: Router, Controller, Database
- controllers/: Controladores
- models/: Modelos (PDO)
- views/: Vistas (PHP)
- public/: Front Controller
- config/: Configuración
- database/: Migraciones y Seeders
- assets/: CSS/JS

## Inicialización
1. Crear BD:
   CREATE DATABASE glp_nueva_esperanza CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
2. Configurar `config/config.php`.
3. Migrar:  php database/migrate.php
4. Seed:    php database/seed.php
5. Levantar: php -S 127.0.0.1:8080 -t public
