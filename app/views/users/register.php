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
                <input type="text" placeholder="Name" name="name"
                    value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>">
                <span class="invalidFeedback">
                    <?php echo $data['nameError'] ?>
                </span>
                <input placeholder="Email" name="email"
                    value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>">
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
                    <option value="frontend" <?php if (in_array("frontend", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>Frontend
                    </option>
                    <optgroup label="Frontend technologies">
                        <option value="angular" <?php if (in_array("angular", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>Angular
                        </option>
                        <option value="angularjs" <?php if (in_array("angularjs", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>AngularJs
                        </option>
                        <option value="react" <?php if (in_array("react", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>React
                        </option>
                        <option value="react-native" <?php if (in_array("react-native", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>React Native
                        </option>
                        <option value="vue" <?php if (in_array("vue", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>Vue
                        </option>
                    </optgroup>
                    <option value="backend" <?php if (in_array("backend", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>Backend
                    </option>
                    <optgroup label="Backend technologies">
                        <option value="php" <?php if (in_array("php", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>PHP
                        </option>
                        <option value="symfony" <?php if (in_array("symfony", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>Symfony
                        </option>
                        <option value="silex" <?php if (in_array("silex", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>Silex
                        </option>
                        <option value="laravel" <?php if (in_array("laravel", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>Laravel
                        </option>
                        <option value="lumen" <?php if (in_array("lumen", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>Lumen
                        </option>
                        <option value="nodejs" <?php if (in_array("nodejs", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>NodeJs
                        </option>
                        <option value="express" <?php if (in_array("express", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>Express
                        </option>
                        <option value="nestjs" <?php if (in_array("nestjs", $_POST["skills"])) {
    echo 'selected="selected"';
} ?>>NestJs
                        </option>
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