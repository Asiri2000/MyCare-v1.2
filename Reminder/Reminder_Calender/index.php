<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Stay organized with our user-friendly Calendar featuring events, reminders, and a customizable interface. Built with HTML, CSS, and JavaScript. Start scheduling today!"
    />
    <meta
      name="keywords"
      content="calendar, events, reminders, javascript, html, css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Calendar with Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
  </head>
  <body>
     <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar bg-light">
                <div class="p-3 bg-navy text-white d-flex align-items-center">
                    <h4 class="mb-0">Dashboard</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="http://localhost/MyCarev1.1/dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Doc Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Reminders</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 content">
                <nav class="navbar navbar-light bg-navy text-white">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1 text-white"><img src="Screenshot (227).png" alt="Logo" width="60" height="60" class="me-2">MY CARE</span>
                        <div class="d-flex align-items-center">
                            <span class="navbar-text text-white">
                                <img src="images.png" alt="User Image" class="rounded-circle" width="40"> Ruwan Perera
                            </span>
                            <i class="bi bi-bell ms-3 text-white"></i>
                                <i class="bi bi-arrow-right-circle ms-3 text-white"></i> 
                        </div>
                    </div>
                </nav>

    <div class="container" >
      <div class="left">
        <div class="calendar">
          <div class="month">
            <i class="fas fa-angle-left prev"></i>
            <div class="date">december 2015</div>
            <i class="fas fa-angle-right next"></i>
          </div>
          <div class="weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
          </div>
          <div class="days"></div>
          <div class="goto-today">
            <div class="goto">
              <input type="text" placeholder="mm/yyyy" class="date-input" />
              <button class="goto-btn">Go</button>
            </div>
            <button class="today-btn">Today</button>
          </div>
        </div>
      </div>
      <div class="right">
        <div class="today-date">
          <div class="event-day">wed</div>
          <div class="event-date">12th december 2022</div>
        </div>
        <div class="events" ></div>
        <div class="add-event-wrapper" >
          <div class="add-event-header">
            <div class="title">Add Event</div>
            <i class="fas fa-times close"></i>
          </div>
          <div class="add-event-body" >
            <div class="add-event-input">
              <input type="text" placeholder="Event Name" class="event-name" />
            </div>
            <div class="add-event-input">
              <input
                type="text"
                placeholder="Event Time From"
                class="event-time-from"
              />
            </div>
            <div class="add-event-input">
              <input
                type="text"
                placeholder="Event Time To"
                class="event-time-to"
              />
            </div>
              <div class="add-event-input">
                  <input
                          type="email"
                          placeholder="sanjika@gmail.com"
                          id="eventMail"
                  />
              </div>
          </div>
          <div class="add-event-footer ">
            <button class="add-event-btn">Add Event</button>
          </div>
        </div>
      </div>
      <button class="add-event">
        <i class="fas fa-plus"></i>
      </button>
    </div>

   
                <footer class="bg-navy text-white text-center text-lg-start mt-auto">
                    <div class="text-center p-3">
                        <a class="text-white" href="#">2024</a> | <a class="text-white" href="#">My Care</a> | <a class="text-white" href="#">About Us</a> | <a class="text-white" href="#">Contact Us</a>
                    </div>
                </footer>

    <script src="script.js"></script>
  </body>
</html>
