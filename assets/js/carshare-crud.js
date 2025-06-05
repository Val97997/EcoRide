// set up logical methods for restricting the date picking options for a new carshare :

let departureDateInput = document.getElementById('carshare_departure_date');
let arrivalDateInput = document.getElementById('carshare_arrival_date');

let today = new Date();
let intervalMax = 3;
const formattedDate = today.toISOString().split('T')[0];

departureDateInput.min = formattedDate;

// force the time window to be restricted : !! max duration => 3 days
departureDateInput.addEventListener('change', () => {
    let departureDate = new Date(departureDateInput.value);
    let maxArrivalDate = new Date(departureDate);
    maxArrivalDate.setDate(maxArrivalDate.getDate() + intervalMax);
    arrivalDateInput.max = maxArrivalDate.toISOString().split('T')[0];
    arrivalDateInput.min = departureDate.toISOString().split('T')[0] ;
});
