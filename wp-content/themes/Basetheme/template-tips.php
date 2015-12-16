<?php
/**
 * Template Name: Tips Template
 */
?>
<?php while (have_posts()) : the_post(); ?>

<?php 
	$extraClass="small";
	$image=getFeaturedUrl(get_the_id());
	$preTitle="";
	$title="Buying<b>Tips</b>";
	$postTitle="";
	include(locate_template('templates/part-jumbotron.php')); ?>
	
	
<div class="tips-content">
		<div class="content">
			“I just want to say a belated thanks to the team at Pinnacle Properties and to recommend their service to anyone looking to sell their property! It was an absolute pleasure selling my house  with Von. She is always very prompt, positive and helpful.”

		</div>
			<div class="author">
				Martin Shane
			</div>
	</div>


<div class="card col-lg-4">
	
	<div class="head-card">
		<img src="http://lorempixel.com/400/200/sports/Dummy-Text/" alt="">
	</div>
	<div class="content-card">
		<div class="title">what is the value of a quiet home?</div>
		<p>According to property experts, the majority of the housing market does put higher value on homes that are quiet. But is quiet in the ear of the beholder?</p>
		<a href="">read more</a>

	</div>

</div>



<?php endwhile; ?>
