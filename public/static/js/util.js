const util = (function(window, $) {
    "use strict";

    let document = window.document;

    function getAlert(type, html) {
        return `<div class='alert ${type} alert-dismissible fade show' role='alert'>${html} <button
            type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>`;
    }

    function getSpinner(size = 0) {
        const sizeArr = ["spinner-border-sm", "", "spinner-border-lg"];
        (size > sizeArr.length || size < 0) ? size = 1 : false;
        return `<div class='spinner-border ${sizeArr[size]}' role='status'>
                <span class='visually-hidden'>Loading...</span>
            </div>`;
    }

    function getMaterialIcon(icon, addClasses = "", DOMElement = true) {
        return DOMElement ? createElement("span", { class: "material-icons " + addClasses }, icon) :
            `<span class="material-icons ${addClasses}">${icon}</span>`;
    }

    function createElement(tag, options = {}, html = null) {
        let e = document.createElement(tag);
        for (const attr in options) {
            $(e).attr(attr, options[attr]);
        }
        html ? $(e).html(html) : false;
        return e;
    }

    function getUniqueStr() {
        return `${Math.floor(Math.random() * 100)}${Date.now().toString().substr(-4)}${Math.floor(Math.random() * 100).toString()}`;
    }

    function toggleFormState(form, disabled = true) {
        form.find("input, button, select, textarea").prop("disabled", disabled);
    }

    return Object.freeze({
        getAlert,
        getSpinner,
        getUniqueStr,
        createElement,
        getMaterialIcon,
        toggleFormState
    });
}(window, jQuery));
