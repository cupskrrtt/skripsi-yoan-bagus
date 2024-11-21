let selectedId;

$(document).ready(function() {
    var machineTable = $('#machine-table').DataTable({
        ajax: {
            url: '/api/machine/', 
            type: 'GET',
            dataSrc: function (json) {
                console.log(json.machines);
                return json.machines;
            }
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'machineuse.name' },
            { data: 'machinestatus.name' },

        ]
    });

    function refreshTable() {
        machineTable.ajax.reload(null, false); // User paging is not reset on reload
    }
    $('#update-button').on('click', function() {
        updateData()
            .then(() => {
                refreshTable();
                clearForm();
            })
            .catch((error) => {
                console.error("Update failed:", error);
            });
    });
    $('#create-button').on('click', function() {
        createData()
            .then(() => {
                refreshTable();
                clearForm();
            })
            .catch((error) => {
                console.error("Creation failed:", error);
            });
    });
    $('#delete-button').on('click', function() {
        deleteData()
            .then(() => {
                refreshTable();
                clearForm();
            })
            .catch((error) => {
                console.error("Deletion failed:", error);
            });
    });

    $('#machine-table tbody').on('click', 'tr', function () {
        var data = machineTable.row(this).data();
        fetchData(data.id);
    });
});

function fetchData(Id) {
    console.log('FETCH');
    selectedId = Id;
    fetch(`/api/machine/${Id}`)
        .then((response) => response.json())
        .then((Data) => {
            console.log(Data);
            document.getElementById("ID").value = "ID: " + Data.id;
            document.getElementById("machineName").value = Data.name;
            document.getElementById("machineUse").value = Data.use_id;
            document.getElementById("machineStatus").value = Data.status_id;
            changeTextColor();

        })
        .catch((error) => console.error("Error fetching Machine data:", error));
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
    document.getElementById("machineName").value = "";
    document.getElementById("machineUse").value = "";
    document.getElementById("machineStatus").value = "";

    document.getElementById("machineUse").selectedIndex = 0;
    document.getElementById("machineStatus").selectedIndex = 0;
}

function createData() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        const machineName = document.getElementById("machineName").value;
        const machineUse = document.getElementById("machineUse").value;
        const machineStatus = document.getElementById("machineStatus").value;

        if (machineName === 'Nama') {
            alert("Machine name cannot be blank");
            return reject(new Error("Machine name cannot be blank"));
        }
        if (machineUse === 'Use') {
            alert("Machine use cannot be blank");
            return reject(new Error("Machine use cannot be blank"));
        }
        if (machineStatus === 'Status') {
            alert("Machine status cannot be blank");
            return reject(new Error("Machine status cannot be blank"));
        }

        const machineData = {
            name: machineName,
            use_id: machineUse,
            status_id: machineStatus,
        };

        fetch(`/api/machine`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(machineData),
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Failed to create Machine');
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
            const machineName = document.getElementById("machineName").value;
            const machineUse = document.getElementById("machineUse").value;
            const machineStatus = document.getElementById("machineStatus").value;

            if (machineName === 'Nama') {
                alert("Machine name cannot be blank");
                return reject(new Error("Machine name cannot be blank"));
            }
            if (machineUse === 'Use') {
                alert("Machine use cannot be blank");
                return reject(new Error("Machine use cannot be blank"));
            }
            if (machineStatus === 'Status') {
                alert("Machine status cannot be blank");
                return reject(new Error("Machine status cannot be blank"));
            }

            const machineData = {
                name: machineName,
                use_id: machineUse,
                status_id: machineStatus,
            };
            fetch(`/api/machine/${selectedId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(machineData),
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Failed to update Machine');
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
            fetch(`/api/machine/${selectedId}`, {
                method: "DELETE",
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Failed to delete Machine');
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