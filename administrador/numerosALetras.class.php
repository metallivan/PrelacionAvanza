<?php
class numerosALetras{
/*
Script Name: *numerosAletras
Script URI: http://www.mis-algoritmos.com/2007/09/07/numbers_to_words/
Description: Permite convertir numeros a letras mediante el uso de una sencilla clase.
Script Version: 0.1
Author: Victor De la Rocha
Author URI: http://www.mis-algoritmos.com
*/
		var $resultado;
		var $antes_con_despues='con ';
		var $despues = 'diezmilésimas';
		var $antes_sin_despues='';
		/*
			Constructor
		*/
		function numerosALetras($valor=''){
				if(is_numeric($valor))
					return $this->convertir($valor);
				return false;
			}
		/*
			Retorna el valor de la centena que se le envie como parametro.
		*/
		function centenas($centenas){
				$valores = array('cero','uno','dos','tres','cuatro','cinco','seis',
				'siete','ocho','nueve','diez','once','doce','trece','catorce',
				'quince',20=>'veinte',30=>'treinta',40=>'cuarenta',50=>'cincuenta',
				60=>'sesenta',70=>'setenta',80=>'ochenta',90=>'noventa',100=>'ciento',
				102=>'dos',103=>'tres',104=>'cuatro', 105=>'quinientos'
				,106=>'seis',107=>'setecientos',108=>'ocho',109=>'novecientos');
		
				switch($centenas){
						case '1': return $valores[100]; break;
						case '2': return $valores[102]; break;
						case '3': return $valores[103]; break;
						case '4': return $valores[104]; break;
						case '5': return $valores[105]; break;
						case '6': return $valores[106]; break;						
						case '7': return $valores[107]; break;
						case '8': return $valores[108]; break;
						case '9': return $valores[109]; break;
						default: return $valores[$VCentena];
					}
			}
		/*
			Retorna el valor de la unidad que se le envie como parametro.
		*/
		function unidades($unidad){
				$valores = array('cero','un','dos','tres','cuatro','cinco','seis',
				'siete','ocho','nueve','diez','once','doce','trece','catorce',
				'quince',20=>'veinte',30=>'treinta',40=>'cuarenta',50=>'cincuenta',
				60=>'sesenta',70=>'setenta',80=>'ochenta',90=>'noventa',100=>'ciento',
				101=>'quinientos',102=>'setecientos',103=>'novecientos'
				);
			
				return $valores[$unidad];
			}
	
