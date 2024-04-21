<?php
$is_invalid = false;

if($_SERVER["REQUEST_METHOD"] === "POST")
{
  $mysqli = require __DIR__ . "/database.php";
  $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();

  if($user)
  {
    if(password_verify($_POST["password"], $user["password_hash"]))
    {
      session_start();
      session_regenerate_id();
      $_SESSION["user_id"] = $user["id"];
      header("Location: index.php");
      exit;
    }
  }
  $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Exo:wght@300;400;500;600&display=swap">
  <style>
    body {
      font-family: 'Exo', sans-serif;
      background: linear-gradient(135deg, #e1bee7, #f3e5f5);/* Gradient background */
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      width: 500px;
      background-color: #ffffff;
      border-radius: 20px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      padding: 40px;
      text-align: center;
      transition: transform 0.3s ease; /* Container hover effect */
    }

    .container:hover {
      transform: scale(1.05); /* Scale on hover */
    }

    h1 {
      color: #7b1fa2; /* Light purple */
      margin-bottom: 30px;
      font-weight: 600;
      letter-spacing: 1px;
    }

    input[type="email"],
    input[type="password"] {
      width: calc(100% - 20px);
      padding: 12px;
      margin: 10px;
      border: none;
      border-radius: 5px;
      background-color: #f5f5f5;
      font-size: 16px;
      transition: background-color 0.3s ease;
      outline: none;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      background-color: #e0e0e0;
    }

    button {
      width: calc(100% - 20px);
      padding: 15px;
      background-color: #ba68c8; /* Light purple */
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
      outline: none;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1); /* Button hover effect */
    }

    button:hover {
      background-color: #7b1fa2; /* Darker purple */
    }

    .links {
      margin-top: 20px;
      font-size: 14px;
    }

    .links a {
      color: #555555; /* Neutral gray */
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .links a:hover {
      color: #7b1fa2; /* Light purple on hover */
    }

    .decorative-line {
      background: linear-gradient(to right, #9980fa, #806fbf);
      height: 3px;
      border-radius: 5px;
      margin: 20px 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>welcome, please log in your account!</h1>
    <form method="post">
      <input type="email" placeholder="Email" name="email">
      <input type="password" placeholder="Password" name="password">
      <button type="submit">Login</button>
    </form>
    <div class="links">
      <span>Don't have an account? </span><a href="signup.php">Sign up here</a>
    </div>
    <div class="decorative-line"></div> <!-- Horizontal line with gradient -->
  </div>
</body>
</html>

