// @AR2, start
let selectedProject_workforce_machine = null;
// @AR2, end
$(document).ready(function () {
    $("#calendar").fullCalendar({
        header: {
            left: "prev,next today",
            center: "title",
            right: "month,agendaWeek,agendaDay",
        },
        defaultDate: "2024-03-14",
        editable: true,
        buttonText: {
            today: "Today",
            month: "Month View",
            week: "Week View",
            day: "Day View",
        },
        events: function (start, end, timezone, callback) {
            $.ajax({
                url: "/api/project/", // Replace with your actual API endpoint
                type: "GET",
                dataType: "json",
                success: function (response) {
                    var events = [];
                    console.log(response); // Log the response to see its structure

                    // Assuming projects are nested under response.projects
                    var projects = response.projects;

                    $.each(projects, function (index, project) {
                        console.log(project); // Log each project to inspect its structure
                        console.log(project.name); // Log project.name to see if it's accessible

                        // Push event data to the events array
                        events.push({
                            title: project.name,
                            start: project.start_date,
                            end: project.end_date,
                        });
                    });
                    callback(events);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data from API: ", error);
                },
            });
        },
        dayClick: function (date) {
            $("#eventStart").val(date.format("YYYY-MM-DD"));
            $("#eventEnd").val(date.format("YYYY-MM-DD"));
            $("#addEventModal").modal("show");
        },
    });
});

// Change calendar month based on dropdown selection
$("#monthSelect").change(function () {
    var selectedMonth = $(this).val();
    var currentYear = new Date().getFullYear();
    var date = new Date(currentYear, selectedMonth, 1);

    $("#calendar").fullCalendar("gotoDate", date);
});

// Initialize datepicker
// $(".datepicker").datepicker({
//         dateFormat: 'yy-mm-dd'
// });

// Show modal on button click
// $('#addNewButton').click(function() {
//     $('#addEventModal').modal('show');
// });

// Save event
// $('#saveEventButton').click(function() {
//     var eventTitle = $('#eventTitle').val();
//     var eventStart = $('#eventStart').val();
//     var eventEnd = $('#eventEnd').val();
//     var eventColor = $('#eventColor').val();
//     var eventTextColor = $('#eventTextColor').val();

// if(eventTitle && eventStart) {
//     $('#calendar').fullCalendar('renderEvent', {
//         title: eventTitle,
//         start: eventStart,
//         end: eventEnd,
//         color: eventColor,
//         textColor: eventTextColor
//     }, true); // stick the event

//     $('#addEventModal').modal('hide');
//     $('#addEventForm')[0].reset();
// } else {
//         alert("Please enter the required details.");
// }
// });
// Array of projects
// Sample data for projects
// Sample project data
// @AR2, start
/*
const projects = [
    {
        id: 1,
        name: "Project 1: Website Development",
        description:
            "This project involves creating a responsive website using HTML, CSS, and JavaScript.",
        details: [
            {
                person: "John Doe",
                machine: "Machine A",
                date: "2024-09-15",
                task: "HTML & CSS Development",
            },
            {
                person: "Jane Smith",
                machine: "Machine B",
                date: "2024-09-16",
                task: "JavaScript Development",
            },
        ],
    },
    {
        id: 2,
        name: "Project 2: Mobile App Development",
        description:
            "This project focuses on developing a cross-platform mobile app for personal finance management.",
        details: [
            {
                person: "Michael Johnson",
                machine: "Machine C",
                date: "2024-09-17",
                task: "Frontend Development",
            },
            {
                person: "Jane Smith",
                machine: "Machine D",
                date: "2024-09-18",
                task: "Backend API Development",
            },
        ],
    },
    {
        id: 3,
        name: "Project 3: Data Analysis with Python",
        description:
            "This project involves analyzing large datasets using Python, Pandas, and Matplotlib.",
        details: [
            {
                person: "John Doe",
                machine: "Machine E",
                date: "2024-09-19",
                task: "Data Cleaning",
            },
            {
                person: "Michael Johnson",
                machine: "Machine F",
                date: "2024-09-20",
                task: "Data Visualization",
            },
        ],
    },
];
*/
// @AR2, end

// Global variable to track the currently selected project and edited row
let currentEditRow = null;

