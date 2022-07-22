let Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});
const conexion = () => {
    let verificando = document.getElementById("btn-comprobar");
    verificando.innerHTML = `<div id="verificando" class="spinner"></div>`;
    let formulario = document.getElementById("agregarRouter");
    let datosRouter = new FormData(formulario);
    $.ajax({
        type: "POST",
        url: "../php/routers/revisarConexion.php",
        dataType: "json",
        data: datosRouter,
        contentType: false,
        processData: false,
        success: (data) => {
            if (data.estado == "si") {
                verificando.innerHTML = `Conexión Exitosa <i class="fa fa-check"></i>`;
            } else {
                verificando.innerHTML = `Sin Conexión <i class="fa-solid fa-cloud-xmark"></i>`;
            }
        }
    })
}
const aconexion = () => {
    let verificando = document.getElementById("abtn-comprobar");
    verificando.innerHTML = `<div id="verificando" class="spinner"></div>`;
    let formulario = document.getElementById("actualizarRouter");
    let datosRouter = new FormData(formulario);
    $.ajax({
        type: "POST",
        url: "../php/routers/revisarConexion.php",
        dataType: "json",
        data: datosRouter,
        contentType: false,
        processData: false,
        success: (data) => {
            if (data.estado == "si") {
                verificando.innerHTML = `Conexión Exitosa <i class="fa fa-check"></i>`;
            } else {
                verificando.innerHTML = `Sin Conexión <i class="fa-solid fa-cloud-xmark"></i>`;
            }
        }
    })
}
const guardarRouter = () => {
    let formulario = document.getElementById("agregarRouter");
    let datosRouter = new FormData(formulario);
    $.ajax({
        type: "POST",
        url: "../php/routers/agregarRouter.php",
        dataType: "json",
        data: datosRouter,
        contentType: false,
        processData: false,
        success: (data) => {
            if (data.estado == "guardado") {
                formRequired();
                $('#modalAgregarRouter').modal('hide');
                document.getElementById("agregarRouter").reset();
                Toast.fire({
                    icon: 'success',
                    title: `Información de router ${data.info} guardado correctamente`
                })
                $('#tablaRouter').load("./tablas/tablaRouters.php");
                document.getElementById("btn-comprobar").innerText = "Comprobar Conexión";
            } else {
                formRequired();
            }
        }
    })
}

const formRequired = () => {
    $("#nombreRouter").val() == "" ? $("#nombreRouter").prop('required', true) : $("#nombreRouter").prop('required', false);
    $("#ipRouter").val() == "" ? $("#ipRouter").prop("required", true) : $("#ipRouter").prop("required", false);
    $("#usuarioRouter").val() == "" ? $("#usuarioRouter").prop("required", true) : $("#usuarioRouter").prop("required", false);
    $("#passwordRouter").val() == "" ? $("#passwordRouter").prop("required", true) : $("#passwordRouter").prop("required", false);
    $("#puertoApi").val() == "" ? $("#puertoApi").prop("required", true) : $("#puertoApi").prop("required", false);
    $("#zonas").val() == "" ? $("#zonas").prop("required", true) : $("#zonas").prop("required", false);
}

const mostrarInfo = (datos) => {
    $("#abtn-comprobar").text("Comprobar Conexión");
    let info = "idRouter=" + datos;
    $.ajax({
        type: "POST",
        url: "../php/routers/mostrarInfo.php",
        dataType: "json",
        data: info,
        success: (data) => {
            $("#anombreRouter").val(data.info.Nombre);
            $("#idRouter").val(data.info.id);
            $("#aipRouter").val(data.info.IP);
            $("#ausuarioRouter").val(data.info.Usuario);
            $("#apasswordRouter").val(data.info.Pwd);
            $("#apuertoApi").val(data.info.PuertoAPI);
            $("#atipoServicio").val(data.info.Tipo);
            $("#azonas").val(data.info.Zonas);
        }
    })
}

const borrarRouter = () => {
    let formulario = document.getElementById("actualizarRouter");
    let datosRouter = new FormData(formulario);
    $.ajax({
        type: "POST",
        url: "../php/routers/borrarRouter.php",
        dataType: "json",
        data: datosRouter,
        contentType: false,
        processData: false,
        success: (data) => {
            if (data.estado == "error") {
                Toast.fire({
                    icon: 'error',
                    title: `No se pudo borrar Verifica la conexión`
                })
            } else {
                $('#modalActualizarRouter').modal('hide');
                document.getElementById("actualizarRouter").reset();
                Toast.fire({
                    icon: 'success',
                    title: `Información de router ${data.info} borrada correctamente`
                })
                $('#tablaRouter').load("./tablas/tablaRouters.php");
            }
        }
    })

}

const actualizarRouter = () => {
    let formulario = document.getElementById("actualizarRouter");
    let datosRouter = new FormData(formulario);
    $.ajax({
        type: "POST",
        url: "../php/routers/actulizarRouter.php",
        dataType: "json",
        data: datosRouter,
        contentType: false,
        processData: false,
        success: (data) => {
            if (data.estado == "error") {
                Toast.fire({
                    icon: 'error',
                    title: `No se pudo borrar Verifica la conexión`
                })
            }else{
                $('#modalActualizarRouter').modal('hide');
                document.getElementById("actualizarRouter").reset();
                Toast.fire({
                    icon: 'success',
                    title: `Información de router ${data.info} actualizada correctamente`
                })
                $('#tablaRouter').load("./tablas/tablaRouters.php");
            }
        }
    })
}