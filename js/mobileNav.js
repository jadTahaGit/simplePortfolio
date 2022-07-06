const navIconEL = document.querySelector(".nav-icon");
const closeIconEl = document.querySelector(".close-icon");
const sideBarEl = document.querySelector(".site-sidebar");
const portfolioSectionEl = document.querySelector(".portfolio-section");
// const portfolioSectionEl = document.querySelector(".portfolio-section");
// const portfolioSectionEl = document.querySelector(".portfolio-section");

navIconEL.addEventListener("click", () => {
  sideBarEl.style.display = "flex";
  navIconEL.style.display = "none";
  closeIconEl.style.display = "block";
  portfolioSectionEl.style.marginTop = "32rem";
});

closeIconEl.addEventListener("click", () => {
  sideBarEl.style.display = "none";
  closeIconEl.style.display = "none";
  navIconEL.style.display = "block";
  portfolioSectionEl.style.marginTop = "0";
});
