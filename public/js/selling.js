let selectedId;
var discount = 0;
var totalHTM = 0;
var selectedItems = [];
let tableSell = $("#selling-table").DataTable();
var tableItem;

$(document).ready(function () {
    console.log(selectedItems);

    $("#saveChanges").on("click", function () {
        closeModal();
        selectedModal();
        populateItems2(selectedItems);
    });

    $("#saveChangesOut").on("click", function () {
        console.log("Changes saved, updated selectedItems:", selectedItems);
        populateItems2(selectedItems);
    });

    $("#create-button").on("click", function () {
        createItem()
            .then((newItemId) => {
                createItem2(newItemId, selectedItems);
                clearForm();
            })
            .catch((error) => {
                console.error("Update failed:", error);
            });
    });

    $.ajax({
        url: "/api/archive/selling/transaction",
        method: "GET",
        success: function (data) {
            console.log("API Response:", data); // Log the JSON data
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(
                "There was a problem with the ajax request:",
                textStatus,
                errorThrown
            );
            console.error("Response text:", jqXHR.responseText);
        },
    });
});

function clearForm() {
    document.getElementById("customerName").value = "";
    document.getElementById("totalPrice").value = "";
    document.getElementById("paid").value = "";
    document.getElementById("Payment").value = "";

    document.getElementById("customerName").selectedIndex = 0;
    document.getElementById("Payment").selectedIndex = 0;
    selectedItems = [];
    console.log(selectedItems);
    tableSell.clear().draw();
    tableItem.clear().draw();
}

function changeTextColor() {
    var inputControl = document.querySelectorAll(".form-control");
    var inputSelect = document.querySelectorAll(".form-select");

    inputControl.forEach(function (field) {
        field.style.color = "black";
    });
    inputSelect.forEach(function (field) {
        field.style.color = "black";
    });
}

function createItem() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        const customerName = document.getElementById("customerName").value;
        const totalPrice = document.getElementById("totalPrice").value;
        const paid = document.getElementById("paid").value;
        const payment = document.getElementById("Payment").value;

        if (customerName === "Select a customer") {
            alert("Customer name cannot be blank");
            return reject(new Error("Customer name cannot be blank"));
        }
        if (totalPrice === "Total") {
            alert("Total price cannot be blank");
            return reject(new Error("Total price cannot be blank"));
        }
        // @AR, start
        //if (paid === "Paid") {
        if (paid === "Paid" || paid === "" || paid === "NaN") {
        // @AR, end
            alert("Paid price cannot be blank");
            return reject(new Error("Paid price cannot be blank"));
        }
        if (payment === "Payment") {
            alert("Payment cannot be blank");
            return reject(new Error("Payment cannot be blank"));
        }

        const sellingData = {
            customer_id: customerName,
            total: totalPrice,
            paid: paid,
            payment_id: payment,
        };

        console.log(sellingData);
        fetch(`/api/selling/transaction`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(sellingData),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to create Transaction Archive");
                }
                return response.json();
            })
            .then((data) => {
                console.log(data.id);
                resolve(data.id);
            })
            .catch((error) => {
                console.error("Error:", error);
                reject(error);
            });
    });
}
function createItem2(newItemId, items) {
    return new Promise((resolve, reject) => {
        const customerName = document.getElementById("customerName").value;

        const requestBody = {
            transaction_id: newItemId,
            items: items,
        };
        console.log(requestBody);
        fetch(`/api/selling/item`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestBody),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to create Archive");
                }
                return response.json();
            })
            .then((data) => {
                resolve(data);
            })
            .catch((error) => {
                console.error("Error:", error);
                reject(error);
            });
    });
}

