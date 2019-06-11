<?php 


class usuario{

/**
*Se declaran las variables a utilizar
*/
var $id_usuario;
var $nombre;
var $apellido;
var $correo;
var $numero_socio;
var $nombre_socio;
var $direccion_socio;
var $rut_socio;

var $nrosocio;
var $rut;
var $dvrut;
var $tipo_certificado;
var $fecha_descarga;




function usuario()
{}

/**
*Metodos GET Y SET 
*/
	
	function getId_usuario() { return $this->id_usuario;}
    function setId_usuario($id_usuario) { $this->id_usuario = $id_usuario;}    

	function getNombre() { return $this->nombre;}
    function setNombre($nombre) { $this->nombre = $nombre;}
	
	function getApellido() { return $this->apellido;}
    function setApellido($apellido) { $this->apellido = $apellido;}

    function getCorreo() { return $this->correo;}
    function setCorreo($correo) { $this->correo = $correo;}	
	
	function getNumero_Socio(){ return $this->numero_socio;}
	function setNumero_Socio($numero_socio) {$this->numero_socio = $numero_socio;}	
	
	function getNombre_Socio() { return $this->nombre_socio;}
	function setNombre_Socio($nombre_socio) {$this->nombre_socio = $nombre_socio;}
	
	function getDireccion_socio() {return $this->direccion_socio = $direccion_socio;}
	function setDireccion_socio($direccion_socio) {$this->direccion_socio = $direccion_socio;}
	
	function getRut_socio() {return $this->rut_socio = $rut_socio;}
	function setRut_socio($rut_socio) {$this->rut_socio = $rut_socio;}

	
	function getNroSocio() {return $this->nrosocio = $nrosocio;}
	function setNroSocio($nrosocio) {$this->nrosocio = $nrosocio;}
	
	function getRut() {return $this->rut = $rut;}
	function setRut($rut) {$this->rut = $rut;}

	function getDv() {return $this->dvrut = $dvrut;}
	function setDv($dvrut) {$this->dvrut = $dvrut;}

	function getTipo_Certificado() {return $this->tipo_certificado = $tipo_certificado;}
	function setTipo_Certificado($tipo_certificado) {$this->tipo_certificado = $tipo_certificado;}

	function getFechaDescarga() {return $this->fecha_descarga = $fecha_descarga;}
	function setFechaDescarga($fecha_descarga) {$this->fecha_descarga = $fecha_descarga;}

/*--------------------------------------------------------------------------DATOS DEL SOCIO------------------------------------------------------------------------------*/

public function datos_socio_imprimir_pdf($rut, $dvrut)	
	{
	    $consulta = "select * from _socios where RUT='".$rut."' AND DVRUT= '".$dvrut."' ";	
	    $result = mysql_query($consulta);
		mysql_query("SET NAMES 'utf8'");	
		return $result;	
	}


/*--------------------------------------------------------------------------FIN DATOS DEL SOCIO------------------------------------------------------------------------------*/





/*-------------------------------------------------------------------CERTIFICADO CUOTAS DE PARTICIPACION------------------------------------------------------------------------------*/


 public function TotalSaldo($numero_socio){
	
	$sql= "SELECT SUM(MONTOAPORTE) - SUM(MONTORETIRO) as totalSaldo FROM _capitalsocial WHERE nrosocio= '".$numero_socio."'  AND FECHA <= 20190401 ";
	$result = mysql_query($sql);
	mysql_query("SET NAMES 'utf8'");
		return $result;		
	
	}

public function CuoMin(){
	
	$sql= "SELECT ROUND(MAX(VALORCUOTA*1000),0) as cuminima FROM _valorcuota ORDER BY fecha DESC";
	$result = mysql_query($sql);
	mysql_query("SET NAMES 'utf8'");
		return $result;		
		
	}



 public function MinimoCuotaParticipacion(){
	
	$sql= "SELECT MAX(VALORCUOTA) as max FROM _valorcuota ORDER BY fecha DESC";
	$result = mysql_query($sql);
	mysql_query("SET NAMES 'utf8'");
		return $result;		
		
	}



public function saldo_en_cuotas($numero_socio){		
		
		$sql = "SELECT TRUNCATE(SUM(MONTOAPORTE/(SELECT MAX(VALORCUOTA) AS MAX FROM _valorcuota ORDER BY fecha DESC)) - SUM(MONTORETIRO/(SELECT MAX(VALORCUOTA) AS MAX FROM _valorcuota ORDER BY fecha DESC)),4) AS totalSaldoenCuotas FROM _capitalsocial WHERE nrosocio= '".$numero_socio."' AND FECHA <= 20190401";
		$result = mysql_query($sql);
		mysql_query("SET NAMES 'utf8'");
		return $result;	
	}

/*--------------------------------------------------------------------------FIN CUOTAS DE PARTICIPACION-------------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------COMPROBACION DE DESCARGA CERTIFICADO------------------------------------------------------------------------------*/

public function verificar_descarga($rut,$dvrut)	
	{
	    $consulta = "select * from certificados_participación_descargados where RUT='$rut' AND DV='".$dvrut."';";

	    $result = mysql_query($consulta);
		mysql_query("SET NAMES 'utf8'");	
		return $result;	
	}


	public function Registar_Descarga_Certificado_Cuota_de_Participacion() 
	{
    	
		$insert =  "INSERT INTO certificados_participación_descargados (nrosocio, rut, dv, tipo_certificado, fecha_descarga) 
		VALUES('".$this->nrosocio."',
			'".$this->rut."',
			'".$this->dvrut."',
			'".$this->tipo_certificado."',
			now());";
			
		if(!mysql_query($insert))
		{	
			return 0;
		}
		else
		{	return 1;
		}
	  
	}
		


/*--------------------------------------------------------------------------------------------------------------------------------------------------------*/























	

}//CIERRE DE CLASS USUARIO.















?>