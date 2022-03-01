<?php
/** Start of Page */
require_once '_component/header.php';
?>

<form class="container-fluid col-6" action="../_action/addUser.php" method="post">
    <img class="mb-4" src="http://webstockreview.net/images/funny-png-images-14.png" alt="" width="72">
    <h1 class="h3 mb-3 fw-normal">Please Sign Up</h1>

    <div class="form-floating">
        <input type="text" class="form-control" placeholder="John Doe" name="name">
        <label for="floatingInput">Full Name</label>
    </div>
    <div class="form-floating mt-4">
        <input type="email" class="form-control" placeholder="John.Doe@example.com" name="email">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating mt-4">
        <input type="number" class="form-control" placeholder="Phone Number" name="phone">
        <label for="floatingPassword">Phone Number</label>
    </div>
    <div class="form-floating mt-4">
        <input type="text" class="form-control" placeholder="Address" name="address">
        <label for="floatingPassword">Address</label>
    </div>
    <div class="form-floating mt-4">
        <input type="number" class="form-control" placeholder="Post Code" name="postcode">
        <label for="floatingPassword">Post Code</label>
    </div>
    <div class="form-floating mt-4">
        <input type="text" class="form-control" placeholder="Country" name="country">
        <label for="floatingPassword">Country</label>
    </div>
    <div class="form-floating mt-4">
        <input type="password" class="form-control" placeholder="Enter Password" name="password">
        <label for="floatingPassword">Enter Password</label>
        <?php if (isset($_GET['error'])){
            if (($_GET['error'] == 'wrongpass')){
                echo 'Password does not match';
            }
        } ?>
    </div>
    <div class="form-floating mt-4">
        <input type="password" class="form-control" placeholder="Re Enter Password" name="password2">
        <label for="floatingPassword">Re-Enter Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary mt-4" type="submit" name="submit">Sign up</button>
    <a href="login.php">Login</a>
</form>

<?php
/** End of Page */
require_once '_component/footer.php';
?>
