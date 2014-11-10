<div class="edit-post">

    <?php foreach ($this->data as $post) { ?>

        <h1>Edit Post: <?php echo $post['title']; ?></h1>

        <form action="/admin/editpost/<?php echo $post['id']; ?>" method="post" id="postedit">
            <input type="text" name="title" required="" value="<?php echo $post['title']; ?>"><br>
            <textarea name="content" form="postedit" rows="10" cols="80"><?php echo $post['content']; ?></textarea><br>
            <input type="submit" name="submit" value="Update">
            <input type="hidden" name="submitted" value="TRUE">
        </form>

    <?php } ?>

</div>



