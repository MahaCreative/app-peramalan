let btn = document.querySelectorAll('.btn');
let login = document.querySelector('#login');
let register = document.querySelector('#register');
btn.forEach((item) => {
    item.addEventListener('click', () => {
        let data = item.getAttribute('data_link')
        if (data == 'login') {
            login.classList.toggle('hidden');
            register.classList.add('hidden');
            login.scrollIntoView({ behavior: 'smooth', block: 'center' });

        } else if (data == 'register') {
            register.classList.toggle('hidden');
            login.classList.add('hidden');
            register.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    })
})