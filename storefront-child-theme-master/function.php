<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */






add_action( 'woocommerce_single_product_summary', 'wc_ninja_add_brand_to_product_page', 19 );
function wc_ninja_add_brand_to_product_page() {
    echo do_shortcode('[product_brand width="64px" height="64px" class="alignright"]');
}

/**
 * @snippet       Edit WooCommerce Product Loop Items Display
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=26658
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.0.4
 */

// -------------------------
// 1. Change number of products per row to 1
// Note: this is specific to Storefront theme
// See https://docs.woocommerce.com/document/change-number-of-products-per-row/

add_filter('storefront_loop_columns', 'loop_columns');

function loop_columns() {
return 1;
}

// -------------------------
// 2. Remove default image, price, rating, add to cart

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// -------------------------
// 3. Remove sale flash (Storefront)

add_action( 'init', 'bbloomer_hide_storefront_sale_flash' );

function bbloomer_hide_storefront_sale_flash() {
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 6 );
}

add_action( 'woocommerce_before_shop_loop', 'bbloomer_loop_product_div_flex_open2' );
function bbloomer_loop_product_div_flex_open2() {
echo "aduh";
}
// -------------------------
// 4. Add <div> before product title

add_action( 'woocommerce_before_shop_loop_item', 'bbloomer_loop_product_div_flex_open', 8 );
function bbloomer_loop_product_div_flex_open() {
echo '<div class="product_table">';
}

// -------------------------
// 5. Wrap product title into a <div> with class "one_third"

add_action( 'woocommerce_before_shop_loop_item', 'bbloomer_loop_product_div_wrap_open', 9 );
function bbloomer_loop_product_div_wrap_open() {
echo '<div class="one_third">';
}

add_action( 'woocommerce_after_shop_loop_item', 'bbloomer_loop_product_div_wrap_close', 6 );
function bbloomer_loop_product_div_wrap_close() {
echo '</div>';
}

// -------------------------
// 6. Re-add and Wrap price into a <div> with class "one_third"

add_action( 'woocommerce_after_shop_loop_item', 'bbloomer_loop_product_div_wrap_open', 7 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 8 );
add_action( 'woocommerce_after_shop_loop_item', 'bbloomer_loop_product_div_wrap_close', 9 );

// -------------------------
// 7. Re-add and Wrap add to cart into a <div> with class "one_third"

add_action( 'woocommerce_after_shop_loop_item', 'bbloomer_loop_product_div_wrap_open', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 11 );


add_action( 'woocommerce_after_shop_loop_item', 'bbloomer_loop_product_div_wrap_close', 12 );

// -------------------------
// 8. Close <div> at the end of product title, price, add to cart divs

add_action( 'woocommerce_after_shop_loop_item', 'bbloomer_loop_product_div_flex_close', 13 );
function bbloomer_loop_product_div_flex_close() {
echo '</div>';
}



// Bismillahirahmanirahim

// -------------------------
// ---------apip-------------
// -------------------------

