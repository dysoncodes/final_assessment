<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = $conn->prepare("DELETE FROM result WHERE id = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . $sql->error;
    }
} else {
    echo "No ID specified for deletion.";
}

?>