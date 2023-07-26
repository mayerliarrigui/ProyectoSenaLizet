<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    // Usuario no logueado, muestra un mensaje de alerta
    echo "<script>alert('Debe iniciar sesión para ver esta página.'); window.location.href='login.html';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
         integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="style.css">
      <script src="index.js"></script>
      <title>Portafolio web</title>
   </head>
   <body>
      <section id="inicio">
         <div class="contenido">
            <header>
               <div class="contenido-header">
                <img src="./imagenes/gettyimages-1676551601.png" alt="" width="40px">
                  <h1>Adoptame</h1>
                  <!-- ... -->
                        <nav id="nav" class="">
                           <ul id="links">
                              <li><a href="#inicio" class="seleccionado" onclick="redirect('adoptar.php')">Adoptar</a></li>
                              <li><a href="#sobremi" onclick="redirect('portular.html')">Postular</a></li>
                              <li><a href="#servicios" onclick="redirect('mision.html')">Acerca de</a></li>
                              <li><a href="#portafolio" onclick="redirect('Login.html')">Login</a></li>
                              <li><a href="#" onclick="cerrarSesion()">Cerrar Sesión</a></li> 
                           </ul>
                        </nav>
                     <!-- ... -->
               </div>
            </header>
              <div class="presentacion">
                <img src="./imagenes/perrosy gati.jpg" alt="" width="580px" height="250px">
               
                  <p class="descripcion">Tener un animal en tu vida no te Hace ser mejor persona,<br>
                   pero cuidarlo y respetarlo como se merece si</p>
              </div>
            <div class="acciones">
                <a href="./">Adopcion de mascotas</a><br><br>
                <p>!Gracias por pensar en adoptar una mascota de nuestro refujio! Nos  esforzamos por <br>
                conseguir un  Hogar permanente lleno de amor a nuestras mascotas del refujio</p><br>
                <button onclick="redirect('adoptar.php')">Adoptar</button> <br>

                <a href="./adoptar.php">Postulacion de mascotas</a><br><br>
                <p>!Con su ayuda y la de muchas otras peronas podremos enciontrar  un hogar para que <br>
                todos los animales puedan estar bajo un techo y tener una calida familia</p>
                <button onclick="redirect('portular.html')">Postular</button>
               
            </div>
         </div>
      </section>
     
    </body>
    
</html>