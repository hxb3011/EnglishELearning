// @ts-check

const VerificationEditor = ((_) => {
    const disposes = /** @type {(() => void)[]} */ ([])

    /** @this {Window} @param {Event} e */
    function onLoadModal(e) {
        const selectType = /** @type {NodeListOf<HTMLSelectElement>} */
            (document.querySelectorAll("form.modal>card>select#stype"))
        const labelValue = /** @type {NodeListOf<HTMLLabelElement>} */
            (document.querySelectorAll("form.modal>card>label:has(+#ivalue)"));
        const inputValue = /** @type {NodeListOf<HTMLInputElement>} */
            (document.querySelectorAll("form.modal>card>input#ivalue"));
        const inputValueError = /** @type {NodeListOf<HTMLElement>} */
            (document.querySelectorAll("form.modal>card>input#ivalue+.error"));

        /** @this {HTMLInputElement} @param {Event} e */
        function onPhoneChange(e) {
            let v = this.value;
            if (!v || !v.length || /^\s+$/.test(v)) {
                for (const value of inputValueError)
                    value.innerText = this.getAttribute(`invalid-phone-isempty`) || "";
                this.setAttribute("invalid", "");
                return;
            }

            if (v.length > 11) {
                for (const value of inputValueError)
                    value.innerText = this.getAttribute(`invalid-phone-isexceed`) || "";
                this.setAttribute("invalid", "");
                return;
            }

            if (v.length < 10) {
                for (const value of inputValueError)
                    value.innerText = this.getAttribute(`invalid-phone-isnotreach`) || "";
                this.setAttribute("invalid", "");
                return;
            }

            if (!/^0\d{9,10}$/.test(v)) {
                for (const value of inputValueError)
                    value.innerText = this.getAttribute(`invalid-phone-isinvalid`) || "";
                this.setAttribute("invalid", "");
                return;
            }
            this.removeAttribute("invalid");
        }

        /** @this {HTMLInputElement} @param {Event} e */
        function onEmailChange(e) {
            let v = this.value;
            if (!v || !v.length || /^\s+$/.test(v)) {
                for (const value of inputValueError)
                    value.innerText = this.getAttribute(`invalid-email-isempty`) || "";
                this.setAttribute("invalid", "");
                return;
            }

            if (v.length > 254) {
                for (const value of inputValueError)
                    value.innerText = this.getAttribute(`invalid-email-isexceed`) || "";
                this.setAttribute("invalid", "");
                return;
            }

            if (v.indexOf("@") < 6) {
                for (const value of inputValueError)
                    value.innerText = this.getAttribute(`invalid-email-isnotreach`) || "";
                this.setAttribute("invalid", "");
                return;
            }
            
            if (!/^[a-zA-Z0-9.! #$%&'*+\/=?^_`{|}~-]{6,}@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(v)) {
                for (const value of inputValueError)
                    value.innerText = this.getAttribute(`invalid-email-isinvalid`) || "";
                this.setAttribute("invalid", "");
                return;
            }
            this.removeAttribute("invalid");
        }

        /** @this {HTMLSelectElement} @param {Event} e */
        function onTypeChange(e) {
            let value = this.value;
            let placeholderAttr, onChange;
            if (value === "phone") {
                placeholderAttr = "placeholder-phone";
                onChange = onPhoneChange;
            } else if (value === "email") {
                placeholderAttr = "placeholder-email";
                onChange = onEmailChange;
            } else return;
            for (const input of inputValue) {
                let placeholder = input.getAttribute(placeholderAttr) || "";
                input.setAttribute("placeholder", placeholder);
                input.setAttribute("verification", value);
                for (const label of labelValue)
                    label.innerText = placeholder;
                onChange.call(input);
            }
        }

        /** @this {HTMLInputElement} @param {Event} e */
        function onValueChange(e) {
            let type = this.getAttribute("verification") || "";
            if (type === "phone") {
                onPhoneChange.call(this, e);
            } else if (type === "email") {
                onEmailChange.call(this, e);
            } else return;
        }

        for (const value of selectType) {
            onTypeChange.call(value);
            value.addEventListener("change", onTypeChange);
        }

        for (const value of inputValue) {
            onValueChange.call(value);
            value.addEventListener("change", onValueChange);
            value.addEventListener("keyup", onValueChange);
        }

        function disposeInputPassword() {
            for (const value of selectType)
                value.removeEventListener("change", onTypeChange);

            for (const value of labelValue) {
                value.removeEventListener("change", onValueChange);
                value.removeEventListener("keyup", onValueChange);
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
    tagName: "clients.profile.addVerrification.js:VerificationEditor"
});