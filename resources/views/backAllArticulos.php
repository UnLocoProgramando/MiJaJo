<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Usuarios</title>
    <link rel="stylesheet" href="<?= web_resource('css/styleadmin.css') ?>">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body style="background: black;">
<!-- Main Dashboard Content -->
<div class="dashboard-container">

    <!-- Side Menu -->
    <nav class="side-menu">
        <div class="menu-title">ADMIN</div>
        <ul>
            <li><a href="/admin"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
            <li><a href="/admin/alluser"><i class='bx bxs-user'></i> Usuarios</a></li>
            <li><a href="/admin/allcoleciones"><i class='bx bxs-collection'></i> Colecciones</a></li>
            <li><a href="/admin/allarticulos"><i class='bx bxl-product-hunt'></i> Articulos</a></li>
        </ul>
    </nav>

    <!-- Contenido principal -->
    <main class="main-content">
        <h1>Lista de Usuarios</h1>

        <table class="tabla-usuarios">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>ID COLECCION</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($articulos as $articulo): ?>
                <tr>
                    <td><?= htmlspecialchars($articulo->id_articulo) ?></td>
                    <td><?= htmlspecialchars($articulo->nombre) ?></td>
                    <td><?= htmlspecialchars($articulo->categoria ?? '-') ?></td>
                    <td><?= htmlspecialchars($articulo->stock ?? '-') ?></td>
                    <td><?= htmlspecialchars($articulo->precio) ?></td>
                    <td><?= htmlspecialchars($articulo->imagen ?? '-') ?></td>
                    <td><?= htmlspecialchars($articulo->id_coleccion) ?></td>
                    <td>
                        <a href="/admin/borrararticulo?id=<?= $articulo->id_articulo ?>" onclick="return confirm('¿Seguro que deseas borrar este usuario?');">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>
