let toastbox = document.getElementById('toastbox');

let success = '<i class="fa-solid fa-circle-check"></i> ';
let error = '<i class="fa-solid fa-circle-xmark"></i> ';
let invalid = '<i class="fa-solid fa-circle-exclamation"></i> ';

let loginbtn = document.getElementById('loginbtn');

loginbtn.onclick = function () {
    var name = document.getElementById('name').value;
    var pass = document.getElementById('password').value;


    if (name === "" || pass === "") {
        // alert("work");
        showToast(invalid,"Invalid Input, Fill the Requird Field");
    } 
}





function showToast(msg, text) {
    
    let fullmsg = msg + text;

    let toast = document.createElement('div');
    toast.classList.add('toasts');
    toast.innerHTML = fullmsg;
    toastbox.appendChild(toast);

    if (fullmsg.includes('Error')) {
        toast.classList.add('error');
    }
    if (fullmsg.includes('Invalid')) {
        toast.classList.add('invalid');
    }
    if (fullmsg.includes('Successfully')) {
        toast.classList.add('success');
    }
    setTimeout(() => {
        toast.remove();
    }, 5000);

}
