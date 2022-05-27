document.getElementById("buscarCliente").addEventListener('keydown', ()=>{
    let tecla = event.keyCode;
    if (tecla == 40 ){
        let nombre = document.getElementById("buscarCliente").value;
        nombre = nombre.replaceAll(" ", "%20");
        $('#tablaClientes').load("../pages/tablas/tablaClientes.php?cliente=" + nombre);
    }
}); 
document.getElementById("btnBuscarCliente").addEventListener('click',() =>{
    let nombre = document.getElementById("buscarCliente").value;
    nombre = nombre.replaceAll(" ", "%20");
    $('#tablaClientes').load("../pages/tablas/tablaClientes.php?cliente=" + nombre);
});

function activar(datos){
    if(confirm(`¿Estas seguro de activar al cliente ${datos}?`)){
        let post = `cliente=${datos}`;
        $.ajax({
            type: 'POST',
            url: '../php/activarCliente.php',
            dataType: 'json',
            data: post,
            success: (data) =>{
                if(data.estado == "activado"){
                    let Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 20000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: `Cliente: ${data.cliente} 
                        Activado plan ${data.plan}
                        Router ${data.nombreRouter} ${data.ipRputer}`
                    });
                }else{
                    Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 20000
                    });
                    Toast.fire({
                        icon: 'warning',
                        title: `Sin conexión Verifica el API del router ${data.nombreRouter}`
                    })
                }
            }
        });
    }
}
function desactivar(datos){
    if(confirm(`¿Estas seguro de desactivar al cliente ${datos}?`)){
        post = 'cliente=' + datos;
        $.ajax({
            type: 'POST',
            url: '../php/desactivarCliente.php',
            dataType: 'json',
            data: post,
            success: (data) => {
                let cliente = data.infoCliente;
                let router = data.infoRouter.Nombre;
                if(data.estado == "errorrouter"){
                    let Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 20000
                    });
                    Toast.fire({
                        icon: 'warning',
                        title: `Sin conexión Verifica el API del router ${router}`
                    })
                }else{
                    Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    });
                    Toast.fire({
                        icon: 'error',
                        title: `Cliente ${cliente} desactivado router ${router} plan 1K/1K`
                    })
                }
            }
        });
    } 
}
function InfoCliente(datos){
    cadena = 'cliente=' + datos;
    $.ajax({
        type: 'POST',
        url: '../php/infoCliente.php',
        dataType: 'json',
        data: cadena,
        success: (data) =>{
            if(data.estado == "si"){
                document.getElementById('clave').value = data.info.CLIENTE;
                document.getElementById('nombre').value = data.info.NOMBRE;
                document.getElementById('estado').value = data.info.ESTADO;
                document.getElementById('cp').value = data.info.CP;
                document.getElementById('poblacion').value = data.info.POBLA;
                document.getElementById('colonia').value = data.info.COLONIA;
                document.getElementById('calle').value = data.info.CALLE;
                document.getElementById('telefono').value = data.info.TELEFONO;
                document.getElementById('clasificacion').value = data.info.TIPO;
                document.getElementById('zon').value = data.info.ZONA;
                document.getElementById('precio').value = data.info.PRECIO;
                document.getElementById('obsr').value = data.info.OBSERV;
                document.getElementById("numero").value = data.info.NUMERO;                
            }else{
                console.log("No conectado")
            }
        }
    });
}