<?php 
    $musics = $block['music_relations'];
    $product = wc_get_product($productID);

    $user_id = get_current_user_id();
    $user_meta = get_user_meta( $user_id, 'product_meta', true );

    
    $purchased_products = get_user_meta($user_id, 'purchased_products', true);
    $form_id = "4";
    
    $product_id = $product->get_id();
?>



<section class="music">
    <div class="align">
        <div class="wrap">
            <?php foreach($musics as $music){
                $categories_list  = get_terms('product_cat', $music->ID);
                //var_dump($music);
                ?>
                <div class="music-container">
                    <div class="song-container">
                        <div class="button-container play-button">
                            <i class="fa fa-3x fa-play-circle play" id="play"></i>
                            <audio src="<?php 
                                    if(is_user_logged_in()){
                                        if(has_purchased_product($user_id,$product_id)){
                                            echo get_field('music_full', $product_id);
                                        }else{
                                            echo get_field('music_sample', $product_id);
                                        }
                                    }else{
                                        echo get_field('music_sample', $product_id); 
                                    }
                                
                        ?>" id="audio"></audio>
                        </div>
                        <div class="text-container">
                            <div class="name"><?php echo $music->post_title; ?></div>
                            <div class="song"><?php echo get_field('music_author', $music->ID); ?></div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>  
        <div class="link-container">
            <a href="<?php echo get_site_url(); ?>/beats/#beats"> <?php echo $block['album_link']['title'] ?></a>
        </div>
    </div>
</section>

<script>
        $(".button-container .play").click(function(){
        
        var audio = $(this).parent().find($("audio"));
        var aud = $(".button-container audio");

        if($(this).hasClass("active")){
            $(this).removeClass("active");
            $(this).removeClass('fa-pause-circle');
            $(this).addClass('fa-play-circle');
            
            audio[0].pause();
        }else{
            $(".button-container .play").removeClass("active");
            aud[0].pause();
            
            $(".button-container .play").removeClass("fa-pause-circle");
            $(".button-container .play").addClass("fa-play-circle");
            $(this).addClass("active");
            
            $(this).removeClass('fa-play-circle');
            $(this).addClass('fa-pause-circle');
            audio[0].play();
            
        }
    
    })
</script>