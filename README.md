# Galápagos - Sistema de Gestión de Salidas de Barcos

Sistema de gestión de salidas de barcos turísticos en Galápagos. Compuesto por tres partes interconectadas:

| Parte | Descripción |
|-------|-------------|
| **Panel Administrador** | Laravel 11 + Blade + autenticación por sesión |
| **API REST Pública** | Laravel (mismo proyecto), rutas en `routes/api.php` |
| **Frontend Público** | React 18 + Vite, consume únicamente la API pública |

---

## Diferencias entre el Monolito y la API REST

Al implementar este proyecto me di cuenta de algo interesante: el backend de Laravel cumple dos trabajos al mismo tiempo. Por un lado, genera vistas HTML que el navegador muestra directamente (el panel del admin). Por otro, responde con datos en formato JSON que otro software puede procesar (la API pública). Aunque parece el mismo código, funcionan de maneras muy distintas.

### Autenticación

En el panel admin usamos **autenticación basada en sesiones**. Cuando te hacés login, Laravel crea una sesión en el servidor y guarda una cookie en tu navegador (`laravel_session`). Cada vez que navegás a otra página, esa cookie se envía automáticamente y el servidor sabe quién sos. Es como cuando entrás a una oficina y te dan una credencial: mientras la tengas, te conocen y pods moverte libremente.

La API, en cambio, es **stateless**, es decir, no guarda estado entre pedidos. No sabe quién sos entre un pedido y otro. Por eso la deixamos pública sin autenticación, pero si quisiéramos protegerla, tendríamos que usar tokens (como JWT o Sanctum) que el cliente debe enviar en cada solicitud.

### Protección CSRF

Los formularios del panel admin usan `@csrf` para generar un token oculto. Esto protege contra ataques Cross-Site Request Forgery, donde un sitio malicioso podría enviar pedidos a tu aplicación usando las cookies del usuario sin que él lo note.

En la API esto **no aplica**. Como no usamos cookies para autenticación, no hay forma de que un sitio externo use la sesión del usuario. Los tokens se envían en headers, no en cookies, así que el navegador no los envía automáticamente.

### Middleware

Laravel tiene dos grupos de middleware distintos. El grupo **web** incluye cosas como manejo de sesiones, cookies, CSRF, y protección de rutas. Se aplica automáticamente a las rutas definidas en `routes/web.php`. El grupo **api** está diseñado para APIs y no incluye nada de eso, por eso las respuestas son más ligeras.

Por eso las rutas del admin están en `web.php` con middleware `auth`, mientras que las de la API están en `api.php` y son públicas.

### Tipo de respuesta

Cuando visitás `/admin/boats`, el servidor devuelve **HTML** listo para mostrar. Laravel renderiza las vistas Blade y el navegador solo tiene que pintarlo. Es como pedir una pizza lista: te llega todo preparado.

Cuando pedís `/api/barcos`, el servidor devuelve **JSON** con los datos crudos. Nadie renderiza nada todavía. Es como pedir los ingredientes: vos decided qué hacer con ellos.

### Tipo de cliente

El panel admin está diseñado para **navegadores tradicionales**. Usa cookies, sigue links, recarga páginas. Si intentaras abrirlo desde una app móvil o desde Postman, no funcionaría bien.

La API acepta **cualquier cliente HTTP**: el navegador con React, una app de iOS, un script de Python, Postman, lo que sea. No le importa quién consume los datos, solo devuelve JSON.

### Manejo de estado

El monolito es **stateful**: el servidor recuerda quién está logueado, qué datos tiene en sesión, etc. Si amanhã querés escalar a múltiples servidores, necesitás configurar algo como Redis para compartir las sesiones.

La API es **stateless**: cada pedido es independiente. Si mañana tenés mil usuarios al mismo tiempo, cada pedido se puede procesar en cualquier servidor sin necesidad de compartir información. Es más fácil de escalar.

### Renderizado de vistas

Blade usa **Server-Side Rendering (SSR)**: el servidor procesa la plantilla, reemplaza las variables con datos reales, y envía HTML listo. El navegador recibe algo que puede mostrar inmediatamente.

React usa **Client-Side Rendering (CSR)**: el servidor solo envía un esqueleto vacío y código JavaScript. El navegador ejecuta ese código, decide qué mostrar, y hace pedidos a la API para obtener los datos. Es más fluido una vez que cargó, pero la primera carga puede ser más lenta.

---

## Instalación

### Backend

```bash
cd backend
composer install
cp .env.example .env
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

**Credenciales de admin:**
- Email: `admin@galapagos.test`
- Password: `password`

### Frontend

```bash
cd frontend
npm install
npm run dev
```

La aplicación frontend corre en `http://localhost:5173` y se conecta al backend en `http://localhost:8000`.

---

## API Endpoints

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/barcos` | Listar barcos activos |
| GET | `/api/barcos/{id}` | Ver detalle de un barco |
| GET | `/api/salidas` | Listar todas las salidas |
| GET | `/api/itinerarios/consulta?tipo=5D/4N&timezone=America/Guayaquil` | Consultar itinerarios con conversión de timezone |

---

## Tecnologías

- **Backend:** Laravel 11, SQLite, TailwindCSS
- **Frontend:** React 18, TypeScript, Vite, TailwindCSS
- **Auth:** Laravel Breeze (session-based)