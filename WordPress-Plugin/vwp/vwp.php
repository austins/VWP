<?php defined('ABSPATH') or exit();
/*
Plugin Name: VWP
*/

// Include Vanilla framework
require_once(dirname(__FILE__) . '/vanilla.php');

// If Vanilla isn't installed, then
if (!$isVanillaInstalled) {
    add_action('admin_notices', 'vpw_admin_notice_vanilla_path_incorrect');

    function vpw_admin_notice_vanilla_path_incorrect() {
        ?>
        <div class="error">
            <p><?php _e("The path to the Vanilla installation isn't set or incorrect.", 'vpw'); ?></p>
            <p><?php _e('VPW must be configured correctly via its settings page.', 'vpw'); ?></p>
        </div>
        <?php
    }
}

/*
 * Disable guest access to WordPress frontend
 */
add_action('get_header', 'disable_guest_access');

function disable_guest_access() {
    if (!is_user_logged_in()) {
        $currentUrl = isset($_SERVER['HTTPS']) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
        $currentUrl .= '://' . $_SERVER['HTTP_HOST'];
        $currentUrl .= in_array($_SERVER['SERVER_PORT'], array('80', '443')) ? '' : ':' . $_SERVER['SERVER_PORT'];
        $currentUrl .= $_SERVER['REQUEST_URI'];

        if (preg_replace('/\?.*/', '', $currentUrl) != preg_replace('/\?.*/', '', wp_login_url())) {
            wp_safe_redirect(wp_login_url(admin_url()), 302);
            exit();
        }
    }
}

/*
 * Add admin menu item and settings page
 */
add_action('admin_menu', 'add_settings_menu');

function add_settings_menu() {
    add_options_page('VWP', 'VWP', 'manage_options', 'vwp', 'vwp_settings_page');
}

function vwp_settings_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    // Variables for the field and option names
    $hiddenFieldName = 'vwp_submit_hidden';
    $optName = 'vwp_vanilla_path';
    $dataFieldName = $optName;

    // Read in existing option value from database
    $optVal = get_option($optName);

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if (isset($_POST[$hiddenFieldName]) && $_POST[$hiddenFieldName] == 'Y') {
        // Read their posted value
        $optVal = $_POST[$dataFieldName];

        // Save the posted value in the database
        update_option($optName, $optVal);

        // Put a "settings saved" message on the screen
        echo '<div class="updated"><p><strong>' . __('Settings Saved.', 'vwp') . '</strong></p></div>';
    }

    // Display settings form
    echo '<div class="wrap">';
    echo '<h1>' . __('VWP Plugin Settings', 'vwp') . '</h1>';
    ?>
    <form method="post" action="">
        <input type="hidden" name="<?php echo $hiddenFieldName; ?>" value="Y">

        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row"><label
                        for="vanillapath"><?php _e("Path to Vanilla Forums Installation", 'vwp'); ?></label></th>
                <td>
                    <?php echo $_SERVER['DOCUMENT_ROOT']; ?> <input type="text" name="<?php echo $dataFieldName; ?>"
                                                                    value="<?php echo $optVal; ?>" size="20">

                    <p class="description"><?php _e("Do enter an initial slash, but don't enter a trailing slash.", 'vwp'); ?></p>
                </td>
            </tr>
            </tbody>
        </table>

        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>"/>
        </p>
    </form>
    <?php
    echo '</div>';
}
