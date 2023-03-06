<?php 
    $musics = $block['top_songs'];

    
    $user_id = get_current_user_id();
    $user_meta = get_user_meta( $user_id, 'product_meta', true );
    
?>

<section class="main-banner">
    <div class="main-container align">
        <div class="image-container">
            <div class="image">
                <img src="<?php echo $block['main_image']['url'] ?>" alt="">
            </div>
        </div>
        <div class="text-container">
            <div class="content">
                <div class="heading">
                    <h1><?php echo $block['heading'] ?></h1>
                </div>
                <div class="text">
                    <p><?php echo $block['text'] ?></p>
                </div>
                <div class="sub-heading">
                    <?php if($block['sub_heading']){
                            echo $block['sub_heading']; ?>
                            <div class="test">
                                <?php 
                                $i = 1;
                                    foreach($musics as $music){ 
                                        $product_id = $music->ID; 
                                        ?>
                                        <p>Beat <?php echo $i ?> - <span>(<?php echo $music->post_title; ?>)</span></p>
                                    <?php 
                                    $i++;    
                                }
                                ?>
                            </div>
                            <?php }
                    ?>
                </div>
            </div>
            <?php if($block["music"]) {?>                
                <div class="wrap">
                    <?php if($block['songs_choice'] == "yes"){ ?>
                        <?php foreach($musics as $music){ 
                            $product_id = $music->ID;?>
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
                                    <div class="song-text-container">
                                        <div class="name"><?php echo $music->post_title; ?></div>
                                        <div class="song"><?php echo get_field('music_author', $music->ID); ?></div>
                                        
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<script>
        $(".main-banner .align .text-container .wrap .music-container .song-container .button-container .play").click(function(){
        
        var audio = $(this).siblings.($("audio"));
        var aud = $(".main-banner .align .text-container .wrap .music-container .song-container .button-container audio");

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







