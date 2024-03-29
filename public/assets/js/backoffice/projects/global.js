let projectsDatatable = null;
let categoriesDatatable = null;
let currentOpenedAction = null;

/**
 * Toggle action dropdown menu in datatable
 *
 * @param element
 */
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

$(document).ready(function () {
    const htmlAction = (target, id) => "<div class='slds-dropdown-trigger slds-dropdown-trigger_click'>" +
        "<button class='slds-button slds-button_icon slds-button_icon-border-filled actions' onclick='toggleAction(this)'>" +
        "<svg class='slds-button__icon'>" +
        "<use xlink:href='/assets/resources/icons/utility-sprite/svg/symbols.svg#up'></use>" +
        "</svg>" +
        "</button>" +
        "<div class='slds-dropdown slds-dropdown_left'>" +
        "<ul class='slds-dropdown__list'>" +
        "<li class='slds-dropdown__item'>" +
        "<a href='javascript:" + (target === "project" ? "showModalProject(\"update\", " + id + ")" : "showModalCategory(\"update\", " + id + ")") + "'>" +
        "<span class='slds-truncate'>Modifier</span>" +
        "</a>" +
        "</li>" +
        "<li class='slds-dropdown__item'>" +
        "<a href='javascript:" + (target === "project" ? ("deleteProject(" + id + ")") : ("deleteCategory(" + id + ")")) + "'>" +
        "<span class='slds-truncate'>Supprimer</span>" +
        "</a>" +
        "</li>" +
        "</ul>" +
        "</div>" +
        "</div>";

    projectsDatatable = $("#projects-datatable").DataTable({
        responsive: true,
        language: {
            url: "/assets/libs/datatables/languages/fr-FR.json"
        },
        columns: [
            { title: "ID", data: "id" },
            { title: "Catégorie", data: "category_id" },
            { title: "Titre", data: "title" },
            { title: "Créer le", data: "created_at" },
            { title: "Modifier le", data: "updated_at" },
            { title: "Statue", data: "status", render: function (data) {
                    return data === "1" ? "Actif" : "Inactif";
                }
            },
            { title: "Actions", data: "id", render: function (data) {
                    return htmlAction("project", data);
                }
            }
        ]
    });
    categoriesDatatable = $("#types-datatable").DataTable({
        responsive: true,
        language: {
            url: "/assets/libs/datatables/languages/fr-FR.json"
        },
        columns: [
            { title: "ID", data: "id" },
            { title: "Nom", data: "name" },
            { title: "Statue", data: "status", render: function (data) {
                    return data === "1" ? "Actif" : "Inactif";
                }
            },
            { title: "Actions", data: "id", render: function (data) {
                    return htmlAction("category", data);
                }
            }
        ]
    });

    updateProjectsList();
    updateCategoriesList();
});