<?php
/**
 * Plugin Name:       WhatsApp Send Message Button for WordPress
 * Description:       Put a WhatsApp contact button in your site so visitors can message you in 2 minutes
 * Version:           1.0.0
 * Author:            Gabriel Adamante
 * Author URI:        https://www.adamante.com.br
 * Text Domain:       adamante
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/g-adamante/WhatsApp-Send-Message-Button-WordPress.git
 */
 
?>
<?php 

  function wpp_btn_register_settings() {
    add_option( 'wpp_btn_number', '');
    add_option( 'wpp_btn_msg', '');
    add_option( 'wpp_btn_animated');
    register_setting( 'wpp_btn_options_group', 'wpp_btn_number');
    register_setting( 'wpp_btn_options_group', 'wpp_btn_msg');
    register_setting( 'wpp_btn_options_group', 'wpp_btn_animated');
  }

  add_action( 'admin_init', 'wpp_btn_register_settings' );

?>
<?php
  
  function wpp_btn_register_options_page() {
    add_options_page('WhatsApp Contact Button Settings', 'WhatsApp Contact Button Settings', 'manage_options', 'wpp_btn', 'wpp_btn_options_page');
  }
  
  add_action('admin_menu', 'wpp_btn_register_options_page');

?>
<?php function wpp_btn_options_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  <h2>WhatsApp Contact Button Settings</h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'wpp_btn_options_group' ); ?>
  <h3>Configure your WhatsApp Button with your data</h3>
  <table>
  <tr valign="top">
  <th scope="row"><label for="wpp_btn_number">WhatsApp Number</label></th>
  <td><input type="tel" id="wpp_btn_number" name="wpp_btn_number" value="<?php echo get_option('wpp_btn_number'); ?>" /></td>
  <p>Only numbers. Don't forget the country code. Ex: 5541995266655
  </tr>
  <tr valign="top">
  <th scope="row"><label for="wpp_btn_msg">Message</label></th>
  <td><input type="tet" id="wpp_btn_msg" name="wpp_btn_msg" value="<?php echo get_option('wpp_btn_msg'); ?>" /></td>
  </tr>
  <tr valign="top">
  <th scope="row"><label for="wpp_btn_animated">Animated?</label></th>
  <td><input type="checkbox" id="wpp_btn_animated" name="wpp_btn_animated" value="1" <?php checked(get_option('wpp_btn_animated'), 1 ); ?> />
  </td>
  </tr>
  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
<?php
} 
?>
<?php 

function whatsapp_button() {

    if (get_option('wpp_btn_animated')){

      $wpp_btn_animated = "bounce-whatsapp-button";

    } else {

      $wpp_btn_animated = "dont-bounce-whatsapp-button";

    }

    echo "<div class='whatsapp-button-generator $wpp_btn_animated' id='whatsapp-button-div'>
    <a id='whatsapp-button-web' target='_blank' href='https://web.whatsapp.com/send?phone=".get_option('wpp_btn_number')."?text=".rawurlencode(get_option('wpp_btn_msg'))."'><img class='whatsapp-button-content whatsapp-button-web' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJIAAABzCAMAAABEvaubAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAViAAAFYgGsYVycAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAvpQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Oov7nAAAAP10Uk5TAAECAwQFBgcICQoL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'></a>
    <a id='whatsapp-button-mobile' target='_blank' href='https://wa.me/".get_option('wpp_btn_number')."?text=".rawurlencode(get_option('wpp_btn_msg'))."'><img class='whatsapp-button-content whatsapp-button-mobile' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJIAAABzCAMAAABEvaubAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAViAAAFYgGsYVycAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAvpQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Oov7nAAAAP10Uk5TAAECAwQFBgcICQoL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'></a></div>
    <style id='whatsapp-button-style'> .whatsapp-button-generator{position: fixed; border-radius: 8%; background-color: #31d831; bottom: 20px; right: 20px; width: 90px; height: 75px; z-index: 110}.whatsapp-button-content{padding-top: 7px; padding-left: 5px; height:70px;}.whatsapp-button-web{display: none}.whatsapp-button-mobile{display: inherit}@media (min-width: 48em){.whatsapp-button-web{display: inherit}.whatsapp-button-mobile{display: none}}.bounce-whatsapp-button{animation: bounce-whatsapp-button 2s infinite; -webkit-animation: bounce-whatsapp-button 2s infinite; -moz-animation: bounce-whatsapp-button 2s infinite; -o-animation: bounce-whatsapp-button 2s infinite}@-webkit-keyframes bounce-whatsapp-button{0%, 100%, 20%, 50%, 80%{-webkit-transform: translateY(0)}40%{-webkit-transform: translateY(-30px)}60%{-webkit-transform: translateY(-15px)}}@-moz-keyframes bounce-whatsapp-button{0%, 100%, 20%, 50%, 80%{-moz-transform: translateY(0)}40%{-moz-transform: translateY(-30px)}60%{-moz-transform: translateY(-15px)}}@-o-keyframes bounce-whatsapp-button{0%, 100%, 20%, 50%, 80%{-o-transform: translateY(0)}40%{-o-transform: translateY(-30px)}60%{-o-transform: translateY(-15px)}}@keyframes bounce-whatsapp-button{0%, 100%, 20%, 50%, 80%{transform: translateY(0)}40%{transform: translateY(-30px)}60%{transform: translateY(-15px)}}</style>";
    }
    add_action( 'wp_footer', 'whatsapp_button' );
?>