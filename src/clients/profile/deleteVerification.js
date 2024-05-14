// @ts-check

const VerificationViewer = ((_) => {
    const disposes = /** @type {(() => void)[]} */ ([])

    /** @this {Window} @param {Event} e */
    function onLoadModal(e) {
        disposes.push((function () {
            const inputExit = /** @type {NodeListOf<HTMLInputElement>} */
                (document.querySelectorAll("form.modal>card>input#iexit"));

            /** @this {HTMLElement} @param {MouseEvent} e */
            function onExit(e) {
                if (e) {
                    e.preventDefault();
                    if (e.target !== this) return;
                }
                location.assign("/profile/index.php");
            }

            for (const value of inputExit)
                value.addEventListener("click", onExit);

            ScrimBack.handler.push(onExit);

            return function () {
                for (const value of inputExit)
                    value.removeEventListener("click", onExit);
                let handler = ScrimBack.handler;
                handler.splice(handler.indexOf(onExit), 1);
            }
        })());
    }

    /** @this {Window} @param {Event} e */
    function onDispose(e) {
        disposes.forEach(dispose => dispose());
        window.removeEventListener("load", onLoadModal);
        window.removeEventListener("unload", onDispose);
    }

    window.addEventListener("load", onLoadModal);
    window.addEventListener("unload", onDispose);

    return {
        get [Symbol.toStringTag]() { return _.tagName; }
    };
})({
    tagName: "clients.profile.deleteVerrification.js:VerificationViewer"
});