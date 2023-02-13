<section class="main-banner">
    <div class="align">
        <div class="image-container">
            <div class="image">
                <img src="<?php echo $block['main_image']['url']?>">
            </div>
        </div>
        <div class="text-container">
            <div class="heading">
                <?php echo $block['heading']?>
            </div>
            <div class="text">
                <?php echo $block['text']?>
            </div>
            <div class="sub-heading">
                <?php echo $block['sub_heading']?>
            </div>
            <div class="wrap">
                <?php foreach($block['music'] as $sound){?>
                    <div class="music-container">
                        <div class="song-container">
                            <div class="play-button">
                                <a class="play">
                                    <img src="<?php echo $sound['play_button']['url']?>">
                                </a>
                            </div>
                            <div class="play-text-container">
                                <div class="name"><?php echo $sound['song_name']?></div>
                                <div class="song"><?php echo $sound['author']?></div>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>  
    </div>
</section>