let data= {};

/**
 * Get the profile data and set it on the input
 */
function setDataOnInput() {
    data = request(BASE_URL_API, ("profile/" + USER["id"]), {});
    if (data["status"] === 200) {
        const profile = data["data"];
        let icon = (profile["logo_path"].length === 0 ? "<img src='" + BASE_URL + "assets/resources/images/no-image.png' style='width: 100%; height: 100%; border-radius: 50%;' alt=''>" : "<img src='" + BASE_URL + profile["logo_path"] + "' style='width: 100%; height: 100%; border-radius: 50%;' alt=''>");
        $("#profile-icon").html(icon);
        $("#input_firstname").val(profile["first_name"]);
        $("#input_lastname").val(profile["last_name"]);
        $("#input_mail").val(profile["email"]);
        $(".input_profile").on("input", checkInput);
        $(".input-file_profile").on("change", checkInput);
        if (tinymce.get("input_description") !== null) {
            tinymce.get("input_description").remove()
        }
        $("#input_description").html(profile["body"]);
        if (profile["logo_path"].length > 0) {
            $("#input_logo-content").html("<button class='slds-button slds-button_destructive' onclick='deleteLogo()'>Supprimer</button>");
        }
        if (profile["cv_path"].length > 0) {
            $("#input_cv-content").html("<button class='slds-button slds-button_destructive' onclick='deleteCv()'>Supprimer</button>");
        }
        if (profile["ts_path"].length > 0) {
            $("#input_ts-content").html("<button class='slds-button slds-button_destructive' onclick='deleteTs()'>Supprimer</button>");
        }
        $("#btn_cancel").attr("disabled", true);
        $("#btn_save").attr("disabled", true);
    }
}

/**
 * Delete the logo file
 */
function deleteLogo() {
    $("#input_logo-content").html("<input type='file' id='input_logo' style='width: 100%;' accept='image/png'>");
    $("#btn_cancel").attr("disabled", false);
    $("#btn_save").attr("disabled", false);
    $("#input_logo").on("change", checkInput);
}

/**
 * Delete the cv file
 */
function deleteCv() {
    $("#input_cv-content").html("<input type='file' id='input_cv' style='width: 100%;' accept='application/pdf'>");
    $("#btn_cancel").attr("disabled", false);
    $("#btn_save").attr("disabled", false);
    $("#input_cv").on("change", checkInput);
}

/**
 * Delete the ts file
 */
function deleteTs() {
    $("#input_ts-content").html("<input type='file' id='input_ts' style='width: 100%;' accept='application/pdf'>");
    $("#btn_cancel").attr("disabled", false);
    $("#btn_save").attr("disabled", false);
    $("#input_ts").on("change", checkInput);
}

/**
 * Check if the input is different from the profile
 */
function checkInput() {
    const profile = data["data"];
    let check = ($("#input_firstname").val().trim() !== profile["first_name"]);
    check = check || ($("#input_lastname").val().trim() !== profile["last_name"]);
    check = check || ($("#input_mail").val().trim() !== profile["email"]);
    check = check || (tinymce.get("input_description") !== null && tinymce.get("input_description").getContent().trim() !== profile["body"]);
    check = check || ($("#input_logo").length && $("#input_logo")[0].files.length > 0);
    check = check || ($("#input_cv").length && $("#input_cv")[0].files.length > 0);
    check = check || ($("#input_ts").length && $("#input_ts")[0].files.length > 0);
    $("#btn_cancel").attr("disabled", !check);
    $("#btn_save").attr("disabled", !check);
}

/**
 * Save the new profile
 * @returns {Promise<void>}
 */
async function save() {
    const firstname = $("#input_firstname").val();
    const lastname = $("#input_lastname").val();
    const mail = $("#input_mail").val();
    const logo = ($("#input_logo").length && $("#input_logo")[0].files[0] ? await readFileContent($("#input_logo")[0].files[0]) : "");
    const cv = ($("#input_cv").length && $("#input_cv")[0].files[0] ? await readFileContent($("#input_cv")[0].files[0]) : "");
    const ts = ($("#input_ts").length && $("#input_ts")[0].files[0] ? await readFileContent($("#input_ts")[0].files[0]) : "");
    const description = (tinymce.get("input_description") !== null) ? tinymce.get("input_description").getContent() : $("#input_description").html();
    let data = {
        "firstname": firstname,
        "lastname": lastname,
        "email": mail,
        "description": description,
    };
    if ($("#input_logo").length) {
        data["logo"] = logo;
    }
    if ($("#input_cv").length) {
        data["cv"] = cv;
    }
    if ($("#input_ts").length) {
        data["ts"] = ts;
    }
    const response = request(BASE_URL_API, ("profile/update/" + USER["id"]), data);
    if (response["status"] === 200) {
        setDataOnInput();
        checkInput();
    } else {

    }
}

/**
 * Cancel the changes
 */
function cancel() {
    setDataOnInput();
    $("#btn_cancel").attr("disabled", true);
    $("#btn_save").attr("disabled", true);
}

$(document).ready(function() {
    setDataOnInput();

    $("#input_description").on("click", function() {
        if ($("#input_description").attr("data-mce-type") === undefined) {
            tinymce.init({
                selector: "#input_description",
                plugins: "advlist autolink lists link charmap preview anchor",
                toolbar: "undo redo | h1 h2 h3 h4 h5 h6 | fontsize | code | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image",
                font_size_input_default_unit: "pt",
                content_style: "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }"
            });
            tinymce.get("input_description").on("input", checkInput);
        }
    });
});