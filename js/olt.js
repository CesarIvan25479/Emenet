function sweetAlert(tipo, mensaje, tiempo) {
    let Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: tiempo
    });
    Toast.fire({
        icon: tipo,
        title: mensaje
    })
}

function agregarOLT() {
    formulario = document.getElementById("agregarOlt");
    datos = new FormData(formulario);
    fetch("../php/olt/agregar.php", {
        method: "POST",
        body: datos,
    })
        .then(res => res.json())
        .then(data => {
            if (data.estado == "sinconexion") {
                let mensaje = `No se puede guardar la información
                verifica la conexión`
                sweetAlert("error", mensaje, 10000);
            } else {
                $('#modalAgregarOlt').modal('hide');
                document.getElementById("agregarOlt").reset();
                $('#contTablaOlt').load('../panel/tablas/tablaOlts.php');
                let mensaje = `Información OLT ${data.info.nombreolt} Guardada correctamente`;
                sweetAlert("success", mensaje, 10000)
            }
        });
}
function actualizarOLT(){
    let formulario = document.getElementById("actualizarOlt");
    let datos = new FormData(formulario);
    fetch("../php/olt/actualizar.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        if (data.estado == "sinconexion") {
            let mensaje = `No se puede guardar la información
            verifica la conexión`
            sweetAlert("error", mensaje, 10000);
        } else {
            $('#modalActualizarOlt').modal('hide');
            document.getElementById("actualizarOlt").reset();
            $('#contTablaOlt').load('../panel/tablas/tablaOlts.php');
            let mensaje = `Información OLT ${data.info.nombreolt} Guardada correctamente`;
            sweetAlert("success", mensaje, 10000)
        }
    })
}

function borrarOLT(){
    let formulario = document.getElementById("actualizarOlt");
    let datos = new FormData(formulario);
    fetch("../php/olt/borrar.php", {
        method: "POST",
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        if (data.estado == "sinconexion") {
            let mensaje = `No se puede guardar la información
            verifica la conexión`
            sweetAlert("error", mensaje, 10000);
        } else {
            $('#modalActualizarOlt').modal('hide');
            document.getElementById("actualizarOlt").reset();
            $('#contTablaOlt').load('../panel/tablas/tablaOlts.php');
            let mensaje = `Información OLT ${data.info.nombreolt} Borrada correctamente`;
            sweetAlert("success", mensaje, 10000)
        }
    });
}

function mostrarInfo(reference) {
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: "../php/olt/mostrarInfo.php",
        data: "ref=" + reference,
        success: (data) => {
            if (data.estado == "sinconexion") {
                let mensaje = `No se puede guardar la información
                verifica la conexión`
                sweetAlert("error", mensaje, 10000);
            } else {
                $("#aidolt").val(data.info.id);
                $("#anombreolt").val(data.info.nombre);
                $("#aservidorolt").val(data.info.servidor);
                $("#ausuarioolt").val(data.info.usuario);
                $("#apasswordolt").val(data.info.pwd);
                $("#apuertoTelnet").val(data.info.ptoTelnet);
            }
        }
    });
}