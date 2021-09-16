# Api-Ingeniat
Descripción
proyecto API par la entrevista en la empresa Ingeniat

# documentacíon
todos los datos enviados en en el cuerpo de la solicitud HTTP tiene que enviarse enla forma x-www-form-urlencoded para el correcto funciona,miento del API

*  <h2>Crear un nuevo usario 
Para crear un nuevo usuario se envia el nombre, apellido,correo,	password y rol por el metodo POST,
si todos los datos ingresados son validos se generara un nuevo usuario en la base de datos y se enviara un mensaje de creacion de usuario exitosa y una respuesta HTTP 201

ejemplo de endpoint par la creación de un usuario
   

     dominio.com/api/user


* <h2>Hacer login en el API
para poder hacer login en el API se envia el correo electronico y la contraseña por el metodo POST, si la información ingresada conincide con un usuario valido que exista en  la base de datos se otorgara un token JWT para poder acceder a los demas endpoints de las publicaciones

ejemplo de endpoint par la hacer login

    dominio.com/api/login

* <h2>Uso del token JWT
eL token se encia en todas las peticiones para obtener, crear, actualizar o eliminar alguna publicación se envia en las cabeceras de la solicitud HTTP con el key Authorization y en el valor de esta cabecera la palabra Bearer  seguido de el token obtenido al hacer login

Ejemplo de token obtenido en el API

    eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpZCI6IjEiLCJuYW1lIjoiYWxkbyIsInJvbGUiOiJhbHRvIiwiZXhwaXJlIjoxNjMxNzk2MDUyfQ.CNlO4EKQoIrPkxw5TQibLWVpkRLkSolyB83vlq8MqmM2mY8JRBVftfOkfQA6dMGkXWTOTY5JrqE7hHKMOJxkBTTuOvPSXFbxS4Hcf3Od6iINNCj3ajE6EetALSnQh0PHEt9a-6c6haha5qvZHZj6ZJbiqWTuc8h4OMSzB0bdnlYQs-cklb6eaxIgTCpc2uqAiok0ZGHLJvjbvY88MQO0yJlqEdW-B-RrhNTEWs6t4XYPx1wtk0CuWyGyoOoqAZA700vMV84iKUDl-QIyEZKK1tP0qWUxKWw8Hx69A83MfCmspWlmOZqOuD_x_BpcmyR717IKj67EjoaMNmUWBt1keDNoDhRlTBUyxJfSP6FbFpG_jJXcRzzE6ynpx9NQt7KvW1BUdSEE4jVbcf-SyGzO1-wJwjUCwJGthnNO6PPVQeJ302QWgsamjzgeBfKr64RQrmzrveXrd8N2i7jYtxvrmzgGaV6Oxj5Sglg7QFm4r1bnnlXu98VJNmScuA9lxs8ttvq30HMjWQS7B8K2tb1SvqEfR3DzNv0oxRzDJ2KEEAc7QV4DqOWG_NbBjODavp7ienJ1wMFmMda59xCwh1JPMzNFqYNaeKfZ1VgnpNX9mSsvcLCJ-_OxSis_wBLB_rj81Hs2nHmuC4795nQoCuzjoeq4kGYPF2FM_qkyWTSonO4

* <h2>Creación de una nueva publicación 
para crear un publicacion se envia el titulo y la descripción de la publicación por el metodo POST, si los datos son correctos se creara una nueva publicación en las base de datos y se recibirá un mensaje de confirmación ademas de una respuesta HTTP 201

ejemplo de endpoint par la creación de una publicación

    dominio.com/api/post

* <h2> Actualización de una publicacion  
para actualizar una publicación se envia el titulo y la descripción de la publicación por el metodo PUT, si los datos son correctos se actualiza el titulo y la descripción en la base de datos 

ejemplo de endpoint par la actualización de una publicación


     dominio.com/api/post/1

 *<h2> Eliminar una publicacion  
 
para eliminar una publicación se especifica en el endpoint el id de la publicacion que se desea eliminar enviando la peticion por el metodo DELETE

ejemplo de endpoint par la eliminación de una publicación

    dominio.com/api/post/1

*<h2> Consultar publicacionnes

para consultar las publicaciones se envia una petición por el metodo GET al endpoint de las publicaciones y se obtiene un objeto con con una lista de arrays con el titulo, la descripción, la fecha de creación, el nombre y el rol de usuario que lo creo

ejemplo de endpoint par la consulta de todas las publicaciones activas

    dominio.com/api/posts
 
