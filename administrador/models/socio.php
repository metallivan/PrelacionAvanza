<?php
/******************************************
*AUTOR:   CODDE SOLUCIONES INFORMATICA   **
*CLIENTE: LAUTARO ROSAS                  **
*******************************************/
class socio{

/**
*Se declaran las variables a utilizar
*/
var $nro_socio;
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



function socio()
{}

/**
*Metodos GET Y SET
*/

	function getNro_socio() { return $this->nro_socio;}
    function setNro_socio($nro_socio) { $this->nro_socio = $nro_socio;}

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
*Función que Actualiza el registro de la tabla _clavesocio utilizando PARAMETRO:NRO_SOCIO
*/
	public function updateSocio()
	{
		$update = "UPDATE _clavesocio
				   SET

					CLAVE = '".$this->clave."',
					ACTIVO = '".$this->activo."'

					where NROSOCIO = '".$this->nro_socio."';";

		if(!mysql_query($update))
		{
			return $update;
		}
		else
		{	return 1;	}


	}


################################ consultar Socios intranet #################################################

/**
*Función que Consulta el registro de la tabla _socios utilizando PARAMETRO:RUT,DV Y CLAVE
*/
	public function consultSocioClaveA($rut,$dv,$clave)
	{
		$result = mysql_query("select * from _socios where RUT = '".$rut."' AND DVRUT = '".$dv."' AND CLAVE_PROVISORIA = '".$clave."';");
		 while($row = mysql_fetch_array($result))
		{
			$this->setNro_socio($row['NROSOCIO']);
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
*Función que Consulta el registro de la tabla _Clavesocio utilizando PARAMETRO:NROSOCIO
*/
	public function consultSocioClaveB($nrosocioA)
	{
		$result = mysql_query("select * from _clavesocio where NROSOCIO = '".$nrosocioA."' AND ACTIVO = 'no';");
		 while($row = mysql_fetch_array($result))
		{
			$this->setNro_socio($row['NROSOCIO']);
			$this->setClave($row['CLAVE']);
			$this->setFecha_registro($row['FECHA_REGISTRO']);

		}
	}


/**
*Función que Consulta el registro de la tabla _clavesocio utilizando PARAMETRO:NR_SOCIO
*/
	public function consultSocioNrosocioA($nro_socio)
	{
		$result = mysql_query("select * from _clavesocio where NROSOCIO = '".$nro_socio."' AND ACTIVO = 'si';");
		 while($row = mysql_fetch_array($result))
		{
			$this->setNro_socio($row['NROSOCIO']);

		}
	}

/**
*Función que Consulta el registro de la tabla _socios utilizando PARAMETRO:NR_SOCIO
*/
	public function consultSocioNrosocioB($nro_socio)
	{
		$result = mysql_query("select * from _socios where NROSOCIO = '".$nro_socio."';");
		 while($row = mysql_fetch_array($result))
		{
			$this->setNro_socio($row['NROSOCIO']);
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
*Función que Consulta el registro de la tabla _socios utilizando PARAMETRO:RUT,DV Y CLAVE
*/
	public function consultSocioIntranetA($rut,$dv,$clave)
	{
		$result = mysql_query("select * from _clavesocio where RUT = '".$rut."' AND DVRUT = '".$dv."' AND CLAVE = '".$clave."' AND ACTIVO = 'si';");
		 while($row = mysql_fetch_array($result))
		{
			$this->setNro_socio($row['NROSOCIO']);

		}
	}

/**
*Función que Consulta el registro de la tabla _socios utilizando PARAMETRO:RUT,DV Y CLAVE
*/
	public function consultSocioIntranetB($nrosocio)
	{
		$result = mysql_query("select * from _socios where NROSOCIO = '".$nrosocio."';");
		 while($row = mysql_fetch_array($result))
		{
			$this->setNro_socio($row['NROSOCIO']);
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
	public function consultSocioRecuperar($rut,$dv,$email)
	{
		$result = mysql_query("SELECT NROSOCIO ,RUT ,DVRUT ,CLAVE_PROVISORIA ,Paterno ,Materno ,Nombres ,Direccion ,Telefono ,Ciudad ,CASE WHEN Email='' THEN LaboEmail ELSE Email END AS Email from _socios  where RUT = '".$rut."' AND DVRUT = '".$dv."' AND CASE WHEN Email='' THEN LaboEmail ELSE Email END = '".$email."';");

		//$result = mysql_query("select * from _socios where RUT = '".$rut."' AND DVRUT = '".$dv."' AND Email = '".$email."';");
		 while($row = mysql_fetch_array($result))
		{
			$this->setNro_socio($row['NROSOCIO']);
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
*Función que Consulta la clave provisoria del registro de la tabla _socios utilizando PARAMETRO: NROSOCIO
*/
	public function rescueClaveProvisoria($nrosocio)
	{
	    $consulta = "select * from _socios where NROSOCIO = '".$nrosocio."' ;";
	    $result = mysql_query($consulta);
		mysql_query("SET NAMES 'utf8'");
		return $result;
	}



	/**
*Función que Consulta la clave provisoria del registro de la tabla _titulares utilizando PARAMETRO: RUT Y DVRUT
*/
	public function rescueClaveProvisoriaTitular($rut, $dvrut)
	{
	    $consulta = "select * from _titulares where RUT = '".$rut."' AND DVRUT= '".$dvrut."' ;";
	    $result = mysql_query($consulta);
		mysql_query("SET NAMES 'utf8'");
		return $result;
	}

	public function consultaSocioRut($rut, $dvrut)
		{
		    $consulta = "select * from _socios where RUT='".$rut."' AND DVRUT= '".$dvrut."' ";
		    $result = mysql_query($consulta);
			mysql_query("SET NAMES 'utf8'");
			return $result;
		}

		public function consultSocioIntranetNoClave($rut,$dv)
	{
		$result = mysql_query("select * from _socios where RUT = '".$rut."' AND DVRUT = '".$dv."';");
		 while($row = mysql_fetch_array($result))
		{
			$this->setNro_socio($row['NROSOCIO']);

		}
	}



}
?>
