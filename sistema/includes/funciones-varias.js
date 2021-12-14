function ir_pagina(pagina) {
    location.href = pagina;
}
//redirige a una pagina si aceptas
function validar_eliminar(mensaje, pagina) {
    if (confirm(mensaje)) {
        location.href = pagina;
    }
}

function validar_obligatorio(objeto, mensaje) {
    if (objeto.value == '') {
        alert(mensaje);
        objeto.focus();
        return true;
    }
}

function validar_sin_espacio(objeto, mensaje) {
    if (objeto.value == '' || (objeto.value.indexOf(" ") > -1)) {
        alert(mensaje);
        objeto.focus();
        return true;
    }
}

function validar_numero(objeto, mensaje) {
    if (isNaN(objeto.value)) {
        alert(mensaje);
        objeto.focus();
        objeto.select();
        return true;
    }
}

function validar_solonumero(objeto, mensaje) {
    var checkOK = "0123456789";
    var checkStr = objeto.value;
    var allValid = true;
    for (i = 0; i < checkStr.length; i++) {
        ch = checkStr.charAt(i);
        for (j = 0; j < checkOK.length; j++)
            if (ch == checkOK.charAt(j))
                break;
        if (j == checkOK.length) {
            allValid = false;
            break;
        }
    }
    if (!allValid) {
        alert(mensaje);
        objeto.focus();
        objeto.select();
        return true;
    }
}

function validar_letranumero(objeto, mensaje) {
    var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz0123456789áéíóúÁÉÍÓÚ,. \n/\t/\r/ ";
    var checkStr = objeto.value;
    var allValid = true;
    for (i = 0; i < checkStr.length; i++) {
        ch = checkStr.charAt(i);
        for (j = 0; j < checkOK.length; j++)
            if (ch == checkOK.charAt(j))
                break;
        if (j == checkOK.length) {
            allValid = false;
            break;
        }
    }
    if (!allValid) {
        alert(mensaje);
        objeto.focus();
        objeto.select();
        return true;
    }
}

function validar_email(objeto, mensaje) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(objeto.value)) {
        return false;
    } else {
        alert(mensaje);
        objeto.focus();
        objeto.select();
        return true;
    }
}

function validar_texto_html(objeto, mensaje) {
    var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz0123456789áéíóúÁÉÍÓÚ, \n\t\r/ /\\<>!-.'º():_;[]{}*+-%&#=?¿$ª";
    var checkStr = objeto.value;
    var allValid = true;
    for (i = 0; i < checkStr.length; i++) {
        ch = checkStr.charAt(i);
        for (j = 0; j < checkOK.length; j++) {
            if (ch == checkOK.charAt(j))
                break;
            if (j == checkOK.length) {
                allValid = false;
                break;
            }
        }
    }
    if (!allValid) {
        alert(mensaje);
        objeto.focus();
        objeto.select();
        return true;
    }
}

function cambiar_color_on(id) {
    id.style.background = '#FFCC33';
}

function cambiar_color_off(id) {
    id.style.background = '#F0F0F0';
}

function cambiar_color_fila_on(id) {
    id.style.background = '#FFCC33';
}

function cambiar_color_fila_off(id) {
    id.style.background = '#F0F0F0';
}

function cambiar_color_txt_on(id, color) {
    id.style.background = color;
}

function cambiar_color_txt_off(id, color) {
    id.style.background = color;
}

function makeOptionList(objeto, name, value, sel) {
    var o = new Option(name, value);
    objeto.options[objeto.length] = o;
    if (sel == 1)
        objeto.selectedIndex = objeto.length - 1;
}

function cerrar_caja(obj) {
    obj.style.visibility = "hidden";
}

function generar_caja(x, y, contenido, obj, obj_txt) {
    obj.style.left = x;
    obj.style.top = y;
    obj.style.visibility = "visible";

    aux_contenido = "<div align=right><A HREF='#' onclick=\"cerrar_caja(" + obj_txt + ");\" title='Cerrar Ventana' class='link02'>X</A></div>" + contenido;

    obj.innerHTML = aux_contenido;
}

