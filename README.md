# ARGDevCamp

ARGDevCamp es un evento para conferencias de desarrolladores, donde toda la comunidad de la programacion puede asistir. Elegi a tu influencia favorita y accede a beneficios. Solo tenes que crear una cuenta.

Lenguajes utilizados: PHP, SASS, JavaScript, MYSQL

Librerias: PHPMailer, PHPdotenv, SweetAlert2, PSR-4

Manejador de paquetes: Composer, NPM

Toolkits: GulpJS para compresion de imagenes, minificacion de CSS y JS. Se utiliza Sourcemaps para identificar a traves del navegador donde se establecio un estilo o un Script de JS.

Arquitecturas: MVC, ActiveRecord(Sincroniza DB con Objetos PHP, explicado en el anterior proyecto).

Meta data: Se establecieron los metadatos necesarios para mejorar el SEO.

Tipo de dispositivos: Responsive para todos los dispositivos.

Se utilizo FontAwesome para algunos iconos.

Asimismo, se comenzo a utilizar la metodología BEM, para mejor escalabilidad, reutilizacion y legibilidad del codigo.

Selectores de atributo:
En este proyecto comenzamos a usar los selectores de atributo para clases genericas, por ejemplo, una clase que se reutiliza mucho es la de LOGO, la cual, comparte muchas veces los mismos estilos.

PHPMailer: Esta libreria de composer, junto a MailTrap, permitieron hacer prueba en desarrollo para el envio de MAILS.

Optimizacion de imagenes por parte del servidor: Intervention Image
A la hora de subir imagenes por parte del servidor, se utilizo Intervention Image, para la optimizacion, resize y ajuste de imagenes.

Renderizacion del texto: CSS tiene una funcion llamada text-rendering, la cual decide que debe cargar primero es decir, a que se le da mas prioridad. Generalmente es para elemntos VECTORES como SVG. En mi caso, los vectores son definidos como carga por igual(auto), es decir, que decida el navegador que hacer.

Reutilizacion de estilos: En este proyecto se aprovecho el uso excesivo de MIXINS, que permite una gran reutilizacion de codigo.


## Funciones de la web
Crear cuenta, login, confirmar cuenta, olvide mi contraseña, restablecer contraseña.



### Funciones agregadas:
LIMITE DE REESTABLECIMIENTO DE Contraseña -> Un usuario puede solicitar 1 vez el restablecimiento de contraseña cada 10 minutos. Para esto se creo una funcion en ActiveRecord llamada checkTimeAwait() al español, chequear tiempo de espera, el cual devuelve si el usuario que quiere solicitar la contraseña, ya esta listo para poder hacerlo. Para esto, se utilizo DateTime en php y las funciones de SQL: DATE_SUB(NOW(), INTERVAL 10 MINUTE) Esto evalua si a paratir del momento en el que se solicito el cambio, ya transcurrieron 10 minutos, en caso de que si, devuelve el resultado