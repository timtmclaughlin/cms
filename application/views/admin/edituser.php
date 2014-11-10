<div class="edit-user">

    <?php foreach ($this->data as $user) { ?>

        <h1>Edit User: <?php echo $user['username']; ?></h1>

        <?php if (isset($_POST['warning'])) { echo '<p class="warning">' . $_POST['warning'] . '</p>'; } ?>

        <form action="/admin/edituser/<?php echo $user['id']; ?>" method="post" id="useredit">

            <p>
                <label for="username">Username</label>
                <input type="text" name="username" disabled="disabled" value="<?php echo $user['username']; ?>">
                <span class="note">Usernames cannot be changed</span>
            </p>

            <p>
                <label for="permissions">User Role</label>
                <select name="permissions">
                    <option value="admin" <?php if($user['permission'] == 'admin') { echo 'selected'; } ?>>
                        Administrator
                    </option>
                    <option value="subscriber" <?php if($user['permission'] == 'subscriber') { echo 'selected'; } ?>>
                        Subscriber
                    </option>
                </select>
            </p>

            <p>
                <label for="password">New Password</label>
                <input type="password" name="password" required="required" value="">
            </p>

            <p>
                <label for="confpassword">Confirm New Password</label>
                <input type="password" name="confpassword" required="required" value="">
            </p>

            <input type="submit" name="submit" value="Update">
            <input type="hidden" name="submitted" value="TRUE">
        </form>

    <?php } ?>

</div>



