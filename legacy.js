let imageIndex = 1;
let imageInterval;

function startImageChange(card) {
  imageInterval = setInterval(() => {
    showImage(card, imageIndex);
    imageIndex = (imageIndex % 3) + 1;
  }, 1000); // Change image every 1.5 seconds
}

function stopImageChange(card) {
  clearInterval(imageInterval);
  showImage(card, 1); // Reset to the first image when mouseout
}

function showImage(card, index) {
  const images = card.querySelectorAll(".l-product-image");
  images.forEach((image, i) => {
    if (i === index - 1) {
      image.style.opacity = 1;
    } else {
      image.style.opacity = 0;
    }
  });
}

// Function to handle the click event on the wishlist icon
function addToWishlist(icon) {
  // Get the product ID from the data attribute
  const productID = icon.getAttribute("data-product-id");

  // Show a message to indicate that the function was called
  console.log("addToWishlist function called with product ID:", productID);

  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();

  // Configure the request
  xhr.open("POST", "./assets/php/add-to-wishlist.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // Define a callback function to handle the response
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Check if the response is "success"
      if (xhr.responseText === "success") {
        // Change the fill color of the SVG to red
        icon.querySelector("svg path").style.fill = "red"; // Change the fill color

        // Optionally, you can display a success message to the user
        alert("Product added to wishlist successfully!");
      } else {
        // Handle other response scenarios (e.g., display an error message)
        alert("Failed to add the product to the wishlist.");
      }
    }
  };

  // Send the AJAX request with the product_id as data
  xhr.send("product_id=" + productID);
}

// function to load the product details page.

function loadProductDetails(productID) {
  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();

  // Configure the request
  xhr.open(
    "GET",
    `./assets/php/product-details.php?product_id=${productID}`,
    true
  );

  // Define a callback function to handle the response
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Get the response from product-details.php
      const response = xhr.responseText;

      // Display the response in the 'content' div
      document.getElementById("content").innerHTML = response;
    }
  };

  // Send the AJAX request
  xhr.send();
}
