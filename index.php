<!doctype html>
<html lang="en">


<head>

  <style>
    .content {
      position: relative;
    }
  </style>

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="bootstrap-footer-13/css/ionicons.min.css">
  <link rel="stylesheet" href="bootstrap-footer-13/css/style.css">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- main css file  -->
  <link rel="stylesheet" href="pdf.css">
  <link rel="stylesheet" href="style.css">
  <!-- navbar css  -->
  <link rel="stylesheet" href="assets\php\css\navstyle.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- css for login and signup  -->
  <link rel="stylesheet" href="assets\php\css\login-signup.css">

  <!-- css for bag    -->
  <link rel="stylesheet" href="./assets/php/css/bag.css">
  <!-- css for product description -->

  <link rel="stylesheet" href="assets/product_description.css">

  <link rel="stylesheet" href="assets/php/css/product_listed.css">

  <!-- login signup css  -->
  <link rel="stylesheet" href="./assets/php/css/login-signup.css">

  <!-- login signup js  -->
  <script src="./assets/php/js/login-signup.js"></script>
  <!-- js for bag  -->
  <script src="assets/php/js/bag.js"></script>
  <!-- ajax   -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <title>Fitstart</title>
  <!-- legacy script  and css -->
  <script src="legacy.js"></script>
  <link rel="stylesheet" href="assets\php\css\legacy.css">
</head>
<!-- controllers -->
<script src="assets/php/controller js/DeleteWIshlist.js"></script>

<!-- js for category_card -->
<script src="assets/php/js/category-card.js"></script>

<!-- js for product descripition page -->

<script src="assets/product_description.js"></script>

<!-- js for product_listed -->
<script src="assets/php/product_listed.js"> </script>




<body>
  <!-- our navigation bar  -->
  <div>
    <header>
      <?php include 'assets\php\navbar.php' ?>
    </header>
    <div id="content" style="margin-top: 100px; position:relative">
      <!-- Content from different pages will be loaded here -->
    </div>
    <footer>
      <?php include 'bootstrap-footer-13\footer.html' ?>
    </footer>
  </div>
</body>
<!-- function to initially load the content  -->
<script>
  // app.js
  const contentDiv = document.getElementById("content");
  const wishlistIcon = document.querySelector(".wishlist-icon");

  // Function to load content into the content area
  function loadContent(page) {
    fetch(page)
      .then(response => response.text())
      .then(data => {
        contentDiv.innerHTML = data;
      })
      .catch(error => {
        console.error(`Error loading ${page}: ${error}`);
      });
  }

  // Initial load of 'initial.php'
  loadContent("initial.php");

  // Event listener for the wishlist icon
  wishlistIcon.addEventListener("click", event => {
    event.preventDefault(); // Prevent the default link behavior (page reload)
    const page = "assets/php/wishlist.php"; // Specify the page you want to load
    loadContent(page);
  });

  // to load wishlist from bag page 
  function loadwishlist() {
    const page = "assets/php/wishlist.php"; // Specify the page you want to load
    loadContent(page);
  }
  // for navigating bag to content space 
  const bagIcon = document.querySelector(".bag-icon");

  bagIcon.addEventListener("click", event => {
    event.preventDefault(); // Prevent the default link behavior (page reload)
    const page = "assets/php/bag.php"; // Specify the page you want to load
    loadContent(page);
  });
</script>

<!-- rough  -->
<!-- to display the image in product details  -->
<script>
  window.onload = function() {
    const mainImage = document.getElementById("main-image");
    const firstThumbnail = document.querySelector(".thumbnail-image");
    if (firstThumbnail) {
      const thumbnailImg = firstThumbnail.querySelector("img");
      if (thumbnailImg) {
        console.log("Thumbnail Image URL: " + thumbnailImg.src);
        mainImage.src = "uploads/" + thumbnailImg.src;
        console.log("Main Image URL: " + mainImage.src);
      }
    }
  };

  // to display the image in product details 
  function displayImage(imageUrl) {
    const mainImage = document.getElementById("main-image");
    mainImage.src = imageUrl;
  }
</script>

