document.getElementById("buscarCliente").addEventListener('keydown', () => {
    let tecla = event.keyCode;
    if (tecla == 40) {
        cargarTabla();
    }
});

document.getElementById("btnBuscarCliente").addEventListener('click', () => {
    cargarTabla();
});

$(document).ready(() => {
    $("#filtClasi").on("change", () => {
        cargarTabla();
    })
    $("#filtZona").on("change", () => {
        cargarTabla();
    })
})

const cargarTabla = () => {
    let nombre = document.getElementById("buscarCliente").value;
    let zona = document.getElementById("filtZona").value;
    let clasi = document.getElementById("filtClasi").value;
    nombre = nombre.replaceAll(" ", "%20");
    $('#tablaClientes').load("../panel/tablas/tablaClientes.php?cliente=" + nombre + "&zona=" + zona + "&clasi=" + clasi);
}

function activar(datos) {
    if (confirm(`¿Estas seguro de activar al cliente ${datos}?`)) {
        let post = `cliente=${datos}`;
        $.ajax({
            type: 'POST',
            url: '../php/activarCliente.php',
            dataType: 'json',
            data: post,
            success: (data) => {
                if (data.estado == "activado") {
                    let Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 20000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: `Cliente: ${data.cliente} 
                        Activado plan ${data.plan}
                        Router ${data.nombreRouter} ${data.ipRputer}`
                    });
                    estadoCliente.classList.remove("suspendido");
                    estadoCliente.classList.add("activo");
                    estadoCliente.innerText = "Activo"
                    estadoCliente.style.display = "block";
                } else {
                    Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 20000
                    });
                    Toast.fire({
                        icon: 'warning',
                        title: `Sin conexión Verifica el API del router ${data.nombreRouter}`
                    })
                }
            }
        });
    }
}
function desactivar(datos) {
    if (confirm(`¿Estas seguro de desactivar al cliente ${datos}?`)) {
        post = 'cliente=' + datos;
        $.ajax({
            type: 'POST',
            url: '../php/desactivarCliente.php',
            dataType: 'json',
            data: post,
            success: (data) => {
                let cliente = data.infoCliente;
                let router = data.infoRouter.Nombre;
                if (data.estado == "errorrouter") {
                    let Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 20000
                    });
                    Toast.fire({
                        icon: 'warning',
                        title: `Sin conexión Verifica el API del router ${router}`
                    })
                } else {
                    Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    });
                    Toast.fire({
                        icon: 'error',
                        title: `Cliente ${cliente} desactivado router ${router} plan 1K/1K`
                    })
                    estadoCliente.classList.remove("activo");
                    estadoCliente.classList.add("suspendido");
                    estadoCliente.innerText = "Suspendido";
                    estadoCliente.style.display = "block";
                }
            }
        });
    }
}

function statusDHCP(data) {
    if (data.estadoDHCP == "NO") {
        estadoDHCP.style.display = "none";
    } else {
        if (data.estadoDHCP == "bound") {
            estadoDHCP.classList.remove("suspendido");
            estadoDHCP.classList.add("activo");
            estadoDHCP.innerText = data.estadoDHCP;
            estadoDHCP.style.display = "block";
        } else {

            estadoDHCP.classList.remove("activo");
            estadoDHCP.classList.add("suspendido");
            estadoDHCP.innerText = data.estadoDHCP;
            estadoDHCP.style.display = "block";
        }

    }
}
function statusQUEUE (data){
    const estadoCliente = document.getElementById("statusCliente");
    if (data.status == "1000/1000" || data.status == "Inactivo") {
        estadoCliente.classList.remove("activo");
        estadoCliente.classList.add("suspendido");
        estadoCliente.innerText = data.status != "Inactivo" ? "Suspendido" : "Inactivo";
        estadoCliente.style.display = "block";
    } else {
        estadoCliente.classList.remove("suspendido");
        estadoCliente.classList.add("activo");
        estadoCliente.innerText = "Activo"
        estadoCliente.style.display = "block";
    }
}
function InfoCliente(datos) {
    cadena = 'cliente=' + datos;
    const cargando = document.getElementById("cargando");
    cargando.innerHTML = `<div id="verificando" class="spinner"></div>`;
    $.ajax({
        type: 'POST',
        url: '../php/infoCliente.php',
        dataType: 'json',
        data: cadena,
        success: (data) => {
            if (data.estado == "si") {
                document.getElementById('clave').value = data.info.CLIENTE;
                document.getElementById('nombre').value = data.info.NOMBRE;
                document.getElementById('estado').value = data.info.ESTADO;
                document.getElementById('cp').value = data.info.CP;
                document.getElementById('poblacion').value = data.info.POBLA;
                document.getElementById('colonia').value = data.info.COLONIA;
                document.getElementById('calle').value = data.info.CALLE;
                document.getElementById('telefono').value = data.info.TELEFONO;
                document.getElementById('clasificacion').value = data.info.TIPO;
                document.getElementById('zon').value = data.info.ZONA;
                document.getElementById('precio').value = data.info.PRECIO;
                document.getElementById('obsr').value = data.info.OBSERV;
                document.getElementById("numero").value = data.info.NUMERO;
                document.getElementById('IP').value = data.target.slice(0, -3);
                document.getElementById("vinculoIP").href = "http://" + data.target.slice(0, -3);
                
                //Verifica el estatus del QUEUE
                statusQUEUE(data);
                //Verifica el estatus del DHCP leases
                statusDHCP(data);

                cargando.innerHTML = "";
            } else {
                console.log("No conectado")
            }
        }
    });
}