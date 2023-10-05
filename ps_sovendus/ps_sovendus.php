<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Ps_Sovendus extends Module
{
    private $SOVENDUS_ACTIVE = "SOVENDUS_ACTIVE";
    private $SOVENDUS_TRAFFIC_SOURCE_NUMBER = "SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    private $SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    public function __construct()
    {
        $this->name = 'ps_sovendus';
        $this->author = 'Sovendus - Marcus Brandstätter';
        $this->version = '1.0.1';
        $this->tab = 'front_office_features';
        $this->need_instance = 0;

        $this->ps_versions_compliancy = [
            'min' => '1.7.0.0',
            'max' => _PS_VERSION_,
        ];

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Sovendus Voucher Network & Checkout Benefits');
        $this->description = $this->l('Official Sovendus Voucher Network & Checkout Benefits module for Prestashop');
    }

    public function install()
    {
        return parent::install()
            && Configuration::updateValue($this->SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue($this->SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue($this->SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && $this->registerHook('displayOrderConfirmation');
    }

    public function hookDisplayOrderConfirmation(array $params)
    {
        $sovendusActive = Tools::getValue($this->SOVENDUS_ACTIVE, Configuration::get($this->SOVENDUS_ACTIVE));
        $trafficSourceNumber = Tools::getValue($this->SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get($this->SOVENDUS_TRAFFIC_SOURCE_NUMBER));
        $trafficMediumNumber = Tools::getValue($this->SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get($this->SOVENDUS_TRAFFIC_MEDIUM_NUMBER));

        if (!$sovendusActive || !$trafficSourceNumber || !$trafficMediumNumber) {
            return '';
        }

        /** @var Order $order */
        $order = (isset($params['objOrder'])) ? $params['objOrder'] : $params['order'];
        $orderNumber = $order->reference;
        $delivery_details = new Address((int) ($order->id_address_delivery));
        $zipCode = $delivery_details->postcode;
        $city = $delivery_details->city;
        list($streetName, $streetNumber) = $this->splitStreetAndStreetNumber($delivery_details->address1);
        $lastname = $delivery_details->lastname;
        $firstname = $delivery_details->firstname;
        // $number = $delivery_details -> phone_mobile ? $delivery_details -> phone_mobile : $delivery_details -> phone;
        $currency = (new Currency($order->id_currency))->iso_code;
        $sessionId = $order->date_add;
        $currentTime = time();
        $grossValue = (float) $order->total_paid_tax_excl;
        $netShipping = (float) ($order->total_shipping_tax_excl);
        $netValue = $grossValue - $netShipping;
        $country = Country::getIsoById($delivery_details->id_country);

        $customer = new Customer((int) ($order->id_customer));
        $email = $customer->email;

        $cart = new Cart($order->id_cart);
        $cart_rule = $cart->getCartRules();
        $usedCouponCode = $cart_rule ? ($cart_rule[0])["code"] : "";

        $this->context->smarty->assign(
            array(
                "currency" => $currency,
                "order" => $order,
                "orderNumber" => $orderNumber,
                "lastname" => $lastname,
                "firstname" => $firstname,
                "zipCode" => $zipCode,
                "city" => $city,
                "streetName" => $streetName,
                "streetNumber" => $streetNumber,
                "currentTime" => $currentTime,
                "country" => $country,
                "netValue" => $netValue,
                "email" => $email,
                "sessionId" => $sessionId,
                "usedCouponCode" => $usedCouponCode,
                "trafficSourceNumber" => $trafficSourceNumber,
                "trafficMediumNumber" => $trafficMediumNumber,
            )
        );
        return $this->display(__FILE__, 'views/templates/hook/psSovendus.tpl');
    }

    public function getContent()
    {
        $output = '';
        if (Tools::isSubmit('submitBlockViewed')) {
            $sovendusActive = Tools::getValue($this->SOVENDUS_ACTIVE);
            Configuration::updateValue($this->SOVENDUS_ACTIVE, (int) $sovendusActive);
            $mediumNumber = Tools::getValue($this->SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue($this->SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $mediumNumber);
            $sourceNumber = Tools::getValue($this->SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue($this->SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $sourceNumber);

            $output .= $this->displayConfirmation(
                $this->trans(
                    'The settings have been updated.',
                    [],
                    'Admin.Notifications.Success'
                )
            );
        }
        return $output . $this->renderForm();
    }

    public function renderForm()
    {
        $fields_form = [
            'form' => [
                'legend' => [
                    'title' => $this->l('Sovendus Settings'),
                    'icon' => 'icon-cogs',
                ],
                'input' => [
                    [
                        'type' => 'radio',
                        'label' => $this->l('Enable Sovendus Banner'),
                        'name' => $this->SOVENDUS_ACTIVE,
                        'desc' => $this->l('This will enable the sovendus banner on the post checkout page.'),
                        'class' => 't',
                        'is_bool' => true,
                        'default' => 0,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Traffic Source Number'),
                        'name' => $this->SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                        'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                        'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Traffic Medium Number'),
                        'name' => $this->SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                        'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                        'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                    ],
                ],
                'submit' => [
                    'title' => $this->trans('Save', [], 'Admin.Actions'),
                ],
            ],
        ];

        $lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->default_form_language = $lang->id;
        $configFormLang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG');
        $helper->allow_employee_form_lang = $configFormLang ? $configFormLang : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitBlockViewed';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) .
            '&configure=' . $this->name .
            '&tab_module=' . $this->tab .
            '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = [
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$fields_form]);
    }

    public function getConfigFieldsValues()
    {
        return [
            $this->SOVENDUS_ACTIVE => Tools::getValue($this->SOVENDUS_ACTIVE, Configuration::get($this->SOVENDUS_ACTIVE)),
            $this->SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue($this->SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get($this->SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            $this->SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue($this->SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get($this->SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),
        ];
    }


    function splitStreetAndStreetNumber(string $street)
    {
        if ((strlen($street) > 0) && preg_match_all('#([0-9/ -]+ ?[a-zA-Z]?(\s|$))#', trim($street), $match)) {
            $housenr = end($match[0]);
            $consumerStreet = trim(str_replace(array($housenr, '/'), '', $street));
            $consumerStreetNumber = trim($housenr);
            return array($consumerStreet, $consumerStreetNumber);
        } else {
            return array($street, "");
        }
    }

}