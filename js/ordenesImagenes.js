let Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});
$(document).ready(() => {

    const validar = (data) =>{
        if(data.estado == "actualizado"){
            Toast.fire({
                icon: 'success',
                title: `Información Guardada Correctamente
                Folio Orden: ${data.folio}`
            })
        }else if(data.estado == "tamano"){
            Toast.fire({
                icon: 'error',
                title: `Verifica el tamaño de las imagenes 
                tamaño menor a 0.5Mb`
            })
        }else if(data.estado == "tipoarchvio"){
            Toast.fire({
                icon: 'error',
                title: `Tipo de archvio incorrecto asegurate 
                de cargar imagenes`
            })
        }else if(data.estado == "error"){
            Toast.fire({
                icon: 'error',
                title: `No se pudo cargar la imagen
                porfavor intentalo de nuevo`
            })
        }else if(data.estado == "sinconexion"){
            Toast.fire({
                icon: 'error',
                title: `No se guardaron los datos
                verifica la información`
            })
        }
    }

    $("#imgOrden").on("change", () =>{
        let formImgOrden = document.getElementById("imagenOrden");
        let datosImagen = new FormData(formImgOrden);
        fetch("../php/ordenesServicio/actualizarImagenes.php",{
            method: "POST",
            body: datosImagen,
        })
        .then(res => res.json())
        .then(data =>{
            validar(data);
        })
    });

    $("#imagenCredencial").on("change", () =>{
        let formImgCredencial = document.getElementById("imagenCredencial");
        let datosImagen = new FormData(formImgCredencial);
        fetch("../php/ordenesServicio/actualizarImagenes.php",{
            method: "POST",
            body: datosImagen,
        })
        .then(res => res.json())
        .then(data => {
            validar(data);
        })
    })

    $("#imgComp").on("change", () => {
        let formImgCom = document.getElementById("imagenCom");
        let datosImagen = new FormData(formImgCom);
        fetch("../php/ordenesServicio/actualizarImagenes.php",{
            method: "POST",
            body: datosImagen,
        })
        .then(res => res.json())
        .then(data => {
            validar(data);
        })

    })
});