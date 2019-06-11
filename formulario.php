<?php

session_start();

if (isset($_SESSION['rut']) and isset($_SESSION['dv']))
   {
  $sesion="ok";
   }else{
  $sesion="nok";
   }


if(isset($_GET["aviso"]))
      {$aviso_encuesta = $_GET["aviso"];}
      else{$aviso_encuesta = "";}

      require_once 'administrador/includes/default.php';
      require_once 'administrador/models/socio.php';
      require_once 'administrador/models/prelacion.php';

      $socio = new socio();
      $prelacion = new prelacion();

      $socio_rut_completo = $socio->consultaSocioRut($_SESSION['rut'],$_SESSION['dv']);

      ?>
<html>

<head><title>Beneficio Prelación Avanza</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="lautaro_icono.ico">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>




<style type="text/css">

@import url('https://fonts.googleapis.com/css?family=Pavanam');

body{

	text-align: center;

}

p{
  color:#898989;
  font-size:22px;
	font-family: 'Pavanam', sans-serif;
  font-style: bold;
	margin-left:30px;

}

ul{
  color:#898989;
  font-size:22px;
	font-family: 'Pavanam', sans-serif;
  font-style: bold;
	margin-left:35%;
  text-align:left;

}

#tabla{

  background-color:#FFFFFF;
	position: absolute;
	left: 450px;
	top: -10px;*/
	width: 910px;


}

th{
  text-align: center;
}

#enviar{
  background-color: #e7e7e7; color: #0A3782;
  border: none;
  padding: 15px 25px;
  width: 250px;
  height:120px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 28px;
  font-style: bold;
  border-radius: 10px;
}

#hint{
  color: darkgray;
  font-style: italic;
  font-size: 17px;
  text-align: center;
}


.disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

</style>

<?php if($aviso_encuesta!=''){ ?>

<script type="text/javascript">
var timeoutId  = setTimeout(mostrarAlerta, 500);
var timeoutId2 = setTimeout(ocultarAlerta,3000);

</script>
<!-- fin -->
<?php }else{} ?>


</head>

<body>

<form action="certificado.php" method="post" id="formulario"  onSubmit='return Validar(this);'>

<?php

 $cantidad_solicitud = "";
 $num = 0;
 $contador = $prelacion->Validacion_Datos($_SESSION['nrosocio']);
 $mostrar_tabla_solicitudes = false;

 while($row = mysql_fetch_array($contador)){
   $num = $row['numero'];
 }

 $consulta_activa = $prelacion->consultSolicitudesCapitalPorSocio($_SESSION['nrosocio']);
 $num_registros = mysql_num_rows($consulta_activa);


 if($num == 0){
   $cantidad_solicitud = "Lamentablemente no puede optar al beneficio por alguno de los siguientes motivos:
   <br>
   <ul align='left'>
   <li>Si usted no posee solicitudes de prelación vigentes.</li>
   <li>Si sus montos solicitados superan los $500.000 pesos.</li>
   <li>Si ha recibido alguna ayuda social.</li>
   <li>Si usted tiene menos de un año iniciado su primera solicitud.</li>
   </ul>";
   $mostrar_tabla_solicitudes = false;
 } elseif ($num == 1) {
   $cantidad_solicitud = "Seleccione la solicitud de la cual desea desistir para optar al beneficio:";
   $mostrar_tabla_solicitudes = true;
 } else {
   $cantidad_solicitud = "Seleccione las solicitudes de las cuales desea desistir para optar al beneficio:";
   $mostrar_tabla_solicitudes = true;
 }

?>

<div class="col-md-2">
  <img src="img\encabezado1.jpg" alt="Lights" width="400" style="margin-left:150px;">
</div>

 <br>

 <div class="col-md-12">
    <p> <?=$cantidad_solicitud?> </p>
 </div>
 <table style="width: 40%;" class="table table-condensed table-bordered table-hover" id="dynamic-table"  onchange="sumarMontos()" align="center">

    
    <?php if($mostrar_tabla_solicitudes){?>
      <thead>
        <th></th>
        <th>ID Solicitud</th>
        <th>Monto</th>
        <th>Fecha de emisión</th>
      </thead>
      
      <tbody>
          <?php
          while($row = mysql_fetch_array($consulta_activa))
          {
            echo '<tr>';

              echo '<td><input type="checkbox" name="solicitud" value='.$row["monto"].'></td>';
              echo '<td align="center">'.$row['id_solicitud'].'<input type="text" name="id_solicitud_input" id="id_solicitud_input" value="'.$row['id_solicitud'].'" hidden></td>';
              echo '<td align="center">$ '. number_format($row["monto"], 0, ',', '.').'</td>';
              echo '<td align="center">'.date('d-m-Y',strtotime($row['fecha_solicitud'])).'<input type="text" name="fecha_solicitud_input" id="fecha_solicitud_input" value="'.$row['fecha_solicitud'].'" hidden>
              </td>';
            echo '</tr>';
          }
          ?>
    <tr align="center">
        
          <p id="monto_sumado"></p>
          <input type="text" name="monto_sumado_input" id="monto_sumado_input" hidden>
          <!-- <p id="ok" class="alert alert-success col-md-6" hidden></p>
          <p id="notok" class="alert alert-danger col-md-6" hidden></p> -->
         
    </tr>
  <?php }?>

</tbody>
</table>
<br>
<div class="col-md-12" align="center">
    <hr><br>

  <button type="submit" id="enviar" disabled hidden onclick="alerta()">
    Sí, quiero optar a este beneficio
  </button>
</div>

</form>

</body>

<script language="javascript" src="administrador\actions-js\action.js"></script>

  <script language="javascript" type="text/javascript"> 
  function alerta(){

    alert("Estimado socio: \n\n Hemos cursado su solicitud con éxito.\n Pronto nos contactaremos con usted.");
  }
    </script>


</html>
