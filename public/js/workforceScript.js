let selectedWorkforceId;
var selectedRows = [];

$(document).ready(function() {
    var workforceTable = $('#workforce-table').DataTable({
        ajax: {
            url: '/api/workforce/', 
            type: 'GET',
            dataSrc: function (json) {
                console.log(json.workforces);
                return json.workforces;
            }
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'workforceposition.name' },
            { data: 'workforcestatus.name' },
        ]
    });

    function refreshTable() {
        workforceTable.ajax.reload(null, false); // User paging is not reset on reload
    }
    $('#update-button').on('click', function() {
        updateWorkforce()
            .then(() => {
                refreshTable(); // Refresh the table after updateWorkforce is successful
                // @AR, start
                clearForm();
                // @AR, end
            })
            .catch((error) => {
                console.error("Update failed:", error);
            });
    });
    $('#create-button').on('click', function() {
        createWorkforce()
            .then(() => {
                refreshTable(); // Refresh the table after createWorkforce is successful
                // @AR, start
                clearForm();
                // @AR, end
            })
            .catch((error) => {
                console.error("Creation failed:", error);
            });
    });
    $('#delete-button').on('click', function() {
        deleteWorkforce()
            .then(() => {
                refreshTable(); // Refresh the table after deleteWorkforce is successful
                // @AR, start
                clearForm();
                // @AR, end
            })
            .catch((error) => {
                console.error("Deletion failed:", error);
            });
    });

    $('#workforce-table').on('click', '.select-btn', function() {
        var WorkforceId = $(this).data('id');
        fetchData(WorkforceId);
        selectedWorkforceId=WorkforceId;
    });

    $('#workforce-table tbody').on('click', 'tr', function () {
        var data = workforceTable.row(this).data();
        fetchData(data.id);
    });
});

function fetchData(WorkforceId) {
    console.log('FETCH');
    // @AR, start
    selectedWorkforceId = WorkforceId;
    // @AR, end
    fetch(`/api/workforce/${WorkforceId}`)
        .then((response) => response.json())
        .then((workforceData) => {
            console.log(workforceData);
            document.getElementById("ID").value = "ID: " + workforceData.id;
            document.getElementById("workforceName").value = workforceData.name;
            document.getElementById("workforcePosition").value = workforceData.position_id;
            document.getElementById("workforceStatus").value = workforceData.status_id;
            changeTextColor();

        })
        .catch((error) => console.error("Error fetching Workforce data:", error));
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
    document.getElementById("workforceName").value = "";
    document.getElementById("workforcePosition").value = "";
    document.getElementById("workforceStatus").value = "";

    document.getElementById("workforcePosition").selectedIndex = 0;
    document.getElementById("workforceStatus").selectedIndex = 0;
}

function createWorkforce() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        const workforceName = document.getElementById("workforceName").value;
        const workforcePosition = document.getElementById("workforcePosition").value;
        const workforceStatus = document.getElementById("workforceStatus").value;

        // @AR, start
        //if (workforceName === 'Nama') {
        if (workforceName === 'Nama' || workforceName.trim() == '') { // gimana kalo ada orang yang namanya "Name" atau "Nama"?
        // @AR, end
            alert("Workforce name cannot be blank");
            return reject(new Error("Workforce name cannot be blank"));
        }
        // @AR, start
        //if (workforcePosition === 'Use') {
        //    alert("Workforce use cannot be blank");
        //    return reject(new Error("Workforce use cannot be blank"));
        //}
        if (workforcePosition === 'Position') {
            alert("Workforce position cannot be blank");
            return reject(new Error("Workforce position cannot be blank"));
        }
        // @AR, end
        if (workforceStatus === 'Status') {
            alert("Workforce status cannot be blank");
            return reject(new Error("Workforce status cannot be blank"));
        }

        const workforceData = {
            name: workforceName,
        // @AR, start
            //use_id: workforcePosition,
            position_id: workforcePosition,
        // @AR, end
            status_id: workforceStatus,
        };

        fetch(`/api/workforce`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(workforceData),
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Failed to create Workforce');
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


function updateWorkforce() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        if (selectedWorkforceId) {
            const workforceName = document.getElementById("workforceName").value;
            const workforcePosition = document.getElementById("workforcePosition").value;
            const workforceStatus = document.getElementById("workforceStatus").value;

            // @AR, start
            //if (workforceName === 'Nama') {
            if (workforceName === 'Nama' || workforceName.trim() == '') { // gimana kalo ada orang yang namanya "Name" atau "Nama"?
            // @AR, end
                alert("Workforce name cannot be blank");
                return reject(new Error("Workforce name cannot be blank"));
            }
            // @AR, start
            //if (workforcePosition === 'Use') {
            //    alert("Workforce use cannot be blank");
            //    return reject(new Error("Workforce use cannot be blank"));
            //}
            if (workforcePosition === 'Position') {
                alert("Workforce position cannot be blank");
                return reject(new Error("Workforce position cannot be blank"));
            }
            // @AR, end
            if (workforceStatus === 'Status') {
                alert("Workforce status cannot be blank");
                return reject(new Error("Workforce status cannot be blank"));
            }

            const workforceData = {
                name: workforceName,
            // @AR, start
                //use_id: workforcePosition,
                position_id: workforcePosition,
            // @AR, end
                status_id: workforceStatus,
            };
            fetch(`/api/workforce/${selectedWorkforceId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(workforceData),
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Failed to update Workforce');
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
            console.error("No workforce selected for update");
            reject(new Error("No workforce selected for update"));
        }
    });
}

function deleteWorkforce() {
    return new Promise((resolve, reject) => {
        event.preventDefault();
        if (selectedWorkforceId) {
            fetch(`/api/workforce/${selectedWorkforceId}`, {
                method: "DELETE",
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Failed to delete Workforce');
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
            console.error("No workforce selected for deletion");
            reject(new Error("No workforce selected for deletion"));
        }
    });
}