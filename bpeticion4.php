<?php
include_once"conect.php";
session_start();

if (empty($_SESSION["user"])) {
  header ("location: index.php");
} else {
  $id_cliente = $_SESSION["user"];
}
?>


                <?php
                $id = addslashes($_GET["id"]);
                $buscarp = mysqli_query($con, "SELECT * FROM peticiones WHERE id_cliente = '$id_cliente' AND id = '$id'");
                $rbusca = mysqli_fetch_assoc($buscarp);
                ?>
                <div class="form-group col-md-12 col-lg-6">
                  <label for="company" class="typeahead form-control-label">Nombre completo</label>
                  <div class="autocomplete">
                    <input type="hidden" name="peticion" value="<?php echo $id; ?>" >
                    <input value="<?php echo $rbusca["nombre"]; ?>" class="form-control" type="text" name="nom" id="nuser" placeholder="Nombre" autocomplete="off" disabled>
                  </div>
                </div>

                <div class="form-group col-md-12 col-lg-6">
                  <label for="company" class=" form-control-label">Colonia</label>
                  <input value="<?php echo $rbusca["colonia"]; ?>" class="form-control" type="text" name="Colonia" id="colonia" placeholder="Colonia" autocomplete="off" onkeypress="buscando2(this.value)" disabled>
                </div>

                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Calle</label>
                  <input class="form-control" value="<?php echo $rbusca["calle"]; ?>" type="text" name="calle" id="calle" placeholder="Calle" autocomplete="off" onkeypress="buscando3(this.value)" disabled>

                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Numero</label>
                  <input class="form-control" value="<?php echo $rbusca["numero"]; ?>" type="text" name="numero" id="numero" placeholder="Numero" disabled>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Telefono</label>
                  <input class="form-control" type="text" value="<?php echo $rbusca["telefono"]; ?>" name="telefono" id="telefono" placeholder="Telefono" autocomplete="off" disabled>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Correo</label>
                  <input class="form-control" type="text" value="<?php echo $rbusca["correo"]; ?>" name="correo" id="Correo" placeholder="Correo" autocomplete="off" disabled >
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Departamento</label>
                  <select class="form-control select2" name="departamento" disabled>
                    <option value="">Seleccionar</option>
                    <?php
                    $depas = mysqli_query($con, "SELECT id, Nombre FROM Departamentos WHERE id_cliente = '$id_cliente' ORDER BY Nombre ASC");
                    while ($rdepas = mysqli_fetch_assoc($depas)) {
                      if ($rdepas["id"] == $rbusca["departamento_asignado"]) {
                        $selected = "selected";
                      } else {
                        $selected = "";
                      }
                      echo '<option value="' . $rdepas["id"] .'" ' . $selected . '>' . $rdepas["Nombre"] .'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-12 col-lg-4">
                  <label for="company" class=" form-control-label">Falla</label>
                  <select class="form-control select2" name="falla" disabled>
                    <option value="">Seleccionar</option>
                    <?php
                    $depas = mysqli_query($con, "SELECT id, NombreNombre FROM Fallas WHERE id_cliente = '$id_cliente' ORDER BY NombreNombre ASC");
                    while ($rdepas = mysqli_fetch_assoc($depas)) {
                      if ($rdepas["id"] == $rbusca["falla"]) {
                        $selected = "selected";
                      } else {
                        $selected = "";
                      }
                      echo '<option value="' . $rdepas["id"] .'" ' . $selected . '>' . $rdepas["NombreNombre"] .'</option>';
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group col-md-12 col-lg-12">
                  <label for="company" class=" form-control-label">Descripcion de reporte</label>
                  <textarea name="reporte" rows="2" class="form-control" disabled><?php echo $rbusca["Descripcion"]; ?></textarea>
                </div>
                <div class="form-group col-md-4 col-lg-4">
                  <label for="company" class=" form-control-label">Asignado</label>
                  <select class="form-control select2" name="asignado" disabled>
                    <option value="">Seleccionar</option>
                    <?php
                    $depas = mysqli_query($con, "SELECT id, Nombre, AppelidoP, AppelidoM FROM Usuarios_APP WHERE id_cliente = '$id_cliente' ORDER BY Nombre ASC");
                    while ($rdepas = mysqli_fetch_assoc($depas)) {
                      if ($rdepas["id"] == $rbusca["usuario_asignado"]) {
                        $selected = "selected";
                      } else {
                        $selected = "";
                      }
                      echo '<option value="' . $rdepas["id"] .'" ' . $selected . '>' . $rdepas["Nombre"] .' ' . $rdepas["AppelidoP"] . ' ' . $rdepas["AppelidoM"] .'</option>';
                    }
                    ?>
                  </select>
                 </div>
                 <div class="form-group col-md-4 col-lg-4">
                   <label for="company" class=" form-control-label">Costo munucipio</label>
                   <input class="form-control" type="text" value="0" name="municipio" id="municipio" placeholder="Costo toal" required>
                 </div>
                 <div class="form-group col-md-4 col-lg-4">
                   <label for="company" class=" form-control-label">Costo ciudadano</label>
                   <input class="form-control" type="text" value="0" name="ciudadano" id="ciudadano" placeholder="Costo toal" required>
                 </div>
                 <?php
                 $barchivos = mysqli_query($con, "SELECT * FROM archivos WHERE id_peticion = '$id'");
                 $carch = 1;
                 while ($rarchivos = mysqli_fetch_assoc($barchivos)) {
                   $click = "window.open('" . $rarchivos["ruta"] . "', 'Archivo', 'width=600,height=700')";
                   echo '<div class="form-group col-md-2 col-lg-2">
                   <button type="button" name="button" class="btn btn-link" onclick="' . $click. '">Archivo' . $carch . '</button>
                   </div>';
                   $carch++;
                 }

                 ?>

                 <div class="col-md-12">

                   <nav>
                     <div class="nav nav-tabs" id="nav-tab" role="tablist">
                       <a onclick="ocultalos(1)" class="nav-item nav-link active" id="panelu" data-toggle="tab" href="#panelu" role="tab" aria-controls="nav-home" aria-selected="true">Articulos</a>
                       <a onclick="ocultalos(2)"  class="nav-item nav-link" id="paneld" data-toggle="tab" href="#paneld" role="tab" aria-controls="nav-profile" aria-selected="false">Cuadrilla</a>
                       <a onclick="ocultalos(3)"  class="nav-item nav-link" id="panelt" data-toggle="tab" href="#panelt" role="tab" aria-controls="nav-contact" aria-selected="false">Vehículos</a>
                     </div>
                   </nav>
                 <script type="text/javascript">
                   function ocultalos(valor) {
                     $(".paneles").hide();
                     $(".paneles" + valor).show();
                   }
                 </script>
                 <div class="row paneles paneles1 col-md-12" id="panel1">
                   <button type="button" name="button" onclick="tablaarts()" class="btn btn-link">Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                   <table id="artstable" class="table-responsive">
                       <tr>
                           <th></th>
                           <th>Concepto</th>
                           <th>Cantidad</th>
                           <th>Costo</th>
                       </tr>
                       <?php
                       $depas = mysqli_query($con, "SELECT conc.*, arts.costo, arts.Nombre AS nameart  FROM conceptos AS conc INNER JOIN Articulos AS arts ON conc.id_con = arts.id WHERE id_peticion = '$id' ORDER BY Nombre ASC");
                       while ($rdepas = mysqli_fetch_assoc($depas)) {
                         $total = $rdepas["costo"] *  $rdepas["cantidad"];
                         echo '<tr>
                           <td></td>
                           <td>' . $rdepas["nameart"] .'</td>
                           <td>' . $rdepas["cantidad"] .'</td>
                           <td>$ ' . $total .'</td>
                         </tr>';
                       }
                       ?>
                   </table>
                   <script type="text/javascript">
                     var cantarts = 0;
                     function tablaarts(){
                       var newdiv = document.createElement('tr');
                       newdiv.setAttribute("id", "tr" + cantarts);
                       newdiv.innerHTML = '<td><a href="#" onclick="elimina('+ cantarts +', 2)" ><i class="fa fa-window-close-o" aria-hidden="true"></i></td><td><select class="js-salida' +  cantarts +'" name="art' +  cantarts +'" style="width:100%;"></select></td><td><input type="number" name="cconcepto'+cantarts+'" value="1" class="form-control" placeholder="Cantidad" step="any"></td><td></td>';
                       document.getElementById("artstable").appendChild(newdiv);

                       $(".js-salida" + cantarts).select2({
                        ajax: {
                            url: "barticle.php",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term // search term
                                };
                            },
                            processResults: function (data) {
                                // parse the results into the format expected by Select2.
                                // since we are using custom formatting functions we do not need to
                                // alter the remote JSON data
                                return {
                                    results: data
                                };
                            },
                            cache: true
                        },
                        minimumInputLength: 2
                        });

                        $(".select2-selection").height(36);
                        cantarts++;

                     }
                     function elimina(valor){
                        $("#tr" + valor).remove();
                     }
                   </script>
                 </div>
                 <div class="row paneles paneles2 col-md-12" id="panel2" style="display:none;">
                   <button type="button" name="button" onclick="addcuadrilla()" class="btn btn-link">Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i></button>

                   <table id="tablacuadrillas" class="table-responsive">
                     <thead>
                         <tr>
                           <th></th>
                           <th>Cuadrilla</th>
                           <th>Lider</th>
                         </tr>
                     </thead>
                     <input type="hidden" name="lider" value="" id="lider" >

                     <tbody>
                       <?php
                       $depas = mysqli_query($con, "SELECT cuad.*, emple.Nombre AS emplename FROM cuadrillas AS cuad INNER JOIN empleados AS emple ON cuad.id_cuad = emple.id WHERE cuad.id_peticion = '$id'");
                       $contad = 1;
                       while ($rdepas = mysqli_fetch_assoc($depas)) {
                         echo '<tr>
                           <td></td>
                           <td>' . $rdepas["emplename"] .'</td>
                           <td><input type="checkbox" value="' . $rdepas["id_cuad"] .'" onchange="ellider(this.value, this.id)" class="lideres" id="li' . $contad .'"></td>
                         </tr>';
                         $contad++;
                       }
                       ?>
                     </tbody>
                   </table>
                   <script type="text/javascript">
                     function ellider(valor, tr, valo){
                      $( ".lideres" ).prop( "checked", false );
                      $( "#li" +  valor).prop( "checked", true );
                       $("#lider").val(valor);

                     }

                     function ellider2(valor){
                      $( ".lideres" ).prop( "checked", false );
                      $( "#lid" +  valor).prop( "checked", true );
                      var elselect = document.getElementById("js-salida"  + valor);
                      var valselect = elselect.options[elselect.selectedIndex].value;
                      $("#lider").val(valselect);
                     }
                     function addcuadrilla(){
                       var newdiv = document.createElement('tr');
                       newdiv.setAttribute("id", "tr" + cantarts);
                       newdiv.innerHTML = '<td><a href="#" onclick="elimina('+ cantarts +', 2)" ><i class="fa fa-window-close-o" aria-hidden="true"></i></td><td><select id="js-salida'+ cantarts +'" class="js-salida' +  cantarts +'" name="cuadril' +  cantarts +'" style="width:100%;"></select></td><td><input type="checkbox" value="" onchange="ellider2(' + cantarts + ')" class="lideres" id="lid' + cantarts +'"></td>';
                       document.getElementById("tablacuadrillas").appendChild(newdiv);

                       $(".js-salida" + cantarts).select2({
                        ajax: {
                            url: "bcuadrilla.php",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term // search term
                                };
                            },
                            processResults: function (data) {
                                // parse the results into the format expected by Select2.
                                // since we are using custom formatting functions we do not need to
                                // alter the remote JSON data
                                return {
                                    results: data
                                };
                            },
                            cache: true
                        },
                        minimumInputLength: 2
                        });

                        $(".select2-selection").height(36);
                        cantarts++;

                     }

                   </script>
                 </div>
                 <div class="row paneles paneles3 col-md-12" id="panel3" style="display:none;">
                   <button type="button" name="button" onclick="addvehi()" class="btn btn-link">Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i></button>

                   <table id="vehitabla" class="table-responsive">
                     <thead>
                       <tr>
                           <th></th>
                           <th>Vehículo</th>
                           <th>kilometraje</th>
                           <th>Gasolina</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php
                       $depas = mysqli_query($con, "SELECT kilo.*, aut.Nombre FROM kilometrajes AS kilo INNER JOIN Autos AS aut ON kilo.id_auto = aut.id WHERE kilo.id_peticion = '$id'");
                       while ($rdepas = mysqli_fetch_assoc($depas)) {
                         echo '<tr>
                           <td></td>
                           <td>' . $rdepas["Nombre"] .'</td>
                           <td> ' . $rdepas["km"] .'</td>
                           <td>$ ' . $rdepas["costo"] .'</td>
                         </tr>';
                       }
                       ?>
                     </tbody>
                   </table>
                   <script type="text/javascript">
                     function addvehi(){
                       var newdiv = document.createElement('tr');
                       newdiv.setAttribute("id", "tr" + cantarts);
                       newdiv.innerHTML = '<td><a href="#" onclick="elimina('+ cantarts +', 2)" ><i class="fa fa-window-close-o" aria-hidden="true"></i></td><td><select class="js-salida' +  cantarts +'" name="vehi' +  cantarts +'" style="width:100%;"></select></td><td><input type="number" name="km'+cantarts+'" value="0" class="form-control" placeholder="KM." step="any"></td><td><input type="number" name="costo'+cantarts+'" value="0" class="form-control" placeholder="Costo" step="any"></td>';
                       document.getElementById("vehitabla").appendChild(newdiv);

                       $(".js-salida" + cantarts).select2({
                        ajax: {
                            url: "bauto.php",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term // search term
                                };
                            },
                            processResults: function (data) {
                                // parse the results into the format expected by Select2.
                                // since we are using custom formatting functions we do not need to
                                // alter the remote JSON data
                                return {
                                    results: data
                                };
                            },
                            cache: true
                        },
                        minimumInputLength: 2
                        });

                        $(".select2-selection").height(36);
                        cantarts++;

                     }

                   </script>
                 </div>

                 </div>




                <script type="text/javascript">
                $( document ).ready(function() {
                  var status = <?php echo $rbusca["status"]; ?>;
                  if (status == 3) {
                    $("#reasignar").hide();
                  } else if (status == 4) {
                    $("#reasignar").hide();
                  } else {
                    $("#reasignar").show();
                  }
                });
                  reasignar
                </script>


<?php
mysqli_close($con);
?>