//PRODUCT PRODUCT PRODUCT
$(document).ready(function () {
    console.log("AHA");
    var productTable = $("#products-table").DataTable({
        ajax: {
            url: "/api/products/", // Change this to your actual endpoint
            type: "GET",
            dataSrc: function (json) {
                console.log(json);
                return json.products;
            },
        },
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "size.name" },
            { data: "code" },
            // @AR, start
            //{ data: "purchase_price" },
            { data: "selling_price" },
            // @AR, end
            {
                data: null,
                render: function (data, type, row) {
                    return `<input type="number" class="form-control quantity" value="0" onfocus="clearDefaultValue(this)" oninput="calculateHTM(this)" />`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<td class="total">0</td>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<td class="total-after-discount">0</td>`;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `<button type="button" id="addItem" class="btn btn-primary" onclick="addToCart(this)">Add</button>`;
                },
            },
        ],
    });

    $("#pilih-product").on("click", function () {
        populateItems(selectedItems);
    });
});

$(document).ready(function () {
    tableItem = $("#selectedItemsTable").DataTable({
        columns: [
            { title: "ID" },
            { title: "Name" },
            { title: "Size" },
            { title: "Code" },
            { title: "Price" },
            { title: "Quantity" },
            { title: "Total" },
            { title: "After Discount" },
            { title: "Action" },
        ],
    });
});

function populateItems(items) {
    console.log(items);
    items.sort((a, b) => a.id - b.id);
    tableItem.clear();

    const addedItemlIds = new Set();

    items.forEach(function (item) {
        if (!addedItemlIds.has(item.id)) {
            var quantity = parseInt(item.quantity);
            var total = item.price * quantity;
            var afterDiscount = total * ((100 - discount) / 100);
            var newRow = [
                item.id,
                item.name,
                item.size,
                item.code,
                item.price,
                '<input type="number" class="form-control quantity" value="' +
                    quantity +
                    '" onchange="updateQuantity(this); calculateTotalHTM(this)">',
                '<span class="total">' + total + "</span>",
                '<span class="after-discount">' + afterDiscount + "</span>",
                '<button type="button" class="btn btn-danger" onclick="removeFromCart(this)">Remove</button>',
            ];

            tableItem.row.add(newRow).draw();
            addedItemlIds.add(item.id);
        }
    });

    calculateTotalHTM();
}

function populateItems2(items) {
    console.log(items);
    items.sort((a, b) => a.id - b.id);
    // var table = $("#selling-table").DataTable();
    tableSell.clear();

    const addedItemlIds = new Set();

    items.forEach(function (item) {
        if (!addedItemlIds.has(item.id)) {
            var quantity = parseInt(item.quantity);
            var total = item.price * quantity;
            var afterDiscount = total * ((100 - discount) / 100);
            var newRow = [
                item.id,
                item.name,
                item.size,
                item.code,
                item.price,
                '<input type="number" class="form-control quantity" value="' +
                    quantity +
                    '" onchange="updateQuantity(this); calculateTotalHTM(this)">',
                '<span class="total">' + total + "</span>",
                '<span class="after-discount">' + afterDiscount + "</span>",
                '<button type="button" class="btn btn-danger" onclick="removeFromCart(this)">Remove</button>',
            ];

            tableSell.row.add(newRow).draw();
            addedItemlIds.add(item.id);
        }
    });

    calculateTotalHTM();
}

function addToCart(button) {
    var row = button.closest("tr");
    if (!row) {
        return;
    }

    var itemId = row.cells[0].innerText;
    var quantityInput = row.querySelector(".quantity");
    var quantity = parseInt(quantityInput.value);

    if (isNaN(quantity) || quantity <= 0) {
        alert("Please enter a valid quantity.");
        return;
    }

    var existingItemIndex = selectedItems.findIndex(function (item) {
        return item.id === itemId;
    });

    if (existingItemIndex !== -1) {
        selectedItems[existingItemIndex].quantity += quantity;
    } else {
        var itemName = row.cells[1].innerText;
        var size = row.cells[2].innerText;
        var code = row.cells[3].innerText;
        var price = parseInt(row.cells[4].innerText);
        var total = price * quantity;
        var totalAfterDiscount = parseInt(total * ((100 - discount) / 100));

        selectedItems.push({
            id: itemId,
            name: itemName,
            size: size,
            code: code,
            price: price,
            quantity: quantity,
            total: total,
            totalAfterDiscount: totalAfterDiscount,
        });
    }
    quantityInput.value = 0;
    console.log(selectedItems);
    populateItems(selectedItems);
}

function removeFromCart(button) {
    var row = button.closest("tr");
    if (!row) {
        return; // Exit the function if the row is not found
    }

    var itemId = row.cells[0].innerText;

    // Remove the item from selectedItems array
    selectedItems = selectedItems.filter(function (item) {
        return item.id !== itemId;
    });

    // Remove the row from the selected items table
    row.remove();
    console.log(selectedItems);
    calculateTotalHTM();
}

function updateQuantity(input) {
    var row = input.closest("tr");
    if (!row) {
        return; // Exit the function if the row is not found
    }

    var itemId = row.cells[0].innerText;
    var newQuantity = parseInt(input.value);

    // Find the item in selectedMaterials array and update its quantity
    var existingItem = selectedItems.find(function (item) {
        return item.id === itemId;
    });

    if (existingItem) {
        // Update the quantity in selectedItems array
        existingItem.quantity = newQuantity;
        // Update the corresponding row in the selected items table
        var selectedRows = document.querySelectorAll("#selectedItemsBody tr");
        for (var i = 0; i < selectedRows.length; i++) {
            if (selectedRows[i].cells[0].innerText === itemId) {
                var quantityInput = selectedRows[i].querySelector(".quantity");
                quantityInput.value = newQuantity; // Update the value of the quantity input field
                break;
            }
        }
    } else {
        console.error("Item not found in selectedItems array.");
    }
}

function closeModal() {
    $("#exampleModal").modal("hide");
}

function selectedModal() {
    selectedItemsTemp = JSON.parse(JSON.stringify(selectedItems));
}

function revertModal() {
    selectedItems = JSON.parse(JSON.stringify(selectedItemsTemp));
    calculateTotalHTM();
}

//TOTAL TOTAL TOTAL
function calculateHTM(input) {
    var row = input.parentNode.parentNode;
    var price = parseInt(row.cells[4].innerHTML);
    var quantity = parseInt(input.value);
    var total = price * quantity;
    row.cells[6].innerHTML = total;

    // Calculate the total after discount
    var totalAfterDiscount = total - total * (discount / 100);
    row.cells[7].innerHTML = totalAfterDiscount;
}
function calculateTotalHTM() {
    totalHTM = 0;
    for (let i = 0; i < selectedItems.length; i++) {
        let htm =
            selectedItems[i].quantity *
            parseInt(selectedItems[i].price) *
            ((100 - discount) / 100);
        totalHTM += htm;
    }
    console.log(totalHTM);
    document.getElementById("totalHTM").innerText = parseInt(totalHTM);
    document.getElementById("totalPrice").value = parseInt(totalHTM);
}

function clearDefaultValue(input) {
    if (input.value == 0) {
        input.value = "";
    }
}

document.getElementById("customerName").addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    discount = selectedOption.getAttribute("data-discount");
    console.log("Selected Discount:", discount);
});

// 3 digit separator
// @AR, start
// ngebug pas create/update, cek lagi ntar
//document.getElementById("paid").addEventListener("input", function (e) {
//    let value = e.target.value.replace(/\./g, ""); // Remove existing dots
//    if (!isNaN(value.replace(",", ".")) && value.includes(",")) {
//        let parts = value.split(",");
//        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Add dots to the integer part
//        parts[1] = parts[1].substring(0, 3); // Limit to 3 decimal places
//        e.target.value = parts.join(",");
//    } else if (!isNaN(value.replace(",", "."))) {
//        value = parseFloat(value.replace(",", ".")).toLocaleString("de-DE", {
//            minimumFractionDigits: 0,
//            maximumFractionDigits: 3,
//        });
//        e.target.value = value.replace(",", ".");
//    }
//});
// @AR, end
