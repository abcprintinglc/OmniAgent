<?php

namespace OmniPrint\Agents\Core;

if (!defined('ABSPATH')) {
    exit;
}

class Assets
{
    public function register(): void
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
    }

    public function enqueue_admin_assets(): void
    {
        wp_register_style(
            'omniprint-agents-admin',
            OMNIPRINT_AGENTS_URL . 'assets/css/admin.css',
            [],
            OMNIPRINT_AGENTS_VERSION
        );

        wp_register_script(
            'omniprint-agents-admin',
            OMNIPRINT_AGENTS_URL . 'assets/js/admin.js',
            ['jquery'],
            OMNIPRINT_AGENTS_VERSION,
            true
        );

        wp_enqueue_style('omniprint-agents-admin');
        wp_enqueue_script('omniprint-agents-admin');
    }
}
