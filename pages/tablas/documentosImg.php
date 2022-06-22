<?php
include "../../php/ConexionMySQL.php";
$folio  = $_GET["folio"];
$query = "SELECT ImgCompromiso, ImgCredencial, ImgOrden, Cliente FROM ordenes WHERE Folio = '$folio'";
$result = mysqli_query($Conexion, $query);
$datosImagenes = mysqli_fetch_array($result);
?>
<div class="row">
    <div class="col-sm-2">
        <a href="../imagenesOrden/orden/<?= $datosImagenes['ImgOrden'] ?>" data-toggle="lightbox" data-title="Orden" data-gallery="gallery">
            <img src="../pages/asset/orden-procesada.png" class="img-fluid mb-2" alt="black sample" />
        </a>
        <div class="input-group">
            <div class="custom-file">
                <form id="imagenOrden" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $folio ?>" name="folioAct">
                    <input type="file" class="custom-file-input" id="imgOrden" name="imgOrden">
                    <label class="custom-file-label" for="imgOrden">Orden</label>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-2">
        <?php if ($datosImagenes['ImgCredencial'] != "" or $datosImagenes['ImgCredencial'] != null) : ?>
            <a href="../imagenesOrden/credencial/<?= $datosImagenes['ImgCredencial'] ?>" data-toggle="lightbox" data-title="Credencial" data-gallery="gallery">
                <img src="../pages/asset/tarjeta-de-identificacion.png" class="img-fluid mb-2" alt="black sample" />
            </a>
        <?php else : ?>
            <a href="../pages/asset/tarjeta-de-identificacion.png" data-toggle="lightbox" data-title="Credencial" data-gallery="gallery">
                <img src="../pages/asset/tarjeta-de-identificacion.png" class="img-fluid mb-2" alt="black sample" />
            </a>
        <?php endif; ?>
        <div class="input-group">
            <div class="custom-file">
                <form id="imagenCredencial" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $folio ?>" name="folioAct">
                    <input type="file" class="custom-file-input" id="imgCredencial" name="imgCredencial">
                    <label class="custom-file-label" for="imgCredencial">Credencial</label>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-2">
        <a href="../imagenesOrden/compromiso/<?= $datosImagenes['ImgCompromiso'] ?>" data-toggle="lightbox" data-title="Compromiso" data-gallery="gallery">
            <img src="../pages/asset/lista-de-verificacion.png" class="img-fluid mb-2" alt="black sample" />
        </a>
        <div class="input-group">
            <div class="custom-file">
                <form id="imagenCom" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $folio ?>" name="folioAct">
                    <input type="file" class="custom-file-input" id="imgComp" name="imgComp">
                    <label class="custom-file-label" for="imgComp">Compromiso </label>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    
    $(function() {
        bsCustomFileInput.init();
    });

    $(document).ready(() => {
        const validar = (data) => {
            if (data.estado == "actualizado") {
                Toast.fire({
                    icon: 'success',
                    title: `Información Guardada Correctamente
                Folio Orden: ${data.folio}`
                })
                $("#documentosImg").load("../pages/tablas/documentosImg.php?folio=" + data.folio);
            } else if (data.estado == "tamano") {
                Toast.fire({
                    icon: 'error',
                    title: `Verifica el tamaño de las imagenes 
                tamaño menor a 0.5Mb`
                })
            } else if (data.estado == "tipoarchvio") {
                Toast.fire({
                    icon: 'error',
                    title: `Tipo de archvio incorrecto asegurate 
                de cargar imagenes`
                })
            } else if (data.estado == "error") {
                Toast.fire({
                    icon: 'error',
                    title: `No se pudo cargar la imagen
                porfavor intentalo de nuevo`
                })
            } else if (data.estado == "sinconexion") {
                Toast.fire({
                    icon: 'error',
                    title: `No se guardaron los datos
                verifica la información`
                })
            }
        }

        $("#imgOrden").on("change", () => {
            let formImgOrden = document.getElementById("imagenOrden");
            let datosImagen = new FormData(formImgOrden);
            fetch("../php/ordenesServicio/actualizarImagenes.php", {
                    method: "POST",
                    body: datosImagen,
                })
                .then(res => res.json())
                .then(data => {
                    validar(data);
                })
        });

        $("#imagenCredencial").on("change", () => {
            let formImgCredencial = document.getElementById("imagenCredencial");
            let datosImagen = new FormData(formImgCredencial);
            fetch("../php/ordenesServicio/actualizarImagenes.php", {
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
            fetch("../php/ordenesServicio/actualizarImagenes.php", {
                    method: "POST",
                    body: datosImagen,
                })
                .then(res => res.json())
                .then(data => {
                    validar(data);
                })

        })
    });
</script>