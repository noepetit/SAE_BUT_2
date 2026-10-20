const passwordInput = document.getElementById("password");
const passwordBar = document.getElementById("password-bar");
const passwordStatus = document.getElementById("password-status");

const lengthRule = document.getElementById("rule-length");
const uppercaseRule = document.getElementById("rule-uppercase");
const specialRule = document.getElementById("rule-special");

function updatePasswordStrength() {
    const password = passwordInput.value;

    const hasLength = Array.from(password).length >= 8;
    const hasUppercase = /[A-Z]/.test(password);
    const hasSpecial = /[!@#$%&*?]/.test(password);

    lengthRule.classList.toggle("rule-valid", hasLength);
    uppercaseRule.classList.toggle("rule-valid", hasUppercase);
    specialRule.classList.toggle("rule-valid", hasSpecial);

    let score = 0;

    if (hasLength) {
        score++;
    }

    if (hasUppercase) {
        score++;
    }

    if (hasSpecial) {
        score++;
    }

    passwordBar.style.width = (score / 3 * 100) + "%";

    if (password === "") {
        passwordStatus.textContent = "Saisissez un mot de passe.";
    } else if (score < 3) {
        passwordStatus.textContent = score + "/3 critères respectés.";
    } else {
        passwordStatus.textContent = "3/3 critères respectés.";
    }

    if (score <= 1) {
        passwordBar.style.backgroundColor = "#b91c1c";
    } else if (score === 2) {
        passwordBar.style.backgroundColor = "#b45309";
    } else {
        passwordBar.style.backgroundColor = "#15803d";
    }

    if (score < 3) {
        passwordInput.setCustomValidity(
            "Utilisez au moins 8 caractères, une majuscule et un symbole parmi ! @ # $ % & * ?"
        );
    } else {
        passwordInput.setCustomValidity("");
    }
}

passwordInput.addEventListener("input", updatePasswordStrength);

updatePasswordStrength();