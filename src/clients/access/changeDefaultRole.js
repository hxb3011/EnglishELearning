// @ts-check

const DefaultRoleEditor = ((_) => {
    const disposes = /** @type {(() => void)[]} */ ([])

    /** @this {Window} @param {Event} e */
    function onLoadModal(e) {
        const inputDefaultInstructorRole = /** @type {NodeListOf<HTMLSelectElement>} */
            (document.querySelectorAll("#inputDefaultInstructorRole"));
        const inputDefaultLearnerRole = /** @type {NodeListOf<HTMLSelectElement>} */
            (document.querySelectorAll("#inputDefaultLearnerRole"));

        /** @param {{ [key in "instructor" | "learner"]?: string; }} data */
        function changeDefaultRole(data) {
            /** @this {XMLHttpRequest} @param {ProgressEvent<EventTarget>} e  */
            function onXMLHttpRequestLoad(e) {
                let result = Number(this.response);
                if ((result & 2) !== 0) console.log("Cập nhật vai trò giảng viên mặc định thành công.");
                if ((result & 1) !== 0) console.log("Cập nhật vai trò học viên mặc định thành công.");
            }

            const xhttp = new XMLHttpRequest();
            xhttp.addEventListener("load", onXMLHttpRequestLoad);
            xhttp.open("POST", "/administration/access/changeDefaultRole.php");
            xhttp.send(JSON.stringify(data));
        }

        /** @this {HTMLSelectElement} @param {Event} e */
        function onInstructorRoleChange(e) {
            changeDefaultRole({
                instructor: this.value
            });
        }

        /** @this {HTMLSelectElement} @param {Event} e */
        function onLearnerRoleChange(e) {
            changeDefaultRole({
                learner: this.value
            });
        }

        for (const value of inputDefaultInstructorRole) {
            value.addEventListener("change", onInstructorRoleChange);
        }

        for (const value of inputDefaultLearnerRole) {
            value.addEventListener("change", onLearnerRoleChange);
        }

        function disposeDefaultInputs() {
            for (const value of inputDefaultInstructorRole) {
                value.removeEventListener("change", onInstructorRoleChange);
            }

            for (const value of inputDefaultLearnerRole) {
                value.removeEventListener("change", onLearnerRoleChange);
            }
        }
        disposes.push(disposeDefaultInputs);
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
    tagName: "clients.access.changeDefaultRole.js:DefaultRoleEditor"
});