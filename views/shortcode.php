<?php
    if(!isset($atts['id'])){
        echo "NO HAS SELECCIONADO NINGUN SLIDER";
        exit;
    }
    function valuebool($i){
        if($i==1){
            return "true";
        }else{
            return "false";
        }
    }
    $slider = $this->panelAdmin->get_slider_id($atts['id']);
?>
<div class="container">
    <?php $cont = 0; foreach($this->panelAdmin->get_images_slider($atts['id']) as $image): ?>
        <?php if($cont==0): $cont+=1;?>
            <div id="<?php echo 'title'.$image->id;?>" class="visibleyaws textyaws">
                <?php echo $image->name;?>
            </div>
        <?php else: ?>
            <div id="<?php echo 'title'.$image->id;?>" class="hiddenyaws textyaws">
                <?php echo $image->name; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div  id="owl-demo" class="owl-carousel owl-theme">
      <?php foreach($this->panelAdmin->get_images_slider($atts['id']) as $image): ?>
        <div class="item" id="<?php echo $image->id; ?>" style="overflow:hidden; background-image: url(<?php echo $image->url; ?>); background-repeat: no-repeat; 	background-size:250px 250px;">
        </div>
    <?php endforeach; ?>
  </div>
    <?php $cont=0; foreach($this->panelAdmin->get_images_slider($atts['id']) as $image): ?>
        <?php if($cont==0): $cont+=1?>
            <div id="<?php echo 'description'.$image->id;?>" class="hiddenyaws textyaws">
                <?php echo $image->description; ?>
            </div>
        <?php else: ?>
            <div id="<?php echo 'description'.$image->id;?>" class="hiddenyaws textyaws">
                <?php echo $image->description; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<style>
.textyaws{
    text-align: center;
    margin-right: 100px;
}
.owl-item:not(.center) > div {
    background: #42bdc2;
    padding: 30px 0px;
    margin: 5px;
    color: #FFF;
    width: <?php echo $slider[0]->width;?>px;
    height: <?php echo $slider[0]->height;?>px;
    transform: scale(0.5,0.5);
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    text-align: center;
}
.owl-item.center > div {
    background: #42bdc2;
    padding: 30px 0px;
    margin: 5px;
    color: #FFF;
    -webkit-border-radius: 0%;
    -moz-border-radius: 0%;
    border-radius: 0%;
    width: 250px;
    height: 250px;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    text-align: center;
}
.hiddenyaws {
    display: none;
}
.visibleyaws {
    display: block;
}


</style>
<script>
$(document).ready(function(){
    var owl = $('.owl-carousel');
    var cont=0;
    owl.on('changed.owl.carousel',function(property){
        if(cont!=0) {
            var current = property.item.index;
            var id = $(property.target).find(".owl-item").eq(current).find("div").prop('id');
            var title = '#title' + id;
            var description = '#description' + id;
            $('.visibleyaws').addClass('hiddenyaws').removeClass('visibleyaws');
            $(title).removeClass('hiddenyaws').addClass('visibleyaws');
            $(description).removeClass('hiddenyaws').addClass('visibleyaws');
        }else{
            cont++;
        }
    });
    owl.owlCarousel({
        dots:false,
        loop: <?php echo valuebool($slider[0]->loopsliders);?>,
        autoplay: <?php echo valuebool($slider[0]->autoplay); ?>,
        autoplayTimeout:<?php echo $slider[0]->slidespeed; ?>,
        autoplayHoverPause:true,
        center:true,
        responsiveClass:true,
        responsive : {
            0: {
                items: <?php echo $slider[0]->items_small;?>,
                nav: <?php echo valuebool($slider[0]->nav_small); ?>,
            },
            600:{
                items: <?php echo $slider[0]->items_medium;?>,
                nav:<?php echo valuebool($slider[0]->nav_medium); ?>,
            },
            1000:{
                items: <?php echo $slider[0]->items_long;?>,
                nav: <?php echo valuebool($slider[0]->nav_long); ?>,
            }
        }
    })
});
</script>
