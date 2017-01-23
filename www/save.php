<?php

if (!empty($_POST['email']) && !empty($_POST['example_id'])) {
	require_once '../src/DB.php';
	$db = new DB();
	$db->insertOrUpdateTranslation($_POST['email'], $_POST['example_id'], $_POST['translation'], $_POST['comment']);
}

$example_id = 1;
if (!empty($_POST['example_id'])) {
	$example_id = $_POST['example_id'];
}

if (isset($_POST['prev'])) {
	$example_id--;
} else {
	$example_id++;	
}

$email = '';
if (!empty($_POST['email'])) {
	$email = $_POST['email'];
}

header('Location: index.php?' . http_build_query(['email' => $email, 'example_id' => $example_id]));
