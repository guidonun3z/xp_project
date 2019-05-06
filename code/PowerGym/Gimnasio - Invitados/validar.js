function validar(){
    var id, nombre, apellidoPaterno, numeroDocumento, fechaNacimiento, expresion;

    id = document.getElementById("id").value;
    nombre = document.getElementById("nombre").value;
    apellidoPaterno = document.getElementById("apellidoPaterno").value;
    numeroDocumento = document.getElementById("numeroDocumento").value;
    fechaNacimiento = document.getElementById("fechaNacimiento").value;

    //VALIDAR QUE HAYA TEXTO EN LOS CAMPOS
    if(id == ""){
        alert("el campo ID es necesariamente obligatorio");
        return false;
    }else{
        if(id.length > 6){
         alert("el campo ID solo necesita 6 caracteres como máximo");
         return false;
        }
    }

    if(nombre == ""){
        alert("el campo Nombre es obligatorio");
        return false;
    }

    if(apellidoPaterno == ""){
        alert("el campo Apellido Paterno es obligatorio");
        return false;
    }

    if(numeroDocumento == ""){
        alert("el campo Numero de documento es obligatorio");
        return false;
    }

    if(fechaNacimiento == ""){
        alert("el campo Fecha de Nacimiento es obligatorio");
        return false;
    }



    
}