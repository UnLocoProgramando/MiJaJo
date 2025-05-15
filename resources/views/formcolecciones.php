<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
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

    <!-- Main Content Area -->
    <div class="main-content">
        <h1>Bienvenido al Dashboard</h1>
        <div class="stats-container">
            <div class="stat-item">
                <p class="stat-number" id="total-users">0</p>
                <p class="stat-description">Usuarios Registrados</p>
            </div>
            <div class="stat-item">
                <p class="stat-number" id="total-shirts-sold">0</p>
                <p class="stat-description">Camisas Vendidas</p>
            </div>
            <div class="stat-item">
                <p class="stat-number" id="total-purchases">0</p>
                <p class="stat-description">Total de Compras</p>
            </div>
        </div>

        <div class="formulariocolleciones">
            <p style="color: white">Hola mundo</p>
            <div class="form-container">
                <h2>Agregar Nueva Colección</h2>
                <form action="/admin/agregrarcoleccion" method="POST">
                    <label for="collection-name">Nombre de la Colección</label>
                    <input type="text" id="collection-name" name="collection_name" placeholder="Ej. Verano 2025" required>
                    <button type="submit">Agregar Colección</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
