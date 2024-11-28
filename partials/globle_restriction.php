<?php
if (!isset($_SESSION)) {
    session_start();
}
// --Restriction--
// if ($_SESSION["role"] != 1) {
//     echo "<script> location.href = '../page_404.php'</script>";
// }
// --Restriction END--
include("../conf/connection.php");
