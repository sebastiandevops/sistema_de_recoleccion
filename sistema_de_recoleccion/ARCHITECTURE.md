# Arquitectura del proyecto — sistema_de_recoleccion

Este documento resume la arquitectura de alto nivel del proyecto, muestra los componentes principales, el flujo de datos y dónde encontrar el código relevante en el repositorio.

## Objetivo
Breve guía para desarrolladores nuevos que permite entender rápidamente cómo está organizado el proyecto, qué responsabilidades tiene cada capa y dónde implementar cambios o nuevas funcionalidades.

## Visión general
- Framework: Laravel (Blade + Breeze para auth)
- Frontend: Blade + Tailwind (Vite)
- Base de datos: SQLite (desarrollo)
- Autenticación: Breeze (scaffolding Blade)
- Autorización: Policies (ej. `CollectionPolicy`)

## Componentes principales

1. Capa de presentación (Vistas)
   - `resources/views/` — todas las vistas Blade.
   - Plantillas principales: `resources/views/layouts/app.blade.php`, `resources/views/layouts/navigation.blade.php`.
   - Páginas clave:
     - `resources/views/dashboard.blade.php` — panel del usuario.
     - `resources/views/collections/*.blade.php` — listado, creación, edición y detalle de recolecciones.

2. Capa de aplicación (Controladores)
   - `app/Http/Controllers/DashboardController.php` — construye los datos del panel.
   - `app/Http/Controllers/CollectionController.php` — CRUD de recolecciones.

3. Capa de dominio (Modelos)
   - `app/Models/User.php` — usuario (relación `hasMany` con `Collection`).
   - `app/Models/Collection.php` — modelo de recolección (atributos, casts y relación a `User`).

4. Persistencia (Migraciones / DB)
   - `database/migrations/2025_10_04_000100_create_collections_table.php` — estructura de la tabla `collections`.
   - `database/database.sqlite` — fichero SQLite (desarrollo).

5. Reglas de acceso (Policies / Gates)
   - `app/Policies/CollectionPolicy.php` — controla `view`, `update`, `delete` (propietario o admin).
   - Las políticas se registran en `app/Providers/AuthServiceProvider.php` o en `AppServiceProvider` según la implementación actual.

6. Rutas
   - `routes/web.php` — contiene las rutas principales. Notas:
     - `Route::resource('collections', CollectionController::class)` dentro del middleware `auth`.
     - `GET /dashboard` apunta a `DashboardController@index`.

7. Assets y Build
   - `resources/js/`, `resources/css/` — puntos de entrada para Vite.
   - Comandos: `npm install`, `npm run dev` (desarrollo), `npm run build` (producción).

## Flujo de datos (ejemplo: crear una recolección)
1. Usuario autenticado abre `GET /collections/create`.
2. `CollectionController@create` devuelve la vista de formulario.
3. Usuario envía `POST /collections` con los datos.
4. `CollectionController@store` valida, guarda en `collections` y redirige al listado o detalle.
5. `DashboardController@index` y `CollectionController@index` consultan `Collection` para mostrar totales/recientes.

## Consideraciones de diseño y buenas prácticas
- Validación: todas las entradas en `CollectionController` se validan antes de persistir.
- Autorización: usa políticas para asegurar que sólo el propietario o admin puedan editar/eliminar.
- Fallback CSS: se añadieron estilos inline mínimos para asegurar visibilidad sin necesidad de compilar assets; idealmente reemplazar por clases Tailwind y compilar assets en el flujo de desarrollo.

## Extensiones recomendadas (priorizadas)
- Rol/Permisos: añadir campo `role` en `users` y el helper `hasRole()` para controlar administradores más explícitamente.
- Tests: añadir pruebas feature para `CollectionController` (crear/editar/mostrar) y para `DashboardController`.
- Integraciones: servicio de notificaciones (WhatsApp), generación de reportes (CSV/PDF) y exportes por usuario/localidad.

## Despliegue (notas rápidas)
- Para producción usar una base de datos robusta (MySQL/Postgres) y configurar variables `APP_ENV`, `APP_DEBUG=false`, `APP_KEY` y drivers de cache/session apropiados.
- Compilar assets con `npm run build` y configurar servidor web (Nginx/Apache) o contenedor.

## Archivos/paths de referencia rápida
- `routes/web.php`
- `app/Http/Controllers/DashboardController.php`
- `app/Http/Controllers/CollectionController.php`
- `app/Models/Collection.php`
- `app/Policies/CollectionPolicy.php`
- `resources/views/collections/index.blade.php`
- `resources/views/collections/create.blade.php`
- `resources/views/dashboard.blade.php`

## Diagrama y documentación adicional
- Diagrama de casos de uso y clases en `docs/diagrams/` (PlantUML source incluido en `docs/diagrams/use-cases.puml`).

---

Si quieres, puedo:
- Generar un diagrama de arquitectura (PlantUML) basado en este documento.
- Añadir un mapa de dependencias (composer.json / package.json) o un diagrama de despliegue.
- Crear `ARCHITECTURE.md` en una ubicación `docs/` en lugar de la raíz si lo prefieres.

Fin del documento.
