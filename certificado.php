<?php 

session_start();
if (isset($_SESSION['rut']) and isset($_SESSION['dv']))
{
    $sesion="ok";
}else{
    $sesion="nok";
   }
   // include("administrador/mc_table.php");
   include("administrador/WriteTag.php");
   include("administrador/includes/default.php");
   include("administrador/models/usuario_intranet.php");
   include("administrador/models/prelacion.php");
   include("administrador/NumberToLetterConverter.class.php");
   include("administrador/numerosALetras.class.php");
   include("administrador/fechaCastellano.php");

   date_default_timezone_set('America/Santiago');
   setlocale(LC_TIME, 'spanish');
   
   $objeto_socio = new usuario();
   $objeto_funcion = new NumberToLetterConverter ();
   
   $rut = $_SESSION['rut'];
   $dvrut  = $_SESSION['dv'];
   
   $objeto_prelacion = new prelacion();
   
   $monto_sumado = $_POST['monto_sumado_input'];
   
   $id_solicitud = $_POST['id_solicitud_input'];
   
   $fecha_solicitud = $_POST['fecha_solicitud_input'];

   
   
   //-------------------CONSULTO DATOS DEL SOCIO CON EL RUT DE SESSION-----------------
   
   $sql= $objeto_socio->datos_socio_imprimir_pdf($rut, $dvrut);
   
   while ($row = mysql_fetch_array($sql)) {
       
       $nrosocio= $row['NROSOCIO'];
       $rut     = $row['RUT'];
       $dvrut   = $row['DVRUT'];
       $nombres = $row['Nombres'];
       $paterno = $row['Paterno'];
       $materno = $row['Materno'];
       
    }
    //----------------------------------------------------------------------------------
    
    
    //----------------CONVIERTO A LETRAS EL SALDO TOTAL------------
    
    
    $total_monto_sumado = $objeto_funcion->to_word($monto_sumado);
    
    
    
    //-------------------------------------------------------------
    
    //Cabecera de página
    
    $pdf=new PDF_WriteTag('P','mm','A4');
	//'L': hoja horizontal, 'P': hoja vertical
	$pdf->AddPage();
    $pdf->Image("img/encabezado1.jpg", 10 ,10, 55 , 15,'JPG');
    $pdf->SetMargins(40,40,40);
    $pdf->SetStyle("i","Arial","I",11,"0,0,0");
    $pdf->SetStyle("p","Arial","N",11,"0,0,0",0);
    $pdf->SetStyle("strong","Arial","B",11,"0,0,0");
    

   	//TITULO
	$pdf->SetXY(25, 65);
    $pdf->SetFont("Arial","B",15);
	$pdf->SetTextColor(0,0,0);
	// $pdf->Cell(10,-45,utf8_decode('CERTIFICADO DE DESISTE DE SOLICITUD DE PRELACIÓN'),0);

    $dia=date("d");
    $mes=date("F");
    $anio=date("Y");

    if ($mes=="January") $mes="Enero";
    if ($mes=="February") $mes="Febrero";
    if ($mes=="March") $mes="Marzo";
    if ($mes=="April") $mes="Abril";
    if ($mes=="May") $mes="Mayo";
    if ($mes=="June") $mes="Junio";
    if ($mes=="July") $mes="Julio";
    if ($mes=="August") $mes="Agosto";
    if ($mes=="September") $mes="Septiembre";
    if ($mes=="October") $mes="Octubre";
    if ($mes=="November") $mes="Noviembre";
    if ($mes=="December") $mes="Diciembre";
    
    $f_solicitud_converted = date('d-m-Y',strtotime($fecha_solicitud));
    $dia_solicitud =  date('d', strtotime($f_solicitud_converted));
    $mes_solicitud = date('F', strtotime($f_solicitud_converted));
    $anio_solicitud = date('Y', strtotime($f_solicitud_converted));
    
    if ($mes_solicitud=="January") $mes_solicitud="Enero";
    if ($mes_solicitud=="February") $mes_solicitud="Febrero";
    if ($mes_solicitud=="March") $mes_solicitud="Marzo";
    if ($mes_solicitud=="April") $mes_solicitud="Abril";
    if ($mes_solicitud=="May") $mes_solicitud="Mayo";
    if ($mes_solicitud=="June") $mes_solicitud="Junio";
    if ($mes_solicitud=="July") $mes_solicitud="Julio";
    if ($mes_solicitud=="August") $mes_solicitud="Agosto";
    if ($mes_solicitud=="September") $mes_solicitud="Septiembre";
    if ($mes_solicitud=="October") $mes_solicitud="Octubre";
    if ($mes_solicitud=="November") $mes_solicitud="Noviembre";
    if ($mes_solicitud=="December") $mes_solicitud="Diciembre";
    
    $de = "";
        if (strpos($monto_sumado,'000000')){
            $de = " de";
        }else {
            $de = "";
        }

    $parrafo1="<p>Valparaíso, $dia de $mes de $anio.</p>";
    $parrafo2="<p>YO, <strong>".$paterno." ".$materno." ".$nombres."</strong>, RUT: <strong>".number_format($rut, 0, ',', '.')."-".$dvrut."</strong>. Por medio de la presente manifiesto, libre y espontáneamente, ".
                "mi voluntad, desistir de mi solicitud de retiro de capital, de fecha <strong>".$dia_solicitud." de ".$mes_solicitud." de ".$anio_solicitud."</strong>, ID <strong>".$id_solicitud."</strong>, por un monto de $".number_format($monto_sumado, 0, ',', '.')." (".trim($total_monto_sumado).")".$de." pesos ".
                "para acceder a Beneficio Prelación Avanza, y a su vez, tomo conocimiento de la restricción por giros parciales de Capital por un periodo de 24 meses y me obligo, libre y voluntariamente, a no solicitar devolución de Cuotas de Participación por igual periodo a contar de esta fecha. </p>";
    $parrafo3="<p>SOCIO N°<strong>".$nrosocio."</strong></p>";

    
    $pdf->SetXY(144, 70);
    $pdf->SetFont("Arial","",15);
    $pdf->SetTextColor(0,0,0);

