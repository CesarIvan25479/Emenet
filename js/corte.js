const pasarIdRouter = (datos) =>{
    d = datos.split("||");
    $("#idRouterCorte").val(d[0]);
    document.getElementById("tituloModal").innerText = `Corte ${d[1]}`
}