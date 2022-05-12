<?php 
    $_SESSION['login']=null;
    isset($_SESSION['login']);
    session_destroy();
    //Header("Location: index.php");
?>
