<link rel="stylesheet" href="assets\php\css\login-signup.css">

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
<script src="assets\php\js\login-signup.js"></script>