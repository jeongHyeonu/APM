<?php
include './LoginUser.php';
$DAO = new LoginUser('localhost', 'testuser', 'root', 'Qq98933096@');
$DAO->register("alice", "alicepw", "ROLE_USER");
$DAO->register("manager", "managerpw", "ROLE_MANAGER");
$DAO->register("admin", "adminpw", "ROLE_ADMIN");
?>