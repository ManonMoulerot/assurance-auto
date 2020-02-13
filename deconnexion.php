<?php
session_name("formulaire");
session_start();
session_unset();
session_destroy();
header('Location: http://localhost/assurance-auto/form.php');
exit();
?>