<div class="about" style="background-image: url('<?php echo $block['bg']['url']?>')">
    <?php foreach($block['about'] as $about){ ?>
        <div class="wrap <?php if($about['reverse_direction']){echo "reverse";}?>">
            <div class="text-container">
                <div class="heading">
                <?php echo $about['heading']?>
                </div>
                <div class="text">
                <?php echo $about['text']?>
                </div>
                <a class="explore" href="<?php echo $about['button']['url']?>"><?php echo $about['button']['title']?></a>
            </div>
            <div class="image-container">
             <img src="<?php echo $about['bigger_image']['url'];?>">
            </div>
        </div>

    <?php }?>    
</div>  