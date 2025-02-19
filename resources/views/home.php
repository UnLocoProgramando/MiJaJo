<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
<!-- <div class="top-lbl">
    <p style="font-weight: bold;">DO NOT SHOW TO STAKEHOLDERS | WEBSITE UNDER CONSTRUCTION</p>
</div> -->
<header class="navbar">
    <img class="logotype" src="<?= asset('logo/PNG/JotaLogo.png') ?>" alt="Jota's Wear Logo">
</header>
<div class="hero">
    <h1>¡Somos la Moda!</h1>
    <a class="main-action-bright" href="/register">Registrate</a>
</div>

<div class="splitted-header">
    <h3>Jota's Wear</h3>
    <p>
        Bienvenidos a Jota's Wear. Aquí podrás encontrar ropa
        de calidad tanto para hombres, mujeres y niñ@s.
        <br> <br>
        Trabajamos todo por Colecciones limitadas, solo se crean
        25 piezas de cada drop, para hacerlo aún más auténtico.
        Hacemos Envío Gratis a Puerto Rico y Estados Unidos.
    </p>
</div>

<div class="objectives-carroussel">
    <div class="carroussel-wrapper">

        <h1 style="align-content: center">Algo Sobre Nosotros</h1>
        <div class="carroussel">
            <img src="https://placehold.co/600x400" alt="a python snake">
            <img src="https://placehold.co/600x400" alt="a python snake">
            <img src="https://placehold.co/600x400" alt="a python snake">
            <img src="https://placehold.co/600x400" alt="a python snake">
        </div>
    </div>
    <div class="carrousel-actions">
        <div onclick="scroll_by_left()" id="scroll-action-l" class="c-action scroll-left">
            <i class="las la-angle-left"></i>
        </div>
        <div onclick="scroll_by_right()" id="scroll-action-r" class="c-action scroll-right">
            <i class="las la-angle-right"></i>
        </div>
    </div>

</div>




<div class="sections-dynamic">
    <div class="splitted-header">
        <div class="block">
            <h3>Colecciones Disponibles</h3>
        </div>

        <p>¡Compra Ahora!</p>
    </div>

    <div class="sections-blocked-dynamic ">
        <div class="section-block shade-1">
            <h1>Colección 1</h1>
            <p>San Valentín</p>
        </div>
        <div class="section-block shade-2">
            <h1>3 al 7 de junio de 2024</h1>
            <p>Sección 2</p>
        </div>
        <div class="section-block shade-3">
            <h1>3 al 7 de junio de 2024</h1>
            <p>Sección 3</p>
        </div>
    </div>
</div>

<?php require_once('partials/footer.php'); ?>

</body>

</html>

