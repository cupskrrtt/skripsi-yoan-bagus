<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tables Custom Header</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="col-md-12 col-md-6 col-lg-6">
                <form class="mt-3" method="post" id="form" class="form-horizontal">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-default" type="button">Range Tanggal</button>
                        </div>
                        <input type="text" class="form-control shawCalRanges" name="rangetgl" id="rangetgl">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button" id="btn-filter">Set</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    // Inisialisasi DataTables
    var table = $('#example').DataTable({
        // Menentukan judul kustom untuk header kolom
        columns: [
            { title: 'Full Name' },
            { title: 'Job Title' },
            { title: 'Office Location' },
            { title: 'Age' },
            { title: 'Join Date' }
        ]
    });
});
</script>

</body>
</html>
