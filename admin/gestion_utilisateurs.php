<?php
require_once("../config/connexion.php");
?>
<h6>Votre Derniere action : </h6>
<?php
require_once("../fonctions/userCrud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Upgrade User Role
    if (isset($_POST["user_id"]) && isset($_POST["new_role"])) {
        $user_id = $_POST["user_id"];
        $new_role = $_POST["new_role"];

        // Appeler la fonction pour mettre à niveau le rôle de l'utilisateur
        if (upgradeUserRole($user_id, $new_role)) {
            echo "Rôle d'utilisateur mis à niveau avec succès.";
        } else {
            echo "Erreur lors de la mise à niveau du rôle d'utilisateur : " . mysqli_error($conn);
        }
    }

    // Delete User
    elseif (isset($_POST["user_id_delete"])) {
        $user_id_delete = $_POST["user_id_delete"];

        // Appeler la fonction pour supprimer l'utilisateur
        if (deleteUser($user_id_delete)) {
            echo "Utilisateur supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($conn);
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_style.css">
    <title>User Management</title>
</head>

<body>
    <div class="admin-wrapper">
        <h1>User Management</h1>

        <!-- List of Users -->
        <section>
            <h2>Users</h2>
        </section>

        <!-- Upgrade User Role -->
        <section>
            <h2>Upgrade User Role</h2>
            <form method="post" action="gestion_utilisateurs.php">
                <label for="user_id">Select User:</label>
                <select id="user_id" name="user_id" required>
                    <?php
                    // Récupérer les noms d'utilisateur depuis la base de données
                    $query = "SELECT id, user_name FROM user";
                    $result = mysqli_query($conn, $query);

                    // Vérifier si la requête a réussi
                    if ($result) {
                        // Itérer à travers les résultats pour créer les options de la liste déroulante
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['user_name'] . "</option>";
                        }
                    } else {
                        echo "Erreur lors de la récupération des utilisateurs : " . mysqli_error($conn);
                    }
                    ?>

                </select>

                <label for="new_role">Select New Role:</label>
                <select id="new_role" name="new_role" required>
                    <option value="1">User</option>
                    <option value="2">Administrator</option>
                </select>

                <button type="submit">Upgrade Role</button>
            </form>
        </section>

        <!-- Delete User -->
        <section>
            <h2>Delete User</h2>
            <form method="post" action="gestion_utilisateurs.php">
                <label for="user_id_delete">Select User:</label>
                <select id="user_id_delete" name="user_id_delete" required>
                    <?php
                    // Récupérer les noms d'utilisateur depuis la base de données
                    $query = "SELECT id, user_name FROM user";
                    $result = mysqli_query($conn, $query);

                    // Vérifier si la requête a réussi
                    if ($result) {
                        // Itérer à travers les résultats pour créer les options de la liste déroulante
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['user_name'] . "</option>";
                        }
                    } else {
                        echo "Erreur lors de la récupération des utilisateurs : " . mysqli_error($conn);
                    }
                    ?>
                </select>

                <button type="submit">Delete User</button>
            </form>
        </section>

        <!-- Back to Admin Dashboard -->
        <section>
            <a href="../results/acceuil.admin.php">Back to Admin Dashboard</a>
        </section>
    </div>
</body>

</html>