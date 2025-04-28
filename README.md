# Laravel Proyecto

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

## Tabla de Contenidos

- [Acerca del proyecto](#acerca-del-proyecto)
- [Tecnologías utilizadas](#tecnologías-utilizadas)
- [Instalación](#instalación)
- [Uso de Docker](#uso-de-docker)
- [Aprendiendo Laravel](#aprendiendo-laravel)
- [Patrocinadores de Laravel](#patrocinadores-de-laravel)
- [Contribuciones](#contribuciones)
- [Código de Conducta](#código-de-conducta)
- [Vulnerabilidades de seguridad](#vulnerabilidades-de-seguridad)
- [Licencia](#licencia)

---

## Acerca del Proyecto

Laravel es un framework de aplicaciones web con una sintaxis expresiva y elegante.  
Su filosofía es hacer el desarrollo algo **agradable y creativo**, ayudando a facilitar tareas comunes en proyectos web, tales como:

- [Sistema de enrutamiento rápido y sencillo](https://laravel.com/docs/routing).
- [Contenedor de inyección de dependencias potente](https://laravel.com/docs/container).
- [Manejo de sesiones y caché con múltiples motores](https://laravel.com/docs/session).
- [ORM intuitivo y expresivo (Eloquent)](https://laravel.com/docs/eloquent).
- [Migraciones de base de datos independientes del motor](https://laravel.com/docs/migrations).
- [Procesamiento de trabajos en segundo plano (colas)](https://laravel.com/docs/queues).
- [Difusión de eventos en tiempo real](https://laravel.com/docs/broadcasting).

Laravel es accesible, potente, y brinda herramientas necesarias para crear aplicaciones robustas y escalables.

---

## Tecnologías utilizadas

Este proyecto utiliza:

- **PHP** `^8.2`
- **Laravel Framework** `^12.0`
- **Laravel UI** `^4.6`
- **Docker** (a través de un archivo `docker-compose.yml`)

---

## Instalación

1. Clona el repositorio:

```bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
```

2. Instala las dependencias PHP usando [Composer](https://getcomposer.org/):

```bash
composer install
```

3. Copia el archivo de entorno:

```bash
cp .env.example .env
```

4. Genera la clave de aplicación:

```bash
php artisan key:generate
```

5. Configura la conexión a la base de datos en tu archivo `.env`.

6. Ejecuta las migraciones (si aplica):

```bash
php artisan migrate
```

---

## Uso de Docker

Este proyecto incluye un archivo `docker-compose.yml` para facilitar la configuración del entorno de desarrollo.

Para levantar los contenedores:

```bash
docker-compose up -d
```

Esto configurará servicios como:

- **Servidor PHP**
- **Servidor MySQL** (o el motor que definas)
- **Servidor Nginx/Apache** (según la configuración)

Accede a la aplicación en:  
[http://localhost:8000](http://localhost:8000)

> **Nota:** Asegúrate de que los puertos definidos en `docker-compose.yml` no estén siendo utilizados por otros servicios.

---

## Aprendiendo Laravel

Laravel ofrece una extensa [documentación oficial](https://laravel.com/docs) y una excelente plataforma de tutoriales en video en [Laracasts](https://laracasts.com).

También puedes iniciar con el [Laravel Bootcamp](https://bootcamp.laravel.com), donde aprenderás a construir una aplicación moderna paso a paso.

---

## Patrocinadores de Laravel

Queremos agradecer a los siguientes patrocinadores por apoyar el desarrollo de Laravel:

- [Vehikl](https://vehikl.com/)
- [Tighten Co.](https://tighten.co)
- [WebReinvent](https://webreinvent.com/)
- [Kirschbaum Development Group](https://kirschbaumdevelopment.com)
- [64 Robots](https://64robots.com)
- [Curotec](https://www.curotec.com/services/technologies/laravel/)
- [Cyber-Duck](https://cyber-duck.co.uk)
- [DevSquad](https://devsquad.com/hire-laravel-developers)
- [Jump24](https://jump24.co.uk)
- [Redberry](https://redberry.international/laravel/)
- [Active Logic](https://activelogic.com)
- [byte5](https://byte5.de)
- [OP.GG](https://op.gg)

Si deseas ser patrocinador, visita el [programa de socios de Laravel](https://partners.laravel.com).

---

## Contribuciones

¡Gracias por considerar contribuir a Laravel!  
Puedes encontrar la guía de contribución en la [documentación oficial](https://laravel.com/docs/contributions).

---

## Código de Conducta

Laravel se esfuerza por mantener una comunidad inclusiva y acogedora.  
Por favor revisa y respeta el [Código de Conducta](https://laravel.com/docs/contributions#code-of-conduct).

---

## Vulnerabilidades de Seguridad

Si encuentras una vulnerabilidad de seguridad en Laravel, por favor comunícalo enviando un correo electrónico a [Taylor Otwell](mailto:taylor@laravel.com).  
Todas las vulnerabilidades serán tratadas con la máxima seriedad.

---

## Licencia

El framework Laravel es un software de código abierto licenciado bajo la [licencia MIT](https://opensource.org/licenses/MIT).
