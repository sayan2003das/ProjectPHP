let icon = document.getElementById('menu-icon');
let nav = document.getElementById('nav');

let changeIcon = true;

function icon_change() {

    if (changeIcon) {
        icon.classList.remove('fa-bars');
        nav.classList.add('active');
        icon.classList.add('fa-xmark');
        changeIcon = false;
    } else {
        icon.classList.remove('fa-xmark');
        nav.classList.remove('active');
        icon.classList.add('fa-bars');
        changeIcon = true;
    }

}