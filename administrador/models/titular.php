<?php 
/******************************************
*AUTOR:   CODDE SOLUCIONES INFORMATICA   **
*CLIENTE: LAUTARO ROSAS                  **
*******************************************/
class titular{

/**
*Se declaran las variables a utilizar
*/
var $rut;
var $dvrut;
var $clave;
var $clave_provisoria;
var $paterno;
var $materno;
var $nombres;
var $direccion;
var $telefono;
var $ciudad;
var $email;
var $fecha_registro;
var $activo;



function titular()
{}

/**
*Metodos GET Y SET 
*/   

	function getRut() { return $this->rut;}
    function setRut($rut) { $this->rut = $rut;}
	
	function getDvrut() { return $this->dvrut;}
    function setDvrut($dvrut) { $this->dvrut = $dvrut;}

    function getClave() { return $this->clave;}
    function setClave($clave) { $this->clave = $clave;}

    function getClave_provisoria() { return $this->clave_provisoria;}
    function setClave_provisoria($clave_provisoria) { $this->clave_provisoria = $clave_provisoria;}

    function getPaterno() { return $this->paterno;}
    function setPaterno($paterno) { $this->paterno = $paterno;}

    function getMaterno() { return $this->materno;}
    function setMaterno($materno) { $this->materno = $materno;}

    function getNombres() { return $this->nombres;}
    function setNombres($nombres) { $this->nombres = $nombres;}

    function getDireccion() { return $this->direccion;}
    function setDireccion($direccion) { $this->direccion = $direccion;}

    function getTelefono() { return $this->telefono;}
    function setTelefono($telefono) { $this->telefono = $telefono;}

    function getCiudad() { return $this->ciudad;}
    function setCiudad($ciudad) { $this->ciudad = $ciudad;}

	function getEmail() { return $this->email;}
    function setEmail($email) { $this->email = $email;}

    function getFecha_registro() { return $this->fecha_registro;}
    function setFecha_registro($fecha_registro) { $this->fecha_registro = $fecha_registro;}

