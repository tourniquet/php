<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <?php
    require_once('../dbc.php');

    $email = '';
    $password = '';
    $show_form = true;

    if (!isset($_COOKIE['user_id'])) {
      if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
        $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
  
        $query = "SELECT id, email, password
          FROM users
          WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($dbc, $query);
  
        if (mysqli_num_rows($result) == 1) {
          $show_form = false;

          $row = mysqli_fetch_array($result);

          setcookie('user_id', $row['id']);
          setcookie('user_email', $row['email']);

          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
          // header('Location: ' . $home_url);
        } else {
          $show_form = true;
        }
      }
    } else {
      $show_form = false;
    }

    if ($show_form) {
  ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input name="email" value="<?php echo $email ?>" type="email">
      <br>
      <input name="password" value="<?php echo $password ?>" type="password">
      <br>
      <button name="submit" type="submit">Submit</button>
    </form>
  <?php
    } elseif (isset($email)) {
      echo 'Hi ' . $_COOKIE['user_email'];
    }
  ?>
</body>
</html>
