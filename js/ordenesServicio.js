let Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});
let agregarOrden = document.getElementById("agregarOrden");
agregarOrden.addEventListener('submit', (e) => {
    e.preventDefault();
    var datosOrden = new FormData(agregarOrden);
    fetch("../php/ordenesServicio/agregarOrden.php", {
        method: "POST",
        body: datosOrden
    })
    .then(res => res.json())
    .then(data => {
        if(data.estado == "Agregado"){
            let fechInicio = $("#fechaInicio").val();
            let fechaFin = $("#fechaFin").val();
            Toast.fire({
                icon: 'success',
                title: `Información Guardada Correctamente
                Folio Orden: ${data.folio}`
            })
            $("#tablaOrdenes").load("../pages/tablas/tablaOrdenes.php?fechaInicio=" + fechInicio + "&fechaFin=" + fechaFin);
            $('#modalAgregarOrden').modal('hide');
            reinicar();
        }else if(data.estado == "tipoarchvio"){
            Toast.fire({
                icon: 'error',
                title: `Tipo de archvio incorrecto
                asegurate de cargar imagenes`
            })
            console.log("no es imagen");
        }else if(data.estado == "tamano"){
            Toast.fire({
                icon: 'error',
                title: `Verifica el tamaño de
                las imagenes menor 0.5Mb`
            })
        }else if(data.estado == "error"){
            Toast.fire({
                icon: 'error',
                title: `Asegurate de cargar la
                imagen de la orden y compromiso`
            })
        }else if(data.estado == "sinconexion"){
            Toast.fire({
                icon: 'error',
                title: `No se guardaron los datos
                verifica la información`
            })
        } 
    })
})
const reinicar = () =>{
    document.getElementById('agregarOrden').reset();
}
function mostrarTabla(){
    let fechInicio = $("#fechaInicio").val();
    let fechaFin = $("#fechaFin").val();
    let tipo = $("#filtrotipo").val();
    let instalacion  = $("#filtroins").val();
    tipo = tipo.replace(" ", "%20");
    $("#tablaOrdenes").load("../pages/tablas/tablaOrdenes.php?fechaInicio=" + fechInicio + "&fechaFin=" + fechaFin + "&tipo=" + tipo + "&instalacion=" + instalacion);
}
$(document).ready(()=>{
    mostrarTabla();
    $("#filtrotipo").on("change", ()=>{
        mostrarTabla();
    })
    $("#filtroins").on("change", () =>{
        mostrarTabla();
    })
    $("#fechaInicio").on("change", () =>{
        mostrarTabla();
    })
    $("#fechaFin").on("change", () =>{
        mostrarTabla();
    })
})
const actualizar = () =>{
    let actualizar = document.getElementById("actualizarOrden");
    var datosOrden = new FormData(actualizar);
    fetch("../php/ordenesServicio/actualizarOrden.php", {
        method: "POST",
        body: datosOrden
    })
    .then(res => res.json())
    .then(data =>{
        if(data.estado == "actualizado"){
            let fechInicio = $("#fechaInicio").val();
            let fechaFin = $("#fechaFin").val();
            Toast.fire({
                icon: 'success',
                title: `Información Actualizada correctamente
                Folio Orden: ${data.folio}`
            })
            $("#tablaOrdenes").load("../pages/tablas/tablaOrdenes.php?fechaInicio=" + fechInicio + "&fechaFin=" + fechaFin);
            $('#modalActualizarOrden').modal('hide');
        }else{
            Toast.fire({
                icon: 'error',
                title: `No se guardaron los datos
                verifica la conexión`
            })
        }
    })
}
const borrar = () =>{
    let actualizar = document.getElementById("actualizarOrden");
    var datosOrden = new FormData(actualizar);
    fetch("../php/ordenesServicio/borrarOden.php",{
        method: "POST", 
        body: datosOrden
    })
    .then(res => res.json())
    .then(data =>{
        if(data.estado == "Borrado"){
            let fechInicio = $("#fechaInicio").val();
            let fechaFin = $("#fechaFin").val();
            Toast.fire({
                icon: 'success',
                title: `Orden eliminada correctamente
                Folio Orden: ${data.folio}`
            })
            $("#tablaOrdenes").load("../pages/tablas/tablaOrdenes.php?fechaInicio=" + fechInicio + "&fechaFin=" + fechaFin);
            $('#modalActualizarOrden').modal('hide');
        }else{
            console.log("no se pudo borrar")
        }
    })
}
const mostrarDatosAct = (datos) =>{
    datos = datos.split("||");
    document.getElementById("actuFolioOrden").value = datos[0];
    document.getElementById("actuNombre").value = datos[1];
    document.getElementById("actuFechaInst").value = datos[2];
    document.getElementById("actuTipoServicio").value = datos[3];
    document.getElementById("actuTipoIns").value = datos[4];
}