<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'orderby' => 'DESC',
);

$products = new WP_Query( $args );

$user_id = get_current_user_id();
$user_meta = get_user_meta( $user_id, 'product_meta', true );

$categories_list  = get_terms( array(
    'taxonomy' => 'product_tag',
    'hide_empty' => false,
    'orderby' => 'ASC',
) );

$product_tags = get_terms( 'product_tag', $args );

?>




<section class="tabs-beats" id="beats">
    <div class="container">
        <div class="heading">
            <h2><?php echo $block['heading'] ?></h2>
        </div>
        <div class="beats-title">
            <div class="title-wrap">
                <?php foreach($product_tags as $tags){ 
                    //var_dump($tags);?>
                    <div class="title" data-tabs="<?php echo $tags->slug; ?>">
                        <h4><?php echo $tags->name; ?></h4>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="beats-content">
            <?php if($products->have_posts()){ ?>
                <div class="inner-wrap">
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
                                $posts = $loop->posts; ?>
                                <div class="tab-items tab-items-<?php echo $category->slug; ?>">
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
                                        //var_dump($post); ?>
                                        <div class="tab-item card-container">
                                            <div class="image-container">
                                                <img src="<?php echo get_the_post_thumbnail_url($post->ID) ?>" alt="" class="card-image">
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
                                                    
                                                    <!-- <a href="" class="cart-btn">Cart</a> -->
                                                </div>
                                            </div>
                                            <div class="icon-container">
                                                <div class="social-container">
                                                        <div class="socials">
                                                            <a href=""><img src="<?php echo '/wp-content/uploads/2022/12/Facebook_black.png'; ?>"></a>
                                                        </div>
                                                        <div class="socials">
                                                            <a href="https://open.spotify.com/artist/29d0GjlUsXCMyJHwai202X?si=vd6eaU2VSRivGRhtXEoV6w"><img src="<?php echo '/wp-content/uploads/2022/12/Spotify_black.png'; ?>"></a>
                                                        </div>
                                                        <div class="socials">
                                                            <a href=""><img src="<?php echo '/wp-content/uploads/2022/12/Instagram_black.png'; ?>"></a>
                                                        </div>
                                                        <div class="socials">
                                                            <a href="https://www.youtube.com/channel/UCw8-EKoWuuXS1sMi4GMxu-w"><img src="<?php echo '/wp-content/uploads/2022/12/Youtube_black.png'; ?>"></a>
                                                        </div>
                                                </div>
                                                <div class="sound-waves">
                                                    <img src="<?php echo '/wp-content/uploads/2023/03/Gif-2.png';?>">
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </div>
                    <?php } ?>
                    <div class="card-popup">
                        <div class="popup-wrap">
                            <span class="cross">&#10010;</span>
                            <div class="popup-container">
                                <div class="form">
                                    <?php gravity_form( $form_id, false, false, false, array( 'product_id' => $product_id ), true); 
                                    // echo do_shortcode("[id='4' ajax='true]")
                                    ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>



<script>
    $(".beats-content .inner-wrap .tab-items .tab-item .card-text-container .button-container .buy").click(function(){
        $(this).parents().siblings(".card-popup").addClass("active");
    })
    $(".beats-content .inner-wrap .card-popup .popup-wrap .cross").click(function(){
        $(this).parents().find(".card-popup").removeClass("active");
    })


    $(document).ready(function() {
        $(".buy").click(function(){
            var data = $(this).data("val");
            console.log(data);
            $("#input_4_13").val(data);
        })
            
    });

    $(document).ready(function(){
        $(".tabs-beats .container .beats-title .title-wrap .title:eq(-1)").addClass("active");
        $(".tabs-beats .container .beats-content .inner-wrap .tab-items:eq(-1)").addClass("active");
        $(".tabs-beats .container .beats-content .inner-wrap .tab-items:eq(-1)").fadeIn('fast');
        $(".tabs-beats .container .beats-title .title-wrap .title").click(function(){
            var tab = $(this).data("tabs");
            console.log(tab);
            if($(this).hasClass("active")){

            }else{
                $(".tabs-beats .container .beats-title .title-wrap .title").removeClass("active");
                $(this).addClass("active");
                $(".tabs-beats .container .beats-content .inner-wrap .tab-items").removeClass("active");
                $(".tabs-beats .container .beats-content .inner-wrap .tab-items").fadeOut('fast');
                //$(".tabs-beats .container .beats-content .inner-wrap .tab-items-"+tab).addClass('active');
                $(".tabs-beats .container .beats-content .inner-wrap .tab-items-"+tab).fadeIn('fast');
            }
        });
    })



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
        var src = $(this).parents(".card-text-container").siblings(".icon-container").children(".sound-waves").children("img").attr("src");
        $(this).parents(".card-text-container").siblings(".icon-container").children(".sound-waves").children("img").toggleClass("playwave");
        if($(this).parents(".card-text-container").siblings(".icon-container").children(".sound-waves").children("img").hasClass("playwave")){
            $(this).parents(".card-text-container").siblings(".icon-container").children(".sound-waves").children("img").attr("src", src.replace(/\.png$/i, ".gif"));
        } else {
            $(this).parents(".card-text-container").siblings(".icon-container").children(".sound-waves").children("img").attr("src", src.replace(/\.gif$/i, ".png"));
        }
    })

    
</script>