document.addEventListener('DOMContentLoaded', () => {
    const durationSelect = document.getElementById('duration');
    const priceInput = document.getElementById('price');
    const discountPriceInput = document.getElementById('disprice');
    const reservationForm = document.getElementById('reservationForm');

    const modal = document.getElementById('reservationSummaryModal');
    const closeModal = document.querySelector('.close');
    const backToFormButton = document.getElementById('backToForm');

    // Modal content elements
    const summaryArea = document.getElementById('summaryArea');
    const summaryDuration = document.getElementById('summaryDuration');
    const summaryPrice = document.getElementById('summaryPrice');
    const summaryDiscountPrice = document.getElementById('summaryDiscountPrice');
    const summaryTotal = document.getElementById('summaryTotal');

    // Pricing and discount configurations
    const pricing = {
        annual: 60000,
        sixmonth: 35000,
        threemonth: 20000
    };

    const discountRates = {
        annual: 0.10,
        sixmonth: 0.05,
        threemonth: 0
    };

    // Event listener for duration change
    durationSelect.addEventListener('change', () => {
        const selectedDuration = durationSelect.value;

        if (pricing[selectedDuration] !== undefined) {
            const basePrice = pricing[selectedDuration];
            const discount = basePrice * discountRates[selectedDuration];
            const discountedPrice = basePrice - discount;

            // Update price and discount price inputs
            priceInput.value = `Rs.${basePrice.toFixed(2)}`;
            discountPriceInput.value = `Rs,${discountedPrice.toFixed(2)}`;
        } else {
            priceInput.value = '';
            discountPriceInput.value = '';
        }
    });

    // Form submission handler
    reservationForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent default form submission

        // Gather form details
        const selectedDay = document.getElementById('area').value;
        const selectedDuration = durationSelect.value;

        if (!selectedDay || !selectedDuration) {
            alert('Please select both a day and a duration before proceeding.');
            return;
        }

        const basePrice = pricing[selectedDuration];
        const discount = basePrice * discountRates[selectedDuration];
        const discountedPrice = basePrice - discount;

        // Populate modal content
        summaryArea.textContent = selectedDay;
        summaryDuration.textContent = durationSelect.options[durationSelect.selectedIndex].text;
        summaryPrice.textContent = `Rs.${basePrice.toFixed(2)}`;
        summaryDiscountPrice.textContent = `$${discount.toFixed(2)}`;
        summaryTotal.textContent = `Rs.${discountedPrice.toFixed(2)}`;

        // Show the modal
        modal.style.display = 'block';
    });

    // Close the modal
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Back to form
    backToFormButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside the content
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
