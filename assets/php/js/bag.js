// open address popup

function openAddressModal() {
  var modal = document.getElementById("addressModal");
  var modalContent = modal.querySelector(".modal-content");

  // Use XMLHttpRequest to fetch the form content from form.php
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Insert the fetched form content into the modal
      modalContent.innerHTML = xhr.responseText;

      // Show the modal
      modal.style.display = "block";
    }
  };

  // Fetch the form.php content
  xhr.open("GET", "form.html", true);
  xhr.send();
}

function updateAddressModal() {
  var modal = document.getElementById("addressModal");
  var modalContent = modal.querySelector(".modal-content");

  // Use XMLHttpRequest to fetch the form content from form.php
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Insert the fetched form content into the modal
      modalContent.innerHTML = xhr.responseText;

      // Show the modal
      modal.style.display = "block";
    }
  };

  // Fetch the form.php content
  xhr.open("GET", "updateaddressform.html", true);
  xhr.send();
}

function addressclosePopup() {
  var popup = document.getElementById("addressModal");
  popup.style.display = "none";
}

// form submission address

document.addEventListener("DOMContentLoaded", function () {
  // Get a reference to the addressForm element
  var addressForm = document.getElementById("addressform");

  // Check if the element exists
  if (addressForm) {
    // Add event listener only if the element exists
    addressForm.addEventListener("submit", function (e) {
      e.preventDefault(); // Prevent the default form submission
      submitForm();
    });
  }
});

// rough

document.addEventListener("DOMContentLoaded", function () {
  // Add an event listener to a parent element that exists when the page loads
  document.body.addEventListener("submit", function (event) {
    // Check if the submitted form has the id "addressform"
    if (event.target.id === "addressform") {
      event.preventDefault(); // Prevent the default form submission behavior
      submitaddressForm(); // Call your custom form submission function
    }
  });

  // Rest of your code here

  // Handle the form submission
  function submitaddressForm() {
    console.log("submit function called");
    // Get form data
    var name = document.getElementById("address-name").value;
    var email = document.getElementById("address-email").value;
    var phone = document.getElementById("address-phone").value;
    var address1 = document.getElementById("address-address1").value;
    var address2 = document.getElementById("address-address2").value;
    var city = document.getElementById("address-city").value;
    var state = document.getElementById("address-state").value;
    var postalCode = document.getElementById("address-postal_code").value;

    // Create a data object to send to the server
    var formData = {
      name: name,
      email: email,
      phone: phone,
      address1: address1,
      address2: address2,
      city: city,
      state: state,
      postal_code: postalCode,
    };

    // Send an AJAX request to the server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "assets/process_form.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    xhr.onload = function () {
      if (xhr.status === 200) {
        var response = xhr.responseText;
        console.log(response);
        if (response === "success") {
          // Load the content into the "content" div
          loadContent("assets/php/bag.php", "content");
        } else {
          alert("Error: Something went wrong.");
        }
      } else {
        // Handle other HTTP status codes
        alert("Error: Something went wrong.");
      }
    };

    xhr.onerror = function () {
      // Handle network errors
      alert("Error: Network error occurred.");
    };

    // Send the request with the form data as JSON
    xhr.send(JSON.stringify(formData));
  }

  function loadContent(url, targetId) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);

    xhr.onload = function () {
      if (xhr.status === 200) {
        var content = xhr.responseText;
        document.getElementById(targetId).innerHTML = content;
      } else {
        alert("Error: Failed to load content.");
      }
    };

    xhr.onerror = function () {
      // Handle network errors
      alert("Error: Network error occurred while loading content.");
    };

    xhr.send();
  }
});

// update address form
document.addEventListener("DOMContentLoaded", function () {
  // Add an event listener to a parent element that exists when the page loads
  document.body.addEventListener("submit", function (event) {
    // Check if the submitted form has the id "addressform"
    if (event.target.id === "updateaddressform") {
      event.preventDefault(); // Prevent the default form submission behavior
      updateaddressForm(); // Call your custom form submission function
    }
  });

  // Rest of your code here

  // Handle the form submission
  function updateaddressForm() {
    console.log("submit function called");
    // Get form data
    var name = document.getElementById("address-name").value;
    var email = document.getElementById("address-email").value;
    var phone = document.getElementById("address-phone").value;
    var address1 = document.getElementById("address-address1").value;
    var address2 = document.getElementById("address-address2").value;
    var city = document.getElementById("address-city").value;
    var state = document.getElementById("address-state").value;
    var postalCode = document.getElementById("address-postal_code").value;

    // Create a data object to send to the server
    var formData = {
      name: name,
      email: email,
      phone: phone,
      address1: address1,
      address2: address2,
      city: city,
      state: state,
      postal_code: postalCode,
    };

    // Send an AJAX request to the server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "assets/updateaddress.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    xhr.onload = function () {
      if (xhr.status === 200) {
        var response = xhr.responseText;
        console.log(response);
        if (response === "success") {
          // Load the content into the "content" div
          loadContent("assets/php/bag.php", "content");
        } else {
          alert("Error: Something went wrong.");
        }
      } else {
        // Handle other HTTP status codes
        alert("Error: Something went wrong.");
      }
    };

    xhr.onerror = function () {
      // Handle network errors
      alert("Error: Network error occurred.");
    };

    // Send the request with the form data as JSON
    xhr.send(JSON.stringify(formData));
  }

  function loadContent(url, targetId) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);

    xhr.onload = function () {
      if (xhr.status === 200) {
        var content = xhr.responseText;
        document.getElementById(targetId).innerHTML = content;
      } else {
        alert("Error: Failed to load content.");
      }
    };

    xhr.onerror = function () {
      // Handle network errors
      alert("Error: Network error occurred while loading content.");
    };

    xhr.send();
  }
});

