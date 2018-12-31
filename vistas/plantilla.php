<?php
$peticionAjax=false;
require_once "./core/configAPP.php";
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo SERVERURL;?>vistas/css/bootstrap.min.css" >
  <link rel="stylesheet" href="<?php echo SERVERURL;?>vistas/css/style.css" >
  <link rel="stylesheet" href="<?php echo SERVERURL;?>vistas/css/sweetalert2.min.css">
  <link rel="stylesheet" href="<?php echo SERVERURL;?>vistas/css/jquery.auto-complete.css">
  <title>Sistema películas!</title>
</head>
<body>
  <div class="wrapper">
    <?php
    require_once "./controladores/vistasControlador.php";
    $vt = new vistasControlador();
    $vistasR=$vt->obtener_vistas_controlador();
    function debug_to_console( $data ) {
      $output = $data;
      if ( is_array( $output ) )
      $output = implode( ',', $output);

      echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }
    ?>
    <!-- Sidebar  -->
    <?php include "modulos/sideMenu.php"; ?>
    <!-- Page Content  -->
    <div id="content">
      <?php
      include "modulos/navBar.php";
      if ($vistasR=="home") {
        require_once "./vistas/contenido/home-view.php";
      } else {
        require_once $vistasR;
      }
      ?>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="<?php echo SERVERURL;?>vistas/js/jquery-3.3.1.min.js" ></script>
  <script src="<?php echo SERVERURL;?>vistas/js/popper.min.js" ></script>
  <script src="<?php echo SERVERURL;?>vistas/js/bootstrap.min.js" ></script>
  <script src="<?php echo SERVERURL;?>vistas/js/sweetalert2.min.js"></script>
  <script src="<?php echo SERVERURL;?>vistas/js/main.js"></script>
  <script src="<?php echo SERVERURL;?>vistas/js/jquery.auto-complete.min.js" ></script>
  <script type="text/javascript">
  $(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
    });
  });
  </script>
  <script>
  // Validación del textarea
  $( document ).ready( function() {
    var errorMessage = "Ajústese al formato solicitado: Primera letra mayúscula o numero.Solo números, letras , y los siguientes caracteres(',óíúñáé.()) .Tamaño mínimo: 40. Tamaño máximo: 500";
    $( this ).find( "textarea" ).on( "input change propertychange", function() {
      var pattern = $( this ).attr( "pattern" );
      if(typeof pattern !== typeof undefined && pattern !== false)
      {
        var patternRegex = new RegExp('^' + pattern.replace(/^\^|\$$/g, '') + '$', 'g');
        hasError = !$( this ).val().match( patternRegex );
        if ( typeof this.setCustomValidity === "function"){
          this.setCustomValidity( hasError ? errorMessage : "" );
        }
        else{
          $( this ).toggleClass( "error", !!hasError );
          $( this ).toggleClass( "ok", !hasError );
          if ( hasError )  {
            $( this ).attr( "title", errorMessage );
          }
          else{
            $( this ).removeAttr( "title" );
          }
        }
      }
    });
  });

  </script>
  <script type="text/javascript">
  function EstaValiado(){
    var forms = document.getElementsByClassName('FormularioAjax');
    console.log(forms[0].checkValidity());
    if (forms[0].checkValidity() === false) {
      return false;
    }
    return true;
  }
  </script>
  <script type="text/javascript">
  function ListaPelis(){
    $.ajax({
      url: '<?php echo SERVERURL; ?>/ajax/peliculasAjax.php?operacion=consultaTotal',
      success: function(respuesta) {
        var res = respuesta.substring(1, respuesta.length);
        $('.resp').html(res);

      },
      error: function(jqXHR,textStatus,errorThrown) {
        console.log("No se ha podido obtener la información"+jqXHR+textStatus+errorThrown);
        console.log('<?php echo SERVERURL; ?>ajax/peliculasAjax.php?operacion=consultaTotal');
      }
    });
  }
  function BusquedaPelis(){
     var x = $("#busqueda").val();
    var busqueda={
      "id":x
    };
    console.log(x);
    $.ajax({
      type:'post',
      url: '<?php echo SERVERURL; ?>/ajax/peliculasAjax.php?operacion=busqueda',
      data: busqueda,
      success: function(respuesta) {
        var res = respuesta.substring(1, respuesta.length);
        $('.resp').html(res);

      },
      error: function(jqXHR,textStatus,errorThrown) {
        console.log("No se ha podido obtener la información"+jqXHR+textStatus+errorThrown);
        console.log('<?php echo SERVERURL; ?>ajax/peliculasAjax.php?operacion=consultaTotal');
      }
    });
  }
  function ConsultaPelis(id){
    var dataID={
      "id":id
    };
    $.ajax({
      type:'post',
      url: '<?php echo SERVERURL; ?>/ajax/peliculasAjax.php?operacion=consultaSimple',
      data: dataID,
      success: function(respuesta) {
        var array = JSON.parse(respuesta)
        $('#imgAct').attr("src","<?php echo SERVERURL; ?>"+array['img']);
        $('#lblNombreAct').attr("value",array['nombre']);
        $('#lblNombre').attr("value",array['nombre']);
        $('.des').html(array['des']);
        document.getElementById("lblSinopsis").value = array['des'];
        $('#lblClaseAct').attr("value",array['clase']);
      },
      error: function( jqXHR, textStatus, errorThrown ) {
        console.log("No se ha podido obtener la información"+jqXHR+textStatus+errorThrown);

      }
    });
  }

  function Modificar(id){
    Swal({
      title: '¿Estas seguro?',
      text: "¿Deseas modificar este registro?",
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Vamos!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        location.href="modificacion/"+id;
      }
    })
  }
  function Eliminar(id){
    var dataID={
      "id":id
    };
    Swal({
      title: '¿Estas seguro?',
      text: "No puedes revertir esta acción!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminalo!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          url: './ajax/peliculasAjax.php?operacion=eliminaPelicula',
          data: dataID,
          success: function(respuesta) {
            $('.RespuestaAjax').html(respuesta);
            ListaPelis();
          },
          error: function() {
            $('.RespuestaAjax').html(respuesta);
            console.log("No se ha podido obtener la información");
          }
        });
      }
    })
  }
