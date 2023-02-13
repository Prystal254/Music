<?php 
$args = array("hide_empty" => 0,
"type"      => "post",
"orderby"   => "name",
"order"     => "ASC" );
$music_tabs = get_categories($args);
//var_dump($music_tabs);?>
<section class="tabs">
    <div class="container">
        <div class="heading">
            <?php echo $block['heading']?>
        </div>
        <div class="tabs-wrap">

            <div class="tab-top-wrap">
                <?php if($music_tabs){
                    foreach ($music_tabs as $tabs) {
                        ?>
                        <div class="tab-item" data-tabs="<?php echo $tabs->slug?>">
                            <?php echo $tabs->name?>
                        </div>
                        <?php
                    }
                }?>
            </div>
            <div class="tab-content-wrap">
                <?php if ($music_tabs){
                    foreach ($music_tabs as $tabs_content){
                        $id = $tabs_content->term_id;
                        ?>
                        <div class="tab-content <?php echo "tab-".$tabs_content->slug;?>">
                          <?php $new_arg = array(
                            'post_type' => 'music',
                            'posts_per_page' => '12',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'term_id',
                                    'terms' => $id,
                                )
                                ),
                            );
                            $wp_query = new WP_Query($new_arg);
                            $posts = $wp_query -> get_posts();
                            if ($posts){
                                foreach ($posts as $post){
                                    $links = get_field('social_links', $post->ID)
                                    ?>
                                    <div class="post-item">
                                        <div class="card-container">
                                            <div class="image-container">
                                                <img src= "<?php echo wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' )[0];?>">
                                            </div>
                                            <div class="card-text-container">
                                                <div class="name"><?php echo $post->post_title?></div>
                                                <div class="author"><?php echo $post->post_content?></div>
                                                <div class="button-container">
                                                    <img class='play' src="../.././wp-content/uploads/2022/12/Vector-1.png">
                                                    <a class="buy" href="">Buy Now</a>
                                                </div>
                                            </div>
                                            <div class="icon-container">
                                                <div class="social-container">
                                                    <?php foreach ($links as $social){?>
                                                        <div class="socials">
                                                            <a href="<?php echo $social['link']['url']?>"><img src="<?php echo $social['icons']['url']?>"></a>
                                                        </div>
                                                    <?php }?>
                                                </div>
                                                <div class="sound-waves">
                                                        <svg width="auto" height="auto" viewBox="0 0 877 125" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <mask id="mask0_79_5281" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="877" height="125">
                                                        <rect x="0.996338" y="0.639771" width="876.004" height="123.755" fill="url(#paint0_linear_79_5281)"/>
                                                        </mask>
                                                        <g mask="url(#mask0_79_5281)">
                                                        <g filter="url(#filter0_f_79_5281)">
                                                        <rect x="877" y="124.395" width="876.343" height="106.677" transform="rotate(-180 877 124.395)" fill="url(#pattern0)"/>
                                                        <rect x="877" y="124.395" width="876.343" height="106.677" transform="rotate(-180 877 124.395)" fill="#0564BF" fill-opacity="0.2"/>
                                                        </g>
                                                        </g>
                                                        <mask id="mask1_79_5281" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="17" width="877" height="108">
                                                        <rect x="0.996307" y="17.718" width="876.004" height="106.677" fill="url(#paint1_linear_79_5281)"/>
                                                        </mask>
                                                        <g mask="url(#mask1_79_5281)">
                                                        <rect x="877" y="124.395" width="876.343" height="100.129" transform="rotate(-180 877 124.395)" fill="url(#pattern1)"/>
                                                        </g>
                                                        <defs>
                                                        <filter id="filter0_f_79_5281" x="-33.3431" y="-16.282" width="944.343" height="174.677" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                                                        <feGaussianBlur stdDeviation="17" result="effect1_foregroundBlur_79_5281"/>
                                                        </filter>
                                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                        <use xlink:href="#image0_79_5281" transform="translate(-0.0326953) scale(0.000260105 0.00213675)"/>
                                                        </pattern>
                                                        <pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                        <use xlink:href="#image0_79_5281" transform="scale(0.000244141 0.00213675)"/>
                                                        </pattern>
                                                        <linearGradient id="paint0_linear_79_5281" x1="0.996338" y1="79.987" x2="877.013" y2="74.2252" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0.00725166" stop-color="#D9D9D9" stop-opacity="0"/>
                                                        <stop offset="0.151042" stop-color="#D9D9D9"/>
                                                        <stop offset="0.884864" stop-color="#D9D9D9" stop-opacity="0.612014"/>
                                                        <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                                        </linearGradient>
                                                        <linearGradient id="paint1_linear_79_5281" x1="0.996308" y1="86.1153" x2="877" y2="79.4312" gradientUnits="userSpaceOnUse">
                                                        <stop offset="0.00725166" stop-color="#D9D9D9" stop-opacity="0"/>
                                                        <stop offset="0.151042" stop-color="#D9D9D9"/>
                                                        <stop offset="0.884864" stop-color="#D9D9D9" stop-opacity="0.612014"/>
                                                        <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"/>
                                                        </linearGradient>
                                                        </defs>
                                                        </svg>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                }?>
            </div>
        </div>
    </div>
</section>
<script>
    $(".tab-top-wrap .tab-item:eq(0)").addClass('active')
    $(".tab-content-wrap .tab-content:eq(0)").fadeIn()
$(".tab-top-wrap .tab-item").click(function(){
    var appear = $(this).data("tabs")
    if($(this).hasClass('active')){

    }else{
        $(".tab-top-wrap .tab-item").removeClass('active');
        $(this).addClass('active');
        $(".tab-content-wrap .tab-content").fadeOut()
        $(".tab-content-wrap .tab-content.tab-"+appear).fadeIn()
    }
});


</script>