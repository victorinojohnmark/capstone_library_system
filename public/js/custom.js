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