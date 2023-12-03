function getListLanguages() {
    var result;
    $.ajax({
        url: "/ajax/data/navigator/languages",
        type: "GET",
        dataType: "json",
        async: false,
        success: function (data) {
            result = data;
        },
        error: function (xhr, status, error) {
            console.error("Error : " + status + " - " + error);
        }
    });
    return result;
}

function getCurrentLanguage() {
    const uri = window.location.pathname;
    return uri.split("/")[1];
}

function changeLanguage(language) {
    var origine = window.location.origin;
    var uri = window.location.pathname;
    var query = window.location.search;
    var split = uri.split("/");
    split[1] = language.toUpperCase();
    uri = split.join("/");
    window.location.href = (origine + uri + query);
}

$(document).ready(function () {

    const listLanguages = getListLanguages();
    const currentLanguage = getCurrentLanguage();

    listLanguages.forEach(function (row) {
        if (row["ID"] === currentLanguage.trim().toUpperCase()) {
            $("#current-language").html("<img src='data:image/png;base64," + row["ICON"] + "' alt='" + row["ID"] + "'>");
            console.log("L1 -> " + row["ID"]);
        } else {
            $("#container-languages").append("<li><a class='dropdown-item' href='javascript:changeLanguage(\"" + row["ID"] + "\");'><img src='data:image/png;base64," + row["ICON"] + "' alt='" + row["ID"] + "'>&ensp;" + row["LABEL"] + "</a></li>");
            console.log("L2 -> " + row["ID"]);
        }
    });

});