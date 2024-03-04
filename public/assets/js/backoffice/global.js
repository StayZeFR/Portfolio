/**
 * Cette fonction permet d'afficher une notification
 *
 * @param type : string type de la notification
 * @param title : string titre de la notification
 * @param message : string message de la notification
 */
function toast(type, title, message = "") {
    type = type.toLowerCase();
    message = message.trim();
    title = title.trim();
    if (type === "success" || type === "error" || type === "warning" || type === "info") {
        sweetAlert.fire({
            icon: type,
            title: title,
            text: message,
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }
}

/**
 * Cette fonction permet de lire le contenu d'un fichier
 *
 * @param file : Le fichier à lire
 * @returns {Promise<unknown>} : Le contenu du fichier
 */
function readFileContent(file) {
    return new Promise((resolve, reject) => {
        let reader = new FileReader();
        reader.onload = function(e) {
            resolve(e.target.result);
        };
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}