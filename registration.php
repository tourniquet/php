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

    $show_form = true;

    $email = '';
    $password = '';
    $password_confirmation = '';

    if (isset($_POST['submit'])) {
      $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
      $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
      $password_confirmation = mysqli_real_escape_string($dbc, trim($_POST['password-confirmation']));

      if (!empty($email) && !empty($password) && !empty($password_confirmation)) {
        if ($password == $password_confirmation) {
          $query = "SELECT *
            FROM users
            WHERE email = '$email'";
          $result = mysqli_query($dbc, $query);

          if (mysqli_num_rows($result) == 0) {
            $query = "INSERT INTO users (email, password)
              VALUES ('$email', '$password')";
            mysqli_query($dbc, $query) or die('Error quering database!');

            $show_form = false;
            mysqli_close($dbc);
          } else {
            $show_form = true;
            echo 'This email is already registered';
          }
        } else {
          echo 'Password and password confirmation not match!';
        }
      } else {
        $show_form = true;
        echo 'All fields are mandatory!';
      }
    }

    if ($show_form) {
  ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <input name="email" placeholder="email" type="email" value="<?php echo $email ?>" required>
      <br>
      <input name="password" placeholder="password" type="password" value="<?php echo $password ?>" required>
      <br>
      <input name="password-confirmation" placeholder="password confirmation" type="password" value="<?php echo $password_confirmation ?>" required>
      <br>
      <button name="submit">Register</button>
    </form>
  <?php
    } else {
      $show_form = false;
  ?>
    <h2>Hello, <?php echo $email ?></h2>
  <?php
    }
  ?>
</body>
</html>
