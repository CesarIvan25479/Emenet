var costos = ["",450,400,350,300,250,200,150,500,450,600];
let agregarPago = document.getElementById("agregarPago");
agregarPago.addEventListener('submit',(e) =>{
    e.preventDefault();
    var datosPago = new FormData(agregarPago);
    fetch('../php/agregarPago.php',{
        method: "POST",
        body: datosPago
    })
    .then(res => res.json())
    .then(data => {
        if(data.estado == "si"){
            console.log("Conectado");
        }
    });
})


$(document).ready(() =>{
    $("#liCliente").on('change',()=>{
        let cliente = "cliente=" + document.getElementById("liCliente").value;
        $.ajax({
            type: "POST",
            url: "../php/infoCliente.php",
            dataType: "json",
            data: cliente,
            success:function(data){
                if(data.estado == "si"){
                    let costo = parseInt(data.info.PRECIO);
                    document.getElementById("nombre").value = data.info.NOMBRE;
                    document.getElementById("pago").value = costos[costo];
                }
            }
        })
    })
})
