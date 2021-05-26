<?php if (count($errors) > 0) : ?>
	<div class="error-container">
	  <div class="error">
	  	<?php foreach ($errors as $error) : ?>
	  	  <div class="error-text"><?php echo $error ?></div>
	  	<?php endforeach ?>
	  </div>
	 </div>
<?php  endif ?>