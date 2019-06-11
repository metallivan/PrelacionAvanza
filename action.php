<?php
	if(isset($_GET['action']))
	        {$action = $_GET['action'];}
	    	elseif(isset($_POST['action']))
	    	{$action = $_POST['action'];}
	        else{$action = "";}




   if($action=='enviar') {

   						  date_default_timezone_set('America/Santiago');
			         	  $fecha= time();
                          $fechaFormato = date('d-m-Y H:i:s' ,$fecha);

					  	  $mensaje = utf8_decode("Campaña Contáctanos, hazte socio y borramos tus deudas: \n");
						  $mensaje.= utf8_decode("\nNombre  : ".$_POST['txtNombre']. "\n");
						  $mensaje.= utf8_decode("\nTelefono: ".$_POST['txtTelefono']. "\n");
					      $mensaje.= utf8_decode("\nEmail   : ".$_POST['txtEmail']." \n ");
					      $mensaje.= utf8_decode("\nFecha recepción   : ".$fechaFormato." \n ");

     	                  $destino   = "prestamos@lautarorosas.cl";
		                  $remitente = utf8_decode("Campaña Contáctanos, hazte socio y borramos tus deudas");
		                  $asunto    = utf8_decode("Interesado en Campaña Contáctanos, hazte socio y borramos tus deudas");
		                  mail($destino,$asunto,$mensaje,"FROM: $remitente");


						echo "<SCRIPT LANGUAGE='javascript'>location.href = 'formulario.php?aviso=ingresado';</SCRIPT>";

						echo "Correo Enviado";


	    				}

   if($action=='solicitud') {

   						  date_default_timezone_set('America/Santiago');
			         	  $fecha= time();
                          $fechaFormato = date('d-m-Y H:i:s' ,$fecha);

					  	  $mensaje = utf8_decode("Campaña Contáctanos, hazte socio y borramos tus deudas: \n");
						  $mensaje.= utf8_decode("\nNombre  : ".$_POST['txtNombre']. "\n");
						  $mensaje.= utf8_decode("\nTelefono: ".$_POST['txtTelefono']. "\n");
					      $mensaje.= utf8_decode("\nEmail   : ".$_POST['txtEmail']." \n ");
					      $mensaje.= utf8_decode("\nFecha recepción   : ".$fechaFormato." \n ");

     	                  $destino   = "cooperativa@lautarorosas.cl";
		                  $remitente = utf8_decode("Campaña Contáctanos, hazte socio y borramos tus deudas");
		                  $asunto    = utf8_decode("Interesado en Campaña Contáctanos, hazte socio y borramos tus deudas");
		                  mail($destino,$asunto,$mensaje,"FROM: $remitente");


						echo "<SCRIPT LANGUAGE='javascript'>location.href = 'formulario.php?aviso=ingresado';</SCRIPT>";

						echo "Correo Enviado";


	    				}


 ?>
