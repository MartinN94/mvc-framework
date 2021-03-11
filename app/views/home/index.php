<?php
    require APPROOT . '/views/includes/head.php';
?>

<body>
    <div id="section-landing">
        <?php
        require APPROOT . '/views/includes/nav.php';
    ?>

        <div class="wrapper-landing">
            <?php if (isLogged()) : ?>
            <h1>Hello, <?php userName(); ?>!
            </h1>
            <?php else :?>
            <h1>Welcome to my custom PHP MVC Framework</h1>
            <?php endif; ?>
        </div>

        <div class="wrapper-search">
            <h2>Search for developers</h2>
            <form action="/users/search" method="POST">
                <input type="text" name="keyword" placeholder="Keyword"
                    value="<?php echo $_SESSION['keyword']; ?>">
                <select name="type" id="type">
                    <option <?php  if ($_SESSION['type'] == null) {
        echo "selected";
    } ?>
                        disabled>Type
                    </option>
                    <option value="frontend" <?php  if ($_SESSION['type'] == 'frontend') {
        echo "selected";
    } ?>>Frontend
                    </option>
                    <option value="backend" <?php  if ($_SESSION['type'] == 'backend') {
        echo "selected";
    } ?>>Backend
                    </option>
                </select>
                <button type="submit" id="search" value="search">Search</button>
            </form>
            <span class="invalidFeedback">
                <?php echo $data['message']; ?>
            </span>
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