<section class="news" >
<div class="news-container" style="background-image: url('<?php echo $block['bg']['url']?>')">
    <div class="text-container">
        <div class="heading"><?php echo $block['heading']?></div>
        <div class="text"><?php echo $block['text']?></div>
    </div>
    <div class="email">
        <?php echo do_shortcode( '[gravityform id="1" title="false" description="false" ajax="true" tabindex="49" field_values="check=First Choice,Second Choice"]' ); ?>
    </div>
</div>
</section>