// Function to show the selected project's description and data
// Function to show the selected project's description and data
// @AR2, start
/*
function showProjectDescription() {
    const dropdown = document.getElementById("projectDropdown");
    const selectedValue = dropdown.value;

    if (selectedValue === "") {
        document.getElementById("description").classList.add("hidden");
        return;
    }

    // Find the selected project
    const selectedProject = projects.find(
        (project) => project.id == selectedValue
    );

    if (selectedProject) {
        document.getElementById("projectTitle").innerText =
            selectedProject.name;
        document.getElementById("projectDetails").innerText =
            selectedProject.description;

        // Clear previous table content
        document.getElementById("employeeTableBody").innerHTML = "";
        document.getElementById("machineTableBody").innerHTML = "";

        // Populate the Employee Table with relevant details
        selectedProject.details.forEach((detail, index) => {
            if (detail.person) {
                // Only add rows with a person entry to the employee table
                const employeeRow = document.createElement("tr");
                employeeRow.innerHTML = `
                    <td>${detail.person}</td>
                    <td>${detail.date}</td>
                    <td>${detail.task}</td>
                    <td><button class="btn btn-sm btn-primary" onclick="openEditForm(this, 'employee', ${index})">Edit</button></td>
                `;
                document
                    .getElementById("employeeTableBody")
                    .appendChild(employeeRow);
            }

            // Populate the Machine Table with relevant details
            if (detail.machine) {
                // Only add rows with a machine entry to the machine table
                const machineRow = document.createElement("tr");
                machineRow.innerHTML = `
                    <td>${detail.machine}</td>
                    <td>${detail.date}</td>
                    <td>${detail.task}</td>
                    <td><button class="btn btn-sm btn-primary" onclick="openEditForm(this, 'machine', ${index})">Edit</button></td>
                `;
                document
                    .getElementById("machineTableBody")
                    .appendChild(machineRow);
            }
        });

        // Display the description card
        document.getElementById("description").classList.remove("hidden");

        // Show only the selected table
        showSelectedTable();
    }
}
*/
// @AR2, end

// Function to show only the selected table (Employee or Machine)
function showSelectedTable() {
    const selectedTable = document.getElementById("dataSelector").value;
    // @AR2, start
    //const employeeTable = document.getElementById("employeeTable");
    //const machineTable = document.getElementById("machineTable");
    const employeeClassName = "employeeOnly";
    const machineClassName = "machineOnly";
    // @AR2, end

    if (selectedTable === "employee") {
        // @AR2, start
        //employeeTable.classList.remove("hidden");
        //machineTable.classList.add("hidden");
        document.getElementsByClassName(employeeClassName).forEach((element, index) => {
            element.classList.remove("hidden");
        });

        document.getElementsByClassName(machineClassName).forEach((element, index) => {
            element.classList.add("hidden");
        });
        // @AR2, end
    } else if (selectedTable === "machine") {
        // @AR2, start
        //employeeTable.classList.add("hidden");
        //machineTable.classList.remove("hidden");
        document.getElementsByClassName(employeeClassName).forEach((element, index) => {
            element.classList.add("hidden");
        });

        document.getElementsByClassName(machineClassName).forEach((element, index) => {
            element.classList.remove("hidden");
        });
        // @AR2, end
    }
    // @AR2, start
    else {
        document.getElementsByClassName(employeeClassName).forEach((element, index) => {
            element.classList.add("hidden");
        });

        document.getElementsByClassName(machineClassName).forEach((element, index) => {
            element.classList.add("hidden");
        });
    }
    // @AR2, end

    // @AR2, start
    //populateDropdownOptions(); // Update dropdown options whenever table selection changes
    cancelEdit();
    cancelAddRow();
    // @AR2, end
}

// Show the Add Row form
function showAddRowForm() {
    document.getElementById("addRowFormContainer").classList.remove("hidden");
}

