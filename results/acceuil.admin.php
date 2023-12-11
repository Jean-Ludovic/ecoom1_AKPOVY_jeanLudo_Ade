<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_style.css"> <!-- Assurez-vous d'avoir une feuille de style pour votre interface d'administration -->
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