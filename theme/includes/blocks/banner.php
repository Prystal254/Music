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
                <div class="card-text-container">
                    <div class="name"><?php echo $block['song_name']?></div>
                    <div class="author"><?php echo $block['song_author']?></div>
                    <div class="button-container">
                        <img class="play" src="<?php echo $block['play_button']['url']?>">
                        <a class="buy" href="<?php echo $block['buy_button']['url']?>"><?php echo $block['buy_button']['title']?></a>
                    <div>
                </div>
            </div>
        </div>
        <div class="icon-container">
            <div class="social-container">
                    <?php foreach ($block['social'] as $social){?>
                        <div class="socials">
                            <a href="<?php echo $social['link']['url']?>"><img src="<?php echo $social['icons']['url']?>"></a>
                        </div>
                    <?php }?>
                </div>
                <div class="sound-waves">
                <img src="<?php echo $block['card_picture']['url']?>">
            </div>
        </div>

    </div>
</section>