document.addEventListener('DOMContentLoaded', function() {
    const durationSelect = document.getElementById('duration');
    const priceInput = document.getElementById('price');
    const reservationForm = document.getElementById('reservationForm');
    const modal = document.getElementById('reservationSummaryModal');
    const closeModal = document.querySelector('.close');
    const backToFormButton = document.getElementById('backToForm');

    // Modal content elements
    const summaryDuration = document.getElementById('summaryDuration');
    const summaryPrice = document.getElementById('summaryPrice');
    const summaryDiscountPrice = document.getElementById('summaryDiscountPrice');
    const summaryTotal = document.getElementById('summaryTotal');

    // Event listener for duration change
    durationSelect.addEventListener('change', function () {
        const duration = this.value;

        // Make an HTTP request to get the price for the selected duration
        fetch(`strengthform/getPrice?duration=${duration}`)
            .then(response => response.text())  // We are expecting plain text for debugging
            .then(data => {
                console.log('Response:', data); // Log the response to debug
                const price = parseFloat(data); // Convert response to float if it's a valid number

                if (!isNaN(price)) {
                    const discount = price * 0.1;  // Example: 10% discount
                    const discountedPrice = price - discount;

                    // Set the price and discounted price in the form fields
                    priceInput.value = price;
                    document.getElementById('disprice').value = discountedPrice;

                    // Also update the modal preview
                    summaryDuration.textContent = durationSelect.options[durationSelect.selectedIndex].text;
                    summaryPrice.textContent = `Rs.${price.toFixed(2)}`;
                    summaryDiscountPrice.textContent = `Rs.${discountedPrice.toFixed(2)}`;
                    summaryTotal.textContent = `Rs.${discountedPrice.toFixed(2)}`;
                } else {
                    alert('Price not found for selected duration.');
                }
            })
            .catch(error => {
                console.error('Error fetching price:', error);
                alert('There was an issue fetching the price');
            });
    });

    // Form submission handler
    reservationForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const selectedDuration = durationSelect.value;
        const price = priceInput.value;

        if (!selectedDuration || !price) {
            alert('Please select a duration before proceeding.');
            return;
        }

        // Show the modal with the reservation summary
        modal.style.display = 'block';
    });

    // Close the modal
    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Back to form button
    backToFormButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Close modal if clicked outside the content
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
