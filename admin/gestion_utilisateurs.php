<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_style.css"> <!-- Assurez-vous d'avoir une feuille de style pour votre interface d'administration -->
    <title>User Management</title>
</head>

<body>
    <div class="admin-wrapper">
        <h1>User Management</h1>

        <!-- List of Users -->
        <section>
            <h2>Users</h2>
            <!-- Display a list of users from your database -->
            <!-- ... -->
        </section>

        <!-- Upgrade User Role -->
        <section>
            <h2>Upgrade User Role</h2>
            <form method="post" action="upgrade_user_role.php">
                <label for="user_id">Select User:</label>
                <select id="user_id" name="user_id" required>
                    <?php
                    require_once("../config/connexion.php"); // la connexion à la base de données est incluse ici

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
            <form method="post" action="delete_user.php">
                <label for="user_id_delete">Select User:</label>
                <select id="user_id_delete" name="user_id_delete" required>
                    <!-- Populate this dropdown with user data from your database -->
                    <!-- <option value="user_id_1">User 1</option> -->
                    <!-- <option value="user_id_2">User 2</option> -->
                    <!-- ... -->
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