// Function to add a new row to the currently displayed table
// Function to add a new row to the currently displayed table
function addRow() {
    // @AR2, start
    //const personMachine = document.getElementById("newPersonMachine").value;
    const selectedTable = document.getElementById("dataSelector").value;
    var employeeMachineId, employeeMachineName;
    const employeeMachineItem = {};

    if (selectedTable === "employee") {
        employeeMachineId = $("#newEmployee").val();
        employeeMachineName = $("#newEmployee").children("option").filter(":selected").text();
    }
    else if (selectedTable === "machine") {
        employeeMachineId = $("#newMachine").val();
        employeeMachineName = $("#newMachine").children("option").filter(":selected").text();
    }
    // @AR2, end
    const date = document.getElementById("newDate").value;
    const task = document.getElementById("newTask").value;

    // @AR2, start
    //if (personMachine === "" || date === "" || task === "") {
    if (employeeMachineId === "" || employeeMachineName === "" || date === "" || task === "") {
    // @AR2, end
        alert("Please fill out all fields.");
        return;
    }

    // @AR2, start
    //const selectedTable = document.getElementById("dataSelector").value;
    //const projectId = document.getElementById("projectDropdown").value;
    //const selectedProject = projects.find((project) => project.id == projectId);
    employeeMachineItem.id = parseInt(employeeMachineId);
    employeeMachineItem.name = employeeMachineName;
    employeeMachineItem.pivot = {};
    employeeMachineItem.pivot.id = 0; // key column (id) in the pivot table | 0 = new
    employeeMachineItem.pivot.date = date;
    employeeMachineItem.pivot.task = task;
    // @AR2, end

    // @AR2, start
    //if (selectedProject) {
    if (selectedProject_workforce_machine != null) {
    // @AR2, end
        // Determine which table is being added to and maintain separate structures for employee and machine
        if (selectedTable === "employee") {
            // @AR2, start
            //selectedProject.details.push({
            //    person: personMachine,
            //    date: date,
            //    task: task,
            //    machine: "", // Ensure machine field remains empty when adding to the employee table
            //});
            selectedProject_workforce_machine.workforces.push(employeeMachineItem);
            // @AR2, end
        } else if (selectedTable === "machine") {
            // @AR2, start
            //selectedProject.details.push({
            //    person: "", // Ensure person field remains empty when adding to the machine table
            //    machine: personMachine,
            //    date: date,
            //    task: task,
            //});
            selectedProject_workforce_machine.machines.push(employeeMachineItem);
            // @AR2, end
        }

        // Re-render the table to reflect the new row
        showProjectDescription_after();
    }

    // Clear the form fields and hide the form
    // @AR2, start
    //document.getElementById("newPersonMachine").value = "";
    document.getElementById("newEmployee").value = "";
    document.getElementById("newMachine").value = "";
    // @AR2, end
    document.getElementById("newDate").value = "";
    document.getElementById("newTask").value = "";
    document.getElementById("addRowFormContainer").classList.add("hidden");
}

// Cancel adding a new row
function cancelAddRow() {
    document.getElementById("addRowFormContainer").classList.add("hidden");
    // @AR2, start
    //document.getElementById("newPersonMachine").value = "";
    document.getElementById("newEmployee").value = "";
    document.getElementById("newMachine").value = "";
    // @AR2, end
    document.getElementById("newDate").value = "";
    document.getElementById("newTask").value = "";
}

// Function to save the changes to the project array
function saveChanges() {
    // @AR2, start
    /*
    const selectedProjectId = document.getElementById("projectDropdown").value;
    const selectedProject = projects.find(
        (project) => project.id == selectedProjectId
    );

    if (selectedProject) {
        alert("Changes have been saved successfully!");
    } else {
        alert("Please select a project first.");
    }
    */
    const selectedProjectId = document.getElementById("projectDropdown").value;

    if (selectedProject_workforce_machine.machines.length == 0 ||
        selectedProject_workforce_machine.workforces.length == 0) {
        alert("There must be at least 1 employee and 1 machine data.");
        return;
    }

    if (!selectedProjectId) {
        alert("Please select a Project.");
        return;
    }

    var updateSuccessCount = 0;
    const requestBody = selectedProject_workforce_machine;
    console.log(requestBody);

    const promiseUpdateProjectWorkforces = new Promise((resolve, reject) => {
        fetch(`/api/project/${selectedProjectId}/updateProjectWorkforces`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestBody),
        }).then((response) => {
            if (!response.ok) {
                throw new Error("Failed to edit project workforces.");
            }
            return response.json();
        }).then((data) => {
            updateSuccessCount += 1;
            resolve(data);
        }).catch((error) => {
            console.error("Error:", error);
            alert(error);
            reject(error);
        });
    });

    const promiseUpdateProjectMachines = new Promise((resolve, reject) => {
        fetch(`/api/project/${selectedProjectId}/updateProjectMachines`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestBody),
        }).then((response) => {
            if (!response.ok) {
                throw new Error("Failed to edit project machines.");
            }
            return response.json();
        }).then((data) => {
            updateSuccessCount += 1;
            resolve(data);
        }).catch((error) => {
            console.error("Error:", error);
            alert(error);
            reject(error);
        });
    });

    Promise.all([promiseUpdateProjectWorkforces, promiseUpdateProjectMachines]).then((response) => {
        console.log(response);

        if (updateSuccessCount == 2) {
            alert("Project machines successfully edited.");
            resetSelectedProject();
        } else {
            // alert something else
        }
    })
    // @AR2, end
}

