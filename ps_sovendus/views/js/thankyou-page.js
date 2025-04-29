(function() {
  "use strict";
  var __defProp = Object.defineProperty;
  var __defProps = Object.defineProperties;
  var __getOwnPropDescs = Object.getOwnPropertyDescriptors;
  var __getOwnPropSymbols = Object.getOwnPropertySymbols;
  var __hasOwnProp = Object.prototype.hasOwnProperty;
  var __propIsEnum = Object.prototype.propertyIsEnumerable;
  var __defNormalProp = (obj, key, value) => key in obj ? __defProp(obj, key, { enumerable: true, configurable: true, writable: true, value }) : obj[key] = value;
  var __spreadValues = (a, b) => {
    for (var prop in b || (b = {}))
      if (__hasOwnProp.call(b, prop))
        __defNormalProp(a, prop, b[prop]);
    if (__getOwnPropSymbols)
      for (var prop of __getOwnPropSymbols(b)) {
        if (__propIsEnum.call(b, prop))
          __defNormalProp(a, prop, b[prop]);
      }
    return a;
  };
  var __spreadProps = (a, b) => __defProps(a, __getOwnPropDescs(b));
  var __publicField = (obj, key, value) => __defNormalProp(obj, typeof key !== "symbol" ? key + "" : key, value);
  var __async = (__this, __arguments, generator) => {
    return new Promise((resolve, reject) => {
      var fulfilled = (value) => {
        try {
          step(generator.next(value));
        } catch (e) {
          reject(e);
        }
      };
      var rejected = (value) => {
        try {
          step(generator.throw(value));
        } catch (e) {
          reject(e);
        }
      };
      var step = (x) => x.done ? resolve(x.value) : Promise.resolve(x.value).then(fulfilled, rejected);
      step((generator = generator.apply(__this, __arguments)).next());
    });
  };
  const integrationScriptVersion = "3.11.12";
  var CountryCodes = /* @__PURE__ */ ((CountryCodes2) => {
    CountryCodes2["AT"] = "AT";
    CountryCodes2["BE"] = "BE";
    CountryCodes2["DK"] = "DK";
    CountryCodes2["FR"] = "FR";
    CountryCodes2["DE"] = "DE";
    CountryCodes2["IE"] = "IE";
    CountryCodes2["IT"] = "IT";
    CountryCodes2["NL"] = "NL";
    CountryCodes2["NO"] = "NO";
    CountryCodes2["PL"] = "PL";
    CountryCodes2["ES"] = "ES";
    CountryCodes2["SE"] = "SE";
    CountryCodes2["CH"] = "CH";
    CountryCodes2["GB"] = "GB";
    return CountryCodes2;
  })(CountryCodes || {});
  const LANGUAGES_BY_COUNTRIES = {
    [
      "AT"
      /* AT */
    ]: { [
      "DE"
      /* DE */
    ]: "Austria" },
    [
      "BE"
      /* BE */
    ]: {
      [
        "FR"
        /* FR */
      ]: "Belgium French",
      [
        "NL"
        /* NL */
      ]: "Belgium Dutch"
    },
    [
      "DK"
      /* DK */
    ]: { [
      "DA"
      /* DA */
    ]: "Denmark" },
    // [CountryCodes.FI]: { [LanguageCodes.FI]: "Finland" },
    [
      "FR"
      /* FR */
    ]: { [
      "FR"
      /* FR */
    ]: "France" },
    [
      "DE"
      /* DE */
    ]: { [
      "DE"
      /* DE */
    ]: "Germany" },
    [
      "IE"
      /* IE */
    ]: { [
      "EN"
      /* EN */
    ]: "Ireland" },
    [
      "IT"
      /* IT */
    ]: { [
      "IT"
      /* IT */
    ]: "Italy" },
    [
      "NL"
      /* NL */
    ]: { [
      "NL"
      /* NL */
    ]: "Netherlands" },
    [
      "NO"
      /* NO */
    ]: { [
      "NB"
      /* NB */
    ]: "Norway" },
    [
      "PL"
      /* PL */
    ]: { [
      "PL"
      /* PL */
    ]: "Poland" },
    // [CountryCodes.PT]: { [LanguageCodes.PT]: "Portugal" },
    [
      "ES"
      /* ES */
    ]: { [
      "ES"
      /* ES */
    ]: "Spain" },
    [
      "SE"
      /* SE */
    ]: { [
      "SV"
      /* SV */
    ]: "Sweden" },
    [
      "CH"
      /* CH */
    ]: {
      [
        "FR"
        /* FR */
      ]: "Switzerland French",
      [
        "DE"
        /* DE */
      ]: "Switzerland German",
      [
        "IT"
        /* IT */
      ]: "Switzerland Italian"
    },
    [
      "GB"
      /* GB */
    ]: { [
      "EN"
      /* EN */
    ]: "United Kingdom" }
  };
  const defaultIframeContainerQuerySelector = { selector: "#sovendus-container", where: "none" };
  var SettingsType = /* @__PURE__ */ ((SettingsType2) => {
    SettingsType2["SIMPLE"] = "simple";
    SettingsType2["COUNTRY"] = "country";
    return SettingsType2;
  })(SettingsType || {});
  const sovLoaderScriptId = "sovloader-script";
  function getPerformanceTime() {
    var _a, _b;
    throwErrorInNonBrowserContext({
      methodName: "getPerformanceTime",
      pageType: "LandingPage",
      requiresWindow: true
    });
    return ((_b = (_a = window.performance) == null ? void 0 : _a.now) == null ? void 0 : _b.call(_a)) || 0;
  }
  function detectCountryCode() {
    return getCountryCodeFromHtmlTag() || getCountryFromDomain() || getCountryFromPagePath();
  }
  function getOptimizeId(settings, country) {
    var _a, _b, _c, _d, _e, _f, _g, _h, _i, _j, _k, _l;
    if (((_a = settings == null ? void 0 : settings.optimize) == null ? void 0 : _a.settingsType) === SettingsType.SIMPLE) {
      if (((_c = (_b = settings == null ? void 0 : settings.optimize) == null ? void 0 : _b.simple) == null ? void 0 : _c.isEnabled) !== false && ((_e = (_d = settings == null ? void 0 : settings.optimize) == null ? void 0 : _d.simple) == null ? void 0 : _e.optimizeId)) {
        return settings.optimize.simple.optimizeId;
      }
    } else {
      if ((_g = (_f = settings.optimize) == null ? void 0 : _f.countries) == null ? void 0 : _g.ids) {
        const uncleanedCountryCode = country;
        const countryCode = uncleanedCountryCode === "UK" ? CountryCodes.GB : uncleanedCountryCode;
        if (countryCode) {
          const countryElement = (_i = (_h = settings.optimize.countries) == null ? void 0 : _h.ids) == null ? void 0 : _i[countryCode];
          return (countryElement == null ? void 0 : countryElement.isEnabled) ? countryElement == null ? void 0 : countryElement.optimizeId : void 0;
        }
        const fallbackId = (_k = (_j = settings == null ? void 0 : settings.optimize) == null ? void 0 : _j.countries) == null ? void 0 : _k.fallBackId;
        if (((_l = settings.optimize) == null ? void 0 : _l.countries.fallBackEnabled) && fallbackId) {
          return fallbackId;
        }
      }
    }
    return void 0;
  }
  function throwErrorInNonBrowserContext({
    methodName,
    requiresWindow,
    requiresDocument,
    pageType
  }) {
    if ((requiresDocument ? typeof document === "undefined" : false) || (requiresWindow ? typeof window === "undefined" : false)) {
      throw new Error(
        `Sovendus App [${pageType}] - ${methodName}: ${requiresWindow ? "window" : ""} ${requiresDocument ? "document" : ""} is not available in your context, you can override this method`
      );
    }
  }
  function loggerError(message, pageType, ...other) {
    console.error(`Sovendus App [${pageType}] - ${message}`, ...other);
  }
  function getCountryCodeFromHtmlTag() {
    throwErrorInNonBrowserContext({
      methodName: "getCountryCodeFromHtmlTag",
      pageType: "LandingPage",
      requiresDocument: true
    });
    const lang = document.documentElement.lang;
    const countryCode = lang.split("-")[1];
    return countryCode ? castToCountry(countryCode.toUpperCase()) : void 0;
  }
  function getCountryFromDomain() {
    throwErrorInNonBrowserContext({
      methodName: "getCountryFromDomain",
      pageType: "LandingPage",
      requiresWindow: true
    });
    const domainToCountry = {
      "de": "DE",
      "at": "AT",
      "ch": "CH",
      "uk": "GB",
      "co.uk": "GB",
      "com": void 0,
      "se": "SE",
      "no": "NO",
      "dk": "DK",
      "fi": "FI",
      "fr": "FR",
      "be": "BE",
      "nl": "NL",
      "it": "IT",
      "es": "ES",
      "pt": "PT",
      "pl": "PL",
      "cz": "CZ",
      "sk": "SK",
      "hu": "HU"
    };
    const domain = window.location.hostname;
    const domainParts = domain.split(".");
    const domainPart = domainParts[domainParts.length - 1];
    return domainPart ? domainToCountry[domainPart] : void 0;
  }
  function getCountryFromPagePath() {
    throwErrorInNonBrowserContext({
      methodName: "getCountryFromDomain",
      pageType: "LandingPage",
      requiresWindow: true
    });
    const path = window.location.pathname;
    const pathParts = path.split("/");
    const country = pathParts[1];
    return castToCountry(country == null ? void 0 : country.toUpperCase());
  }
  function castToCountry(value) {
    if (value && Object.values(CountryCodes).includes(value)) {
      return value;
    }
    return void 0;
  }
  function makeNumber(value) {
    if (value === void 0) {
      return void 0;
    }
    if (typeof value === "number") {
      return value;
    }
    if (typeof value === "string") {
      const number = Number(value);
      if (!Number.isNaN(number)) {
        return number;
      }
    }
    return void 0;
  }
  function sovendusThankyouMain(sovThankyouConfig, onDone) {
    return __async(this, null, function* () {
      const sovThankyouStatus = this.initializeStatus();
      try {
        if (!sovThankyouConfig) {
          sovThankyouStatus.status.sovThankyouConfigFound = false;
          loggerError("sovThankyouConfig is not defined", "ThankyouPage");
          onDone({ sovThankyouStatus, sovThankyouConfig });
          return;
        }
        sovThankyouStatus.status.sovThankyouConfigFound = true;
        yield this.processConfig(sovThankyouConfig, sovThankyouStatus);
        this.handleVoucherNetwork(sovThankyouConfig, sovThankyouStatus);
        yield this.handleCheckoutProductsConversion(
          sovThankyouConfig,
          sovThankyouStatus
        );
        yield this.handleOptimizeConversion(sovThankyouConfig, sovThankyouStatus);
        sovThankyouStatus.times.integrationLoaderDone = this.getPerformanceTime();
        sovThankyouStatus.status.integrationLoaderDone = true;
      } catch (error) {
        loggerError("Error in SovendusThankyouPage.main", "ThankyouPage", error);
      }
      onDone({ sovThankyouConfig, sovThankyouStatus });
    });
  }
  function processConfig(sovThankyouConfig, sovThankyouStatus) {
    return __async(this, null, function* () {
      yield this.handleVoucherCode(sovThankyouConfig);
      this.handleStreet(sovThankyouConfig);
      this.handleCountryCode(sovThankyouConfig, sovThankyouStatus);
      this.handleOrderValue(sovThankyouConfig);
    });
  }
  function handleCountryCode(sovThankyouConfig, sovThankyouStatus) {
    if (sovThankyouConfig.customerData.consumerCountry === "UK") {
      sovThankyouConfig.customerData.consumerCountry = CountryCodes.GB;
    }
    if (!sovThankyouConfig.customerData.consumerCountry) {
      sovThankyouStatus.status.countryCodePassedOnByPlugin = false;
      sovThankyouConfig.customerData.consumerCountry = sovThankyouConfig.customerData.consumerCountry || this.detectCountryCode();
    } else {
      sovThankyouStatus.status.countryCodePassedOnByPlugin = true;
    }
  }
  function handleOptimizeConversion(sovThankyouConfig, sovThankyouStatus) {
    return __async(this, null, function* () {
      var _a;
      const optimizeId = getOptimizeId(
        sovThankyouConfig.settings,
        sovThankyouConfig.customerData.consumerCountry
      );
      if (!optimizeId) {
        return;
      }
      const couponCode = (_a = sovThankyouConfig.orderData.usedCouponCodes) == null ? void 0 : _a[0];
      yield this.handleOptimizeConversionScript(
        optimizeId,
        couponCode,
        sovThankyouConfig,
        sovThankyouStatus
      );
    });
  }
  function handleStreet(sovThankyouConfig) {
    if (sovThankyouConfig.customerData.consumerStreetWithNumber) {
      const [street, streetNumber] = this.splitStreetAndStreetNumber(
        sovThankyouConfig.customerData.consumerStreetWithNumber
      );
      sovThankyouConfig.customerData.consumerStreet = street;
      sovThankyouConfig.customerData.consumerStreetNumber = streetNumber;
    }
  }
  function handleOrderValue(sovThankyouConfig) {
    const orderValueData = sovThankyouConfig.orderData.orderValue;
    if (!orderValueData) {
      return;
    }
    if (orderValueData.netOrderValue) {
      orderValueData.netOrderValue = makeNumber(orderValueData.netOrderValue);
    } else {
      orderValueData.netOrderValue = calculateNetValue(orderValueData);
    }
  }
  function calculateNetValue(orderValueData) {
    const grossOrderValue = makeNumber(orderValueData.grossOrderValue);
    if (typeof grossOrderValue === "undefined") {
      return void 0;
    } else {
      const shippingValue = makeNumber(orderValueData.shippingValue);
      if (typeof shippingValue === "undefined") {
        loggerError(
          "shippingValue is not defined in SovendusThankyouPage.calculateOrderValue",
          "ThankyouPage"
        );
      }
      const taxValue = calculateTaxValue(orderValueData, grossOrderValue);
      return Math.max(0, grossOrderValue - taxValue - (shippingValue || 0));
    }
  }
  function calculateTaxValue(orderValueData, grossOrderValue) {
    const taxValue = makeNumber(orderValueData.taxValue);
    if (typeof taxValue === "undefined") {
      const taxPercent = makeNumber(orderValueData.taxPercent);
      if (typeof taxPercent === "undefined") {
        loggerError(
          "Either taxPercent or taxValue has to be defined in SovendusThankyouPage.calculateOrderValue",
          "ThankyouPage"
        );
      } else {
        return grossOrderValue / (1 + taxPercent / 100) * (taxPercent / 100);
      }
    } else {
      return taxValue;
    }
    return 0;
  }
  function splitStreetAndStreetNumber(street) {
    if (!street) {
      return ["", ""];
    }
    const trimmedStreet = street.trim();
    const apartmentComplexMatch = trimmedStreet.match(
      /^(.*?),\s*(\d+[A-Za-z]?)\s+(.+)$/
    );
    if (apartmentComplexMatch && apartmentComplexMatch[1] && apartmentComplexMatch[2] && apartmentComplexMatch[3]) {
      const apartmentPart = apartmentComplexMatch[1].trim();
      const streetNumber = apartmentComplexMatch[2].trim();
      const streetName = apartmentComplexMatch[3].trim();
      return [`${apartmentPart}, ${streetName}`, streetNumber];
    }
    const angleSaxonMatch = trimmedStreet.match(/^(\d+[A-Za-z]?)\s+(.+)$/);
    if (angleSaxonMatch && angleSaxonMatch[1] && angleSaxonMatch[2]) {
      const streetNumber = angleSaxonMatch[1].trim();
      const streetName = angleSaxonMatch[2].trim();
      if (streetName.split(/\s+/).length >= 2) {
        const possiblePostalCode = streetNumber.match(/^\d{4,5}$/);
        if (possiblePostalCode) {
          return [trimmedStreet, ""];
        }
      }
      return [streetName, streetNumber];
    }
    const europeanMatch = trimmedStreet.match(
      /^(.*?)\s+(\d+(?:[\s/-]*\d*)(?:[A-Za-z])?(?:\s+[A-Za-z])?)$/
    );
    if (europeanMatch && europeanMatch[1] && europeanMatch[2]) {
      const streetName = europeanMatch[1].trim();
      const streetNumber = europeanMatch[2].trim();
      return [streetName, streetNumber];
    }
    return [trimmedStreet, ""];
  }
  function handleVoucherCode(sovThankyouConfig) {
    return __async(this, null, function* () {
      const couponCodes = new Set(
        sovThankyouConfig.orderData.usedCouponCodes
      );
      const couponFromCookie = yield this.getCookie("sovCouponCode");
      if (couponFromCookie) {
        this.clearCookie("sovCouponCode");
        sovThankyouConfig.orderData.usedCouponCodes = [couponFromCookie];
        return;
      }
      if (sovThankyouConfig.orderData.usedCouponCode) {
        couponCodes.add(sovThankyouConfig.orderData.usedCouponCode);
      }
      sovThankyouConfig.orderData.usedCouponCodes = Array.from(couponCodes);
    });
  }
  function initializeStatus() {
    const sovThankyouStatus = {
      integrationScriptVersion,
      status: {
        sovThankyouConfigFound: false,
        integrationLoaderStarted: false,
        integrationParametersLoaded: false,
        checkoutProductsPixelFired: false,
        loadedOptimize: false,
        voucherNetworkLinkTrackingSuccess: false,
        integrationLoaderVnCbStarted: false,
        integrationLoaderDone: false,
        voucherNetworkIframeContainerIdFound: false,
        voucherNetworkIframeContainerFound: false,
        countryCodePassedOnByPlugin: false
      },
      data: {
        orderValue: void 0,
        orderCurrency: void 0,
        orderId: void 0,
        sovCouponCode: void 0,
        sovReqToken: void 0,
        puid: void 0,
        sovDebugLevel: void 0
      },
      times: {
        integrationLoaderStart: this.getPerformanceTime()
      }
    };
    return sovThankyouStatus;
  }
  function handleCheckoutProductsConversion(sovThankyouConfig, sovThankyouStatus) {
    return __async(this, null, function* () {
      const { checkoutProducts } = sovThankyouConfig.settings;
      if (checkoutProducts) {
        const sovReqToken = yield this.getCookie("sovReqToken");
        if (sovReqToken) {
          this.clearCookie("sovReqToken");
          const pixelUrl = `https://press-order-api.sovendus.com/ext/image?sovReqToken=${decodeURIComponent(sovReqToken)}`;
          yield fetch(pixelUrl);
          sovThankyouStatus.status.checkoutProductsPixelFired = true;
        }
      }
      return false;
    });
  }
  function getVoucherNetworkConfig(sovThankyouConfig) {
    var _a, _b, _c, _d, _e, _f;
    if (((_b = (_a = sovThankyouConfig.settings) == null ? void 0 : _a.voucherNetwork) == null ? void 0 : _b.settingType) === SettingsType.SIMPLE) {
      return (_d = (_c = sovThankyouConfig.settings) == null ? void 0 : _c.voucherNetwork) == null ? void 0 : _d.simple;
    }
    if (((_f = (_e = sovThankyouConfig.settings) == null ? void 0 : _e.voucherNetwork) == null ? void 0 : _f.settingType) === SettingsType.COUNTRY) {
      return this.getVoucherNetworkCountryBasedSettings(sovThankyouConfig);
    }
    return void 0;
  }
  function getVoucherNetworkCountryBasedSettings(sovThankyouConfig) {
    var _a, _b, _c, _d, _e, _f, _g, _h, _i;
    const country = sovThankyouConfig.customerData.consumerCountry;
    if (!sovThankyouConfig.customerData.consumerCountry) {
      return void 0;
    }
    const countrySettings = (_d = (_c = (_b = (_a = sovThankyouConfig.settings) == null ? void 0 : _a.voucherNetwork) == null ? void 0 : _b.countries) == null ? void 0 : _c.ids) == null ? void 0 : _d[country];
    const languagesSettings = countrySettings == null ? void 0 : countrySettings.languages;
    if (!languagesSettings) {
      return void 0;
    }
    const languagesAvailable = Object.keys(LANGUAGES_BY_COUNTRIES[country]);
    if ((languagesAvailable == null ? void 0 : languagesAvailable.length) === 1) {
      const language = languagesAvailable[0];
      const languageSettings = languagesSettings[language];
      return __spreadProps(__spreadValues({
        isEnabled: (languageSettings == null ? void 0 : languageSettings.isEnabled) || false,
        trafficSourceNumber: (languageSettings == null ? void 0 : languageSettings.trafficSourceNumber) || "",
        trafficMediumNumber: (languageSettings == null ? void 0 : languageSettings.trafficMediumNumber) || ""
      }, languageSettings), {
        iframeContainerQuerySelector: ((_g = (_f = (_e = sovThankyouConfig.settings) == null ? void 0 : _e.voucherNetwork) == null ? void 0 : _f.countries) == null ? void 0 : _g.iframeContainerQuerySelector) || (languageSettings == null ? void 0 : languageSettings.iframeContainerQuerySelector)
      });
    }
    if ((languagesAvailable == null ? void 0 : languagesAvailable.length) > 1) {
      const languageKey = sovThankyouConfig.customerData.consumerLanguage || this.detectLanguageCode();
      const languageSettings = languageKey && languagesSettings[languageKey];
      if (!languageSettings) {
        return void 0;
      }
      return __spreadProps(__spreadValues({}, languageSettings), {
        iframeContainerQuerySelector: ((_i = (_h = sovThankyouConfig.settings.voucherNetwork) == null ? void 0 : _h.countries) == null ? void 0 : _i.iframeContainerQuerySelector) || (languageSettings == null ? void 0 : languageSettings.iframeContainerQuerySelector)
      });
    }
    return void 0;
  }
  function handleCouponCodes(orderData, trafficSourceNumber) {
    return __async(this, null, function* () {
      var _a;
      const couponCodes = (_a = orderData.usedCouponCodes) == null ? void 0 : _a.slice(1);
      if (couponCodes) {
        yield Promise.all(
          couponCodes.map((coupon) => __async(this, null, function* () {
            var _a2, _b;
            yield sendCouponCode({
              trafficSourceNumber,
              couponCode: coupon,
              orderValue: ((_a2 = orderData.orderValue) == null ? void 0 : _a2.netOrderValue) ? Number((_b = orderData.orderValue) == null ? void 0 : _b.netOrderValue) : void 0,
              orderCurrency: orderData.orderCurrency,
              orderId: orderData.orderId,
              sessionId: orderData.sessionId
            });
          }))
        );
      }
    });
  }
  function sendCouponCode(redemptionData) {
    return __async(this, null, function* () {
      const endpoint = `https://integration-api.sovendus.com/coupon/code-transmitted/${encodeURIComponent(
        btoa(JSON.stringify(redemptionData))
      )}`;
      yield fetch(endpoint, {
        method: "POST",
        body: JSON.stringify(redemptionData)
      });
    });
  }
  const flexibleIframeScriptId = "sovendus-iframe-script";
  function cleanUp() {
    var _a, _b, _c, _d, _e, _f;
    (_b = (_a = window.sovApplication) == null ? void 0 : _a.instances) == null ? void 0 : _b.forEach((instance) => {
      var _a2, _b2, _c2, _d2, _e2, _f2, _g, _h;
      if (instance.isCollapsableOverlay) {
        (_b2 = (_a2 = window.sovApplication) == null ? void 0 : _a2.collapsableOverlay) == null ? void 0 : _b2.closeInstance(instance, false);
        (_d2 = (_c2 = window.sovApplication) == null ? void 0 : _c2.sovCollector) == null ? void 0 : _d2.clearProperties();
      }
      if (instance.isStickyBanner) {
        (_f2 = (_e2 = window.sovApplication) == null ? void 0 : _e2.stickyBanner) == null ? void 0 : _f2.closeInstance(instance);
        (_h = (_g = window.sovApplication) == null ? void 0 : _g.sovCollector) == null ? void 0 : _h.clearProperties();
      }
    });
    if ((_c = window.sovApplication) == null ? void 0 : _c.messageListener) {
      window.removeEventListener(
        "message",
        (_d = window.sovApplication) == null ? void 0 : _d.messageListener,
        true
      );
      window.sovApplication.resizeListenerAdded = false;
    }
    if (window.sovThankyouConfig) {
      delete window.sovThankyouConfig;
    }
    if (window.sovThankyouStatus) {
      delete window.sovThankyouStatus;
    }
    if (window.sovConsumer) {
      delete window.sovConsumer;
    }
    if (window.sovIframes) {
      delete window.sovIframes;
    }
    if (window.sovApplication) {
      delete window.sovApplication;
    }
    (_e = document.getElementById(sovLoaderScriptId)) == null ? void 0 : _e.remove();
    (_f = document.getElementById(flexibleIframeScriptId)) == null ? void 0 : _f.remove();
  }
  class SovendusThankyouPage {
    constructor() {
      __publicField(this, "main", sovendusThankyouMain);
      __publicField(this, "processConfig", processConfig);
      __publicField(this, "handleCountryCode", handleCountryCode);
      __publicField(this, "handleOptimizeConversion", handleOptimizeConversion);
      __publicField(this, "handleStreet", handleStreet);
      __publicField(this, "splitStreetAndStreetNumber", splitStreetAndStreetNumber);
      __publicField(this, "handleVoucherCode", handleVoucherCode);
      __publicField(this, "initializeStatus", initializeStatus);
      __publicField(this, "handleOrderValue", handleOrderValue);
      __publicField(this, "handleCheckoutProductsConversion", handleCheckoutProductsConversion);
      __publicField(this, "getVoucherNetworkConfig", getVoucherNetworkConfig);
      __publicField(this, "getVoucherNetworkCountryBasedSettings", getVoucherNetworkCountryBasedSettings);
      __publicField(this, "getPerformanceTime", getPerformanceTime);
      __publicField(this, "detectCountryCode", detectCountryCode);
    }
    // Is async in case the plugin needs to wait for the script to load
    handleOptimizeConversionScript(optimizeId, couponCode, sovThankyouConfig, sovThankyouStatus) {
      var _a;
      throwErrorInNonBrowserContext({
        methodName: "handleOptimizeConversionScript",
        pageType: "ThankyouPage",
        requiresDocument: true
      });
      const script = document.createElement("script");
      script.type = "text/javascript";
      script.async = true;
      script.src = `https://www.sovopt.com/${optimizeId}/conversion/?ordervalue=${(_a = sovThankyouConfig.orderData.orderValue) == null ? void 0 : _a.netOrderValue}&ordernumber=${sovThankyouConfig.orderData.orderId}&vouchercode=${couponCode}&email=${sovThankyouConfig.customerData.consumerEmail}`;
      document.body.appendChild(script);
      sovThankyouStatus.status.loadedOptimize = true;
    }
    handleVoucherNetwork(sovThankyouConfig, sovThankyouStatus) {
      var _a, _b;
      throwErrorInNonBrowserContext({
        methodName: "handleVoucherNetwork",
        pageType: "ThankyouPage",
        requiresDocument: true,
        requiresWindow: true
      });
      const voucherNetworkConfig = this.getVoucherNetworkConfig(sovThankyouConfig);
      if ((voucherNetworkConfig == null ? void 0 : voucherNetworkConfig.trafficSourceNumber) && (voucherNetworkConfig == null ? void 0 : voucherNetworkConfig.trafficMediumNumber) && (voucherNetworkConfig == null ? void 0 : voucherNetworkConfig.isEnabled)) {
        const iframeContainerId = this.handleSovendusVoucherNetworkDivContainer(
          voucherNetworkConfig,
          sovThankyouConfig,
          sovThankyouStatus
        );
        window.sovIframes = window.sovIframes || [];
        window.sovIframes.push({
          trafficSourceNumber: voucherNetworkConfig.trafficSourceNumber,
          trafficMediumNumber: voucherNetworkConfig.trafficMediumNumber,
          sessionId: sovThankyouConfig.orderData.sessionId,
          orderId: sovThankyouConfig.orderData.orderId,
          orderValue: (_a = sovThankyouConfig.orderData.orderValue) == null ? void 0 : _a.netOrderValue,
          orderCurrency: sovThankyouConfig.orderData.orderCurrency,
          // TODO Handle Coupon Codes in FlexibleIFrame
          // Transmit first Coupon Code and handle all other Coupon Codes in handleCouponCodes()
          usedCouponCode: (_b = sovThankyouConfig.orderData.usedCouponCodes) == null ? void 0 : _b[0],
          iframeContainerId,
          integrationType: sovThankyouConfig.integrationType
        });
        window.sovConsumer = {
          consumerFirstName: sovThankyouConfig.customerData.consumerFirstName,
          consumerLastName: sovThankyouConfig.customerData.consumerLastName,
          consumerEmail: sovThankyouConfig.customerData.consumerEmail,
          consumerStreet: sovThankyouConfig.customerData.consumerStreet,
          consumerStreetNumber: sovThankyouConfig.customerData.consumerStreetNumber,
          consumerZipcode: sovThankyouConfig.customerData.consumerZipcode,
          consumerCity: sovThankyouConfig.customerData.consumerCity,
          consumerCountry: sovThankyouConfig.customerData.consumerCountry,
          consumerPhone: sovThankyouConfig.customerData.consumerPhone,
          consumerDateOfBirth: sovThankyouConfig.customerData.consumerDateOfBirth,
          consumerYearOfBirth: sovThankyouConfig.customerData.consumerYearOfBirth,
          consumerEmailHash: sovThankyouConfig.customerData.consumerEmailHash,
          consumerSalutation: sovThankyouConfig.customerData.consumerSalutation,
          consumerStreetWithNumber: sovThankyouConfig.customerData.consumerStreetWithNumber,
          consumerLanguage: sovThankyouConfig.customerData.consumerLanguage
        };
        const script = document.createElement("script");
        script.type = "text/javascript";
        script.async = true;
        script.id = flexibleIframeScriptId;
        script.src = "https://api.sovendus.com/sovabo/common/js/flexibleIframe.js";
        document.body.appendChild(script);
        void handleCouponCodes(
          sovThankyouConfig.orderData,
          voucherNetworkConfig.trafficSourceNumber
        );
        sovThankyouStatus.status.integrationLoaderVnCbStarted = true;
        sovThankyouStatus.times.integrationLoaderVnCbStart = this.getPerformanceTime();
      }
    }
    handleSovendusVoucherNetworkDivContainer(voucherNetworkConfig, sovThankyouConfig, sovThankyouStatus) {
      throwErrorInNonBrowserContext({
        methodName: "handleSovendusVoucherNetworkDivContainer",
        pageType: "ThankyouPage",
        requiresDocument: true,
        requiresWindow: true
      });
      const iframeContainerSettings = this.getIframeQuerySelector(
        voucherNetworkConfig,
        sovThankyouConfig
      );
      const rootElement = document.querySelector(
        iframeContainerSettings.selector
      );
      if (rootElement) {
        if (iframeContainerSettings.where === "none") {
          return rootElement.id;
        }
        const sovendusDiv = document.createElement("div");
        sovendusDiv.id = "sovendus-container";
        rootElement.insertAdjacentElement(
          iframeContainerSettings.where,
          sovendusDiv
        );
        sovThankyouStatus.status.voucherNetworkIframeContainerFound = true;
        return sovendusDiv.id;
      } else {
        sovThankyouStatus.status.voucherNetworkIframeContainerFound = false;
        loggerError(
          `Voucher Network container query selector ${iframeContainerSettings.selector} not found`,
          "ThankyouPage"
        );
        return "";
      }
    }
    getIframeQuerySelector(voucherNetworkConfig, sovThankyouConfig) {
      if (voucherNetworkConfig.iframeContainerQuerySelector) {
        return voucherNetworkConfig.iframeContainerQuerySelector;
      }
      if (sovThankyouConfig.iframeContainerQuerySelector) {
        return sovThankyouConfig.iframeContainerQuerySelector;
      }
      loggerError(
        "No iframeContainerQuerySelector found in SovendusThankYouPageConfig, trying default",
        "ThankyouPage"
      );
      return defaultIframeContainerQuerySelector;
    }
    // make it async as some platforms might need to wait for the cookies
    getCookie(name) {
      var _a;
      throwErrorInNonBrowserContext({
        methodName: "getCookie",
        pageType: "ThankyouPage",
        requiresDocument: true
      });
      const value = `; ${document.cookie}`;
      const parts = value.split(`; ${name}=`);
      if (parts.length === 2) {
        return (_a = parts.pop()) == null ? void 0 : _a.split(";").shift();
      }
      return void 0;
    }
    clearCookie(name) {
      throwErrorInNonBrowserContext({
        methodName: "clearCookie",
        pageType: "ThankyouPage",
        requiresDocument: true,
        requiresWindow: true
      });
      const path = "/";
      const domain = window.location.hostname;
      const cookieString = `${name}=;secure;samesite=strict;expires=Thu, 01 Jan 1970 00:00:00 UTC;domain=${domain};path=${path}`;
      document.cookie = cookieString;
    }
    detectLanguageCode() {
      var _a;
      throwErrorInNonBrowserContext({
        methodName: "getCookie",
        pageType: "ThankyouPage",
        requiresDocument: true
      });
      const htmlLang = document.documentElement.lang.split("-")[0];
      if (htmlLang) {
        return htmlLang.toUpperCase();
      }
      return (_a = navigator.language.split("-")[0]) == null ? void 0 : _a.toUpperCase();
    }
    unmount() {
      cleanUp();
    }
  }
  function loadSovendusThankyouPage() {
    const OnDone = ({ sovThankyouStatus }) => {
      window.sovThankyouStatus = sovThankyouStatus;
    };
    void new SovendusThankyouPage().main(window.sovThankyouConfig, OnDone);
  }
  loadSovendusThankyouPage();
})();
//# sourceMappingURL=thankyou-page.js.map
