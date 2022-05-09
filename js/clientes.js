document.getElementById("buscarCliente").addEventListener('keydown', ()=>{
    let tecla = event.keyCode;
    if(tecla == 40){
        alert("daf")
        $('#tablaClientes').load('../pages/tablas/tablaClientes.php');
    }
}); 
