<?php 
    $productID = $block['featured_product'];
    $product = wc_get_product($productID);

    $user_id = get_current_user_id();
    $user_meta = get_user_meta( $user_id, 'product_meta', true );

    
    $purchased_products = get_user_meta($user_id, 'purchased_products', true);
    $form_id = "4";
    
    $product_id = $product->get_id();
  
    $form = GFAPI::get_form($form_id);
    // Loop through the form fields to find the "product_id" field
    foreach ( $form['fields'] as $field ) {
        if ( $field->adminLabel == 'product_id' ) {
            // Store the ID of the "product_id" field in a variable
            $product_id_field_id = $field->id;
            break;
        }
    }
?>


<section class="banner" style="background-image: url('<?php echo $block['bg']['url']?>')">
    <div class="banner-container">
        <div class="text-container">
            <div class="heading"><?php echo $block['heading']?></div>
            <div class="text"><?php echo $block['text']?></div>
        </div>
        <div class="card">
            <div class="card-container">
                <div class="image-container">
                    <img class="card-image" src="<?php echo $block['card_image']['url']?>">
                </div>
                <div class="content-container">
                    <div class="card-text-container">
                        <div class="card-text-wrap">
                            <div class="name"><?php echo $productID->post_title;?></div>
                            <div class="author"><?php echo get_field('music_author', $productID);?></div>
                        </div>
                        <div class="social-container">
                            <?php foreach ($block['social'] as $social){?>
                                <div class="socials">
                                    <a href="<?php echo $social['link']['url']?>"><img src="<?php echo $social['icons']['url']?>"></a>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="icon-container">
                        <div class="button-container">
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
                                    
                                    ?>" id="audio" class="song">
                            </audio>
                            <?php if(is_user_logged_in()){
                                    if(has_purchased_product($user_id,$product_id)){ ?>
                                    <a href="<?php echo get_field('music_full', $product_id); ?>" download class="download"> Download Now </a>
                                <?php } else{ ?>
                                    <a class="buy" data-val="<?php echo $product_id ?>">Buy Now</a>
                                <?php  }  
                                }else {?>
                                    <a class="buy" data-val="<?php echo $product_id ?>">Buy Now</a>
                            <?php } ?>
                        </div>
                        <div class="sound-waves">
                            <img src="<?php echo $block['card_picture']['url']?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-popup">
                <div class="popup-wrap">
                    <span class="cross">&#10010;</span>
                    <div class="popup-container">
                        <div class="form">
                                <?php gravity_form( $form_id, false, false, false, array( 'product_id' => $product_id ), true); 
                                    ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    $(document).ready(function() {
        $(".buy").click(function(){
            var data = $(this).data("val");
            console.log(data);
            $("#input_4_13").val(data);
        })
            
    });
    $(".banner banner-container .card .card-container .content-container .icon-container .button-container .play").click(function(){
        
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

    $(".card .card-container .content-container .icon-container .button-container .buy").click(function(){
        $(this).parents().siblings(".card-popup").addClass("active");
    })
    $(".card .card-popup .popup-wrap .cross").click(function(){
        $(this).parents().find(".card-popup").removeClass("active");
    })


</script>