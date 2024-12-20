let selectedId;
let selectedTransaction = [];
let tableItem;
var discount = 0;

$(document).ready(function () {
    var transactionTable = $("#transaction-table").DataTable({
        ajax: {
            url: "/api/archive/selling/transaction",
            type: "GET",
            dataSrc: function (json) {
                console.log(json);
                return json.transactions;
            },
        },
        columns: [
            { data: "id" },
            { data: "customer.name" },
            {
                data: "total",
                render: function (data, type, row) {
                    return data
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
            },
            {
                data: "paid",
                render: function (data, type, row) {
                    return data
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
            },
            { data: "paymentmethod.name" },
            {
                data: null,
                render: function (data, type, row) {
                    var productsHtml = "<ul>";
                    data.products.forEach(function (product) {
                        productsHtml +=
                            "<li>" +
                            product.name +
                            " (" +
                            product.pivot.quantity +
                            ")</li>";
                    });
                    productsHtml += "</ul>";
                    return productsHtml;
                },
            },
            {
                data: "created_at",
                render: function (data, type, row) {
                    var date = new Date(data);
                    var options = {
                        year: "numeric",
                        month: "long",
                        day: "numeric",
                    };
                    return (
                        date.toLocaleDateString(undefined, options) +
                        " " +
                        date.toLocaleTimeString()
                    );
                },
            },
        ],
    });

    function refreshTable() {
        transactionTable.ajax.reload(null, false);
    }
    $("#update-button").on("click", function () {
        updateData()
            .then(() => {
                updateItem(selectedId);
            })
            .then(() => {
                refreshTable();
                clearForm();
            })
            .catch((error) => {
                console.error("Update failed:", error);
            });
    });
    $("#create-button").on("click", function () {
        createData()
            .then(() => {
                refreshTable();
                clearForm();
            })
            .catch((error) => {
                console.error("Creation failed:", error);
            });
    });
    $("#delete-button").on("click", function () {
        deleteData()
            .then(() => {
                refreshTable();
                clearForm();
            })
            .catch((error) => {
                console.error("Deletion failed:", error);
            });
    });

    $("#transaction-table tbody").on("click", "tr", function () {
        var data = transactionTable.row(this).data();
        selectedId = data.id;
        fetchData(data.id);
    });

    $("#detail-product").on("click", function () {
        console.log("WOI");
        $("#exampleModal").modal("show");
        populateTransaction(selectedTransaction);
    });
});

$(document).ready(function () {
    tableItem = $("#selectedTransactionTable").DataTable({
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

function fetchData(Id) {
    console.log("FETCH");
    selectedId = Id;
    fetch(`/api/archive/selling/transaction/${Id}`)
        .then((response) => response.json())
        .then((Data) => {
            console.log(Data);
            document.getElementById("ID").value = "ID: " + Data.id;
            document.getElementById("customerName").value = Data.customer_id;
            document.getElementById("totalPrice").value = Data.total;
            document.getElementById("paid").value = Data.paid;
            document.getElementById("Payment").value = Data.payment_id;
            changeTextColor();
            discount = Data.customer.customerclass.discount;
            selectedTransaction = [];
            if (Array.isArray(Data.products)) {
                Data.products.forEach((product) => {
                    selectedTransaction.push({
                        id: product.id,
                        name: product.name,
                        size: product.size.name,
                        code: product.code,
                        // @AR, start
                        //price: product.purchase_price,
                        price: product.selling_price,
                        // @AR, end
                        quantity: product.quantity,
                    });
                });
            }
            console.log(selectedTransaction);
            console.log(discount);
        })

        .catch((error) => console.error("Error fetching Machine data:", error));
}

function populateTransaction(items) {
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

    // calculateTotalHTM();
    // @AR, start
    calculateTotalHTM();
    // @AR, end
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

function clearForm() {
    document.getElementById("ID").value = "ID: " + "";
    document.getElementById("customerName").value = "";
    document.getElementById("totalPrice").value = "";
    document.getElementById("paid").value = "";
    document.getElementById("Payment").value = "";

    document.getElementById("customerName").selectedIndex = 0;
    document.getElementById("Payment").selectedIndex = 0;
}

function updateData() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        if (selectedId) {
            const customerName = document.getElementById("customerName").value;
            const totalPrice = document.getElementById("totalPrice").value;
            const paid = document.getElementById("paid").value;
            const Payment = document.getElementById("Payment").value;

            if (customerName === "Select a customer") {
                alert("Customer name cannot be blank");
                return reject(new Error("Customer name cannot be blank"));
            }
            if (totalPrice === "Total") {
                alert("Total cannot be blank");
                return reject(new Error("Total cannot be blank"));
            }
            if (paid === "Paid") {
                alert("Paid cannot be blank");
                return reject(new Error("Paid cannot be blank"));
            }
            if (Payment === "Payment") {
                alert("Payment cannot be blank");
                return reject(new Error("Payment cannot be blank"));
            }

            const Data = {
                customer_id: customerName,
                total: parseInt(totalPrice),
                paid: parseInt(paid),
                payment_id: Payment,
            };
            console.log(Data);
            fetch(`/api/archive/selling/transaction/${selectedId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(Data),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Failed to update Machine");
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
        } else {
            console.error("No Machine selected for update");
            reject(new Error("No Machine selected for update"));
        }
    });
}

function deleteData() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        if (selectedId) {
            fetch(`/api/archive/selling/transaction/${selectedId}`, {
                method: "DELETE",
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Failed to delete Machine");
                    }
                    return response.json();
                })
                .then((data) => {
                    clearForm();
                    resolve(data);
                })
                .catch((error) => {
                    console.error("Error:", error);
                    reject(error);
                });
        } else {
            console.error("No Machine selected for deletion");
            reject(new Error("No Machine selected for deletion"));
        }
    });
}

function updateItem(id) {
    return new Promise((resolve, reject) => {
        const requestBody = {
            transaction_id: id,
            items: selectedTransaction,
        };

        console.log(requestBody);
        fetch(`/api/archive/selling/${id}/updateItem`, {
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
                clearForm();
                resolve(data);
            })
            .catch((error) => {
                console.error("Error:", error);
                reject(error);
            });
    });
}

function removeFromCart(button) {
    var row = button.closest("tr");
    if (!row) {
        return; // Exit the function if the row is not found
    }

    var itemId = row.cells[0].innerText;

    // Remove the item from selectedItems array
    selectedTransaction = selectedTransaction.filter(function (item) {
        return item.id !== itemId;
    });

    // Remove the row from the selected items table
    row.remove();
    console.log(selectedTransaction);
    calculateTotalHTM();
}

function updateQuantity(input) {
    var row = input.closest("tr");
    if (!row) {
        return; // Exit the function if the row is not found
    }

    var itemId = parseInt(row.cells[0].innerText);
    var newQuantity = parseInt(input.value);
    console.log(itemId);

    var existingItem = selectedTransaction.find(function (item) {
        return item.id === itemId;
    });
    console.log(existingItem);
    if (existingItem) {
        // Update the quantity in selectedTransaction array
        existingItem.quantity = newQuantity;
        // Update the corresponding row in the selected items table
        var selectedRows = document.querySelectorAll(
            "#selectedTransactionTable tr"
        );
        for (var i = 0; i < selectedRows.length; i++) {
            if (selectedRows[i].cells[0].innerText === itemId) {
                var quantityInput = selectedRows[i].querySelector(".quantity");
                quantityInput.value = newQuantity; // Update the value of the quantity input field
                break;
            }
        }
    } else {
        console.error("Item not found in selectedTransaction array.");
    }
}

function calculateTotalHTM() {
    totalHTM = 0;
    for (let i = 0; i < selectedTransaction.length; i++) {
        let htm =
            selectedTransaction[i].quantity *
            parseInt(selectedTransaction[i].price) *
            ((100 - discount) / 100);
        totalHTM += htm;
    }
    console.log(totalHTM);
    document.getElementById("totalHTM").innerText = parseInt(totalHTM);
    document.getElementById("totalPrice").value = parseInt(totalHTM);
}

document.getElementById("customerName").addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    discount = selectedOption.getAttribute("data-discount");
    console.log("Selected Discount:", discount);
});

function closeModal() {
    $("#exampleModal").modal("hide");
}

function selectedModal() {
    selectedTransactionTemp = JSON.parse(JSON.stringify(selectedTransaction));
}

function revertModal() {
    selectedTransaction = JSON.parse(JSON.stringify(selectedTransactionTemp));
    // calculateTotalHTM();
}

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
