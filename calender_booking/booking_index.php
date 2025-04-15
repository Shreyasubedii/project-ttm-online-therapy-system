<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
</head>

<body>
    <h2>Book Your Appointment</h2>

    <form id="bookingForm">
        <input type="text" name="name" placeholder="Your name" required>
        <input type="date" name="date" id="date" required>

        <select name="time" id="timeSlots" required>
            <option>Select time slot</option>
        </select>

        <button type="submit">Book</button>
    </form>

    <div id="result"></div>

    <script>
    document.getElementById('date').addEventListener('change', function() {
        const selectedDate = this.value;
        fetch('get_slots.php?date=' + selectedDate)
            .then(res => res.json())
            .then(data => {
                const select = document.getElementById('timeSlots');
                select.innerHTML = '<option>Select time slot</option>';
                data.forEach(time => {
                    select.innerHTML += `<option value="${time}">${time}</option>`;
                });
            });
    });

    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('book.php', {
            method: 'POST',
            body: formData
        }).then(res => res.text()).then(data => {
            document.getElementById('result').innerText =
                data === 'success' ? 'Appointment Booked!' : 'Time Slot Already Booked!';
        });
    });
    </script>
</body>

</html>