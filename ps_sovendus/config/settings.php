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
 * Module configuration page content
 *
 * @param Ps_Sovendus $module The module instance
 * @return string HTML content
 */
function sovendus_get_content($module)
{
    // Handle AJAX save
    if (Tools::isSubmit('ajax') && Tools::getValue('action') === 'saveSettings') {
        sovendus_process_ajax_save();
        exit; // The function will handle the response
    }

    // Get current settings
    $settings = sovendus_get_config();

    // Generate a nonce for security
    $nonce = md5(uniqid(rand(), true));

    // Get context using a public method
    $context = $module->getContext();

    // Get base URL
    $baseUrl = _PS_BASE_URL_ . __PS_BASE_URI__;

    // Get admin link
    $adminLink = $context->link->getAdminLink('AdminModules')
        . '&configure=' . $module->name
        . '&module_name=' . $module->name;

    // Assign settings to Smarty and JavaScript
    $context->smarty->assign([
        'configValues' => $settings,
        'saveUrl' => $adminLink,
        'nonce' => $nonce,
        'baseUrl' => $baseUrl,
        'sovendusSettings' => [
            'settings' => $settings,
            'ajaxurl' => $adminLink,
            'nonce' => $nonce
        ]
    ]);

    // Render the custom settings template
    return $module->display($module->getLocalPath(), 'views/templates/admin/settings.tpl');
}

/**
 * Process AJAX settings save
 */
function sovendus_process_ajax_save()
{
    // Set content type for all responses
    header('Content-Type: application/json');

    try {
        // Check if settings are provided as JSON
        if (Tools::getIsset('settings')) {
            $settingsJson = Tools::getValue('settings');
            $settings = json_decode($settingsJson, true);

            // Simple validation to ensure it's an array
            if (!is_array($settings)) {
                $settings = [];
            }

            // Save settings
            $result = Configuration::updateValue(SOVENDUS_SETTINGS, json_encode($settings));

            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode([
                    'success' => false,
                    'error' => 'Failed to save settings'
                ]);
            }
        } else {
            // Handle error if settings are not provided
            echo json_encode([
                'success' => false,
                'error' => 'Settings not provided'
            ]);
        }
    } catch (Exception $e) {
        // Return error response
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    exit;
}
