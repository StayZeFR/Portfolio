/**
 * Get projects list by category from API
 * @param user
 * @param category
 * @param search
 * @returns {*}
 */
function getProjectsList(user, category, search) {
    let data;
    $.ajax({
        url: "/api/projects/list?user=" + user + "&category=" + category + "&search=" + encodeURI(search) + "&status=1",
        type: "POST",
        data: {},
        dataType: "json",
        async: false,
        success: function (result) {
            data = result;
        },
        error: function (xhr, status, error) {
            console.log("Error : " + xhr.responseText);
        }
    });
    return data;
}

/**
 * Get projects categories list from API
 * @param user
 * @returns {*}
 */
function getCategoriesList(user) {
    let data;
    $.ajax({
        url: "/api/categories/list?user=" + user + "&status=1",
        type: "POST",
        data: {},
        dataType: "json",
        async: false,
        success: function (result) {
            data = result;
        },
        error: function (xhr, status, error) {
            console.log("Error : " + xhr.responseText);
        }
    });
    return data;
}

/**
 * Get project files from API
 * @param id
 * @returns {*}
 */
function getProjectFiles(id) {
    let data;
    $.ajax({
        url: "/api/projects/files/" + id,
        type: "POST",
        data: {},
        dataType: "json",
        async: false,
        success: function (result) {
            data = result;
        },
        error: function (xhr, status, error) {
            console.log("Error : " + xhr.responseText);
        }
    });
    return data;
}

function filter() {
    const category = $("#filter-category").val();
    const search = $("#filter-search").val();
    const projects = getProjectsList(USER["id"], category, search);

    $("#projects-list").html("");
    projects.forEach(function (project) {
        const docs = getProjectFiles(project["id"]);
        let img = (project["image_path"] !== null) ? ("<img class='contains-image' src='" + project["image_path"] + "' alt=''>") : "<img class='no-image' src='assets/resources/images/no-image.png' alt=''>";

        console.log(img);

        let html = "<div class='project'>" +
            "<div class='project-image'>" +
            img +
            "</div>" +
            "<div class='project-content'>" +
            "<h2>" + project["title"] +  "</h2>" +
            "<p><i>" + project["category_name"] + "</i></p>" +
            "<p>" + (project["description"] ?? "Pas de description...") + "</p>" +
            "</div>" +
            "<div class='project-docs'>";

        docs.forEach(function (doc) {
            html += "<a href='/" + doc["file_path"] + "' target='_blank'>" + doc["name"] + "</a>";
        });

        html += "</div></div>";

        $("#projects-list").append(html);
    });
}

$(document).ready(function () {
    const categories = getCategoriesList(USER["id"]);

    $("#filter-category").append("<option value=''>Toutes les catégories</option>");
    categories.forEach(function (category) {
        $("#filter-category").append("<option value='" + category["id"] + "'>" + category["name"] + "</option>");
    });

    filter();
});