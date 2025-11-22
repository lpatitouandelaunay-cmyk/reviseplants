<?php
// Fix sessions OVH
ini_set('session.save_path', __DIR__ . '/sessions');
if (!is_dir(__DIR__ . '/sessions')) mkdir(__DIR__ . '/sessions');
session_start();

if (!($_SESSION['logged'] ?? false)) exit;

$path = __DIR__ . '/data/gifts.json';
$gifts = json_decode(file_get_contents($path), true);

$id = intval($_POST['id']);
array_splice($gifts, $id, 1);

file_put_contents($path, json_encode($gifts, JSON_PRETTY_PRINT));

echo "OK";
