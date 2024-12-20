

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <form action="login_post" method="post" id="loginForm" >
    <h2>LOGIN</h2>
    <?php if(isset($_SESSION['error'])){ ?>
        <p class="error"> <?php echo $_SESSION['error']; ?></p>
    <?php }?>
    
    <label>Username</label>
    <input type="text" name="email" placeholder="email" value="admin@admin.com"><br>
    <label>Password</label>
    <input type="password" value="admin" name="Password" placeholder="Password"><br>

        <!-- div to show reCAPTCHA -->
      <div style="margin-left: 10px;">
          <div class="g-recaptcha"
               data-sitekey="6LcZ-Z8qAAAAAI4WpJaweSPKCEQAfo-R4VF-ETZD">
          </div>
      </div>

    <button type="submit" >Login</button>


    </form>


    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            // Get the reCAPTCHA response token
            const recaptchaResponse = grecaptcha.getResponse();

            // Check if the reCAPTCHA is completed
            if (!recaptchaResponse) {
                // Prevent form submission
                e.preventDefault();
                alert('handle google captcha!');
            }
        });

    </script>
</body>
</html>