<?php

/**
 * Sovendus Voucher App Module for PrestaShop
 *
 * @author    Sovendus GmbH
 * @copyright 2025 Sovendus GmbH
 * @license   GPL-3.0
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

// Include required files
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/config/settings.php';
require_once __DIR__ . '/hooks/hooks.php';
require_once __DIR__ . '/helpers/utils.php';

/**
 * Main module class
 */
class Ps_Sovendus extends Module
{
    /**
     * Module constructor
     */
    public function __construct()
    {
        $this->name = 'ps_sovendus';
        $this->author = 'Sovendus - Marcus Brandstätter';
        $this->version = SOVENDUS_VERSION;
        $this->tab = 'front_office_features';
        $this->need_instance = 0;

        $this->ps_versions_compliancy = [
            'min' => '1.7.0.0',
            'max' => _PS_VERSION_,
        ];

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Sovendus App');
        $this->description = $this->l('Official Sovendus module for Prestashop');
    }

    /**
     * Install the module
     *
     * @return bool Success status
     */
    public function install()
    {
        // Register hooks for PrestaShop 1.7+ and 8.2.1
        $result = parent::install();

        // Footer hooks
        $result &= $this->registerHook('displayFooterAfter');

        // Order confirmation hooks
        $result &= $this->registerHook('displayOrderConfirmation');

        // Admin hooks
        $result &= $this->registerHook('actionAdminControllerSetMedia');
        $result &= $this->registerHook('displayAdminAfterHeader'); // For PrestaShop 8.2.1

        // Create empty settings
        Configuration::updateValue(SOVENDUS_SETTINGS, '{}');

        return $result;
    }

    /**
     * Uninstall the module
     *
     * @return bool Success status
     */
    public function uninstall()
    {
        return parent::uninstall();
    }

    /**
     * Hook for displaying content after order confirmation
     *
     * This hook is used to display the Sovendus thank you page integration
     * after an order is confirmed. It works with PrestaShop 1.7+ and 8.2.1.
     *
     * @param array $params Hook parameters
     * @return string HTML content
     */
    public function hookDisplayOrderConfirmation(array $params)
    {
        return sovendus_hook_display_order_confirmation($this, $params);
    }

    /**
     * Hook for displaying content in the footer
     *
     * This hook is used to display the Sovendus page integration in the footer.
     * It works with PrestaShop 1.7+ and 8.2.1.
     *
     * @param array $params Hook parameters
     * @return string HTML content
     */
    public function hookDisplayFooterAfter(array $params = [])
    {
        return sovendus_hook_display_footer_after($this, $params);
    }

    /**
     * Hook for loading admin assets
     *
     * This hook is used to load the admin JavaScript files for the module
     * configuration page. It works with PrestaShop 1.7+.
     *
     * @param array $params Hook parameters
     */
    public function hookActionAdminControllerSetMedia($params)
    {
        sovendus_hook_action_admin_controller_set_media($this, $params);
    }

    /**
     * Hook for loading admin assets in newer PrestaShop versions
     *
     * This hook is used to load the admin JavaScript files for the module
     * configuration page. It's specifically for PrestaShop 8.2.1 and above.
     *
     * @param array $params Hook parameters
     * @return string HTML content
     */
    public function hookDisplayAdminAfterHeader($params)
    {
        return sovendus_hook_display_admin_after_header($this, $params);
    }

    /**
     * Module configuration page content
     *
     * @return string HTML content
     */
    public function getContent()
    {
        return sovendus_get_content($this);
    }

    /**
     * Get the module context
     *
     * @return Context The module context
     */
    public function getContext()
    {
        return $this->context;
    }
}
