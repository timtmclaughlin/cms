<h1>Login</h1>

<?php if (isset($_POST['warning'])) { echo '<p class="warning">' . $_POST['warning'] . '</p>'; } ?>


<form action="/admin" method="post" id="login">

    <p>
        <label for="username">Username</label>
        <input type="text" name="username" maxlength="20" required="" />
    </p>

    <p>
        <label for="password">Password</label>
        <input type="password" name="password" maxlength="20" required="" />
    </p>

    <p>
        <input type="submit" name="submit" value="Login" />
        <input type="hidden" name="submitted" value="TRUE" />
    </p>

</form>

<div class="register-here">
    <p>Click <a href="/admin/registeruser">here</a> to create an account.</p>
</div>