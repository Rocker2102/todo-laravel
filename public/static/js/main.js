const main = (function(window, $, util) {
    "use strict";

    const constsFn = () => {
        return {
            searchForm: $("#searchForm")
        };
    };
    const constants = constsFn();

    return Object.freeze({
        constants: constsFn
    });
}(window, jQuery, util));

const handlers = (function(window, $, util, main) {
    "use strict";

    const constants = main.constants();
    let document = window.document;

    constants.searchForm.submit(function(e) {
        e.preventDefault();
    });
}(window, jQuery, util, main));
