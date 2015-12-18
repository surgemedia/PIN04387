
<?php if (""!=$image){
    $color="";
    $content_size="";
}else{
    $content_size="big";
}
?>
<div class="card col-lg-4 <?php echo $color; ?>">
    <?php if (""!=$image):?>
        <div class="head-card">
            <img src="<?php echo $image; ?>" alt="">
        </div>
    <?php endif;?>
    <div class="content-card <?php echo $content_size ?>">
        <div class="title"><?php the_title(); ?></div>
        <p><?php the_content(); ?></p>
    </div>
    <a href="<?php the_permalink(); ?>">read more</a>

</div>