// Add inventory item
const inventoryForm = document.getElementById('inventory-form');
const inventoryList = document.getElementById('inventory-list');

// Function to generate a unique ID for items (could be replaced with actual ID from DB)
function generateUniqueId() {
    return Date.now(); // Unique ID based on timestamp
}

// Add new item to the inventory
inventoryForm.addEventListener('submit', function (e) {
    e.preventDefault();

    // Get form values
    const itemName = document.getElementById('item-name').value.trim();
    const itemQuantity = document.getElementById('item-quantity').value.trim();
    const itemPrice = document.getElementById('item-price').value.trim();

    // Basic validation
    if (!itemName || !itemQuantity || !itemPrice) {
        alert("Please fill in all fields.");
        return;
    }

    // Generate unique ID for the item
    const itemId = generateUniqueId();

    // Create new row for the item
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${itemId}</td>
        <td>${itemName}</td>
        <td>${itemQuantity} kg</td>
        <td>$${parseFloat(itemPrice).toFixed(2)}</td>
        <td>
            <button class="edit-btn" data-id="${itemId}">Edit</button>
            <button class="delete-btn" data-id="${itemId}">Delete</button>
        </td>
    `;

    // Add new row to the table
    inventoryList.appendChild(newRow);

    // Clear form fields
    inventoryForm.reset();
    alert("Item added successfully!");
});

// Edit inventory item
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('edit-btn')) {
        const row = e.target.closest('tr');
        const itemId = e.target.getAttribute('data-id');
        const itemName = row.cells[1].textContent;
        const itemQuantity = row.cells[2].textContent.replace(' kg', '');
        const itemPrice = row.cells[3].textContent.slice(1);

        // Populate the form with existing data
        document.getElementById('item-name').value = itemName;
        document.getElementById('item-quantity').value = itemQuantity;
        document.getElementById('item-price').value = itemPrice;

        // Remove the row being edited
        row.remove();
        
        alert("Edit item. Make your changes and submit.");
    }
});

// Delete inventory item
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-btn')) {
        const confirmation = confirm("Are you sure you want to delete this item?");
        if (confirmation) {
            const row = e.target.closest('tr');
            row.remove();
            alert("Item deleted successfully!");
        }
    }
});