<!-- to load the product details  -->
<script>
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
    xhr.onreadystatechange = function() {
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
</script>

<!-- login signup js  -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Profile Popup Logic
    const profilePopup = document.getElementById("profile-popup");
    const profileOpener = document.getElementById("profile-popup-opener");

    // Open the profile popup on hover
    profileOpener.addEventListener("mouseover", function() {
      profilePopup.style.display = "block";
    });

    // Close the profile popup when leaving the popup area
    profilePopup.addEventListener("mouseleave", function() {
      profilePopup.style.display = "none";
    });

    // General Login/Signup Popup Logic
    const popupContainer = document.getElementById("popup");
    const loginForm = document.getElementById("login-form");
    const signupForm = document.getElementById("signup-form");
    const signupLink = document.getElementById("signup-link");
    const signupSuccessMessage = document.getElementById(
      "signup-success-message"
    );
    const continueButton = document.getElementById("continue-button-popup");
    const continueButtonProfile = document.getElementById(
      "continue-button-profile-popup"
    );

    // Function to show the popup container and dimm the background
    function showPopupContainer() {
      popupContainer.style.display = "block";
      popupContainer.classList.add("animate-drop");
      document.querySelector(".popup-overlay").style.display = "block";
    }
    // Function to hide the popup container and overlay
    function hidePopupContainer() {
      popupContainer.style.display = "none";
      popupContainer.classList.remove("animate-drop");
      document.querySelector(".popup-overlay").style.display = "none";
    }

    // ... (other functions for the general popup)
    // Function to check if the target is inside the popup content
    function isInsidePopupContent(target) {
      return popupContainer.contains(target);
    }

    // Function to handle clicks outside the popup area
    function handleOutsideClick(event) {
      if (
        !isInsidePopupContent(event.target) &&
        event.target !== continueButtonProfile
      ) {
        hidePopupContainer();
      }
    }

    // Attach click event listener to the body
    document.body.addEventListener("click", handleOutsideClick);

    // Function to show the login form and hide the signup form
    function showLoginForm() {
      loginForm.style.display = "block";
      signupForm.style.display = "none";
      signupLink.innerHTML = "Don't have an account? <a href='#'>Sign up</a>";
    }

    // Function to open the login/signup popup
    function openLoginPopup() {
      profilePopup.style.display = "none"; // Hide the profile popup
      showLoginForm(); // Show the login form
      showPopupContainer(); // Show the popup container and overlay
    }

    // Attach click event listener to the "Continue to Login" button
    continueButton.addEventListener("click", function() {
      signupSuccessMessage.style.display = "none"; // Hide the message
      loginForm.style.display = "block"; // Show the login form
      continueButton.style.display = "none"; // Hide the continue button
    });

    // Attach click event listener to the popup opener button in the profile popup
    continueButtonProfile.addEventListener("click", function(event) {
      event.preventDefault();
      openLoginPopup(); // Open the login/signup popup
    });
    // Function to show the signup form and update toggle text
    function showSignupForm() {
      loginForm.style.display = "none";
      signupForm.style.display = "block";
      toggleText.textContent = "Already have an account?";
    }

    // Attach click event listener to the signup link
    signupLink.addEventListener("click", function(event) {
      event.preventDefault();
      showSignupForm();
    });

    // Attach click event listener to the login link in the signup form
    const loginLink = document.getElementById("login-link");

    loginLink.addEventListener("click", function(event) {
      event.preventDefault();
      showLoginForm(); // Show the login form
    });

    // remove from here

    // Attach a submit event listener to the login form
    const loginErrorDiv = document.getElementById("login-error-message");

    loginForm.addEventListener("submit", function(event) {
      event.preventDefault(); // Prevent the default form submission

      const formData = new FormData(loginForm);

      fetch("db_connect_login.php", {
          method: "POST",
          body: formData,
        })
        .then((response) => response.json())
        .then((data) => handleLoginResponse(data))
        .catch((error) =>
          console.error("An error occurred while processing the request.", error)
        );
    });

    function handleLoginResponse(response) {
      if (response.login_success) {
        // Handle successful login
        // For example, display a success message and redirect
        loginErrorDiv.style.display = "none";
        window.location.href = "index.php";
      } else {
        // Display the login failure message below the login form
        loginErrorDiv.textContent = "Incorrect email or password.";
        loginErrorDiv.style.display = "block";
      }
    }
    // Function to check email format using regex
    function isEmailValid(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

    // Attach a submit event listener to the login form
    // Attach a submit event listener to the login form
    document
      .getElementById("login-form")
      .addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission

        const loginForm = this; // Get the login form

        // Create a new FormData object to collect form data
        const formData = new FormData(loginForm);

        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // Configure the request
        xhr.open("POST", "connection/db_connect_login.php", true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest"); // Indicate AJAX request
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              const response = JSON.parse(xhr.responseText);
              handleLoginResponse(response);
            } else {
              console.error("An error occurred while processing the request.");
            }
          }
        };

        // Send the form data
        xhr.send(formData);
      });

    // Function to handle the login response
    function handleLoginResponse(response) {
      const loginErrorDiv = document.getElementById("login-error-message");
      const loginForm = document.getElementById("login-form");
      const loginSuccessMessagePopup = document.getElementById(
        "login-success-message-popup"
      );
      const continueButtonPopup = document.getElementById(
        "continue-button-popup"
      );

      // If login was successful
      if (response.login_success) {
        // Hide the login form
        loginForm.style.display = "none";

        // Display the login success message inside the popup
        loginSuccessMessagePopup.style.display = "block";
        continueButtonPopup.style.display = "block";

        // Set up a click event listener for the continue button
        continueButtonPopup.addEventListener("click", function() {
          // Hide the success message and continue button
          loginSuccessMessagePopup.style.display = "none";
          continueButtonPopup.style.display = "none";

          // Show the login form again
          loginForm.style.display = "block";

          // Redirect to index.php
          window.location.href = "index.php";
        });
      } else {
        // Display the login failure message below the login form
        loginErrorDiv.textContent = "Incorrect email or password.";
        loginErrorDiv.style.display = "block";
        loginForm.email.value = "";
        loginForm.password.value = "";
      }
    }

    // Function to handle the signup process
    document
      .getElementById("signup-form")
      .addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission

        const signupForm = this; // Get the signup form

        // Create a new FormData object to collect form data
        const formData = new FormData(signupForm);

        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // Configure the request
        xhr.open("POST", "connection/db_connect_signup.php", true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest"); // Indicate AJAX request
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              const response = JSON.parse(xhr.responseText);
              handleSignupResponse(response);
            } else {
              console.error("An error occurred while processing the request.");
            }
          }
        };

        // Send the form data
        xhr.send(formData);
      });

    function handleSignupResponse(response) {
      const signupForm = document.getElementById("signup-form");
      const signupSuccessMessage = document.getElementById(
        "signup-success-message"
      );
      const continueButton = document.getElementById("continue-button-popup");

      if (response.signup_success) {
        // Hide the signup form
        signupForm.style.display = "none";

        // Display the signup success message inside the popup
        signupSuccessMessage.style.display = "block";
        continueButton.style.display = "block";
      } else {
        // Display the signup failure message
        console.error(response.message);
      }
    }



  });
