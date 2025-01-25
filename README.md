
# Prueba Tecnica

Sistema para control de productos y categorias.
## Instrucciones

Como sugerencia utilice Xammp o cualquier otro gestor similar.

Clone el repositorio

```bash
    git clone https://github.com/stevenhaucab/crud_products.git
```

Dirijase al repositorio una vez clonado

```bash
    cd tu_ruta/crud_products
```

Copie el archivo config/config-Example.php y quite -Example dentro agrege sus credenciales de BD

En esta ruta \src\Controllers\RegisterController.php
cambiar las xxxx por tus credenciales de BD es para el registro de usuarios.

En el host local que tenga apunte a la carpeta public 

Ejemplo con XAMMP: 

<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\crud_products\public"
    ServerName testTecnico.local
    <Directory "C:\xampp\htdocs\crud_products\public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
## Ejemplo en XAMMP

```javascript
<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\crud_products\public"
    ServerName testTecnico.local
    <Directory "C:\xampp\htdocs\crud_products\public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```
en los host agregue el nombre de ServerName la ruta en Windows es 
```javascript
	C:\Windows\System32\drivers\etc\host
```
Abrir de preferencia en Notepad++ y agregar el nombre del host local

```javascript
	127.0.0.1   	testTecnico.local
```

Para crear un nuevo usuario debe dirijirse a tuHost/register 

y podra acceder al sistema