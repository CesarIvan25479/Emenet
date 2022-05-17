let Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 20000
});
$(document).ready(()=>{
    $("#cliente").on('change', mostrarReporte);
    $("#oprime").click(mostrarReporte);
    $("#opcion").on('change', mostrarReporte);
    $("#FechaIn").on('change', mostrarReporte);
    $("#todasFechas").click(mostrarReporte);
    $("#todosConceptos").click(mostrarReporte);
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
        $('#tablaTelefono').empty();
        $('#tablaCamara').empty();
        if(data.todosConceptos == false){
            if(data.servicioCamara >= 1){
                $("#tablaCamara").load(`../pages/tablas/tablaCamara.php?cliente=${data.cliente}&fechaInicio=${data.fechaInicio}&numCam=${data.servicioCamara}&todasFechas=${data.todasFechas}`);
            }

            if(data.servicioTelefono >= 1){
                $("#tablaTelefono").load(`../pages/tablas/tablaTelefono.php?cliente=${data.cliente}&fechaInicio=${data.fechaInicio}&numTel=${data.servicioTelefono}&todasFechas=${data.todasFechas}`);
            }

            if(data.estado === 'mostrar' ){
                $('#tablaInternet').load(`../pages/tablas/tablaInternet.php?cliente=${data.cliente}&fechaInicio=${data.fechaInicio}&todasFechas=${data.todasFechas}`);
            }else if(data.estado == "mostrarActivar"){
                $('#tablaInternet').load(`../pages/tablas/tablaInternet.php?cliente=${data.cliente}&fechaInicio=${data.fechaInicio}&todasFechas=${data.todasFechas}`);
                if(data.estadoReporte == "adeudo"){
                    Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 20000
                    });
                    Toast.fire({
                        icon: 'warning',
                            title: `El cliente ${data.cliente} tiene adeudo 
                            en sus pagos`
                    });
                }else if(data.estadoReporte == "corriente"){
                    Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 20000
                    });
                    Toast.fire({
                        icon: 'success',
                            title: `Cliente: ${data.cliente} 
                            Activado plan ${data.plan}
                            Router ${data.nombreRouter} ${data.ipRouter}`
                    });
                }else if(data.estadoReporte == "sinconexion"){
                    Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 20000
                    });
                    Toast.fire({
                        icon: 'error',
                            title: `Sin Conexión verifica el API del router ${data.nombreRouter}`
                    });
                }
            }
        }else{
            $('#tablaInternet').load(`../pages/tablas/tablaInternet.php?cliente=${data.cliente}&fechaInicio=${data.fechaInicio}&todasFechas=${data.todasFechas}&todasConceptos=${data.todosConceptos}`);
        }
    })
}
