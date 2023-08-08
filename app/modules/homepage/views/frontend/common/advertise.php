<section class="aside-maps aside-panel">
    <header class="panel-head">
        <div class="heading">
            <span>Bản đồ</span>
        </div>
    </header>
    <section class="panel-body">
        <?php echo $this->fcSystem['contact_map'] ?>
    </section>
</section>
<section class="aside-facebook aside-panel">
    <header class="panel-head">
        <div class="heading">
            <span>Fanpage Facebook</span>
        </div>
    </header>
    <section class="panel-body">
        <div class="fb-page" data-href="<?php echo $this->fcSystem['social_facebook'] ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?php echo $this->fcSystem['social_facebook'] ?>" class="fb-xfbml-parse-ignore"><a href="<?php echo $this->fcSystem['social_facebook'] ?>">Facebook</a></blockquote></div>
    </section>
</section>
<!-- Quản cáo -->
<?php $advhome = $this->FrontendSlides_Model->Read('adversite-1', $this->fc_lang); ?>
<?php if(isset($advhome) && is_array($advhome) && count($advhome)){ ?>
    <?php foreach($advhome as $key => $val){ ?>
        <div class="banner mb10">
            <a href="<?php echo $val['url']; ?>" title="<?php echo $val['title']; ?>" class="img-cover">
            	<img src="<?php echo $val['image']; ?>" alt="<?php echo $val['title']; ?>" />
            </a>
        </div>
    <?php } ?>
<?php } ?>
<!-- END Quảng cáo -->
