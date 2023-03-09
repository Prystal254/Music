<?php


$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'orderby' => 'category',
);
$products = new WP_Query( $args );

// Get the form object
$user_id = get_current_user_id();
$user_meta = get_user_meta( $user_id, 'purchased_product_ids', true );



$categories_list  = get_terms( array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
) );
$product_tags = get_terms( 'product_tag', $args );

// function update_purchased_products_meta($order_id) {
//     $user_id = $order->get_user_id();
//     $purchased_products = get_user_meta($user_id, 'purchased_products', true);

?>

<section class="author-card" id="music-album"> 
    <div class="align" style="background:transparent; color: white;"> 

                        <?php if ( $products->have_posts() ){ ?>
                            <div class="tab">
                                <div class="tab-container">
                                    <?php foreach($categories_list as $category){ 
                                            $args = array(
                                                'post_type' => 'product',
                                                'orderby' => 'category',
                                                'posts_per_page' => -1,
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => $category->taxonomy,
                                                        'field' => 'slug',
                                                        'terms' => $category->slug,
                                                    )
                                                )
                                            );
                                            $loop = new WP_Query($args); 
                                            if($loop->have_posts()){
                                            $posts = $loop->posts; ?>
                                            

                                                    <div data-tabs="<?php echo $category->slug?>" class="tab-title">
                                                        <h4><?php echo $category->name; ?></h4>
                                                    </div>
 
                                            <?php 
                                            }
                                        } ?>
                                    </div>
                                </div>
                        <?php }?>
                        <?php if ( $products->have_posts() ) : ?>
                                <div class="tab-content">
                                    <?php foreach($categories_list as $category){ 
                                            $args = array(
                                                'post_type' => 'product',
                                                'orderby' => 'category',
                                                'posts_per_page' => 10,
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => $category->taxonomy,
                                                        'field' => 'slug',
                                                        'terms' => $category->slug,
                                                    )
                                                )
                                            );
                                            $loop = new WP_Query($args); 
                                            if($loop->have_posts()){
                                            $posts = $loop->posts; ?>
                                                        <div class="tab-items tab-items-<?php echo $category->slug ?>">
                                                            <?php foreach($posts as $post){
                                                                $purchased_products = get_user_meta($user_id, 'purchased_products', true);
                                                                // var_dump($post);
                                                                $form_id = "4";
                                                                $product_id = $post->ID;

                                                                $form = GFAPI::get_form($form_id);
                                                                // Loop through the form fields to find the "product_id" field
                                                                foreach ( $form['fields'] as $field ) {
                                                                    if ( $field->adminLabel == 'product_id' ) {
                                                                        // Store the ID of the "product_id" field in a variable
                                                                        $product_id_field_id = $field->id;

                                                                        break;
                                                                    }
                                                                }

                                                                // var_dump($product_id_field_id);
                                                                ?>
                                                                <div class="card tab-item">
                                                                    <div class="card-container">
                                                                        <div class="image-container">
                                                                            <img src="<?php echo get_the_post_thumbnail_url($post->ID)?> " alt="" class="card-image">
                                                                        </div>
                                                                        <div class="card-text-container">
                                                                            <div class="name"><?php echo $post->post_title; ?></div>
                                                                            <div class="author"><?php echo get_field('music_author', $post->ID); ?></div>
                                                                            <div class="button-container">
                                                                                <i class="fa fa-3x fa-play-circle play" id="play" ></i>
                                                                                <audio src="<?php 
                                                                                            if(is_user_logged_in()){
                                                                                                if(has_purchased_product($user_id,$product_id)){
                                                                                                    echo get_field('music_full', $post->ID);
                                                                                                }else{
                                                                                                    echo get_field('music_sample', $post->ID);
                                                                                                }
                                                                                            }else{
                                                                                                echo get_field('music_sample', $post->ID); 
                                                                                            }
                                                                                        
                                                                                ?>" id="audio" class="song"></audio>
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
                                                                        </div>
                                                                        <div class="icon-container">
                                                                            <div class="social-container">
                                                                                    <div class="socials">
                                                                                        <a href=""><img src="<?php echo '/wp-content/uploads/2022/12/Facebook_black.png'; ?>"></a>
                                                                                    </div>
                                                                                    <div class="socials">
                                                                                        <a href=""><img src="<?php echo '/wp-content/uploads/2022/12/Spotify_black.png'; ?>"></a>
                                                                                    </div>
                                                                                    <div class="socials">
                                                                                        <a href=""><img src="<?php echo '/wp-content/uploads/2022/12/Instagram_black.png'; ?>"></a>
                                                                                    </div>
                                                                                    <div class="socials">
                                                                                        <a href=""><img src="<?php echo '/wp-content/uploads/2022/12/Youtube_black.png'; ?>"></a>
                                                                                    </div>
                                                                            </div>
                                                                            <div class="sound-waves">
                                                                                <img src="<?php echo '/wp-content/uploads/2022/12/Group-1000001529.png';?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            <?php } ?>
                                                            <div class="card-popup">
                                                                <div class="popup-wrap">
                                                                    <span class="cross">&#10010;</span>
                                                                    <div class="popup-container">

                                                                <!-- Gravity Forms form -->
                                                                        <div class="form">
                                                                            <?php gravity_form( $form_id, false, false, false, array( 'product_id' => $product_id ), true); 
                                                                            // var_dump($product_id);
                                                                            ?>

                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php } ?>      
                                        <?php } ?>
                                    </div>
                                <?php endif; ?>
                                <?php 
                                //     update_user_meta($user_id, 'purchased_products', $purchased_products);
                                // }
                                ?>



<script>



$(document).ready(function() {
        $(".buy").click(function(){
            var data = $(this).data("val");
            console.log(data);
            $("#input_4_13").val(data);
        })
            
    });
                                                                                    

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

    $(".card .card-container .card-text-container .button-container .buy").click(function(){
        $(this).parents().siblings(".card-popup").addClass("active");
    })
    $(".tab-items .card-popup .popup-wrap .cross").click(function(){
        $(this).parents().find(".card-popup").removeClass("active");
    })



    $(document).ready(function(){
        $(".tab-content .tab-items:eq(0)").addClass("active");
        $(".tab .tab-container .tab-title:eq(0)").addClass('active');
        $(".tab-content .tab-items:eq(0)").fadeIn('fast');
        $(".tab .tab-container .tab-title").click(function(){
            var tab = $(this).data("tabs")
            console.log(tab);
            if($(this).hasClass("active")){
                
            }else{
                $(".tab .tab-container .tab-title").removeClass("active");
                $(this).addClass("active");
                $(".tab-content .tab-items").fadeOut('fast');
                $(".tab-content .tab-items-"+tab).fadeIn('fast');
            }
        });
        


    })




</script>