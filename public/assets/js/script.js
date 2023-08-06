window.onload = () => {
  let calendarElt = document.getElementById('calendrier');

  let calendar = new FullCalendar.Calendar(calendarElt, {
    initialView: 'dayGridMonth',
    locale: 'fr',
    timeZone: 'Europe/Paris',
    initialDate: '2023-07-07',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: [
      {

      }
    ]
})
  calendar.render();
}