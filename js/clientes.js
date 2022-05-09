document.getElementById("buscarCliente").addEventListener('keydown', ()=>{
    let tecla = event.keyCode;
    tecla == 40 ? $('#tablaClientes').load('../pages/tablas/tablaClientes.php') : '' ;
}); 
document.getElementById("btnBuscarCliente").addEventListener('click',() =>{
    alert("Boton");
});