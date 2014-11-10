<div class="admin-view-posts">
    <h1>Edit Posts</h1>

    <div class="post-item item-header">
        <h2>Post Title</h2>

    </div>

    <?php foreach($this->data as $post) { ?>

        <div class="post-item">
            <h2>
                <a href="/admin/editpost/<?php echo $post['id']; ?>">
                    <?php echo $post['title']; ?>
                </a>
            </h2>
            <a href="/admin/deletepost/<?php echo $post['id']; ?>" class="delete-post">Delete</a>
        </div>

    <?php } ?>

</div>