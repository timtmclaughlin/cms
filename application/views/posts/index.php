<h1>Posts</h1>

<?php foreach($this->data as $post ) { ?>
    <h3>
        <a href="/posts/show/<?php echo $post['id'] ?>">
            <?php echo $post['title']; ?>
        </a>
    </h3>
    <p><?php echo $post['content']; ?></p>
<?php } ?>



