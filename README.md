Pedidos Lumen

Sistema de gestión de pedidos desarrollado con Laravel 12 + Livewire + MySQL, utilizando buenas prácticas de control de versiones, CI/CD y arquitectura limpia. Proyecto realizado como parte del Trabajo Final Integrador de Metodología de Sistemas II – UTN.

📝 Descripción

Pedidos Lumen es un sistema para gestionar pedidos, productos, proveedores y estados del flujo comercial.
Está desarrollado con Laravel 12 y Livewire, integrando:

CRUD de pedidos

Manejo de stock

Vistas dinámicas con Livewire

Validaciones del lado del servidor

Seguridad con CSRF, middleware y .env

Estrategia de ramas profesional (backend/frontend)

Mirror automático GitHub → GitLab con CI/CD

🛠 Tecnologías utilizadas

PHP 8

Laravel 12

Livewire 

MySQL (XAMPP)

Composer

Node.js + Vite

GitHub Actions (CI/CD)

Git / Git Flow simplificado


⚙️ Instalación

Clonar el repositorio:

git clone https://github.com/milagrosgoiris/pedidos_lumen.git
cd pedidos_lumen


Instalar dependencias:

composer install
npm install

🔧 Configuración del entorno (.env)

Crear archivo .env:

cp .env.example .env


Generar clave de app:

php artisan key:generate


Configurar base de datos local:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pedidos_lumen
DB_USERNAME=root
DB_PASSWORD=


⚠️ Recordá: .env nunca se sube al repositorio.

🗄 Migraciones y base de datos

Crear base de datos:

pedidos_lumen


Ejecutar migraciones:

php artisan migrate


Opcional (si agregás seeds):

php artisan db:seed

▶ Ejecución del proyecto

Ejecutar backend:

php artisan serve


Ejecutar Vite (frontend dinámico):

npm run dev


Abrir en el navegador:
👉 http://localhost:8000

📁 Estructura del proyecto
/app
    /Http
    /Livewire
/resources
    /views
/routes
    web.php
/database
    /migrations
/public

🔄 CI/CD

Este repositorio utiliza GitHub Actions:

✔ Linter / Quality Check

Se ejecuta en cada Pull Request para garantizar integridad del código.

✔ Mirror a GitLab

Workflow: .github/workflows/gitlab-mirror.yml
Sincroniza automáticamente la rama main con el repositorio espejo en GitLab usando SSH Keys almacenadas en GitHub Secrets.

✔ Secrets

Configurados en:

GITLAB_REPO_URL

GITLAB_SSH_PRIVATE_KEY

🔐 Buenas prácticas aplicadas

Manejo seguro de secretos con .env + GitHub Secrets

CSRF Protection

Middleware auth y verified

Validaciones del lado del servidor

Eloquent ORM (prevención de SQL Injection)

Ramas separadas por funcionalidad

Commits usando Conventional Commits

Logs de Laravel activos

Dependabot y Secret Scanning activados

📚 Repositorios

Repositorio principal (GitHub):
👉 https://github.com/milagrosgoiris/pedidos_lumen

Repositorio espejo (GitLab):
👉 https://gitlab.com/milagrosgoiris42/pedidos_lumen
