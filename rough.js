// JavaScript for the overlay
document.addEventListener("DOMContentLoaded", function() {
    const accountIcon = document.querySelector(".profile-account-icon");
    const popupContainer = document.querySelector(".profile-popup-container");
    const overlay = document.querySelector(".popup-overlay");
  
    accountIcon.addEventListener("mouseenter", function() {
      overlay.classList.add("active");
    });
  
    popupContainer.addEventListener("mouseenter", function() {
      overlay.classList.add("active");
    });
  
    overlay.addEventListener("mouseleave", function() {
      overlay.classList.remove("active");
    });
  });
  