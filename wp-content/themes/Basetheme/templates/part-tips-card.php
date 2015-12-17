
<?php if (""==$image){
    $color="";
} 
?>
<div class="card col-lg-4 <?php echo $color; ?>">
    
    <div class="head-card">
        <img src="<?php echo $image; ?>" alt="">
    </div>
    <div class="content-card">
        <div class="title"><?php the_title(); ?></div>
        <p><?php the_content(); ?></p>
        <a href="">read more</a>

    </div>

</div>