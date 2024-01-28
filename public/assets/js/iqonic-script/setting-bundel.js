/*-----------------------------
 * Functions
 * - init
 * - reInit
 * - destroy
 * - storageGet
 * - storageSet
 * - storageRemove
 * - UpdateOption
 * - setSettingOption
 * - UpdateOptionFromStorage
 * - CustomEvent for updateOption
 * - CustomEvent for updateOptionFromStorage
 * - setDefault option Soon
 * - addClass
 * - removeClass
 * - toggleClass
 * - observeStorage:  https://developer.mozilla.org/en-US/docs/Web/API/Window/storage_event
-----------------------------*/

/*************************
 * Lodash functions use
 * https://lodash.com/docs/4.17.15#functions
 *  function list:
    - _.keys
    - _.has
    - _.findKey
    - _.find
    - _.forEach
    - _.isObject
    - _.isArray
    - _.isString
 * ***********************/

/****** Incomplete Points
 * Color Customizer with color pallet & Custom Color
 * Font Family by root variables
 * FOOTER FIXED
 - position: STICKY;
 - bottom: 0;
 * ***/
 (function (window) {
  // Listners for Customizer

  const selectors = {
    radio: document.querySelectorAll('[data-setting="radio"]'),
    checkbox: document.querySelectorAll('[data-setting="checkbox"]'),
    attribute: document.querySelectorAll('[data-setting="attribute"]'),
    style: document.querySelectorAll('[data-setting="style"]'),
    input: document.querySelectorAll('[data-setting="input"]'),
    select: document.querySelectorAll('[data-setting="select"]'),
    color: document.querySelectorAll('[data-setting="color"]'),
  };

  /**************************************************************************
   * Default Object for setting Start
   * **********************************************************************/

  const defaults = defaultSetting();

  function defaultSetting() {
    return {
      saveLocal: "", // sessionStorage, localStorage, null
      storeKey: "",
      setting: defaultSettingOption(),
      beforeInit: function (cb) {
        return cb;
      },
      afterInit: function (cb) {
        return cb;
      },
    };
  }

  function defaultSettingOption() {
    return {
      app_name: {
        target: '[data-setting="app_name"]',
        type: "text",
        value: "Hope UI",
      },
      theme_scheme_direction: {
        target: "html",
        choices: ["ltr", "rtl"],
        value: "ltr",
      },
      theme_scheme: {
        target: "body",
        choices: ["light", "dark", "auto"],
        value: "light",
      },
      theme_style_appearance: {
        target: "body",
        choices: [
          "theme-default",
          "theme-flat",
          "theme-bordered",
          "theme-sharp",
        ],
        value: ["theme-default"],
      },
      theme_color: {
        target: "body",
        choices: [
          "theme-color-blue",
          "theme-color-gray",
          "theme-color-red",
          "theme-color-yellow",
          "theme-color-pink",
          "theme-color-default",
        ],
        type: "variable",
        colors: {
          "--{{prefix}}primary": "#3a57e8",
          "--{{prefix}}info": "#08B1BA",
        },
        value: "theme-color-default",
      },
      theme_transition: {
        target: "body",
        choices: ["theme-without-animation", "theme-with-animation"],
        value: "theme-with-animation",
      },
      theme_font_size: {
        target: "html",
        choices: ["theme-fs-sm", "theme-fs-md", "theme-fs-lg"],
        value: "theme-fs-md",
      },
      page_layout: {
        target: "#page_layout",
        choices: ["container", "container-fluid"],
        value: "container-fluid",
      },
      header_navbar: {
        target: ".iq-navbar",
        choices: [
          "default",
          "fixed",
          "navs-sticky",
          "nav-glass",
          "navs-transparent",
          "boxed",
          "hidden",
        ],
        value: "default",
      },
      header_banner: {
        target: ".iq-banner",
        choices: ["default", "navs-bg-color", "hide"],
        value: "default",
      },
      card_color: {
        target: "body",
        choices: [
          "card-default",
          "card-glass",
          "card-transparent",
        ],
        value: "card-default",
      },
      sidebar_color: {
        target: '[data-toggle="main-sidebar"]',
        choices: [
          "sidebar-white",
          "sidebar-dark",
          "sidebar-color",
          "sidebar-transparent",
        ],
        value: "sidebar-white",
      },
      sidebar_type: {
        target: '[data-toggle="main-sidebar"]',
        choices: ["sidebar-hover", "sidebar-mini", "sidebar-boxed", "sidebar-soft"],
        value: [],
      },
      sidebar_menu_style: {
        target: '[data-toggle="main-sidebar"]',
        choices: [
          "navs-rounded",
          "navs-rounded-all",
          "navs-pill",
          "navs-pill-all",
          "navs-rounded-all",
          "navs-full-width",
        ],
        value: "navs-rounded-all",
      },
      footer: {
        target: ".footer",
        choices: ["sticky", "default"],
        value: "default",
      },
      body_font_family: {
        target: "body",
        type: "variable",
        value: "Inter",
      },
      heading_font_family: {
        target: "heading",
        type: "variable",
        value: "Inter",
      },
    };
  }

  /**************************************************************************
   * Default Object for setting End
   * **********************************************************************/

  // Main function
  this.IQSetting = function (opt) {
    this.options = {};

    this.arg = opt;

    this.extend(defaults);

    if (typeof this.options.saveLocal !== typeof null && this.options.saveLocal !== '') {
      // IQUtils.removeSessionStorage(this.options.storeKey);
      // IQUtils.removeLocalStorage(this.options.storeKey);
      this.getStorageValue(this.options.storeKey);
    }

    this.updateOptionFromStorage();

    if (_.isFunction(this.options.beforeInit)) {
      this.options.beforeInit(this);
    }

    this.init();

    if (_.isFunction(this.options.afterInit)) {
      this.options.afterInit(this);
    }

    return this;
  };

  /**************************************************************************
   * Initialize Functions Start
   * **********************************************************************/

  // extend object function to the IQSetting prototype
  IQSetting.prototype.extend = function (defaults) {
    // Create options by extending defaults with the passed in arugments
    if (this.arg && _.isObject(this.arg)) {
      this.options = IQUtils.mergeDeep(defaults, this.arg);
    } else {
      this.options = defaults;
    }
  };

  // Function call by parameter to the IQSetting prototype
  IQSetting.prototype.fnCall = function (
    key,
    value = this.getSettingKey(key).value
  ) {
    if (_.isString(key)) {
      if (
        this.__proto__.hasOwnProperty(key) &&
        _.isFunction(this.__proto__[key])
      ) {
        this.__proto__[key].call(this, value);
      }
    }
  };

  // Init function to the IQSetting prototype
  IQSetting.prototype.init = function () {
    const keys = _.keys(this.options.setting);
    _.forEach(keys, (key) => {
      this.fnCall(key);
    });

    this.saveOption();
  };

  // reInit function to the IQSetting prototype
  IQSetting.prototype.reInit = function () {
    this.destroy();
    this.extend(defaultSetting());
    this.saveLocal(this.options.saveLocal);
    this.init();
    this.afterUpdate("reinit", this.options);
    this.resetFontFamily();
  };

  // After Update function to the IQSetting Prototype
  IQSetting.prototype.afterUpdate = function (
    key,
    value,
    currentValue = ''
  ) {
    const event = new CustomEvent(key, { detail: {value: value, name: key, currentValue: currentValue }});
    document.dispatchEvent(event);
    this.saveOption();
  };

  // Destroy function to the IQSetting prototype
  IQSetting.prototype.destroy = function () {
    this.removeOption();
  };
  /**************************************************************************
   * Initialize Functions End
   * **********************************************************************/

  /**************************************************************************
   * Get Value Functions Start
   * **********************************************************************/

  // Update option key values to the IQSetting
  IQSetting.prototype.setMainOption = function (key, value) {
    this.options[key] = value;
  };

  // get setting options function to the IQSetting prototype
  IQSetting.prototype.getSettingOptions = function () {
    return this.options.settings;
  };

  // get Setting key function to the IQSetting prototype
  IQSetting.prototype.getSettingKey = function (key) {
    return this.options.setting[key];
  };

  // Update option setting key values to the IQSetting
  IQSetting.prototype.setSettingOption = function (key, value, manual) {
    if (manual) {
      this.options.setting[key].value = value;
    }
  };

  // Update theme color custom choise object to the IQSetting
  this.IQSetting.prototype.setSettingColorChoice = function (key, pair) {
    this.options.setting[key].colors[pair.key] = pair.value;
  };

  // get option json function to the IQSetting prototype
  IQSetting.prototype.getSettingJson = function () {
    const self = this;
    const json = {};
    Object.keys(self.options).forEach(function (key) {
      if (key !== "afterInit" && key !== "beforeInit") {
        json[key] = self.options[key];
        if (key === "setting") {
          Object.keys(json[key]).forEach(function (subKey) {
            delete json[key][subKey].target;
            delete json[key][subKey].type;
            delete json[key][subKey].choices;
          });
        }
      }
    });
    this.options = IQUtils.mergeDeep(defaults, json);
    return JSON.stringify(json, null, 4);
  };

  // Static method to get the instance of the IQSetting
  IQSetting.getInstance = function () {
    if (!IQSetting.instance) {
      IQSetting.instance = new IQSetting();
    }
    return IQSetting.instance;
  };

  /**************************************************************************
   * Get Value Functions End
   * **********************************************************************/

  /**************************************************************************
   * Storage get & update Functions Start
   * **********************************************************************/

  // function for save option in localStorage or sessionStorage based on options
  IQSetting.prototype.saveOption = function () {
    const key = this.options.storeKey;
    const value = this.options;
    IQUtils.removeSessionStorage(key);
    IQUtils.removeLocalStorage(key);
    switch (this.options.saveLocal) {
      case "localStorage":
        return IQUtils.saveLocalStorage(key, JSON.stringify(value));
        break;

      case "sessionStorage":
        return IQUtils.saveSessionStorage(key, JSON.stringify(value));
        break;

      default:
        break;
    }
  };

  // function for get option in localStorage or sessionStorage based on options
  IQSetting.prototype.getOption = function (storage) {
    const key = this.options.storeKey;
    switch (storage) {
      case "localStorage":
        return IQUtils.getLocalStorage(key);
        break;

      case "sessionStorage":
        return IQUtils.getSessionStorage(key);
        break;

      default:
        break;
    }
  };

  // function for remove option to localStorage or sessionStorage based on options
  IQSetting.prototype.removeOption = function () {
    const key = this.options.storeKey;
    switch (this.options.saveLocal) {
      case "localStorage":
        IQUtils.removeLocalStorage(key);
        break;

      case "sessionStorage":
        IQUtils.removeSessionStorage(key);
        break;

      default:
        break;
    }
  };

  // function for update option from localStorage or sessionStorage based on options
  IQSetting.prototype.updateOptionFromStorage = function () {
    const key = this.options.storeKey;
    switch (this.options.saveLocal) {
      case "localStorage":
        const localValue = IQUtils.getLocalStorage(key);
        if (localValue) {
          this.options = JSON.parse(localValue);
        }
        break;

      case "sessionStorage":
        const sessionValue = IQUtils.getSessionStorage(key);
        if (sessionValue) {
          this.options = JSON.parse(sessionValue);
        }
        break;

      default:
        this.removeOption();
        break;
    }
  };

  // function for get storage value if exists
  IQSetting.prototype.getStorageValue = function (key) {
    const checkKey = IQUtils.checkStorageArray(key, [
      "localStorage",
      "sessionStorage",
    ]);
    if (!checkKey.result) {
      this.options = JSON.parse(this.getOption(checkKey.storage));
      IQUtils.getElems(`input[name="saveLocal"]`).forEach(function (el) {
        el.checked = false;
        if (el.value === checkKey.storage) {
          el.checked = true;
        }
      });
    }
  };

  /**************************************************************************
   * Storage get & update Functions End
   * **********************************************************************/

  /**************************************************************************
   * Input Update Functions Start
   * **********************************************************************/

  // Input radio input manually change function to the IQSetting prototype
  IQSetting.prototype.__radioInputChange__ = function (key) {
    const obj = this.getSettingKey(key);
    IQUtils.getElems(`input[name="${key}"]`).forEach(function (el) {
      el.checked = false;
      if (el.value === obj.value) {
        el.checked = true;
      }
    });
  };
  // Input checkbox input manually change function to the IQSetting prototype
  IQSetting.prototype.__checkboxInputChange__ = function (key) {
    const obj = this.getSettingKey(key);
    IQUtils.getElems(`input[name="${key}"]`).forEach(function (el) {
      el.checked = false;
      if (obj.value.indexOf(el.value) !== -1) {
        el.checked = true;
      }
    });
  };
  // Input manually change function to the IQSetting prototype
  IQSetting.prototype.__inputChange__ = function (key, value) {
    IQUtils.getElems(`input[name="${key}"]`).forEach(function (el) {
      el.value = value;
    });
  };
  // Select input update manually change function to the IQSetting prototype
  IQSetting.prototype.__selectInputChange__ = function (key) {
    const obj = this.getSettingKey(key);
    IQUtils.getElems(`select[name="${key}"]`).forEach(function (el) {
      el.value = obj.value;
    });
    if(typeof $ !== typeof undefined) {
      $(`[data-select="font"][name="${key}"]`).val(obj.value).trigger("change");
    }
  };

  /**************************************************************************
   * Input Update Functions End
   * **********************************************************************/

  /**************************************************************************
   * Dom & Object Update Functions Start
   * IQSetting.options update functions saveLocal, setting:key, value etc...
   * **********************************************************************/

  // radio update function to the IQSetting prototype
  IQSetting.prototype.__radioUpdate__ = function (key, value, cb) {
    const obj = this.getSettingKey(key);
    if (value !== null) {
      obj.value = value;
      this.setSettingOption(key, value);
    }
    if (obj.target !== null) {
      obj.choices.forEach((other) => {
        IQUtils.removeClass(obj.target, other);
      });
      IQUtils.addClass(obj.target, value);
    }
    this.__radioInputChange__(key);
    if (_.isFunction(cb)) {
      cb(key, value, obj);
    }
    this.afterUpdate(key, value);
  };

  // style update function to the IQSetting prototype
  IQSetting.prototype.__styleUpdate__ = function (
    key,
    pair = { prop: "", value: "value" },
    cb
  ) {
    const obj = this.getSettingKey(key);
    if (pair.value !== null) {
      obj.value = pair.value;
      this.setSettingOption(key, pair.value);
    }
    if (obj.target !== null) {
      IQUtils.setStyle(obj.target, pair);
    }
    this.__radioInputChange__(key);
    if (_.isFunction(cb)) {
      cb(key, pair.value);
    }
    this.afterUpdate(key, pair);
  };

  // attribute update function to the IQSetting prototype
  IQSetting.prototype.__attributeUpdate__ = function (
    key,
    pair = { prop: "color", value: "value" },
    cb
  ) {
    const obj = this.getSettingKey(key);
    if (pair.value !== null) {
      obj.value = pair.value;
      this.setSettingOption(key, pair.value);
    }
    if (obj.target !== null) {
      IQUtils.setAttr(obj.target, pair);
    }
    this.__radioInputChange__(key);
    if (_.isFunction(cb)) {
      cb(key, pair.value);
    }
    this.afterUpdate(key, pair);
  };

  // checkbox update function to the IQSetting Prototype
  IQSetting.prototype.__checkboxUpdate__ = function (key, value, currentValue, cb) {
    const obj = this.getSettingKey(key);
    if (value !== null) {
      obj.value = value;
      this.setSettingOption(key, value);
    }
    if (obj.target !== null) {
      obj.choices.forEach((other) => {
        IQUtils.removeClass(obj.target, other);
      });
      if (obj.value.length) {
        obj.value.forEach((objValue) => {
          IQUtils.addClass(obj.target, objValue);
        });
      }
    }
    this.__checkboxInputChange__(key);
    if (_.isFunction(cb)) {
      cb(key, value);
    }
    this.afterUpdate(key, value, currentValue);
  };

  // input update function to the IQSetting Prototype
  IQSetting.prototype.__inputUpdate__ = function (key, value, cb) {
    const obj = this.getSettingKey(key);
    if (value !== null) {
      obj.value = value;
      this.setSettingOption(key, value);
    }
    if (obj.target !== null) {
      IQUtils.setContent(obj.target, value.substr(0, 10));
    }
    this.__inputChange__(key, value);
    if (_.isFunction(cb)) {
      cb(key, value);
    }
    this.afterUpdate(key, value);
  };

  // Update theme color & custom color to the IQSetting Prototype
  IQSetting.prototype.__updateThemeColor__ = function (key, value) {
    const obj = this.getSettingKey(key);
    if (value !== null) {
      obj.value = value;
      this.setSettingOption(key, value);
    }
    if (obj.target !== null) {
      obj.choices.forEach((other) => {
        IQUtils.removeClass(obj.target, other);
      });
      if (obj.value !== "custom") {
        this.resetColor(key);
      }
      if (!_.isObject(obj.value)) {
        _.forEach(obj.colors, (value, index) => {
          if (
            IQUtils.getElem(
              `[data-extra="${index.replace("--{{prefix}}", "")}"]`
            ) !== null
          ) {
            IQUtils.getElem(
              `[data-extra="${index.replace("--{{prefix}}", "")}"]`
            ).value = value;
          }
          this.setSettingColorChoice(key, {
            key: index,
            value: value,
          });
        });
        let prefix = IQUtils.getRootVars("--prefix") || "bs-";
        let newColors = {};
        const theme_scheme = this.getSettingKey('theme_scheme');
        let dark = false
        if(theme_scheme.value !== 'light') {
          dark = true
        }
        _.forEach(obj.colors, (value, key) => {
          key = key.replace("{{prefix}}", prefix);
          newColors = {
            ...newColors,
            ...IQUtils.getColorShadeTint(key, value),
          };
        });
        IQUtils.setRootVariables(newColors);
        IQUtils.addClass("body", obj.value);
        switch (obj.type) {
          case "default":
            _.forEach(obj.colors, (value, key) => {
              key = key.replace("{{prefix}}", prefix);
              newColors = {
                ...newColors,
                ...IQUtils.getColorShadeTint(key, value),
              };
            });
            IQUtils.removeClass("body", obj.value);
            IQUtils.removeRootVariables(newColors);
            break;

          default:
            break;
        }
      }
    }
    this.__radioInputChange__(key);
    this.afterUpdate(key, value);
  };

  this.IQSetting.prototype.resetColor = function (key) {
    const choices = defaults.setting.theme_color.choices.find(
      (x) => x.name == "custom"
    );
    if (choices !== undefined) {
      _.forEach(defaults.setting.theme_color.colors, (value, index) => {
        this.setSettingColorChoice(key, {
          key: index,
          value: value,
        });
      });
    }
  };

  // Update font function to the IQSetting Prototype
  IQSetting.prototype.__selectUpdate__ = function (key, value) {
    const obj = this.getSettingKey(key);
    if (value !== null) {
      obj.value = value;
      this.setSettingOption(key, value);
    }
    if (obj.target !== null) {
      IQUtils.setFontFamily(value, obj.target);
    }
    this.__selectInputChange__(key);
    this.afterUpdate(key, value);
  };

  // Update option function to the IQSetting Prototype
  IQSetting.prototype.__updateOption__ = function (key, value) {
    this.setMainOption(key, value);
    this.saveOption();
    this.updateOptionFromStorage();
  };

  /**************************************************************************
   * Dom & Object Update Functions End
   * **********************************************************************/

  // Reset Font Family Functions Start
  IQSetting.prototype.resetFontFamily = function () {
    document.querySelectorAll('[data-font-body="google"]').forEach((el) => {
      el.remove();
    });
    document.querySelectorAll('[data-font-heading="google"]').forEach((el) => {
      el.remove();
    });
    let prefix =
      getComputedStyle(document.body).getPropertyValue("--prefix") || "bs-";
    if (prefix) {
      prefix = prefix.trim();
    }
    const bodyFamily = '"Inter", sans-serif';
    const headingFamily = '"Inter", sans-serif';
    if(typeof $ !== typeof undefined) {
      $(`[data-select="font"]`).select2("destroy").select2();
    }
    document.documentElement.style.setProperty(
      `--${prefix}body-font-family`,
      bodyFamily
    );
    document.documentElement.style.setProperty(
      `--${prefix}heading-font-family`,
      headingFamily
    );
    this.setSettingOption("body_font_family", "Inter", true);
    this.setSettingOption("heading_font_family", "Inter", true);
    this.__selectInputChange__("body_font_family", bodyFamily);
    this.__selectInputChange__("heading_font_family", headingFamily);
  };

  // 0. Set app name function to the IQSetting prototype @param {string} appName
  IQSetting.prototype.app_name = function (value) {
    if (typeof value !== typeof null) {
      this.__inputUpdate__("app_name", value);
    }
  };

  // 1. theme_scheme function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.theme_scheme = function (value) {
    if (typeof value !== typeof null) {
      this.__radioUpdate__("theme_scheme", value, function () {
        if (value == "auto") {
          if (matchMedia("(prefers-color-scheme: light)").matches) {
            document.querySelector("body").classList.add("light");
          } else {
            document.querySelector("body").classList.add("dark");
          }
        }
        this.__updateThemeColor__("theme_color", null);
      });
    }
  };

  // 2. theme_scheme_direction function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.theme_scheme_direction = function (value) {
    if (typeof value !== typeof null) {
      const __this = this;
      this.__attributeUpdate__(
        "theme_scheme_direction",
        { prop: "dir", value: value },
        function (key, val) {
          __this.rtlChange(val == "rtl" ? true : false);
          if(typeof $ !== typeof undefined) {
            if ($(`[data-select="font"]`).data("select2")) {
              $(`[data-select="font"]`).select2("destroy").select2();
            }
          }
        }
      );
    }
  };

  // 3. theme_style_appearance function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.theme_style_appearance = function (value, currentValue) {
    if (value !== null) {
      this.__checkboxUpdate__("theme_style_appearance", value, currentValue);
    }
  };

  // 4. theme_color function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.theme_color = function (value) {
    if (typeof value !== typeof null) {
      this.__updateThemeColor__("theme_color", value);
    }
  };

  // 5. theme_transition function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.theme_transition = function (value) {
    if (typeof value !== typeof null) {
      this.__radioUpdate__("theme_transition", value);
    }
  };

  // 6. theme_font_size function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.theme_font_size = function (value) {
    if (typeof value !== typeof null) {
      this.__radioUpdate__("theme_font_size", value);
    }
  };

  // 7. page_layout function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.page_layout = function (value) {
    if (typeof value !== typeof null) {
      this.__radioUpdate__("page_layout", value);
    }
  };

  // 8. header_navbar function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.header_navbar = function (value) {
    if (typeof value !== typeof null) {
      this.__radioUpdate__("header_navbar", value);
    }
  };

  // 9. header_banner function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.header_banner = function (value) {
    if (typeof value !== typeof null) {
      this.__radioUpdate__("header_banner", value);
    }
  };

  // 10. sidebar_color function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.sidebar_color = function (value) {
    if (typeof value !== typeof null) {
      this.__radioUpdate__("sidebar_color", value);
    }
  };

  // 11. sidebar_type function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.sidebar_type = function (value, currentValue) {
    if (value !== null) {
      this.__checkboxUpdate__("sidebar_type", value, currentValue);
    }
  };

  // 12. sidebar_menu_style function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.sidebar_menu_style = function (value) {
    if (typeof value !== typeof null) {
      this.__radioUpdate__("sidebar_menu_style", value);
    }
  };

  // 13. footer function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.footer = function (value) {
    if (typeof value !== typeof null) {
      this.__radioUpdate__("footer", value);
    }
  };

  // 14. footer function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.body_font_family = function (value = null) {
    if (typeof value != typeof null && value != '' && value != 'null') {
      this.__selectUpdate__("body_font_family", value);
    }
  };

  // 15. footer function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.heading_font_family = function (value = null) {
    if (typeof value != typeof null && value != '' && value != 'null') {
      this.__selectUpdate__("heading_font_family", value);
    }
  };

  // 16. card_color function to the IQSetting prototype @params: value (string)
  IQSetting.prototype.card_color = function (value) {
    if (typeof value !== typeof null) {
      console.log(value)
      this.__radioUpdate__("card_color", value);
    }
  };

  // saveLocal function to the IQSetting prototype value (string)
  IQSetting.prototype.saveLocal = function (value = null) {
    if (value !== null) {
      this.__updateOption__("saveLocal", value);
    }
  };

  /**************************************************************************
   * Additional Functions Start
   * **********************************************************************/
  // Rtl Change to Offcanvas left to right Static Function
  IQSetting.prototype.rtlChange = function (check) {
    IQUtils.addClass(".offcanvas-start", "on-rtl", "start");
    IQUtils.addClass(".offcanvas-end", "on-rtl", "end");
    if (check) {
      IQUtils.addClass(".on-rtl.start", "offcanvas-end");
      IQUtils.removeClass(".on-rtl.start", "offcanvas-start");
      IQUtils.addClass(".on-rtl.end", "offcanvas-start");
      IQUtils.removeClass(".on-rtl.end", "offcanvas-end");
    } else {
      IQUtils.addClass(".on-rtl.start", "offcanvas-start");
      IQUtils.removeClass(".on-rtl.start", "offcanvas-end");
      IQUtils.addClass(".on-rtl.end", "offcanvas-end");
      IQUtils.removeClass(".on-rtl.end", "offcanvas-start");
    }
  };
  /**************************************************************************
   * Additional Functions End
   * **********************************************************************/

  // Export the IQSetting
  window.IQSetting = this.IQSetting;

  // reset font color
  const resetFont = document.querySelector('[data-reset="body-heading-font"]');
  if (resetFont !== null) {
    resetFont.addEventListener("click", (e) => {
      e.preventDefault();
      this.IQSetting.setSettingOption("body_font_family", "Inter", true);
      this.IQSetting.setSettingOption("heading_font_family", "Inter", true);
      this.IQSetting.resetFontFamily();
    });
  }

  return window.IQSetting;
})(window);
