(function() {
  "use strict";
  var __defProp = Object.defineProperty;
  var __defNormalProp = (obj, key, value) => key in obj ? __defProp(obj, key, { enumerable: true, configurable: true, writable: true, value }) : obj[key] = value;
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
  const integrationScriptVersion = "3.11.13";
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
  var SettingsType = /* @__PURE__ */ ((SettingsType2) => {
    SettingsType2["SIMPLE"] = "simple";
    SettingsType2["COUNTRY"] = "country";
    return SettingsType2;
  })(SettingsType || {});
  const sovendusPageApis = {
    // this only gets called when a optimize id is set
    // you don't have to whitelist this domain if you don't want to use Sovendus Optimize
    optimize: "https://www.sovopt.com/"
  };
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
  function unmount() {
    try {
      const optimizeScript = document.getElementById(this.optimizeScriptId);
      if (optimizeScript) {
        optimizeScript.remove();
      }
      if (window.sovPageConfig) {
        delete window.sovPageConfig;
      }
      if (window.sovPageStatus) {
        delete window.sovPageStatus;
      }
      if (window.sovPageInitialized) {
        delete window.sovPageInitialized;
      }
    } catch (error) {
      loggerError("Error during cleanup in unmount:", "LandingPage", error);
    }
  }
  const urlParamAndCookieKeys = [
    // These are the keys that Sovendus uses to store the url params as cookies
    // for simplicity we store all supported url params as cookies
    // as without the url params the cookies would not be set anyway
    // each url param requires separate opt in on Sovendus side, so this is safe to use
    //
    // key only passed on in Switzerland Voucher Network
    "puid",
    // Optional link based conversion tracking for Sovendus Voucher Network
    "sovCouponCode",
    // Key used for Sovendus Checkout Products
    "sovReqToken",
    // used to enable debug mode for the testing process.
    "sovDebugLevel"
  ];
  function sovendusPageMain(sovPageConfig, onDone) {
    return __async(this, null, function* () {
      const sovPageStatus = this.initializeStatus();
      this.processConfig(sovPageConfig, sovPageStatus);
      try {
        if (!sovPageConfig) {
          sovPageStatus.status.sovPageConfigFound = true;
          onDone({ sovPageStatus, sovPageConfig });
          loggerError("sovPageConfig is not defined", "LandingPage");
          return;
        }
        sovPageStatus.urlData = yield this.lookForUrlParamsToStore(sovPageStatus);
        this.sovendusOptimize(sovPageConfig, sovPageStatus);
        sovPageStatus.times.integrationLoaderDone = this.getPerformanceTime();
      } catch (error) {
        loggerError("Crash in SovendusPage.main", "LandingPage", error);
      }
      onDone({ sovPageStatus, sovPageConfig });
    });
  }
  function initializePageStatus() {
    return {
      integrationScriptVersion,
      urlData: {
        sovCouponCode: void 0,
        sovReqToken: void 0,
        puid: void 0,
        sovDebugLevel: void 0
      },
      status: {
        sovPageConfigFound: false,
        loadedOptimize: false,
        storedCookies: false,
        countryCodePassedOnByPlugin: false
      },
      times: {
        integrationLoaderStart: this.getPerformanceTime()
      }
    };
  }
  function getSovendusUrlParameters() {
    return __async(this, null, function* () {
      const pageViewData = {
        sovCouponCode: void 0,
        sovReqToken: void 0,
        puid: void 0,
        sovDebugLevel: void 0
      };
      const urlParams = yield this.getSearchParams();
      urlParamAndCookieKeys.forEach((dataKey) => {
        const paramValue = urlParams == null ? void 0 : urlParams.get(dataKey);
        if (paramValue) {
          if (dataKey === "sovDebugLevel") {
            if (paramValue === "debug" || paramValue === "silent") {
              pageViewData[dataKey] = paramValue;
            }
          } else {
            pageViewData[dataKey] = paramValue;
          }
        }
      });
      return pageViewData;
    });
  }
  function lookForUrlParamsToStore(sovPageStatus) {
    return __async(this, null, function* () {
      try {
        const pageViewData = yield this.getSovendusUrlParameters();
        yield Promise.all(
          Object.entries(pageViewData).map((_0) => __async(this, [_0], function* ([cookieKey, cookieValue]) {
            if (cookieValue) {
              yield this.setCookie(cookieKey, cookieValue);
              sovPageStatus.status.storedCookies = true;
            }
          }))
        );
        return pageViewData;
      } catch (error) {
        loggerError("Error while storing url params", "LandingPage", error);
      }
      return {
        sovCouponCode: void 0,
        sovReqToken: void 0,
        puid: void 0,
        sovDebugLevel: void 0
      };
    });
  }
  function processPageConfig(sovPageConfig, sovPageStatus) {
    this.handleCountryCode(sovPageConfig, sovPageStatus);
  }
  function handlePageCountryCode(sovPageConfig, sovPageStatus) {
    if (sovPageConfig.country === "UK") {
      sovPageConfig.country = CountryCodes.GB;
    }
    if (!sovPageConfig.country) {
      sovPageStatus.status.countryCodePassedOnByPlugin = false;
      sovPageConfig.country = sovPageConfig.country || this.detectCountryCode();
    }
  }
  function sovendusOptimize(sovPageConfig, sovPageStatus) {
    const optimizeId = getOptimizeId(
      sovPageConfig.settings,
      sovPageConfig.country
    );
    if (!optimizeId) {
      return;
    }
    this.handleOptimizeScript(optimizeId, sovPageConfig, sovPageStatus);
    sovPageStatus.status.loadedOptimize = true;
  }
  const optimizeScriptId = "sovendus-optimize-script";
  class SovendusPage {
    constructor() {
      __publicField(this, "urlParamAndCookieKeys", urlParamAndCookieKeys);
      __publicField(this, "main", sovendusPageMain);
      __publicField(this, "initializeStatus", initializePageStatus);
      __publicField(this, "getSovendusUrlParameters", getSovendusUrlParameters);
      __publicField(this, "lookForUrlParamsToStore", lookForUrlParamsToStore);
      __publicField(this, "sovendusOptimize", sovendusOptimize);
      __publicField(this, "optimizeScriptId", optimizeScriptId);
      __publicField(this, "processConfig", processPageConfig);
      __publicField(this, "handleCountryCode", handlePageCountryCode);
      __publicField(this, "getPerformanceTime", getPerformanceTime);
      __publicField(this, "detectCountryCode", detectCountryCode);
      __publicField(this, "unmount", unmount);
    }
    // make it async as some context might require it
    getSearchParams() {
      throwErrorInNonBrowserContext({
        methodName: "getSearchParams",
        pageType: "LandingPage",
        requiresWindow: true
      });
      return new URLSearchParams(window.location.search);
    }
    // make it async as some context might require it
    setCookie(cookieName, value) {
      throwErrorInNonBrowserContext({
        methodName: "setCookie",
        pageType: "LandingPage",
        requiresDocument: true,
        requiresWindow: true
      });
      const path = "/";
      const expireDate = /* @__PURE__ */ new Date();
      expireDate.setTime(expireDate.getTime() + 24 * 60 * 60 * 1e3 * 30);
      const domain = window.location.hostname;
      const cookieString = `${cookieName}=${value};secure;samesite=strict;expires=${expireDate.toUTCString()};domain=${domain};path=${path}`;
      document.cookie = cookieString;
    }
    handleOptimizeScript(optimizeId, _sovPageConfig, _sovPageStatus) {
      throwErrorInNonBrowserContext({
        methodName: "sovendusOptimize",
        pageType: "LandingPage",
        requiresDocument: true
      });
      const script = document.createElement("script");
      script.async = true;
      script.id = this.optimizeScriptId;
      script.type = "application/javascript";
      script.src = `${sovendusPageApis.optimize}${optimizeId}`;
      document.head.appendChild(script);
    }
  }
  function loadSovendusPage() {
    const OnDone = ({ sovPageStatus }) => {
      window.sovPageStatus = sovPageStatus;
    };
    void new SovendusPage().main(window.sovPageConfig, OnDone);
  }
  loadSovendusPage();
})();
//# sourceMappingURL=sovendus-page.js.map
