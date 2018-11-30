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
    $first_name = '';
    $last_name = '';

    if (isset($_POST['submit'])) {
      $first_name = $_POST['first-name'];
      $last_name = $_POST['last-name'];
      $output_form = false;

      if (empty($first_name) || empty($last_name)) {
        echo '<p style="color: red;">You must fill out both inputs</p>';
        $output_form = true;
      }
    } else {
      $output_form = true;
    }

    if ($output_form) {
  ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
      <input name="first-name" placeholder="first name" type="text" value="<?php echo $first_name; ?>">
      <br>
      <input name="last-name" placeholder="last name" type="text" value="<?php echo $last_name; ?>">
      <br>
      <button name="submit">Submit</button>
    </form>
  <?php
    }
  ?>
</body>
</html>
