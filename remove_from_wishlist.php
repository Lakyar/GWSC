<?php
include 'dbconfig.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['site_name'])) {
        $site_name = $_POST['site_name'];
        $user_id = $_SESSION['user_id'];

        $query = "SELECT wishlist FROM users WHERE id = $user_id";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $wishlist = json_decode($row['wishlist'], true);

            if (!is_array($wishlist)) {
                $wishlist = [];
            }

            $index = array_search($site_name, $wishlist);
            if ($index !== false) {
                array_splice($wishlist, $index, 1);

                $updated_wishlist = json_encode($wishlist);
                $update_query = "UPDATE users SET wishlist = '$updated_wishlist' WHERE id = $user_id";

                if ($conn->query($update_query) === TRUE) {
                    echo "success";
                } else {
                    echo "Error updating wishlist: " . $conn->error;
                }
            } else {
                echo "Site not found in the wishlist";
            }
        } else {
            echo "User not found.";
        }
    }
}
?>
