<?php
    session_start();
    session_destroy();
    $_SESSION = array();
    $_POST = array();
    echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";