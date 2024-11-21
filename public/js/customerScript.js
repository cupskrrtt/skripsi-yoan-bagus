let selectedId;

$(document).ready(function () {
    var customerTable = $("#customer-table").DataTable({
        ajax: {
            url: "/api/customer/",
            type: "GET",
            dataSrc: function (json) {
                console.log(json.customers);
                return json.customers;
            },
        },
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "customerclass.name" },
            { data: "telp" },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        '<button class="btn btn-primary" onclick="fetchData(' +
                        row.id +
                        ');">Select</button>'
                    );
                },
            },
        ],
    });

    function refreshTable() {
        customerTable.ajax.reload(null, false); // User paging is not reset on reload
    }
    $("#update-button").on("click", function () {
        updateData()
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

    $("#customer-table").on("click", ".select-btn", function () {
        var CustomerId = $(this).data("id");
        fetchCustomerData(CustomerId);
        selectedCustomerId = CustomerId;
    });
});

function fetchData(Id) {
    console.log("FETCH");
    selectedId = Id;
    fetch(`/api/customer/${Id}`)
        .then((response) => response.json())
        .then((Data) => {
            console.log(Data);
            document.getElementById("ID").value = "ID: " + Data.id;
            document.getElementById("Name").value = Data.name;
            document.getElementById("Class").value = Data.class_id;
            document.getElementById("Telp").value = Data.telp;
            changeTextColor();
        })
        .catch((error) => console.error("Error fetching Machine data:", error));
}

function clearForm() {
    document.getElementById("ID").value = "ID: " + "";
    document.getElementById("Name").value = "";
    document.getElementById("Class").value = "";
    document.getElementById("Telp").value = "";

    document.getElementById("Class").selectedIndex = 0;
    document.getElementById("Telp").selectedIndex = 0;
}

function createData() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        const Name = document.getElementById("Name").value;
        const Class = document.getElementById("Class").value;
        const Telp = document.getElementById("Telp").value;

        if (Name === "Nama") {
            alert("Customer name cannot be blank");
            return reject(new Error("Customer name cannot be blank"));
        }
        if (Class === "Class") {
            alert("Customer Class cannot be blank");
            return reject(new Error("Customer Class cannot be blank"));
        }
        if (Telp === "Telp") {
            alert("Customer Telp cannot be blank");
            return reject(new Error("Customer Telp cannot be blank"));
        }

        const Data = {
            name: Name,
            class_id: Class,
            telp: Telp,
        };

        fetch(`/api/customer`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(Data),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to create Machine");
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

function updateData() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        if (selectedId) {
            const Name = document.getElementById("Name").value;
            const Class = document.getElementById("Class").value;
            const Telp = document.getElementById("Telp").value;

            if (Name === "Nama") {
                alert("Customer name cannot be blank");
                return reject(new Error("Customer name cannot be blank"));
            }
            if (Class === "Class") {
                alert("Customer Class cannot be blank");
                return reject(new Error("Customer Class cannot be blank"));
            }
            if (Telp === "Telp") {
                alert("Customer Telp cannot be blank");
                return reject(new Error("Customer Telp cannot be blank"));
            }

            const Data = {
                name: Name,
                class_id: Class,
                telp: Telp,
            };
            fetch(`/api/customer/${selectedId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(Data),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Failed to update Customer");
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
            fetch(`/api/customer/${selectedId}`, {
                method: "DELETE",
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Failed to delete Customer");
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
            console.error("No Customer selected for deletion");
            reject(new Error("No Customer selected for deletion"));
        }
    });
}

// auto dashed after  digits
document.getElementById("Telp").addEventListener("input", function (e) {
    var input = e.target.value.replace(/\D/g, ""); // Remove all non-digits
    var formatted = "";

    // Loop through the digits and add a dash after every 4th digit
    for (let i = 0; i < input.length; i++) {
        if (i !== 0 && i % 4 === 0) {
            formatted += "-"; // Add dash
        }
        formatted += input[i];
    }

    e.target.value = formatted; // Update the input field
});
