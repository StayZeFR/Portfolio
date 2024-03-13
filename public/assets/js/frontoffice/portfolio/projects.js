/**
 * Permet de filtrer les projets
 */
function filter() {
    const category = $("#filter-category").val();
    const search = $("#filter-search").val();
    const projects = request(BASE_URL_API, ("projects/list?user=" + USER["id"] + "&category=" + category + "&search=" + encodeURI(search) + "&status=1"))["data"];

    $("#projects-list").html("");
    projects.forEach(function (project) {
        const docs = request(BASE_URL_API, ("projects/files/" + project["id"]))["data"];
        let img = (project["image_path"] !== null) ? ("<img class='contains-image' src='" + project["image_path"] + "' alt=''>") : "<img class='no-image' src='assets/resources/images/no-image.png' alt=''>";

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
            html += "<a href='" + doc["file_path"] + "' target='_blank'>" + doc["name"] + "</a>";
        });

        html += "</div></div>";

        $("#projects-list").append(html);
    });
}

$(document).ready(function () {
    const categories = request(BASE_URL_API, "categories/list?user=" + USER["id"] + "&status=1")["data"];

    $("#filter-category").append("<option value=''>Toutes les catégories</option>");
    categories.forEach(function (category) {
        $("#filter-category").append("<option value='" + category["id"] + "'>" + category["name"] + "</option>");
    });

    filter();
});