# Sistema CRUD con FETCH
Registra Usuarios.
Valida los campos del registro tanto de usuarios como de los productos.
Envía correos electrónicos para verificar el correo del usuario, y para enviarle su nueva contraseña por si se le olvida.
Valida que el nuevo usuario no use un correo electrónico que ya está en uso.
Impide el acceso a la página principal en caso de no haberse autenticado previamente.

Desarrollado mediante html, js, fetch, bootstrap, php pdo,php mailer, sweet alert2 y mysql.

Nota: Los archivos dentro de la carpeta sendEmail no tienen ni el correo utilizado ni la contraseña.
Si desea usar el sistema, se deben llenar los campos vacíos en esos archivos y se debe configurar previamente el servicio de google, 
para poder enviar correos electrónicos desde la página web.
Para configurarlo, mira este video: https://www.youtube.com/watch?v=kZnTFUvc1ig
La única diferencia es que no es necesario usar ISP Gestión como en el video, únicamente es escribir la contraseña que se muestra al realizar los pasos del video,
en el espacio correspondiente de los archivos dentro de sendEmail.
