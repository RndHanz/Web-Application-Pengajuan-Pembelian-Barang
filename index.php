
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet"  href='assets/css/style_login.css'/>
  </head>
  <body> 
    <div class="login-container">
    <img src="assets/img/account.png" style="width: 30%">
      <h2>Login</h2>
      <form action="process/process_login.php" method="post">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="submit" value="Login" />
      </form>
    </div>

    


  </body>
</html>

