<?php

namespace OmniPrint\Agents\Core;

use OmniPrint\Agents\Admin\Admin_Menu;
use OmniPrint\Agents\Core\Roles;
use OmniPrint\Agents\Core\Assets;
use OmniPrint\Agents\Modules\Products\Products_Module;
use OmniPrint\Agents\Modules\Organizations\Organizations_Module;
use OmniPrint\Agents\Modules\Orders\Orders_Module;
use OmniPrint\Agents\Modules\Approvals\Approvals_Module;
use OmniPrint\Agents\Modules\Pricing\Pricing_Module;
use OmniPrint\Agents\Modules\Preflight\Preflight_Module;
use OmniPrint\Agents\Modules\AI\AI_Module;
use OmniPrint\Agents\Modules\Integrations\Integrations_Module;
use OmniPrint\Agents\Modules\Dashboard\Dashboard_Module;

if (!defined('ABSPATH')) {
    exit;
}

class Plugin
{
    protected array $modules = [];

    public function boot(): void
    {
        $this->modules = [
            new Roles(),
            new Assets(),
            new Admin_Menu(),
            new Products_Module(),
            new Organizations_Module(),
            new Orders_Module(),
            new Approvals_Module(),
            new Pricing_Module(),
            new Preflight_Module(),
            new AI_Module(),
            new Integrations_Module(),
            new Dashboard_Module(),
        ];

        foreach ($this->modules as $module) {
            if (method_exists($module, 'register')) {
                $module->register();
            }
        }
    }
}
