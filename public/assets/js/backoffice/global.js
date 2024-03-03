/**
 * Return the HTML of a toast message with the given icon and text
 *
 * @param icon
 * @param text
 * @returns {string}
 */
const toastHTML = (icon, text) => "<div class='slds-notify_container slds-is-relative'>" +
                        "<div class='slds-notify slds-notify_toast slds-theme_" + icon + "' role='status'>" +
                        "<span class='slds-assistive-text'>" + icon + "</span>" +
                        "<span class='slds-icon_container slds-icon-utility-" + icon + " slds-m-right_small slds-no-flex slds-align-top'>" +
                        "<svg class='slds-icon slds-icon_small'>" +
                        "<use xlink:href='/assets/resources/icons/utility-sprite/svg/symbols.svg#" + icon + "'></use>" +
                        "</svg>" +
                        "</span>" +
                        "<div class='slds-notify__content'>" +
                        "<h2 class='slds-text-heading_small'>" + text + "</h2>" +
                        "</div>" +
                        "<div class='slds-notify__close'>" +
                        "<button class='slds-button slds-button_icon slds-button_icon-inverse' onclick='closeToast(this)'>" +
                        "<svg class='slds-button__icon slds-button__icon_large'>" +
                        "<use xlink:href='/assets/resources/icons/utility-sprite/svg/symbols.svg#close'></use>" +
                        "</svg>" +
                        "<span class='slds-assistive-text'>Fermer</span>" +
                        "</button>" +
                        "</div>" +
                        "</div>" +
                        "</div>";

/**
 * Display a toast message in the given container with the given type and message
 *
 * @param container
 * @param type
 * @param message
 */
function toast (container, type, message) {
    container = $("#" + container);
    let html;
    switch (type) {
        case "success":
            html = toastHTML("success", message);
            break;
        case "error":
            html = toastHTML("error", message);
            break;
        case "warning":
            html = toastHTML("warning", message);
            break;
    }
    const check = (container.html() ?? "").replaceAll("\"", "'").includes(html);
    container.append((check ? "" : html));
}

function closeToast(toast) {
    $(toast).parent().parent().parent().remove();
}

function request(base, url, params) {
    let data;
    $.ajax({
        url: base + "/" +  url,
        type: "POST",
        data: params,
        dataType: "json",
        async: false,
        success: function (result, status, xhr) {
            data = {
                "status": xhr.status,
                "data": result
            };
        },
        error: function (error) {
            data = {
                "status": 500,
                "data": JSON.stringify(error)
            };
            console.log("Error: " + JSON.stringify(error));
        }
    });
    return data;
}

/**
 * Read file content to base64
 * @param file
 * @returns {Promise<unknown>}
 */
function readFileContent(file) {
    return new Promise((resolve, reject) => {
        let reader = new FileReader();
        reader.onload = function(e) {
            resolve(e.target.result);
        };
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}