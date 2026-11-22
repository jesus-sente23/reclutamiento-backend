# Backend - Sistema de Reclutamiento

API REST desarrollada con Laravel para administrar la información del Sistema de Reclutamiento.

El backend permite gestionar vacantes, candidatos, postulaciones y entrevistas, además de proporcionar autenticación mediante Laravel Sanctum.

## Tecnologías utilizadas

- PHP
- Laravel
- Laravel Sanctum
- SQL Server
- Composer

## Requisitos previos

Para ejecutar el proyecto es necesario contar con:

- PHP compatible con la versión de Laravel utilizada.
- Composer.
- SQL Server.
- Extensiones PHP `sqlsrv` y `pdo_sqlsrv`.
- Git.
- Laragon.

## Instalación

### 1. Despues de clonar repositorio

Ingresar a la carpeta del proyecto:

```bash
cd practica_backend
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar variables de entorno

Crear el archivo `.env` utilizando como referencia `.env.example`.

Generar la clave de la aplicación:

```bash
php artisan key:generate
```

### 4. Configurar SQL Server

Crear una base de datos en SQL Server:

```sql
CREATE DATABASE reclutamiento;
```

Modificar las variables de conexión en `.env`:

```env
DB_CONNECTION=sqlsrv
DB_HOST=localhost
DB_PORT=1433
DB_DATABASE=reclutamiento
DB_USERNAME=USUARIO
DB_PASSWORD=CONTRASENA
```

Sustituir `USUARIO` y `CONTRASENA` por las credenciales locales de SQL Server.

Verificar que SQL Server esté iniciado y que las extensiones correspondientes estén habilitadas en PHP.

### 5. Ejecutar migraciones

Para crear las tablas de la base de datos:

```bash
php artisan migrate
```

### 6. Ejecutar seeders

Para cargar los catálogos y usuarios iniciales:

```bash
php artisan db:seed
```

Este comando ejecutará los seeders registrados en `DatabaseSeeder.php`.

Si algún seeder no está registrado, deberá ejecutarse individualmente mediante:

```bash
php artisan db:seed --class=NombreDelSeeder
```



La API estará disponible en:

```text
http://127.0.0.1:8000/api
```


## Funcionalidades de la API

### Autenticación

- Inicio de sesión.
- Consulta del usuario autenticado.
- Cierre de sesión.
- Protección de rutas mediante Laravel Sanctum.

### Vacantes

- Registrar vacantes.
- Consultar vacantes.
- Actualizar vacantes.
- Eliminar vacantes.
- Consultar catálogos de unidades, modalidades y estados.

### Candidatos

- Registrar candidatos.
- Consultar candidatos.
- Actualizar candidatos.
- Eliminar candidatos.

### Postulaciones

- Registrar postulaciones.
- Consultar postulaciones.
- Filtrar por vacante y estado.
- Actualizar el estado de una postulación.
- Consultar catálogos relacionados.

### Entrevistas

- Registrar entrevistas.
- Consultar entrevistas.
- Actualizar entrevistas.
- Eliminar entrevistas.
- Consultar tipos y resultados de entrevistas.

## Usuarios de prueba

Los usuarios iniciales se encuentran definidos en `UserSeeder.php`.

Es necesario ejecutar el seeder correspondiente antes de iniciar sesión.


## Verificación del funcionamiento

Después de iniciar el servidor:

1. Confirmar que Laravel responde en `http://127.0.0.1:8000`.
2. Verificar la conexión a SQL Server.
3. Comprobar que las migraciones y los seeders se ejecutaron correctamente.
4. Iniciar sesión desde el frontend.
5. Realizar operaciones de consulta, creación, actualización y eliminación.
