let selectedProjectId;
let selectedProjects = [];
let selectedProjectsTemp = [];

let startDate;
let endDate;

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

//PROJECT
$(document).ready(function () {
    // Initialize the DataTable
    var projectTable = $("#projects-table").DataTable({
        ajax: {
            url: "/api/project/", // Change this to your actual endpoint
            type: "GET",
            dataSrc: function (json) {
                console.log(json.projects);
                // Assuming your JSON structure, you may need to adjust the dataSrc function
                return json.projects;
            },
        },
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "start_date" },
            { data: "end_date" },
            { data: "projectstatus.name" },
            {
                data: null,
                render: function (data, type, row) {
                    var productsHtml = "<ul>"; // Start unordered list
                    data.products.forEach(function (product) {
                        productsHtml +=
                            "<li>" +
                            product.name +
                            " (" +
                            product.pivot.quantity +
                            ")</li>"; // List item for each product
                    });
                    productsHtml += "</ul>"; // End unordered list
                    return productsHtml;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <td>
                            <a href="#" onclick="resetSelectedProjects(); 
                                                    ${row.products
                                                        .map(
                                                            (product) => `
                                                        addToSelectedProjects(
                                                        '${product.id}',                                           
                                                        '${product.name}',
                                                        '${product.size.name}',
                                                        '${product.color.name}',
                                                        '${product.code}',
                                                        '${product.pivot.quantity}'
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
        projectTable.ajax.reload(null, false); // User paging is not reset on reload
    }
    $("#update-button").on("click", function () {
        updateProject()
            .then(() => {
                refreshTable(); // Refresh the table after updateProject is successful
            })
            .catch((error) => {
                console.error("Update failed:", error);
            });
    });
    $("#create-button").on("click", function () {
        createProject()
            .then(() => {
                refreshTable(); // Refresh the table after createProject is successful
            })
            .catch((error) => {
                console.error("Creation failed:", error);
            });
    });
    $("#delete-button").on("click", function () {
        deleteProject()
            .then(() => {
                refreshTable(); // Refresh the table after deleteProject is successful
            })
            .catch((error) => {
                console.error("Deletion failed:", error);
            });
    });
});

//Date Picker
$(document).ready(function () {
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function () {
            $(this).trigger("change");
        },
    });

    function handleInputChange() {
        startDate = $("#projectStartDate").val();
        endDate = $("#projectEndDate").val();
        startDateFilter = $("#date-filter-start").val();
        endDateFilter = $("#date-filter-end").val();

        console.log(startDate);
    }

    $("#projectStartDate, #projectEndDate").on(
        "change input",
        handleInputChange
    );
});

// datepicker filter
$(document).ready(function () {
    // Initialize date pickers for both start and end dates
    $("#date-filter-start, #date-filter-end").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function () {
            $(this).trigger("change"); // This ensures that the change event is fired after date selection
        },
    });

    function handleDateFilterChange() {
        // Fetch the values from the date filters
        var startDateFilter = $("#date-filter-start").val();
        var endDateFilter = $("#date-filter-end").val();

        // Here you might want to reload or filter your DataTable based on the selected dates
        // For example, if you are using DataTables, you might do something like this:
        $("#projects-table").DataTable().ajax.reload();
    }

    // Set up event handlers for changes on the date picker inputs
    $("#date-filter-start, #date-filter-end").on(
        "change",
        handleDateFilterChange
    );
});

//Product
$(document).ready(function () {
    // Initialize the DataTable
    var productTable = $("#products-table").DataTable({
        ajax: {
            url: "/api/products/", // Change this to your actual endpoint
            type: "GET",
            dataSrc: function (json) {
                console.log(json);
                // Assuming your JSON structure, you may need to adjust the dataSrc function
                return json.products;
            },
        },
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "size.name" },
            { data: "color.name" },
            { data: "code" },
            // { data: "stock" },
            {
                data: null,
                render: function (data, type, row) {
                    return `<input type="number" class="form-control quantity" value="0" onfocus="clearDefaultValue(this)" />`;
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

    $("#pilih-product").on("click", function () {
        console.log(selectedProjects);
        populateMaterials(selectedProjects);
    });
});

// POPULATE POPULATE POPULATE POPULATE POPULATE
function populateFields(projectId) {
    selectedProjectId = projectId;
    console.log(projectId);
    fetchProjectData(projectId);
}

function fetchProjectData(projectId) {
    fetch(`/api/project/${projectId}`)
        .then((response) => response.json())
        .then((projectData) => {
            console.log(projectData);
            document.getElementById("ID").value =
                "Project ID: " + projectData.id;
            document.getElementById("projectName").value = projectData.name;
            document.getElementById("projectStartDate").value =
                projectData.start_date;
            document.getElementById("projectEndDate").value =
                projectData.end_date;
            document.getElementById("projectStatus").value =
                projectData.status_id;
            changeTextColor();
        })
        .catch((error) => console.error("Error fetching project data:", error));
}

function clearForm() {
    document.getElementById("ID").value = "";
    document.getElementById("projectStatus").value = "";
    document.getElementById("projectName").value = "";
    document.getElementById("projectStartDate").value = "";
    document.getElementById("projectEndDate").value = "";

    document.getElementById("projectStatus").selectedIndex = 0;
    resetSelectedProjects();
    selectedModal();
}

// CRUD CRUD CRUD CRUD CRUD
function createProject() {
    return new Promise((resolve, reject) => {
        event.preventDefault();

        if (!selectedProjects || selectedProjects.length === 0) {
            alert("Please select at least one product.");
            return reject(new Error("No materials selected"));
        }
        const projectName = document.getElementById("projectName").value;
        const projectStatus = document.getElementById("projectStatus").value;
        const projectStartDate =
            document.getElementById("projectStartDate").value;
        const projectEndDate = document.getElementById("projectEndDate").value;

        if (projectName === "Nama") {
            alert("Nama projek harus diisi.");
            return reject(new Error("Project name cannot be blank"));
        }
        if (projectStatus === "Status") {
            alert("Status projek harus diisi.");
            return reject(new Error("Project type cannot be blank"));
        }
        if (!projectStartDate || projectStartDate === "Start Date") {
            alert("Project start date must be filled.");
            return reject(
                new Error("Project purchase price cannot be zero or blank")
            );
        }
        if (!projectEndDate || projectEndDate === "End Date") {
            alert("Project end date must be filled.");
            return reject(
                new Error("Project selling price cannot be zero or blank")
            );
        }

        const projectData = {
            name: projectName,
            start_date: projectStartDate,
            end_date: projectEndDate,
            status_id: projectStatus,
        };
        console.log(projectData);

        fetch(`/api/project`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(projectData),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to create product");
                }
                return response.json();
            })
            .then((data) => {
                console.log(data);
                var newId = data.project.id;
                updateProjectProduct(newId)
                    .then(() => {
                        resetSelectedProjects();
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

function updateProject() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        if (selectedProjectId) {
            const projectName = document.getElementById("projectName").value;
            const projectStatus =
                document.getElementById("projectStatus").value;
            const projectStartDate =
                document.getElementById("projectStartDate").value;
            const projectEndDate =
                document.getElementById("projectEndDate").value;

            if (projectName === "Nama") {
                alert("Nama projek harus diisi.");
                return reject(new Error("Project name cannot be blank"));
            }
            if (projectStatus === "Status") {
                alert("Status projek harus diisi.");
                return reject(new Error("Project type cannot be blank"));
            }
            if (!projectStartDate || projectStartDate === "Start Date") {
                alert("Project start date must be filled.");
                return reject(
                    new Error("Project purchase price cannot be zero or blank")
                );
            }
            if (!projectEndDate || projectEndDate === "End Date") {
                alert("Project end date must be filled.");
                return reject(
                    new Error("Project selling price cannot be zero or blank")
                );
            }

            const updatedProjectData = {
                name: projectName,
                start_date: projectStartDate,
                end_date: projectEndDate,
                status_id: projectStatus,
            };
            console.log(updatedProjectData);

            fetch(`/api/project/${selectedProjectId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(updatedProjectData),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Failed to update product");
                    }
                    return response.json();
                })
                .then((data) => {
                    updateProjectProduct(selectedProjectId)
                        .then(() => {
                            resetSelectedProjects();
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

function updateProjectProduct(id) {
    console.log(id);
    return new Promise((resolve, reject) => {
        if (!selectedProjects || selectedProjects.length === 0) {
            alert("Please select at least one Product.");
            return reject(new Error("No products selected"));
        }
        const requestBody = {
            projectId: id,
            products: selectedProjects,
        };
        console.log(requestBody);

        fetch(`/api/project/${id}/updateProducts`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestBody),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to update products");
                }
                return response.json();
            })
            .then((data) => {
                resetSelectedProjects();
                clearForm();
                resolve(data);
            })
            .catch((error) => {
                console.error("Error:", error);
                reject(error);
            });
    });
}

function deleteProject() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        if (selectedProjectId) {
            console.log(selectedProjectId);
            fetch(`/api/project/${selectedProjectId}`, {
                method: "DELETE",
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Failed to delete project");
                    }
                    return response.json();
                })
                .then((data) => {
                    clearForm();
                    resetSelectedProjects();
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

function addToSelectedProjects(productId, name, size, color, code, quantity) {
    selectedProjects.push({
        id: productId,
        name: name,
        size: size,
        color: color,
        code: code,
        quantity: parseInt(quantity),
    });
    console.log(selectedProjects);
}

function resetSelectedProjects() {
    selectedProjects = [];
}

function populateMaterials(products) {
    // Sort products by ID
    products.sort((a, b) => a.id - b.id);

    // Clear the table body
    $("#selectedProductsBody").empty();

    // Track IDs of products already added to the table
    const addedProjectIds = new Set();
    console.log(products);

    // Populate the table with products
    products.forEach(function (product) {
        // Check if the product ID has already been added to the table
        if (!addedProjectIds.has(product.id)) {
            var newRow =
                "<tr>" +
                "<td>" +
                product.id +
                "</td>" +
                "<td>" +
                product.name +
                "</td>" +
                "<td>" +
                product.size +
                "</td>" +
                "<td>" +
                product.color +
                "</td>" +
                "<td>" +
                product.code +
                "</td>" +
                '<td><input type="number" class="form-control quantity" value="' +
                product.quantity +
                '" onchange="updateQuantity(this)"></td>' +
                '<td><button type="button" class="btn btn-danger" onclick="removeFromCart(this)">Remove</button></td>' +
                "</tr>";

            // Append the new row to the selected products table
            $("#selectedProductsBody").append(newRow);

            // Add the product ID to the set of added IDs
            addedProjectIds.add(product.id);
        }
    });
}

function addToCart(button) {
    var row = button.closest("tr");
    if (!row) {
        return;
    }
    var ProductId = row.cells[0].innerText;
    var quantityInput = row.querySelector(".quantity");
    var quantity = parseInt(quantityInput.value);

    if (isNaN(quantity) || quantity <= 0) {
        alert("Please enter a valid quantity.");
        return;
    }

    var existingProductIndex = selectedProjects.findIndex(function (item) {
        return item.id === ProductId;
    });

    if (existingProductIndex !== -1) {
        selectedProjects[existingProductIndex].quantity += quantity;
    } else {
        var productName = row.cells[1].innerText;
        var size = row.cells[2].innerText;
        var color = row.cells[3].innerText;
        var code = row.cells[4].innerText;

        selectedProjects.push({
            id: ProductId,
            name: productName,
            size: size,
            color: color,
            code: code,
            quantity: quantity,
        });
    }
    quantityInput.value = 0;
    populateMaterials(selectedProjects);
}

function removeFromCart(button) {
    // Get the clicked row
    var row = button.closest("tr");
    if (!row) {
        return; // Exit the function if the row is not found
    }

    var materialId = row.cells[0].innerText;

    // Remove the material from selectedProjects array
    selectedProjects = selectedProjects.filter(function (item) {
        return item.id !== materialId;
    });

    // Remove the row from the selected materials table
    row.remove();
}

function updateQuantity(input) {
    var row = input.closest("tr");
    if (!row) {
        return;
    }
    console.log(row);
    var materialId = row.cells[0].innerText;
    var newQuantity = parseInt(input.value);
    console.log(newQuantity);
    // Find the material in selectedProjects array and update its quantity
    var existingMaterial = selectedProjects.find(function (item) {
        return item.id === materialId;
    });

    if (existingMaterial) {
        // Update the quantity in selectedProjects array
        existingMaterial.quantity = newQuantity;
        // Update the corresponding row in the selected materials table
        var selectedRows = document.querySelectorAll(
            "#selectedProjectsBody tr"
        );
        for (var i = 0; i < selectedRows.length; i++) {
            if (selectedRows[i].cells[0].innerText === materialId) {
                var quantityInput = selectedRows[i].querySelector(".quantity");
                quantityInput.value = newQuantity; // Update the value of the quantity input field
                break;
            }
        }
    } else {
        console.error("Material not found in selectedProjects array.");
    }
}

function closeModal() {
    $("#exampleModal").modal("hide");
}

function selectedModal() {
    selectedProjectsTemp = JSON.parse(JSON.stringify(selectedProjects));
}

function revertModal() {
    selectedProjects = JSON.parse(JSON.stringify(selectedProjectsTemp));
}

$("#exampleModal").on("shown.bs.modal", function () {
    //
});

function clearDefaultValue(input) {
    if (input.value === "0") {
        input.value = ""; // Clear the default value
    }
}
