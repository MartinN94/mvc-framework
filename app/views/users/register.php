<?php
    require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
    require APPROOT . '/views/includes/nav.php';
?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>

        <form action="/users/register" method="POST">
            <input type="text" placeholder="Name" name="name">
            <span class="invalidFeedback">
                <?php echo $data['nameError'] ?>
            </span>
            <input placeholder="Email" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError'] ?>
            </span>
            <input type="password" placeholder="Password" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError'] ?>
            </span>
            <input type="password" placeholder="Confirm Password" name="confirmPassword">
            <span class="invalidFeedback">
                <?php echo $data['confirmPasswordError'] ?>
            </span>
            <button type="submit" id="submit" value="submit">Submit</button>

            <p class="options">
                Already have an account? <a href="/users/login">Sign In!</a>
            </p>
        </form>
    </div>
</div>