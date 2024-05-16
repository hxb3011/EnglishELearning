const disposeBackToTop = (() => {
    let backToTop = document.getElementById('to-top-button');
    if (!backToTop) return;
    document.body.addEventListener('scroll', onWindowScroll(e));
    function onWindowScroll(e) {
        console.log("Vô được scroll");
        let display = (document.body.scrollTop > 100
            || document.documentElement.scrollTop > 100)
            ? 'block' : "none";
        backToTop.style.display = display;
    }
    function onBackToTopClick(e) {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome
    }
    backToTop.addEventListener("click", onBackToTopClick(e));
    return function dispose() {
        window.removeEventListener("scroll", onWindowScroll);
        backToTop.removeEventListener("click", onBackToTopClick);
    };
});
