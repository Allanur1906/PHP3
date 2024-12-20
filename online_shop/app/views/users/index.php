<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/picnic">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
</head>

<body>


<?php require './app/includes/nav.php' ?>



<div class="container-fluid my-3">

    <?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $messageType = $_SESSION['message_type']; // Optional: For styling

        echo "<div class='alert alert-{$messageType} alert-dismissible fade show' role='alert'>
  <strong>{$messageType}</strong> {$message}
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>

    <div class="d-flex justify-content-between align-items-center">
        <h2>Users</h2>
<!--        <div>-->
<!--            <button class="btn btn-success btn-lg create_user">Create User</button>-->
<!--        </div>-->

    </div>

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="myForm" action="/online_shop/users">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">first name:</label>
                        <input type="text" name="first_name" class="form-control" id="first_name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">last name:</label>
                        <input type="text" name="last_name" class="form-control" id="last_name">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">email:</label>
                        <input type="text" name="email" class="form-control" id="email">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn_submit">Save changes</button>
            </div>
        </div>
    </div>
</div>


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
<!--                        <th></th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user["first_name"] ?></td>
                            <td><?= $user["last_name"] ?></td>
                            <td><?= $user["email"] ?></td>

<!--                            <td>-->
<!--                                <div class="d-flex gap-3">-->
<!--                                    <form action="/online_shop/users/--><?php //= $user["id"] ?><!--/delete" method="post" id="em---><?php //= $user['id'] ?><!--">-->
<!--                                        <a class="btn btn-danger" onclick="if(confirm('are you sure you want to delete this user?'))-->
<!--                                                { document.getElementById('em---><?php //= $user['id'] ?>//').submit() }">Delete</a>
//                                    </form>
//                                    <button class="btn btn-primary update_btn"
//                                            data-first-name="<?php //= $user["first_name"] ?><!--"-->
<!--                                            data-last-name="--><?php //= $user["last_name"] ?><!--"-->
<!--                                            data-email="--><?php //= $user["email"] ?><!--"-->
<!--                                    >Update</button>-->
<!--                                </div>-->
<!--                            </td>-->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"
                integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <script>

            $('.create_user').click(function (e) {
                e.preventDefault();
                $('#exampleModal').modal('show')
            })

            $('.btn_submit').click(function (e) {
                e.preventDefault();
                $('form').submit();
            })

            $(document).on('click','.update_btn', function (e) {
                e.preventDefault();
                document.getElementById('myForm').action = `/online_shop/users/`+$(this).data('id')+`/update`;
                $('#exampleModal').modal('show')
                document.getElementById('first_name').value = $(this).data('first-name')
                document.getElementById('last_name').value = $(this).data('last-name')
                document.getElementById('email').value = $(this).data('email')
            })

        </script>
</body>

</html>