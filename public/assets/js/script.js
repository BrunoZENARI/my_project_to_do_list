// fonction date
const copyrightDate = document.querySelector('#current_date');
let date = new Date();
let year = date.getFullYear();
copyrightDate.innerHTML = year ;


// // blocage de la date antérieur à la date d'aujourd'hui
// document.addEventListener("DOMContentLoaded", function() {
//     let today = new Date().toISOString().split('T')[0]; // Récupère la date d'aujourd'hui au format 'YYYY-MM-DD'

//     let startDateInputs = document.querySelectorAll('.start-date');
//     let endDateInputs = document.querySelectorAll('.end-date');

//     startDateInputs.forEach(function(startDateInput) {
//         startDateInput.setAttribute('min', today);
//     });

//     endDateInputs.forEach(function(endDateInput) {
//         endDateInput.setAttribute('min', today);
//     });
// });