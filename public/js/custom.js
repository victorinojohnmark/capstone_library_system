function handleImageChange(input, imageId) {
    // console.log(imageId);
    const file = input.files[0]; // Get the selected file from the input
    const selectedImage = document.getElementById(imageId);

    if (file) {
        const reader = new FileReader(); // Create a FileReader
        reader.onload = function(e) {
            selectedImage.src = e.target.result
        };

        reader.readAsDataURL(file); // Read the file as a data URL
    }
}

function acceptOnlyLetters(event) {
    var inputValue = event.key;
    var regex = /^[a-zA-Z\s]+$/;  // \s matches any whitespace character, including spaces
    if (!regex.test(inputValue)) {
        event.preventDefault();
    }
}

function validatePassword(event) {
    var passwordInput = event.target;
    var password = passwordInput.value;
    var errorElement = passwordInput.nextElementSibling;

    if (password.length < 8) {
        errorElement.textContent = "Must be at least 8 characters long.";
    } else {
        errorElement.textContent = "";
    }
}

function validateConfirmPassword(event) {
    var confirmPasswordInput = event.target;
    var confirmPassword = confirmPasswordInput.value;
    var passwordInput = document.getElementsByName('password')[0]; // Assuming your password input has name="password"
    var password = passwordInput.value;
    var errorElement = confirmPasswordInput.nextElementSibling;

    if (confirmPassword !== password) {
        errorElement.textContent = "Passwords do not match.";
    } else {
        errorElement.textContent = "";
    }
}