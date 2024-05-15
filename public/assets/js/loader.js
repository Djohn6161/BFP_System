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