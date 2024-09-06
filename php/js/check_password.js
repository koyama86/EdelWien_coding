'use strict';

const check = document.querySelector('#view')
const password = document.querySelector('#password')

check.addEventListener('change', () => {
    if(check.checked) {
        password.setAttribute('type', 'text');
    } else {
        password.setAttribute('type', 'password');
    }
})