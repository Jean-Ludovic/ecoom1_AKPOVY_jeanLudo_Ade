super admin
<!-- Back to Admin Dashboard -->
<section>
    <a href="../results/acceuil.admin.php">Back to Admin Dashboard</a>
</section>
<?php
require_once("../config/connexion.php");
require_once("../fonctions/userCrud.php");

// Vous devriez avoir une fonction ou une méthode pour obtenir le rôle de l'utilisateur.
// Assurez-vous que cette fonction renvoie le rôle sous forme de nombre, par exemple 2 pour admin et 3 pour superadmin.
$role_id = getCurrentUserRole(); // Cette fonction est hypothétique.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["user_id"]) && isset($_POST["new_role"])) {
        if ($role_id == 3) { // Seul le superadmin (id=3) peut modifier les rôles
            $user_id = $_POST["user_id"];
            $new_role = $_POST["new_role"];

            if (upgradeUserRole($user_id, $new_role)) {
                echo "Rôle d'utilisateur mis à niveau avec succès.";
            } else {
                echo "Erreur lors de la mise à niveau du rôle d'utilisateur : " . mysqli_error($conn);
            }
        } else {
            echo "Action non autorisée : Vous n'avez pas les droits de superadmin.";
        }
    } elseif (isset($_POST["user_id_delete"])) {
        if ($role_id == 3) { // Seul le superadmin peut supprimer les comptes
            $user_id_delete = $_POST["user_id_delete"];

            if (deleteUser($user_id_delete)) {
                echo "Utilisateur supprimé avec succès.";
            } else {
                echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($conn);
            }
        } else {
            echo "Action non autorisée : Vous n'avez pas les droits de superadmin.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gestQctionStyle.css">
    <title>Interface Superadmin</title>
</head>

<body>
    <div class="admin-wrapper">
        <h1>Interface Superadmin</h1>

        <!-- Changement de rôle des admins -->
        <section>
            <h2>Changement de rôle des admins</h2>
            <form method="post" action="gestion_superadmin.php">
                <label for="user_id">Sélectionner l'admin:</label>
                <select id="user_id" name="user_id" required>
                    <?php
                    // Récupérer les admins depuis la base de données
                    // Remplacer '2' par l'ID de rôle des admins dans votre base de données
                    $query = "SELECT id, user_name FROM user WHERE role_id = 2";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['user_name'] . "</option>";
                    }
                    ?>
                </select>

                <label for="new_role">Nouveau rôle:</label>
                <select id="new_role" name="new_role" required>
                    <option value="1">Utilisateur</option>
                    <option value="2">Administrateur</option>
                </select>

                <button type="submit">Modifier le rôle</button>
            </form>
        </section>

        <!-- Suppression des admins -->
        <section>
            <h2>Suppression des admins</h2>
            <form method="post" action="actions_super_admin.php">
                <label for="user_id_delete">Sélectionner l'admin à supprimer:</label>
                <select id="user_id_delete" name="user_id_delete" required>
                    <?php
                    // Réutilisation de la requête pour récupérer les admins
                    mysqli_data_seek($result, 0); // Réinitialiser le pointeur de résultat
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['user_name'] . "</option>";
                    }
                    ?>
                </select>

                <button type="submit">Supprimer l'admin</button>
            </form>
        </section>


    </div>
</body>

</html>