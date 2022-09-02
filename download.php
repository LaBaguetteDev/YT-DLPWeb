<?php
$f = $_GET['f'];
$size = filesize($f);
$fname = substr($f, 8);
header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false);
header("Content-disposition: attachment; filename=". $fname);
header("Content-Type: application/octet-stream");
header('Content-Transfer-Encoding: binary');
header("Content-length: $size");

readfile($f);

ignore_user_abort(true);

unlink($f);

?>
