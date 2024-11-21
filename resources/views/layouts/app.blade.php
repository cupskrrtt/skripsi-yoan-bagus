<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Other head elements -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <!-- Other body elements -->
    @yield('content')
    <script>
    $(document).ready(function() {
        $('#myTable tbody').on('click', 'tr', function() {
            var userId = $(this).data('id');
            var userName = $(this).data('name');
            var userEmail = $(this).data('email');

            $('#userId').val(userId);
            $('#userName').val(userName);
            $('#userEmail').val(userEmail);
        });

        $('#editForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.post('/update-user', formData, function(response) {
                // Handle response, e.g., show success message or update UI
            });
        });
    });
    </script>
</body>
</html>
