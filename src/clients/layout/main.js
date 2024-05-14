// @ts-check

const ScrimBack = ((_) => {
    const disposes = /** @type {(() => void)[]} */ ([]);
    const handler = /** @type {((this: HTMLElement, e: MouseEvent) => any)[]} */([]);
    /** @this {Window} @param {Event} e */
    function onLoadLayout(e) {
        const scrim = /** @type {NodeListOf<HTMLElement>} */
            (document.querySelectorAll("scrim"));

        /** @this {HTMLElement} @param {MouseEvent} e */
        function onBack(e) {
            if (!handler.length) e.preventDefault();
            for (const back of handler) {
                back && Object.getPrototypeOf(back) === Function.prototype && back.call(this, e);
            }
        }

        function disposeScrim() {
            for (const value of scrim)
                value.removeEventListener("click", onBack);
        }

        for (const value of scrim)
            value.addEventListener("click", onBack);
        disposes.push(disposeScrim);
    }

    /** @this {Window} @param {Event} e */
    function onDispose(e) {
        disposes.forEach(dispose => dispose());
        window.removeEventListener("load", onLoadLayout);
        window.removeEventListener("unload", onDispose);
    }

    window.addEventListener("load", onLoadLayout);
    window.addEventListener("unload", onDispose);

    return {
        handler,
        get [Symbol.toStringTag]() { return _.tagName; }
    }
})({
    tagName: "clients.layout.main.js:ScrimBack"
})

const MainLayout = ((_) => {
    const disposes = /** @type {(() => void)[]} */ ([]);

    /** @this {Window} @param {Event} e */
    function onLoadLayout(e) {
        disposes.push((function () {
            const search = /** @type {NodeListOf<HTMLAnchorElement>} */
                (document.querySelectorAll("nav>a.nav-item.-search._action"));

            /** @this {HTMLAnchorElement} @param {MouseEvent} e */
            function onSearch(e) {
                const onSearch = MainLayout.onSearch;
                if (!onSearch.length) e.preventDefault();
                for (const value of onSearch)
                    value.call(this, e);
            }

            for (const value of search)
                value.addEventListener("click", onSearch);

            return function () {
                for (const value of search)
                    value.removeEventListener("click", onSearch);
            }
        })());
        disposes.push((function () {
            const dictionary = /** @type {NodeListOf<HTMLAnchorElement>} */
                (document.querySelectorAll("nav:not(.drawer)>a.nav-item.-dictionary"));
            const dictionaryBack = /** @type {NodeListOf<HTMLAnchorElement>} */
                (document.querySelectorAll("nav.drawer.-dictionary>a.nav-item.-back._action"));

            /** @this {HTMLAnchorElement} @param {MouseEvent} e */
            function onOpenDictionary(e) {
                e.preventDefault();
                for (const value of dictionaryBack) {
                    let parent = value.parentElement;
                    if (!parent) continue;
                    let classes = parent.classList;
                    if (classes.contains("_closed"))
                        classes.remove("_closed");
                }
            }

            /** @this {HTMLAnchorElement} @param {MouseEvent} e */
            function onCloseDictionary(e) {
                e.preventDefault();
                for (const value of dictionaryBack) {
                    let parent = value.parentElement;
                    if (!parent) continue;
                    let classes = parent.classList;
                    if (!classes.contains("_closed"))
                        classes.add("_closed");
                }
            }

            for (const value of dictionary)
                value.addEventListener("click", onOpenDictionary);

            for (const value of dictionaryBack)
                value.addEventListener("click", onCloseDictionary);

            return function () {
                for (const value of dictionary)
                    value.removeEventListener("click", onOpenDictionary);

                for (const value of dictionaryBack)
                    value.removeEventListener("click", onCloseDictionary);
            }
        })());
        disposes.push((function () {
            const courses = /** @type {NodeListOf<HTMLAnchorElement>} */
                (document.querySelectorAll("nav:not(.drawer)>a.nav-item.-courses"));
            const coursesBack = /** @type {NodeListOf<HTMLAnchorElement>} */
                (document.querySelectorAll("nav.drawer.-courses>a.nav-item.-back._action"));

            /** @this {HTMLAnchorElement} @param {MouseEvent} e */
            function onOpenCourses(e) {
                e.preventDefault();
                for (const value of coursesBack) {
                    let parent = value.parentElement;
                    if (!parent) continue;
                    let classes = parent.classList;
                    if (classes.contains("_closed"))
                        classes.remove("_closed");
                }
            }

            /** @this {HTMLAnchorElement} @param {MouseEvent} e */
            function onCloseCourses(e) {
                e.preventDefault();
                for (const value of coursesBack) {
                    let parent = value.parentElement;
                    if (!parent) continue;
                    let classes = parent.classList;
                    if (!classes.contains("_closed"))
                        classes.add("_closed");
                }
            }

            for (const value of courses)
                value.addEventListener("click", onOpenCourses);

            for (const value of coursesBack)
                value.addEventListener("click", onCloseCourses);

            return function () {
                for (const value of courses)
                    value.removeEventListener("click", onOpenCourses);

                for (const value of coursesBack)
                    value.removeEventListener("click", onCloseCourses);
            }
        })());
        disposes.push((function () {
            const drawers = /** @type {NodeListOf<HTMLElement>} */
                (document.querySelectorAll("nav.drawer"));

            /** @this {HTMLElement} @param {MouseEvent} e */
            function onCloseDrawers(e) {
                e.preventDefault();
                for (const value of drawers) {
                    let parent = value.parentElement;
                    if (!parent) continue;
                    let classes = parent.classList;
                    if (!classes.contains("_closed"))
                        classes.add("_closed");
                }
            }

            ScrimBack.handler.push(onCloseDrawers);

            return function () {
                let handler = ScrimBack.handler;
                handler.splice(handler.indexOf(onCloseDrawers), 1);
            }
        })());
    }

    /** @this {Window} @param {Event} e */
    function onDispose(e) {
        disposes.forEach(dispose => dispose());
        window.removeEventListener("load", onLoadLayout);
        window.removeEventListener("unload", onDispose);
    }

    window.addEventListener("load", onLoadLayout);
    window.addEventListener("unload", onDispose);

    return {
        onSearch: /** @type {((this: HTMLAnchorElement, e: MouseEvent) => any)[]} */ ([]),
        get [Symbol.toStringTag]() { return _.tagName; }
    };
})({
    tagName: "clients.layout.main.js:MainLayout"
});