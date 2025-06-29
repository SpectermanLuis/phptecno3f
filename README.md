#  CURSO PHP Y MYSQL
## ALUMNO : SPECTERMAN LUIS OMAR

### TP FINAL Curso PHP y MYSQL de TECNO 3F 

### Consigna
Deberan crear un CRUD con LOGIN.
Deben realizar buenas practicas, indentando y comentando el
codigo¡

#### Estructura de directorios
``` tree
    ├── uploads     ( imagenes de los productos que se cargan )
    │   Archivos para el crud   
    ├── conexion.php
    ├── crear_producto.php
    ├── dashboard.php
    ├── editar_producto.php
    ├── eliminar_producto.php
    ├── login.php
    ├── logout.php
    ├── ver_productos.php
    ├   Archivos front basico para verificar funcionamiento del crud
    ├── catalogo.html
    ├── api_productos.php
    └── README.md
```

---
### CONFIGURACION DE ENTORNO
  - #### VARIABLES DE ENTORNO
    Se debe hacer una copia del archivo **.env.dist** y renombrarlo como **.env**. Con respecto a su contenido, es necesario asignar los valores a correspondientes a las variables:
    ``` js
        SERVER_PORT=3005
        SERVER_HOST=127.0.0.1

        DATABASE_URL=tu-cadena-de-conexion
        DATABASE_NAME=muebleria
    ```

