<?php
  $peticionAjax=true;
  require_once "../core/configAPP.php";
  require_once "../controladores/peliculasControlador.php";
   $insPeliculas= new peliculasControlador();
   switch ($_GET['operacion']) {
     case 'consultaTotal':
       echo $insPeliculas->listar_pelicula_controlador();
     break;
     case 'consultaSimple':
       echo $insPeliculas->consulta_simple_controlador();
     break;
     case 'consultaTitulos':
       echo $insPeliculas->listar_titulos_pelicula_controlador();
     break;
     case 'busqueda':
       echo $insPeliculas->listar_busqueda_pelicula_controlador();
     break;
     case 'registrarPelicula':
       echo $insPeliculas->agregar_pelicula_controlador();
     break;
     case 'actualizarPelicula':
       echo $insPeliculas->actualizar_pelicula_controlador();
     break;
     case 'eliminaPelicula':
       echo $insPeliculas->eliminar_pelicula_controlador();
     break;
   }
 ?>
