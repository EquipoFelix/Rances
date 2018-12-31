<?php
if ($peticionAjax) {
  require_once "../modelos/peliculaModelo.php";
  require_once "../core/configGeneral.php";
} else {
  require_once "./modelos/peliculaModelo.php";
  require_once "./core/configGeneral.php";
}
class peliculasControlador extends peliculaModelo{
  public function agregar_pelicula_controlador(){
    $nombre=$_POST['lblNombre'];
    $sinopsis=$_POST['lblSinopsis'];
    $clase=$_POST['lblClase'];
    $img=$_FILES['file-input']['tmp_name'];
    $hoy = date("Ymdhis");
    $archivo_final = "../adjuntos/".$hoy.".jpg";
    $data=[
      "lblNombre"=>$nombre,
      "lblSinopsis"=>$sinopsis,
      "lblClase"=>$clase,
      "file-input"=>$hoy.".jpg"
    ];
    $registroPelicula=peliculaModelo::agregar_pelicula_modelo($data);
    if ($registroPelicula->rowCount()>=1) {
      if(move_uploaded_file($img,$archivo_final)){
        $alerta=[
          "Alerta"=>"limpiar",
          "Titulo"=>"Correcto!",
          "Texto"=>"Registro exitoso",
          "Tipo"=>"success"
        ];
      }else {
        $alerta=[
          "Alerta"=>"simple",
          "Titulo"=>"Algo Salio mal!",
          "Texto"=>"No se pudo subir la imagen".$archivo_final,
          "Tipo"=>"error"
        ];
      }

    } else {
      $alerta=[
        "Alerta"=>"simple",
        "Titulo"=>"Error",
        "Texto"=>"No hemos podido hacer el registro",
        "Tipo"=>"error"
      ];
    }
    return mainModel::alertas($alerta);
  }
  public function actualizar_pelicula_controlador(){
    $nombre=$_POST['lblNombre'];
    $id=$_POST['Id'];
    $sinopsis=$_POST['lblSinopsis'];
    $clase=$_POST['lblClase'];
    $img=$_FILES['file-input']['tmp_name'];
    $hoy = date("Ymdhis");
    $archivo_final = "../adjuntos/".$hoy.".jpg";
    $data=[
      "id"=>$id,
      "lblNombre"=>$nombre,
      "lblSinopsis"=>$sinopsis,
      "lblClase"=>$clase,
      "file-input"=>$hoy.".jpg"
    ];
    $Consulta=mainModel::consulta_simple("Select pel_img from peliculas where pel_id=".$id);
    if ($Consulta->rowCount()>=1) {
      while ($arr = $Consulta->fetch(PDO::FETCH_ASSOC)) {
        $Img=$arr['pel_img'];
        $rm_file ="../adjuntos/".$Img;
        if (unlink( $rm_file )){
          $registroPelicula=peliculaModelo::actualizar_pelicula_modelo($data);
          if ($registroPelicula->rowCount()>=1) {
            if(move_uploaded_file($img,$archivo_final)){
              $alerta=[
                "Alerta"=>"recargar",
                "Titulo"=>"Correcto!",
                "Texto"=>"Actualización exitosa",
                "Tipo"=>"success"
              ];
            }else {
              $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Algo Salio mal!",
                "Texto"=>"No se pudo subir la imagen".$archivo_final,
                "Tipo"=>"error"
              ];
            }

          } else {
            $alerta=[
              "Alerta"=>"simple",
              "Titulo"=>"Error",
              "Texto"=>"No hemos podido hacer la actualización".$registroPelicula,
              "Tipo"=>"error"
            ];
          }
        }else {
          $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Error",
            "Texto"=>"No hemos podido actualizar el registro",
            "Tipo"=>"error"
          ];
        }
      }
    }
    return mainModel::alertas($alerta);
  }



  public function eliminar_pelicula_controlador(){
    $id=$_POST['id'];
    $Consulta=mainModel::consulta_simple("Select pel_img from peliculas where pel_id=".$id);
    if ($Consulta->rowCount()>=1) {
      while ($arr = $Consulta->fetch(PDO::FETCH_ASSOC)) {
        $Img=$arr['pel_img'];
        $rm_file ="../adjuntos/".$Img;
        if (unlink( $rm_file )){
          $eliminaPelicula=peliculaModelo::eliminar_pelicula_modelo($id);
          if ($eliminaPelicula->rowCount()>=1) {

            $alerta=[
              "Alerta"=>"simple",
              "Titulo"=>"Correcto!",
              "Texto"=>"Eliminaste un registro",
              "Tipo"=>"success"
            ];
          }else {
            $alerta=[
              "Alerta"=>"simple",
              "Titulo"=>"Error",
              "Texto"=>"No hemos podido eliminar el registro",
              "Tipo"=>"error"
            ];
          }
        }
        else{
          $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Error",
            "Texto"=>"No hemos podido eliminar el registro",
            "Tipo"=>"error"
          ];
        }
      }
    }else {
      $alerta=[
        "Alerta"=>"simple",
        "Titulo"=>"Error",
        "Texto"=>"No hemos podido eliminar el registro",
        "Tipo"=>"error"
      ];
    }

    return mainModel::alertas($alerta);
  }
  public function consulta_simple_controlador(){
    $id=$_POST['id'];


    $Consulta=mainModel::consulta_simple("Select * from peliculas where pel_id=".$id);
    if ($Consulta->rowCount()>=1) {
      while ($arr = $Consulta->fetch(PDO::FETCH_ASSOC)) {
        $Nom=$arr['pel_nombre'];
        $Des=$arr['pel_des'];
        $Clase=$arr['pel_clase'];
        $Img=$arr['pel_img'];
        $datos=[
          "nombre"=>$Nom,
          "des"=>$Des,
          "clase"=> $Clase,
          "img"=>"adjuntos/".$Img
        ];

      }
    }else {
      $datos=[
        "nombre"=>"No enontrado",
        "des"=>"",
        "clase"=> "",
        "img"=>""
      ];
    }
    $json = json_encode($datos);
    return $json;
  }
  public function listar_pelicula_controlador(){
    $res="";
    $Lista=mainModel::consulta_simple("Select * from peliculas");
    if ($Lista->rowCount()>=1) {
      while ($arr = $Lista->fetch(PDO::FETCH_ASSOC)) {
        $Id=$arr['pel_id'];
        $Nom=$arr['pel_nombre'];
        $Des=$arr['pel_des'];
        $Clase=$arr['pel_clase'];
        $Img=$arr['pel_img'];
        $res=$res."
        <div class=\"card\">
        <div class=\"card-body\">
        <div class=\"row\">
        <div class=\"col-3  d-flex justify-content-center d-flex flex-wrap align-content-center\">
        <img src=\"./adjuntos/".$Img.
        "\" width=\"200\" height=\"200\" alt=\"...\" class=\"img-thumbnail\">
        </div>
        <div class=\"col-6\">
        <h4 class=\"text-center\">".$Nom."</h4>
        <br>
        <h6 class=\"text-danger\">Clasificación: ".$Clase."</h6>
        <h6>".$Des."</h6>
        </div>
        <div class=\"col-3  d-flex justify-content-center d-flex flex-wrap align-content-center\">
        <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
        <button type=\"button\" class=\"btn btn-primary btn-sm\" id=\"".$Id."\" onclick=\"Modificar(this.id)\">Modificar</button>
        <button type=\"button\" class=\"btn btn-danger btn-sm\" id=\"".$Id."\" onclick=\"Eliminar(this.id)\">Eliminar</button>
        </div>
        </div>
        </div>
        </div>
        </div>
        ";
      }
    }else{
      $res="
      <div class=\"card\">
      <div class=\"card-body\">
      <div class=\"row\">
      <div class=\"col-3  d-flex justify-content-center d-flex flex-wrap align-content-center\">
      <img src=\"./adjuntos/"."".
      "\" width=\"200\" height=\"200\" alt=\"...\" class=\"img-thumbnail\">
      </div>
      <div class=\"col-6\">
      <h4 class=\"text-center\">"."No hay ninguna pelicula registrada"."</h4>
      <br>
      <h6 class=\"text-danger\">Clasificación: ".""."</h6>
      <h6>".""."</h6>
      </div>
      <div class=\"col-2  d-flex justify-content-center d-flex flex-wrap align-content-center\">
      <button type=\"button\" class=\"btn btn-primary btn-sm\"  onclick=\"Modificar()\">Modificar</button>
      </div>
      <div class=\"col-1  d-flex justify-content-center d-flex flex-wrap align-content-center\">
      <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"Eliminar()\">Eliminar</button>
      </div>
      </div>
      </div>
      </div>
      ";
    }

    return $res;
  }
  public function listar_busqueda_pelicula_controlador(){

    $bus=$_POST['id'];
    $res="";
    $Lista=mainModel::consulta_simple("Select * from peliculas");
    if ($Lista->rowCount()>=1) {
      while ($arr = $Lista->fetch(PDO::FETCH_ASSOC)) {
        $Id=$arr['pel_id'];
        $Nom=$arr['pel_nombre'];
        $Des=$arr['pel_des'];
        $Clase=$arr['pel_clase'];
        $Img=$arr['pel_img'];
        if ($bus=="") {
          $res=$res."
          <div class=\"card\">
          <div class=\"card-body\">
          <div class=\"row\">
          <div class=\"col-3  d-flex justify-content-center d-flex flex-wrap align-content-center\">
          <img src=\"./adjuntos/".$Img.
          "\" width=\"200\" height=\"200\" alt=\"...\" class=\"img-thumbnail\">
          </div>
          <div class=\"col-6\">
          <h4 class=\"text-center\">".$Nom."</h4>
          <br>
          <h6 class=\"text-danger\">Clasificación: ".$Clase."</h6>
          <h6>".$Des."</h6>
          </div>
          <div class=\"col-3  d-flex justify-content-center d-flex flex-wrap align-content-center\">
          <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
          <button type=\"button\" class=\"btn btn-primary btn-sm\" id=\"".$Id."\" onclick=\"Modificar(this.id)\">Modificar</button>
          <button type=\"button\" class=\"btn btn-danger btn-sm\" id=\"".$Id."\" onclick=\"Eliminar(this.id)\">Eliminar</button>
          </div>
          </div>
          </div>
          </div>
          </div>
          ";
        }else {
          if (strpos(strtolower($Nom),strtolower($bus)) !== false) {
            $res=$res."
            <div class=\"card\">
            <div class=\"card-body\">
            <div class=\"row\">
            <div class=\"col-3  d-flex justify-content-center d-flex flex-wrap align-content-center\">
            <img src=\"./adjuntos/".$Img.
            "\" width=\"200\" height=\"200\" alt=\"...\" class=\"img-thumbnail\">
            </div>
            <div class=\"col-6\">
            <h4 class=\"text-center\">".$Nom."</h4>
            <br>
            <h6 class=\"text-danger\">Clasificación: ".$Clase."</h6>
            <h6>".$Des."</h6>
            </div>
            <div class=\"col-3  d-flex justify-content-center d-flex flex-wrap align-content-center\">
            <div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
            <button type=\"button\" class=\"btn btn-primary btn-sm\" id=\"".$Id."\" onclick=\"Modificar(this.id)\">Modificar</button>
            <button type=\"button\" class=\"btn btn-danger btn-sm\" id=\"".$Id."\" onclick=\"Eliminar(this.id)\">Eliminar</button>
            </div>
            </div>
            </div>
            </div>
            </div>
            ";
          }
        }
      }
    }else{
      $res="
      <div class=\"card\">
      <div class=\"card-body\">
      <div class=\"row\">
      <div class=\"col-3  d-flex justify-content-center d-flex flex-wrap align-content-center\">
      <img src=\"./adjuntos/"."".
      "\" width=\"200\" height=\"200\" alt=\"...\" class=\"img-thumbnail\">
      </div>
      <div class=\"col-6\">
      <h4 class=\"text-center\">"."No hay ninguna pelicula registrada"."</h4>
      <br>
      <h6 class=\"text-danger\">Clasificación: ".""."</h6>
      <h6>".""."</h6>
      </div>
      <div class=\"col-2  d-flex justify-content-center d-flex flex-wrap align-content-center\">
      <button type=\"button\" class=\"btn btn-primary btn-sm\"  onclick=\"Modificar()\">Modificar</button>
      </div>
      <div class=\"col-1  d-flex justify-content-center d-flex flex-wrap align-content-center\">
      <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"Eliminar()\">Eliminar</button>
      </div>
      </div>
      </div>
      </div>
      ";
    }

    return $res;
  }
  public function listar_titulos_pelicula_controlador(){
    $res="";
    $num=0;
    $Lista=mainModel::consulta_simple("SELECT pel_nombre FROM peliculas");
    if ($Lista->rowCount()>=1) {
      while ($arr = $Lista->fetch(PDO::FETCH_ASSOC)) {
        $Nom=$arr['pel_nombre'];
        $res=$res.$Nom.",";
        $num=$num+1;
      }
    }else{
      $res="No hay peliculas";
    }
    $res = substr($res, 0, -1)."";
    $json = json_encode($res);
    return $json;
  }
  function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
    $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
  }
}


?>
