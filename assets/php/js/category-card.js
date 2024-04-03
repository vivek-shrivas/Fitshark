function loadCategoryProducts(categoryId) {
  window.scrollTo(0, 0);
  $.ajax({
    type: "GET",
    url: "assets/php/product_listed.php",
    data: { category_id: categoryId },
    success: function (response) {
      // Load the elements received into the div with id "content"
      $("#content").html(response);
      console.log("Response from product_listed.php:", response);
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

function loadAllProducts() {
  $.ajax({
    type: "GET",
    url: "assets/php/allproduct_listed.php",
    success: function (response) {
      // Assuming you have loaded new content into the "content" div.
      var contentDiv = document.getElementById("content");
      contentDiv.scrollTop = 0;
      window.scrollTo(0, 0);

      // Load the elements received into the div with id "content"
      $("#content").html(response);
      console.log("Response from product_listed.php:", response);
      window.scrollTo(0, 0);
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}
