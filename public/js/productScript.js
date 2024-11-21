let selectedProductId;
let selectedMaterials = [];
let totalHTM = 0;
let selectedMaterialsTemp = [];

function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");

    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

// datepicker
$(".datepicker").datepicker({
    dateFormat: "yy-mm-dd",
});

//PRODUCT
$(document).ready(function () {
    var productTable = $("#products-table").DataTable({
        ajax: {
            url: "/api/products/",
            type: "GET",
            dataSrc: function (json) {
                console.log(json);
                return json.products;
            },
        },
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "type.name" },
            { data: "category.name" },
            { data: "size.name" },
            { data: "color.name" },
            { data: "sign.name" },
            { data: "code" },
            {
                data: "purchase_price",
                render: function (data, type, row) {
                    return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
            },
            {
                data: "selling_price",
                render: function (data, type, row) {
                    return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
            },
            { data: "stock" },
            {
                data: null,
                render: function (data, type, row) {
                    var materialsHtml = "<ul>";
                    data.materials.forEach(function (material) {
                        materialsHtml +=
                            "<li>" +
                            material.name +
                            " (" +
                            material.pivot.quantity +
                            ")</li>";
                    });
                    materialsHtml += "</ul>";
                    return materialsHtml;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <td>
                            <a href="#" onclick="resetSelectedMaterials(); 
                                                    ${row.materials
                                                        .map(
                                                            (material) => `
                                                        addToSelectedMaterials(
                                                        '${material.id}',
                                                        '${material.name}',
                                                        '${material.purchase_price}',
                                                        '${material.unit.name}',
                                                        '${material.pivot.quantity}'
                                                    );`
                                                        )
                                                        .join("")}
                                                    selectedModal();
                                                    populateFields('${
                                                        row.id
                                                    }');" class="btn btn-primary">Select</a>
                        </td>
                    `;
                },
            },
        ],
    });
    function refreshTable() {
        productTable.ajax.reload(null, false);
    }
    $("#update-button").on("click", function () {
        updateProduct()
            .then(() => {
                refreshTable();
            })
            .catch((error) => {
                console.error("Update failed:", error);
            });
    });
    $("#create-button").on("click", function () {
        createProduct()
            .then(() => {
                refreshTable();
            })
            .catch((error) => {
                console.error("Creation failed:", error);
            });
    });
    $("#delete-button").on("click", function () {
        deleteProduct()
            .then(() => {
                refreshTable();
            })
            .catch((error) => {
                console.error("Deletion failed:", error);
            });
    });
});

//MATERIAL
$(document).ready(function () {
    var materialTable = $("#materials-table").DataTable({
        ajax: {
            url: "/api/materials/", // Change this to your actual endpoint
            type: "GET",
            dataSrc: function (json) {
                console.log(json);
                return json.materials;
            },
        },
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "purchase_price" },
            { data: "materialunit.name" },
            {
                data: null,
                render: function (data, type, row) {
                    return `<input type="number" class="form-control quantity" value="0" onfocus="clearDefaultValue(this)" oninput="calculateHTM(this)" />`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<td class="htm">0</td>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<button type="button" class="btn btn-primary" onclick="addToCart(this)">Add</button>`;
                },
            },
        ],
    });

    $("#pilih-material").on("click", function () {
        populateMaterials(selectedMaterials);
    });
});

// POPULATE POPULATE POPULATE POPULATE POPULATE
function populateFields(productId) {
    selectedProductId = productId;
    fetchProductData(productId);
}

function fetchProductData(productId) {
    fetch(`/api/products/${productId}`)
        .then((response) => response.json())
        .then((productData) => {
            console.log(productData);
            document.getElementById("ID").value = "ID: " + productData.id;
            document.getElementById("productName").value = productData.name;
            document.getElementById("productType").value = productData.type_id;
            document.getElementById("productCategory").value = productData.category_id;
            document.getElementById("productSize").value = productData.size_id;
            document.getElementById("productColor").value = productData.color_id;
            document.getElementById("productSign").value = productData.sign_id;
            document.getElementById("productCode").value = productData.code;
            document.getElementById("productPurchasePrice").value = productData.purchase_price;
            document.getElementById("productSellingPrice").value = productData.selling_price;
            document.getElementById("productStock").value = productData.stock;
            changeTextColor();
        })
        .catch((error) => console.error("Error fetching product data:", error));
}

