$(document).ready(()=>{
    $("#cliente").on('change', mostrarReporte);
    $("#oprime").click(mostrarReporte);
});

function mostrarReporte(){
    let formulario = document.getElementById('ActulizarReporte');
    let datos = new FormData(formulario);
    fetch('../php/datosReporte.php',{
        method: 'POST',
        body: datos
    })
    .then(res => res.json())
    .then(data =>{
        if(data.estado === 'mostrar' ){
            let cliente = data.cliente;
            let fechaInicio = data.fechaInicio;
            console.log(data)
            $('#tablaInternet').load(`../pages/tablas/tablaReportePagos.php?cliente=${cliente}&fechaInicio=${fechaInicio}`);
        }
    })
}
