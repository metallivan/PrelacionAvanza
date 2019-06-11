<?php session_start();
	
	  include  ("administrador/includes/default.php");   
    include  ("administrador/models/socio.php");
    include  ("administrador/models/titular.php");
    include  ("administrador/models/usuario_intranet.php");

    
    $objeto_socio = new usuario();
  
    $new_socioA = new socio(); 
    $new_socioB = new socio(); 

    $new_titularA = new titular(); 
    $new_titularB = new titular();  

  if(isset($_GET['action']))
  {$action = $_GET['action'];}
  elseif(isset($_POST['action']))
  {$action = $_POST['action'];}
  else{$action = "";}   



//PASO1-----VALIDAMOS EL RUT QUE VENGA CON GUION 
 function valida_rut($r)
{
  $r=strtoupper(ereg_replace('\.|,|-','',$r));
  $sub_rut=substr($r,0,strlen($r)-1);
  $sub_dv=substr($r,-1);
  $x=2;
  $s=0;
  for ( $i=strlen($sub_rut)-1;$i>=0;$i-- )
  {
    if ( $x >7 )
    {
      $x=2;
    }
    $s += $sub_rut[$i]*$x;
    $x++;
  }
  $dv=11-($s%11);
  if ( $dv==10 )
  {
    $dv='K';
  }
  if ( $dv==11 )
  {
    $dv='0';
  }
  if ( $dv==$sub_dv )
  {
    return true;
  }
  else
  {
    return false;
  }
}

 $rutCompleto=$_POST['rut'];

 $porciones = explode("-", $rutCompleto);
 $RUT = $porciones[0]; 
 $DVRUT = $porciones[1];

 //echo $RUT;
 //echo $DVRUT;

 $clave = $_POST['password'];
 //echo $clave;

 $password=md5($_POST['password']);
 //echo $password;



if($action=='validar')
  {


            //PASO2-----VALIDAMOS SI VIENE CON ALGO DE LO CONTRARIO MANDA UN MENSAJE 
            if($_POST['rut']==''){
             
                     $mensaje='mensaje1';
                     echo'
                           <body onload="document.formulario.submit();">
                           <form name="formulario" action="certificado.php" method="post">
                           <input type="hidden" name="mensaje" value="'.$mensaje.'">
                           </form>
                           </body>';
                 }

                 
            //PASO3-----VALIDAMOS CON LA FUNCION PHP CREADA CON ANTERIORIDAD 
               elseif(valida_rut($_POST['rut'])==true){

                   
                        $rutCompleto=$_POST['rut'];
                        echo $rutCompleto;

                        $porciones = explode("-", $rutCompleto);
                        $RUT = $porciones[0]; 
                        $DVRUT = $porciones[1]; 


                        $password=md5($_POST['password']);
                      

                      
                        $new_socioA->consultSocioIntranetA($RUT,$DVRUT,$password); //buscar match en socios
                        $nrosocioA=$new_socioA->getNro_socio();
                        $new_socioB->consultSocioIntranetB($nrosocioA);

                       echo $nrosocioA;
                       echo $new_socioB;


                       
                       if($new_socioB->getNro_socio()!='')
                           {
                                  $nrosocio=$new_socioB->getNro_socio();

                                        $_SESSION["nrosocio"] = $nrosocio;
                                        $_SESSION["rut"] = $RUT;
                                        $_SESSION["dv"] = $DVRUT;
                                        $_SESSION["password"] = $password;
                                       


                                    echo'
                                              <body onload="document.formulario.submit();">
                                              <form name="formulario" action="certificado.php" method="post">
                                              <input type="hidden" name="nrosocio" value="'.$nrosocio.'">
                                              <input type="hidden" name="rut" value="'.$RUT.'">
                                              <input type="hidden" name="dv" value="'.$DVRUT.'">
                                              <input type="hidden" name="password" value="'.$password.'">
                                              <input type="hidden" name="action" value="'.$action.'">
                                              </form>
                                              </body>';
                                      
                            }                             
                            else
                            {
                                    $action = "error";

                                        echo'
                                              <body onload="document.formulario.submit();">
                                              <form name="formulario" action="index.php" method="post">
                                              <input type="hidden" name="action" value="'.$action.'">
                                              </form>
                                              </body>';


                            }

                                      

                }else{

                            $mensaje='mensaje2';
                            echo'
                            <body onload="document.formulario.submit();">
                            <form name="formulario" action="index.php" method="post">
                            <input type="hidden" name="mensaje" value="'.$mensaje.'">
                            </form>
                            </body>';

                 }
          

  }
  
  elseif($action=='salir'){
    //session_destroy();
  unset($_SESSION["nrosocio"]); 
  unset($_SESSION["rut"]);  
  unset($_SESSION["dv"]); 
  unset($_SESSION["password"]); 

     echo'
                      <body onload="document.formulario.submit();">
                      <form name="formulario" action="index.php" method="post">
                      <input type="hidden" name="action" value="'.$action.'">
                      </form>
                      </body>';

  }else{
  				$action = "error";

  				echo'
                      <body onload="document.formulario.submit();">
                      <form name="formulario" action="index.php" method="post">
                      <input type="hidden" name="action" value="'.$action.'">
                      </form>
                      </body>';
  }



?>