function clearForm() {
    document.getElementById("ID").value = "";
    document.getElementById("productName").value = "";
    document.getElementById("productType").value = "";
    document.getElementById("productCategory").value = "";
    document.getElementById("productSize").value = "";
    document.getElementById("productColor").value = "";
    document.getElementById("productSign").value = "";
    document.getElementById("productCode").value = "";
    document.getElementById("productPurchasePrice").value = "";
    document.getElementById("productSellingPrice").value = "";
    document.getElementById("productStock").value = "";

    document.getElementById("productType").selectedIndex = 0;
    document.getElementById("productCategory").selectedIndex = 0;
    document.getElementById("productSize").selectedIndex = 0;
    document.getElementById("productColor").selectedIndex = 0;
    document.getElementById("productSign").selectedIndex = 0;
    resetSelectedMaterials();
    selectedModal();
}

// CRUD CRUD CRUD CRUD CRUD
function createProduct() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        if (!selectedMaterials || selectedMaterials.length === 0) {
            alert("Please select at least one material.");
            return reject(new Error("No materials selected"));
        }
        const productName = document.getElementById("productName").value;
        const productType = document.getElementById("productType").value;
        const productCategory = document.getElementById("productCategory").value;
        const productSize = document.getElementById("productSize").value;
        const productColor = document.getElementById("productColor").value;
        const productSign = document.getElementById("productSign").value;
        const productCode = document.getElementById("productCode").value;
        const productPurchasePrice = totalHTM;
        const productSellingPrice = document.getElementById("productSellingPrice").value;
        const productStock = document.getElementById("productStock").value;

        if (productCode === "Nama") {
            alert("Nama produk harus diisi.");
            return reject(new Error("Product name cannot be blank"));
        }
        if (productType === "Tipe") {
            alert("Tipe produk harus diisi.");
            return reject(new Error("Product type cannot be blank"));
        }
        if (productCategory === "Kategori") {
            alert("Kategori produk harus diisi.");
            return reject(new Error("Product category cannot be blank"));
        }
        if (productSize === "Size") {
            alert("Size produk harus diisi.");
            return reject(new Error("Product size cannot be blank"));
        }
        if (productColor === "Warna") {
            alert("Warna produk harus diisi.");
            return reject(new Error("Product color cannot be blank"));
        }
        if (productSign === "Merk") {
            alert("Merk produk harus diisi.");
            return reject(new Error("Product sign cannot be blank"));
        }
        if (productCode === "Kode") {
            alert("Kode produk harus diisi.");
            return reject(new Error("Product code cannot be blank"));
        }
        if (!productPurchasePrice || productPurchasePrice == 0) {
            alert("Product purchase price cannot be zero or blank.");
            return reject(
                new Error("Product purchase price cannot be zero or blank")
            );
        }
        if (!productSellingPrice || productSellingPrice == 0) {
            alert("Harga Jual produk harus diisi.");
            return reject(
                new Error("Product selling price cannot be zero or blank")
            );
        }
        if (!productStock || productStock == 0) {
            alert("Stock produk harus diisi.");
            return reject(new Error("Product stock cannot be zero or blank"));
        }

        const productData = {
            name: productName,
            type_id: productType,
            category_id: productCategory,
            size_id: productSize,
            color_id: productColor,
            sign_id: productSign,
            code: productCode,
            purchase_price: productPurchasePrice,
            selling_price: productSellingPrice,
            stock: productStock,
        };

        fetch(`/api/products`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(productData),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to create product");
                }
                return response.json();
            })
            .then((data) => {
                var newId = data.product.id;
                updateProductMaterial(newId)
                    .then(() => {
                        resetSelectedMaterials();
                        resolve(data);
                    })
                    .catch((error) => {
                        console.error("Error updating materials:", error);
                        reject(error);
                    });
            })
            .catch((error) => {
                console.error("Error:", error);
                reject(error);
            });
    });
}