// Function to open the edit form with the data from the selected row
function openEditForm(button, tableType, rowIndex) {
    currentEditRow = { rowIndex, tableType }; // Store the row index and table type being edited

    // Find the row being edited
    const row = button.closest("tr");
    const cells = row.getElementsByTagName("td");

    // Populate the edit form fields with the current row's data
    // @AR2, start
    //document.getElementById("editPersonMachine").value = cells[0].innerText;
    //document.getElementById("editDate").value = cells[1].innerText;
    //document.getElementById("editTask").value = cells[2].innerText;
    if (tableType == "employee")
    {
        document.getElementById("editEmployee").value = cells[0].innerText;
    }
    else if (tableType == "machine")
    {
        document.getElementById("editMachine").value = cells[0].innerText;
    }
    document.getElementById("editDate").value = cells[2].innerText;
    document.getElementById("editTask").value = cells[3].innerText;
    // @AR2, end

    // Show the edit form container
    document.getElementById("editFormContainer").classList.remove("hidden");
}

// Save the changes made in the edit form
function saveEdit() {
    // @AR2, start
    //const editPersonMachine =
    //    document.getElementById("editPersonMachine").value;
    const selectedTable = document.getElementById("dataSelector").value;
    var editEmployeeMachineId, editEmployeeMachineName;

    if (selectedTable === "employee") {
        editEmployeeMachineId = $("#editEmployee").val();
        editEmployeeMachineName = $("#editEmployee").children("option").filter(":selected").text();
    }
    else if (selectedTable === "machine") {
        editEmployeeMachineId = $("#editMachine").val();
        editEmployeeMachineName = $("#editMachine").children("option").filter(":selected").text();
    }
    // @AR2, end
    const editDate = document.getElementById("editDate").value;
    const editTask = document.getElementById("editTask").value;

    // Ensure all fields have been filled
    // @AR2, start
    //if (!editPersonMachine || !editDate || !editTask) {
    if (!editEmployeeMachineId || !editEmployeeMachineName || !editDate || !editTask) {
    // @AR2, end
        alert("Please fill out all fields before saving.");
        return;
    }

    // Find the row to be updated
    if (currentEditRow) {
        const tableBody =
            currentEditRow.tableType === "employee"
                ? document.getElementById("employeeTableBody")
                : document.getElementById("machineTableBody");

        const row = tableBody.children[currentEditRow.rowIndex];
        const cells = row.getElementsByTagName("td");

        // Update the row in the DOM with the new values
        // @AR2, start
        //cells[0].innerText = editPersonMachine;
        //cells[1].innerText = editDate;
        //cells[2].innerText = editTask;
        cells[0].innerText = parseInt(editEmployeeMachineId);
        cells[1].innerText = editEmployeeMachineName;
        cells[2].innerText = editDate;
        cells[3].innerText = editTask;
        // @AR2, end

        // Update the data in the projects array
        // @AR2, start
        /*
        const projectId = document.getElementById("projectDropdown").value;
        const selectedProject = projects.find(
            (project) => project.id == projectId
        );

        if (selectedProject) {
            const detailIndex = currentEditRow.rowIndex;
            if (currentEditRow.tableType === "employee") {
                selectedProject.details[detailIndex].person = editPersonMachine;
                selectedProject.details[detailIndex].date = editDate;
                selectedProject.details[detailIndex].task = editTask;
            } else if (currentEditRow.tableType === "machine") {
                selectedProject.details[detailIndex].machine =
                    editPersonMachine;
                selectedProject.details[detailIndex].date = editDate;
                selectedProject.details[detailIndex].task = editTask;
            }
        }
        */
        const detailIndex = currentEditRow.rowIndex;

        if (selectedTable === "employee") {
            selectedProject_workforce_machine.workforces[detailIndex].id = editEmployeeMachineId;
            selectedProject_workforce_machine.workforces[detailIndex].name = editEmployeeMachineName;
            selectedProject_workforce_machine.workforces[detailIndex].pivot.date = editDate;
            selectedProject_workforce_machine.workforces[detailIndex].pivot.task = editTask;
        }
        else if (selectedTable === "machine") {
            selectedProject_workforce_machine.machines[detailIndex].id = editEmployeeMachineId;
            selectedProject_workforce_machine.machines[detailIndex].name = editEmployeeMachineName;
            selectedProject_workforce_machine.machines[detailIndex].pivot.date = editDate;
            selectedProject_workforce_machine.machines[detailIndex].pivot.task = editTask;
        }
        // @AR2, end

        // Clear and hide the edit form
        document.getElementById("editFormContainer").classList.add("hidden");
        // @AR2, start
        //document.getElementById("editPersonMachine").value = "";
        document.getElementById("editEmployee").value = "";
        document.getElementById("editMachine").value = "";
        // @AR2, end
        document.getElementById("editDate").value = "";
        document.getElementById("editTask").value = "";

        // Alert success
        alert("Changes have been saved successfully!");

        // @AR2, start
        console.log(selectedProject_workforce_machine);
        // @AR2, end
    }
}
// Cancel editing and hide the edit form
function cancelEdit() {
    document.getElementById("editFormContainer").classList.add("hidden");
    // @AR2, start
    //document.getElementById("editPersonMachine").value = "";
    document.getElementById("editEmployee").value = "";
    document.getElementById("editMachine").value = "";
    // @AR2, end
    document.getElementById("editDate").value = "";
    document.getElementById("editTask").value = "";
}

