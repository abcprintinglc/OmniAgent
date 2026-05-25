<?php
/**
 * Plugin Name: OmniPrint Agents
 * Plugin URI: https://abcprinting.example.com
 * Description: WordPress-based print ordering, approvals, pricing, preflight, invoicing, and workflow platform for ABC Printing.
 * Version: 0.1.0
 * Author: ABC Printing / OmniPrint Agents
 * Author URI: https://abcprinting.example.com
 * Text Domain: omniprint-agents
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

define('OMNIPRINT_AGENTS_VERSION', '0.1.0');
define('OMNIPRINT_AGENTS_FILE', __FILE__);
define('OMNIPRINT_AGENTS_PATH', plugin_dir_path(__FILE__));
define('OMNIPRINT_AGENTS_URL', plugin_dir_url(__FILE__));
define('OMNIPRINT_AGENTS_BASENAME', plugin_basename(__FILE__));

require_once OMNIPRINT_AGENTS_PATH . 'includes/Core/class-autoloader.php';
\OmniPrint\Agents\Core\Autoloader::register();

require_once OMNIPRINT_AGENTS_PATH . 'includes/Core/class-functions.php';

register_activation_hook(__FILE__, ['\\OmniPrint\\Agents\\Core\\Installer', 'activate']);
register_deactivation_hook(__FILE__, ['\\OmniPrint\\Agents\\Core\\Installer', 'deactivate']);

add_action('plugins_loaded', function () {
    load_plugin_textdomain('omniprint-agents', false, dirname(OMNIPRINT_AGENTS_BASENAME) . '/languages');

    $plugin = new \OmniPrint\Agents\Core\Plugin();
    $plugin->boot();
});