</script>



<script>
  function addtobag(product_id) {
    // Retrieve the selected size_id (radio button) and quantity from the form
    const sizeRadios = document.querySelectorAll('input[name="size"]');
    let selectedSizeId = null;

    sizeRadios.forEach((radio) => {
      if (radio.checked) {
        selectedSizeId = radio.value;
      }
    });

    const selectedQuantity = document.getElementById('quantity').value;

    // Make an AJAX request to insert the product into the bag table
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          const response = xhr.responseText;
          if (response === 'success') {
            alert('Product added to bag successfully.');
          } else {
            alert('Error adding product to bag: ' + response);
          }
        } else {
          alert('Error: ' + xhr.status);
        }
      }
    };

    // Define the URL where your PHP script handles the insertion
    const url = 'assets/insert_product_into_bag.php';

    // Create the data to be sent in the request
    const data = new FormData();
    data.append('product_id', product_id);
    data.append('size_id', selectedSizeId); // Pass the selected size_id
    data.append('quantity', selectedQuantity); // Ensure quantity is passed as an integer

    // Open and send the AJAX request
    xhr.open('POST', url, true);
    xhr.send(data);
  }
</script>


<!-- to make pdf  -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const generatePDFButton = document.getElementById('generatePDF');
    if (generatePDFButton) {
      generatePDFButton.addEventListener('click', function() {
        const element = document.querySelector('.invoice-container'); // Replace with the selector of your invoice container
        if (element) {
          const options = {
            margin: 10,
            filename: 'invoice.pdf',
            image: {
              type: 'jpeg',
              quality: 0.98
            },
            html2canvas: {
              scale: 2
            },
            jsPDF: {
              unit: 'mm',
              format: 'a4',
              orientation: 'portrait'
            },
            pagebreak: {
              mode: 'avoid-all',
              before: '.page-break'
            } // Optional: Customize page breaks
          };

          html2pdf()
            .from(element)
            .set(options)
            .toPdf()
            .get('pdf')
            .then(function(pdf) {
              pdf.save();
            });
        } else {
          console.error('Element with class .invoice-container not found in the DOM.');
        }
      });
    } else {
      console.error('Element with id generatePDF not found in the DOM.');
    }
  });
</script>