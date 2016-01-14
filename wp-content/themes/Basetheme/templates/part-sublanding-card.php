<div class="card col-lg-4 <?php echo $color; ?>">
    <?php if (""!=$image):?>
        <div class="head-card">
            <img src="<?php echo $image; ?>" alt="">
        </div>
    <?php endif;?>
    <div class="content-card small">
        <div class="title"><?php echo $title; ?></div>
        <p><?php echo $content?></p>
    </div>
    <a href="<?php echo $linkto ?>"><?php echo $linktext ?></a>

</div>