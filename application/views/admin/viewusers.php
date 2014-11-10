<div class="admin-view-users">
    <h1>Manage Users</h1>

    <div class="user-item item-header">
        <h2>Username</h2>
        <h2>Permissions</h2>
    </div>

    <?php foreach($this->data as $user) { ?>

        <div class="user-item">
            <h2>
                <a href="/admin/edituser/<?php echo $user['id']; ?>">
                    <?php echo $user['username']; ?>
                </a>
            </h2>
            <h2 class="permissions">
                <?php echo $user['permission']; ?>
            </h2>
            <a href="/admin/deleteuser/<?php echo $user['id']; ?>" class="delete-user">Delete</a>
        </div>

    <?php } ?>

</div>