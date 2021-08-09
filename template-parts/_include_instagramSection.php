<?php
    $igPosts = get_field('homepage_instagram', 20);
    $counter = 0;    
    if($igPosts):
    shuffle($igPosts)
?>
<section class="homeInstagram">
    <?php if(!is_front_page()): ?>
        <div class="wave container">
            <img src="<?php echo get_template_directory_uri() . '/images/wave_thin.svg'; ?>">
        </div>
    <?php endif; ?>
    <div class="homeInstagram__heading">
        <?php if(is_front_page()): ?>
        <h2 class="homeSectionHeading"><span>odwiedź nas</span></h2>
        <?php else: ?>
        <h2 class="sectionHeading"><span>Odwiedź nas</span></h2>
        <?php endif; ?>
        <div class="hash">
            <a href="https://www.instagram.com/lolobaby_brand/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/icons/instagram_ico.svg'; ?>"/>lolobaby_brand</a>
            <a href="https://www.instagram.com/explore/tags/lolobaby/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/icons/hash_ico.svg'; ?>"/>lolobaby</a>
            <a href="https://www.instagram.com/explore/tags/pulltofly/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/icons/hash_ico.svg'; ?>"/>pulltofly</a>
        </div>
    </div>
    <div class="homeInstagram__wrap">
        <?php
            foreach($igPosts as $post):
            $image = $post['homepage_instagram_image'];
            $user = $post['homepage_instagram_user'];
            $counter++;

            if( $counter > 4 ){
                break;
            }
        ?>
        <div class="homeInstagram__box">
            <div class="thumb">
                <img src="<?php echo $image; ?>"/>
            </div>
            <p><img src="<?php echo get_template_directory_uri() . '/images/icons/instagram_ico_red.svg';?>"/><?php echo $user; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>