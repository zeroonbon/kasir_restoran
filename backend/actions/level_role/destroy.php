<?php
include '../../config/connaction.php';

$id_level = intval($_GET['id'] ?? 0);

if ($id_level > 0) {
    $query = "DELETE FROM level WHERE id_level='$id_level'";
    if (mysqli_query($connect, $query)) {
        header("Location: ../../pages/level_role/index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($connect);
    }
} else {
    echo "Invalid ID.";
}
?>
