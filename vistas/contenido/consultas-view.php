<div class="container" >
  <div class="col-10 offset-1">
    <div class="col-12 bg-light" >
      <br>
      <form onsubmit="$('#busqueda').blur();return false;" class="form-inline" style="border-top: 1px solid #eee;border-bottom:1px solid #eee;background:#fafafa;margin:30px 0;padding:20px 10px;text-align:center">
          <input id="busqueda" name="busqueda" autofocus type="text" name="q" class=" form-control col-10" placeholder="Buscar..." style="width:100%;max-width:600px;outline:0">
          <button class="btn btn-outline-success col-2" onclick="BusquedaPelis()">Buscar</button>
      </form>
      <br>
    </div>

       <!-- Llama la funcion que carga las peliclas -->
    <img src=""  onerror="ListaPelis()"alt="">
    <div class="resp">
      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
      </div>
    </div>
    <div class="RespuestaAjax">

    </div>
  </div>
</div>
