<h1>Register</h1>

<?php if (isset($_POST['warning'])) { echo '<p class="warning">' . $_POST['warning'] . '</p>'; } ?>



<form method="post" action="registeruser" id="user-register">

    <p>
        <label for="username">Username</label>
        <input type="text" name="username" required="" maxlength="20" >
    </p>

    <p>
        <label for="password">Password</label>
        <input type="password" name="password" required="" maxlength="20">
    </p>

    <p>
        <label for="confirmpw">Confirm Password</label>
        <input type="password" name="confirmpw" required="" maxlength="20">
    </p>

    <p>
        <input type="submit" name="submit" value="Submit">
        <input type="hidden" name="submitted" value="TRUE">
    </p>

</form>