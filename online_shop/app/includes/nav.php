<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Application</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
                <a class="nav-link" href="/online_shop/users/index">Users</a>
                <a class="nav-link" href="/online_shop/products/index">Products</a>
            </div>

            <!-- Dropdown Menu for Logged-in User -->
            <div class="ms-auto dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $_SESSION['email'] ?> <!-- Replace this text dynamically with the user's name -->
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
<!--                    <li><a class="dropdown-item" href="/profile">Profile</a></li>-->
<!--                    <li><a class="dropdown-item" href="/settings">Settings</a></li>-->
<!--                    <li>-->
<!--                        <hr class="dropdown-divider">-->
<!--                    </li>-->
                    <li><a class="dropdown-item" href="#" onclick="document.querySelector('.hidden').submit(); return false;">Logout</a></li>
                    <form action="/online_shop/logout" method="post" class="hidden">

                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>
