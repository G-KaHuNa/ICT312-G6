document.getElementById('reservationForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const guests = document.getElementById('guests').value;

    if (!name || !email || !phone || guests < 1) {
        alert('Please fill out all required fields and make sure the number of guests is at least 1.');
        e.preventDefault();
    }
});
