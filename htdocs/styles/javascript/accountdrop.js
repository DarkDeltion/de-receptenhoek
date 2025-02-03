document.addEventListener("DOMContentLoaded", () => {
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownMenu = document.getElementById("dropdownMenu");

    // Toggle dropdown on button click
    dropdownButton.addEventListener("click", (e) => {
        e.stopPropagation(); // Prevent bubbling to document
        dropdownMenu.style.display =
            dropdownMenu.style.display === "flex" ? "none" : "flex";
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", () => {
        dropdownMenu.style.display = "none";
    });
});
