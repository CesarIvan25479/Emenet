document.getElementById("buscarCliente").addEventListener('keydown', ()=>{
    let tecla = event.keyCode;
    if(tecla == 40){
        $('#tablaClientes').load('../tablas/tablaClientes.php');
    }
}); 
