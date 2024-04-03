<head>

  <link rel="stylesheet" href="assets\php\css\navstyle.css">

  <link rel="stylesheet" href="assets\php\css\login-signup.css">
</head>

<style>
  @import url("https://fonts.googleapis.com/css2?family=Mukta:wght@600&display=swap");
  /* search bar  */


  #navbar {
    position: inherit;
    top: 0;
    left: 0;
    border: 1px solid transparent;
    width: 100%;
    height: 80px;
    background-color: #fff;
    font-family: "Mukta", sans-serif;
    font-size: 16px;
    color: #282c3f;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    display: flex;
  }

  #navbar>div {
    display: inline-block;
    vertical-align: top;
  }

  #leftMenu {
    width: 90%;
  }

  #leftMenu>div {
    display: inline-block;
    margin: 28px 14px;
    padding-bottom: 23px;
    vertical-align: top;
  }

  #rightMenu {
    top: 20px;
    right: 40px;
    width: 12%;
    height: 45%;
  }

  #rightMenu>div {
    align-items: flex-end;
    width: 25%;
    height: 100%;
    display: inline-block;
    vertical-align: top;
    cursor: pointer;
  }

  #rightMenu i {
    font-size: 18px;
    margin: 0 9px 0 9px;
    color: #7d7e92;
  }

  #rightMenu>div div {
    font-size: 12px;
    /* margin-top: -7px; */
  }

  #men,
  #women,
  #accessories,
  #home,
  #beauty {
    /* border: 1px solid red; */
    background-color: #fff;
    width: 85%;
    position: absolute;
    top: 81px;
    left: 120px;
    visibility: hidden;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    opacity: 0;
    transition: all 0.3s ease-out;
    z-index: 2;
  }

  #men>div,
  #women>div,
  #accessories>div,
  #home>div,
  #beauty>div {
    display: inline-block;
    vertical-align: top;
    width: 15%;
    font-size: 14px;
    margin-left: 40px;
  }

  #menTtl:hover #men,
  #womenTtl:hover #women,
  #kidsTtl:hover #accessories {
    visibility: visible;
    opacity: 1;
    transition-delay: 0.15s;
  }

  .addju {
    border-bottom: 1px solid #e0e0e2;
    margin: 20px 0;
    padding-bottom: 12px;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    z-index: 9999;
  }

  .addju>div {
    line-height: 25px;
  }

  .addju>div:hover {
    color: black;
    font-weight: 600;
  }

  .head {
    color: black;
    font-weight: bold;
    font-family: "Mukta", sans-serif;
    font-size: 15.5px;
  }

  #women .head {
    color: black;
  }

  #accessories .head {
    color: black;
  }


  #menTtl:hover {
    border-bottom: 3px solid black;
  }

  #womenTtl:hover {
    border-bottom: 3px solid black;
  }

  #kidsTtl:hover {
    border-bottom: 3px solid black;
  }

  .addju div {
    cursor: pointer;
  }
</style>

<head>

