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

require_once __DIR__ . '/../config/settings.php';
require_once __DIR__ . '/../helpers/utils.php';

/**
 * Hook for displaying content after order confirmation
 *
 * @param Ps_Sovendus $module The module instance
 * @param array $params Hook parameters
 * @return string HTML content
 */
function sovendus_hook_display_order_confirmation($module, array $params)
{
    // Get order data
    /** @var Order $order */
    $order = isset($params['objOrder']) ? $params['objOrder'] : $params['order'];
    $delivery_details = new Address((int)$order->id_address_delivery);
    $country = Country::getIsoById($delivery_details->id_country);
    $language = Language::getIsoById($order->id_lang);

    // Extract order details
    $orderData = sovendus_get_order_data($order);
    $customerData = sovendus_get_customer_data($order, $delivery_details, $country, $language);
    $couponCodes = sovendus_get_coupon_codes($order);

    // Create container div for Sovendus integration
    $containerHtml = '<div id="sovendus-integration-container"></div>';

    $jsConfig = [
        'settings' => sovendus_get_config(),
        "iframeContainerQuerySelector" => [
            "selector" => "#sovendus-integration-container",
            "where" => "none"
        ],
        'integrationType' => SOVENDUS_INTEGRATION_TYPE,
        'orderData' => array_merge($orderData, [
            'usedCouponCodes' => $couponCodes
        ]),
        'customerData' => $customerData
    ];

    $jsPath = $module->getPathUri() . 'views/js/thankyou-page.js';

    $directScriptTag = '<script type="text/javascript">
        window.sovThankyouConfig = ' . json_encode($jsConfig) . ';
    </script>';
    $directScriptTag .= '<script type="text/javascript" src="' . $jsPath . '"></script>';

    return $containerHtml . $directScriptTag;
}

/**
 * Get order data for Sovendus
 *
 * @param Order $order The order object
 * @return array Order data
 */
function sovendus_get_order_data($order)
{
    $orderNumber = $order->reference;
    $currency = (new Currency($order->id_currency))->iso_code;
    $grossValue = (float)$order->total_paid_tax_excl;
    $netShipping = (float)$order->total_shipping_tax_excl;
    $netValue = $grossValue - $netShipping;

    return [
        'orderId' => $orderNumber,
        'orderValue' => [
            'netOrderValue' => $netValue
        ],
        'orderCurrency' => $currency
    ];
}

/**
 * Get customer data for Sovendus
 *
 * @param Order $order The order object
 * @param Address $delivery_details The delivery address
 * @param string $country The country code
 * @param string $language The language code
 * @return array Customer data
 */
function sovendus_get_customer_data($order, $delivery_details, $country, $language)
{
    $customer = new Customer((int)$order->id_customer);

    $salutation = sovendus_get_formatted_salutation($customer->id_gender);

    return [
        'consumerSalutation' => $salutation,
        'consumerFirstName' => $delivery_details->firstname,
        'consumerLastName' => $delivery_details->lastname,
        'consumerEmail' => $customer->email,
        'consumerStreetWithNumber' => $delivery_details->address1,
        'consumerZipcode' => $delivery_details->postcode,
        'consumerCity' => $delivery_details->city,
        'consumerCountry' => $country,
        'consumerLanguage' => $language,
        'consumerPhone' => $delivery_details->phone_mobile ?: $delivery_details->phone
    ];
}

/**
 * Convert PrestaShop title ID to Sovendus salutation format
 *
 * @param int $titleId The PrestaShop title ID
 * @return string The formatted salutation (Mr. or Mrs. or empty string)
 */
function sovendus_get_formatted_salutation($titleId)
{
    // Default to empty string if we can't determine
    $salutation = '';

    if (!empty($titleId)) {
        try {
            // Get the title object
            $title = new Gender($titleId);

            // Check the gender type
            if ($title->type == 1) {
                $salutation = 'Mrs.';
            } else if ($title->type == 0) {
                $salutation = 'Mr.';
            }
        } catch (Exception $e) {
            // If there's an error, just use the default empty string
        }
    }

    return $salutation;
}

/**
 * Get coupon codes used in the order
 *
 * @param Order $order The order object
 * @return array Coupon codes
 */
