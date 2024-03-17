$(document).ready(function () {
    let data = request(BASE_URL_API, "categories/list?status=1&user=" + USER["id"]);
    if (data["status"] === 200) {
        let categories = data["data"];
        let html = "";
        for (let i = 0; i < categories.length; i++) {
            html += "<li><a class='dropdown-item' href='" + routeProject + "?category=" + categories[i]["id"] + "'>" + categories[i]["name"] + "</a></li>";
            if (i < categories.length - 1) {
                html += "<hr>";
            }
        }
        $("#categories").html(html);
    }
});