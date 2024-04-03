// Function to delete a product from the wishlist and update the count
function deleteProduct(productId) {
  if (
    confirm("Are you sure you want to remove this product from your wishlist?")
  ) {
    // Send an AJAX request to delete the product
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          // Product deleted successfully, remove it from the DOM
          var productCard = document.getElementById("product_" + productId);
          if (productCard) {
            productCard.remove();

            // Show the popup
            var popup = document.getElementById("wishlist-popup");
            var popupMessage = document.getElementById(
              "removed-product-message"
            );
            var popupImage = document.getElementById("removed-product-image");

            var productName = productCard.querySelector("h6").textContent;
            var productImage = productCard.querySelector("img").src;

            popupImage.src = productImage;
            popupMessage.textContent = productName + " removed from wishlist";

            // Display the popup
            popup.style.display = "block";

            // Automatically hide the popup after 1.5 seconds
            setTimeout(function () {
              popup.style.display = "none";
            }, 3000);
            // Update the wishlist count
            updateWishlistCount();
          }
        } else {
          console.error("Error deleting product: " + xhr.statusText);
        }
      }
    };

    // Send the request to the server to delete the product
    xhr.open(
      "POST",
      "assets/php/controller php/controller-delete-wishlisted.php",
      true
    );
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("productId=" + productId);
  }
}

// Function to update the wishlist count
function updateWishlistCount() {
  // Send an AJAX request to fetch the updated count from the server
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        // Update the count in the wishlist title
        var itemCount = parseInt(xhr.responseText);
        var wishlistTitle = document.querySelector(".wishlist-text-top h5");
        if (wishlistTitle) {
          wishlistTitle.textContent = "My Wishlist (" + itemCount + " items)";
        }
      } else {
        console.error("Error updating wishlist count: " + xhr.statusText);
      }
    }
  };

  // Send the request to the server to fetch the updated count
  xhr.open("GET", "assets/php/controller php/update-wishlist-count.php", true);
  xhr.send();
}

function moveToBag(productId) {
  if (confirm("Are you sure you want to move this product to your bag?")) {
    // Send an AJAX request to add the product to the bag
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          // Product added to bag successfully, remove it from the wishlist
          var productCard = document.getElementById("product_" + productId);
          if (productCard) {
            productCard.remove();
            updateWishlistCount();
            // Display a success message or perform any other necessary actions
            // ...
          }
        } else {
          console.error("Error moving product to bag: " + xhr.statusText);
        }
      }
    };

    // Send the request to the server to move the product to the bag
    xhr.open(
      "POST",
      "assets/php/controller php/controller-move-to-bag.php",
      true
    );
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("productId=" + productId);
  }
}