// Function to show the selected project's description and data
function showProjectDescription() {
    const dropdown = document.getElementById("projectDropdown");
    const selectedValue = dropdown.value;

    if (selectedValue === "") {
        document.getElementById("description").classList.add("hidden");
        // @AR2, start
        //populateDropdownOptions(); // Populate with dummy data
        document.getElementById("editProjectButton").classList.add("hidden");
        // @AR2, end
        return;
    }

    // @AR2, start
    //const selectedProject = projects.find(
    //    (project) => project.id == selectedValue
    //);
    $.ajax({
        url: "/api/project/workforce_machine/" + selectedValue.toString(),
        type: 'GET',
        success: function (data) {
            console.log("API Response:", data); // Log the JSON data
            selectedProject_workforce_machine = data;
            showProjectDescription_after();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(
                "There was a problem with the ajax request:",
                textStatus,
                errorThrown
            );
            console.error("Response text:", jqXHR.responseText);
            selectedProject_workforce_machine = null;
            return;
        }
    });
    // @AR2, end

    // @AR2, start
    /*
    if (selectedProject) {
        document.getElementById("projectTitle").innerText =
            selectedProject.name;
        document.getElementById("projectDetails").innerText =
            selectedProject.description;

        document.getElementById("employeeTableBody").innerHTML = "";
        document.getElementById("machineTableBody").innerHTML = "";

        selectedProject.details.forEach((detail, index) => {
            if (detail.person) {
                const employeeRow = document.createElement("tr");
                employeeRow.innerHTML = `
                    <td>${detail.person}</td>
                    <td>${detail.date}</td>
                    <td>${detail.task}</td>
                    <td><button class="btn btn-sm btn-primary" onclick="openEditForm(this, 'employee', ${index})">Edit</button></td>
                `;
                document
                    .getElementById("employeeTableBody")
                    .appendChild(employeeRow);
            }

            if (detail.machine) {
                const machineRow = document.createElement("tr");
                machineRow.innerHTML = `
                    <td>${detail.machine}</td>
                    <td>${detail.date}</td>
                    <td>${detail.task}</td>
                    <td><button class="btn btn-sm btn-primary" onclick="openEditForm(this, 'machine', ${index})">Edit</button></td>
                `;
                document
                    .getElementById("machineTableBody")
                    .appendChild(machineRow);
            }
        });

        document.getElementById("description").classList.remove("hidden");
        showSelectedTable(); // Ensure the correct table is displayed
        populateDropdownOptions(); // Populate dropdown with relevant data
    }
    */
    // @AR2, end
}

