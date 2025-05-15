let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('active');
};

window.onscroll = () => {
    menu.classList.remove('bx-x');
    navbar.classList.remove('active');
};

document.addEventListener("DOMContentLoaded", function () {
    const userEmail = document.getElementById("user-email");
    const userMenu = document.getElementById("user-menu");

    if (userEmail) {
        userEmail.addEventListener("click", function () {
            userMenu.classList.toggle("active"); // Muestra u oculta el menú
        });

        // Cerrar el menú si el usuario hace clic fuera de él
        document.addEventListener("click", function (event) {
            if (!userEmail.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.remove("active");
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const abrirCarrito = document.getElementById('abrir-carrito');
    const cerrarCarrito = document.getElementById('cerrar-carrito');
    const menuCarrito = document.getElementById('menu-carrito');

    abrirCarrito?.addEventListener('click', function () {
        menuCarrito.classList.add('active');
    });

    cerrarCarrito?.addEventListener('click', function () {
        menuCarrito.classList.remove('active');
    });
});
