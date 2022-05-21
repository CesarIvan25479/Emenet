var costos = ["",450,400,350,300,250,200,150,500,450,600];
let Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});
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
        if(data.estado == "Agregado"){
            let mes = data.mes.replace(" ", "%20");
            $("#tablaPagosBanco").load("../pages/tablas/tablaPagosBanco.php?mes=" + mes);
            Toast.fire({
                icon: 'success',
                title: `Pago registrado
                ${data.nombre} concepto ${data.mes}`
            })
            $("#numeroOperacion").removeAttr('readonly');
            $('#observacion').removeAttr("required");
            document.getElementById('agregarPago').reset();
            $('#modalAgregarPago').modal('hide');
        }else if(data.estado == "errormes"){
            Toast.fire({
                icon: 'warning',
                title: `El pago del mes ya fue registrado
                por favor verifica la información`
            })
        }else if(data.estado == "llenaCampos"){
            Toast.fire({
                icon: 'info',
                title: `Verifica la información 
                LLena los campos solicitados`
            })
        }else if(data.estado == "erroroperacion"){
            Toast.fire({
                icon: 'warning',
                title: `El Num. de operación ya fue registrado
                Por favor verifica la información`
            })
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
                    document.getElementById("telefono").value = data.info.TELEFONO;
                    document.getElementById("poblacion").value = data.info.COLONIA;
                }
            }
        })
    });
    $("#formaPago").on("change", ()=>{
        let pago = document.getElementById("formaPago").value;
        $("#numeroOperacion").removeAttr('readonly');
        if(pago == "Efectivo Almoloya"){
            $("#numeroOperacion").attr('readonly','readonly');
            $('#numeroOperacion').val('');
        }
    });
    $("#mesPago").on("change", ()=>{
        let concepto = document.getElementById("mesPago").value;
        $('#observacion').removeAttr("required");
        concepto == "OTRO" ? $("#observacion").prop('required',true) : "";
    });


    $("#mosEsatado").on("change", mostrarTablaPagosBanco);
    $("#mosMes").on("change", mostrarTablaPagosBanco);
    $("#todosRegistros").on("click", mostrarTablaPagosBanco);
})

function mostrarTablaPagosBanco(){
    let estado = document.getElementById("mosEsatado").value;
    let mes = document.getElementById("mosMes").value;
    mes = mes.replace(" ", "%20");
    let todosReg = document.getElementById("todosRegistros").checked ? "on" : "off";
    console.log(mes)
    $("#tablaPagosBanco").load("../pages/tablas/tablaPagosBanco.php?estado=" + estado +"&mes=" + mes +"&todosreg="+ todosReg);
}

