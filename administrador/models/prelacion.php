<?php


class prelacion{

/**
*Se declaran las variables a utilizar
*/

var $id_solicitud;
var $id_solicitud_capital;
var $nrosocio;
var $fecha_solicitud;
var $monto;




function prelacion()
{}

/**
*Metodos GET Y SET
*/

	function getId_solicitud() { return $this->id_solicitud;}
    function setId_solicitud($id_solicitud) { $this->id_solicitud = $id_solicitud;}


	function getId_solicitud_capital() { return $this->id_solicitud_capital;}
    function setId_solicitud_capital($id_solicitud_capital) { $this->id_solicitud_capital = $id_solicitud_capital;}


    function getNroSocio() { return $this->nrosocio;}
    function setNroSocio($nrosocio) { $this->nrosocio = $nrosocio;}


    function getFechaSolicitud() { return $this->fecha_solicitud;}
    function setFechaSolicitud($fecha_solicitud) { $this->fecha_solicitud = $fecha_solicitud;}


    function getMonto() { return $this->monto;}
    function setMonto($monto) { $this->monto = $monto;}



/**
*Función que Consulta  todos los registro de la tabla _solicitudes_capital
*/
	public function Validacion_Datos($nrosocio)
	{

		$dia = '';
		$mes = date('m');
		$anio = date('Y')-1;

		function esBisiesto($anio)
		{
			return ((($anio%4 == 0) && ($anio%100)) || $anio%400 == 0)? true: false;
		}

		if ($mes == '02'){
			if(esBisiesto($anio)){
				$dia = 29;
			}else{
				$dia = 28;
			}
		} elseif (in_array($mes, array('01','03','05','07','08','10','12'))){
			$dia = 31;
		} else {
			$dia = 30;
		}
    	$consult = "SELECT COUNT(*) AS numero FROM _solicitudes_capital WHERE NROSOCIO = ".$nrosocio." AND MONTO-ADELANTO > 0 and adelanto = 0 and monto <= 500000 and fecha_solicitud <= ".$anio.$mes.$dia.";";


		$result = mysql_query($consult);

		return $result;

	}

/**
*Función que Consulta solamente las solicitudes activas del socio, se utiliza arriba de la tabla principal
*/
	public function consultSolicitudesCapitalActivas($nrosocio)
	{
    	$consult = "SELECT PRELACION  FROM (SELECT @rownum:=@rownum+1 AS prelacion ,id_solicitud ,CASE WHEN nrosocio = ".$nrosocio." AND MONTO-ADELANTO <> 0 THEN nrosocio ELSE '' END AS nrosocio ,fecha_solicitud ,monto ,adelanto ,CASE WHEN nrosocio = ".$nrosocio." THEN MONTO-ADELANTO ELSE MONTO END AS SALDO FROM (SELECT @rownum:=0) r ,_solicitudes_capital WHERE monto <> 0 AND prioridad*100000000+id_solicitud <= (SELECT MAX(soli2.prioridad*100000000+soli2.id_solicitud) FROM _solicitudes_capital AS soli2 WHERE soli2.NROSOCIO = ".$nrosocio." AND soli2.MONTO-soli2.ADELANTO >0 ) ORDER BY prelacion ASC ) derived WHERE NROSOCIO = ".$nrosocio." ";

		$result = mysql_query($consult);

		return $result;

	}




/**
*Función que Consulta  todos los registro de la tabla _solicitudes_capital
*/
	public function consultSolicitudesCapital($nrosocio)
	{
    	$consult = "SELECT @rownum:=@rownum+1 AS prelacion ,id_solicitud ,CASE WHEN nrosocio =".$nrosocio." AND MONTO-ADELANTO <> 0 THEN nrosocio ELSE '' END AS nrosocio ,fecha_solicitud ,monto ,adelanto ,periodopago ,CASE WHEN nrosocio = ".$nrosocio." THEN MONTO-ADELANTO ELSE MONTO END AS monto ,prioridad FROM (SELECT @rownum:=0) r ,_solicitudes_capital WHERE monto <> 0 AND prioridad*100000000+id_solicitud <= (SELECT MAX(soli2.prioridad*100000000+soli2.id_solicitud) FROM _solicitudes_capital AS soli2 WHERE soli2.NROSOCIO = ".$nrosocio." AND soli2.MONTO-soli2.ADELANTO >0 ) ORDER BY prioridad,prelacion ASC";

		$result = mysql_query($consult);

		return $result;

	}


/**
*Función que Consulta todos los registros de Discount network utilizando los PARAMETROS:INICIO-TAMANO_PAGINA
*Se utiliza par la paginación
*/
	public function consultPrelacion_Paginas($nrosocio,$inicio,$TAMANO_PAGINA)
	{
	$consultar = "SELECT @rownum:=@rownum+1 AS prelacion, id_solicitud ,CASE WHEN nrosocio = ".$nrosocio." THEN nrosocio ELSE '' END AS nrosocio ,fecha_solicitud ,monto FROM (SELECT @rownum:=0) r, _solicitudes_capital WHERE id_solicitud > (SELECT MAX(id_solicitud)FROM _pagos)  ORDER BY prelacion ASC LIMIT ".$inicio.",".$TAMANO_PAGINA."";

	$result = mysql_query($consultar);

	return $result;

	}


	public function consultSolicitudesCapitalPorSocio($nrosocio)
	{
		$dia = '';
		$mes = date('m');
		$anio = date('Y')-1;

		if ($mes == '02'){
			if(esBisiesto($anio)){
				$dia = 29;
			}else{
				$dia = 28;
			}
		} elseif (in_array($mes, array('01','03','05','07','08','10','12'))){
			$dia = 31;
		} else {
			$dia = 30;
		}
		
    	$consult = "SELECT * from _solicitudes_capital where nrosocio = ".$nrosocio." AND MONTO-ADELANTO > 0 and adelanto = 0 HAVING MIN(fecha_solicitud) <= ".$anio.$mes.$dia.";";
    	// $consult = "SELECT * from _solicitudes_capital where nrosocio = ".$nrosocio." AND MONTO-ADELANTO > 0 and adelanto = 0 and monto <= 500000 and fecha_solicitud <= ".$anio.$mes.$dia.";";

		$result = mysql_query($consult);

		return $result;

	}


	}
?>
