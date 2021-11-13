<?php
$salt = substr(md5(uniqid(rand(), true)), 0, 9);
$pass = sha1($salt . sha1($salt . sha1('@admin123456')));
echo $salt;
echo '<br>';
echo $pass;