// @AR2, start
function showProjectDescription_after()
{
    if (selectedProject_workforce_machine != null) {
        document.getElementById("editProjectButton").classList.remove("hidden");

        document.getElementById("projectTitle").innerText = "Project: " + selectedProject_workforce_machine.name;
        document.getElementById("projectDetails").innerText = "(kolom Description belum ada di tabel Projects)";
        document.getElementById("employeeTableBody").innerHTML = "";
        document.getElementById("machineTableBody").innerHTML = "";

        var machineRow = "";
        var employeeRow = "";
        
        if (selectedProject_workforce_machine.machines.length > 0)
        {
            selectedProject_workforce_machine.machines.forEach((machine, index) => {
                machineRow = document.createElement("tr");
                machineRow.innerHTML = `
                    <td>${machine.id}</td>
                    <td>${machine.name}</td>
                    <td>${machine.pivot.date}</td>
                    <td>${machine.pivot.task}</td>
                    <td><button class="btn btn-sm btn-primary" onclick="openEditForm(this, 'machine', ${index})">Edit</button></td>
                `;
                document.getElementById("machineTableBody").appendChild(machineRow);
            });
        }
        else
        {
            machineRow = document.createElement("tr");
            machineRow.innerHTML = '<td colspan="4">(No Data)</td>';
            document.getElementById("machineTableBody").appendChild(machineRow);
        }

        if (selectedProject_workforce_machine.workforces.length > 0)
        {
            selectedProject_workforce_machine.workforces.forEach((workforce, index) => {
                employeeRow = document.createElement("tr");
                employeeRow.innerHTML = `
                    <td>${workforce.id}</td>
                    <td>${workforce.name}</td>
                    <td>${workforce.pivot.date}</td>
                    <td>${workforce.pivot.task}</td>
                    <td><button class="btn btn-sm btn-primary" onclick="openEditForm(this, 'employee', ${index})">Edit</button></td>
                `;
                document.getElementById("employeeTableBody").appendChild(employeeRow);
            });
        }
        else
        {
            employeeRow = document.createElement("tr");
            employeeRow.innerHTML = '<td colspan="4">(No Data)</td>';
            document.getElementById("employeeTableBody").appendChild(employeeRow);
        }

        document.getElementById("description").classList.remove("hidden");
        showSelectedTable(); // Ensure the correct table is displayed
    }
}

function resetSelectedProject()
{
    document.getElementById("projectDropdown").value = "";
    selectedProject_workforce_machine = null;
    showProjectDescription();
}
// @AR2, end

// Function to populate dropdown options with dummy data for Person/Machine based on selected table
// @AR2, start
/*
function populateDropdownOptions() {
    const selectedTable = document.getElementById("dataSelector").value; // Get the selected table type
    const newPersonMachineSelect = document.getElementById("newPersonMachine");
    const editPersonMachineSelect =
        document.getElementById("editPersonMachine");

    // Clear existing options
    newPersonMachineSelect.innerHTML = "";
    editPersonMachineSelect.innerHTML = "";

    // Add a placeholder option
    const placeholderOption = document.createElement("option");
    placeholderOption.value = "";
    placeholderOption.text = "-- Select an Option --";
    newPersonMachineSelect.appendChild(placeholderOption);
    editPersonMachineSelect.appendChild(placeholderOption.cloneNode(true));

    // Dummy data for persons and machines
    const dummyPersons = [
        "Alice Johnson",
        "Bob Smith",
        "Charlie Brown",
        "David Williams",
    ];
    const dummyMachines = ["Machine X", "Machine Y", "Machine Z", "Machine W"];

    // Check which table is selected and populate accordingly
    if (selectedTable === "employee") {
        // Populate with dummy person data
        dummyPersons.forEach((person) => {
            const option = document.createElement("option");
            option.value = person;
            option.text = person;
            newPersonMachineSelect.appendChild(option.cloneNode(true));
            editPersonMachineSelect.appendChild(option.cloneNode(true));
        });
    } else if (selectedTable === "machine") {
        // Populate with dummy machine data
        dummyMachines.forEach((machine) => {
            const option = document.createElement("option");
            option.value = machine;
            option.text = machine;
            newPersonMachineSelect.appendChild(option.cloneNode(true));
            editPersonMachineSelect.appendChild(option.cloneNode(true));
        });
    }
}
*/
// @AR2, end
