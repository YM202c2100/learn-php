<?php
$dns = 'mysql:dbname=test_db;host=localhost;port=8889';
$conn = new PDO($dns, 'root', 'root');

$pst = $conn->query("SELECT * FROM mst_prefs");

echo '<pre>';
print_r($pst->fetchAll(PDO::FETCH_ASSOC));
echo '</pre>';