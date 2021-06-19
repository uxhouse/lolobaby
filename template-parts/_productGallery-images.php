<?php
    $attachment_ids = $product->get_gallery_image_ids();
    $thisVariations = $product->get_available_variations();

    foreach( $attachment_ids as $attachment_id ):
    $image_link = wp_get_attachment_url($attachment_id); ?>
    <div class="galleryImage">
        <div class="galleryImage__wrap">
            <img src="<?php echo $image_link; ?>"/> 
        </div>    
    </div>
<?php endforeach; ?>
<?php
    foreach ( $thisVariations as $thisVariation ){
        $variationsID[] = $thisVariation['variation_id'];
    }
    foreach ($variationsID as $variationID){
        $variation = new WC_Product_Variation( $variationID );
        $image_tag = $variation->get_image('full');
        $image_slug['variation_attributes'] = $variation->get_attributes();
        $image_id['image_id'] = $variation->get_image_id();
        $varsID['variation_id'] = $variationID;
        $variationsData[] = array_merge($image_id, $varsID, $image_slug);
    }
    foreach ($variationsData as $k => $v) {
        foreach ($variationsData as $key => $value) {
            if ($k != $key && $v['image_id'] == $value['image_id']) {
                unset($variationsData[$k]);
            }
        }
    }

    foreach ($variationsData as $variationData): ?>
        <div class="galleryImage" data-id="<?php echo $variationData['variation_id']; ?>" data-name="<?php echo $variationData['variation_attributes']['pa_kolor'] ?>">
            <div class="galleryImage__wrap">
                <?php echo wp_get_attachment_image($variationData['image_id'], 'full'); ?>
            </div> 
        </div>
    <?php endforeach; ?>