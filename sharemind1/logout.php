<?php 
include('config.php');
setcookie("ckuserid", "", time()-60 );
session_destroy();
header('Location: index.php');
?>
