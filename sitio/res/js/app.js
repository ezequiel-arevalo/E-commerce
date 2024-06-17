document.addEventListener("DOMContentLoaded", function() {
    const togglePassword = document.getElementById('togglePassword');
    const inputPassword = document.getElementById('password');

    if (togglePassword) {
        togglePassword.addEventListener('click', () => {
            if (inputPassword.type === 'password') {
                inputPassword.type = 'text';
                togglePassword.innerHTML = '<i class="bi bi-eye"></i>';
            } else {
                inputPassword.type = 'password';
                togglePassword.innerHTML = '<i class="bi bi-eye-slash"></i>';
            }
        });
    }
});