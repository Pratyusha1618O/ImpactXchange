const form = document.querySelector("form");
const usernameInput = document.querySelector("#username");
const passwordInput = document.querySelector("#password");
const submitButton = document.querySelector("#submit");
const errorMessage = document.querySelector(".error-message");

form.addEventListener("submit", (event) => {
    event.preventDefault();
    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

    if (username === "" || password === "") {
        errorMessage.textContent = "Please fill in all fields.";
        errorMessage.classList.add("visible");
    } else {
        errorMessage.classList.remove("visible");
        // Here you can add code to handle successful login, e.g., sending data to a server
        console.log("Username:", username);
        console.log("Password:", password);
    }
});

usernameInput.addEventListener("focus", () => {
    usernameInput.classList.add("active");
});

usernameInput.addEventListener("blur", () => {
    if (usernameInput.value.trim() === "") {
        usernameInput.classList.remove("active");
    }
});

passwordInput.addEventListener("focus", () => {
    passwordInput.classList.add("active");
});

passwordInput.addEventListener("blur", () => {
    if (passwordInput.value.trim() === "") {
        passwordInput.classList.remove("active");
    }
});