////////////////////////////////////////////////
function KeyIsLetra(evt) {
    var isNav = (navigator.appName.indexOf("Netscape") != -1)
    var isIE = (navigator.appName.indexOf("Microsoft") != -1)

    if (isNav) {
        //if ( evt.which == 13 || evt.which == 8 || (evt.which >= 65 &&  evt.which <=90) || (evt.which >= 97 &&  evt.which <=122) || evt.which == 225 || evt.which == 233 || evt.which == 237 || evt.which == 243 || evt.which == 250 || evt.which == 193 || evt.which == 201 || evt.which == 205 || evt.which == 211 || evt.which == 218 )
        if (evt.which == 209 || evt.which == 241 || evt.which == 13 || evt.which == 8 || (evt.which >= 65 && evt.which <= 90) || (evt.which >= 97 && evt.which <= 122) || evt.which == 32)
            return true;
        return false;
    } else if (isIE) {
        evt = window.event;
        //if ( evt.keyCode == 13 || evt.keyCode == 8 || (evt.keyCode >= 65 && evt.keyCode <= 90) || (evt.keyCode >= 97 && evt.keyCode <= 122) || evt.keyCode == 225 || evt.keyCode == 233 || evt.keyCode == 237 || evt.keyCode == 243 || evt.keyCode == 250 || evt.keyCode == 193 || evt.keyCode == 201 || evt.keyCode == 205 || evt.keyCode == 211 || evt.keyCode == 218 )
        if (evt.keyCode == 209 || evt.keyCode == 241 || evt.keyCode == 13 || evt.keyCode == 8 || (evt.keyCode >= 65 && evt.keyCode <= 90) || (evt.keyCode >= 97 && evt.keyCode <= 122) || evt.keyCode == 32)
            return true;
        return false;
    } else {
        alert("Su browser no es soportado por esta aplicaci?n")
    }
    return false
}

////////////////////////////////////////////////
function KeyIsNumber(evt) {
    var isNav = (navigator.appName.indexOf("Netscape") != -1)
    var isIE = (navigator.appName.indexOf("Microsoft") != -1)

    if (isNav) {
        if (evt.which == 13 || evt.which == 44 || evt.which == 8 || (evt.which >= 48 && evt.which <= 57))
            return true;
        return false;
    } else if (isIE) {
        evt = window.event;
        if (evt.keyCode == 13 || evt.keyCode == 44 || evt.keyCode == 8 || (evt.keyCode >= 48 && evt.keyCode <= 57))
            return true;
        return false;
    } else {
        alert("Su browser no es soportado por esta aplicaci?n")
    }
    return false
}

////////////////////////////////////////////////
function KeyNotCarExt(evt) {
    var isNav = (navigator.appName.indexOf("Netscape") != -1)
    var isIE = (navigator.appName.indexOf("Microsoft") != -1)

    if (isNav) {
        if (evt.which == 39) //Comilla Simple
            return false;
        if (evt.which == 34) //Comillas Dobles
            return false;
        if (evt.which == 37) //Porcentaje
            return false;
        if (evt.which == 35) //Gato
            return false;
        if (evt.which == 46) //Punto
            return false;
        //if ( evt.which == 44 )//Coma
        //  return false;		  			    
        return true;
    } else if (isIE) {
        evt = window.event;
        if (evt.keyCode == 39)
            return false;
        if (evt.keyCode == 34)
            return false;
        if (evt.keyCode == 37)
            return false;
        if (evt.keyCode == 35)
            return false;
        if (evt.keyCode == 46)
            return false;
        //if ( evt.keyCode == 44 )
        //	return false;									

        return true;
    } else {
        alert("Su browser no es soportado por esta aplicaci?n")
    }
    return true;
}
/////////////////////////////////////////

function KeyNotCarExtConPunto(evt) {
    var isNav = (navigator.appName.indexOf("Netscape") != -1)
    var isIE = (navigator.appName.indexOf("Microsoft") != -1)

    if (isNav) {
        if (evt.which == 39) //Comilla Simple
            return false;
        if (evt.which == 34) //Comillas Dobles
            return false;
        if (evt.which == 37) //Porcentaje
            return false;
        if (evt.which == 35) //Gato
            return false;

        //if ( evt.which == 44 )//Coma
        //  return false;		  			    
        return true;
    } else if (isIE) {
        evt = window.event;
        if (evt.keyCode == 39)
            return false;
        if (evt.keyCode == 34)
            return false;
        if (evt.keyCode == 37)
            return false;
        if (evt.keyCode == 35)
            return false;
        if (evt.keyCode == 46)
            return false;
        //if ( evt.keyCode == 44 )
        //	return false;									

        return true;
    } else {
        alert("Su browser no es soportado por esta aplicaci?n")
    }
    return true;
}



/////////////////////////////////////////////////////////////////
function KeyIsSoloNum(evt) {
    var isNav = (navigator.appName.indexOf("Netscape") != -1)
    var isIE = (navigator.appName.indexOf("Microsoft") != -1)

    if (isNav) {
        if (evt.which >= 48 && evt.which <= 57)
            return true;
        return false;
    } else if (isIE) {
        evt = window.event;
        if (evt.keyCode >= 48 && evt.keyCode <= 57)
            return true;
        return false;
    } else {
        alert("Su browser no es soportado por esta aplicaci?n")
    }
    return false
}
////////////////////////////////////////////////

function KeyIsDecimal(evt) {
    var isNav = (navigator.appName.indexOf("Netscape") != -1)
    var isIE = (navigator.appName.indexOf("Microsoft") != -1)

    if (isNav) {
        if (evt.which == 13 || evt.which == 8 || evt.which == 46 || (evt.which >= 48 && evt.which <= 57))
            return true;
        return false;
    } else if (isIE) {
        evt = window.event;
        if (evt.keyCode == 13 || evt.keyCode == 8 || evt.keyCode == 46 || (evt.keyCode >= 48 && evt.keyCode <= 57))
            return true;
        return false;
    } else {
        alert("Su browser no es soportado por esta aplicacion")
    }
    return false
}

