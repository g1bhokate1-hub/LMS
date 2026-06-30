document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("toggle-btn");
    const sidebar = document.getElementById("sidebar");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("hidden");
        });
    }
});