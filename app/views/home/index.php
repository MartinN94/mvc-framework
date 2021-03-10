<?php
    require APPROOT . '/views/includes/head.php';
?>

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
        <h2>Search for developers:</h2>
        <form action="users/search" method="POST">
            <input type="text" placeholder="Keyword">
            <select name="type" id="type">
                <option value="1">Fronend</option>
                <option value="1">Fronend</option>
            </select>
            <button type="submit" id="search" value="search">Search</button>
        </form>
    </div>
</div>