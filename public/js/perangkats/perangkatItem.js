


function getProducts(params) {

    return new Promise((resolve, reject) => {
        $.get(window.base_url + "/api/products", params , resolve).catch((reject));
    });

}

function searchProduct(e) {
    e.preventDefault();

    let perangkat_id = $("#perangkat_id").val();
    let search = $("#search-product").val();

    getProducts({ perangkat_id: parseInt(perangkat_id) , search: search }).then( appentProductToHtml );

}

function appentProductToHtml(response) {
    let html = "";

    if (Array.isArray(response.data)) {
        response.data.forEach((product) => {
            html += `
                    <tr>
                        <td>
                            <div class="form-check">
                                <input name="product_ids[]" class="form-check-input" type="checkbox" value="${product.id}" id="defaultCheck1">
                            </div>
                        </td>
                        <td>${product.name}</td>
                        <td>${product.expired_date}</td>
                    </tr>
                `;
        });
    }

    $("#modal-list-products").html(html);
}


$(document).ready(function() {

    var perangkat_id = $("#perangkat_id").val();

    getProducts({ perangkat_id: parseInt(perangkat_id) })
    .then(appentProductToHtml);

});