// function for changing the quantity ---------------------------------------------------------------------------------------------------------------
function updateQuantity(productId, newQty) {
  // Show a confirmation dialog to confirm the quantity update
  if (confirm("Are you sure you want to update the quantity?")) {
    // If the user confirms, send an AJAX request to update the quantity in the database
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        if (this.status == 200) {
          // Update successful, you can handle any additional actions here if needed
          alert("Quantity updated successfully!");
        } else {
          // Handle errors if the update fails
          alert("Error updating quantity.");
        }
      }
    };
    xhttp.open(
      "POST",
      "./assets/php/controller php/update_bag_quantity.php",
      true
    );
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("product_id=" + productId + "&qty=" + newQty);
  }
}

// size change js --------------------------------------------------------------------------------------------------------------------------------------------

// Function to update the selected size
function updateSize(productId, selectElement, customerId, initialSize) {
  // Get the selected size value
  var newSizeId = selectElement.value;

  // Show an alert message before changing the size
  if (confirm("Are you sure you want to change the size?")) {
    // If the user confirms, perform the update using AJAX
    $.ajax({
      type: "POST",
      url: "./assets/php/controller php/update_size_in_bag.php", // URL to your PHP script for updating the size
      data: {
        productId: productId,
        newSizeId: newSizeId,
        customerId: customerId,
        initialSize: initialSize,
      },
      success: function (response) {
        // Handle the server's response here (e.g., display a success message)
        alert(response); // You can customize the response handling
        if (response === "Size updated successfully!") {
          selectElement.setAttribute("data-initial-size", newSizeId);

          // Update the selected option's value with the new size ID
          selectElement.options[selectElement.selectedIndex].value = newSizeId;

          // Update the initialSize variable to the new size
          initialSize = newSizeId;
        } else {
          // If there was an error, revert the selection to the initial size
          selectElement.value = initialSize;
        }
      },
      error: function (error) {
        // Handle errors here
        alert("Error updating size: " + error);
      },
    });
  } else {
    // If the user cancels, revert the selection to the initial size
    selectElement.value = initialSize;
  }
}

const selectedProductIds = []; // To store selected product_ids
let rzrpay = 0;
function updatePrices() {
  const totalMRPValue = document.getElementById("total-mrp-value");
  const discountMRPValue = document.getElementById("discount-mrp-value");
  const totalAmountValue = document.getElementById("total-amount-value");

  let selectedItemCount = 0;
  let totalMRP = 0;
  let totalDiscount = 0;

  selectedProductIds.forEach((productId) => {
    const productCheckbox = document.querySelector(
      `.product-checkbox[data-product-id="${productId}"]`
    );
    const productMRP = parseFloat(
      productCheckbox.getAttribute("data-product-mrp")
    );
    const productDiscount = parseFloat(
      productCheckbox.getAttribute("data-product-discount")
    );
    const quantity = parseInt(productCheckbox.getAttribute("-quantity"));
    if (productCheckbox.checked) {
      selectedItemCount++;
      totalMRP += productMRP;
      totalMRP = totalMRP * quantity;
      totalDiscount = totalMRP * (productDiscount / 100);
    }
  });

  totalMRPValue.textContent = totalMRP.toFixed(2);
  discountMRPValue.textContent = totalDiscount.toFixed(2);
  totalAmountValue.textContent = (totalMRP - totalDiscount).toFixed(2);
  rzrpay = (totalMRP - totalDiscount).toFixed(2);
}

function updateItemCount(checkbox) {
  const selectedItemCount = document.getElementById("item-count");
  const currentCount = parseInt(selectedItemCount.textContent, 10);
  const productId = checkbox.getAttribute("data-product-id"); // Get product_id

  if (checkbox.checked) {
    // If the checkbox is checked, decrease the count by 1
    selectedItemCount.textContent = (currentCount + 1).toString();

    if (productId && !selectedProductIds.includes(productId)) {
      selectedProductIds.push(productId); // Add product_id to the array if not already included
    }
  } else {
    // If the checkbox is unchecked, decrease the count by 1
    selectedItemCount.textContent = (currentCount - 1).toString();

    if (productId) {
      const index = selectedProductIds.indexOf(productId);
      if (index !== -1) {
        selectedProductIds.splice(index, 1); // Remove product_id from the array
      }
    }
  }
  updatePrices();
}

