<!-- profile icon hover  -->

<li class="menu-item">
    <div class="login-signup">
        <div class="profile-account-icon">
            <img src="icons\login-sign-up.webp" alt="Account Icon" id="profile-popup-opener">
            <span class="account-text">profile</span>
        </div>
        <div class="profile-popup-container" id="profile-popup">
            <!-- Contents of the profile popup -->
            <div class="profile-popup-content">
                <h4>Welcome</h4>
                <p>To access account and manage orders</p>
                <button class="login-button" id="continue-button-profile-popup">LOGIN/SIGNUP</button>
                <div class="profile-popup-options">
                    <a href="#">Orders</a>
                    <a href="#">Wishlist</a>
                    <a href="#">Giftcards</a>
                    <a href="#">Contact us</a>
                </div>
            </div>
        </div>
        <div class="popup-overlay"></div>
    </div>
</li>

<!-- pop-up of login -->
<div class="popup-container" id="popup">
    <div class="popup-content">
        <div id="login-success-message-popup" style="display: none;">
            <p>Login successful!</p>
            <button class="login-button" id="continue-button-popup">Continue</button>
        </div>
        <form id="login-form" action="connection\db_connect_login.php" method="post">
            <input type="email" placeholder="email" name="email">
            <input type="password" placeholder="password" name="password">
            <div class="forgot-password">Forgot Password?</div>
            <button type="submit" class="login-button" onclick="onLogin()">Login</button>
        </form>
        <form action="connection\db_connect_signup.php" method="post" id="signup-form" style="display: none;">
            <input type="text" placeholder="Name" name="name" required>
            <input type="tel" placeholder="Mobile Number" name="mobile" pattern="[0-9]{10}" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Password" name="pasword" required>
            <button type="submit" class="login-button" id="signup-button">Sign Up</button>
        </form>
        <div id="login-error-message" style="display: none; color: red;"></div>
        <div class="sign-up-link" id="signup-link">Don't have an account? <a href="#">Sign up</a></div>
    </div>
</div>

<!-- script for handelling form data  -->

<script>
    // Attach a submit event listener to the login form
    document.getElementById("login-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Create a new FormData object to collect form data
        const formData = new FormData(this);

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

        // If login was successful
        if (response.login_success) {
            // Hide the login form
            loginForm.style.display = "none";

            // Display the login success message inside the popup
            const loginSuccessMessagePopup = document.getElementById("login-success-message-popup");
            const continueButtonPopup = document.getElementById("continue-button-popup");
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


    // Function to check email format using regex
    function isEmailValid(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
</script>


<!-- bag and wishlist  -->

<li class="menu-item">
    <a href="wishlist.php" class="wishlist-text">
        <div class="wishlist-icon">
            <img src="images\svg\heart.svg" alt="Heart Icon" class="heart-icon">
            <span class="wishlist-text">Wishlist</span>
        </div>
    </a>
</li>
<li class="menu-item">
    <a href="bag.php" class="bag-text">
        <div class="bag-icon">
            <img src="images\svg\shopping-bag-svgrepo-com.svg" alt="Heart Icon" class="heart-icon">
            <span class="bag-text">Bag</span>
        </div>
    </a>
</li>