<?php

session_start();
// print_r($_SESSION);

if(isset($_SESSION["user_id"]))
{
  $mysqli = require __DIR__ . "/database.php";
  $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Exo:wght@300;400;500;600&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- FontAwesome for icons -->
  <style>
    body {
      font-family: 'Exo', sans-serif;
      background: linear-gradient(120deg, #d1c4e9, #f3e5f5); /* Softer gradient with lighter purple tones */
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden; /* Prevent scrolling for a clean view */
    }

    .container {
      width: 450px;
      background-color: #ffffff;
      border-radius: 20px;
      box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
      padding: 50px;
      text-align: center;
      transition: transform 0.3s ease-in-out;
    }

    .container:hover {
      transform: scale(1.05); /* Hover effect for interactivity */
    }

    h1 {
      color: #8e44ad; /* Deep purple */
      font-weight: 700;
      margin-bottom: 30px;
      font-size: 2em; /* Larger heading for emphasis */
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    p {
      font-size: 16px;
      color: #4a235a; /* Medium purple for text */
      margin-bottom: 20px;
    }

    a {
      color: #9b59b6; /* Light purple */
      text-decoration: none;
      transition: color 0.3s ease-in-out;
      font-weight: 600;
    }

    a:hover {
      color: #8e44ad; /* Deep purple on hover */
    }

    .btn {
      background-color: #8e44ad; /* Deep purple for buttons */
      color: #ffffff;
      border: none;
      border-radius: 10px;
      padding: 12px 25px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }

    .btn:hover {
      background-color: #6a1b9a; /* Darker purple on hover */
    }

    .decorative-line {
      background: linear-gradient(to right, #8e44ad, #9b59b6); /* Gradient decorative line */
      height: 3px;
      border-radius: 5px;
      margin: 20px 0;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Welcome User!</h1>

    <?php if(isset($user)): ?>
      <p>Hello, <?= htmlspecialchars($user["username"]); ?>. You are now logged in.</p>
      <button class="btn"><a href="logout.php" style="color: white; text-decoration: none;">Logout</a></button> <!-- Button for Logout -->
    <?php else: ?>
      <p><a href="login.php">Login</a> or <a href="signup.php">Sign up</a></p>
    <?php endif; ?>

    <div class="decorative-line"></div> <!-- Decorative line for visual separation -->
  </div>
</body>
</html>