<body>
  <header>
    <div id="navbar">
      <div id="leftMenu">
        <div style="margin: 18px 10px; margin-left: 50px; cursor: pointer">
          <a href="index.php"><img width="60px" src="logo\gs-icon-black.svg" /></a>
        </div>

        <div style=" margin-left: 680px; display: inline-flex; gap: 30px;">
          <div id="menTtl">
            <div style="font-weight: bolder;">MENS</div>
            <div id="men" class="overlay-trigger">
              <div>
                <div class="addju">
                  <span class="head">Products</span>

                  <div onclick="loadCategoryProducts(13)">Shorts</div>
                  <div onclick="loadCategoryProducts(14)">T-shirts & Tops</div>
                  <div onclick="loadCategoryProducts(15)">Sweatshirts</div>
                  <div onclick="loadCategoryProducts(16)">Joggers</div>
                  <div onclick="loadCategoryProducts(17)">Hoodies</div>
                  <div onclick="loadCategoryProducts(15)">Tanks</div>
                  <div onclick="loadCategoryProducts(14)">Stingers</div>
                  <div onclick="loadCategoryProducts(20)">Slides</div>
                </div>
                <div class="addju">
                  <span class="head">Innerwear</span>
                  <div onclick="loadCategoryProducts(14)">Sweatsuits</div>
                  <div onclick="loadCategoryProducts(22)">Underwear</div>
                  <div onclick="loadCategoryProducts(16)">Base Layers</div>
                  <div onclick="loadCategoryProducts(14)">Tanks</div>
                </div>
              </div>
              <div>
                <div class="addju">
                  <span class="head">Men Collections</span>
                  <div onclick="loadCategoryProducts(14)">Power</div>
                  <div onclick="loadCategoryProducts(14)">crest</div>
                  <div onclick="loadCategoryProducts(14)">Apex</div>
                  <div onclick="loadCategoryProducts(17)">Legacy</div>
                  <div onclick="loadCategoryProducts(13)">Sport</div>
                </div>
                <div class="addju">
                  <span class="head">Essentials</span>
                  <div onclick="loadCategoryProducts(13)">Briefs & Trunks</div>
                  <div onclick="loadCategoryProducts(22)">Boxers</div>
                  <div onclick="loadCategoryProducts(14)">Vests</div>
                </div>
                <div class="addju">
                  <span class="head">Legacy</span>
                  <div onclick="loadCategoryProducts(17)">Legacy Hoodies</div>
                  <div onclick="loadCategoryProducts(14)">Legacy T-shirts</div>
                  <div onclick="loadCategoryProducts(16)">Legacy Joggers</div>
                </div>
              </div>
              <div>
                <div class="addju">
                  <span class="head">Back To Gym Essentials</span>
                  <div></div>
                  <div onclick="loadCategoryProducts(16)">Conditioning Essentials</div>
                  <div onclick="loadCategoryProducts(53)">Lifting Essentials</div>
                  <div onclick="loadCategoryProducts(17)">Rest Day Essentials</div>
                </div>
              </div>
              <div>
              </div>
            </div>
          </div>
          <div id="womenTtl">
            <div style="font-weight: bolder">WOMENS</div>
            <div id="women">
              <div>
                <div class="addju">
                  <span class="head">Women Trending</span>
                  <div></div>

                  <div onclick="loadCategoryProducts(42)">Matching Sets</div>
                  <div onclick="loadCategoryProducts(43)">Black Leggings</div>
                  <div onclick="loadCategoryProducts(46)">Fall Essentials</div>
                  <div onclick="loadCategoryProducts(42)">Functional Fitness</div>
                  <div onclick="loadCategoryProducts(48)">Oversized</div>
                  <div onclick="loadCategoryProducts(49)">Tank tops</div>
                </div>
              </div>
              <div>

                <div class="addju">
                  <span class="head">Back To GYM</span>
                  <div onclick="loadCategoryProducts(50)">Conditioning Essentials</div>
                  <div onclick="loadCategoryProducts(49)">Lifting Essentials</div>
                  <div onclick="loadCategoryProducts(43)">Rest Day Essentials</div>
                </div>
              </div>
              <div>
                <div class="addju">
                  <span class="head">ACCESSORIES</span>

                  <div onclick="loadCategoryProducts(20)">Slides</div>

                </div>
                <div class="addju">
                  <span class="head">Sports & Active Wear</span>
                  <div onclick="loadCategoryProducts(50)">Sports Bra</div>
                  <div onclick="loadCategoryProducts(42)">Sports Wear</div>
                  <div onclick="loadCategoryProducts(53)">Sports Equipment</div>
                </div>
              </div>
            </div>
          </div>
          <div id="kidsTtl">
            <div style="font-weight: bolder">ACCESSORIES</div>
            <div id="accessories">
              <div>
                <div class="addju">
                  <span class="head">Trending</span>
                  <div onclick="loadCategoryProducts(49)">Best Sellers</div>
                  <div onclick="loadCategoryProducts(20)">Slides</div>
                  <div onclick="loadCategoryProducts(53)">Lifting Accessories</div>
                  <div onclick="loadCategoryProducts(56)" class="addju">
                    <span class="head">Socks</span>
                    <div onclick="loadCategoryProducts(56)">Socks</div>
                  </div>
                </div>
              </div>
              <div>
                <div class="addju">
                  <span class="head">Bags</span>

                  <div onclick="loadCategoryProducts(55)">Backpacks</div>
                </div>
                <div class="addju">
                  <span class="head">Headwear</span>

                  <div onclick="loadCategoryProducts(57)">Caps</div>

                </div>
              </div>
              <div>
                <div class="addju">
                  <span class="head">Innerwear</span>
                  <div onclick="loadCategoryProducts(50)">Womens Bra</div>
                  <div onclick="loadCategoryProducts(22)">Mens Underwear</div>
                </div>

                <div class="addju">
                  <span class="head">Equipments</span>
                  <div onclick="loadCategoryProducts(53)">All Equipments</div>
                  <div onclick="loadCategoryProducts(54)">Bottles</div>
                </div>
              </div>
              <div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="rightMenu" style="display: flex;">
        <ul class="profile-menu">
          <li class="profile-menu-item">
            <div class="login-signup">
              <div class="menu-icon profile-icon">
                <img src="assets/php/images/icons/login-sign-up.webp" alt="Profile Icon" id="profile-popup-opener">
              </div>
              <div class="profile-popup-container" id="profile-popup" style="display: none;">
                <!-- Contents of the profile popup -->
                <div class="profile-popup-content">
                  <h6>Welcome</h6>
                  <p>To access account and manage orders</p>
                  <div class="profile-login-button" id="continue-button-profile-popup" onclick="openLoginPopup()">
                    LOGIN/SIGNUP
                  </div>

                </div>
              </div>
              <span class="menu-text">Profile</span>
            </div>
          </li>
          <li class="profile-menu-item">
            <a href="assets/php/wishlist.php" class="wishlist-text">
              <div class="menu-icon wishlist-icon">
                <img src="assets/php/images/svg/heart.svg" alt="Heart Icon" class="heart-icon">
                <span class="menu-text">Wishlist</span>
              </div>
            </a>
          </li>
          <li class="profile-menu-item">
            <a href="assets/php/bag.php" class="bag-text">
              <div class="menu-icon bag-icon">
                <img src="assets/php/images/svg/shopping-bag-svgrepo-com.svg" alt="Bag Icon" class="bag-icon">
                <span class="menu-text">Bag</span>
              </div>
            </a>
          </li>
        </ul>
      </div>

    </div>
    <div class="popup-overlay"></div>
    <div class="popup-container" id="popup">
      <div class="popup-content">
        <div id="login-success-message-popup" style="display: none;">
          <p>Login successful!</p>
          <button class="login-button" id="continue-button-popup">Continue</button>
        </div>
        <div id="signup-success-message" style="display: none;">
          <p>signup Successful</p>
        </div>
        <form id="login-form" action="connection\db_connect_login.php" method="post">
          <input type="email" placeholder="Email" name="email">
          <input type="password" placeholder="Password" name="password">
          <div class="forgot-password">Forgot Password?</div>
          <button type="submit" class="form-login-button" id="submit-button">Login</button>
          <div class="sign-up-link" id="signup-link">
            Don't have an account? <span id="toggle-text" style="color: blue">Sign up</span>
          </div>
        </form>
        <form action="connection\db_connect_signup.php" method="post" id="signup-form" style="display: none;">
          <input type="text" placeholder="Name" name="name" required>
          <input type="tel" placeholder="Mobile Number" name="mobile" pattern="[0-9]{10}" required>
          <input type="email" placeholder="Email" name="email" required>
          <input type="password" placeholder="Password" name="password" required>
          <button type="submit" class="form-login-button" id="signup-button">Sign Up</button>
          <div class="sign-up-link" id="login-link">
            Already have an account? <span id="login-link" style="color: blue ">Login</span>
          </div>
        </form>
        <div id="login-error-message" style="display: none; color: red;"></div>
      </div>

  </header>
</body>
<script src="assets\php\js\login-signup.js"></script>
</body>

</html>