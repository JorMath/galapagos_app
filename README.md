# Galápagos - Sistema de Gestión de Salidas de Barcos
Sistema de gestión de salidas de barcos turísticos en Galápagos. Compuesto por tres partes interconectadas:
| Parte | Descripción |
|-------|-------------|
| **Panel Administrador** | Laravel 11 + Blade + autenticación por sesión |
| **API REST Pública** | Laravel (mismo proyecto), rutas en `routes/api.php` |
| **Frontend Público** | React 18 + Vite, consume únicamente la API pública |
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
---
## Diferencias entre el Monolito y la API REST
Al implementar este proyecto me di cuenta de algo interesante: el backend de Laravel cumple dos trabajos al mismo tiempo. Por un lado, genera vistas HTML que el navegador muestra directamente (el panel del admin). Por otro, responde con datos en formato JSON que otro software puede procesar (la API pública). Aunque parece el mismo código, funcionan de maneras muy distintas.
### Autenticación
En el panel admin usamos autenticación basada en sesiones. Cuando hacemos login, Laravel crea una sesión en el servidor y guarda una cookie en el navegador. Cada vez que se navega a otra página, esa cookie se envía automáticamente y el servidor sabe quién soy.
La API, en cambio, no guarda estado entre pedidos por lo que se conoce como stateless. No sabe quién es entre un pedido y otro. Por eso en la prueba se sugiere que los endpoints sean públicos sin autenticación, pero si quisiéramos protegerla, tendríamos que usar tokens (como JWT o Sanctum) que el cliente debe enviar en cada solicitud, es la manera de manejar autenticación el la API.
### Protección CSRF
Los formularios del panel admin usan `@csrf` para generar un token oculto. Esto protege contra ataques donde un sitio malicioso podría enviar peticiones a la app usando las cookies del usuario sin que se note.
En la API esto no aplica. Como no usamos cookies para autenticación, no hay forma de que un sitio externo use la sesión del usuario. Los tokens se envían en las cabeceras, no en cookies, así que el navegador no los envía automáticamente.
### Middleware
Laravel tiene dos grupos de middleware distintos. El grupo web incluye cosas como manejo de sesiones, cookies, CSRF, y protección de rutas. Se aplica automáticamente a las rutas definidas en `routes/web.php`. El grupo api está diseñado para APIs y no incluye nada de eso.
Por eso las rutas del admin están en `web.php` con middleware `auth`, mientras que las de la API están en `api.php` y son públicas.
### Tipo de respuesta
Cuando se visita `/admin/boats`, el servidor devuelve HTML listo para mostrar. Laravel renderiza las vistas Blade y el navegador solo tiene que tomar lo que envía el servidor.
Cuando se visita `/api/barcos`, el servidor devuelve JSON con los datos crudos. Nadie renderiza nada todavía. Por eso al implementar con React después, se habla del CSR (Client-Side-Rendering)
### Tipo de cliente
El panel admin está diseñado para navegadores tradicionales, usa cookies, sigue links, recarga páginas, en cambio, la API acepta cualquier cliente, el navegador con React, una app de iOS, un script de Python, Postman, lo que sea.
### Manejo de estado
El monolito tiene estado, el servidor recuerda quién está logueado, qué datos tiene en sesión, etc
La API como ya se comentó es sin estado.
### Renderizado de vistas
Blade usa Server-Side Rendering (SSR): el servidor procesa la plantilla, reemplaza las variables con datos reales, y envía HTML listo. El navegador recibe algo que puede mostrar inmediatamente.
React usa **Client-Side Rendering (CSR)**: el servidor solo envía un esqueleto vacío y código JavaScript. El navegador ejecuta ese código, decide qué mostrar, y hace pedidos a la API para obtener los datos, también creo que depende de las decisiones de implementación cuál es mejor o peor, dependiendo del caso.
---
