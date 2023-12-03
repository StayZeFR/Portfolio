/**
 * Open modal for action on project
 *
 * @param action
 * @param id
 */
function showModalProject(action, id) {
    $("#modal-project-action_title").html(action === "edit" ? "Modifier un projet - ID : " + id : "Ajouter un projet");
    $("#modal-project-action_valid").html(action === "edit" ? "Modifier" : "Ajouter").attr("onclick", action === "edit" ? "editProject(" + id + ")" : "addProject()");

    const categories = getCategoriesList();

    if (action === "edit") {
        const project = getProject(id);
        $("#modal-project-action_form-title").val(project["TITLE"]);
        $("#modal-project-action_form-status").prop("checked", project.STATUS === "1");
        $("#modal-project-action_form-category").append(function () {
            let html = "";
            categories.forEach(category => {
                html += "<option value='" + category["ID_CATEGORY"] + "' " + (category["ID_CATEGORY"] === project["ID_CATEGORY"] ? "selected" : "") + ">" + category["NAME"] + "</option>";
            });
            return html;
        });
        $("#modal-project-action_form-texteditor").html(project["TEXT"]);
    } else {
        $("#modal-project-action_form-title").val("");
        $("#modal-project-action_form-status").prop("checked", true);
        $("#modal-project-action_form-category").append(function () {
            let html = "<option value=''>Sélectionner une categorie...</option>";
            categories.forEach(category => {
                html += "<option value='" + category["ID_CATEGORY"] + "'>" + category["NAME"] + "</option>";
            });
            return html;
        });
        $("#modal-project-action_form-texteditor").html("");
    }

    $("#modal-project-action").show();
}

/**
 * Close modal for action on project
 */
function closeModalProject() {
    $("#modal-project-action").hide();
    const editor = tinymce.EditorManager.activeEditor;
    if (editor) {
        editor.resetContent();
    }
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
            if (data.status === "success") {
                closeModalProject();
                updateProjectsList();
                toast("modal-project-action_toast", "success", "Le projet a bien été ajouté.");
            } else {
                toast("modal-project-action_toast", "error", "Une erreur est survenue lors de l'ajout du projet.");
            }
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