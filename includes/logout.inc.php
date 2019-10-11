<?php

session_start();
session_unset();
session_destroy();
header("Location: http://manassehedwardsportfolio-com.stackstaging.com/index.php?success=logout")

 ?>
