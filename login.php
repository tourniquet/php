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
    require_once('./dbc.php');

    $email = '';
    $password = '';
    $show_form = true;

    if (isset($_POST['submit'])) {
      $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
      $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($email) && !empty($password)) {
        $query = "SELECT *
          FROM users
          WHERE email = '$email'
          AND password = '$password'";
        $result = mysqli_query($dbc, $query);

        if (mysqli_num_rows($result) == 1) {
          $show_form = false;
          mysqli_close($dbc);
        }
      }
    }

    if ($show_form) {
  ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <input name="email" placeholder="email" type="email" value="<?php echo $email ?>" required>
      <br>
      <input name="password" placeholder="password" type="password" value="<?php $password ?>" required>
      <br>
      <button name="submit">Login</button>
    </form>
  <?php
    } else {
  ?>
    <h2>Hello, <?php echo $email; ?>
  <?php
    }
  ?>
</body>
</html>
