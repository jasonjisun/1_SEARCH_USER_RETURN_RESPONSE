<?php
require_once 'core/models.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteApplicant($pdo, $id);
    header('Location: index.php');
}
?>