function updateProduct() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        if (selectedProductId) {
            const productName = document.getElementById("productName").value;
            const productType = document.getElementById("productType").value;
            const productCategory = document.getElementById("productCategory").value;
            const productSize = document.getElementById("productSize").value;
            const productColor = document.getElementById("productColor").value;
            const productSign = document.getElementById("productSign").value;
            const productCode = document.getElementById("productCode").value;
            const productPurchasePrice = totalHTM;
            const productSellingPrice = document.getElementById("productSellingPrice").value;
            const productStock = document.getElementById("productStock").value;

            if (productCode === "Nama") {
                alert("Nama produk harus diisi.");
                return reject(new Error("Product name cannot be blank"));
            }
            if (productType === "Tipe") {
                alert("Tipe produk harus diisi.");
                return reject(new Error("Product type cannot be blank"));
            }
            if (productCategory === "Kategori") {
                alert("Kategori produk harus diisi.");
                return reject(new Error("Product category cannot be blank"));
            }
            if (productSize === "Size") {
                alert("Size produk harus diisi.");
                return reject(new Error("Product size cannot be blank"));
            }
            if (productColor === "Warna") {
                alert("Warna produk harus diisi.");
                return reject(new Error("Product color cannot be blank"));
            }
            if (productSign === "Merk") {
                alert("Merk produk harus diisi.");
                return reject(new Error("Product sign cannot be blank"));
            }
            if (productCode === "Kode") {
                alert("Kode produk harus diisi.");
                return reject(new Error("Product code cannot be blank"));
            }
            if (!productPurchasePrice || productPurchasePrice == 0) {
                alert("Product purchase price cannot be zero or blank.");
                return reject(
                    new Error("Product purchase price cannot be zero or blank")
                );
            }
            if (!productSellingPrice || productSellingPrice == 0) {
                alert("Harga Jual produk harus diisi.");
                return reject(
                    new Error("Product selling price cannot be zero or blank")
                );
            }
            if (!productStock || productStock == 0) {
                alert("Stock produk harus diisi.");
                return reject(
                    new Error("Product stock cannot be zero or blank")
                );
            }

            const updatedProductData = {
                name: productName,
                type_id: productType,
                category_id: productCategory,
                size_id: productSize,
                color_id: productColor,
                sign_id: productSign,
                code: productCode,
                purchase_price: productPurchasePrice,
                selling_price: productSellingPrice,
                stock: productStock,
            };

            fetch(`/api/products/${selectedProductId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(updatedProductData),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Failed to update product");
                    }
                    return response.json();
                })
                .then((data) => {
                    updateProductMaterial(selectedProductId)
                        .then(() => {
                            resetSelectedMaterials();
                            clearForm();
                            resolve(data);
                        })
                        .catch((error) => {
                            console.error("Error updating materials:", error);
                            reject(error);
                        });
                })
                .catch((error) => {
                    console.error("Error:", error);
                    reject(error);
                });
        } else {
            console.error("No product selected for update");
            reject(new Error("No product selected for update"));
        }
    });
}

function updateProductMaterial(id) {
    return new Promise((resolve, reject) => {
        if (!selectedMaterials || selectedMaterials.length === 0) {
            alert("Please select at least one material.");
            return reject(new Error("No materials selected"));
        }
        const requestBody = {
            productId: id,
            materials: selectedMaterials,
        };

        fetch(`/api/products/${id}/updateMaterials`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestBody),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to update materials");
                }
                return response.json();
            })
            .then((data) => {
                resetSelectedMaterials();
                clearForm();
                resolve(data);
            })
            .catch((error) => {
                console.error("Error:", error);
                reject(error);
            });
    });
}

function deleteProduct() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        if (selectedProductId) {
            fetch(`/api/products/${selectedProductId}`, {
                method: "DELETE",
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Failed to delete product");
                    }
                    return response.json();
                })
                .then((data) => {
                    clearForm();
                    resetSelectedMaterials();
                    resolve(data);
                })
                .catch((error) => {
                    console.error("Error:", error);
                    reject(error);
                });
        } else {
            console.error("No product selected for deletion");
            reject(new Error("No product selected for deletion"));
        }
    });
}

// MATERIAL MATERIAL MATERIAL MATERIAL MATERIAL

function addToSelectedMaterials(
    materialId,
    name,
    purchase_price,
    unit,
    quantity) {
    selectedMaterials.push({
        id: materialId,
        name: name,
        purchase_price: parseInt(purchase_price),
        unit: unit,
        quantity: parseInt(quantity),
    });
    console.log(selectedMaterials);
    calculateTotalHTM();
}

function resetSelectedMaterials() {
    selectedMaterials = [];
    calculateTotalHTM();
}

function populateMaterials(materials) {
    console.log(materials);
    materials.sort((a, b) => a.id - b.id);
    $("#selectedMaterialsBody").empty();
    const addedMaterialIds = new Set();

    materials.forEach(function (material) {
        if (!addedMaterialIds.has(material.id)) {
            var quantity = parseInt(material.quantity);
            var htm = material.purchase_price * quantity;
            var newRow =
                "<tr>" +
                "<td>" +
                material.id +
                "</td>" +
                "<td>" +
                material.name +
                "</td>" +
                "<td>" +
                material.purchase_price +
                "</td>" +
                "<td>" +
                material.unit +
                "</td>" +
                '<td><input type="number" class="form-control quantity" value="' +
                quantity +
                '" onchange="updateQuantity(this); calculateTotalHTM(this)"></td>' +
                "<td>" +
                htm +
                "</td>" +
                '<td><button type="button" class="btn btn-danger" onclick="removeFromCart(this)">Remove</button></td>' +
                "</tr>";

            // Append the new row to the selected materials table
            $("#selectedMaterialsBody").append(newRow);

            // Add the material ID to the set of added IDs
            addedMaterialIds.add(material.id);
        }
    });
    calculateTotalHTM();
}

function addToCart(button) {
    var row = button.closest("tr");
    if (!row) {
        return;
    }

    var materialId = row.cells[0].innerText;
    var quantityInput = row.querySelector(".quantity");
    var quantity = parseInt(quantityInput.value);

    if (isNaN(quantity) || quantity <= 0) {
        alert("Please enter a valid quantity.");
        return;
    }

    var existingMaterialIndex = selectedMaterials.findIndex(function (item) {
        return item.id === materialId;
    });

    if (existingMaterialIndex !== -1) {
        selectedMaterials[existingMaterialIndex].quantity += quantity;
    } else {
        var materialName = row.cells[1].innerText;
        var price = parseInt(row.cells[2].innerText);
        var satuan = row.cells[3].innerText;
        var htm = price * quantity;

        selectedMaterials.push({
            id: materialId,
            name: materialName,
            purchase_price: price,
            unit: satuan,
            quantity: quantity,
        });
    }
    quantityInput.value = 0;

    populateMaterials(selectedMaterials);
}

function removeFromCart(button) {
    // Get the clicked row
    var row = button.closest("tr");
    if (!row) {
        return; // Exit the function if the row is not found
    }

    var materialId = row.cells[0].innerText;

    // Remove the material from selectedMaterials array
    selectedMaterials = selectedMaterials.filter(function (item) {
        return item.id !== materialId;
    });

    // Remove the row from the selected materials table
    row.remove();

    calculateTotalHTM();
}
function updateQuantity(input) {
    var row = input.closest("tr");
    if (!row) {
        return; // Exit the function if the row is not found
    }

    var materialId = row.cells[0].innerText;
    var newQuantity = parseInt(input.value);

    // Find the material in selectedMaterials array and update its quantity
    var existingMaterial = selectedMaterials.find(function (item) {
        return item.id === materialId;
    });

    if (existingMaterial) {
        // Update the quantity in selectedMaterials array
        existingMaterial.quantity = newQuantity;
        // Update the corresponding row in the selected materials table
        var selectedRows = document.querySelectorAll(
            "#selectedMaterialsBody tr"
        );
        for (var i = 0; i < selectedRows.length; i++) {
            if (selectedRows[i].cells[0].innerText === materialId) {
                var quantityInput = selectedRows[i].querySelector(".quantity");
                quantityInput.value = newQuantity; // Update the value of the quantity input field
                break;
            }
        }
    } else {
        console.error("Material not found in selectedMaterials array.");
    }
}

function closeModal() {
    $("#exampleModal").modal("hide");
}

function selectedModal() {
    selectedMaterialsTemp = JSON.parse(JSON.stringify(selectedMaterials));
}

function revertModal() {
    selectedMaterials = JSON.parse(JSON.stringify(selectedMaterialsTemp));
    calculateTotalHTM();
}

$("#exampleModal").on("shown.bs.modal", function () {
    //
});

// HTM
function calculateHTM(input) {
    var row = input.parentNode.parentNode;
    var price = parseInt(row.cells[2].innerHTML);
    var quantity = parseInt(input.value);
    var htm = price * quantity;
    row.cells[5].innerHTML = htm;
}

function calculateTotalHTM() {
    totalHTM = 0;
    for (let i = 0; i < selectedMaterials.length; i++) {
        let htm =
            selectedMaterials[i].quantity *
            parseInt(selectedMaterials[i].purchase_price);
        totalHTM += htm;
    }
    document.getElementById("totalHTM").innerText = totalHTM;
}

function clearDefaultValue(input) {
    if (input.value === "0") {
        input.value = ""; // Clear the default value
    }
}

// datepicker
$(document).ready(function () {
    $("#example").DataTable();
});

type =
    "text/javascript" >
    $(function () {
        $("#startdatepicker").datepicker();
        $("#enddatepicker").datepicker();
    });
