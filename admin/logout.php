<?php
  if (isset($_COOKIE['user_email'])) {
    setcookie('user_email', time() - 3600);
    setcookie('user_id', time() - 3600);

    $home_url = 'http://' . $_SERVER['HTTP_POST'] . dirname($_SERVER['PHP_SELF']) .  '/index.php';
    header('Location:' . $home_url);
  }
?>
