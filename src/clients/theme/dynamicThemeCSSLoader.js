// @ts-check
// required: /clients/utils.js

const DynamicThemeCSSLoader = (function (_) {
    const lg = log.bindTag(_.tagName);
    const lgv = lg.bindPriority("v");
    const lge = lg.bindPriority("e");

    /**
        @typedef {`dark`|`light`} ThemeMode
        @typedef {`high`|`medium`|`normal`} ThemeContrast
        @typedef {`--theme-preview--primary-${ThemeMode}${``|`__${`high-contrast`|`medium-contrast`}`}`} ThemeMetaProperties
        @typedef {{
            meta?: CSSStyleRule;
            metaToMigrated?: {
                [property in ThemeMetaProperties]?: CSSStyleValue;
            };
        } & {
            [o in ThemeMode]: {
                [c in ThemeContrast]?: CSSStyleRule;
            };
        }} ThemeGroups;
     */

    function appendMediaRule(/** @type {ThemeGroups} */ theme,
        /** @type {ThemeMode} */ mode, /** @type {ThemeContrast} */ contrast,
        /** @type {CSSGroupingRule} */ mediaRule, /** @type {string} */ selector) {
        const rule = theme[mode][contrast];
        if (!rule) return;
        const rules = mediaRule.cssRules;
        const index = mediaRule.insertRule(rule.cssText, rules.length);
        /** @type {CSSStyleRule} */ (rules[index]).selectorText = selector;
    }

    function appendThemeMediaRule(/** @type {ThemeGroups} */ theme,
        /** @type {ThemeMode} */ mode, /** @type {CSSStyleSheet} */ styleSheet) {
        const rules = styleSheet.cssRules;
        const index = styleSheet.insertRule(`@media (prefers-color-scheme: ${mode}) {}`, rules.length);
        const rule = /** @type {CSSMediaRule} */ (rules[index]);
        appendMediaRule(theme, mode, "high", rule, `[mdc-theme="system highContrast"]`);
        appendMediaRule(theme, mode, "medium", rule, `[mdc-theme="system mediumContrast"]`);
        appendMediaRule(theme, mode, "normal", rule, `[mdc-theme="system"]`);
    }

    function storeThemeMeta(/** @type {ThemeGroups} */ theme,
        /** @type {CSSStyleRule} */ rule) {
        theme.meta = rule;
        const metaToMigrated = theme.metaToMigrated;
        if (!metaToMigrated) return;
        for (const key in metaToMigrated) {
            const value = metaToMigrated[key];
            if (value) rule.styleMap.set(key, value);
        }
        delete theme.metaToMigrated;
    }

    function storeTheme(/** @type {ThemeGroups} */ theme,
        /** @type {ThemeMode} */ mode, /** @type {ThemeContrast} */ contrast,
        /** @type {string} */ prop, /** @type {CSSStyleRule} */ element) {
        theme[mode][contrast] = element;
        const value = element.styleMap.get("--mdc-primary");
        if (!value) return;
        const themeMeta = theme.meta;
        if (!themeMeta) {
            let metaToMigrated = theme.metaToMigrated;
            if (!metaToMigrated) theme.metaToMigrated =
                metaToMigrated = {};
            metaToMigrated[prop] = value;
        } else themeMeta.styleMap.set(prop, value);
    }

    function loadTheme(/** @type {string} */ name) {
        const loader = _.dynamicThemeCSSLoader;
        const contentToRollback = loader.textContent;
        const sheet = loader.sheet;
        if (!sheet) {
            lge(`html>head>link[rel=stylesheet]#${loader.id} tag is required!`);
            loader.textContent = contentToRollback;
            return false;
        }

        const rules = sheet.cssRules;
        loader.textContent = ``;
        const importedSheet = /** @type {CSSImportRule} */ (rules[sheet.insertRule(
            `@import url("/clients/css/theme/${name}.css");`, rules.length)]).styleSheet;
        if (!importedSheet) {
            lge(`"${name}" theme not found!`);
            loader.textContent = contentToRollback;
            return false;
        }

        const importedRules = importedSheet.cssRules;
        lgv(`<begin function>`);
        /** @type {ThemeGroups} */
        const theme = {
            dark: {},
            light: {}
        };

        /** @type {{ [selector in `[mdc-theme${``|`="${ThemeMode}${``|` ${"highContrast"|"mediumContrast"}`}"`}]`]: (element: CSSStyleRule) => void; }} */
        const themeMapping = {
            '[mdc-theme]': storeThemeMeta.bind(this, theme),
            '[mdc-theme="dark"]': storeTheme.bind(this, theme, "dark", "normal", "--theme-preview--primary-dark"),
            '[mdc-theme="light"]': storeTheme.bind(this, theme, "light", "normal", "--theme-preview--primary-light"),
            '[mdc-theme="dark highContrast"]': storeTheme.bind(this, theme, "dark", "high", "--theme-preview--primary-dark__high-contrast"),
            '[mdc-theme="light highContrast"]': storeTheme.bind(this, theme, "light", "high", "--theme-preview--primary-light__high-contrast"),
            '[mdc-theme="dark mediumContrast"]': storeTheme.bind(this, theme, "dark", "medium", "--theme-preview--primary-dark__medium-contrast"),
            '[mdc-theme="light mediumContrast"]': storeTheme.bind(this, theme, "light", "medium", "--theme-preview--primary-light__medium-contrast")
        };

        for (let i = 0; i < importedRules.length; i++) {
            const element = /** @type {CSSStyleRule} */ (importedRules[i]);
            if (Object.getPrototypeOf(element) !== CSSStyleRule.prototype) continue;
            const mapping = /** @type {((element: CSSStyleRule) => void) | undefined} */ (themeMapping[element.selectorText]);
            if (mapping) mapping(element);
        }

        appendThemeMediaRule(theme, "dark", sheet);
        appendThemeMediaRule(theme, "light", sheet);
        lgv(`<end function>`);
        return true;
    }

    function theme(/** @type {string?} */ name) {
        const key = _.tagName + ".dynamicThemeName";
        let old = localStorage.getItem(key);
        if (!old) {
            old = _.defaultThemeName;
            name ||= old;
        }

        if (name && loadTheme(name))
            localStorage.setItem(key, name);
        return old;
    };

    loadTheme(theme());

    return {
        theme,
        [Symbol.toStringTag]() { return _.tagName; }
    };
})({
    defaultThemeName: "mdc1",
    dynamicThemeCSSLoader: document.head.appendChild((() => {
        let style = document.createElement("style");
        style.id = "dynamicThemeCSSLoader";
        return style;
    })()),
    tagName: "clients.theme.dynamicThemeCSSLoader.js:DynamicThemeCSSLoader"
});