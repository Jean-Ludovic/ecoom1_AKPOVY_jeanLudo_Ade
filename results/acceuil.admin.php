<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_style.css">
    <title>Interface d'Administration</title>
</head>

<body>
    <div class="admin-wrapper">
        <h1>Administration Interface</h1>

        <h2>items adding</h2>
        <form method="post" action="../admin/ajout_produit.php">
            <button type="submit">Add an item</button>
        </form>
        </section>

        <!-- Gestion des utilisateurs -->
        <section>
            <h2>Users Management </h2>
            <form method="post" action="../admin/gestion_utilisateurs.php">
                <button type="submit">Manage users</button>
            </form>
        </section>

        <!-- Actions réservées aux super-administrateurs -->
        <?php //if ($_SESSION["role_id"] == 2) : 
        ?>
        <section>
            <h2>Actions réservées aux super-administrateurs</h2>
            <form method="post" action="../admin/actions_super_admin.php">
                <button type="submit">Super Admin Actions</button>
            </form>
        </section>
        <? // endif; 
        ?>

        <!-- Déconnexion -->
        <section>
            <h2>Déconnexion</h2>
            <form method="post" action="../index.php">
                <button type="submit">Logout</button>
            </form>
        </section>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .admin-wrapper {
                width: 80%;
                max-width: 600px;
                background: #fff;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                text-align: center;
            }

            .admin-wrapper h1 {
                color: #333;
                margin-bottom: 20px;
            }

            .admin-wrapper form {
                margin-bottom: 20px;
            }

            button {
                background-color: #5C6BC0;

                color: white;
                border: none;
                padding: 10px 20px;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-weight: bold;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            button:hover {
                background-color: #3F51B5;

            }

            section {
                margin-top: 20px;
            }
        </style>