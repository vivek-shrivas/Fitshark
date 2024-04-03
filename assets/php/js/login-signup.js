document.addEventListener("DOMContentLoaded", function () {
  // Profile Popup Logic
  const profilePopup = document.getElementById("profile-popup");
  const profileOpener = document.getElementById("profile-popup-opener");

  // Open the profile popup on hover
  profileOpener.addEventListener("mouseover", function () {
    profilePopup.style.display = "block";
  });

  // Close the profile popup when leaving the popup area
  profilePopup.addEventListener("mouseleave", function () {
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
  continueButton.addEventListener("click", function () {
    signupSuccessMessage.style.display = "none"; // Hide the message
    loginForm.style.display = "block"; // Show the login form
    continueButton.style.display = "none"; // Hide the continue button
  });

  // Attach click event listener to the popup opener button in the profile popup
  continueButtonProfile.addEventListener("click", function (event) {
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
  signupLink.addEventListener("click", function (event) {
    event.preventDefault();
    showSignupForm();
  });

  // Attach click event listener to the login link in the signup form
  const loginLink = document.getElementById("login-link");

  loginLink.addEventListener("click", function (event) {
    event.preventDefault();
    showLoginForm(); // Show the login form
  });

  // remove from here

  // Attach a submit event listener to the login form
  const loginErrorDiv = document.getElementById("login-error-message");

  loginForm.addEventListener("submit", function (event) {
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
    .addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission

      const loginForm = this; // Get the login form

      // Create a new FormData object to collect form data
      const formData = new FormData(loginForm);

      // Create a new XMLHttpRequest object
      const xhr = new XMLHttpRequest();

      // Configure the request
      xhr.open("POST", "connection/db_connect_login.php", true);
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest"); // Indicate AJAX request
      xhr.onreadystatechange = function () {
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
      continueButtonPopup.addEventListener("click", function () {
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
    .addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission

      const signupForm = this; // Get the signup form

      // Create a new FormData object to collect form data
      const formData = new FormData(signupForm);

      // Create a new XMLHttpRequest object
      const xhr = new XMLHttpRequest();

      // Configure the request
      xhr.open("POST", "connection/db_connect_signup.php", true);
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest"); // Indicate AJAX request
      xhr.onreadystatechange = function () {
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