		/*
			Retorna el valor de la decena que se le envie como parametro
		*/
		function decenas($decena){
				$valores = array('cero','un','dos','tres','cuatro','cinco','seis','siete',
				'ocho','nueve','diez','once','doce','trece','catorce','quince',20=>'veinte',30=>'treinta',
				40=>'cuarenta',50=>'cincuenta',60=>'sesenta',70=>'setenta',80=>'ochenta',90=>'noventa',
				100=>'ciento',101=>'quinientos',102=>'setecientos',103=>'novecientos');
		
				return $valores[$decena];
			}
	
	
		function evalua($valor){
				if($valor==0)
					return 'cero';
					
				$decimales = 0;
				$letras = '';
				while($valor!=0){
						// Validamos si supera los 100 millones
						if($valor>=1000000000)
							return 'L&iacute;mite de aplicaci&oacute;n exedido.';
						
						//Centenas de Millón
						if (($valor<1000000000) and ($valor>=100000000)){
								if ((intval($valor/100000000)==1) and (($valor-(intval($valor/100000000)*100000000))<1000000))
										$letras.=(string)'cien millones ';
									else{
										$letras.=$this->centenas(intval($valor/100000000));
										If ((intval($valor/100000000)<>1) and (intval($valor/100000000)<>5) and (intval($valor/100000000)<>7) and (intval($valor/100000000)<> 9))
												$letras.=(string)'ciento ';
											else
												$letras.=(string)' ';
									}
								$valor=$valor-(Intval($valor/100000000)*100000000);
							}
			
						//Decenas de Millón
						if(($valor<100000000) and ($valor>=10000000)){
								if(intval($valor/1000000)<16){
										$tempo=$this->decenas(intval($valor/1000000));
										$letras.=(string)$tempo;
										$letras.=(string)' millones ';
										$valor=$valor-(intval($valor/1000000)*1000000);
									}else{
										$letras.=$this->decenas(intval($valor/10000000)*10);
										$valor=$valor-(intval($valor/10000000)*10000000);
										if ($valor>1000000)
											$letras.=$letras.' y ';
									}
							}
			
						//Unidades de Millon
						if(($valor<10000000) and ($valor>=1000000)){
									$tempo=(intval($valor/1000000));
									if($tempo==1)
											$letras.=(string)' un mill&oacute;n ';
										else{
											$tempo= unidades(intval($valor/1000000));
											$letras.=(string)$tempo;
											$letras.=(string)" millones ";
										}
								$valor=$valor-(intval($valor/1000000)*1000000);
							}
			
						//Centenas de Millar
						if(($valor<1000000) and ($valor>=100000)){
								$tempo=(intval($valor/100000));
								$tempo2=($valor-($tempo*100000));
								if(($tempo==1) and ($tempo2<1000))
										$letras.=(string) 'cien mil ';
									else{
										$tempo=$this->centenas(intval($valor/100000));
										$letras.=(string)$tempo;
										$tempo=(intval($valor/100000));
										if(($tempo <> 1) and ($tempo <> 5) and ($tempo <> 7) and ($tempo <> 9))
												$letras.=(string)'ciento ';
											else
												$letras.=(string)' ';
									}
								$valor=$valor-(intval($valor/100000)*100000);
							}
			
						//Decenas de Millar
						if(($valor<100000) and ($valor>=10000)){
								$tempo=(intval($valor/1000));
								if($tempo<16){
										$tempo=$this->decenas(intval($valor/1000));
										$letras.=(string)$tempo;
										$letras.=(string)' mil ';
										$valor=$valor-(intval($valor/1000)*1000);
									}else{
										$tempo=$this->decenas(intval($valor/10000)*10);
										$letras.=(string) $tempo;
										$valor=$valor-(intval(($valor/10000))*10000);
										if($valor>1000)
												$letras.=(string)' y ';
											else
												$letras.=(string)' mil ';
									}
							}
			
			
						//Unidades de Millar
						if(($valor<10000) and ($valor>=1000)){
								$tempo=intval($valor/1000);
								if($tempo==1)
									$letras.=(string)'';//'un';
									else{
										$tempo=$this->unidades(intval($valor/1000));
										$letras.=(string) $tempo;
									}
								$letras.=(string)' mil ';
								$valor=$valor-(intval($valor/1000)*1000);
							}
			
						//Centenas
						if(($valor<1000) and ($valor>99)){
								if ((intval($valor/100)==1) and (($valor-(intval($valor/100)*100))<1))
										$letras.='cien ';
									else{
										$temp=(intval($valor/100));
										$l2=$this->centenas($temp);
										$letras.=(string) $l2;
										if((intval($valor/100)<>1) and (intval($valor/100)<>5) and (intval($valor/100)<>7) and (intval($valor/100)<>9))
												$letras.='cientos ';
											else
												$letras.=(string)' ';
									}
								$valor=$valor-(intval($valor/100)*100);
							}
			
						//Decenas
						if(($valor<100) and ($valor>9)){
								if($valor<16){
										$tempo=$this->decenas(intval($valor));
										$letras.=$tempo;
										$Numer =$valor-Intval($valor);
									}else{
										$tempo=$this->decenas(Intval(($valor/10))*10);
										$letras.=(string)$tempo;
										$valor=$valor-(Intval(($valor/10))*10);
										if($valor>0.99)
											$letras.=(string)' y ';
									}
							}
			
						//Unidades
						if(($valor<10) And ($valor>0.99)){
								$tempo=$this->unidades(intval($valor));
								$letras.=(string)$tempo;
								$valor=$valor-intval($valor);
							}
			
						//Decimales
						if($decimales<=0)
							if(($letras <> "Error en Conversi&oacute;n a Letras") and (strlen(trim($letras))>0))
								$letras .= (string) ' ';
					return $letras;
				}
			}
		/*
			Retorna el texto de el numero enviado como parametros
		*/
		function convertir($valor){
				ob_start();
				$tt = $valor;          //$$tt es el numero completo

	      		$valor = intval($tt);    //$valor es solo el entero
	      		//echo $valor;

				$decimales = $tt - intval($tt);  //al numero completo le resto el entero, dejando solo los decimales.
				//echo $decimales;
				
				$decimales = substr($decimales,strpos($decimales,'.'),5)*(100);
				//echo $decimales;
								
				$decimal_sin_puntos = str_replace ( ".", "", $decimales);  //le quito los puntos al numero decimal.
				//echo $decimal_sin_puntos;

				//Parte entera
				print $this->evalua($valor);
				
				//Parte Decimal
				if($decimales){
						print "$this->antes_con_despues";
						print $this->evalua($decimal_sin_puntos);  
						print "$this->despues";
					}else{
						print " $this->antes_sin_despues ";
					}
				return $this->resultado = $texto = ob_get_clean();


			}
	}
?>