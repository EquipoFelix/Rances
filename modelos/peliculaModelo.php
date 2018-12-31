<?php
header("Content-Type: text/html;charset=utf-8");
    if ($peticionAjax) {
      require_once "../core/mainModel.php";
    } else {
      require_once "./core/mainModel.php";
    }

    class peliculaModelo extends mainModel {
      protected function agregar_pelicula_modelo($datos){

          $sql=self::conectar()->prepare("INSERT INTO peliculas(pel_nombre,pel_des,pel_clase,pel_img)
                                          Values(:nombre,:des,:clase,:img)");
          $sql->bindParam(":nombre",$datos['lblNombre']);
          $sql->bindParam(":des",$datos['lblSinopsis']);
          $sql->bindParam(":clase",$datos['lblClase']);
          $sql->bindParam(":img",$datos['file-input']);
          $sql->execute();
          return $sql;

      }
      protected function actualizar_pelicula_modelo($datos){
          $sql=self::conectar()->prepare("UPDATE peliculas SET pel_nombre = :nombre,pel_des = :des, pel_clase = :clase,pel_img = :img WHERE pel_id =:id");
          $sql->bindParam(":id",$datos['id']);
          $sql->bindParam(":nombre",$datos['lblNombre']);
          $sql->bindParam(":des",$datos['lblSinopsis']);
          $sql->bindParam(":clase",$datos['lblClase']);
          $sql->bindParam(":img",$datos['file-input']);
          $sql->execute();
          return $sql;

      }
      protected function eliminar_pelicula_modelo($datos){
        $sql=self::conectar()->prepare("DELETE FROM peliculas where pel_id=:ID");
        $sql->bindParam(":ID",$datos);
        $sql->execute();
        return $sql;
      }
    }

 ?>
