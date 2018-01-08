
jQuery(document).ready(function() {//solo numeros
	console.log("hello");
    jQuery('.input_number_int').keypress(function(tecla) {

        if(tecla.charCode < 48 || tecla.charCode > 57) return false;
    });

    jQuery('.input_number_float').keypress(function(tecla) {//numeros y punto
        if((tecla.charCode > 47 && tecla.charCode < 58) || tecla.charCode == 46) return true;
        return false;
    });

    jQuery('.input_no_special_character').keypress(function(tecla) { //numetros y letras
        if((tecla.charCode > 47 && tecla.charCode < 58) || (tecla.charCode > 64 && tecla.charCode < 91) || (tecla.charCode > 96 && tecla.charCode < 123) )  return true;
        return false;
    });

});

Number.prototype.formatMoney = function(c, d, t){
   var n = this, 
   c = isNaN(c = Math.abs(c)) ? 0 : c, 
   d = d == undefined ? "." : d, 
   t = t == undefined ? "," : t, 
   s = n < 0 ? "-" : "", 
   i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
   j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

