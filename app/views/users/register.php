<?php
    require APPROOT . '/views/includes/head.php';
?>

<body>
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
                <select name="skills[]" id="skills" multiple="multiple">
                    <option value="frontend">Frontend</option>
                    <optgroup label="Frontend technologies">
                        <option value="angular">Angular</option>
                        <option value="angularjs">AngularJs</option>
                        <option value="react">React</option>
                        <option value="react-native">React Native</option>
                        <option value="vue">Vue</option>
                    </optgroup>
                    <option value="backend">Backend</option>
                    <optgroup label="Backend technologies">
                        <option value="php">PHP</option>
                        <option value="symfony">Symfony</option>
                        <option value="silex">Silex</option>
                        <option value="laravel">Laravel</option>
                        <option value="lumen">Lumen</option>
                        <option value="nodejs">NodeJs</option>
                        <option value="express">Express</option>
                        <option value="nestjs">NestJs</option>
                    </optgroup>
                </select>
                <span class="invalidFeedback">
                    <?php echo $data['skillsError'] ?>
                </span>
                <button type="submit" id="submit" value="submit">Submit</button>

                <p class="options">
                    Already have an account? <a href="/users/login">Sign In!</a>
                </p>
                <p class="options">
                    <a href="/home/index">Return to homepage</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        jQuery('option').mousedown(function(e) {
            e.preventDefault();
            jQuery(this).toggleClass('selected');

            jQuery(this).prop('selected', !jQuery(this).prop('selected'));
            return false;
        });
    </script>
</body>