function selectAllItems() {
  const selectAllCheckbox = document.getElementById("select-all");
  const productCheckboxes = document.querySelectorAll(".product-checkbox");
  const selectedItemCount = document.getElementById("item-count");

  if (selectAllCheckbox.checked) {
    // If "Select All" is checked, check all product checkboxes and update the count
    productCheckboxes.forEach((checkbox) => {
      checkbox.checked = true;
      updateItemCount(checkbox); // Trigger the updateItemCount function for each checkbox
    });
    selectedItemCount.textContent = productCheckboxes.length.toString();
  } else {
    // If "Select All" is unchecked, uncheck all product checkboxes and set count to 0
    productCheckboxes.forEach((checkbox) => {
      checkbox.checked = false;
      updateItemCount(checkbox); // Trigger the updateItemCount function for each checkbox
    });
    selectedItemCount.textContent = "0";
    console.log(selectedProductIds);
  }
}

// function to remove the selected items from the bag

function removeSelected() {
  const productCheckboxes = document.querySelectorAll(".product-checkbox");
  const selectedProductIds = [];

  productCheckboxes.forEach((checkbox) => {
    if (checkbox.checked) {
      const productId = checkbox.getAttribute("data-product-id");
      if (productId) {
        selectedProductIds.push(productId);
      }
    }
  });

  if (selectedProductIds.length === 0) {
    alert("No items selected for removal.");
    return;
  }

  // Send an AJAX request to remove the selected items
  $.ajax({
    type: "POST",
    url: "assets/php/controller php/remove_items_bag.php", // Create a PHP file for handling removal
    data: { selectedProductIds: selectedProductIds }, // Update the variable name here
    success: function (response) {
      if (response === "success") {
        // Update the page or show a success message
        const page = "assets/php/bag.php"; // Specify the page you want to load
        loadContent(page);
        alert("Selected items removed successfully.");
      } else {
        alert("Error removing items. Please try again. later");
      }
    },
  });
}

// Remove the cards for the removed products from the DOM
selectedProductIds.forEach((productId) => {
  const cardToRemove = document.querySelector(
    `.cart-item[data-product-id="${productId}"]`
  );
  if (cardToRemove) {
    cardToRemove.remove();
  }
});

// function to move the selected items to wishlist

function moveToWishlist() {
  const productCheckboxes = document.querySelectorAll(".product-checkbox");
  const selectedProductIds = [];

  productCheckboxes.forEach((checkbox) => {
    if (checkbox.checked) {
      const productId = checkbox.getAttribute("data-product-id");
      if (productId) {
        selectedProductIds.push(productId);
      }
    }
  });

  if (selectedProductIds.length === 0) {
    alert("No items selected to move to wishlist.");
    return;
  }

  // Send an AJAX request to move the selected items to the wishlist
  $.ajax({
    type: "POST",
    url: "assets/php/controller%20php/move_to_wishlist.php", // Corrected URL
    data: { productIds: selectedProductIds },
    success: function (response) {
      console.log("AJAX Response:", response); // Debugging output
      if (response === "success") {
        // Update the page or show a success message
        const page = "assets/php/bag.php"; // Specify the page you want to load
        loadContent(page);

        alert("Selected items moved to wishlist successfully.");
      } else {
        alert("Error moving items to wishlist. Response: " + response); // Debugging output
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("AJAX Error:", textStatus, errorThrown); // Debugging output
      alert("Error moving items to wishlist. Please try again later.");
    },
  });
}
// to open the page address details page

function openAddressDetailsPage() {
  // Specify the page URL you want to open
  const pageUrl = "assets/payment.php";
  // Use window.location to navigate to the specified page
  window.location.href = pageUrl;
}
let Rorder_id = 0;

function passSelectedProductIdsToPHP() {
  // Check if there are selected products
  if (selectedProductIds.length <= 0) {
    alert("No products selected.");
    return Promise.reject("No products selected."); // Return a rejected promise
  }

  // Create an array of product IDs as a string
  const productIdsString = selectedProductIds.join(",");

  // Create a FormData object and append the product IDs as a field
  const formData = new FormData();
  formData.append("selectedProductIds", productIdsString);

  // Send a POST request to your PHP script
  return fetch("assets/php/order.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text()) // Use response.text() to directly get the order_id as a string
    .then((order_id) => {
      // Handle the response from the server
      console.log("Order ID:", order_id);
      return parseInt(order_id, 10);
    })
    .catch((error) => {
      console.error("An error occurred:", error);
      return Promise.reject(error); // Return a rejected promise
    });
}

// to download invoice

// Call the passSelectedProductIdsToPHP function when you want to send the data
function sendTotalAmount() {
  passSelectedProductIdsToPHP()
    .then((result) => {
      Rorder_id = result;

      // Define the URL of the next page
      const nextPageUrl = `assets/razorpay.php?amount=${parseFloat(
        rzrpay * 100
      )}&order_id=${Rorder_id}`;

      // Redirect to the next page
      window.location.href = nextPageUrl;
    })
    .catch((error) => {
      // Handle the error
      console.error(error);
    });
}
