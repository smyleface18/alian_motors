# Alian Motors

Aplicación MVC en PHP para administrar propietarios, vehículos y mantenimientos.

## Resumen

Este proyecto es un sistema simple de gestión de parque automotor con:
- CRUD de propietarios (`owners`)
- CRUD de vehículos (`cars`)
- CRUD de mantenimientos (`maintenances`)
- Búsqueda y filtros en listados
- Validación de formularios y mensajes de error amistosos

## Estructura del proyecto

- `public/` - Punto de entrada web. Aquí se ejecuta el servidor PHP.
- `routes/web.php` - Enrutador principal basado en query params (`view`, `action`).
- `config/database.php` - Configuración de conexión PDO a MySQL.
- `app/controllers/` - Controladores para la lógica de dueños, autos y mantenimientos.
- `app/models/` - Clases que encapsulan operaciones sobre la base de datos.
- `app/views/` - Plantillas HTML/PHP para mostrar listas, formularios y detalles.
- `SQL.sql` - Script de creación de las tablas en MySQL.

## Configuración de base de datos

El proyecto usa MySQL con PDO. Modifica los datos de conexión en `config/database.php` si tu entorno es diferente.

Valor por defecto:
- host: `localhost`
- database: `cars_db`
- user: `root`
- pass: ``

### Tablas principales

```sql
CREATE TABLE owners (
    cc VARCHAR(20) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20)
);

CREATE TABLE cars (
    license_plate VARCHAR(10) PRIMARY KEY,
    owner_cc VARCHAR(20),
    model VARCHAR(50),
    line VARCHAR(50),
    brand VARCHAR(50),
    CONSTRAINT fk_owner FOREIGN KEY (owner_cc) REFERENCES owners(cc) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE maintenances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_plate VARCHAR(10),
    date DATE,
    description TEXT,
    cost DECIMAL(10,2),
    CONSTRAINT fk_car FOREIGN KEY (car_plate) REFERENCES cars(license_plate) ON DELETE CASCADE ON UPDATE CASCADE
);
```

## Uso

1. Ejecuta el servidor local desde la carpeta `public`:
   ```bash
   php -S localhost:8000
   ```
2. Abre en el navegador:
   ```
   http://localhost:8000
   ```
3. Navega entre las vistas disponibles:
   - `?view=owners` - Lista de propietarios
   - `?view=cars` - Lista de vehículos
   - `?view=maintenances` - Historial de mantenimientos

### Acciones

- Crear: `?view=<entidad>&action=create`
- Editar: `?view=<entidad>&action=edit&cc=<cc>` o `?view=<entidad>&action=edit&license_plate=<placa>` o `?view=<entidad>&action=edit&id=<id>`
- Ver detalle: `?view=owners&action=view&cc=<cc>` o `?view=cars&action=view&license_plate=<placa>`
- Eliminar: `?view=<entidad>&action=delete&...`

## Lógica de enrutamiento

- `routes/web.php` carga el controlador según `view`.
- Los controladores `save` y `update` devuelven errores estructurados si hay validación fallida.
- Si no hay errores, redirige al listado correspondiente.

## Controladores

- `OwnerController`:
  - `save()` - valida datos y crea propietario
  - `update()` - valida datos y actualiza propietario
  - `delete()` - elimina propietario
  - `getAll()` / `getByCc()` / `getCars()`

- `CarController`:
  - `save()` - valida datos, comprueba propietario y crea vehículo
  - `update()` - valida datos y actualiza vehículo
  - `delete()` - elimina vehículo
  - `getAll()` / `getByPlate()` / `getOwners()` / `getMaintenances()`

- `MaintenanceController`:
  - `save()` - valida datos y crea mantenimiento
  - `update()` - valida datos y actualiza mantenimiento
  - `delete()` - elimina mantenimiento
  - `getAll()` / `getById()` / `getCars()`

## Modelos y operaciones

- `Owner.php` maneja la tabla `owners`.
- `Car.php` maneja la tabla `cars` y tiene joins con `owners`.
- `Maintenance.php` maneja la tabla `maintenances` y relaciona autos con dueños.

## Mejora actual

- Validación del lado servidor para evitar errores directos de la DB.
- Mensajes de error claros en los formularios.
- Conservación de datos ingresados tras fallar validación.

## Notas

- El proyecto está construido con PHP nativo y plantillas simples, sin framework.
- Si deseas añadir autenticación o AJAX, revisa `routes/web.php` y los formularios en `app/views/`.
- Para cambiar la base de datos, actualiza `config/database.php` y rehace el script en `SQL.sql`.
