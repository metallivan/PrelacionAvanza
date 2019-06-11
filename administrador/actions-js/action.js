var monto_solicitud = document.getElementsByName('solicitud');
var enviar = document.getElementById('enviar');
var boton = document.getElementsByTagName('img');

function sumarMontos(){

  var totalChecks = monto_solicitud.length;
  var totalSumado = 0;        
  
  for( var i=0; i<totalChecks; ++i){ 
      if( monto_solicitud[i].checked){
            var valor = monto_solicitud[i].value;        
            totalSumado = totalSumado + parseInt(valor);
            
        }

    if (monto_solicitud[i].checked == false){
          document.getElementById('monto_sumado').innerHTML = 'Monto Total: $ '+ formatNumber(totalSumado);
          document.getElementById('monto_sumado_input').value = totalSumado;
          enviar.setAttribute('hidden','hidden');
          enviar.disabled = true;
      
    }else{

    document.getElementById('monto_sumado').innerHTML = 'Monto Total: $ '+ formatNumber(totalSumado);
    document.getElementById('monto_sumado_input').value = totalSumado; 

}
        if(totalSumado != 0 && totalSumado <= 500000){
              enviar.removeAttribute('hidden','hidden');
              enviar.disabled = false;
    
    
    
        } else{
          enviar.setAttribute('hidden','hidden');
          enviar.disabled = true;
        }
    }

}

function formatNumber(num) {
    if (!num || num == 'NaN') return '-';
    if (num == 'Infinity') return '&#x221e;';
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
        num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
    return (((sign) ? '' : '-') + num + ',' + cents);
}
