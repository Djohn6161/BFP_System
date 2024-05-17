// for loading screen

window.addEventListener('load', function() {
    const loader = document.querySelector('.loader');
    if (loader) {
        loader.classList.add('fade-out');
        loader.addEventListener('transitionend', function() {
            loader.style.display = 'none';
        });
    }
});
