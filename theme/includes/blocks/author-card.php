<section class="author-card">
    <div class="align">
        <?php foreach($block['card'] as $author) {?>
            <div class="card">
                        <div class="card-container">
                            <div class="image-container">
                                <img class="card-image" src="<?php echo $author['card_image']['url']?>">
                            </div>
                            <div class="card-text-container">
                                <div class="name"><?php echo $author['song_name']?></div>
                                <div class="author"><?php echo $author['song_author']?></div>
                                <div class="button-container">
                                    <img class="play" src="<?php echo $author['play_button']['url']?>">
                                    <a class="buy" href="<?php echo $author['buy_button']['url']?>"><?php echo $author['buy_button']['title']?></a>
                                <div>
                            </div>
                        </div>
                    </div>
                    <div class="icon-container">
                        <div class="social-container">
                            <?php foreach ($author['social'] as $social){?>
                                <div class="socials">
                                    <a href="<?php echo $social['link']['url']?>"><img src="<?php echo $social['icons']['url']?>"></a>
                                </div>
                            <?php }?>
                        </div>
                            <div class="sound-waves">
                            <img src="<?php echo $author['card_picture']['url']?>">
                        </div>
                    </div>
                </div>
        <?php }?>
    </div>

</section>