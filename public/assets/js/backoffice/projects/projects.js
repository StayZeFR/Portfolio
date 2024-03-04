/**
 * Cette fonction permet d'afficher le modal pour ajouter ou modifier un projet
 *
 * @param action
 * @param id
 */
function showModalProject(action, id) {
    $("#modal-project-action_title").html(action === "update" ? "Modifier un projet - ID : " + id : "Ajouter un projet");
    $("#modal-project-action_valid").html(action === "update" ? "Modifier" : "Ajouter").attr("onclick", action === "update" ? "updateProject(" + id + ")" : "addProject()");

    const categories = request(BASE_URL_API, "categories/list")["data"];

    if (action === "update") {

    } else {
        $("#modal-project-action_form-title").val("");
        $("#modal-project-action_form-status").prop("checked", true);
        $("#modal-project-action_form-category").html(function () {
            let html = "<option value=''>Sélectionner une categorie...</option>";
            categories.forEach(category => {
                html += "<option value='" + category["id"] + "'>" + category["name"] + "</option>";
            });
            return html;
        });
        $("#modal-project-action_form-doc-img").val("");
        $("#modal-project-action_form-docs").html(getHtmlDocInput("", true, false));
    }

    $("#modal-project-action").show();
}

/**
 * Cette fonction permet de générer le code HTML pour un input de document
 *
 * @param name : Le nom du document
 * @param add : Si on doit afficher le bouton d'ajout
 * @param remove : Si on doit afficher le bouton de suppression
 * @returns {string} : Le code HTML
 */
function getHtmlDocInput(name, add, remove = false) {
    return "<div class='slds-col' style='margin-bottom: 5px;'>" +
        "<div class='slds-grid slds-gutters'>" +
        "<div class='slds-col'>" +
        "<div class='slds-form-element__control'>" +
        "<input type='text' placeholder='Nom' class='slds-input modal-project-action_form-doc-name'' " + (name === "" ? "" : ("value='" + name + "'")) + "/>" +
        "</div>" +
        "</div>" +
        "<div class='slds-col'>" +
        "<input type='file' class='modal-project-action_form-doc-file' accept='application/pdf'/>" +
        "</div>" +
        "<div class='slds-col' style='width: 50px !important;'>" +
        "<button class='slds-button slds-button_icon slds-button_icon-brand button-doc-remove' onclick='removeDocInput(this)' " + (remove ? "" : "disabled") + ">" +
        "<svg class='slds-button__icon' aria-hidden='true'>" +
        "<use xlink:href='/assets/resources/icons/utility-sprite/svg/symbols.svg#delete'></use>" +
        "</svg>" +
        "</button>" +
        "<button class='slds-button slds-button_icon slds-button_icon-brand button-doc-add' onclick='addDocInput();' style='display: " + (add ? "inline-flex" : "none") + "'>" +
        "<svg class='slds-button__icon' aria-hidden='true'>" +
        "<use xlink:href='/assets/resources/icons/utility-sprite/svg/symbols.svg#add'></use>" +
        "</svg>" +
        "</button>" +
        "</div>" +
        "</div>" +
        "</div>";
}

/**
 * Cette fonction permet de ajouter un input de document
 */
function addDocInput() {
    const docs = $("#modal-project-action_form-docs");
    let children = docs.children().get();
    $(children[children.length - 1]).find(".button-doc-add").hide();
    $(children[children.length - 1]).find(".button-doc-remove").attr("disabled", false);
    docs.append(getHtmlDocInput("", true, true));
}

/**
 * Cette fonction permet de supprimer un input de document
 *
 * @param element : L'élément qui a déclenché l'événement
 */
function removeDocInput(element) {
    $(element).parent().parent().parent().remove();
    const docs = $("#modal-project-action_form-docs");
    let children = docs.children().get();
    $(children[children.length - 1]).find(".button-doc-add").show();
    $(children[children.length - 1]).find(".button-doc-remove").attr("disabled", children.length === 1);
}

/**
 * Cette fonction permet fermer le modal pour ajouter ou modifier un projet
 */
function closeModalProject() {
    $("#modal-project-action").hide();
    $("#modal-project-action_toast").html("");
}

/**
 * Cette fonction permet d'ajouter un projet dans la base de données avec l'API
 */
async function addProject() {
    const title = $("#modal-project-action_form-title").val();
    const status = $("#modal-project-action_form-status").is(":checked") ? 1 : 0;
    const category = $("#modal-project-action_form-category").val();
    const image = ($("#modal-project-action_form-doc-img")[0].files[0] ? await readFileContent($("#modal-project-action_form-doc-img")[0].files[0]) : "");
    const description = $("#modal-project-action_form-description").val();
    const children = $("#modal-project-action_form-docs").children().get();
    let files = [];

    for (let i = 0; i < children.length; i++) {
        let name = $(children[i]).find(".modal-project-action_form-doc-name").val().trim();
        let content;
        let file = $(children[i]).find(".modal-project-action_form-doc-file")[0].files[0];
        if (file) {
            content = await readFileContent(file);
        }
        files.push({
            name: name,
            file: content
        });
    }

    let error = false;
    for (let i = 0; i < files.length; i++) {
        if (files[i].file === undefined || files[i].file === "" || files[i].name === "") {
            error = true;
            break;
        }
    }

    if (title === "" || category === "" || files.length === 0 || error) {
        toast("error", "Champs manquants", "Veuillez remplir tous les champs.");
    } else {

        let data = {
            title: title,
            status: status,
            category: category,
            image: image,
            description: description,
            user: USER["id"],
            files: files
        };

        let result = request(BASE_URL_API, "projects/add", JSON.stringify(data));

        if (result["status"] === 200) {
            closeModalProject();
            updateProjectsList();
            toast("success", "Projet ajouté", "Le projet a bien été ajouté.");
        } else {
            toast("error", "Une erreur est survenue", "Une erreur est survenue lors de l'ajout du projet.");
        }
    }
}

/**
 * Cette fonction permet de supprimer un projet dans la base de données avec l'API
 *
 * @param id : L'identifiant du projet
 */
function deleteProject(id) {
    Swal.fire({
        title: "Êtes-vous sûr ?",
        text: "Voulez-vous vraiment supprimer ce projet ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui",
        cancelButtonText: "Non",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            let result = request(BASE_URL_API, "projects/delete/" + id);
            if (result["status"] === 200) {
                updateProjectsList();
                toast("success", "Projet supprimé", "Le projet a bien été supprimé.");
            } else {
                toast("error", "Une erreur est survenue", "Une erreur est survenue lors de la suppression du projet.");
            }
        }
    });

}

function updateProject(id) {
    const title = $("#modal-project-action_form-title").val();
    const status = $("#modal-project-action_form-status").is(":checked") ? 1 : 0;
    const category = $("#modal-project-action_form-category").val();
    const text = tinymce.get("modal-project-action_form-texteditor").getContent();

    // TODO: Update project with API

}

/**
 * Cette fonction permet de récupérer la liste des projets et de les afficher dans le tableau
 */
function updateProjectsList() {
    let projects = request(BASE_URL_API, "projects/list")["data"];
    projectsDatatable.clear();
    projectsDatatable.rows.add(projects);
    projectsDatatable.draw();
}