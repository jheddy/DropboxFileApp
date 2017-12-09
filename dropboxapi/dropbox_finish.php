<?php

require 'app/start.php';

List($accessToken) = $webAuth->finish($_GET);

$store = $db->prepare("
    UPDATE dropbox_users
    SET dropbox_token = :dropbox_token
    WHERE id = :user_id
    ");

$store->execute([
    'dropbox_token' => $accessToken,
    'user_id' => $_SESSION['user_id']
]);

header('Location: index.php');
?>
