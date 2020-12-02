<?php

include VIEWS_DIR . 'ajax/header-ajax.php';

use app\base\App;
use app\services\Auth;
use app\services\Db;
use app\forms\NewPasswordForm;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var null|string $error */
$error = null;

$password = trim($_POST['password']);
$repeat_password = trim($_POST['repeat_password']);
$verification_token = trim($_POST['verification_token']);

$form = new NewPasswordForm();
$form->password = $password;
$form->password_repeat = $repeat_password;

if ($form->validate()) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE " . DB_P_USERS . " SET verification_token = '', password_hash = :password_hash WHERE verification_token = :verification_token";
    $db->execute($sql, [':password_hash' => $password_hash, ':verification_token' => $verification_token]);
} else {
    $error = $form->errors['new-password'];
}

echo json_encode(['post' => $_POST, 'error' => $error]);
