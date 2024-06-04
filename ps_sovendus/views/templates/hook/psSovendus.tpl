<div id="sovendus-integration-container"></div>
<script type="text/javascript">
  let isActive = false;
  let trafficSourceNumber = "";
  let trafficMediumNumber = "";
  const multiLangCountries = ["CH", "BE"]
  if (multiLangCountries.includes("{$sovendusData.country}")){
    const lang = document.documentElement.lang.split("-")[0];
    isActive = JSON.parse('{$sovendusData.isActive}'.replace(/&quot;/g, '"'))[lang];
    trafficSourceNumber = JSON.parse('{$sovendusData.trafficSourceNumber}'.replace(/&quot;/g, '"'))[lang];
    trafficMediumNumber = JSON.parse('{$sovendusData.trafficMediumNumber}'.replace(/&quot;/g, '"'))[lang];
  }
  else {
    trafficSourceNumber = '{$sovendusData.trafficSourceNumber}'.replace(/&quot;/g, '');
    trafficMediumNumber = '{$sovendusData.trafficMediumNumber}'.replace(/&quot;/g, '');
    isActive = true;
  }
  if (isActive && Number(trafficSourceNumber) > 0 && Number(trafficMediumNumber) > 0) {
    window.sovIframes = window.sovIframes || [];
    window.sovIframes.push({
      trafficSourceNumber: trafficSourceNumber,
      trafficMediumNumber: trafficMediumNumber,
      sessionId: "{$sovendusData.sessionId}",
      timestamp: "{$sovendusData.currentTime}",
      orderId: "{$sovendusData.orderNumber}",
      orderValue: "{$sovendusData.netValue}",
      orderCurrency: "{$sovendusData.currency}",
      usedCouponCode: "{$sovendusData.usedCouponCode}",
      iframeContainerId: "sovendus-integration-container",
      integrationType: "prestashop-1.2.2"
    });
    window.sovConsumer = window.sovConsumer || {};
    window.sovConsumer = {
      consumerFirstName: "{$sovendusData.firstname}",
      consumerLastName: "{$sovendusData.lastname}",
      consumerEmail: "{$sovendusData.email}",
      consumerStreet:"{$sovendusData.streetName}",
      consumerStreetNumber:"{$sovendusData.streetNumber}",
      consumerZipcode: "{$sovendusData.zipCode}",
      consumerCity: "{$sovendusData.city}",
      consumerCountry: "{$sovendusData.country}",
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