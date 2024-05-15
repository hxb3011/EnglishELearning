// @ts-check

const MainProfile = ((_) => {
    const disposes = /** @type {(() => void)[]} */ ([]);

    /** @this {Window} @param {Event} e */
    function onLoadModal(e) {
        const inputRegister = /** @type {NodeListOf<HTMLInputElement>} */
            (document.querySelectorAll("main>card.header input#iregister"));
        const inputSignIn = /** @type {NodeListOf<HTMLInputElement>} */
            (document.querySelectorAll("main>card.header input#isignin"));
        const inputSignOut = /** @type {NodeListOf<HTMLInputElement>} */
            (document.querySelectorAll("main>card.header input#isignout"));
        console.log(inputRegister, inputSignIn, inputSignOut);
        /** @this {HTMLInputElement} @param {Event} e */
        function onRegister(e) {
            console.log("onRegister", this, e);
            location.assign("/authentication/authenticate.php");
        }

        /** @this {HTMLInputElement} @param {Event} e */
        function onSignIn(e) {
            console.log("onSignIn", this, e);
            location.assign("/authentication/authenticate.php");
        }

        /** @this {HTMLInputElement} @param {Event} e */
        function onSignOut(e) {
            console.log("onSignOut", this, e);
            location.assign("/profile/signOut.php");
        }

        for (const value of inputRegister)
            value.addEventListener("click", onRegister);

        for (const value of inputSignIn)
            value.addEventListener("click", onSignIn);

        for (const value of inputSignOut)
            value.addEventListener("click", onSignOut);

        function disposeHeader() {
            for (const value of inputRegister)
                value.removeEventListener("click", onRegister);

            for (const value of inputSignIn)
                value.removeEventListener("click", onSignIn);

            for (const value of inputSignOut)
                value.removeEventListener("click", onSignOut);
        }

        disposes.push(disposeHeader);
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
        [Symbol.toStringTag]() { return _.tagName; }
    };
})({
    tagName: "clients.profile.main.js:MainProfile"
});