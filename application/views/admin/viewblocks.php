<div class="admin-view-blocks">
    <h1>Edit Blocks</h1>

    <div class="block-item item-header">
        <h2>Block Name</h2>

    </div>

    <?php foreach($this->data as $block) { ?>

        <div class="block-item">
            <h2>
                <a href="/admin/editblock/<?php echo $block['id']; ?>">
                    <?php echo $block['name']; ?>
                </a>
            </h2>
            <a href="/admin/deleteblock/<?php echo $block['id']; ?>" class="delete-block">Delete</a>
        </div>

    <?php } ?>

</div>