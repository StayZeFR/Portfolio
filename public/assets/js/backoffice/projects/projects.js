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
                html += "<option value='" + category["ID_CATEGORY"] + "'>" + category["NAME"] + "</option>";
            });
            return html;
        });
    }

    $("#modal-project-action").show();
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
function addProject() {
    const title = $("#modal-project-action_form-title").val();
    const status = $("#modal-project-action_form-status").is(":checked") ? 1 : 0;
    const category = $("#modal-project-action_form-category").val();
    const text = tinymce.get("modal-project-action_form-texteditor").getContent();
    $.ajax({
        url: "/api/projects/add",
        type: "POST",
        dataType: "json",
        async: false,
        data: {
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
                title: "Projet ajouté",
                text: "Le projet a bien été ajouté.",
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