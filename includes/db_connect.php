<?php
mysqli_report(MYSQLI_REPORT_OFF);
define('host', "localhost");
define('db', "portfolio");
define('user', "root");
define('pass', "");

$conn = @mysqli_connect(host, user, pass, db);
if (!$conn) {
    error_log('Database connection failed: ' . mysqli_connect_error());
}