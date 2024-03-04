let datatable = null;
let currentOpenedAction = null;

function toggleAction(element) {
    if (currentOpenedAction !== null && currentOpenedAction !== element) {
        $(currentOpenedAction).parent().removeClass("slds-is-open");
        const html = $(currentOpenedAction).html().replaceAll("down", "up");
        $(currentOpenedAction).html(html);
    }
    const status = $(element).parent().hasClass("slds-is-open");
    const html = $(element).html().replaceAll((status ? "down" : "up"), (status ? "up" : "down"));
    $(element).html(html);
    $(element).parent().toggleClass("slds-is-open");
    currentOpenedAction = status ? null : element;
}

$(document).on("click", function (e) {
    if (!$(e.target).hasClass("actions")) {
        if (currentOpenedAction !== null) {
            $(currentOpenedAction).parent().removeClass("slds-is-open");
            const html = $(currentOpenedAction).html().replaceAll("down", "up");
            $(currentOpenedAction).html(html);
            currentOpenedAction = null;
        }
    }
});

function updateLinks() {
    const result = request(BASE_URL_API, "techwatch/links/" + USER["id"]);
    if (result.status === 200) {
        datatable.clear().draw();
        datatable.rows.add(result["data"]).draw();
    }
}

$(document).ready(function() {
    datatable = $("#table_links").DataTable({
        responsive: true,
        language: {
            url: "/assets/libs/datatables/languages/fr-FR.json"
        },
        columns: [
            { title: "ID", data: "id" },
            { title: "Lien", data: "link" },
            { title: "status", data: "status", render: function (data) {
                    return data === "1" ? "Actif" : "Inactif";
                }
            },
            { title: "Créer le", data: "created_at" },
            { title: "Actions", data: "id", render: function (data) {
                    return "<div class='slds-dropdown-trigger slds-dropdown-trigger_click'>" +
                        "<button class='slds-button slds-button_icon slds-button_icon-border-filled actions' onclick='toggleAction(this)'>" +
                        "<svg class='slds-button__icon'>" +
                        "<use xlink:href='/assets/resources/icons/utility-sprite/svg/symbols.svg#up'></use>" +
                        "</svg>" +
                        "</button>" +
                        "<div class='slds-dropdown slds-dropdown_left'>" +
                        "<ul class='slds-dropdown__list'>" +
                        "<li class='slds-dropdown__item'>" +
                        "<a href='javascript:showModalLink(\"update\", " + id + ")'>" +
                        "<span class='slds-truncate'>Modifier</span>" +
                        "</a>" +
                        "</li>" +
                        "<li class='slds-dropdown__item'>" +
                        "<a href='javascript:deleteLink(" + id + ")'>" +
                        "<span class='slds-truncate'>Supprimer</span>" +
                        "</a>" +
                        "</li>" +
                        "</ul>" +
                        "</div>" +
                        "</div>";
                }
            }

        ]
    });
    updateLinks();
});

