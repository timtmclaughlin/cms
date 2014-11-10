<div class="edit-block">

    <?php foreach ($this->data as $block) { ?>

        <h1>Edit Block: <?php echo $block['name']; ?></h1>

        <form action="/admin/editblock/<?php echo $block['id']; ?>" method="post" id="blockedit">
            <input type="text" name="name" required="" value="<?php echo $block['name']; ?>"><br>
            <textarea name="content" form="blockedit" rows="10" cols="80"><?php echo $block['content']; ?></textarea><br>
            <input type="submit" name="submit" value="Update">
            <input type="hidden" name="submitted" value="TRUE">
        </form>

    <?php } ?>

</div>



