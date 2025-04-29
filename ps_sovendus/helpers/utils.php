<?php

/**
 * Sovendus for PrestaShop
 *
 * @author    Sovendus GmbH
 * @copyright 2025 Sovendus GmbH
 * @license   GPL-3.0
 */

if (!defined('_PS_VERSION_')) {
    exit;
}


/**
 * Get Sovendus configuration
 *
 * @return array Configuration array
 */
function sovendus_get_config()
{
    $settingsJson = Configuration::get(SOVENDUS_SETTINGS);

    // Try to decode JSON if it's a string
    if (is_string($settingsJson) && !empty($settingsJson)) {
        $settings = json_decode($settingsJson, true);
        if (is_array($settings)) {
            return $settings;
        }
    }

    // Default empty array if nothing is found
    return [];
}

/**
 * Set Sovendus configuration
 *
 * @param array $settings The settings to save
 * @return bool Success status
 */
function sovendus_set_config($settings)
{
    $settingsJson = json_encode($settings);
    return Configuration::updateValue(SOVENDUS_SETTINGS, $settingsJson);
}
