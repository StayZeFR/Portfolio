/**
 * Open modal for action on project
 *
 * @param action
 * @param id
 */
function showModalProject(action, id) {
    $("#modal-project-action_title").html(action === "update" ? "Modifier un projet - ID : " + id : "Ajouter un projet");
    $("#modal-project-action_valid").html(action === "update" ? "Modifier" : "Ajouter").attr("onclick", action === "update" ? "updateProject(" + id + ")" : "addProject()");

    const categories = getCategoriesList();

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

function getHtmlDocInput(name, add, remove = false) {
    let id = generateRandomId();
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
 * Generate random id
 * @returns {string}
 */
function generateRandomId() {
    return "id_" + Math.random().toString(36).substr(2, 9) + "_" + Date.now().toString(36);
}

/**
 * Add document input for project action
 */
function addDocInput() {
    const docs = $("#modal-project-action_form-docs");
    let children = docs.children().get();
    $(children[children.length - 1]).find(".button-doc-add").hide();
    $(children[children.length - 1]).find(".button-doc-remove").attr("disabled", false);
    docs.append(getHtmlDocInput("", true, true));
}

/**
 * Remove document input for project action
 * @param element
 */
function removeDocInput(element) {
    $(element).parent().parent().parent().remove();
    const docs = $("#modal-project-action_form-docs");
    let children = docs.children().get();
    $(children[children.length - 1]).find(".button-doc-add").show();
    $(children[children.length - 1]).find(".button-doc-remove").attr("disabled", children.length === 1);
}

/**
 * Close modal for action on project
 */
function closeModalProject() {
    $("#modal-project-action").hide();
    $("#modal-project-action_toast").html("");
}

function getProject(id) {
    let result;
    $.ajax({
        url: "/api/projects/" + id,
        type: "POST",
        dataType: "json",
        async: false,
        data: {},
        success: function (data) {
            result = data;
        }
    });
    return result;
}

/**
 * Get projects list from API
 *
 * @returns {*}
 */
function getProjectsList() {
    let result;
    $.ajax({
        url: "/api/projects/list",
        type: "POST",
        dataType: "json",
        async: false,
        success: function (data) {
            result = data;
        }
    });
    return result;
}

/**
 * Add project to database with API
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
        Swal.fire({
            icon: "error",
            title: "Champs manquants",
            text: "Veuillez remplir tous les champs.",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
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

        $.ajax({
            url: "/api/projects/add",
            type: "POST",
            dataType: "json",
            async: false,
            data: JSON.stringify(data),
            success: function (data, status, xhr) {
                closeModalProject();
                updateProjectsList();
                if (xhr.status === 201) {
                    Swal.fire({
                        icon: "success",
                        title: "Projet ajouté",
                        text: "Le projet a bien été ajouté.",
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Une erreur est survenue",
                        text: "Une erreur est survenue lors de l'ajout du projet.",
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            },
            error: function (e) {
                console.log(e);
                Swal.fire({
                    icon: "error",
                    title: "Une erreur est survenue",
                    text: "Une erreur est survenue lors de l'ajout du projet.",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        });
    }
}

function readFileContent(file) {
    return new Promise((resolve, reject) => {
        let reader = new FileReader();
        reader.onload = function(e) {
            resolve(e.target.result);
        };
        reader.onerror = reject;
        reader.readAsDataURL(file);
        console.log("ICI")
    });
}

/**
 * Delete project from database with API
 *
 * @param id
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
            $.ajax({
                url: "/api/projects/delete",
                type: "POST",
                dataType: "json",
                async: false,
                data: {
                    id: id
                },
                success: function (data) {
                    updateProjectsList();
                    Swal.fire({
                        icon: "success",
                        title: "Projet supprimé",
                        text: "Le projet a bien été supprimé.",
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                },
                error: function (e) {
                    Swal.fire({
                        icon: "error",
                        title: "Une erreur est survenue",
                        text: "Une erreur est survenue lors de la suppression du projet.",
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            });
        }
    });

}

function updateProject(id) {
    const title = $("#modal-project-action_form-title").val();
    const status = $("#modal-project-action_form-status").is(":checked") ? 1 : 0;
    const category = $("#modal-project-action_form-category").val();
    const text = tinymce.get("modal-project-action_form-texteditor").getContent();
    $.ajax({
        url: "/api/projects/update",
        type: "POST",
        dataType: "json",
        async: false,
        data: {
            id: id,
            title: title,
            status: status,
            category: category,
            text: text
        },
        success: function (data) {
            closeModalProject();
            updateProjectsList();
            Swal.fire({
                icon: "success",
                title: "Projet modifié",
                text: "Le projet a bien été modifié.",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        },
        error: function (e) {
            Swal.fire({
                icon: "error",
                title: "Une erreur est survenue",
                text: "Une erreur est survenue lors de la modification du projet.",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        }
    });

}

/**
 * Update projects list in datatable
 */
function updateProjectsList() {
    let projects = getProjectsList();
    projectsDatatable.clear();
    projectsDatatable.rows.add(projects);
    projectsDatatable.draw();
}