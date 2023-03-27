<?php
// config base 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "khalil";

//tconnecti lel base
$conn = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ajout lel article
function add_article($name, $min_quant, $current_quant) {
    global $conn;

    $sql = "INSERT INTO articles (name, min_quant, current_quant) VALUES ('$name', $min_quant, $current_quant)";

    if ($conn->query($sql) !== TRUE) {
        die("Error adding article: " . $conn->error);
    }
}

// hét les articles ga3ga3 louta
function get_articles() {
    global $conn;

    $articles = array();

    $sql = "SELECT * FROM articles";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
            $articles[] = $row;
        }
    }

    return $articles;
}

// na9as
function dickrement_quantity($id) {
    global $conn;

    $sql = "UPDATE articles SET current_quant = current_quant - 1 WHERE article_id = $id";

    if ($conn->query($sql) !== TRUE) {
        die("Error updating quantity: " . $conn->error);
    }
}

//rajja3
function increment_quantity($id) {
    global $conn;

    $sql = "UPDATE articles SET current_quant = current_quant + 1 WHERE article_id = $id";

    if ($conn->query($sql) !== TRUE) {
        die("Error updating quantity: " . $conn->error);
    }
}
// fasa5 3la zebbi ay
function delete_article($id) {
    global $conn;

    $sql = "DELETE FROM articles WHERE article_id = $id";

    if ($conn->query($sql) !== TRUE) {
        die("Error deleting article: " . $conn->error);
    }
}
?>