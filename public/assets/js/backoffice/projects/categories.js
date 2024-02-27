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
                name: name,
                status: (status ? 1 : 0),
                user: USER["id"]
            },
            success: function (data) {
                closeModalCategory();
                updateCategoriesList();
                Swal.fire({
                    title: "Catégorie ajoutée",
                    text: "La catégorie a bien été ajoutée !",
                    icon: "success",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            },
            error: function (e) {
                Swal.fire({
                    title: "Erreur",
                    text: "Une erreur est survenue lors de l'ajout de la catégorie !",
                    icon: "error",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
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
            Swal.fire({
                title: "Catégorie supprimée",
                text: "La catégorie a bien été supprimée !",
                icon: "success",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        },
        error: function (e) {
            Swal.fire({
                title: "Erreur",
                text: "Une erreur est survenue lors de la suppression de la catégorie !",
                icon: "error",
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
                Swal.fire({
                    title: "Catégorie modifiée",
                    text: "La catégorie a bien été modifiée !",
                    icon: "success",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        });
    } else {
        Swal.fire({
            title: "Erreur",
            text: "Veuillez remplir tous les champs !",
            icon: "error",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
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