<?php

$nombres = addslashes($_GET["r"]);
if ($nombres == "correcto") {
  echo '<script type="text/javascript">
  $( document ).ready(function() {
    $.notify({
      // options
      message: "Registro exitoso"

      },{
      // settings
      type: "warning",
      placement: {
      from: "top",
      align: "center"
      },
      });
    });</script>';
}

if ($nombres == "bmail") {
  echo '<script type="text/javascript">
  $( document ).ready(function() {
    $.notify({
      // options
      message: "Enviamos tus datos al correo"

      },{
      // settings
      type: "warning",
      placement: {
      from: "top",
      align: "center"
      },
      });
    });</script>';
}
if ($nombres == "failmail") {
  echo '<script type="text/javascript">
  $( document ).ready(function() {
    $.notify({
      // options
      message: "Ocurrio un error al enviar tu dtos por favor intenta de nuevo"

      },{
      // settings
      type: "warning",
      placement: {
      from: "top",
      align: "center"
      },
      });
    });</script>';
}

if ($nombres == "errmail") {
  echo '<script type="text/javascript">
  $( document ).ready(function() {
    $.notify({
      // options
      message: "No encontramos tus datos registrados."

      },{
      // settings
      type: "warning",
      placement: {
      from: "top",
      align: "center"
      },
      });
    });</script>';
}
?>
