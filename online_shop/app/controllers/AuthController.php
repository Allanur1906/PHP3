<?php
require_once "app/models/User.php";
require_once "BaseController.php";

class AuthController extends BaseController
{
    public function __construct()
    {
        if($_SESSION['email']){
            header("Location: /online_shop/users/index");
        }
        parent::__construct();
    }

    public static function login_view()
    {
        require_once "app/views/auth/login.php";
    }

    public static function login_post()
    {
        $post = self::xss($_POST);
        $email = $post['email'] ?? '';
        $password = $post['Password'] ?? '';

        $captcha_response = $post['g-recaptcha-response'];

        $user = User::findUser($email);


        $captcha_handle = self::get_captcha_response($captcha_response);
        if($captcha_handle && isset($captcha_response->success) && !$captcha_response->success){
            var_dump($captcha_response);
            $_SESSION["error"] = "invalid captcha handle!";
            header("Location: /online_shop/login");
            exit();
        }

        if ($user && password_verify($password, $user['password'])) {

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            unset($_SESSION['error']);
            header("Location: /online_shop/users/index");
            // require_once "app/views/dashboard.php";
            // Start a session, set session variables, etc. // Ensure the session is started

        } else {
            $_SESSION["error"] = "Invalid login";
            header("Location: /online_shop/login");
            exit();
        }
    }

    public static function get_captcha_response($captcha)
    {
        $secret_key = '6LcZ-Z8qAAAAAF7wqBP0338WhA71miK1X-OVbmqG';
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
            . $secret_key . '&response=' . $captcha;
        $response = file_get_contents($url);
        return $response;

    }

    public static function logout()
    {
        session_unset();

        // Destroy the session
        session_destroy();

        // Redirect to the login page or homepage
        header("Location: /online_shop/login");
        exit();
    }

    public static function show()
    {
        $user_id = $_GET['id'];
        $user = User::getUser($user_id);

        if ($user) {
            require_once "app/views/users/show.php";
        } else {
            $_SESSION['error'] = "User not found";
            require_once "app/views/404.php";
        }
    }

    public static function test()
    {
        echo 'test';
    }
}
