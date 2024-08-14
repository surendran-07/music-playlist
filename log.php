<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'prosan';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get username and password from form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Query to check if user exists
  $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($query);

  // Check if user exists
  if ($result->num_rows > 0) {
    // User exists, redirect to welcome page
    header('Location: welc.html');
    exit;
  } else {
    // User does not exist, display error message
    $error = "Invalid username or password";
  }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;500;600;700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Open Sans", sans-serif;
}

body {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  width: 100%;
  padding: 0 10px;
}

body::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background: url("colorful-wallpaper-background-multicolored-generative-ai.jpg"), #000;
  background-position: center;
  background-size: cover;
}

.container {
  width: 400px;
  border-radius: 8px;
  padding: 30px;
  text-align: center;
  border: 1px solid rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(7px);
  -webkit-backdrop-filter: blur(7px);
}

form {
  display: flex;
  flex-direction: column;
}

h2 {
  font-size: 2rem;
  margin-bottom: 20px;
  color: #fff;
}

.input-field {
  position: relative;
  border-bottom: 2px solid #ccc;
  margin: 15px 0;
}

.input-field label {
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  color: #fff;
  font-size: 16px;
  pointer-events: none;
  transition: 0.15s ease;
}

.input-field input {
  width: 100%;
  height: 40px;
  background: transparent;
  border: none;
  outline: none;
  font-size: 16px;
  color: #fff;
}

.input-field input:focus~label,
.input-field input:valid~label {
  font-size: 0.8rem;
  top: 10px;
  transform: translateY(-120%);
}

.forget {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 25px 0 35px 0;
  color: #fff;
}

#Save-login {
  accent-color: #fff;
}

.forget label {
  display: flex;
  align-items: center;
}

.forget label p {
  margin-left: 8px;
}

.container a {
  color: #efefef;
  text-decoration: none;
}

.container a:hover {
  text-decoration: underline;
}

button {
  background: #fff;
  color: #000;
  font-weight: 600;
  border: none;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 3px;
  font-size: 16px;
  border: 2px solid transparent;
  transition: 0.3s ease;
}

button:hover {
  color: #fff;
  border-color: #fff;
  background: rgba(255, 255, 255, 0.15);
}

.Create-account {
  text-align: center;
  margin-top: 30px;
  color: #fff;
}
  </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="input-field">
                <input type="text" id="username" name="username" required />
                <label for="username">Enter username</label>
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" required />
                <label for="password">Enter password</label>
            </div>
            <div class="forget">
                <label for="Save-login">
                    <input type="checkbox" id="Save-login" />
                    <p>Save login information</p>
                </label>
            </div>
            <button type="submit">Log In</button>
            <div class="Create-account">
                <p>Don't have an account? <a href="sign.php">Create account</a></p>
            </div>
        </form>

        <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
    </div>
</body>