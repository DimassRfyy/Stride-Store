// const defaultPrice = 18500000;
// const discount = 900000;
const quantityDisplay = document.getElementById('quantity-display');
const quantityInput = document.getElementById('quantity');
// const totalPriceDisplay = document.getElementById('total-price');
// const grandTotalDisplay = document.getElementById('grand-total');

document.getElementById('minus').addEventListener('click', () => {
    let quantity = parseInt(quantityInput.value);
    if (quantity > 1) {
        quantity--;
        updateDisplay(quantity);
    }
});

document.getElementById('plus').addEventListener('click', () => {
    let quantity = parseInt(quantityInput.value);
    quantity++;
    updateDisplay(quantity);
});

function updateDisplay(quantity) {
    quantityInput.value = quantity;
    quantityDisplay.textContent = quantity;
    // const totalPrice = quantity * defaultPrice;
    // totalPriceDisplay.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
    // const grandTotal = totalPrice - discount;
    // grandTotalDisplay.textContent = `Rp ${grandTotal.toLocaleString('id-ID')}`;
}

// Initial display update when the page loads
document.addEventListener('DOMContentLoaded', () => {
    const initialQuantity = parseInt(quantityInput.value);
    updateDisplay(initialQuantity);
});
