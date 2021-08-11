<div class="loloBreadcrumbs container">
    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/breadcrumb_home_ico.svg'; ?>"/></a>
    <a href="<?php echo home_url('/blog') ?>"><?php _e('Blog', 'lolobaby'); ?></a>
    <span>/</span>
    <a><?php the_title(); ?></a>
</div>