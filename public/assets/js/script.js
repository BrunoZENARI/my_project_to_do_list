// fonction date
const copyrightDate = document.querySelector('#current_date');
let date = new Date();
let year = date.getFullYear();

copyrightDate.innerHTML = year ;