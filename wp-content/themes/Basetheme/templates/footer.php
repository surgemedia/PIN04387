<div class="container">
<?php 
    $footer_list = get_field('contact_details','option');
 ?>
	 <ul class="info"> 
    <?php for ($i=0; $i < count($footer_list); $i++) { ?>
      <li>
          <?php echo $footer_list[$i]['label'];?> 
          <a href="<?php echo $footer_list[$i]['Clickable_link'];?>">
            <?php echo $footer_list[$i]['value'];?>
          </a>
      </li>
      
    <?php } ?>
    </ul>
</div>
<footer class="content-info" role="contentinfo">
  
  <div class="foot">
  	<span><?php the_field('footer_text','option') ?></span>
  </div>
  
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
</footer>
