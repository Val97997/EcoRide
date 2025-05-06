let btn = document.getElementById('hook-button');
let semicirclebtn = document.getElementById('semicirclebtn');

btn.addEventListener('click', function() {
    semicirclebtn.style.visibility = 'visible';
    btn.style.visibility = 'hidden';
});