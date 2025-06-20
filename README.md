
---

## 🐳 Instructivo para ejecutar el proyecto Laravel con Docker

### ✅ Requisitos previos

Antes de comenzar, asegúrate de tener instalados en tu computadora:

* [composer](lo puedes hacer mediante este enlace: https://getcomposer.org/download/)
* [Docker](https://www.docker.com/products/docker-desktop/)
* [Git](https://git-scm.com/) (opcional pero recomendado)

---

### 📥 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
```

> Cambia la URL por la de tu propio repositorio.

---

### 📁 2. Estructura esperada

Asegúrate de que en el proyecto existan los siguientes archivos y carpetas:

* `docker-compose.yml`
* `Dockerfile`
* Carpeta `nginx/` con `default.conf`
* Carpeta `initdb/` con el archivo `documento1.sql` (contiene la base de datos inicial)
* Código Laravel (carpeta `app`, `routes`, `public`, etc.)

---

### ⚙️ 3. Construir e iniciar los contenedores

```bash
docker-compose up --build
```

Este comando hará lo siguiente:

* Construirá la imagen de Laravel.
* Levantará los contenedores: **Laravel (PHP-FPM)**, **MySQL**, y **Nginx**.
* Ejecutará el archivo `documento1.sql` automáticamente para crear la base de datos y sus tablas.

⏳ La primera vez puede tardar unos minutos.

---

### 🌐 4. Acceder al proyecto

Una vez que todo esté funcionando correctamente, abre tu navegador en:

```
http://localhost:8000
```

Ahí podrás ver tu aplicación Laravel en funcionamiento.

---

### 🧹 5. Si hay errores

Si algo sale mal (como la base de datos no se crea):

```bash
docker-compose down -v
```

Este comando elimina todos los volúmenes y datos. Luego vuelve a correr:

```bash
docker-compose up --build
```

---

