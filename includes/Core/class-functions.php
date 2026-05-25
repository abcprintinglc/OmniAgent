<?php

if (!defined('ABSPATH')) {
    exit;
}

function omniprint_agents_array_get(array $data, string $key, $default = null)
{
    return array_key_exists($key, $data) ? $data[$key] : $default;
}
