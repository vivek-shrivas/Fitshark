function managecustomer(pageName) {
  fetch("assets/manage_customer.php")
    .then((response) => response.text())
    .then((content) => {
      document.querySelector(".content").innerHTML = content;
    })
    .catch((error) => {
      console.error("Error loading content:", error);
    });
}
