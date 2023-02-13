<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<div class="slide">
    <div class="align"style ="background-image:url(<?php echo $block['bg']['url']?>);">
        <?php foreach($block['slides'] as $slide){ ?>
            <div class="card" >
                <div class="image-container">
                <img class="large" src="<?php echo $slide['large_image']['url']?>">
                </div>
            </div>
        <?php }?>
    </div>
</div>        
<script>
    $('.slide .align').slick({
  centerMode: true,
  centerPadding: '10px',
  slidesToShow: 3,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 2
      }
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});
</script>