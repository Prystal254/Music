<section class="music">
    <div class="align">
        <div class="wrap">
            <?php foreach($block['collection'] as $music){?>
                <div class="music-container">
                    <div class="song-container">
                        <div class="play-button">
                            <a class="play">
                                <img src="<?php echo $music['play_button_image']['url']?>">
                            </a>
                        </div>
                        <div class="text-container">
                            <div class="name"><?php echo $music['song_name']?></div>
                            <div class="song"><?php echo $music['song_author']?></div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>  
        <div class="link-container">
            <a href="<?php echo $block['view']['url']?>"><?php echo $block['view']['title']?></a>
        </div>
    </div>
</section>