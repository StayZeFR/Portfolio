/**
 * Open modal for action on category
 *
 * @param action
 * @param id
 */
function showModalCategory(action, id) {
    $("#modal-category-action_title").html(action === "edit" ? "Modifier une catégorie - ID : " + id : "Ajouter une catégorie");
    $("#modal-category-action_valid").html(action === "edit" ? "Modifier" : "Ajouter").attr("onclick", action === "edit" ? "updateCategory(" + id + ")" : "addCategory()");

    if (action === "edit") {
        const category = getCategory(id);
        $("#modal-category-action_name").val(category.NAME);
        $("#modal-category-action_status").prop("checked", category.STATUS === "1");
    }

    $("#modal-category-action").show();
}

/**
 * Close modal for action on category
 */
function closeModalCategory() {
    $("#modal-category-action").hide();
    $("#modal-category-action_toast").html("");
    $("#modal-category-action_name").val("");
    $("#modal-category-action_status").prop("checked", true);
}

/**
 * Get category from API by ID
 * @param id
 * @returns {*}
 */
function getCategory(id) {
    let result;
    $.ajax({
        url: "/api/categories/" + id,
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
 * Get types list from API (categories)
 *
 * @returns {*}
 */
function getCategoriesList() {
    let result;
    $.ajax({
        url: "/api/categories/list",
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
 * Add category to database
 */
function addCategory() {
    const name = $("#modal-category-action_name").val();
    const status = $("#modal-category-action_status").prop("checked");
    if (name !== "") {
        $.ajax({
            url: "/api/categories/add",
            type: "POST",
            dataType: "json",
            data: {
                NAME: name,
                STATUS: (status ? 1 : 0)
            },
            success: function (data) {
                closeModalCategory();
                updateCategoriesList();
            }
        });
    } else {
        toast("modal-category-action_toast", "error", "Veuillez remplir tous les champs !");
    }
}

/**
 * Delete category from database
 *
 * @param id
 */
function deleteCategory(id) {
    console.log(id);
    $.ajax({
        url: "/api/categories/delete",
        type: "POST",
        dataType: "json",
        data: {
            ID: id
        },
        success: function (data) {
            updateCategoriesList();
        }
    });
}

/**
 * Edit project in database
 *
 * @param id
 */
function updateCategory(id) {
    const name = $("#modal-category-action_name").val();
    const status = $("#modal-category-action_status").prop("checked");
    if (name !== "") {
        $.ajax({
            url: "/api/categories/update",
            type: "POST",
            dataType: "json",
            data: {
                ID: id,
                NAME: name,
                STATUS: (status ? 1 : 0)
            },
            success: function (data) {
                closeModalCategory();
                updateCategoriesList();
            }
        });
    } else {
        toast("modal-category-action_toast", "error", "Veuillez remplir tous les champs !");
    }
}

/**
 * Update types list in datatable
 */
function updateCategoriesList() {
    let types = getCategoriesList();
    categoriesDatatable.clear();
    categoriesDatatable.rows.add(types);
    categoriesDatatable.draw();
}