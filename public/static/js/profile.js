const profile = (function(window, $, util, main) {
    "use strict";

    let document = window.document, location = window.location;
    const constants = {
        ...main.constants(),
        forms: {
            update: $("#updateForm"),
            changePwd: ("#changePasswordForm"),
            deleteAcc: $("#deleteAccountForm")
        },
        get profileBtns() {
            return {
                enableUpdateEdit: this.forms.update.find("button[data-action='edit']")
            }
        }
    };

    constants.profileBtns.enableUpdateEdit.click(function() {
        const form = constants.forms.update;
        const submitbtn = form.find("button[type='submit']");
        let status = false;
        if (form.attr("status") == "1") {
            form.attr("status", "0");
            status = true;
        } else {
            form.attr("status", "1");
        }
        util.toggleFormState(form, status);
        constants.profileBtns.enableUpdateEdit.attr("disabled", false);
    });

    return {

    }
}(window, jQuery, util, main));
