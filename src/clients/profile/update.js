// @ts-check

const ProfileEditor = ((_) => {
    const disposes = /** @type {(() => void)[]} */ ([])

    /** @this {Window} @param {Event} e */
    function onLoadModal(e) {
        disposes.push((function () {
            const inputLastName = /** @type {NodeListOf<HTMLInputElement>} */
                (document.querySelectorAll("form.modal>card>input#ilname"));
            const inputLastNameError = /** @type {NodeListOf<HTMLElement>} */
                (document.querySelectorAll("form.modal>card>input#ilname+.error"));

            /** @this {HTMLInputElement} @param {Event} e */
            function onChange(e) {
                if (!this.value || !this.value.length || /^\s+$/.test(this.value)) {
                    for (const value of inputLastNameError)
                        value.innerText = this.getAttribute("invalid-isEmpty") || "";
                    this.setAttribute("invalid", "");
                    return;
                }
                if (this.value.length > 255) {
                    for (const value of inputLastNameError)
                        value.innerText = this.getAttribute("invalid-isExceed") || "";
                    this.setAttribute("invalid", "");
                } else this.removeAttribute("invalid");
            }

            for (const value of inputLastName) {
                onChange.call(value);
                value.addEventListener("change", onChange);
                value.addEventListener("keyup", onChange);
            }

            return function () {
                for (const value of inputLastName) {
                    value.removeEventListener("change", onChange);
                    value.removeEventListener("keyup", onChange);
                }
            }
        })());
        disposes.push((function () {
            const inputFirstName = /** @type {NodeListOf<HTMLInputElement>} */
                (document.querySelectorAll("form.modal>card>input#ifname"));
            const inputFirstNameError = /** @type {NodeListOf<HTMLElement>} */
                (document.querySelectorAll("form.modal>card>input#ifname+.error"));

            /** @this {HTMLInputElement} @param {Event} e */
            function onChange(e) {
                if (!this.value || !this.value.length || /^\s+$/.test(this.value)) {
                    for (const value of inputFirstNameError)
                        value.innerText = this.getAttribute("invalid-isEmpty") || "";
                    this.setAttribute("invalid", "");
                    return;
                }
                if (this.value.length > 255) {
                    for (const value of inputFirstNameError)
                        value.innerText = this.getAttribute("invalid-isExceed") || "";
                    this.setAttribute("invalid", "");
                } else this.removeAttribute("invalid");
            }

            for (const value of inputFirstName) {
                onChange.call(value);
                value.addEventListener("change", onChange);
                value.addEventListener("keyup", onChange);
            }

            return function () {
                for (const value of inputFirstName) {
                    value.removeEventListener("change", onChange);
                    value.removeEventListener("keyup", onChange);
                }
            }
        })());
        disposes.push((function () {
            const inputBirthday = /** @type {NodeListOf<HTMLInputElement>} */
                (document.querySelectorAll("form.modal>card>input#ibirthday"));

            /** @this {HTMLInputElement} @param {Event} e */
            function onChange(e) {
                if (!this.value || !this.value.length) {
                    this.setAttribute("invalid", "");
                } else this.removeAttribute("invalid");
            }

            for (const value of inputBirthday) {
                onChange.call(value);
                value.addEventListener("change", onChange);
                value.addEventListener("keyup", onChange);
            }

            return function () {
                for (const value of inputBirthday) {
                    value.removeEventListener("change", onChange);
                    value.removeEventListener("keyup", onChange);
                }
            }
        })());
        disposes.push((function () {
            const inputUserName = /** @type {NodeListOf<HTMLInputElement>} */
                (document.querySelectorAll("form.modal>card>input#iuname"));
            const inputUserNameError = /** @type {NodeListOf<HTMLElement>} */
                (document.querySelectorAll("form.modal>card>input#iuname+.error"));

            /** @this {HTMLInputElement} @param {Event} e */
            function onChange(e) {
                if (!this.value || !this.value.length || /^\s+$/.test(this.value)) {
                    for (const value of inputUserNameError)
                        value.innerText = this.getAttribute("invalid-isEmpty") || "";
                    this.setAttribute("invalid", "");
                    return;
                }
                if (this.value.length > 255) {
                    for (const value of inputUserNameError)
                        value.innerText = this.getAttribute("invalid-isExceed") || "";
                    this.setAttribute("invalid", "");
                    return;
                }
                if (this.value.length < 6) {
                    for (const value of inputUserNameError)
                        value.innerText = this.getAttribute("invalid-isNotReach") || "";
                    this.setAttribute("invalid", "");
                    return;
                }
                this.removeAttribute("invalid");

                const input = this;
                /** @this {XMLHttpRequest} @param {ProgressEvent<EventTarget>} e  */
                function onXMLHttpRequestLoad(e) {
                    if (Number(this.response) !== 0) {
                        for (const value of inputUserNameError)
                            value.innerText = input.getAttribute("invalid-isExisted") || "";
                        input.setAttribute("invalid", "");
                    } else input.removeAttribute("invalid");
                    this.removeEventListener("load", onXMLHttpRequestLoad);
                }

                const xhttp = new XMLHttpRequest();
                xhttp.addEventListener("load", onXMLHttpRequestLoad);
                xhttp.open("POST", "/profile/checkUserName.php");
                xhttp.send(JSON.stringify({ userName: this.value }));
            }

            for (const value of inputUserName) {
                onChange.call(value);
                value.addEventListener("change", onChange);
                value.addEventListener("keyup", onChange);
            }

            return function () {
                for (const value of inputUserName) {
                    value.removeEventListener("change", onChange);
                    value.removeEventListener("keyup", onChange);
                }
            }
        })());
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

            for (const value of inputExit) {
                value.addEventListener("click", onExit);
            }
            ScrimBack.handler.push(onExit);

            return function () {
                for (const value of inputExit)
                    value.removeEventListener("click", onExit);
                let handler = ScrimBack.handler;
                handler.splice(handler.indexOf(onExit), 1);
            }
        })());
        disposes.push((function () {
            const input = /** @type {NodeListOf<HTMLInputElement>} */
                (document.querySelectorAll("form.modal>card>input"));
            const select = /** @type {NodeListOf<HTMLSelectElement>} */
                (document.querySelectorAll("form.modal>card>select"));
            const inputSubmit = /** @type {NodeListOf<HTMLElement>} */
                (document.querySelectorAll("form.modal>card>input[type=\"submit\"]"));

            /** @this {HTMLElement} @param {MouseEvent} e */
            function onSubmit(e) {
                for (const i of input) {
                    if (i.hasAttribute("invalid")) {
                        e.preventDefault();
                        alert("Dữ liệu không hợp lệ");
                        return;
                    }
                }
                for (const s of select) {
                    if (s.hasAttribute("invalid")) {
                        e.preventDefault();
                        alert("Dữ liệu không hợp lệ");
                        return;
                    }
                }
            }

            for (const value of inputSubmit) {
                value.addEventListener("click", onSubmit);
            }

            return function () {
                for (const value of inputSubmit)
                    value.removeEventListener("click", onSubmit);
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
    tagName: "clients.profile.update.js:ProfileEditor"
});