function sovendus_get_coupon_codes($order)
{
    $couponCodes = [];

    // Try to get coupon codes from cart
    $cart = new Cart($order->id_cart);
    $cart_rule = $cart->getCartRules();

    if (!empty($cart_rule)) {
        foreach ($cart_rule as $rule) {
            if (!empty($rule['code'])) {
                $couponCodes[] = $rule['code'];
            }
        }
    }

    // Fallback for older versions if no coupon codes were found
    if (empty($couponCodes)) {
        // Try to get coupon codes directly from the order
        $orderCartRules = $order->getCartRules();
        if (!empty($orderCartRules)) {
            foreach ($orderCartRules as $rule) {
                if (!empty($rule['code'])) {
                    $couponCodes[] = $rule['code'];
                }
            }
        }
    }

    return $couponCodes;
}

/**
 * Hook for displaying content in the footer
 *
 * @param Ps_Sovendus $module The module instance
 * @param array $params Hook parameters
 * @return string HTML content
 */
function sovendus_hook_display_footer_after($module, $params = [])
{
    // Get locale and country information
    $context = Context::getContext();
    $locale = $context->language->iso_code;
    $language = strtoupper($locale);
    $country = sovendus_get_customer_country($context);

    // Create configuration for JavaScript
    $jsConfig = [
        'settings' => sovendus_get_config(),
        'integrationType' => SOVENDUS_INTEGRATION_TYPE,
        'country' => $country,
        'language' => $language,
    ];

    // Add JavaScript to the page
    $jsPath = $module->getPathUri() . 'views/js/sovendus-page.js';

    // Always include direct script tags to ensure it works in all PrestaShop versions
    $directScriptTag = '<script type="text/javascript">
        window.sovPageConfig = ' . json_encode($jsConfig) . ';
    </script>';
    $directScriptTag .= '<script type="text/javascript" src="' . $jsPath . '"></script>';

    return $directScriptTag . '<div id="sovendus-page-container"></div>';
}

/**
 * Hook for loading admin assets
 *
 * @param Ps_Sovendus $module The module instance
 * @param array $params Hook parameters
 * @return bool Whether the script was successfully registered
 */
function sovendus_hook_action_admin_controller_set_media($module, $params = array())
{
    $controller = Tools::getValue('controller');
    $moduleName = Tools::getValue('module_name');

    // Only load on the Modules > Configure page for this module
    if ($controller === 'AdminModules' && $moduleName === $module->name) {
        $context = Context::getContext();

        try {
            // Check if the controller has the registerJavascript method
            if (method_exists($context->controller, 'registerJavascript')) {
                // Register the main admin settings script
                $context->controller->registerJavascript(
                    'sovendus-admin-js',
                    $module->getPathUri() . 'views/js/admin_settings.js',
                    ['position' => 'bottom', 'priority' => 200]
                );

                // Successfully registered
                return true;
            } else if (method_exists($context->controller, 'addJS')) {
                // Fallback to addJS method if available
                $context->controller->addJS($module->getPathUri() . 'views/js/admin_settings.js');

                // Successfully registered
                return true;
            }

            // Neither method is available, fall back to direct script tag
            return false;
        } catch (Exception $e) {
            // If any error occurs, the script tag in the template will handle it
            return false;
        }
    }

    return false;
}

/**
 * Hook for loading admin assets in PrestaShop 8.2.1
 *
 * This hook is used as a fallback for PrestaShop 8.2.1 where the actionAdminControllerSetMedia
 * hook might not work correctly. It always includes the script tag to ensure the script is loaded.
 *
 * @param Ps_Sovendus $module The module instance
 * @param array $params Hook parameters
 * @return string HTML content
 */
function sovendus_hook_display_admin_after_header($module, $params = array())
{
    $controller = Tools::getValue('controller');
    $configure = Tools::getValue('configure');

    // Only load on the Modules > Configure page for this module
    if ($controller === 'AdminModules' && $configure === $module->name) {
        // Try to load the script using the other hook first, but we'll include the script tag anyway
        // This ensures the script is always loaded, even if the other hook fails
        sovendus_hook_action_admin_controller_set_media($module, $params);

        // Always include the script tag directly
        $jsPath = $module->getPathUri() . 'views/js/admin_settings.js';
        return '<script type="text/javascript" src="' . $jsPath . '"></script>';
    }

    return '';
}

/**
 * Get the customer's country code
 *
 * @param Context $context The PrestaShop context
 * @return string The country code
 */
function sovendus_get_customer_country($context)
{
    $country = $context->country->iso_code;

    // If country is not set, try to get it from the customer
    if (empty($country) && $context->customer->id) {
        $addresses = $context->customer->getAddresses($context->language->id);
        if (!empty($addresses)) {
            $firstAddress = reset($addresses);
            if (isset($firstAddress['id_country'])) {
                $country = Country::getIsoById($firstAddress['id_country']);
            }
        }
    }

    return $country;
}
