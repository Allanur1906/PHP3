<?php
require_once "app/models/User.php";
require_once "BaseController.php";

class UserController  extends BaseController {

    public static function index() {

        if(!isset($_SESSION["user_id"])){
            header("Location: /online_shop/login");
            exit();
        }

        $users = User::getAllUsers();
        require_once "app/views/users/index.php";
    }

    public static function show() {
        $user_id = $_GET['id'];
        $user = User::getUser($user_id);

        if ($user) {
            require_once "app/views/users/show.php";
        } else {
            $_SESSION['error'] = "User not found";
            require_once "app/views/404.php";
        }

    }

    public static function delete($id){

        $user = User::getUser($id);
        if ($user) {
            // Call the model to delete the product
            $delete_result = User::delete($id);

            session_start();
            if ($delete_result) {
                $_SESSION['message'] = 'User deleted successfully!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Error occurred during product deletion!';
                $_SESSION['message_type'] = 'error';
            }
        } else {
            session_start();
            $_SESSION['message'] = 'Product not found!';
            $_SESSION['message_type'] = 'error';
        }

        // Redirect to the product list page
        header("Location: /online_shop/users/index");
        exit();
    }

    public static function store()
    {
        $post = self::xss($_POST);

       $user =  User::create($post['first_name'], $post['last_name'],$post['email'], hash('sha512', 'password'), 1);

        if(!$user){
            $_SESSION['message'] = 'Error occurred during user creation!';
            $_SESSION['message_type'] = 'error'; // Optional
        } else {
            $_SESSION['message'] = 'user created successfully!';
            $_SESSION['message_type'] = 'success';
        }
        header("Location: /online_shop/users/index");

    }

    public static function update($id){
        $post = self::xss($_POST);
        var_dump($id);
        var_dump($post); die();
        $category = $post['category'];
        $name = $post['name'];
        $price = $post['price'];

        // Call the model method to update the product
        $product_updated = Product::update($id, $category, $name, $price);

        session_start();
        if ($product_updated) {
            $_SESSION['message'] = 'Product updated successfully!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error occurred during product update!';
            $_SESSION['message_type'] = 'error';
        }

        // Redirect to the product list page
        header("Location: /online_shop/products/index");
        exit();


    }

}
?>