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
        <h2>Sign In</h2>
        <?php echo $data['success']; ?>
        <span class="invalidFeedback">
            <?php echo $data['message']; ?>
        </span>
        <form action="/users/login" method="POST">
            <input type="email" placeholder="Email" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>
            <input type="password" placeholder="Password" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>
            <button type="submit" id="submit" value="submit">Submit</button>

            <p class="options">
                Not registered? <a href="/users/register">Create
                    an account!</a>
            </p>
            <p class="options">
                <a href="/home/index">Return to homepage</a>
            </p>
        </form>
    </div>
</div>