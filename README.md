# ARGDevCamp

ARGDevCamp es un evento para conferencias de desarrolladores, donde toda la comunidad de la programacion puede asistir. Elegi a tu influencia favorita y accede a beneficios. Solo tenes que crear una cuenta.

Lenguajes utilizados: PHP, SASS, JavaScript, MYSQL

Librerias: PHPMailer, PHPdotenv, SweetAlert2, PSR-4, InterventionImage

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

## Pagos en linea.
ArgDevCamp permite realizar pagos en linea a traves de PayPal o tarjetas. Se implementa  la API REST de PayPal. Se utilizaron credenciales otorgadas y el sandbox por la empresa para garantizar el buen funcionamiento del envio de dinero. Que es el sandbox? El sandbox es un estado de la aplicacion, la cual significa un modo de prueba.

## Regalos y conferencias

Una vez hecho un pago, el usuario podra elegir hasta 5 conferencias de desarrolladores si asi lo desea. Asimismo, podra elegir un regalo, siempre y cuando su pase sea virtual o presencial

## Funciones de la web
Crear cuenta, login, confirmar cuenta, olvide mi contraseña, restablecer contraseña.


Paginacion: La paginacion es un elemento super importante para webs con muchos registros. Alivianan la carga al servidor y permite una experiencia de usuario muy agradable. Este proyecto lo incorpora. Se crearon tanto consultas para la base de datos como funciones especificas y una clase para la Paginacion.

Nuevas funcionalidades y nuevos metodos de ActiveRecord:
A medida que se avanza en el proyecto, surgen nuevos requerimentos que no satisfacen la necesidad del mismo. Es por eso que se crearon 1 metodo mas:
1. Llamado whereArray, recibe un array y realiza consultas en base a las keys otorgadas por parte del Controlador.
Asimismo, esto derivo en un problema, cuando se establece más de un filtro en SQL, se agrega AND entre medio de 2 condiciones. Entonces, al recorrer con un foreach, siendo una query fija como:
*2 "SELECT * FROM tabla where columna_id = id AND "
Al recorrerse 2 veces, se agregara un AND al final, quedando asi:
"SELECT * FROM tabla where columna_id = id AND columna2_id = id2 AND", esto claramente esta mal.
Por lo que se hizo uso de la funcion de PHP array_key_last($array) y se comprobo si se llego a la ultima posicion del array, no agregue el AND.
Otra opcion fue SUBSTR(), pero no es muy optima, no por rendimiento, sino que necesita una especificidad de caracteres a eliminar, contando por ejemplo, espacios.

## Nuevas funciones de JS:
Por necesidad de la logica del codigo y acceso a las variables, se necesito convertir NodeList(elementos en nodo de HTML) a un array. Ahora si bien su estructura es similar, un NODELIST no se puede recorrer con un FILTER, ni MAP. Es por esto que se incorporo: Array.from(nodelist);
Transforma un NodeList en un array.


### Funciones agregadas:
LIMITE DE REESTABLECIMIENTO DE Contraseña -> Un usuario puede solicitar 1 vez el restablecimiento de contraseña cada 10 minutos. Para esto se creo una funcion en ActiveRecord llamada checkTimeAwait() al español, chequear tiempo de espera, el cual devuelve si el usuario que quiere solicitar la contraseña, ya esta listo para poder hacerlo. Para esto, se utilizo DateTime en php y las funciones de SQL: DATE_SUB(NOW(), INTERVAL 10 MINUTE) Esto evalua si a paratir del momento en el que se solicito el cambio, ya transcurrieron 10 minutos, en caso de que si, devuelve el resultado


