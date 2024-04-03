
// Function to sort product cards by price (High to Low)
function sortByHighToLow() {
    const productContainer = document.querySelector('.l-product-card-container');
    const productCards = [...document.querySelectorAll('.product-card')];

    productCards.sort((a, b) => {
        const priceA = parseFloat(a.querySelector('.product-price').textContent.replace('₹', '').replace(',', ''));
        const priceB = parseFloat(b.querySelector('.product-price').textContent.replace('₹', '').replace(',', ''));
        return priceB - priceA;
    });

    productContainer.innerHTML = ''; // Clear the current cards

    // Append sorted cards back to the container
    productCards.forEach(card => {
        productContainer.appendChild(card);
    });
}

// Function to sort product cards by price (Low to High)
function sortByLowToHigh() {
    const productContainer = document.querySelector('.l-product-card-container');
    const productCards = [...document.querySelectorAll('.product-card')];

    productCards.sort((a, b) => {
        const priceA = parseFloat(a.querySelector('.product-price').textContent.replace('₹', '').replace(',', ''));
        const priceB = parseFloat(b.querySelector('.product-price').textContent.replace('₹', '').replace(',', ''));
        return priceA - priceB;
    });

    productContainer.innerHTML = ''; // Clear the current cards

    // Append sorted cards back to the container
    productCards.forEach(card => {
        productContainer.appendChild(card);
    });
}

// Event listener for the "Price" select element
const priceSelect = document.getElementById('price');

if (priceSelect) {
    priceSelect.addEventListener('change', function () {
        const selectedValue = this.value;
        if (selectedValue === 'high_to_low') {
            sortByHighToLow();
            // Reload the page to apply the sorting
            location.reload();
        } else if (selectedValue === 'low_to_high') {
            sortByLowToHigh();
            // Reload the page to apply the sorting
            location.reload();
        }
    });
}




// Event listener for the Newestfirst buttons
// Function to shuffle an array randomly
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

// Function to handle the "NewestFirst" radio button change event
function handleRandomizeChange() {
    if ($("#randomize").is(":checked")) {
        const productContainer = $(".l-product-card-container");
        const productCards = $(".product-card");

        // Convert productCards to an array for shuffling
        const productArray = $.makeArray(productCards);

        // Shuffle the product cards randomly
        shuffleArray(productArray);

        // Clear the current cards
        productContainer.empty();

        // Append shuffled cards back to the container
        productContainer.append(productArray);
    }
}

// Event listener for the "NewestFirst" radio button change event
$("#randomize").change(handleRandomizeChange);



// js for discount button 
// Filter products by discount
const discountButtons = document.querySelectorAll(".dis-button");
discountButtons.forEach(button => {
    button.addEventListener("click", function () {
        const discountPercent = parseInt(this.getAttribute("data-discount"));
        filterProductsByDiscount(discountPercent);
    });
});

// Function to filter products by discount
function filterProductsByDiscount(discountPercent) {
    const productContainer = document.getElementById("content");
    const productCards = Array.from(productContainer.getElementsByClassName("product-card"));

    productCards.forEach(card => {
        const cardDiscount = parseInt(card.querySelector(".discount").textContent);
        if (cardDiscount > discountPercent) {
            card.style.display = "block"; // Show the card
        } else {
            card.style.display = "none"; // Hide the card
        }
    });
}
