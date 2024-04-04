<div id="sovendus-integration-container"></div>
<script type="text/javascript">
  let isActive = false;
  let trafficSourceNumber = "";
  let trafficMediumNumber = "";
  const multiLangCountries = ["CH", "BE"]
  if (multiLangCountries.includes("{$country}")){
    const lang = document.documentElement.lang.split("-")[0];
    isActive = JSON.parse('{$isActive}'.replace(/&quot;/g, '"'))[lang];
    trafficSourceNumber = JSON.parse('{$trafficSourceNumber}'.replace(/&quot;/g, '"'))[lang];
    trafficMediumNumber = JSON.parse('{$trafficMediumNumber}'.replace(/&quot;/g, '"'))[lang];
  }
  else {
    trafficSourceNumber = '{$trafficSourceNumber}'.replace(/&quot;/g, '');
    trafficMediumNumber = '{$trafficMediumNumber}'.replace(/&quot;/g, '');
    isActive = true;
  }
  if (isActive && Number(trafficSourceNumber) > 0 && Number(trafficMediumNumber) > 0) {
    const isSovendusSale = document.cookie.split("; ").find(function(entry) {
      return entry.startsWith("isSovendusSale=");
    });
    window.sovIframes = window.sovIframes || [];
    window.sovIframes.push({
      trafficSourceNumber: trafficSourceNumber,
      trafficMediumNumber: trafficMediumNumber,
      sessionId: "{$sessionId}",
      timestamp: "{$currentTime}",
      orderId: "{$orderNumber}",
      orderValue: "{$netValue}",
      orderCurrency: "{$currency}",
      usedCouponCode: "{$usedCouponCode}",
      iframeContainerId: "sovendus-integration-container",
      integrationType: "prestashop-1.1.3"
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
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.async = true;
    script.src =
      window.location.protocol +
      "//api.sovendus.com/sovabo/common/js/flexibleIframe.js";
    document.body.appendChild(script);
  };
</script>