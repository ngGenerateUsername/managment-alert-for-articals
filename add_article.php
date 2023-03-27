<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $min_quant = $_POST['min_quant'];
    $current_quant = $_POST['current_quant'];
    add_article($name, $min_quant, $current_quant);
}

header('Location: index.php');
exit;
?>