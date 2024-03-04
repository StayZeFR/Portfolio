/**
 * Cette fonction permet d'afficher le modal de catégorie
 *
 * @param action : Action à réaliser (update ou add)
 * @param id : ID de la catégorie
 */
function showModalCategory(action, id) {
    $("#modal-category-action_title").html(action === "update" ? "Modifier une catégorie - ID : " + id : "Ajouter une catégorie");
    $("#modal-category-action_valid").html(action === "update" ? "Modifier" : "Ajouter").attr("onclick", action === "update" ? "updateCategory(" + id + ")" : "addCategory()");

    if (action === "update") {
        const category = request(BASE_URL_API, "categories/" + id, {})["data"];
        $("#modal-category-action_name").val(category["name"]);
        $("#modal-category-action_status").prop("checked", category["status"] === "1");
    }

    $("#modal-category-action").show();
}

/**
 * Cette fonction permet de fermer la modal de catégorie
 */
function closeModalCategory() {
    $("#modal-category-action").hide();
    $("#modal-category-action_toast").html("");
    $("#modal-category-action_name").val("");
    $("#modal-category-action_status").prop("checked", true);
}

/**
 * Cette fonction permet d'ajouter une catégorie
 */
function addCategory() {
    const name = $("#modal-category-action_name").val();
    const status = $("#modal-category-action_status").prop("checked");
    if (name !== "") {
        let data = {
            "name": name,
            "status": (status ? 1 : 0),
            "user": USER["id"]
        };
        let result = request(BASE_URL_API, "categories/add", data);
        if (result["status"] === 200) {
            closeModalCategory();
            updateCategoriesList();
            toast("success", "Catégorie ajoutée", "La catégorie a bien été ajoutée !");
        } else {
            toast("error", "Erreur", "Une erreur est survenue lors de l'ajout de la catégorie !");
        }
    } else {
        toast("error", "Veuillez remplir tous les champs !");
    }
}

/**
 * Cette fonction permet de supprimer une catégorie
 *
 * @param id : ID de la catégorie
 */
function deleteCategory(id) {
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
            let result = request(BASE_URL_API, "categories/delete/" + id)
            if (result["status"] === 200) {
                updateCategoriesList();
                toast("success", "Catégorie supprimée", "La catégorie a bien été supprimée !");
            } else {
                toast("error", "Erreur", "Une erreur est survenue lors de la suppression de la catégorie !");
            }
        }
    });
}

/**
 * Cette fonction permet de modifier une catégorie
 *
 * @param id : ID de la catégorie
 */
function updateCategory(id) {
    const name = $("#modal-category-action_name").val();
    const status = $("#modal-category-action_status").prop("checked");
    if (name !== "") {
        let data = {
            "name": name,
            "status": (status ? 1 : 0),
            "user": USER["id"]
        };

        let result = request(BASE_URL_API, "categories/update/" + id, data);
        if (result["status"] === 200) {
            closeModalCategory();
            updateCategoriesList();
            toast("success", "Catégorie modifiée", "La catégorie a bien été modifiée !");
        } else {
            toast("error", "Erreur", "Une erreur est survenue lors de la modification de la catégorie !");
        }
    } else {
        toast("error", "Veuillez remplir tous les champs !");
    }
}

/**
 * Cette fonction est appelée lors du chargement de la page pour initialiser les éléments
 */
function updateCategoriesList() {
    let list = request(BASE_URL_API, "categories/list")["data"];
    categoriesDatatable.clear();
    categoriesDatatable.rows.add(list);
    categoriesDatatable.draw();
}