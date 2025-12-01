<?php
session_start();
session_unset();
session_destroy();
header("Location: ../../pages/pelanggan/index.php");
exit();
