$(document).ready(() => {
    $("#olt").on("change", () => {
        setTimeout(() => {
            $("#puerto").load("../panel/tablas/puertoOpt.php?interface=" + interface.value.replace(" ", "%20"));
        },500)
        $("#interface").load("../panel/tablas/InterfaceOpt.php?olt_id=" + olt.value.replace(" ", "%20"));
    });
    $("#interface").on("change", () => {
        $("#puerto").load("../panel/tablas/puertoOpt.php?interface=" + interface.value.replace(" ", "%20"));
    });
    $("#puerto").on("change", () => {
        
        $("#caja").load("../panel/tablas/CajasOpt.php?puerto=" + puerto.value.replace(" ", "%20"));
    });
    $("#caja").on("change", () => {
        console.log(caja.value)
        console.log(puerto.value)
        $("#ontId").load("../panel/tablas/ontidOpt.php?puerto=" + puerto.value.replace(" ", "%20") + "&caja=" + caja.value.replace(" ", "%20"));
    });

    $("#ontId").on("change", () => {
        let datos = new FormData(datosgpon)
        fetch("../php/olt/datosPunteo.php", {
            method: "POST",
            body: datos
        })
        .then(response => response.json())
        .then(data => {
            if(data.estado == "error"){
                alert("Error al consultar datos")
            }else{  
                console.log(data.info)
                let interface = data.info.interface.split("/");
                let frame = interface[0]
                let slot = interface[1];
                frameID.value = frame;
                slotID.value = slot;
                portId.value = data.info.numPuerto;
                console.log(data.info.ontID)
                ontIDPun = data.info.ontID;
                lineProfile.value = data.info.lineProfile;
                srvProfile.value = data.info.serviceProfile;
                vlanInternet.value = data.info.vlanInternet;
                vlanHotspot.value = data.info.vlanHotspot;
                indexInternet.value = data.info.serPort;
                indexVoip.value = data.info.serPort2;

            }
        })
    });

});



const mostrarONTActivos = () => {
    
}
mostrarONTAct.addEventListener("click", () => {
    let datos = new FormData(datosgpon);
    fetch("../php/punteo/buscarONT.php", {
        method: "POST",
        body: datos,
    })
    .then(res => res.json())
    .then(data => {
        console.log(data)
    })
})