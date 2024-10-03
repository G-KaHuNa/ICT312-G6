// Add customer feedback
const feedbackForm = document.getElementById('feedback-form');
const feedbackList = document.getElementById('feedback-list');

feedbackForm.addEventListener('submit', function(e) {
    e.preventDefault();

    // Get form values
    const customerName = document.getElementById('customer-name').value;
    const customerEmail = document.getElementById('customer-email').value;
    const feedbackText = document.getElementById('feedback-text').value;

    // Create new row for the feedback
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${customerName}</td>
        <td>${customerEmail}</td>
        <td>${feedbackText}</td>
    `;

    // Add new row to the feedback table
    feedbackList.appendChild(newRow);

    // Clear form fields
    feedbackForm.reset();
});
