<?php

namespace OmniPrint\Agents\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class Admin_Menu
{
    public function register(): void
    {
        add_action('admin_menu', [$this, 'register_menu']);
    }

    public function register_menu(): void
    {
        add_menu_page(
            __('OmniPrint Agents', 'omniprint-agents'),
            __('OmniPrint Agents', 'omniprint-agents'),
            'omniprint_view_dashboard',
            'omniprint-agents',
            [$this, 'render_dashboard'],
            'dashicons-art',
            56
        );

        $pages = [
            'Orders' => 'omniprint-orders',
            'Products' => 'omniprint-products',
            'Organizations' => 'omniprint-organizations',
            'Pricing Rules' => 'omniprint-pricing',
            'Preflight' => 'omniprint-preflight',
            'Integrations' => 'omniprint-integrations',
            'Visual Office' => 'omniprint-visual-office',
            'Settings' => 'omniprint-settings',
        ];

        foreach ($pages as $label => $slug) {
            add_submenu_page(
                'omniprint-agents',
                __($label, 'omniprint-agents'),
                __($label, 'omniprint-agents'),
                'omniprint_view_dashboard',
                $slug,
                [$this, 'render_placeholder']
            );
        }
    }

    public function render_dashboard(): void
    {
        echo '<div class="wrap omniprint-admin"><h1>OmniPrint Agents</h1><p>Welcome to the OmniPrint Agents dashboard scaffold.</p></div>';
    }

    public function render_placeholder(): void
    {
        echo '<div class="wrap omniprint-admin"><h1>OmniPrint Agents</h1><p>This section is scaffolded and ready for implementation.</p></div>';
    }
}