$pdf->WriteTag(110,5,utf8_decode($parrafo1), 0,'J',0, 0);
$pdf->Ln(30);
$pdf->SetXY(10, 100);
$pdf->WriteTag(190,5,utf8_decode($parrafo2), 0,'J',0, 0);
$pdf->Ln(30);
$pdf->SetXY(173, 160);
$pdf->WriteTag(150,5,utf8_decode($parrafo3), 0,'J',0, 0);

    //FIRMA GERENTE
    // $pdf->Image("img/firma_don_pedro.jpg", 55 ,180, 83 , 56,'JPG');


    $pdf->Image("img/banner-bottom.png", 0 ,275, 210 , 18,'PNG');

   
//NOMBRE DEL PDF:
$Nombrearchivo=utf8_decode('Certificado Desiste Solicitud Prelacion Socio N°'.$nrosocio.'.pdf');
$modo="I";

 //ENVIO CORREO
 date_default_timezone_set('America/Santiago');
 $fecha= time();
$fechaFormato = date('d-m-Y H:i:s' ,$fecha);


// $mensaje = "<div style='color:#898989; font-size:13px; font-family: Pavanam, sans-serif;'><p>Estimados:</p>";
$mensaje= "\n".$parrafo1."\n";
$mensaje.= "\n".$parrafo2."\n";
$mensaje.= "\n".$parrafo3."\n";
// $mensaje.= "\n <p>Nombre del socio: <strong>".$paterno." ".$materno." ".$nombres."</strong></p>";
// $mensaje.= "\n <p>ID: <strong>".$id_solicitud."</strong></p>";
// $mensaje.= "\n <p>Fecha emitida de solicitud: <strong>".$f_solicitud_converted."</strong></p>";
// $mensaje.= "\n <p>Monto: <strong>$ ".number_format($monto_sumado, 0, ',', '.')."</strong> (".trim($total_monto_sumado).")".$de." pesos .</p>";
// $mensaje.= "\n <p>Saludos cordiales. </p></div>";


// $encoded_content = chunk_split(base64_encode($content));
//Adjunto
//  $mensaje .= $encoded_content; 

$destino   = "ivan.hernandez@lautarorosas.cl";
$remitente = "Solicitud Beneficio";
$asunto    = "Solicitud Beneficio Prelacion Socio N°".$nrosocio;

$cabeceras = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// $cabeceras .='Content-Type: application/pdf; name='.$Nombrearchivo."\r\n";
// $cabeceras .='Content-Disposition: attachment; filename='.$Nombrearchivo."\r\n";
// $cabeceras .='Content-Transfer-Encoding: base64'."\r\n";
// $cabeceras .='X-Attachment-Id: '.rand(1000,99999)."\r\n\r\n"; 
$cabeceras .= "FROM:".$remitente;

mail($destino,$asunto,$mensaje,$cabeceras);

//-------------------------------------------------------------


if (!empty($pdf)) { // <= false
    
    
    //REALIZO INSERT REGISTRANDO LA DESCARGA DEL CERTIFICADO CON DATOS DEL SOCIO Y FECHA DE DESCARGA
    
    $objeto_socio->setNroSocio         ($nrosocio);
    $objeto_socio->setRut              ($rut);
                     $objeto_socio->setDv               ($dvrut);
                     $objeto_socio->setTipo_Certificado ('desiste prelacion');
                     //$objeto_socio->setFechaDescarga    ();
                     
                     
                     if($objeto_socio-> Registar_Descarga_Certificado_Cuota_de_Participacion() == 1)
                     
                     {
                                //SI INSERTO BIEN LE LIBERO EL ARCHIVO PDF
                                $pdf->Output($Nombrearchivo,$modo);

                                //CIERRO SESION
                                session_destroy();
                                unset($_SESSION["nrosocio"]);
                                unset($_SESSION["rut"]);
                                unset($_SESSION["dv"]);
                                unset($_SESSION["password"]);
                    }else{
                        
                                //SI DA ERROR LE INDICO CON UN MENSAJE
                                echo "Error en la descarga del certificado";
                            }
                            
                            
                        } else {
                            
                            echo "Está vacía (false)";
                        }


                        
                        
                        ?>

