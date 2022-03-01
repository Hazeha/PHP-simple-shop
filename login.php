<?php
/** Start of Page */
require_once '_component/header.php';
?>

<form class="container-fluid col-6" action="_service/loginValidator.php" method="post">
    <img class="mb-4" src="http://webstockreview.net/images/funny-png-images-14.png" alt="" width="72">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
        <input type="email" class="form-control" placeholder="name@example.com" name="email">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating mt-4">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <a href="register.php">Register</a>
</form>

<div>
    User = doe@mail.se  -  pass <br>
    Admin = admin@mail.se  -  root
</div>

<?php
/** End of Page */
require_once '_component/footer.php';
?>
