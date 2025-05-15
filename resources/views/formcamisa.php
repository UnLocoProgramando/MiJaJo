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
                <h2>Agregar Nueva Camisa</h2>
                <form action="/admin/agregarcamisa" method="POST" enctype="multipart/form-data">
                    <label for="shirt-name">Nombre de la Camisa:</label>
                    <input type="text" id="shirt-name" name="shirt_name" required>

                    <label for="shirt-price">Precio de la Camisa:</label>
                    <div class="input-with-icon">
                        <span class="icon">$</span>
                        <input type="number" id="shirt-price" name="shirt_price" required min="1" step="0.01">
                    </div>

                    <label for="shirt-image">Imagen de la Camisa:</label>
                    <input type="file" id="shirt-image" name="shirt_image" accept="image/*" required>

                    <label for="collection">Colección:</label>
                    <select id="collection" name="collection_id" required>
                        <option value="" disabled selected>Selecciona una colección</option>
                        <?php foreach ($colecciones as $coleccion): ?>
                            <option value="<?= htmlspecialchars($coleccion->values['id_coleccion']) ?>">
                                <?= htmlspecialchars($coleccion->values['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit">Agregar Camisa</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
