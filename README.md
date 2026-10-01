# Insurance Consultant

<img width="1344" height="591" alt="image" src="https://github.com/user-attachments/assets/a9cb9623-817c-42f9-a2e6-26725b54aac5" />


Aplicación web empresarial para la gestión de operaciones relacionadas con **seguros comerciales**, desarrollada para centralizar la administración de clientes, pólizas, cotizaciones, documentos y procesos internos de una agencia de seguros.

El sistema implementa autenticación, autorización basada en roles, gestión de usuarios y diferentes funcionalidades según el perfil de acceso, utilizando una arquitectura MVC y herramientas del ecosistema Laravel.

## Tecnologías

### Backend

* PHP
* Laravel 11
* Laravel Breeze
* Spatie Laravel Permission

### Frontend

* Blade
* Tailwind CSS
* Vite
* JavaScript

### Base de datos

* MySQL

### Herramientas

* Composer
* npm
* Git
* GitHub

---

##  Características

* Autenticación de usuarios
* Verificación de correo electrónico
* Autorización basada en roles y permisos
* Gestión de usuarios
* Gestión de clientes
* Gestión de pólizas
* Gestión de certificados
* Gestión de documentos
* Formularios con validación
* Diferentes funcionalidades según el rol del usuario
* Panel administrativo
* Gestión de asesores
* Procesos específicos para operaciones de seguros
* Generación y gestión de documentos
* Interfaz responsive con Tailwind CSS

---

## Roles y permisos

El sistema implementa control de acceso mediante **roles y permisos**, utilizando Spatie Laravel Permission.

### Administrador

Cuenta con acceso a las principales funcionalidades administrativas del sistema, incluyendo la gestión de usuarios, asesores, clientes y configuraciones relacionadas con la aplicación.

### Asesor

Dispone de funcionalidades orientadas a la gestión de clientes y operaciones relacionadas con las pólizas y documentación de seguros.

### Usuario

Cuenta con acceso a las funcionalidades disponibles para clientes y usuarios registrados dentro de la plataforma.

La autorización se gestiona mediante middleware y permisos asociados a cada rol.

---

## Arquitectura

La aplicación utiliza el patrón arquitectónico **MVC (Model-View-Controller)** proporcionado por Laravel.

```

### Models

Gestionan la interacción con la base de datos y representan las principales entidades del sistema.

### Controllers

Contienen la lógica necesaria para procesar las solicitudes y coordinar las operaciones entre modelos y vistas.

### Views

Construidas con **Blade** y **Tailwind CSS**, proporcionando una interfaz responsive y organizada.

### Middleware

Se utilizan para controlar autenticación, autorización y acceso a determinadas funcionalidades.

---



## Autenticación y autorización

La autenticación está implementada utilizando **Laravel Breeze**, con personalización de los flujos de acceso requeridos por la aplicación.

El sistema incluye:

* Registro
* Inicio de sesión
* Cierre de sesión
* Verificación de correo electrónico
* Protección de rutas
* Control de acceso mediante roles
* Permisos específicos para determinadas operaciones

**Spatie Laravel Permission** se utiliza para gestionar los roles y permisos de manera estructurada.

---

##  Gestión de seguros

La aplicación permite gestionar información relacionada con las operaciones de seguros comerciales.

Entre las principales entidades gestionadas se encuentran:

```text id="s5k1qv"
Usuarios
   │
   └── Roles / Permisos

Clientes
   │
   └── Pólizas
        │
        ├── Certificados
        └── Documentos
```

El sistema permite centralizar la información necesaria para administrar estos procesos desde una única plataforma.

---

##  Validación de datos

Los formularios de la aplicación utilizan las herramientas de validación proporcionadas por Laravel para verificar la información recibida antes de procesarla.

Esto permite controlar:

* Campos obligatorios
* Formatos de datos
* Valores permitidos
* Relaciones entre registros
* Información necesaria para los procesos administrativos

---


## Deployment

La aplicación fue desplegada en un entorno de producción utilizando **Hostinger**.

### Producción

```text id="zq3v9n"
GitHub
   │
   ▼
Hostinger
   │
   ├── Laravel / PHP
   ├── Blade / Tailwind
   └── MySQL
```

La aplicación utiliza el dominio:

**insuranceconsultantapp.com**

Durante el despliegue se configuró el entorno de producción, incluyendo:

* Aplicación Laravel
* PHP
* Base de datos MySQL
* Variables de entorno
* Dependencias de Composer
* Recursos frontend compilados
* Configuración del directorio público
* Almacenamiento de archivos

Las credenciales y variables sensibles se mantienen fuera del repositorio mediante variables de entorno.

---

## Desarrollo y buenas prácticas

Durante el desarrollo se aplicaron diferentes prácticas para mantener el código organizado y facilitar su mantenimiento:

* Arquitectura MVC
* Separación de responsabilidades
* Reutilización de componentes Blade
* Middleware para autorización
* Validación de formularios
* Migraciones de base de datos
* Seeders para datos iniciales
* Control de versiones con Git
* Gestión de dependencias con Composer y npm

---

##  Capturas de pantalla


### Dashboard

<img width="1341" height="577" alt="image" src="https://github.com/user-attachments/assets/373d4b03-b9a6-42e3-9af9-dc23533643ff" />


### Gestión de clientes

<img width="1332" height="580" alt="image" src="https://github.com/user-attachments/assets/0d2cc106-917c-48b1-9995-ebc5e86f1ad9" />


---

## Estado del proyecto

Aplicación desarrollada para la gestión de procesos relacionados con seguros comerciales y como proyecto de experiencia práctica en desarrollo de aplicaciones web empresariales.

---

##  Autor

**Daniel Murillo**

Desarrollador Full Stack

* Laravel
* PHP
* React
* TypeScript
* Node.js
* Express
* PostgreSQL
* MySQL