//function untuk menambah spesifikasi khusus amp
function tambah_spesifikasi_amp() {
  global $product;

  $sku = $product->get_sku();//ok
  $panjang = $product->get_length();//ok
  $weight = $product->get_weight();//ok
  $width = $product->get_width();//ok
  $height = $product->get_height();//ok
  $stock_status= $product->get_stock_status();//ok
  $price = $product->get_price();//ok
  $short_description = $product->get_short_description();//ok
  $name = $product->get_name();//ok

  $categories = $product->get_categories();//ok
  $category = $product->get_category_ids();
  $tag = $product->get_tag_ids();

  $cetak = '<table class=tablecss asu>';
  $cetak = $cetak.'<tbody>';

  if ($name != null && $name != '' && $name != ' ') {
    $cetak = $cetak.'<tr class=trclass>';
    $cetak = $cetak.'<th class=thtable>Nama</th>';
    $cetak = $cetak.'<td class=tdtable>'.$name.'</td>';
    $cetak = $cetak.'</tr>';
  }

  if ($price != null && $price != '' && $price != ' ') {
    $cetak = $cetak.'<tr class=trclass>';
    $cetak = $cetak.'<th class=thtable>Harga</th>';
    $cetak = $cetak.'<td class=tdtable>Rp '.$price.'</td>';
    $cetak = $cetak.'</tr>';
  }

  if ($sku != null && $sku != '' && $sku != ' ') {
    $cetak = $cetak.'<tr class=trclass>';
    $cetak = $cetak.'<th class=thtable>SKU</th>';
    $cetak = $cetak.'<td class=tdtable>'.$sku.'</td>';
    $cetak = $cetak.'</tr>';
  }

  if ($panjang != null && $panjang != '' && $panjang != ' ') {
    $cetak = $cetak.'<tr class=trclass>';
    $cetak = $cetak.'<th class=thtable>Panjang</th>';
    $cetak = $cetak.'<td class=tdtable>'.$panjang.'</td>';
    $cetak = $cetak.'</tr>';
  }

  if ($weight != null && $weight != '' && $weight != ' ') {
    $cetak = $cetak.'<tr class=trclass>';
    $cetak = $cetak.'<th class=thtable>Berat</th>';
    $cetak = $cetak.'<td class=tdtable>'.$weight.'</td>';
    $cetak = $cetak.'</tr>';
  }

  if ($width != null && $width != '' && $width != ' ') {
    $cetak = $cetak.'<tr class=trclass>';
    $cetak = $cetak.'<th class=thtable>Width</th>';
    $cetak = $cetak.'<td class=tdtable>'.$width.' mm</td>';
    $cetak = $cetak.'</tr>';
  }

  if ($height != null && $height != '' && $height != ' ') {
    $cetak = $cetak.'<tr class=trclass>';
    $cetak = $cetak.'<th class=thtable>Height</th>';
    $cetak = $cetak.'<td class=tdtable>'.$height.' mm</td>';
    $cetak = $cetak.'</tr>';
  }

  if ($categories != null && $categories != '' && $categories != ' ') {
    $cetak = $cetak.'<tr class=trclass>';
    $cetak = $cetak.'<th class=thtable>Category</th>';
    $cetak = $cetak.'<td class=tdtable>'.$categories.'</td>';
    $cetak = $cetak.'</tr>';
  }

  if ($stock_status != null && $stock_status != '' && $stock_status != ' ') {
    $cetak = $cetak.'<tr class=trclass>';
    $cetak = $cetak.'<th class=thtable>Stock</th>';
    $cetak = $cetak.'<td class=tdtable>'.$stock_status.'</td>';
    $cetak = $cetak.'</tr>';
  }

  $cetak = $cetak.'</tbody>';
  $cetak = $cetak.'</table>';

  echo $cetak;

  if ($short_description != null && $short_description != '' && $short_description != ' ') {
    $cetak = '<div style="padding-left: 20px;">';
    $cetak = $cetak.'<h3 style="margin-bottom: 0px;margin-left: -20px;">Short Description</h3>';
    $cetak = $cetak.$short_description;
    $cetak = $cetak.'</div>';
    echo $cetak;
  }

}
add_shortcode( 'apip_amp', 'tambah_spesifikasi_amp' );



// -------------------------
// ---------ayi-------------
// -------------------------

//function untuk menambah spesifikasi
function tambah_spesifikasi() {
  global $product;

  $sku = $product->get_sku();
  $panjang = $product->get_length();
  $weight = $product->get_weight();
  $width = $product->get_width();
  $height = $product->get_height();
  $dimension = $product->get_dimensions();

  $categories = $product->get_categories();
  $category = $product->get_category_ids();
  $tag = $product->get_tag_ids();

  $cetak = '<table class=tablecss>';
  $cetak = $cetak.'<tbody>';

  $cetak = $cetak.'<tr class=trclass>';
  $cetak = $cetak.'<th class=thtable>SKU</th>';
  $cetak = $cetak.'<td class=tdtable>'.$sku.'</td>';
  $cetak = $cetak.'</tr>';

  $cetak = $cetak.'<tr class=trclass>';
  $cetak = $cetak.'<th class=thtable>Category</th>';
  $cetak = $cetak.'<td class=tdtable>'.$categories.'</td>';
  $cetak = $cetak.'</tr>';

  $cetak = $cetak.'<tr class=trclass>';
  $cetak = $cetak.'<th class=thtable>Width</th>';
  $cetak = $cetak.'<td class=tdtable>'.$width.' mm</td>';
  $cetak = $cetak.'</tr>';

  $cetak = $cetak.'<tr class=trclass>';
  $cetak = $cetak.'<th class=thtable>Height</th>';
  $cetak = $cetak.'<td class=tdtable>'.$height.' mm</td>';
  $cetak = $cetak.'</tr>';

  $cetak = $cetak.'</tbody>';
  $cetak = $cetak.'</table>';

  echo $cetak;

  echo do_shortcode("[product_additional_information]");

}
add_shortcode( 'ayi', 'tambah_spesifikasi' );



