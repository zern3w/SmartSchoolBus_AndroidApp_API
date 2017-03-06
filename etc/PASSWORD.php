<?php
$pw = "11223344";
$hash = '$2y$10$sCVdlsERJMACAmhbfI9B3utsNXzlmlHETByxwSdUcW5frGkctDWUW';

if (password_verify($pw, $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

?>