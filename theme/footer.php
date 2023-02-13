<?php 
 $logo = get_field("footer_logo","option");
 $socials = get_field("socials","option");
 $nav = get_field("nav","option");
 $copyright= get_field("copyright","option");
?>
  <div class="footer-container">
    <div class="footer">
        <div class="logo">
            <img src= "<?php echo $logo ['url']?>">
        </div>
        <div class="container">
            <div class="social-container">
                    <?php foreach($socials as $social){ ?>
                        <div class="social-wrap">
                            <div class="social">
                                <a href="<?php echo $social["link"]["url"]?>"><img src="<?php echo $social['icons']['url'];?>"></a>
                            </div>
                        </div>    
                    <?php }?>
            </div>
            <div class="link-container">
                    <?php foreach($nav as $links){ ?>
                        <div class="link-wrap">
                            <div class="link">
                                <a href="<?php echo $links["link"]["url"]?>"><?php echo $links["link"]["title"]?></a>
                            </div>
                        </div>    
                    <?php }?>
            </div>
        </div>
        <div class="align">
            <div class="copy-container">
                <div class="copy">
                    <p><?php echo $copyright; ?></p>
                </div>
            </div>
        </div>            
    </div>
  </div>
       
    
    </div><!-- closing all div -->
    

    <?php wp_footer(); ?>
	</body>
</html>
