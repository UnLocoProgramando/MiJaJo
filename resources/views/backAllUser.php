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
                <th>Email</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Teléfono</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Fecha de Registro</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario->user_id) ?></td>
                    <td><?= htmlspecialchars($usuario->email) ?></td>
                    <td><?= htmlspecialchars($usuario->nombre ?? '-') ?></td>
                    <td><?= htmlspecialchars($usuario->apellidos ?? '-') ?></td>
                    <td><?= htmlspecialchars($usuario->telefono ?? '-') ?></td>
                    <td><?= htmlspecialchars($usuario->tipo) ?></td>
                    <td><?= htmlspecialchars($usuario->estado ?? '-') ?></td>
                    <td><?= htmlspecialchars($usuario->creado) ?></td>
                    <td>
                        <a href="/admin/borrarusuario?id=<?= $usuario->user_id ?>" onclick="return confirm('¿Seguro que deseas borrar este usuario?');">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>
