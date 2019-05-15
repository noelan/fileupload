<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_POST['image'];
    unlink($file);
    header('Location: index.php');
}

?>