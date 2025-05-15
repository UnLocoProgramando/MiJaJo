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
                <th>Descripcion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($coleciones as $coleccion): ?>
                <tr>
                    <td><?= htmlspecialchars($coleccion->id_coleccion) ?></td>
                    <td><?= htmlspecialchars($coleccion->nombre) ?></td>
                    <td><?= htmlspecialchars($coleccion->descripcion ?? '-') ?></td>
                    <td>
                        <a href="/admin/borrarcoleccion?id=<?= $coleccion->id_coleccion ?>" onclick="return confirm('¿Seguro que deseas borrar este usuario?');">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>
