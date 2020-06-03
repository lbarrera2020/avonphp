function cargarCombo (url, comboAnterior, element_id) {
    //Obtenemos el contenido del div
    //donde se cargaran los resultados
    var element =  document.getElementById(element_id);
    //Obtenemos el valor seleccionado del combo anterior
    var valordepende = document.getElementById(comboAnterior)
    var x = valordepende.value
    //construimos la url definitiva
    //pasando como parametro el valor seleccionado
    var fragment_url = url+'?id='+x;
    element.innerHTML = 'Cargando...';
    //abrimos la url
    peticion.open("GET", fragment_url);
    peticion.onreadystatechange = function() {
        if (peticion.readyState == 4) {
            //escribimos la respuesta
            element.innerHTML = peticion.responseText;
        }
    }
    peticion.send(null);
}
function cargarDiv(div,url)
{
    $(div).load(url);
}

function runajax(serverPage, objID){
    xmlhttp = define_xmlhttp();
    // ejecutando ajax
    var obj = document.getElementById(objID);
    xmlhttp.open("POST", serverPage);
    xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
            obj.innerHTML = xmlhttp.responseText;
        }
        else{
            obj.innerHTML = "<img src='img/loading.gif'>";
        }
    }
    xmlhttp.send(null);
}