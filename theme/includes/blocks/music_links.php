<?php $musics = $block['music'] ?>

<section class="music-links">
    <div class="container">
        <div class="inner-wrap">
            <div class="music-links">
                <?php foreach($musics as $music){ ?>
                    <div class="songs">
                        <div class="card tab-item">
                            <div class="card-container">
                                <div class="image-container">
                                    <a href="<?php echo $music['song']['url']; ?>"><img src="<?php echo $music['song_thumbnail'];?> " alt="" class="card-image"></a>
                                </div>
                                <div class="card-text-container">
                                    <div class="song"> <a href="<?php echo $music['song']['url']; ?>"><?php echo $music['song']['title']; ?></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
</section>