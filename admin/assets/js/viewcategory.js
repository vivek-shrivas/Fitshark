function viewcategory(pageName) {
  fetch("adminview/viewCategories.php")
    .then((response) => response.text())
    .then((content) => {
      document.querySelector(".content").innerHTML = content;
    })
    .catch((error) => {
      console.error("Error loading content:", error);
    });
}

// category delete function

// Function to remove a category row by matching the category ID
function remove(categoryIdToRemove) {
  // Find the table element by its ID (replace 'yourTableId' with the actual table ID)
  var table = document.getElementById("cat-tab");
  if (!table) {
    console.error("Table not found.");
    return;
  }

  // Iterate through each row in the table
  var rows = table.getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    var row = rows[i];
    var dataCategoryId = row.getAttribute("data-category-id");

    if (dataCategoryId === categoryIdToRemove) {
      if (
        confirm(
          "Are you sure you want to delete category " + categoryIdToRemove + "?"
        )
      ) {
        row.remove();
        // You can also perform an AJAX request to delete the category from the server database here if needed.
        break; // Stop iterating after the first matching row is found and removed.
      }
    }
  }
}

function categoryDelete(categoryId) {
  if (confirm("Are you sure you want to delete this category?")) {
    fetch("config/category_delete.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "category_id=" + encodeURIComponent(categoryId),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          window.location.reload();

          // Add an event listener to call viewcategory after the page is fully loaded
          window.addEventListener("load", function () {
            viewcategory();
          });

          // Refresh the page
          // You can remove this part if it's not needed anymore
          const deletedRow = document.querySelector(
            `#categoryTableBody tr[data-category-id="${categoryId}"]`
          );
          if (deletedRow) {
            deletedRow.remove();
          }
        } else {
          showNotification("An error occurred while deleting the category.");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
}

// delete category notification

function showNotification(message) {
  const notification = document.getElementById("notification");
  const notificationMessage = document.getElementById("notification-message");

  notificationMessage.textContent = message;
  notification.style.animation = "none"; // Reset animation
  notification.style.right = "-300px"; // Reset position
  notification.style.display = "block"; // Show the notification

  setTimeout(function () {
    notification.style.animation = "slide-in 0.5s forwards"; // Apply animation
    setTimeout(function () {
      hideNotification();
    }, 3000); // Hide the notification after 3 seconds
  }, 100); // Delay the animation start
}

function hideNotification() {
  const notification = document.getElementById("notification");
  notification.style.animation = "slide-out 0.5s forwards";

  setTimeout(function () {
    notification.style.display = "none";
    notification.style.animation = "none";
  }, 500); // Hide the notification animation duration
}
