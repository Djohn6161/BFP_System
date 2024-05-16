window.addEventListener('load', function() {
    const loader = document.querySelector('.loader');

    // Ensure the loader exists and is visible before starting the fade-out
    if (loader) {
        // Trigger the fade-out transition
        loader.classList.add('fade-out');

        // Wait for the transition to end before hiding the loader completely
        loader.addEventListener('transitionend', function() {
            loader.style.display = 'none';
        });
    }
});
// document.addEventListener('DOMContentLoaded', function() {
//     const loader = document.querySelector('.loader');

//     // Show loader immediately on page load
//     loader.style.display = 'flex';

//     window.addEventListener('load', function() {
//         // Optional: Introduce a delay before starting the fade-out
//         setTimeout(function() {
//             // Trigger the fade-out transition
//             loader.classList.add('fade-out');

//             // Wait for the transition to end before hiding the loader completely
//             loader.addEventListener('transitionend', function() {
//                 loader.style.display = 'none';
//             });
//         }, 1000); // Adjust the delay duration as needed (1000ms = 1 second)
//     });
// });
