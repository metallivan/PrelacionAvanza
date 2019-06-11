

<?php if(isset($_GET["aviso"]))
      {$aviso_encuesta = $_GET["aviso"];}
      else{$aviso_encuesta = "";}

      require_once 'administrador/models/socio.php';
      require_once 'administrador/models/prelacion.php';

      $socio = new socio();
      $prelacion = new prelacion();

      ?>
<html>

<head><title>Beneficio Prelación Avanza modificaciones de rama1</title>

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

img{
  width:1000px;
}

p{
  color:#898989;
  font-size:22px;
	font-family: 'Pavanam', sans-serif;
  text-align:center;
  font-style: bold;
	margin-left:30px;

}


#tabla{

  background-color:#FFFFFF;
	position: absolute;
	left: 450px;
	top: -10px;
	width: 910px;


}

#enviar{
  border: 0;
  background-color: transparent;
  cursor: pointer;
}

#hint{
  color: darkgray;
  font-style: italic;
  font-size: 17px;
  text-align: center;
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

<form action="redireccion.php" method="post" id="formulario"  onSubmit='return Validar(this);' enctype="multipart/form-data">


<div class="table-responsive">

  <table border="0" style="margin: 0 auto;" cellspacing="1" cellpadding="1" >

    <tbody>
        <tr>
          <td colspan="2">
              <img src="https://www.lautarorosas.cl/mailing/2019/beneficio_prelacion_avanza/imagenes/form-top.jpg" >
          </td>
        </tr>
        <tr>
          <td height="50" colspan="2" align="center">
          <?php switch($aviso_encuesta){
                            case '':

                          break; case 'ingresado': ?>
                          <div id="aviso" class="alert alert-success col-sm-12" align="center">
                            <strong> Hemos recibido sus datos exitosamente!.</strong>
                          </div>
                        <?php break; case 'error': ?>
                          <div id="aviso" class="alert alert-warning col-sm-12" align="center">
                            <strong> Intentelo nuevamente.</strong>
                          </div>
                        <?php break; } ?>

                        <br>
          </td>
        </tr>

        <tr>
          <td>
            <p>Ingrese su RUT como el siguiente formato: 12345678-9</p>
          </td>
        </tr>

        <tr>
                <th width="142" scope="col">
                  <div class="form-group form-inline" style="margin-left: 450px;">
                    <label for="rut" style="font-size:20px">RUT: </label>
                    <input name="rut" id="rut" class="form-control input-lg" type="text" placeholder="" maxlength="10" style="width:120px;" >
                  </div>
                </th>
        </tr>
  
        <tr>
            <td height="100" colspan="2" align="center">
                <button type="submit" name="Ingresar" value="validar" class="btn btn-default btn-lg">Ingresar</button>
            </td>
        </tr>
              
      <tr>
        <td>
            <p id="mensaje" style="color:#678F05; font-size: 18px;">  </p>
        </td>
      </tr>

      <tr>
        <td height="110" colspan="2">  
          <img src="https://www.lautarorosas.cl/mailing/2019/beneficio_prelacion_avanza/imagenes/form-bottom.jpg"> 
        </td>
      </tr>

    </tbody>

 </table>

</form>

</body>

</html>

