<?php

namespace OmniPrint\Agents\Core;

if (!defined('ABSPATH')) {
    exit;
}

class Statuses
{
    public const ORDER_DRAFT = 'draft';
    public const ORDER_SUBMITTED = 'submitted';
    public const ORDER_PENDING_APPROVAL = 'pending_approval';
    public const ORDER_APPROVED = 'approved';
    public const ORDER_REJECTED = 'rejected';
    public const ORDER_PREFLIGHT_REVIEW = 'preflight_review';
    public const ORDER_PREFLIGHT_FAILED = 'preflight_failed';
    public const ORDER_PRINT_READY = 'print_ready';
    public const ORDER_IN_PRODUCTION = 'in_production';
    public const ORDER_INVOICED = 'invoiced';
    public const ORDER_COMPLETED = 'completed';
    public const ORDER_CANCELLED = 'cancelled';
    public const ORDER_ON_HOLD = 'on_hold';

    public static function seed_defaults(): void
    {
        // Reserved for future option seeding.
    }
}
