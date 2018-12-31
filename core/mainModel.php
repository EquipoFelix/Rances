<?php
if ($peticionAjax) {
  require_once "../core/configAPP.php";
} else {
  require_once "./core/configAPP.php";
}

class mainModel{
  protected function conectar(){
    $enlace=  new PDO(SGBD,USER,PASSWORD ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
    return $enlace;
  }

  protected function consulta_simple($datos){
    $respuesta=self::conectar()->prepare($datos);
    $respuesta->execute();
    return $respuesta;
  }


  protected function alertas($datos){
    if ($datos['Alerta']=="simple") {
      $alerta="
      <script>
        Swal('".$datos['Titulo']."','".$datos['Texto']."','".$datos['Tipo']."')
      </script>
      ";
    }elseif ($datos['Alerta']=="recargar") {
      $alerta="
      <script>
      swal({
        title:'".$datos['Titulo']."',
        text:'".$datos['Texto']."',
        type:'".$datos['Tipo']."',
        confirmButtonText:'Aceptar'
      }).then(function (){
          location.reload();
      });
      </script>
      ";
    }elseif ($datos['Alerta']=="limpiar") {
      $alerta="
      <script>
      swal({
        title:'".$datos['Titulo']."',
        text:'".$datos['Texto']."',
        type:'".$datos['Tipo']."',
        confirmButtonText:'Aceptar'
      }).then(function (){
          $('.FormularioAjax')[0].reset();
      });
      </script>
      ";
    }
    return $alerta;
  }

}
?>
