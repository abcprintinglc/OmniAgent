<?php

namespace OmniPrint\Agents\Core;

if (!defined('ABSPATH')) {
    exit;
}

class Roles
{
    public function register(): void
    {
        add_action('init', [__CLASS__, 'add_roles']);
    }

    public static function add_roles(): void
    {
        add_role('omniprint_artist', 'OmniPrint Artist/Designer', self::base_caps());
        add_role('omniprint_org_employee', 'OmniPrint Organization Employee', self::base_caps());
        add_role('omniprint_org_admin', 'OmniPrint Organization Admin', array_merge(self::base_caps(), [
            'omniprint_approve_orders' => true,
            'omniprint_manage_org' => true,
        ]));
        add_role('omniprint_print_admin', 'OmniPrint Print Shop Admin', array_merge(self::base_caps(), [
            'omniprint_manage_orders' => true,
            'omniprint_manage_products' => true,
            'omniprint_manage_pricing' => true,
            'omniprint_review_preflight' => true,
        ]));

        $admin = get_role('administrator');
        if ($admin) {
            foreach (self::admin_caps() as $cap => $grant) {
                $admin->add_cap($cap, $grant);
            }
        }
    }

    protected static function base_caps(): array
    {
        return [
            'read' => true,
            'upload_files' => true,
            'omniprint_place_orders' => true,
        ];
    }

    protected static function admin_caps(): array
    {
        return [
            'omniprint_place_orders' => true,
            'omniprint_approve_orders' => true,
            'omniprint_manage_org' => true,
            'omniprint_manage_orders' => true,
            'omniprint_manage_products' => true,
            'omniprint_manage_pricing' => true,
            'omniprint_review_preflight' => true,
            'omniprint_manage_integrations' => true,
            'omniprint_manage_settings' => true,
            'omniprint_view_dashboard' => true,
        ];
    }
}
