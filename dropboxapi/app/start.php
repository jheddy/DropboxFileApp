<?php
session_start();
$_SESSION['user_id'] = 1;

require __DIR__ . '/../vendor/autoload.php';

$dropboxKey = 'samplekey';
$dropboxSecret = 'samplesecret';
$appName = 'FileUploadDownload';

$appInfo = new Dropbox\AppInfo($dropboxKey, $dropboxSecret);

$csrfTokenStore = new Dropbox\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');

$webAuth = new Dropbox\WebAuth($appInfo, $appName, 'http://localhost/dropboxapi/dropbox_finish.php', $csrfTokenStore );

$db = new PDO('mysql:host=localhost;dbname=dropbox_db', 'root', 'root');

$user = $db->prepare("SELECT * from dropbox_users where id = :user_id");
$user->execute(['user_id' => $_SESSION['user_id']]);
$user = $user->fetchObject();
var_dump($user)
?>
