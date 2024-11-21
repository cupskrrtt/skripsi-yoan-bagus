

<?php $__env->startSection('container'); ?>
<style>
  .hidden {
    display: none;
  }
</style>

<div class="container-sc">
    <div class="top-bar">
        <div class="header-wrapper">
        <div class="header-title">
            <h2>Schedule</h2>
        </div>
        <div class="dropdown-top">
            <a href="/schedule" class="active">Schedule</a>
            <a href="">|</a>
            <a href="/project">Project</a>
        </div>
        <div class="user-info">
            <img src="image2.jpg" alt="">
        </div>
        </div>
    </div>  

<section class="timeline-container">
    <div class="timeline-header">
        <h2>Timeline</h2>
        <div>
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Project Description
</button>

<!-- Modal for displaying project details -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="title">Ongoing Project</div>
                    <select class="form-select" id="projectDropdown" onchange="showProjectDescription()">
                        <option value="">-- Select a Project --</option>
                        <option value="1">Project 1</option>
                        <option value="2">Project 2</option>
                        <option value="3">Project 3</option>
                    </select>
                </div>

                <div id="description" class="card hidden">
                    <div class="card-body">
                        <h4 id="projectTitle" class="card-title"></h4>
                        <p id="projectDetails" class="card-text"></p>

                        <h5 class="mt-4">Select Data to Display</h5>
                        <select class="form-select mb-3" id="dataSelector" onchange="showSelectedTable()">
                            <option value="employee">Employee Table</option>
                            <option value="machine">Machine Table</option>
                        </select>

                        <h5 class="mt-4" id="tableHeader">People, Dates, and Tasks Involved</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mt-3" id="employeeTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">People</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Task</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="employeeTableBody">
                                    <!-- Rows for Employee Table will be dynamically inserted here -->
                                </tbody>
                            </table>

                            <table class="table table-bordered mt-3 hidden" id="machineTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Machine</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Task</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="machineTableBody">
                                    <!-- Rows for Machine Table will be dynamically inserted here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Edit Form Container (Initially Hidden) -->
<!-- Edit Form Container (Initially Hidden) -->
<div id="editFormContainer" class="hidden mt-4">
    <h5>Edit Row</h5>
    <form id="editForm">
        <div class="mb-3">
            <label for="editPersonMachine" class="form-label">Person/Machine</label>
            <select class="form-select" id="editPersonMachine">
                <!-- Options will be dynamically inserted here -->
            </select>
        </div>
        <div class="mb-3">
            <label for="editDate" class="form-label">Date</label>
            <input type="date" class="form-control" id="editDate">
        </div>
        <div class="mb-3">
            <label for="editTask" class="form-label">Task</label>
            <input type="text" class="form-control" id="editTask">
        </div>
        <button type="button" class="btn btn-primary" onclick="saveEdit()">Save changes</button>
        <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Cancel</button>
    </form>
</div>



                        <!-- Button to show the add row form -->
                        <button class="btn btn-success mt-3" onclick="showAddRowForm()">Add Row</button>

                        <!-- Add Row Form (Initially Hidden) -->
                        <!-- Add Row Form (Initially Hidden) -->
<div id="addRowFormContainer" class="hidden mt-4">
    <h5>Add New Row</h5>
    <form id="addRowForm">
        <div class="mb-3">
            <label for="newPersonMachine" class="form-label">Person/Machine</label>
            <select class="form-select" id="newPersonMachine">
                <!-- Options will be dynamically inserted here -->
            </select>
        </div>
        <div class="mb-3">
            <label for="newDate" class="form-label">Date</label>
            <input type="date" class="form-control" id="newDate">
        </div>
        <div class="mb-3">
            <label for="newTask" class="form-label">Task</label>
            <input type="text" class="form-control" id="newTask">
        </div>
        <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
        <button type="button" class="btn btn-secondary" onclick="cancelAddRow()">Cancel</button>
    </form>
</div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
            </div>
        </div>
    </div>
</div>

            <a href="/project"><button class="btn btn-primary">Project View</button></a>
            <select class="btn btn-light" id="monthSelect">
                <option value="0">January</option>
                <option value="1">February</option>
                <option value="2">March</option>
                <option value="3">April</option>
                <option value="4">May</option>
                <option value="5">June</option>
                <option value="6">July</option>
                <option value="7">August</option>
                <option value="8">September</option>
                <option value="9">October</option>
                <option value="10">November</option>
                <option value="11">December</option>
            </select>
            <button class="btn btn-success" id="addNewButton" onclick="location.href='project'">Add New</button>
        </div>
    </div>
        <div id="calendar"></div>
</section>

<!-- Modal -->



<script src="/js/scheduleScript.js"></script>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\yoandhika\OneDrive\Documents\TA\TA-2\resources\views/schedule.blade.php ENDPATH**/ ?>