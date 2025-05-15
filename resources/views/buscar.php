<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JotaWear</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="shortcut icon" href="/<?= asset("logo/PNG/JotaLogo.png") ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= web_resource("css/stylehome.css") ?>">
</head>
<body>
<!--- header start --->
<header>
    <ul class="navbar">
        <li><a href="#contact">Menu</a></li>
        <li><a href="/buscar">Buscar</a></li>
    </ul>

    <a href="/" class="logo">Jota's Wear</a>
    <div class="bx bx-menu" id="menu-icon"></div>

    <!-- Intentando que funcione el login ayudame Dios -->
    <div class="icons">

        <!-- Div donde aparece el correo electrónico y el menú emergente -->
        <?php if (isset($_SESSION["email"])): ?>
            <div class="user-email-container">
                <span class="user-email" id="user-email"><?= htmlspecialchars($email) ?></span>
                <div class="user-menu" id="user-menu">
                    <a href="#">Editar perfil</a>
                    <a href="/registrar/cerrarsesion">Cerrar sesión</a>
                </div>
            </div>
        <?php else: ?>
            <a href="/registrar"><i class='bx bxs-user'></i></a>
        <?php endif; ?>


        <a href="/carrito"><i class='bx bx-cart'></i></a>
        <a href="/buscar"><i class='bx bx-search'></i></a>
    </div>

</header>
<!--- header end --->
<main>
    <div class="hero"></div>

    <section>
        <p>Jota's Wear se enfoca en Calidad y Exclusividad, es por eso que cada colección es limitada a 25 piezas. . . Dando un toque único y especial en cada producción, las cuales niños, hombres y mujeres pueden usar.</p>
    </section>
    <section>
        <h1>Colecciones:</h1>
    </section>

    <div class="shop" id="shop">
        <!--- Esta sección hay que cambiarlo porque ahora esta manualmente --->
        <!--- La idea es que se actualice en tiempo real con datos de la DB --->
        <h1>Marzo Street Vibes</h1>
        <div class="container">
            <div class="box">
                <img src="<?= asset('col2/jota1.png') ?>">
                <h4>I'm a product</h4>
                <h5>$15.00</h5>
                <div class="cart">
                    <a href="#"><i class='bx bxs-cart'></i></a>
                </div>
            </div>
            <div class="box">
                <img src="<?= asset('col2/jota2.png') ?>">
                <h4>I'm a product</h4>
                <h5>$15.00</h5>
                <div class="cart">
                    <a href="#"><i class='bx bxs-cart'></i></a>
                </div>
            </div>
            <div class="box">
                <img src="<?= asset('col2/jota3.png') ?>">
                <h4>I'm a product</h4>
                <h5>$15.00</h5>
                <div class="cart">
                    <a href="#"><i class='bx bxs-cart'></i></a>
                </div>
            </div>
        </div>

        <!--- Esta sección hay que cambiarlo porque ahora esta manualmente --->
        <!--- La idea es que se actualice en tiempo real con datos de la DB --->
        <h1>San valentin</h1>
        <div class="container">
            <div class="box">
                <img src="<?= asset('col1/jota1.png') ?>">
                <h4>I'm a product</h4>
                <h5>$15.00</h5>
                <div class="cart">
                    <a href="#"><i class='bx bxs-cart'></i></a>
                </div>
            </div>
            <div class="box">
                <img src="<?= asset('col1/jota2.png') ?>">
                <h4>I'm a product</h4>
                <h5>$15.00</h5>
                <div class="cart">
                    <a href="#"><i class='bx bxs-cart'></i></a>
                </div>
            </div>
            <div class="box">
                <img src="<?= asset('col1/jota3.png') ?>">
                <h4>I'm a product</h4>
                <h5>$15.00</h5>
                <div class="cart">
                    <a href="#"><i class='bx bxs-cart'></i></a>
                </div>
            </div>
            <div class="box">
                <img src="<?= asset('col1/jota4.png') ?>">
                <h4>I'm a product</h4>
                <h5>$15.00</h5>
                <div class="cart">
                    <a href="#"><i class='bx bxs-cart'></i></a>
                </div>
            </div>

            <div class="box">
                <img src="<?= asset('col1/jota5.png') ?>">
                <h4>I'm a product</h4>
                <h5>$15.00</h5>
                <div class="cart">
                    <a href="#"><i class='bx bxs-cart'></i></a>
                </div>
            </div>

            <div class="box">
                <img src="<?= asset('col1/jota6.png') ?>">
                <h4>I'm a product</h4>
                <h5>$15.00</h5>
                <div class="cart">
                    <a href="#"><i class='bx bxs-cart'></i></a>
                </div>
            </div>
        </div>


    </div>
    <!--- contact start --->
    <!--- Esta sección se llama contacto pero es un footer --->
    <section class="contact" id="contact">
        <div class="main-contact">
            <div class="contact-content">
                <li><a href="#contact">Menu</a></li>
                <li><a href="/buscar">Buscar</a></li>
                <li><a href="/registrar">Suscríbete</a></li>
                <li><a href="/carrito">Carrito de compras</a></li>
            </div>

            <div class="contact-content">
                <li><a href="/devolucion">Envío y devolución</a></li>
                <li><a href="/politica">Política de la tienda</a></li>
                <li><a href="/metododepago">Métodos de pago</a></li>
            </div>

            <div class="contact-content">
                <li><a href="/contacto">Contact:</a></li>
                <li><a href="/contacto">jotaswear24@gmail.com</a></li>
            </div>

            <div class="contact-content">
                <!--- Link de las redes sociales --->
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Instagram</a></li>
            </div>

        </div>

        <div class="action">
            <form>
                <input type="email" name="email" placeholder="Your email" required>
                <input type="submit" name="submit" value="Submit" required>
            </form>
        </div>
        <!--- Se acabó el supuesto footer --->

    </section>

    <div class="last">
        <p>2024 by Jota's Wear</p>
    </div>

</main>
<!--- Custom js link --->
<script src="<?= asset('js/script.js') ?>"></script>
</body>
</html>