////////////////////////////////////////////////

function TrimRight(str) {
    var resultStr = "";
    var i = 0;
    // Return immediately if an invalid value was passed in
    if (str + "" == "undefined" || str == null)
        return null;
    // Make sure the argument is a string
    str += "";

    if (str.length == 0)
        resultStr = "";
    else {
        // Loop through string starting at the end as long as there
        // are spaces.
        i = str.length - 1;
        while ((i >= 0) && (str.charAt(i) == " "))
            i--;

        // When the loop is done, we're sitting at the last non-space char,
        // so return that char plus all previous chars of the string.
        resultStr = str.substring(0, i + 1);
    }

    return resultStr;
}

function TrimLeft(str) {
    var resultStr = "";
    var i = len = 0;
    // Return immediately if an invalid value was passed in
    if (str + "" == "undefined" || str == null)
        return null;
    // Make sure the argument is a string
    str += "";
    if (str.length == 0)
        resultStr = "";
    else {
        // Loop through string starting at the beginning as long as there
        // are spaces.
        // len = str.length - 1;
        len = str.length;

        while ((i <= len) && (str.charAt(i) == " "))
            i++;
        // When the loop is done, we're sitting at the first non-space char,
        // so return that char plus the remaining chars of the string.
        resultStr = str.substring(i, len);
    }
    return resultStr;
}


function Trim(str) {
    var resultStr = "";

    resultStr = TrimLeft(str);
    resultStr = TrimRight(resultStr);

    return resultStr;
}

////////////////////////////////////////////////

function KeyIsTexto(evt) {
    var isNav = (navigator.appName.indexOf("Netscape") != -1)
    var isIE = (navigator.appName.indexOf("Microsoft") != -1)

    if (isNav) {
        if (evt.which == 0 /* TAB */ ||
            evt.which == 8 /* DELETE */ ||
            evt.which == 32 ||
            evt.which == 46 // .
            ||
            (evt.which >= 224 && evt.which == 252) // Acentos
            ||
            (evt.which >= 48 && evt.which == 57) // [0-9]
            ||
            (evt.which >= 65 && evt.which == 90) // [a-z]
            ||
            (evt.which >= 97 && evt.which == 122)) // [A-Z]
            return true;
        return false;
    } else if (isIE) {
        evt = window.event;
        if (evt.keyCode == 32 ||
            evt.keyCode == 46 ||
            (evt.keyCode >= 224 && evt.keyCode <= 252) ||
            (evt.keyCode >= 48 && evt.keyCode <= 57) ||
            (evt.keyCode >= 65 && evt.keyCode <= 90) ||
            (evt.keyCode >= 97 && evt.keyCode <= 122))
            return true;
        return false;
    } else {
        alert("Su browser no es soportado por esta aplicaci?n")
    }
    return false;
}

function KeyIsRut(evt) {
    var isNav = (navigator.appName.indexOf("Netscape") != -1)
    var isIE = (navigator.appName.indexOf("Microsoft") != -1)
    if (isNav) {
        if ((evt.which >= 48 && evt.which == 57) // [0-9]
            ||
            evt.which == 75 // [K]
            ||
            (evt.which == 107)) // [k]
            return true;
        return false;
    } else if (isIE) {
        evt = window.event;
        if ((evt.keyCode >= 48 && evt.keyCode <= 57) ||
            evt.keyCode == 75 ||
            evt.keyCode == 107)
            return true;
        return false;
    } else {
        alert("Su browser no es soportado por esta aplicaci?n")
    }
    return false;
}

/*********************************************************/
function succesfull() {
    var urlSearch = window.location.search;
    if (urlSearch.indexOf("message") != -1) {
        alert(((urlSearch.substring(urlSearch.indexOf("message")).split("="))[1]).replace(/%20/gi, " "));
    }
}

function loadMotivos(idTipoMotivo, name) {


    combo = document.getElementById(name);

    if (idTipoMotivo.toUpperCase() === "Seleccione".toUpperCase()) {
        cleanCombo(combo);
    } else {
        $.ajax({
            url: "ViewLoadMotivosByTipoMotivo",
            data: "&idTipoMotivo=" + idTipoMotivo,
            type: "POST",
            async: false,
            success: function(data) {
                try {
                    opciones = eval(data);
                    cleanCombo(combo);

                    if (opciones.length > 0) {

                        for (var i = 0; i < opciones.length; i++) {
                            op = new Option(opciones[i].desc, opciones[i].id);
                            combo.add(op, undefined);
                        }
                    }
                } catch (e) {
                    alert(e);
                }
            }
        });
    }
}

function cleanCombo(combo) {
    try {
        combo.options.length = 0;
    } catch (e) {}
}
