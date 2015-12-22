<div class="jumbotron <?php echo $extraClass;?>" style="background-image: url('<?php echo $image;?>');"; >
	<div class="content">
	  <?php if ($preTitle!=""): ?>
	  	<span class="before-title"><?php echo $preTitle;?></span>
	  <?php endif ?>
	  <h1><?php echo $title;?></h1>
		<?php if ($postTitle!=""): ?>
	  	<span class="after-title"><?php echo $postTitle;?></span>
		<?php endif ?>
	</div>
</div>