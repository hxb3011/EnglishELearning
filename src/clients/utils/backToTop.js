// @ts-check
const disposeBackToTop = (() => {
    let backToTop = /** @type {HTMLElement} */ (document.getElementById('back-to-top'));
    if (!backToTop) return;
    function onWindowScroll(/** @type {Event} */ e) {
        let display = (document.body.scrollTop > 20
            || document.documentElement.scrollTop > 20)
            ? 'block' : "none";
        backToTop.style.display = display;
    }
    window.addEventListener("scroll", onWindowScroll);
    function onBackToTopClick(/** @type {Event} */ e) {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome
    }
    backToTop.addEventListener("click", onBackToTopClick);
    return function dispose() {
        window.removeEventListener("scroll", onWindowScroll);
        backToTop.removeEventListener("click", onBackToTopClick);
    };
})();