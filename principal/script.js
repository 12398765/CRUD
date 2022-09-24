listarProductos();

var cod = document.getElementById("codigo");
var produc = document.getElementById("producto");
var precio = document.getElementById("precio");
var cant = document.getElementById("cantidad");

var val_codigo = document.querySelector(".val_codigo");
var val_produc = document.querySelector(".val_producto");
var val_precio = document.querySelector(".val_precio");
var val_cant = document.querySelector(".val_cantidad");

const clear = function () {
    cod.setAttribute("style", ""); val_codigo.setAttribute("style", "");
    cod.innerHTML = ""; val_codigo.innerHTML = "";
    produc.setAttribute("style", ""); val_produc.setAttribute("style", "");
    produc.innerHTML = ""; val_produc.innerHTML = "";
    precio.setAttribute("style", ""); val_precio.setAttribute("style", "");
    precio.innerHTML = ""; val_precio.innerHTML = "";
    cant.setAttribute("style", ""); val_cant.setAttribute("style", "");
    cant.innerHTML = ""; val_cant.innerHTML = "";
}


var condicion = 0;

function esNumero(dato) {
    /*Definición de los valores aceptados*/
    var valoresAceptados = /^[0-9]+$/;
    if (dato.indexOf(".") == -1) {
        if (dato.match(valoresAceptados)) {
            return true;
        } else {
            return false;
        }
    } else {
        //dividir la expresión por el punto en un array
        var particion = dato.split(".");
        //evaluamos la primera parte de la división (parte entera)
        if (particion[0].match(valoresAceptados) || particion[0] == "") {
            if (particion[1].match(valoresAceptados)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

const validarInfo = function () {
    clear();
    let val = "Please, try again";
    if (cod.value == "" || cod.value.length < 3) {
        val_codigo.innerHTML = val;
        val_codigo.setAttribute("style", "color:red;");
        cod.setAttribute("style", "border:1px solid red");
        condicion = 1;
    } else if (produc.value == "" || produc.value.length < 5) {
        val_produc.innerHTML = val;
        val_produc.setAttribute("style", "color:red;");
        produc.setAttribute("style", "border:1px solid red");
        condicion = 1;
    } else if (precio.val == "" || !esNumero(precio.value)) {
        val_precio.innerHTML = val;
        val_precio.setAttribute("style", "color:red;");
        precio.setAttribute("style", "border:1px solid red");
        condicion = 1;
    } else if (cant.value == "" || !esNumero(cant.value)) {
        val_cant.innerHTML = val;
        val_cant.setAttribute("style", "color:red;");
        cant.setAttribute("style", "border:1px solid red");
        condicion = 1;
    }

    else condicion = 2;
}

//Registrar / Actualizar2
Registrar.addEventListener("click", () => {
    validarInfo();
    if (condicion == 2) {
        clear();
        fetch("../procesosPhP/productos/registrar.php", {
            method: "POST",
            body: new FormData(frm)
        }).then(response => response.text()).then(response => {
            if (response == "ok") {
                listarProductos();
                Swal.fire({
                    icon: 'success',
                    title: 'Registrado exitosamente !!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                listarProductos();
                Swal.fire({
                    icon: 'success',
                    title: 'Editado exitosamente !!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })
        frm.reset();
    } else if (condicion == 1) {
        Swal.fire({
            icon: 'error',
            title: 'No se ha podido registrar !!',
            showConfirmButton: false,
            timer: 1500
        })
    }


})

//Listar
function listarProductos() {
    fetch("../procesosPhP/productos/listar.php", {
        method: "POST",
    }).then(response => response.text()).then(response => {
        resultado.innerHTML = response;
    })
    Registrar.value = "Registrar";
    idp.value = "";
}


/*
Actualizar y eliminar vienen de los botones en
listar.php
*/

//Eliminar
function Eliminar(id) {
    Swal.fire({
        title: 'Seguro que deseas eliminar el registro??',
        text: "No podrás deshacer los cambios una vez eliminado.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No!',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("../procesosPhP/productos/Eliminar.php", {
                method: "POST",
                body: id
            }).then(response => response.text().then(response => {
                if (response == "OK") {
                    listarProductos();
                    Swal.fire({
                        icon: 'success',
                        title: 'Borrado Exitosamente !!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else if (response == "solo1") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No puedes eliminar todos los productos, pero puedes editarlo a tu gusto!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Algo ha salido mal...',
                        text: "No se ha podido eliminar, intente nuevamente",
                        showConfirmButton: false,
                        timer: 3000
                    })
                    console.log(response);
                }

            }))

        }


    })
    listarProductos();
}

//Actualizar1
function Editar(id) {
    fetch("../procesosPhP/productos/Editar.php", {
        method: "POST",
        body: id
    }).then(response => response.json().then(response => {
        idp.value = response.id;
        cod.value = response.codigo;
        produc.value = response.producto;
        precio.value = response.precio;
        cantidad.value = response.cantidad;
        Registrar.value = "Actualizar";
    }))
}