/**
 * Request the given URL with the given parameters and return the result as a JSON object with the status code
 * @param base
 * @param url
 * @param params
 * @returns {*}
 */
function request(base, url, params = {}) {
    let data;
    const route = base + "/" +  url;
    $.ajax({
        url: route,
        type: "POST",
        data: params,
        dataType: "json",
        async: false,
        success: function (result, status, xhr) {
            data = {
                "status": xhr.status,
                "data": result
            };
        },
        error: function (error) {
            data = {
                "status": 500,
                "data": error
            };
            console.log("Error : " + JSON.stringify(data));
        }
    });
    return data;
}