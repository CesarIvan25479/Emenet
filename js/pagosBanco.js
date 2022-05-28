var costos = [0,450,400,350,300,250,200,150,500,450,600];
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
    fetch('../php/pagosBanco/agregarPago.php',{
        method: "POST",
        body: datosPago
    })
    .then(res => res.json())
    .then(data => {
        if(data.estado == "Agregado"){
            let mes = data.mes.replace(" ", "%20");
            $("#tablaPagosBanco").load("../pages/tablas/tablaPagosBanco.php?estado=PENDIENTE&mes=" + mes +"&todosreg=off");
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
    
    $("#AformaPago").on("change", ()=>{
        let pago = document.getElementById("AformaPago").value;
        $("#AnumeroOperacion").removeAttr('readonly');
        if(pago == "Efectivo Almoloya"){
            $("#AnumeroOperacion").attr('readonly','readonly');
            $('#AnumeroOperacion').val('');
        }
    });
    $("#AmesPago").on("change", ()=>{
        let concepto = document.getElementById("AmesPago").value;
        $('#Aobservacion').removeAttr("required");
        concepto == "OTRO" ? $("#Aobservacion").prop('required',true) : "";
    });
    
    $("#mosEsatado").on("change", mostrarTablaPagosBanco);
    $("#mosMes").on("change", mostrarTablaPagosBanco);
    $("#todosRegistros").on("click", mostrarTablaPagosBanco);
})

function mostrarTablaPagosBanco(){
    let estado = document.getElementById("mosEsatado").value;
    let mes = document.getElementById("mosMes").value;
    document.getElementById("buscarClientePago").value = "";
    mes = mes.replace(" ", "%20");
    let todosReg = document.getElementById("todosRegistros").checked ? "on" : "off";
    console.log(todosReg)
    $("#tablaPagosBanco").load("../pages/tablas/tablaPagosBanco.php?estado=" + estado +"&mes=" + mes +"&todosreg="+ todosReg);
}

function mostrarTablaPagosBancoCliente(){
    let estado = document.getElementById("mosEsatado").value;
    let mes = document.getElementById("mosMes").value;
    let nombre = document.getElementById("buscarClientePago").value;
    nombre = nombre.replaceAll(" ", "%20");
    mes = mes.replace(" ", "%20");
    let todosReg = document.getElementById("todosRegistros").checked ? "on" : "off";
    $("#tablaPagosBanco").load("../pages/tablas/tablaPagosBanco.php?estado=" + estado +"&mes=" + mes +"&todosreg="+ todosReg + "&nombre=" + nombre);
}
function pagoRegistrado(datos){
    $.ajax({
        type: "POST",
        url: "../php/pagosBanco/pagoRegistrado.php",
        dataType: "json",
        data: "cliente=" + datos,
        success:function(data){
            if(data.estado == "Actualizado"){
                mostrarTablaPagosBanco();
                Toast.fire({
                    icon: 'success',
                    title: `Pago registrado correctamente`
                })
            }else{
                Toast.fire({
                    icon: 'error',
                    title: `No se pudo actualizar el registro`
                })
            }
        }
    })
}
function pagoFinalizado(datos){
    $.ajax({
        type: "POST",
        url: "../php/pagosBanco/pagoFinalizado.php", 
        dataType: "json",
        data: "cliente=" + datos,
        success: (data) =>{
            if(data.estado == "Actualizado"){
                mostrarTablaPagosBanco();
                Toast.fire({
                    icon: 'success',
                    title: `Pago Finalizado correctamente`
                })
            }else{
                Toast.fire({
                    icon: 'error',
                    title: `No se pudo actualizar el registro`
                })
            }
        }
    });
}
document.getElementById("buscarClientePago").addEventListener('keydown', ()=>{
    let tecla = event.keyCode;
    if (tecla == 40 ){
        mostrarTablaPagosBancoCliente();
    }
}); 
const mostrarDatosPagos = (datos) =>{
    $.ajax({
        type: "POST",
        url: "../php/pagosBanco/mostrarDatosPago.php",
        dataType: "json",
        data: "cliente=" + datos,
        success: (data) =>{
            if(data == "error"){
                Toast.fire({
                    icon: 'error',
                    title: `No se tiene comunicacion con
                    la base de datos`
                })
            }else{
                document.getElementById("Aid").value = data.info.id;
                document.getElementById("Anombre").value = data.info.Nombre;
                document.getElementById("AnumeroOperacion").value = data.info.NumOperacion;
                document.getElementById("AmesPago").value = data.info.Mes;
                document.getElementById("Apago").value = data.info.Importe;
                document.getElementById("AformaPago").value = data.info.FormaPago;
                document.getElementById("AfechaDeposito").value = data.info.FechaPago;
                document.getElementById("Aobservacion").value = data.info.Observacion;
                let pago = document.getElementById("AformaPago").value;
                $("#AnumeroOperacion").removeAttr('readonly');
                if(pago == "Efectivo Almoloya"){
                    $("#AnumeroOperacion").attr('readonly','readonly');
                    $('#AnumeroOperacion').val('');
                }
                let concepto = document.getElementById("AmesPago").value;
                $('#Aobservacion').removeAttr("required");
                concepto == "OTRO" ? $("#Aobservacion").prop('required',true) : "";
                $("#modalActualizarPago").modal("show");
            }
        }
    })
}

const obtenerDatos = ()=>{
    let id = document.getElementById("Aid").value;
    let nombre = document.getElementById("Anombre").value;
    let numeroOperacion = document.getElementById("AnumeroOperacion").value;
    let mesPago = document.getElementById("AmesPago").value;
    let pago = document.getElementById("Apago").value;
    let formaPago = document.getElementById("AformaPago").value;
    let fechaPago = document.getElementById("AfechaDeposito").value;
    let observacion = document.getElementById("Aobservacion").value;
    return `id=${id}&nombre=${nombre}&numOperacion=${numeroOperacion}&mesPago=${mesPago}&pago=${pago}&formaPago=${formaPago}&fechaPago=${fechaPago}&observacion=${observacion}`;
}

const actualizarPago = () =>{
    $.ajax({
        type: "POST",
        url: "../php/pagosBanco/actualizarPago.php",
        dataType: "json",
        data: obtenerDatos(),
        success: (data)=>{
            if(data.estado == "Actualizado"){
                mostrarTablaPagosBanco();
                $('#modalActualizarPago').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: `Los datos del pago han sido
                    actualizados correctamente`
                })
            }else if(data.estado == "llenaCampos"){
                Toast.fire({
                    icon: 'info',
                    title: `Verifica la información 
                    LLena los campos solicitados`
                })
            }else if(data.estado == "errormes"){
                Toast.fire({
                    icon: 'warning',
                    title: `El pago del mes ya fue registrado
                    por favor verifica la información`
                })
            }else if(data.estado == "erroroperacion"){
                Toast.fire({
                    icon: 'warning',
                    title: `El Num. de operación ya fue registrado
                    Por favor verifica la información`
                })
            }
        }

    })
}
const borrarPago = () =>{
    if(confirm(`¿Estas seguro de Borrar este registro?`)){
        $.ajax({
            type: "POST",
            url: "../php/pagosBanco/borrarPago.php",
            dataType: "json",
            data: obtenerDatos(),
            success: (data) =>{
                if(data.estado == "borrado"){
                    Toast.fire({
                        icon: 'success',
                        title: `Pago Borrado con exito
                        ${data.id} ${data.nombre}`
                    })
                    mostrarTablaPagosBanco();
                    $('#modalActualizarPago').modal('hide');
                }else{
                    Toast.fire({
                        icon: 'error',
                        title: `no se pudo borrar el registro`
                    })
                }
            }
        })
    }
}