<?php
if (strpos($_GET['views'], '/') !== false) {
  $ruta=explode("/", $_GET['views']);
  //echo $ruta[1];
} else {
  header('Location:'.SERVERURL);
}
?>
<img src=""  onerror="ConsultaPelis(<?php echo $ruta[1];?>)"alt="">

<div class="container">
  <div class="col-8 offset-2">
    <div class="col-8 offset-2 mx-auto">
      <h3>Actualizar una película</h3>
    </div>
    <br><br><br>
    <form type="post" action="<?php echo SERVERURL;?>ajax/peliculasAjax.php?operacion=actualizarPelicula" data-form="save" class="FormularioAjax" id="uploadForm"  enctype="multipart/form-data">
      <input type="hidden" id="Id" name="Id" value="<?php echo $ruta[1]; ?>">
      <div class="form-group">
        <div class="row">
          <div class="col">
            <label class="font-weight-bold" for="lblNombreAct">Nombre actual de la película</label>
            <input type="text" readonly class="form-control-plaintext text-primary" id="lblNombreAct" value="<?php echo('Hola');?>">
          </div>
          <div class="col">
            <label for="lblNombre">Nombre de la película</label>
            <input type="text" class="form-control" name="lblNombre" id="lblNombre" data-html="true" required pattern="[A-Z0-9][A-Za-z0-9' óíúñáé]{1,59}"
            title="Primera letra mayúscula o numero.
            Solo números, letras y apostrofes
            Tamaño mínimo: 2. Tamaño máximo: 60" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label class="font-weight-bold" for="lblSinopsisAct">Sinopsis actual</label>
          <div class="des text-primary" >

          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="lblSinopsis">Sinopsis</label>
            <textarea class="form-control" name="lblSinopsis" id="lblSinopsis" rows="5" required pattern="[A-Z0-9][A-Za-z0-9',óíúñáé.() \n]{39,499}"
            title="Primera letra mayúscula o numero. Solo números, letras , y los siguientes caracteres(',óíúñáé.())
            Tamaño mínimo: 40. Tamaño máximo: 500"
            ></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label  class="font-weight-bold" for="lblClaseAct">Clasificación actual</label>
          <input type="text" readonly class="form-control-plaintext text-primary" id="lblClaseAct" value="<?php echo('B15');?>">
        </div>
        <div class="col">
          <div class="form-group">
            <label for="lblClase">Clasificación</label>
            <label>
              <a tabindex="0" id="popover" class="btn" role="button"
              data-toggle="popover" data-trigger="focus" title="Clasificación por edades"
              data-content="
              <b>AA</b> Todos los públicos pueden ver. <br />
              <b>A</b> Mayores de 6 años. <br />
              <b>B</b> Para adolescentes de 12 años en adelante. <br />
              <b>B15</b>  Para mayores de 15 años, menores requieren supervisión. <br />
              <b>C</b> Para adultos, apto para mayores de 18 años. <br />
              <b>D</b>  Exclusivamente adultos. Los cines no aceptan menores de 18 años.
              Esta clasificación es casi igual a la anterior, con la diferencia de que es
              aplicada a contenido con lenguaje soez sin censura, adicciones explícitas,
              mayor desnudez o violencia extrema."
              data-html="true"> <i class="fas fa-info-circle"></i></a>
            </label>
            <select class="form-control" name="lblClase" id="lblClase">
              <option>AA</option>
              <option>A</option>
              <option>B</option>
              <option>B15</option>
              <option>C</option>
              <option>D</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <label class="font-weight-bold" for="lblImgAct">Imagen actual</label>
          <img class="mx-auto d-block" id="imgAct" width="80%" height="80%" src="" />
        </div>
        <div class="col-6">
          <div class="form-group mx-auto d-block">
            <label for="file-input">Imagen</label> <br>
            <input name="file-input" name="file-input" id="file-input" type="file" required  />
            <br />
            <img class="mx-auto d-block" id="imgSalida" width="80%" height="80%" src="" />
            <div class="text-danger" id="Error"></div>
            <div class="text-success" id="Bien"></div>
          </div>
        </div>
      </div>
      <button class="btn btn-primary btn-block" id="Act" type="submit">Actualizar <i class="fas fa-arrow-right"></i></button>
      <div class="RespuestaAjax">

      </div>
    </form>
  </div>
</div>
