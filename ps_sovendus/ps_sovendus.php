<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Ps_Sovendus extends Module
{
    const DE_SOVENDUS_ACTIVE = "DE_SOVENDUS_ACTIVE";
    const DE_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "DE_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const DE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "DE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const AT_SOVENDUS_ACTIVE = "AT_SOVENDUS_ACTIVE";
    const AT_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "AT_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const AT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "AT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const NL_SOVENDUS_ACTIVE = "NL_SOVENDUS_ACTIVE";
    const NL_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "NL_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const NL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "NL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const DE_CH_SOVENDUS_ACTIVE = "DE_CH_SOVENDUS_ACTIVE";
    const DE_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "DE_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const DE_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "DE_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";
    const FR_CH_SOVENDUS_ACTIVE = "FR_CH_SOVENDUS_ACTIVE";
    const FR_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "FR_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const FR_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "FR_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const FR_SOVENDUS_ACTIVE = "FR_SOVENDUS_ACTIVE";
    const FR_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "FR_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const FR_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "FR_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const IT_SOVENDUS_ACTIVE = "IT_SOVENDUS_ACTIVE";
    const IT_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "IT_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const IT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "IT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const IE_SOVENDUS_ACTIVE = "IE_SOVENDUS_ACTIVE";
    const IE_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "IE_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const IE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "IE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const UK_SOVENDUS_ACTIVE = "UK_SOVENDUS_ACTIVE";
    const UK_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "UK_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const UK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "UK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const DK_SOVENDUS_ACTIVE = "DK_SOVENDUS_ACTIVE";
    const DK_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "DK_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const DK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "DK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const SE_SOVENDUS_ACTIVE = "SE_SOVENDUS_ACTIVE";
    const SE_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "SE_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const SE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "SE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const ES_SOVENDUS_ACTIVE = "ES_SOVENDUS_ACTIVE";
    const ES_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "ES_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const ES_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "ES_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const NL_BE_SOVENDUS_ACTIVE = "NL_BE_SOVENDUS_ACTIVE";
    const NL_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "NL_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const NL_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "NL_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";


    const FR_BE_SOVENDUS_ACTIVE = "FR_BE_SOVENDUS_ACTIVE";
    const FR_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "FR_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const FR_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "FR_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";

    const PL_SOVENDUS_ACTIVE = "PL_SOVENDUS_ACTIVE";
    const PL_SOVENDUS_TRAFFIC_SOURCE_NUMBER = "PL_SOVENDUS_TRAFFIC_SOURCE_NUMBER";
    const PL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER = "PL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER";


    public function __construct()
    {
        $this->name = 'ps_sovendus';
        $this->author = 'Sovendus - Marcus Brandstätter';
        $this->version = '1.2.0';
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
            && Configuration::updateValue(self::DE_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::DE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::DE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::AT_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::AT_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::AT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::NL_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::NL_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::NL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::DE_CH_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::DE_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::DE_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::FR_CH_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::FR_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::FR_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::FR_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::FR_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::FR_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::IT_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::IT_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::IT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::IE_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::IE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::IE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::UK_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::UK_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::UK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::DK_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::DK_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::DK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::SE_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::SE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::SE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::ES_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::ES_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::ES_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::NL_BE_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::NL_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::NL_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::FR_BE_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::FR_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::FR_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && Configuration::updateValue(self::PL_SOVENDUS_ACTIVE, 0)
            && Configuration::updateValue(self::PL_SOVENDUS_TRAFFIC_SOURCE_NUMBER, "")
            && Configuration::updateValue(self::PL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, "")
            && $this->registerHook('displayFooterAfter')
            && $this->registerHook('displayOrderConfirmation');
    }

    public function hookDisplayOrderConfirmation(array $params)
    {
        /** @var Order $order */
        $order = (isset($params['objOrder'])) ? $params['objOrder'] : $params['order'];
        $delivery_details = new Address((int) ($order->id_address_delivery));
        $country = Country::getIsoById($delivery_details->id_country);

        list($sovendusActive, $trafficSourceNumber, $trafficMediumNumber) = $this->getSovendusConfig($country);

        if (!$sovendusActive || !$trafficSourceNumber || !$trafficMediumNumber) {
            return '';
        }

        $orderNumber = $order->reference;
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
                "isActive"=> json_encode($sovendusActive),
                "trafficSourceNumber" => json_encode($trafficSourceNumber),
                "trafficMediumNumber" => json_encode($trafficMediumNumber),
            )
        );
        return $this->display(__FILE__, 'views/templates/hook/psSovendus.tpl');
    }

    function getSovendusConfig($countryCode)
    {
        switch ($countryCode) {
            case 'DE':
                $sovendusActive = Tools::getValue(self::DE_SOVENDUS_ACTIVE, Configuration::get(self::DE_SOVENDUS_ACTIVE));
                $trafficSourceNumber = Tools::getValue(self::DE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::DE_SOVENDUS_TRAFFIC_SOURCE_NUMBER));
                $trafficMediumNumber = Tools::getValue(self::DE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::DE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER));
                break;
            case 'AT':
                $sovendusActive = Tools::getValue(self::AT_SOVENDUS_ACTIVE, Configuration::get(self::AT_SOVENDUS_ACTIVE));
                $trafficSourceNumber = Tools::getValue(self::AT_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::AT_SOVENDUS_TRAFFIC_SOURCE_NUMBER));
                $trafficMediumNumber = Tools::getValue(self::AT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::AT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER));
                break;
            case 'NL':
                $sovendusActive = Tools::getValue(self::NL_SOVENDUS_ACTIVE, Configuration::get(self::NL_SOVENDUS_ACTIVE));
                $trafficSourceNumber = Tools::getValue(self::NL_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::NL_SOVENDUS_TRAFFIC_SOURCE_NUMBER));
                $trafficMediumNumber = Tools::getValue(self::NL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::NL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER));
                break;
            case 'CH':
                $sovendusActive = array(
                    "de" => Tools::getValue(self::DE_CH_SOVENDUS_ACTIVE, Configuration::get(self::DE_CH_SOVENDUS_ACTIVE)),
                    "fr" => Tools::getValue(self::FR_CH_SOVENDUS_ACTIVE, Configuration::get(self::FR_CH_SOVENDUS_ACTIVE))
                );
                $trafficSourceNumber = array(
                    "de" => Tools::getValue(self::DE_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::DE_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
                    "fr" => Tools::getValue(self::FR_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::FR_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER))
                );
                $trafficMediumNumber = array(
                    "de" => Tools::getValue(self::DE_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::DE_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),
                    "fr" => Tools::getValue(self::FR_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::FR_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER))
                );
                break;
            case 'FR':
                $sovendusActive = Tools::getValue(self::FR_SOVENDUS_ACTIVE, Configuration::get(self::FR_SOVENDUS_ACTIVE));
                $trafficSourceNumber = Tools::getValue(self::FR_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::FR_SOVENDUS_TRAFFIC_SOURCE_NUMBER));
                $trafficMediumNumber = Tools::getValue(self::FR_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::FR_SOVENDUS_TRAFFIC_MEDIUM_NUMBER));
                break;
            case 'IT':
                $sovendusActive = Tools::getValue(self::IT_SOVENDUS_ACTIVE, Configuration::get(self::IT_SOVENDUS_ACTIVE));
                $trafficSourceNumber = Tools::getValue(self::IT_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::IT_SOVENDUS_TRAFFIC_SOURCE_NUMBER));
                $trafficMediumNumber = Tools::getValue(self::IT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::IT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER));
                break;
            case 'IE':
                $sovendusActive = Tools::getValue(self::IE_SOVENDUS_ACTIVE, Configuration::get(self::IE_SOVENDUS_ACTIVE));
                $trafficSourceNumber = Tools::getValue(self::IE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::IE_SOVENDUS_TRAFFIC_SOURCE_NUMBER));
                $trafficMediumNumber = Tools::getValue(self::IE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::IE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER));
                break;
            case 'UK':
                $sovendusActive = Tools::getValue(self::UK_SOVENDUS_ACTIVE, Configuration::get(self::UK_SOVENDUS_ACTIVE));
                $trafficSourceNumber = Tools::getValue(self::UK_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::UK_SOVENDUS_TRAFFIC_SOURCE_NUMBER));
                $trafficMediumNumber = Tools::getValue(self::UK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::UK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER));
                break;
            case 'DK':
                $sovendusActive = Tools::getValue(self::DK_SOVENDUS_ACTIVE, Configuration::get(self::DK_SOVENDUS_ACTIVE));
                $trafficSourceNumber = Tools::getValue(self::DK_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::DK_SOVENDUS_TRAFFIC_SOURCE_NUMBER));
                $trafficMediumNumber = Tools::getValue(self::DK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::DK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER));
                break;
            case 'SE':
                $sovendusActive = Tools::getValue(self::SE_SOVENDUS_ACTIVE, Configuration::get(self::SE_SOVENDUS_ACTIVE));
                $trafficSourceNumber = Tools::getValue(self::SE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::SE_SOVENDUS_TRAFFIC_SOURCE_NUMBER));
                $trafficMediumNumber = Tools::getValue(self::SE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::SE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER));
                break;
            case 'ES':
                $sovendusActive = Tools::getValue(self::ES_SOVENDUS_ACTIVE, Configuration::get(self::ES_SOVENDUS_ACTIVE));
                $trafficSourceNumber = Tools::getValue(self::ES_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::ES_SOVENDUS_TRAFFIC_SOURCE_NUMBER));
                $trafficMediumNumber = Tools::getValue(self::ES_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::ES_SOVENDUS_TRAFFIC_MEDIUM_NUMBER));
                break;
            case 'BE':
                $sovendusActive = array(
                    "nl" => Tools::getValue(self::NL_BE_SOVENDUS_ACTIVE, Configuration::get(self::NL_BE_SOVENDUS_ACTIVE)),
                    "fr" => Tools::getValue(self::FR_BE_SOVENDUS_ACTIVE, Configuration::get(self::FR_BE_SOVENDUS_ACTIVE))
                );
                $trafficSourceNumber = array(
                    "nl" => Tools::getValue(self::NL_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::NL_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
                    "fr" => Tools::getValue(self::FR_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::FR_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER))
                );
                $trafficMediumNumber = array(
                    "nl" => Tools::getValue(self::NL_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::NL_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),
                    "fr" => Tools::getValue(self::FR_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::FR_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER))
                );
                break;
            case 'PL':
                $sovendusActive = Tools::getValue(self::PL_SOVENDUS_ACTIVE, Configuration::get(self::PL_SOVENDUS_ACTIVE));
                $trafficSourceNumber = Tools::getValue(self::PL_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::PL_SOVENDUS_TRAFFIC_SOURCE_NUMBER));
                $trafficMediumNumber = Tools::getValue(self::PL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::PL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER));
                break;
            default:
                $sovendusActive = 0;
                $trafficSourceNumber = 0;
                $trafficMediumNumber = 0;
                break;
        }

        return array(
            $sovendusActive,
            $trafficSourceNumber,
            $trafficMediumNumber,
        );
    }

    public function getContent()
    {
        $output = '';
        if (Tools::isSubmit('submitBlockViewed')) {
            $DE_sovendusActive = Tools::getValue(self::DE_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::DE_SOVENDUS_ACTIVE, (int) $DE_sovendusActive);
            $DE_mediumNumber = Tools::getValue(self::DE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::DE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $DE_mediumNumber);
            $DE_sourceNumber = Tools::getValue(self::DE_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::DE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $DE_sourceNumber);

            $AT_sovendusActive = Tools::getValue(self::AT_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::AT_SOVENDUS_ACTIVE, (int) $AT_sovendusActive);
            $AT_mediumNumber = Tools::getValue(self::AT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::AT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $AT_mediumNumber);
            $AT_sourceNumber = Tools::getValue(self::AT_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::AT_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $AT_sourceNumber);

            $NL_sovendusActive = Tools::getValue(self::NL_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::NL_SOVENDUS_ACTIVE, (int) $NL_sovendusActive);
            $NL_mediumNumber = Tools::getValue(self::NL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::NL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $NL_mediumNumber);
            $NL_sourceNumber = Tools::getValue(self::NL_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::NL_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $NL_sourceNumber);

            $DE_CH_sovendusActive = Tools::getValue(self::DE_CH_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::DE_CH_SOVENDUS_ACTIVE, (int) $DE_CH_sovendusActive);
            $DE_CH_mediumNumber = Tools::getValue(self::DE_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::DE_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $DE_CH_mediumNumber);
            $DE_CH_sourceNumber = Tools::getValue(self::DE_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::DE_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $DE_CH_sourceNumber);

            $FR_CH_sovendusActive = Tools::getValue(self::FR_CH_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::FR_CH_SOVENDUS_ACTIVE, (int) $FR_CH_sovendusActive);
            $FR_CH_mediumNumber = Tools::getValue(self::FR_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::FR_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $FR_CH_mediumNumber);
            $FR_CH_sourceNumber = Tools::getValue(self::FR_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::FR_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $FR_CH_sourceNumber);

            $FR_sovendusActive = Tools::getValue(self::FR_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::FR_SOVENDUS_ACTIVE, (int) $FR_sovendusActive);
            $FR_mediumNumber = Tools::getValue(self::FR_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::FR_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $FR_mediumNumber);
            $FR_sourceNumber = Tools::getValue(self::FR_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::FR_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $FR_sourceNumber);

            $IT_sovendusActive = Tools::getValue(self::IT_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::IT_SOVENDUS_ACTIVE, (int) $IT_sovendusActive);
            $IT_mediumNumber = Tools::getValue(self::IT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::IT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $IT_mediumNumber);
            $IT_sourceNumber = Tools::getValue(self::IT_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::IT_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $IT_sourceNumber);

            $IE_sovendusActive = Tools::getValue(self::IE_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::IE_SOVENDUS_ACTIVE, (int) $IE_sovendusActive);
            $IE_mediumNumber = Tools::getValue(self::IE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::IE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $IE_mediumNumber);
            $IE_sourceNumber = Tools::getValue(self::IE_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::IE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $IE_sourceNumber);

            $UK_sovendusActive = Tools::getValue(self::UK_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::UK_SOVENDUS_ACTIVE, (int) $UK_sovendusActive);
            $UK_mediumNumber = Tools::getValue(self::UK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::UK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $UK_mediumNumber);
            $UK_sourceNumber = Tools::getValue(self::UK_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::UK_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $UK_sourceNumber);

            $DK_sovendusActive = Tools::getValue(self::DK_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::DK_SOVENDUS_ACTIVE, (int) $DK_sovendusActive);
            $DK_mediumNumber = Tools::getValue(self::DK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::DK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $DK_mediumNumber);
            $DK_sourceNumber = Tools::getValue(self::DK_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::DK_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $DK_sourceNumber);

            $SE_sovendusActive = Tools::getValue(self::SE_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::SE_SOVENDUS_ACTIVE, (int) $SE_sovendusActive);
            $SE_mediumNumber = Tools::getValue(self::SE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::SE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $SE_mediumNumber);
            $SE_sourceNumber = Tools::getValue(self::SE_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::SE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $SE_sourceNumber);

            $ES_sovendusActive = Tools::getValue(self::ES_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::ES_SOVENDUS_ACTIVE, (int) $ES_sovendusActive);
            $ES_mediumNumber = Tools::getValue(self::ES_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::ES_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $ES_mediumNumber);
            $ES_sourceNumber = Tools::getValue(self::ES_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::ES_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $ES_sourceNumber);

            $NL_BE_sovendusActive = Tools::getValue(self::NL_BE_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::NL_BE_SOVENDUS_ACTIVE, (int) $NL_BE_sovendusActive);
            $NL_BE_mediumNumber = Tools::getValue(self::NL_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::NL_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $NL_BE_mediumNumber);
            $NL_BE_sourceNumber = Tools::getValue(self::NL_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::NL_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $NL_BE_sourceNumber);

            $FR_BE_sovendusActive = Tools::getValue(self::FR_BE_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::FR_BE_SOVENDUS_ACTIVE, (int) $FR_BE_sovendusActive);
            $FR_BE_mediumNumber = Tools::getValue(self::FR_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::FR_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $FR_BE_mediumNumber);
            $FR_BE_sourceNumber = Tools::getValue(self::FR_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::FR_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $FR_BE_sourceNumber);

            $PL_sovendusActive = Tools::getValue(self::PL_SOVENDUS_ACTIVE);
            Configuration::updateValue(self::PL_SOVENDUS_ACTIVE, (int) $PL_sovendusActive);
            $PL_mediumNumber = Tools::getValue(self::PL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER);
            Configuration::updateValue(self::PL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, (int) $PL_mediumNumber);
            $PL_sourceNumber = Tools::getValue(self::PL_SOVENDUS_TRAFFIC_SOURCE_NUMBER);
            Configuration::updateValue(self::PL_SOVENDUS_TRAFFIC_SOURCE_NUMBER, (int) $PL_sourceNumber);
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
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Germany Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Germany'),
                            'name' => self::DE_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Germany Traffic Source Number'),
                            'name' => self::DE_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Germany Traffic Medium Number'),
                            'name' => self::DE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Austria Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Austria'),
                            'name' => self::AT_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Austria Traffic Source Number'),
                            'name' => self::AT_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Austria Traffic Medium Number'),
                            'name' => self::AT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Netherland Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Netherland'),
                            'name' => self::NL_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Netherland Traffic Source Number'),
                            'name' => self::NL_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Netherland Traffic Medium Number'),
                            'name' => self::NL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Switzerland German Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Switzerland German'),
                            'name' => self::DE_CH_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Switzerland German Traffic Source Number'),
                            'name' => self::DE_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Switzerland German Traffic Medium Number'),
                            'name' => self::DE_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Switzerland French Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Switzerland French'),
                            'name' => self::FR_CH_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Switzerland French Traffic Source Number'),
                            'name' => self::FR_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Switzerland French Traffic Medium Number'),
                            'name' => self::FR_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('France Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus France'),
                            'name' => self::FR_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('France Traffic Source Number'),
                            'name' => self::FR_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('France Traffic Medium Number'),
                            'name' => self::FR_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Italy Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Italy'),
                            'name' => self::IT_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Italy Traffic Source Number'),
                            'name' => self::IT_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Italy Traffic Medium Number'),
                            'name' => self::IT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Ireland Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Ireland'),
                            'name' => self::IE_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Ireland Traffic Source Number'),
                            'name' => self::IE_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Ireland Traffic Medium Number'),
                            'name' => self::IE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('United Kingdom Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus United Kingdom'),
                            'name' => self::UK_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('United Kingdom Traffic Source Number'),
                            'name' => self::UK_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('United Kingdom Traffic Medium Number'),
                            'name' => self::UK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Denmark Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Denmark'),
                            'name' => self::DK_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Denmark Traffic Source Number'),
                            'name' => self::DK_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Denmark Traffic Medium Number'),
                            'name' => self::DK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Sweden Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Sweden'),
                            'name' => self::SE_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Sweden Traffic Source Number'),
                            'name' => self::SE_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Sweden Traffic Medium Number'),
                            'name' => self::SE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Spain Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Spain'),
                            'name' => self::ES_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Spain Traffic Source Number'),
                            'name' => self::ES_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Spain Traffic Medium Number'),
                            'name' => self::ES_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Belgium Dutch Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Belgium Dutch'),
                            'name' => self::NL_BE_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Belgium Dutch Traffic Source Number'),
                            'name' => self::NL_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Belgium Dutch Traffic Medium Number'),
                            'name' => self::NL_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Belgium French Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Belgium French'),
                            'name' => self::FR_BE_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Belgium French Traffic Source Number'),
                            'name' => self::FR_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Belgium French Traffic Medium Number'),
                            'name' => self::FR_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
                ],
            ],
            [
                'form' => [
                    'legend' => [
                        'title' => $this->l('Poland Settings'),
                        'icon' => 'icon-cogs',
                    ],
                    'input' => [
                        [
                            'type' => 'radio',
                            'label' => $this->l('Enable Sovendus Poland'),
                            'name' => self::PL_SOVENDUS_ACTIVE,
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
                            'label' => $this->l('Poland Traffic Source Number'),
                            'name' => self::PL_SOVENDUS_TRAFFIC_SOURCE_NUMBER,
                            'desc' => $this->l('Enter the traffic source number from your integration documentation.'),
                            'hint' => $this->l('The traffic source number is used to assign your store in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                        [
                            'type' => 'text',
                            'label' => $this->l('Poland Traffic Medium Number'),
                            'name' => self::PL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER,
                            'desc' => $this->l('Enter the traffic medium number from your integration documentation.'),
                            'hint' => $this->l('The traffic medium number is used to assign your integration in the Sovendus system. You can find it in your integration documentation.'),
                        ],
                    ],
                    'submit' => [
                        'title' => $this->trans('Save', [], 'Admin.Actions'),
                    ],
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

        return $helper->generateForm($fields_form);
    }

    public function getConfigFieldsValues()
    {
        return [
            self::DE_SOVENDUS_ACTIVE => Tools::getValue(self::DE_SOVENDUS_ACTIVE, Configuration::get(self::DE_SOVENDUS_ACTIVE)),
            self::DE_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::DE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::DE_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::DE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::DE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::DE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::AT_SOVENDUS_ACTIVE => Tools::getValue(self::AT_SOVENDUS_ACTIVE, Configuration::get(self::AT_SOVENDUS_ACTIVE)),
            self::AT_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::AT_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::AT_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::AT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::AT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::AT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::NL_SOVENDUS_ACTIVE => Tools::getValue(self::NL_SOVENDUS_ACTIVE, Configuration::get(self::NL_SOVENDUS_ACTIVE)),
            self::NL_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::NL_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::NL_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::NL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::NL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::NL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::DE_CH_SOVENDUS_ACTIVE => Tools::getValue(self::DE_CH_SOVENDUS_ACTIVE, Configuration::get(self::DE_CH_SOVENDUS_ACTIVE)),
            self::DE_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::DE_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::DE_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::DE_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::DE_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::DE_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::FR_CH_SOVENDUS_ACTIVE => Tools::getValue(self::FR_CH_SOVENDUS_ACTIVE, Configuration::get(self::FR_CH_SOVENDUS_ACTIVE)),
            self::FR_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::FR_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::FR_CH_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::FR_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::FR_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::FR_CH_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::FR_SOVENDUS_ACTIVE => Tools::getValue(self::FR_SOVENDUS_ACTIVE, Configuration::get(self::FR_SOVENDUS_ACTIVE)),
            self::FR_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::FR_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::FR_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::FR_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::FR_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::FR_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::IT_SOVENDUS_ACTIVE => Tools::getValue(self::IT_SOVENDUS_ACTIVE, Configuration::get(self::IT_SOVENDUS_ACTIVE)),
            self::IT_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::IT_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::IT_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::IT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::IT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::IT_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::IE_SOVENDUS_ACTIVE => Tools::getValue(self::IE_SOVENDUS_ACTIVE, Configuration::get(self::IE_SOVENDUS_ACTIVE)),
            self::IE_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::IE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::IE_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::IE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::IE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::IE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::UK_SOVENDUS_ACTIVE => Tools::getValue(self::UK_SOVENDUS_ACTIVE, Configuration::get(self::UK_SOVENDUS_ACTIVE)),
            self::UK_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::UK_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::UK_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::UK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::UK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::UK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::DK_SOVENDUS_ACTIVE => Tools::getValue(self::DK_SOVENDUS_ACTIVE, Configuration::get(self::DK_SOVENDUS_ACTIVE)),
            self::DK_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::DK_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::DK_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::DK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::DK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::DK_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::SE_SOVENDUS_ACTIVE => Tools::getValue(self::SE_SOVENDUS_ACTIVE, Configuration::get(self::SE_SOVENDUS_ACTIVE)),
            self::SE_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::SE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::SE_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::SE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::SE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::SE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::ES_SOVENDUS_ACTIVE => Tools::getValue(self::ES_SOVENDUS_ACTIVE, Configuration::get(self::ES_SOVENDUS_ACTIVE)),
            self::ES_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::ES_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::ES_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::ES_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::ES_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::ES_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::NL_BE_SOVENDUS_ACTIVE => Tools::getValue(self::NL_BE_SOVENDUS_ACTIVE, Configuration::get(self::NL_BE_SOVENDUS_ACTIVE)),
            self::NL_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::NL_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::NL_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::NL_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::NL_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::NL_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::FR_BE_SOVENDUS_ACTIVE => Tools::getValue(self::FR_BE_SOVENDUS_ACTIVE, Configuration::get(self::FR_BE_SOVENDUS_ACTIVE)),
            self::FR_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::FR_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::FR_BE_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::FR_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::FR_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::FR_BE_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),

            self::PL_SOVENDUS_ACTIVE => Tools::getValue(self::PL_SOVENDUS_ACTIVE, Configuration::get(self::PL_SOVENDUS_ACTIVE)),
            self::PL_SOVENDUS_TRAFFIC_SOURCE_NUMBER => Tools::getValue(self::PL_SOVENDUS_TRAFFIC_SOURCE_NUMBER, Configuration::get(self::PL_SOVENDUS_TRAFFIC_SOURCE_NUMBER)),
            self::PL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER => Tools::getValue(self::PL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER, Configuration::get(self::PL_SOVENDUS_TRAFFIC_MEDIUM_NUMBER)),
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
    public function hookDisplayFooterAfter(array $params)
    {
        return $this->display(__FILE__, 'views/templates/hook/sovendusHome.tpl');
    }

}