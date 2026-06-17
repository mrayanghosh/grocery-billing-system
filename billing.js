function addRow() {
    let table = document.getElementById("billTable");
    let row = table.rows[1].cloneNode(true);

    row.querySelectorAll("input").forEach(input => input.value = "");
    table.appendChild(row);
}

function removeRow(btn) {
    let table = document.getElementById("billTable");
    if (table.rows.length > 2) {
        btn.parentElement.parentElement.remove();
        calculateTotal();
    }
}

function updatePrice(select) {
    let price = select.options[select.selectedIndex].dataset.price || 0;
    let row = select.parentElement.parentElement;
    row.querySelector(".price").value = price;
    calculateSubtotal(row.querySelector(".qty"));
}

function calculateSubtotal(qtyInput) {
    let row = qtyInput.parentElement.parentElement;
    let price = row.querySelector(".price").value;
    let subtotal = price * qtyInput.value;
    row.querySelector(".subtotal").value = subtotal.toFixed(2);
    calculateTotal();
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll(".subtotal").forEach(s => {
        total += Number(s.value);
    });
    document.getElementById("grandTotal").innerText = total.toFixed(2);
}

function validateBill() {
    let valid = false;
    document.querySelectorAll(".qty").forEach(q => {
        if (q.value > 0) valid = true;
    });
    if (!valid) {
        alert("Add at least one product");
    }
    return valid;
}