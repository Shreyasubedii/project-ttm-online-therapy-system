<!-- index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h2>Book an Appointment</h2>
    <form id="bookingForm" method="POST" action="book.php">
        <label for="date">Choose Date:</label>
        <input type="date" id="date" name="date" required><br>

        <label for="time">Available Time Slots:</label>
        <select id="time" name="time" required>
            <option value="">Select a time</option>
        </select><br>

        <input type="submit" value="Book Appointment">
    </form>

    <script>
    $(document).ready(function() {
        $('#date').on('change', function() {
            const selectedDate = $(this).val();
            $.ajax({
                url: 'get_slots.php',
                method: 'POST',
                data: {
                    date: selectedDate
                },
                success: function(response) {
                    $('#time').html(response);
                }
            });
        });
    });
    </script>
</body>

</html>