</script>
<!-- Previsualizar imagen-->
<script >
$(window).on('load', function(){
  $(function() {
    $('#file-input').change(function(e) {
      addImage(e);
    });
    function addImage(e){
      var file = e.target.files[0],
      imageType = /image.*/;
      if (!file.type.match(imageType))
      return;
      var reader = new FileReader();
      reader.onload = fileOnload;
      reader.readAsDataURL(file);
    }
    function fileOnload(e) {
      var result=e.target.result;
      $('#imgSalida').attr("src",result);
    }
  });
});
</script>
<!-- Valida imagen-->
<script>
$('#file-input').change( function() {
  if(this.files[0].size > 1024000) { // Valida el tamaño 1MB
    $(this).val('');
    $('#Error').html("El archivo supera el límite de peso permitido. 1 MB");
    $('#Bien').html("");
    $('#imgSalida').attr("src","");
  } else { //ok
    var formato = (this.files[0].name).split('.').pop();
    //alert(formato);
    if(formato.toLowerCase() == 'jpg' || formato.toLowerCase() == 'png' || formato.toLowerCase() == 'gif') {
      $('#Error').html("");
      $('#Bien').html("Correcto!");
    } else {
      $(this).val('');
      $('#Error').html("Formato no soportado.Solo jpg,png y gif");
      $('#Bien').html("");
      $('#imgSalida').attr("src","");
    }
  }
});
</script>
<script type="text/javascript">
$('#busqueda').autoComplete({
    source: function(term, response){
        $.getJSON('<?php echo SERVERURL; ?>/ajax/peliculasAjax.php?operacion=consultaTitulos', { q: term }, function(data){ var res = data.split(","); response(res); });
    },
    dataType: "jsonp"
});
$(function () {
  $('#popover').popover({
    container: 'body'
  })
})
</script>
</body>
</html>
