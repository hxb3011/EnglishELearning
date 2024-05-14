// @ts-check

const PasswordEditor = ((_) => {
    const disposes = /** @type {(() => void)[]} */ ([])

    /** @this {Window} @param {Event} e */
    function onLoadModal(e) {
        const inputPassword = /** @type {NodeListOf<HTMLInputElement>} */
            (document.querySelectorAll("form.modal>card>input#ipassword"))
        const inputXPassword = /** @type {NodeListOf<HTMLInputElement>} */
            (document.querySelectorAll("form.modal>card>input#ixpassword"));
        const inputZPassword = /** @type {NodeListOf<HTMLInputElement>} */
            (document.querySelectorAll("form.modal>card>input#izpassword"));
        const inputPasswordError = /** @type {NodeListOf<HTMLElement>} */
            (document.querySelectorAll("form.modal>card>input#ipassword+.error"));
        const inputXPasswordError = /** @type {NodeListOf<HTMLElement>} */
            (document.querySelectorAll("form.modal>card>input#ixpassword+.error"));
        const inputZPasswordError = /** @type {NodeListOf<HTMLElement>} */
            (document.querySelectorAll("form.modal>card>input#izpassword+.error"));

        /** @this {HTMLInputElement} @param {Event} e */
        function onPasswordChange(e) {
            if (!this.value || !this.value.length || /^\s+$/.test(this.value)) {
                for (const value of inputPasswordError)
                    value.innerText = this.getAttribute("invalid-isempty") || "";
                this.setAttribute("invalid", "");
                return;
            }
            if (this.value.length > 255) {
                for (const value of inputPasswordError)
                    value.innerText = this.getAttribute("invalid-isexceed") || "";
                this.setAttribute("invalid", "");
                return;
            }
            if (this.value.length < 8) {
                for (const value of inputPasswordError)
                    value.innerText = this.getAttribute("invalid-isnotreach") || "";
                this.setAttribute("invalid", "");
                return;
            }
            if (!/[a-z]/.test(this.value) || !/[A-Z]/.test(this.value) || !/[0-9]/.test(this.value) || !/[^\w\s]/.test(this.value)) {
                for (const value of inputPasswordError)
                    value.innerText = this.getAttribute("invalid-isinvalid") || "";
                this.setAttribute("invalid", "");
                return;
            }
            for (const input of inputXPassword)
                onXPasswordChange.call(input);
            this.removeAttribute("invalid");
        }

        /** @this {HTMLInputElement} @param {Event} e */
        function onXPasswordChange(e) {
            if (!this.value || !this.value.length || /^\s+$/.test(this.value)) {
                for (const value of inputXPasswordError)
                    value.innerText = this.getAttribute("invalid-isempty") || "";
                this.setAttribute("invalid", "");
                return;
            }
            if (this.value.length > 255) {
                for (const value of inputXPasswordError)
                    value.innerText = this.getAttribute("invalid-isexceed") || "";
                this.setAttribute("invalid", "");
                return;
            }
            if (this.value.length < 8) {
                for (const value of inputXPasswordError)
                    value.innerText = this.getAttribute("invalid-isnotreach") || "";
                this.setAttribute("invalid", "");
                return;
            }
            if (!/[a-z]/.test(this.value) || !/[A-Z]/.test(this.value) || !/[0-9]/.test(this.value) || !/[^\w\s]/.test(this.value)) {
                for (const value of inputXPasswordError)
                    value.innerText = this.getAttribute("invalid-isinvalid") || "";
                this.setAttribute("invalid", "");
                return;
            }

            for (const input of inputZPassword)
                onZPasswordChange.call(input);
            
            let match = true;
            for (const input of inputPassword) {
                if (input.value !== this.value) {
                    match = false;
                    break;
                }
            }
            if (match) {
                for (const value of inputXPasswordError)
                    value.innerText = this.getAttribute("invalid-ismatch") || "";
                this.setAttribute("invalid", "");
                return;
            }
            this.removeAttribute("invalid");
        }

        /** @this {HTMLInputElement} @param {Event} e */
        function onZPasswordChange(e) {
            if (!this.value || !this.value.length || /^\s+$/.test(this.value)) {
                for (const value of inputZPasswordError)
                    value.innerText = this.getAttribute("invalid-isempty") || "";
                this.setAttribute("invalid", "");
                return;
            }
            if (this.value.length > 255) {
                for (const value of inputZPasswordError)
                    value.innerText = this.getAttribute("invalid-isexceed") || "";
                this.setAttribute("invalid", "");
                return;
            }
            if (this.value.length < 8) {
                for (const value of inputZPasswordError)
                    value.innerText = this.getAttribute("invalid-isnotreach") || "";
                this.setAttribute("invalid", "");
                return;
            }
            if (!/[a-z]/.test(this.value) || !/[A-Z]/.test(this.value) || !/[0-9]/.test(this.value) || !/[^\w\s]/.test(this.value)) {
                for (const value of inputZPasswordError)
                    value.innerText = this.getAttribute("invalid-isinvalid") || "";
                this.setAttribute("invalid", "");
                return;
            }
            let match = true;
            for (const input of inputXPassword) {
                if (input.value !== this.value) {
                    match = false;
                    break;
                }
            }
            if (!match) {
                for (const value of inputZPasswordError)
                    value.innerText = this.getAttribute("invalid-isnotmatch") || "";
                this.setAttribute("invalid", "");
                return;
            }
            this.removeAttribute("invalid");
        }

        for (const value of inputPassword) {
            onPasswordChange.call(value);
            value.addEventListener("change", onPasswordChange);
            value.addEventListener("keyup", onPasswordChange);
        }

        for (const value of inputXPassword) {
            onXPasswordChange.call(value);
            value.addEventListener("change", onXPasswordChange);
            value.addEventListener("keyup", onXPasswordChange);
        }

        for (const value of inputZPassword) {
            onZPasswordChange.call(value);
            value.addEventListener("change", onZPasswordChange);
            value.addEventListener("keyup", onZPasswordChange);
        }

        function disposeInputPassword() {
            for (const value of inputPassword) {
                value.removeEventListener("change", onPasswordChange);
                value.removeEventListener("keyup", onPasswordChange);
            }

            for (const value of inputXPassword) {
                value.removeEventListener("change", onXPasswordChange);
                value.removeEventListener("keyup", onXPasswordChange);
            }

            for (const value of inputZPassword) {
                value.removeEventListener("change", onZPasswordChange);
                value.removeEventListener("keyup", onZPasswordChange);
            }
        }

        disposes.push(disposeInputPassword);
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
    tagName: "clients.profile.updatePassword.js:PasswordEditor"
});