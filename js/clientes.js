document.getElementById("buscarCliente").addEventListener('keydown', ()=>{
    let tecla = event.keyCode;
    tecla == 40 ? $('#tablaClientes').load('../pages/tablas/tablaClientes.php?nombre=2022&') : '' ;
}); 
document.getElementById("btnBuscarCliente").addEventListener('click',() =>{
    alert("Boton");
});