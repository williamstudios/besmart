<?php
include_once"conect.php";
session_start();

if (empty($_SESSION["user"])) {
  header ("location: index.php");
} else {
  $id_cliente = $_SESSION["user"];
}
?>


          <div class="col-md-12">
            <form action="greporte.php" method="post">
            <div class="card">
              <div class="card-header"><strong>Nueva peticion</strong><small></small></div>
              <div class="card-body card-block">
                <div class="form-group col-md-12 col-lg-6">
                  <label for="company" class="typeahead form-control-label">Nombre completo</label>
                  <div class="autocomplete">
                    <input type="hidden" name="repetido" id="repetido" value="">
                    <input class="form-control" type="text" name="nom" id="nuser" placeholder="Nombre" onkeypress="buscando(this.value)" autocomplete="off" required>
                  </div>
                  <script type="text/javascript">
                    function buscando(valor){
                      if (valor.length > 1) {
                      var url = "repeticiones.php?nombre=" + valor; // El script a dónde se realizará la petición.
                      $.ajax({
                         url: url,
                         beforeSend: function () {

                         },
                         success: function(data) {
                          $("#tablas").html(data);
                         }, error:  function(data){
                          $("#tablas").html("");
                         }
                      });
                      $("#repetido").val("");
                      var url = "repeticion.php?nombre=" + valor; // El script a dónde se realizará la petición.
                      $.ajax({
                         url: url,
                         beforeSend: function () {

                         },
                         success: function(data) {
                          $("#nombres").html(data);
                         }, error:  function(data){
                          $("#nombres").html("");
                         }
                      });
                      }
                      if (valor == "") {
                        $("#tablas").html("");
                      }
                    }
                  </script>
                </div>

                <div class="form-group col-md-12 col-lg-6">
                  <label for="company" class=" form-control-label">Colonia</label>
                  <input class="form-control" type="text" name="Colonia" id="colonia" placeholder="Colonia" autocomplete="off" onkeypress="buscando2(this.value)" required>
                  <script type="text/javascript">
                    function buscando2(valor){

                      if (valor.length > 1) {
                      var url = "repeticiones.php?colonia=" + valor; // El script a dónde se realizará la petición.
                      $.ajax({
                         url: url,
                         beforeSend: function () {

                         },
                         success: function(data) {
                          $("#tablas").html(data);
                         }, error:  function(data){
                          $("#tablas").html("");
                         }
                      });

                      }
                      if (valor == "") {
                        $("#tablas").html("");
                      }
                    }
                  </script>
                </div>
                <div class="form-group col-md-12 col-lg-12" id="nombres">

                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Calle</label>
                  <input class="form-control" type="text" name="calle" id="calle" placeholder="Calle" autocomplete="off" onkeypress="buscando3(this.value)" required>
                  <script type="text/javascript">
                    function buscando3(valor){

                      if (valor.length > 1) {
                      var url = "repeticiones.php?calle=" + valor; // El script a dónde se realizará la petición.
                      $.ajax({
                         url: url,
                         beforeSend: function () {

                         },
                         success: function(data) {
                          $("#tablas").html(data);
                         }, error:  function(data){
                          $("#tablas").html("");
                         }
                      });

                      }
                      if (valor == "") {
                        $("#tablas").html("");
                      }
                    }
                  </script>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Numero</label>
                  <input class="form-control" type="text" name="numero" id="numero" placeholder="Numero" >
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Telefono</label>
                  <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Telefono" autocomplete="off" required>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Correo</label>
                  <input class="form-control" type="text" name="correo" id="Correo" placeholder="Correo" autocomplete="off" required>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Departamento</label>
                  <select class="form-control select2" name="departamento">
                    <option value="">Seleccionar</option>
                    <?php
                    $depas = mysqli_query($con, "SELECT id, Nombre FROM Departamentos WHERE id_cliente = '$id_cliente' ORDER BY Nombre ASC");
                    while ($rdepas = mysqli_fetch_assoc($depas)) {
                      echo '<option value="' . $rdepas["id"] .'">' . $rdepas["Nombre"] .'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Falla</label>
                  <select class="form-control select2" name="usuario">
                    <option value="">Seleccionar</option>
                    <?php
                    $depas = mysqli_query($con, "SELECT id, NombreNombre FROM Fallas WHERE id_cliente = '$id_cliente' ORDER BY NombreNombre ASC");
                    while ($rdepas = mysqli_fetch_assoc($depas)) {
                      echo '<option value="' . $rdepas["id"] .'">' . $rdepas["NombreNombre"] .'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-12 col-lg-12">
                  <label for="company" class=" form-control-label">Descripcion de reporte</label>
                  <textarea name="reporte" rows="2" class="form-control" required></textarea>
                </div>
                <div class="form-group col-md-12 col-lg-12" id="tablas">

                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                  <i class="fa fa-dot-circle-o"></i> Guardar
                </button>
              </div>
            </div>
            </form>
          </div>

<?php
mysqli_close($con);
?>