add_action( 'init', 'marce_remove_storefront_header_search' );
function marce_remove_storefront_header_search() {
    remove_action( 'storefront_header', 'storefront_product_search',    40 );
}



add_filter( 'storefront_handheld_footer_bar_links', 'jk_remove_handheld_footer_links' );

function myshortcode_title( ){
   return get_the_title();
}
add_shortcode( 'page_title', 'myshortcode_title' );

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
/**
* Get the product thumbnail, or the placeholder if not set.
*
* @subpackage Loop
* @param string $size (default: 'shop_catalog')
* @param int $deprecated1 Deprecated since WooCommerce 2.0 (default: 0)
* @param int $deprecated2 Deprecated since WooCommerce 2.0 (default: 0)
* @return string
*/
function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0 ) {
global $post;
if ( has_post_thumbnail() ) {
return '<a href="' . get_permalink( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, $size ) . '</a>';
} elseif ( wc_placeholder_img_src() ) {
return wc_placeholder_img( $size );
}
}
}



if ( ! function_exists( 'display_product_additional_information' ) ) {

    function display_product_additional_information($atts) {

        // Shortcode attribute (or argument)
        $atts = shortcode_atts( array(
            'id'    => ''
        ), $atts, 'product_additional_information' );

        // If the "id" argument is not defined, we try to get the post Id
        if ( ! ( ! empty($atts['id']) && $atts['id'] > 0 ) ) {
           $atts['id'] = get_the_id();
        }

        // We check that the "id" argument is a product id
        if ( get_post_type($atts['id']) === 'product' ) {
            $product = wc_get_product($atts['id']);
        }
        // If not we exit
        else {
            return;
        }

        ob_start(); // Start buffering

        do_action( 'woocommerce_product_additional_information', $product );

        return ob_get_clean(); // Return the buffered outpout
    }

    add_shortcode('product_additional_information', 'display_product_additional_information');

}


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

add_action( 'woocommerce_after_single_product_summary', 'bbloomer_wc_output_long_description', 10 );

function bbloomer_wc_output_long_description() {
echo do_shortcode("[ayi]");
?>
   <div class="woocommerce-tabs">

  <?php the_content(); ?>
   </div>
<?php

}



/********* DO NOT COPY THE PARTS ABOVE THIS LINE *********/
/* Remove Yoast SEO Add custom title or meta template variables
* ini testing uprek description di yoast
 */

// define the custom replacement callback
function get_myname() {
    global $product;

  $sku = $product->get_sku();
  $panjang = $product->get_length();
  $weight = $product->get_weight();
  $width = $product->get_width();
  $height = $product->get_height();
  $dimension = $product->get_dimensions();
  $price = $product->get_price();
 $result =  $sku . ' Dapatkan dengan Harga ' . $price;
  return $result;

}

// define the action for register yoast_variable replacments
function register_custom_yoast_variables() {
    wpseo_register_var_replacement( '%%myname%%', 'get_myname', 'advanced', 'some help text' );
}

// Add action
add_action('wpseo_register_extra_replacements', 'register_custom_yoast_variables');






add_action('woocommerce_after_shop_loop_item_title', 'display_custom_product_attributes_on_loop', 5 );
function display_custom_product_attributes_on_loop() {
    global $product;

    // Settings: Here below set your product attribute label names
    $attributes_names = array('Size', 'Tebal', 'Bahan');

    $attributes_data  = array(); // Initializing

    // Loop through product attribute settings array
    foreach ( $attributes_names as $attribute_name ) {
        if ( $value = $product->get_attribute($attribute_name) ) {
            $attributes_data[] = $attribute_name . ': ' . $value;
        }
    }

    if ( ! empty($attributes_data) ) {
        echo '<div class="items" style="color: red;"><p>' . implode( '<br>', $attributes_data ) . '</p></div>';
    }
}
