
<div id="sovendus-integration-container"></div>
<script type="text/javascript">
  window.sovIframes = window.sovIframes || [];
  window.sovIframes.push({
    trafficSourceNumber: "{$trafficSourceNumber}",
    trafficMediumNumber: "{$trafficMediumNumber}",
    sessionId: "{$sessionId}",
    timestamp: "{$currentTime}",
    orderId: "{$orderNumber}",
    orderValue: "{$netValue}",
    orderCurrency: "{$currency}",
    usedCouponCode: "{$usedCouponCode}",
    iframeContainerId: "sovendus-integration-container",
    integrationType: "prestashop-1.1.2"
  });
  window.sovConsumer = window.sovConsumer || {};
  window.sovConsumer = {
    consumerFirstName: "{$firstname}",
    consumerLastName: "{$lastname}",
    consumerEmail: "{$email}",
    consumerStreet:"{$streetName}",
    consumerStreetNumber:"{$streetNumber}",
    consumerZipcode: "{$zipCode}",
    consumerCity: "{$city}",
    consumerCountry: "{$country}",
  };
</script>
<script
  async=true
  src="https://api.sovendus.com/sovabo/common/js/flexibleIframe.js"
  type="text/javascript"
>
</script>