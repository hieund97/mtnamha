<?php $slide = $this->FrontendSlides_Model->Read('index-slide',$this->fc_lang); ?>
<?php if(isset($slide) && is_array($slide) && count($slide)){ ?> 
<div class="main-slider">
    <div class="slider-large owl-carousel">
        <?php foreach ($slide as $key => $val) { ?>
        <div class="item" data-hash="one<?php echo $key ?>">
            <a href="<?php echo $val['url'] ?>"> <img class="owl-lazy" data-src="<?php echo $val['image'] ?>" alt="<?php echo $val['title'] ?>">
            </a>
        </div>
        <?php } ?>
    </div>
    <div class="slider-small owl-carousel" style="display: none">
        <?php foreach ($slide as $key => $val) { ?>
        <a href="#one<?php echo $key ?>"> <span class="transforn"></span> <?php echo $val['title'] ?> </a>
        <?php } ?>
    </div>
</div>
<?php } ?>
<style type="text/css">
    .slider-small .owl-item:nth-of-type(odd) > a{
        background: -webkit-radial-gradient(center center, circle farthest-side, #5f5a5a 14%, #000 100%);
    }
    .slider-small .owl-item:nth-of-type(even) > a{
        background: -webkit-radial-gradient(center center, circle farthest-side, #f2e386 14%, #ccb05e 100%);
        color: black;
    }
    /* .slider-small .owl-item:nth-child(5n+3) > a{
        background: -webkit-radial-gradient(center center, circle farthest-side, #5f5a5a 14%, #000 100%);
    }
    .slider-small .owl-item:nth-child(5n+4) > a{
        background: -webkit-radial-gradient(center center, circle farthest-side, #f2e386 14%, #ccb05e 100%);
    }
    .slider-small .owl-item:nth-child(5n+5) > a{
        background: -webkit-radial-gradient(center center, circle farthest-side, #5f5a5a 14%, #000 100%);
    } */
</style>