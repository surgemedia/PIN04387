<div class="jumbotron <?php echo $extraClass;?>" style="background-image: url('<?php echo $image;?>');"; >
	<div class="content">
	  <?php if ($preTitle!=""): ?>
	  	<span><?php echo $preTitle;?></span>
	  <?php endif ?>
	  <h1><?php echo $title;?></h1>
		<?php if ($postTitle!=""): ?>
	  	<span><?php echo $postTitle;?></span>
		<?php endif ?>
	</div>
</div>