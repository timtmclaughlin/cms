<h3>Error Page</h3>
<br />

<?php 
	if (isset($this->errors)) {
		foreach ($this->errors as $key => $er) { ?>
			<p id="error<?=$key;?>"><?php echo $er; ?></p>
			<br />
			<?php 
		}
	}
?>