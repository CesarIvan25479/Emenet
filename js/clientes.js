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
    let post = `cliente=${datos}`;
    $.ajax({
        type: 'POST',
        url: '../php/activarCliente.php',
        dataType: 'json',
        data: post,
        success: (data) =>{
            if(data.estado == "si"){
                console.log("conectado")
            }else{
                console.log("no conectado")
            }
        }
    });
}
function desactivar(datos){
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
                let mensaje = document.getElementById('menActivar');
                let texto = `<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Sin conexión</h5>
                Verifica el API del router ${router}
              </div>`;
                mensaje.innerHTML = texto;
            }else{
                let mensaje = document.getElementById('menActivar');
                let texto = `<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Cliente ${cliente} desactivado </h5>
                Router ${router} Plan 1K/1K 
              </div>`;
                mensaje.innerHTML = texto;
            }
        }
    });
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