# Extracción de Entidades Predominantes desde una URL

Este proyecto permite extraer las entidades 5 predominantes de un texto proveniente de una URL utilizando la API de Google Cloud Language.

## Requisitos

Para ejecutar este proyecto, son necesarias las siguientes herramientas y servicios:

- **Google Cloud Platform**: Para acceder a la API de Google Cloud Language.
- **Node.js y Composer**: Para las dependencias relacionadas con el backend del proyecto.
- **Python**: Para ejecutar el código que interactúa con la API de Google Cloud Language.

## Instrucciones para la Configuración

### 1. Clonar el Repositorio

Clona el repositorio a tu máquina local:

```bash
git clone https://github.com/Benjamin-Galan/entidades-app.git

```
### 2. Descargar dependencias de node, composer y python

```bash
npm install
```

```bash
composer install
```

```bash
pip install requests
pip install beautifulsoup4
pip install google-cloud-language
```

### 3. Crear una cuenta de google cloud
1. Ve a google cloud console y crea una cuenta.
2. Ve a Seleccionar un proyecto o haz clic en Crear un proyecto.
3. Asigna un nombre a tu proyecto y configura la organización opcional.
4. Haz clic en Crear para crear tu proyecto.
5. Te saldrá una notificación para que selecciones el proyecto.
6. En la Google Cloud Console, ve a APIs y Servicios > Biblioteca.
7. Busca Cloud Natural Language API.
8. Haz clic en Habilitar para activar la API en tu proyecto.
9. Ve a APIs y Servicios > Credenciales en la Google Cloud Console.
10. Haz clic en el menu de administración > IAM > Cuentas de servicio
11. Asigna un nombre a la cuenta de servicio y selecciona el rol Proyecto > Propietario o uno adecuado.
12. Luego, aparecerá el proyecto. A la derecha hay un ícono con 3 puntos.
13. Dar click > Administrar claves > agregar clave > Crear clave nueva
14. En Tipo de clave, selecciona JSON y haz clic en Crear.
Descarga el archivo JSON con las credenciales de la cuenta de servicio y guárdalo en un lugar seguro.


### 4. Configurar variables de entorno
Este proyecto necesita 2 variables de entorno, el interprete de python y el archivo json con la clave de api de google

Abre CMD y ejecuta el siguiente comando (reemplaza la ruta con la ubicación de tu archivo JSON):
```bash
set GOOGLE_APPLICATION_CREDENTIALS=C:\Users\nombredeusuario\AppData\Roaming\gcloud\angelic-surfer-443117-d8-35160ff8546b.json
```
```bash
set PYTHON_PATH=C:\Python312\python.exe
```

En powershell
```bash
$env:GOOGLE_APPLICATION_CREDENTIALS="C:\Users\nombredeusuario\AppData\Roaming\gcloud\angelic-surfer-443117-d8-35160ff8546b.json"
```
```bash
 $env:PYTHON_PATH="C:\Python312\python.exe"
```
Se deben llamar de esta manera ya que tienen ese nombre en el archivo .env de laravel

### 5. Ejecutar el servidor de laravel
Ejecuta el servidor de laravel con php artisan serve

[https://github.com/Benjamin-Galan/entidades-app/master/imagen/captura.jpeg](https://github.com/Benjamin-Galan/entidades-app/blob/master/imagen/captura.jpeg)

### 6. Observaciones
1. Si tienes problemas con la base de datos crea una migración con php artisan migrate
2. Si tienes otro problema enviame un correo a begalan@outlook.es para ayudarte
