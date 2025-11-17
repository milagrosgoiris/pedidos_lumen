# 🛒 Pedidos Lumen
**Sistema de gestión de pedidos, stock y proveedores para negocios con múltiples locales.**

Pedidos Lumen es un sistema web desarrollado en **Laravel 12 + Livewire**, diseñado para centralizar pedidos, controlar el stock en tiempo real y mejorar la comunicación entre empleados, encargados y gerentes.  
El proyecto forma parte del **Trabajo Final Integrador – UTN**.

---

## 📌 Objetivos del sistema
- Centralizar y organizar los pedidos por local.
- Mantener el stock actualizado en tiempo real.
- Reducir faltantes y mejorar la toma de decisiones.
- Registrar productos, marcas, proveedores y movimientos.
- Brindar a los encargados una herramienta clara y rápida.
- Proveer al gerente un dashboard general con métricas.

---

## 🏗️ Tecnologías utilizadas
- **Laravel 12**
- **Livewire 3**
- **Blade**
- **MySQL**
- **TailwindCSS**
- **XAMPP**
- **PHP 8.2**
- **GitHub + GitLab CI/CD**

---

## 🔐 Roles del sistema
- **Administrador** → controla todo  
- **Gerente** → dashboard general, stock crítico, pedidos  
- **Encargado/Empleado** → carga pedidos, adjunta imágenes, controla stock

---

## 📦 Funcionalidades principales (CRUD)
### 🧾 CRUDs base
- CRUD de Proveedores  
- CRUD de Marcas  
- CRUD de Productos  
- CRUD de Locales  
- CRUD de Usuarios (roles/permisos)

### 🛒 Pedidos
- Crear pedidos con productos
- Editar productos del pedido
- Adjuntar imágenes (remitos, fotos)
- Cambiar estado del pedido (pendiente, enviado, recibido)
- Comentarios internos
- Historial

### 📦 Stock
- Control de stock por local
- Movimientos de stock
- Alerta de stock crítico
- Reportes

### 📊 Dashboard (Gerente)
- Pedidos pendientes / completados
- Productos más pedidos
- Stock crítico
- Proveedores más utilizados

---

## 🔄 Flujo de trabajo (Git)
El repositorio principal está alojado en **GitHub**.  
GitLab se utiliza como **espejo automático** y para:

- CI/CD
- Calidad de código
- Métricas
- Tablero ágil (híbrido Kanban)

✔️ Cada push en GitHub actualiza automáticamente GitLab.

---

## 🧪 CI/CD (GitLab)
Pipeline configurado con:

- Lint (PHP CS Fixer)
- Unit tests (Pest/PHPUnit)
- Code Quality
- SAST
- Build & Deploy (opcional)

Archivos clave:
- `.gitlab-ci.yml`
- `phpunit.xml`

---

## 📐 Modelo de datos (ER)
Incluye:

- Proveedores
- Marcas
- Productos
- Usuarios
- Locales
- Roles
- Pedidos
- PedidoItems
- Stock

*(Ver carpeta `/docs/modelo-datos`)*

---

## 👩‍💻 Autora
**Milagros Goiris**  
Técnica Universitaria en Desarrollo de Software – UTN  

---


