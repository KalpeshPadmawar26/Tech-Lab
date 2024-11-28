<?php
if (
    isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
) {
    echo '<base href = "https://localhost/" >';
} else {
    echo '<base href = "http://localhost/" >';
}
?>