const form = document.querySelector('form');
const loginButton = document.getElementById('loginButton');

form.addEventListener('submit', function () {
    loginButton.disabled = true;
    loginButton.innerHTML = `
        <span class="spinner-border spinner-border-sm text-light me-2" role="status" aria-hidden="true"></span>
        <label class="text-white">Entering Web Application...</label>
    `;
});