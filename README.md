# Proyecto Psicoalianza

Este proyecto utiliza Laravel y SQLite como base de datos. Sigue las instrucciones a continuación para configurarlo y ejecutarlo en tu entorno local.

## Requisitos

Asegúrate de tener instalado lo siguiente:

- PHP (>= 8.0)
- Composer
- Laravel (opcional, se puede instalar globalmente)
- SQLite3

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/harryson723/psicoalianzaTest.git
   cd psicoalianzaTest
   ```

2. Instala las dependencias:
   ```bash
   composer install
   ```

3. Copia el archivo de configuración `.env.example` y renómbralo como `.env`:
   ```bash
   cp .env.example .env
   ```

4. Configura la base de datos en el archivo `.env`:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=/absolute/path/to/database.sqlite
   ```
   O si deseas que la base de datos esté en la carpeta `database` del proyecto:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

5. Crea el archivo de base de datos SQLite (opcional):
   ```bash
   touch database/database.sqlite
   ```

6. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```

7. Ejecuta las migraciones para generar las tablas:
   ```bash
   php artisan migrate
   ```

## Ejecución

Para iniciar el servidor de desarrollo, usa el siguiente comando:
```bash
php artisan serve
```
Esto iniciará el servidor en `http://127.0.0.1:8000/`.