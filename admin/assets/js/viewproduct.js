function viewProduct(pageName) {
  fetch("adminview/viewProduct.php ")
    .then((response) => response.text())
    .then((content) => {
      document.querySelector(".content").innerHTML = content;
    })
    .catch((error) => {
      console.error("Error loading content:", error);
    });
}
// ... Your existing JavaScript code ...
// ... Your existing JavaScript code ...

// show images selected
function showSelectedFiles() {
  const input = document.getElementById("images");
  const selectedFiles = input.files;
  const selectedImagesDiv = document.getElementById("selected-images");

  selectedImagesDiv.innerHTML = ""; // Clear previous selections

  for (let i = 0; i < selectedFiles.length; i++) {
    const file = selectedFiles[i];
    const reader = new FileReader();

    reader.onload = function (event) {
      const image = document.createElement("img");
      image.src = event.target.result;
      image.className = "selected-image";
      selectedImagesDiv.appendChild(image);
    };

    reader.readAsDataURL(file);
  }
}

function showAddProductForm() {
  var formContainer = document.getElementById("form-cnt");
  var overlay = document.getElementById("form-overlay");
  formContainer.style.display = "block";
  overlay.style.display = "block";
  document.body.style.overflow = "hidden"; // Prevent scrolling
}

function closeAddProductForm() {
  var formContainer = document.getElementById("form-cnt");
  var overlay = document.getElementById("form-overlay");
  formContainer.style.display = "none";
  overlay.style.display = "none";
  document.body.style.overflow = "auto"; // Enable scrolling
}

function ShowupdtProductForm() {
  var formContainer = document.getElementById("form-updt");
  var overlay = document.getElementById("form-overlay");
  formContainer.style.display = "block";
  overlay.style.display = "block";
  document.body.style.overflow = "hidden"; // Prevent scrolling
}

function closeupdtProductForm() {
  var formContainer = document.getElementById("form-updt");
  var overlay = document.getElementById("form-overlay");
  formContainer.style.display = "none";
  overlay.style.display = "none";
  document.body.style.overflow = "auto"; // Enable scrolling
}
