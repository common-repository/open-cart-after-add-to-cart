<?php
/*
    Plugin Name:       Open Cart After Add to Cart
    Description:       This light plugin allows you automatically open the mini-cart when a product added to the cart.
    Version:           1.0.0
    Author:            Ido Navarro
    Requires at least: 5.0
    Author URI:        https://wpnavarro.com/
    License:           GPL-2.0+ 
    License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
    Text Domain:       open-cart-after-add-to-cart
    Domain Path:       /languages/
    WC tested up to: 4.9
 */




// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'OCAATC_URL', plugins_url( '/', __FILE__ ) );

/**
 * Currently plugin version.
 */

define( 'OPEN_CART_AFTER_ADD_TO_CART_VERSION', '1.0.0' );

/**
 * Check if Elementor is active
 */

if (!in_array( 'elementor/elementor.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && !array_key_exists( 'elementor/elementor.php', apply_filters( 'active_plugins', get_site_option( 'active_sitewide_plugins', array() ) ) ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    function ocaatc_admin_notice()
    {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php echo '<strong>Pay attention:</strong> Elementor plugin not activated, It should required for Open Cart After Add to Cart.'; ?></p>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'ocaatc_admin_notice' );
}

/**
 * Enqueue the plugin's styles.
 */

function ocaatc_mini_cart_handler() {
    ?>
    <script type="text/javascript">
        (function($){
            $('body').on( 'added_to_cart', function(e, fragments, cart_hash, this_button){
                $(".elementor-menu-cart__container").addClass("elementor-menu-cart--shown");
            });
        })(jQuery);
    </script>
    <?php
}
add_action( 'wp_footer', 'ocaatc_mini_cart_handler' );


