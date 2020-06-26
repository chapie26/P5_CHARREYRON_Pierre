const pass = document.getElementById('pass');
const pseudo = document.getElementById('pseudo');
const myForm = document.querySelector('#myForm');

myForm.addEventListener('submit', function(event) {
    event.preventDefault();
    console.log('plop');
    const regex = /^[a-z]{6,12}$/g;
    const regex2 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/g;
    if(regex.test(pseudo.value) && regex2.test(pass.value)) {
        myForm.submit();
    }
    else {
        alert('Pseudo entre 6 et 12 charactere, mot de passe entre 8 et 16 charactere( avec au moins 1 lettre majuscule, 1 lettre minuscule ainsi qu\'un chiffre)');
    }
})