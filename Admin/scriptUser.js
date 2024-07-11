
document.addEventListener('DOMContentLoaded', () => {
    const rows = document.querySelectorAll('#tbl tbody tr');
    const role = document.querySelector("[name='role']");
    const Id = document.getElementById('id')
    const form = document.getElementById('signupForm');
    const fnameInput = document.getElementById('fname');
    const lnameInput = document.getElementById('lname');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const cpasswordInput = document.getElementById('cpassword');

    const fnameError = document.getElementById('fnameError');
    const lnameError = document.getElementById('lnameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const cpasswordError = document.getElementById('cpasswordError');
    const signupButton = form.querySelector('button[type="submit"]');
    document.querySelector('#tbl').addEventListener('click', function (event) {
        const row = event.target.closest('tr');
        if (row) {
            const cells = row.getElementsByTagName('td');
            Id.value = cells[0].innerText;
            fnameInput.value = cells[1].innerText;
            lnameInput.value = cells[2].innerText;
            emailInput.value = cells[3].innerText;
            passwordInput.value = cells[4].innerText;
            cpasswordInput.value = cells[4].innerText;
            role.value = cells[6].innerText;





            Image.value = '';
        }
    });



    fnameInput.addEventListener('blur', validateFname);
    lnameInput.addEventListener('blur', validateLname);
    emailInput.addEventListener('blur', validateEmail);
    passwordInput.addEventListener('blur', () => {
        if (validatePassword()) {
            cpasswordInput.disabled = false;
        } else {
            cpasswordInput.disabled = true;
            signupButton.disabled = true;
        }
    });
    cpasswordInput.addEventListener('blur', validateCPassword);


    form.addEventListener('submit', (event) => {
        let isValid = true;

        // Clear previous errors
        fnameError.textContent = '';
        lnameError.textContent = '';
        emailError.textContent = '';
        passwordError.textContent = '';
        cpasswordError.textContent = '';


        // Validate first name
        if (!validateFname()) {
            isValid = false;
        }

        // Validate last name
        if (!validateLname()) {
            isValid = false;
        }

        // Validate email
        if (!validateEmail()) {
            isValid = false;
        }

        // Validate password
        if (!validatePassword()) {
            isValid = false;
        }

        // Validate confirm password
        if (!validateCPassword()) {
            isValid = false;
        }

        // Validate terms and conditions


        if (!isValid) {
            event.preventDefault();
        }
    });

    function validateFname() {
        const fnameValue = fnameInput.value.trim();
        if (fnameValue === '') {
            fnameError.textContent = 'First name is required.';
            return false;
        } else {
            fnameError.textContent = '';
            return true;
        }
    }

    function validateLname() {
        const lnameValue = lnameInput.value.trim();
        if (lnameValue === '') {
            lnameError.textContent = 'Last name is required.';
            return false;
        } else {
            lnameError.textContent = '';
            return true;
        }
    }

    function validateEmail() {
        const emailValue = emailInput.value.trim();
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if (!emailPattern.test(emailValue)) {
            emailError.textContent = 'Please enter a valid email address.';
            return false;
        } else {
            emailError.textContent = '';
            return true;
        }
    }

    function validatePassword() {
        const passwordValue = passwordInput.value.trim();

        if (passwordValue.length < 6) {
            passwordError.textContent = 'Password must be at least 6 characters long.';
            return false;
        } else {
            passwordError.textContent = '';
            return true;
        }
    }

    function validateCPassword() {
        const passwordValue = passwordInput.value.trim();
        const cpasswordValue = cpasswordInput.value.trim();

        if (passwordValue !== cpasswordValue) {
            cpasswordError.textContent = 'Passwords do not match.';
            return false;
        } else {
            cpasswordError.textContent = '';
            return true;
        }
    }

    function checkFormValidity() {
        if (validateFname() && validateLname() && validateEmail() && validatePassword() && validateCPassword()) {
            signupButton.disabled = false;
        } else {
            signupButton.disabled = true;
        }
    }







});

