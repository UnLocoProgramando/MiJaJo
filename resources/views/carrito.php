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


        <a href="javascript:void(0);" class="carrito-icon" id="abrir-carrito">
            <i class='bx bx-cart'></i>
            <?php if ($cantidadEnCarrito > 0): ?>
                <span class="cart-count"><?= $cantidadEnCarrito ?></span>
            <?php endif; ?>
        </a>


        <a href="/buscar"><i class='bx bx-search'></i></a>
    </div>

</header>
<!--- header end --->
<main>
    <div class="hero"></div>

    <section>
        <p>Artículos en el Carrito de compras:</p>
        <?php if (!empty($carrito)): ?>
            <section class="carrito-detalle">
                <?php
                $totalOrden = 0;
                foreach ($carrito as $producto):
                    $totalOrden += $producto['subtotal'];
                    ?>
                    <div class="producto" style="display: flex; margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; width: auto">
                        <img src="<?= asset($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" style="width: 25rem; height: 25rem; margin-right: 7rem;">
                        <div>
                            <h2><?= htmlspecialchars($producto['nombre']) ?></h2>
                            <p style="display: flex; justify-content: space-between;"><strong>Colección:</strong> <?= htmlspecialchars($producto['coleccion']) ?></p>
                            <p style="display: flex; justify-content: space-between;"><strong>Categoría:</strong> <?= htmlspecialchars($producto['categoria']) ?></p>
                            <p style="display: flex; justify-content: space-between;"><strong>Stock:</strong> <?= htmlspecialchars($producto['stock']) ?></p>
                            <p style="display: flex; justify-content: space-between;"><strong>Precio:</strong> $<?= number_format($producto['precio'], 2) ?></p>
                            <p style="display: flex; justify-content: space-between;"><strong>Cantidad:</strong> <?= $producto['cantidad'] ?></p>
                            <p style="display: flex; justify-content: space-between;"><strong>Subtotal:</strong> $<?= number_format($producto['subtotal'], 2) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

                <p style="display: flex; justify-content: space-between;"><strong>Total de la orden:</strong> $<?= number_format($totalOrden, 2) ?></p>
                <button class="btn view" style="margin-top: 2rem; width: 100%; height: 4rem; border-radius: 2rem;">Confirmar información de tu orden</button>

            </section>
        <?php else: ?>
            <p>Tu carrito está vacío.</p>
        <?php endif; ?>
    </section>
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
<div id="menu-carrito" class="menu-carrito" style="margin-top: 60px; background: black;">
    <button id="cerrar-carrito" style="color: white;">&times;</button>
    <h2 style="color: white;">Tu carrito</h2>

    <?php if (!empty($carrito)): ?>
        <ul id="lista-carrito">
            <?php foreach ($carrito as $producto): ?>
                <li data-id="<?= $producto['id'] ?>" style="display: flex; gap: 10px; align-items: center; margin-bottom: 10px; background: white; padding: 10px;">
                    <img src="<?= asset($producto['imagen'] ?? 'img/default.png') ?>" alt="<?= htmlspecialchars($producto['nombre'] ?? '') ?>" style="width: 60px; height: auto;">
                    <div style="flex: 1;">
                        <strong><?= htmlspecialchars($producto['nombre'] ?? '') ?></strong><br>
                        Cantidad: <span class="cantidad"><?= $producto['cantidad'] ?? 0 ?></span><br>
                        Precio: $<?= number_format((float)($producto['precio'] ?? 0), 2) ?>
                    </div>

                    <div>
                        <button class="btn-aumentar">+</button>
                        <button class="btn-disminuir">−</button>
                        <button class="btn-eliminar" style="background: red; color: white;">Eliminar</button>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <div style="text-align: center; margin-top: 20px;">
            <a href="/carrito" class="btn-proceder" style="background: white; color: black; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">Proceder al pago</a>
        </div>
    <?php else: ?>
        <p style="color: white;">Tu carrito está vacío.</p>
    <?php endif; ?>
</div>

<!--- Custom js link --->
<script src="<?= asset('js/script.js') ?>"></script>
</body>
<!--- Para aumentar carrito --->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-aumentar').forEach(btn => {
            btn.addEventListener('click', () => {
                const item = btn.closest('li');
                const id = item.dataset.id;
                fetch(`/carrito/actualizar?id=${id}&accion=mas`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            item.querySelector('.cantidad').textContent = data.nueva_cantidad;
                        }
                    });
            });
        });

        document.querySelectorAll('.btn-disminuir').forEach(btn => {
            btn.addEventListener('click', () => {
                const item = btn.closest('li');
                const id = item.dataset.id;
                fetch(`/carrito/actualizar?id=${id}&accion=menos`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            if (data.nueva_cantidad > 0) {
                                item.querySelector('.cantidad').textContent = data.nueva_cantidad;
                            } else {
                                item.remove();
                            }
                        }
                    });
            });
        });

        document.querySelectorAll('.btn-eliminar').forEach(btn => {
            btn.addEventListener('click', () => {
                const item = btn.closest('li');
                const id = item.dataset.id;
                fetch(`/carrito/eliminar?id=${id}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            item.remove();
                        }
                    });
            });
        });
    });
</script>
</html>