    function getActivo() { return $this->activo;}
    function setActivo($activo) { $this->activo = $activo;}

	
   
	
 /**
*Función que Actualiza el registro de la tabla _clavetitular utilizando PARAMETRO:RUT
*/
	public function updateTitular() 
	{
		$update = "UPDATE _clavetitular
				   SET

					CLAVE = '".$this->clave."',
					ACTIVO = '".$this->activo."'
					
					where RUT = '".$this->rut."';";
		
		if(!mysql_query($update))
		{	
			return $update;
		}
		else
		{	return 1;	}	
	
	
	}	  
	
################################ consultar Titulares intranet #################################################		
/**
*Función que Consulta el registro a la tabla consultTitularRut utilizando el PARAMETRO:RUT
*/
	public function consultTitularClaveA($rut,$dv,$clave)
	{
		$result = mysql_query("select * from _titulares where RUT = '".$rut."' AND DVRUT = '".$dv."' AND CLAVE_PROVISORIA = '".$clave."';");
		 while($row = mysql_fetch_array($result))
		{			
			$this->setRut($row['RUT']);
			$this->setDvrut($row['DVRUT']);
			$this->setClave_provisoria($row['CLAVE_PROVISORIA']);				
			$this->setPaterno($row['Paterno']);
			$this->setMaterno($row['Materno']);			
			$this->setNombres($row['Nombres']);
			$this->setDireccion($row['Direccion']);
			$this->setTelefono($row['Telefono']);				
			$this->setCiudad($row['Ciudad']);
			$this->setEmail($row['Email']);		

		}
	}	


/**
*Función que Consulta el registro a la tabla consultTitularRut utilizando el PARAMETRO:RUT
*/
	public function consultTitularClaveB($rut,$dv)
	{
		$result = mysql_query("select * from _clavetitular where RUT = '".$rut."' AND DVRUT = '".$dv."' AND ACTIVO = 'no';");
		 while($row = mysql_fetch_array($result))
		{			
			$this->setRut($row['RUT']);
			$this->setDvrut($row['DVRUT']);			
			$this->setFecha_registro($row['FECHA_REGISTRO']);	

		}
	}

/**
*Función que Consulta el registro a la tabla consultTitularRut utilizando el PARAMETRO:RUT
*/
	public function consultTitularRutA($rut,$dvrut)
	{
		$result = mysql_query("select * from _clavetitular where RUT = '".$rut."' AND DVRUT = '".$dvrut."' AND ACTIVO ='si';");
		 while($row = mysql_fetch_array($result))
		{			
			$this->setRut($row['RUT']);
			$this->setDvrut($row['DVRUT']);		

		}
	}
	
/**
*Función que Consulta el registro a la tabla consultTitularRut utilizando el PARAMETRO:RUT
*/
	public function consultTitularRutB($rut,$dvrut)
	{
		$result = mysql_query("select * from _titulares where RUT = '".$rut."' AND DVRUT = '".$dvrut."';");
		 while($row = mysql_fetch_array($result))
		{			
			$this->setRut($row['RUT']);
			$this->setDvrut($row['DVRUT']);
			$this->setClave_provisoria($row['CLAVE_PROVISORIA']);				
			$this->setPaterno($row['Paterno']);
			$this->setMaterno($row['Materno']);			
			$this->setNombres($row['Nombres']);
			$this->setDireccion($row['Direccion']);
			$this->setTelefono($row['Telefono']);				
			$this->setCiudad($row['Ciudad']);
			$this->setEmail($row['Email']);		

		}
	}	

/**
*Función que Consulta el registro a la tabla consultTitularRut utilizando los PARAMETROS:RUT,DV,CLAVE
*/
	public function consultTitularIntranetA($rut,$dv,$clave)
	{
		$result = mysql_query("select * from _clavetitular where RUT = '".$rut."' AND DVRUT = '".$dv."' AND CLAVE = '".$clave."';");
		 while($row = mysql_fetch_array($result))
		{		
			$this->setRut($row['RUT']);
			$this->setDvrut($row['DVRUT']);
			$this->setClave($row['CLAVE']);			

		}
	}

/**
*Función que Consulta el registro a la tabla consultTitularRut utilizando los PARAMETROS:RUT,DV,CLAVE
*/
	public function consultTitularIntranetB($rut,$dv)
	{
		$result = mysql_query("select * from _titulares where RUT = '".$rut."' AND DVRUT = '".$dv."';");
		 while($row = mysql_fetch_array($result))
		{		
			$this->setRut($row['RUT']);
			$this->setDvrut($row['DVRUT']);
			$this->setClave_provisoria($row['CLAVE_PROVISORIA']);			
			$this->setPaterno($row['Paterno']);
			$this->setMaterno($row['Materno']);			
			$this->setNombres($row['Nombres']);
			$this->setDireccion($row['Direccion']);
			$this->setTelefono($row['Telefono']);				
			$this->setCiudad($row['Ciudad']);
			$this->setEmail($row['Email']);		

		}
	}	


/**
*Función que Consulta el registro de la tabla _socios utilizando PARAMETRO:RUT,DV Y EMAIL
*/
	public function consultTitularRecuperar($rut,$dv,$email)
	{
		$result = mysql_query("select * from _titulares where RUT = '".$rut."' AND DVRUT = '".$dv."' AND Email = '".$email."';");
		 while($row = mysql_fetch_array($result))
		{					
			$this->setRut($row['RUT']);
			$this->setDvrut($row['DVRUT']);
			$this->setClave_provisoria($row['CLAVE_PROVISORIA']);				
			$this->setPaterno($row['Paterno']);
			$this->setMaterno($row['Materno']);			
			$this->setNombres($row['Nombres']);
			$this->setDireccion($row['Direccion']);
			$this->setTelefono($row['Telefono']);				
			$this->setCiudad($row['Ciudad']);
			$this->setEmail($row['Email']);		

		}
	}	

}
?>