<!-- Listings Sub Navigation -->
	<ul class="nav nav-tabs" style="margin-bottom: 1em;">
		<li class="<?php echo $page_now == 'all' ? 'active':''; ?>">
			<a href="<?php echo CORE_URL.'listings.php' ?>">All</a>
		</li>
		<li class="<?php echo $page_now == 'current' ? 'active':''; ?>">
			<a href="<?php echo CORE_URL.'listings-current.php' ?>">Current</a>
		</li>
		<li class="<?php echo $page_now == 'sold' ? 'active':''; ?>">
			<a href="<?php echo CORE_URL.'listings-sold.php' ?>">Sold</a>
		</li>
		<li class="<?php echo $page_now == 'leased' ? 'active':''; ?>">
			<a href="<?php echo CORE_URL.'listings-leased.php' ?>">Leased</a>
		</li>
		<li class="<?php echo $page_now == 'withdrawn' ? 'active':''; ?>">
			<a href="<?php echo CORE_URL.'listings-withdrawn.php' ?>">Withdrawn</a>
		</li>
		<li class="<?php echo $page_now == 'offmarket' ? 'active':''; ?>">
			<a href="<?php echo CORE_URL.'listings-offmarket.php' ?>">Off Market</a>
		</li>
		<li class="<?php echo $page_now == 'imported' ? 'active':''; ?>">
			<a href="<?php echo CORE_URL.'listings-imported.php' ?>">Imported</a>
		</li>
		<li class="<?php echo $page_now == 'agents' ? 'active':''; ?>">
			<a href="<?php echo CORE_URL.'listings-agent.php' ?>">Agents</a>
		</li>
		<?php
				$images = glob(IMAGES_PATH."*.{jpg,png,gif}", GLOB_BRACE);
				if( count($images) > 0 ) {
		?>
		<li class="<?php echo $page_now == 'images' ? 'active':''; ?>">
			<a href="<?php echo CORE_URL.'listings-images.php' ?>">Images</a>
		</li>
		<?php } ?>
	</ul>
