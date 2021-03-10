<nav class="top-nav">
    <ul>
        <li>
            <?php if (!isLogged()) : ?>
            <a href="/users/register">Register</a>
            <?php endif; ?>
        </li>
        <li class="btn-login">
            <?php if (isLogged()) : ?>
            <a href="/users/logout">Logout</a>
            <?php else : ?>
            <a href="/users/login">Login</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>