# Proyecto web para gestionar la biblioteca del centro I.E.S. Hermenegildo Lanz - 2 D.A.W.

**Descripción:**

* Parte administrativa: Registro de usuarios tanto individuales como por archivo CSV. Registro de libros electrónicos guardando sus archivos. Gestión de usuarios, cursos y libros. Aprobación de los comentarios realizados por los usuarios para su posterior visualización.

* Parte del usuario final: listado de libros por orden alfabético, búsqueda de libros, descarga de los mismos (si acepta los términos del centro), subida de valoraciones y comentarios (si está logueado).

**Tecnologías usadas:**

Symfony 5 (parte administrativa de la aplicación), React 17 (parte del usuario final), SASS, CSS3 y HTML5. Bundles de symfony: API Platform, Paginator.


React en: /assets
Sass en: /public/scss

**Instalación:**

* composer install (instala las dependencias de symfony).

* yarn install (instala las dependencias de react);

**Para ejecutar en local:**

* yarn watch (compila react)

* symfony server:start (inicia el servidor)

(Ambos son necesarios dejarlos ejecutándose)

**Base de datos:**

* crear en local: proyectobiblioteca

* ejecutar: php bin/console doctrine:schema:update

**Integrantes:**

Alberto, Alejandro, Iván, Jesús, Juan de Dios, Yalal.