<?php

namespace OmniPrint\Agents\Core;

if (!defined('ABSPATH')) {
    exit;
}

class Database
{
    public static function migrate(): void
    {
        global $wpdb;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $charsetCollate = $wpdb->get_charset_collate();
        $prefix = $wpdb->prefix . 'omni_';

        $sql = [];

        $sql[] = "CREATE TABLE {$prefix}products (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            slug VARCHAR(191) NOT NULL,
            name VARCHAR(191) NOT NULL,
            description LONGTEXT NULL,
            active TINYINT(1) NOT NULL DEFAULT 1,
            default_width DECIMAL(10,3) NULL,
            default_height DECIMAL(10,3) NULL,
            default_bleed DECIMAL(10,3) NULL,
            default_safe_margin DECIMAL(10,3) NULL,
            default_orientation VARCHAR(50) NULL,
            product_type VARCHAR(100) NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            PRIMARY KEY (id),
            UNIQUE KEY slug (slug)
        ) {$charsetCollate};";

        $sql[] = "CREATE TABLE {$prefix}organizations (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(191) NOT NULL,
            billing_email VARCHAR(191) NULL,
            approval_email VARCHAR(191) NULL,
            pricing_tier VARCHAR(100) NULL,
            tax_exempt TINYINT(1) NOT NULL DEFAULT 0,
            preapproved_amount_limit DECIMAL(10,2) NULL,
            active TINYINT(1) NOT NULL DEFAULT 1,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            PRIMARY KEY (id)
        ) {$charsetCollate};";

        $sql[] = "CREATE TABLE {$prefix}orders (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            order_number VARCHAR(50) NOT NULL,
            customer_user_id BIGINT UNSIGNED NULL,
            organization_id BIGINT UNSIGNED NULL,
            customer_type VARCHAR(50) NOT NULL,
            status VARCHAR(50) NOT NULL,
            approval_status VARCHAR(50) NULL,
            preflight_status VARCHAR(50) NULL,
            production_status VARCHAR(50) NULL,
            invoice_status VARCHAR(50) NULL,
            subtotal DECIMAL(10,2) NOT NULL DEFAULT 0,
            discount_total DECIMAL(10,2) NOT NULL DEFAULT 0,
            total DECIMAL(10,2) NOT NULL DEFAULT 0,
            notes LONGTEXT NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL,
            PRIMARY KEY (id),
            UNIQUE KEY order_number (order_number)
        ) {$charsetCollate};";

        $sql[] = "CREATE TABLE {$prefix}approvals (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            order_id BIGINT UNSIGNED NOT NULL,
            requested_by_user_id BIGINT UNSIGNED NULL,
            approver_user_id BIGINT UNSIGNED NULL,
            approver_email VARCHAR(191) NULL,
            approval_token VARCHAR(191) NULL,
            status VARCHAR(50) NOT NULL,
            request_notes LONGTEXT NULL,
            decision_notes LONGTEXT NULL,
            decided_at DATETIME NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY (id),
            KEY order_id (order_id)
        ) {$charsetCollate};";

        $sql[] = "CREATE TABLE {$prefix}pricing_rules (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            product_id BIGINT UNSIGNED NULL,
            organization_id BIGINT UNSIGNED NULL,
            customer_type VARCHAR(50) NULL,
            quantity_min INT NULL,
            quantity_max INT NULL,
            base_price DECIMAL(10,2) NOT NULL DEFAULT 0,
            discount_type VARCHAR(50) NOT NULL DEFAULT 'none',
            discount_value DECIMAL(10,2) NOT NULL DEFAULT 0,
            wholesale_only TINYINT(1) NOT NULL DEFAULT 0,
            requires_custom_quote TINYINT(1) NOT NULL DEFAULT 0,
            active TINYINT(1) NOT NULL DEFAULT 1,
            created_at DATETIME NOT NULL,
            PRIMARY KEY (id)
        ) {$charsetCollate};";

        foreach ($sql as $statement) {
            dbDelta($statement);
        }
    }
}
