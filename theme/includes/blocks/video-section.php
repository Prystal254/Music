<section class="video" style="background-image: url(<?php echo $block['background_image'] ?>);">
    <div class="video-container">
            <?php foreach($block['video_card'] as $card){ 
            
                ?>
                <div class="card-wrap">
                    <div class="frame-wrap">
                        <?php echo $card['video_iframe']; ?>
                    </div>
                    <div class="text-wrap">
                        <div class="title-wrap">
                            <h4><?php echo $card['title']; ?></h4>
                        </div>
                        <div class="subtext-wrap">
                            <p><?php echo $card['subtext']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>   
    </div>
