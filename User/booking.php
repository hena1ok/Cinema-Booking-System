<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book</title>
  <link rel="stylesheet" href="../Styles/main.css">
  <link rel="stylesheet" href="../Styles/styleBooking.css">
</head>

<body>
  <div class="final__page">
    <div class="checkout__content">
      <h1>CHECKOUT</h1>
      <div class="checkout__content__items">

      </div>
      <div class="btns">
        <button class="checkout__content__button">Pay</button>
        <button class="exit__content__button">Exit</button>
      </div>
    </div>
  </div>
  <?php include("../Add/header.php"); ?>
  <?php

  include("../Config/Connection.php");

  $movie_id = $_SESSION['movie_id'];
  $user_id = $_SESSION['user_id'];
  $hall_id = 2;
  $selected_schedule_id = 1;

  if (isset($_POST['selected_schedule'])) {
    $selected_schedule_id = $_POST['selected_schedule'];

    echo "Selected schedule ID: " . $selected_schedule_id; // Add this line for debugging
    // Fetch the hall ID from the schedule table

    $query = "SELECT * FROM schedules WHERE Id = $selected_schedule_id";
    $result = mysqli_query($getConnection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $hall_id = $row['Hall'];
      echo "Hall ID: " . $hall_id . $selected_schedule_id; // Add this line for debugging
      // Store the hall ID in the session
      $_SESSION['hall_id'] = $hall_id;
      $_SESSION['schedule_id'] = $selected_schedule_id;
    } else {
      echo "No result found for the selected schedule ID."; // Add this line for debugging
    }
  }

  $Schedule_query = "SELECT * from schedules";
  $Schedule_result = mysqli_query($getConnection, $Schedule_query);

  $Movie_query = "SELECT * from movies WHERE Id = $movie_id";
  $Movie_result = mysqli_query($getConnection, $Movie_query);

  $MovieInfo_query = "SELECT * from movies WHERE Id = $movie_id";
  $MovieInfo_result = mysqli_query($getConnection, $MovieInfo_query);
  ?>



  <main class="main">

    <section class="movie__schedule">
      <aside class="movie__details">
        <figure class="movie__poster">

        </figure>
        <div class="movie__description">
          <div class="movie__info">
            <?php
            if (mysqli_num_rows($MovieInfo_result) > 0) {
              $Movie = mysqli_fetch_assoc($MovieInfo_result);
            ?>
              <div class="movie-item">
                <div>Title: <?php echo $Movie['Title']; ?></div>
                <div>Release date: <?php echo $Movie['Release_date']; ?></div>
                <div>Genre: <?php echo $Movie['Category']; ?></div>
              </div>
            <?php

            } else {
              echo "No Details found.";
            }
            ?>
          </div>
        </div>

      </aside>
      <div class="schedule">
        <section class="template__schedule">
          <p>Date</p>
          <p>Time</p>
          <p>Hall</p>
        </section>
        <?php
        if (mysqli_num_rows($Schedule_result) > 0) {
          while ($Schedule_row = mysqli_fetch_assoc($Schedule_result)) {
        ?>
            <div class="schedule-item" data-hall-id="<?php echo $Schedule_row['Hall']; ?>" data-schedule-id="<?php echo $Schedule_row['Id']; ?>">
              <span><?php echo $Schedule_row['Date']; ?></span>
              <span><?php echo $Schedule_row['Time']; ?></span>
              <span><?php echo $Schedule_row['Hall']; ?></span>
            </div>
        <?php

          }
        } else {
          echo "No schedules found.";
        }

        ?>
      </div>
    </section>

    <section class="seat__arrangement">
      <div class="screen">SCREEN</div>
      <div class="normal__seats">
        <div class="left__seats"></div>
        <div class="middle__seats"></div>
        <div class="right__seats"></div>
      </div>
      <div class="vip__seats"></div>

      <div class="status__description">
        <div class="available">
          <svg class="available-seat" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="800" height="800" viewBox="0 0 512 512">
            <path d="M406.069 388.414H105.931v-52.966c0-19.5 15.81-35.31 35.31-35.31h229.517c19.5 0 35.31 15.81 35.31 35.31v52.966zM129.472 211.862H61.79c-4.873 0-8.828 3.955-8.828 8.828v17.655c0 4.873 3.955 8.828 8.828 8.828h65.721l1.961-35.311zM382.528 211.862l1.96 35.31h65.721c4.873 0 8.828-3.955 8.828-8.828V220.69c0-4.873-3.955-8.828-8.828-8.828h-67.681z" />
            <path d="M105.931 335.448c0-13.33 7.477-24.806 18.388-30.808l3.187-57.468H70.621v105.931c0 9.754 7.901 17.655 17.655 17.655h17.655v-35.31zM384.49 247.172l3.196 57.468c10.902 6.003 18.379 17.479 18.379 30.808v35.31h17.655c9.754 0 17.655-7.901 17.655-17.655V247.172H384.49z" />
            <path d="M141.241 300.138h229.517c6.171 0 11.882 1.721 16.922 4.502L374.29 63.629C372.312 27.93 342.784 0 307.032 0H204.968c-35.752 0-65.28 27.93-67.257 63.629L124.319 304.64c5.04-2.781 10.752-4.502 16.922-4.502" />
            <path d="M339.026 74.414a8.82 8.82 0 0 1-8.801-8.342c-.68-12.297-10.876-21.937-23.19-21.937H204.962c-12.314 0-22.502 9.64-23.181 21.937-.274 4.864-4.378 8.527-9.304 8.333-4.864-.274-8.598-4.44-8.324-9.304 1.201-21.654 19.121-38.621 40.81-38.621h102.073c21.689 0 39.609 16.967 40.81 38.621.274 4.864-3.46 9.031-8.316 9.304-.177.009-.336.009-.504.009" />
            <path d="M353.103 512c-9.754 0-17.655-7.901-17.655-17.655V388.414h35.31v105.931c.001 9.754-7.9 17.655-17.655 17.655M176.552 494.345V388.414h-35.31v105.931c0 9.754 7.901 17.655 17.655 17.655 9.754 0 17.655-7.901 17.655-17.655" />
          </svg>
          <p>Available</p>

        </div>
        <div class="selected">
          <svg class="seat selected-seat" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="800" height="800" viewBox="0 0 512 512">
            <path d="M406.069 388.414H105.931v-52.966c0-19.5 15.81-35.31 35.31-35.31h229.517c19.5 0 35.31 15.81 35.31 35.31v52.966zM129.472 211.862H61.79c-4.873 0-8.828 3.955-8.828 8.828v17.655c0 4.873 3.955 8.828 8.828 8.828h65.721l1.961-35.311zM382.528 211.862l1.96 35.31h65.721c4.873 0 8.828-3.955 8.828-8.828V220.69c0-4.873-3.955-8.828-8.828-8.828h-67.681z" />
            <path d="M105.931 335.448c0-13.33 7.477-24.806 18.388-30.808l3.187-57.468H70.621v105.931c0 9.754 7.901 17.655 17.655 17.655h17.655v-35.31zM384.49 247.172l3.196 57.468c10.902 6.003 18.379 17.479 18.379 30.808v35.31h17.655c9.754 0 17.655-7.901 17.655-17.655V247.172H384.49z" />
            <path d="M141.241 300.138h229.517c6.171 0 11.882 1.721 16.922 4.502L374.29 63.629C372.312 27.93 342.784 0 307.032 0H204.968c-35.752 0-65.28 27.93-67.257 63.629L124.319 304.64c5.04-2.781 10.752-4.502 16.922-4.502" />
            <path d="M339.026 74.414a8.82 8.82 0 0 1-8.801-8.342c-.68-12.297-10.876-21.937-23.19-21.937H204.962c-12.314 0-22.502 9.64-23.181 21.937-.274 4.864-4.378 8.527-9.304 8.333-4.864-.274-8.598-4.44-8.324-9.304 1.201-21.654 19.121-38.621 40.81-38.621h102.073c21.689 0 39.609 16.967 40.81 38.621.274 4.864-3.46 9.031-8.316 9.304-.177.009-.336.009-.504.009" />
            <path d="M353.103 512c-9.754 0-17.655-7.901-17.655-17.655V388.414h35.31v105.931c.001 9.754-7.9 17.655-17.655 17.655M176.552 494.345V388.414h-35.31v105.931c0 9.754 7.901 17.655 17.655 17.655 9.754 0 17.655-7.901 17.655-17.655" />
          </svg>
          <p>Selected</p>

        </div>
        <div class="reserved">
          <svg class="reserved-seat" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="800" height="800" viewBox="0 0 512 512">
            <path d="M406.069 388.414H105.931v-52.966c0-19.5 15.81-35.31 35.31-35.31h229.517c19.5 0 35.31 15.81 35.31 35.31v52.966zM129.472 211.862H61.79c-4.873 0-8.828 3.955-8.828 8.828v17.655c0 4.873 3.955 8.828 8.828 8.828h65.721l1.961-35.311zM382.528 211.862l1.96 35.31h65.721c4.873 0 8.828-3.955 8.828-8.828V220.69c0-4.873-3.955-8.828-8.828-8.828h-67.681z" />
            <path d="M105.931 335.448c0-13.33 7.477-24.806 18.388-30.808l3.187-57.468H70.621v105.931c0 9.754 7.901 17.655 17.655 17.655h17.655v-35.31zM384.49 247.172l3.196 57.468c10.902 6.003 18.379 17.479 18.379 30.808v35.31h17.655c9.754 0 17.655-7.901 17.655-17.655V247.172H384.49z" />
            <path d="M141.241 300.138h229.517c6.171 0 11.882 1.721 16.922 4.502L374.29 63.629C372.312 27.93 342.784 0 307.032 0H204.968c-35.752 0-65.28 27.93-67.257 63.629L124.319 304.64c5.04-2.781 10.752-4.502 16.922-4.502" />
            <path d="M339.026 74.414a8.82 8.82 0 0 1-8.801-8.342c-.68-12.297-10.876-21.937-23.19-21.937H204.962c-12.314 0-22.502 9.64-23.181 21.937-.274 4.864-4.378 8.527-9.304 8.333-4.864-.274-8.598-4.44-8.324-9.304 1.201-21.654 19.121-38.621 40.81-38.621h102.073c21.689 0 39.609 16.967 40.81 38.621.274 4.864-3.46 9.031-8.316 9.304-.177.009-.336.009-.504.009" />
            <path d="M353.103 512c-9.754 0-17.655-7.901-17.655-17.655V388.414h35.31v105.931c.001 9.754-7.9 17.655-17.655 17.655M176.552 494.345V388.414h-35.31v105.931c0 9.754 7.901 17.655 17.655 17.655 9.754 0 17.655-7.901 17.655-17.655" />
          </svg>
          <p>Reserved</p>
        </div>
      </div>
    </section>

    <form id="bookingForm" action="selected.php" method="post" class="form-container">
      <input type="hidden" id="selectedSeatsInput" name="selectedSeatsInput">
      <div class="btns">
        <button type="submit" class="checkout__content__button" name="book_seats">Pay</button>
        <button type="button" class="exit__content__button">Exit</button>
      </div>
    </form>


  </main>


  <?php include("../Add/footer.php"); ?>
</body>

</html>

<script>
  const seatElement = document.createElement('svg');
  const leftSeatElement = document.querySelector('.left__seats');
  const rightSeatElement = document.querySelector('.right__seats');
  const middleSeatElement = document.querySelector('.middle__seats');
  const VIPSeatElement = document.querySelector('.vip__seats');
  const checkoutItems = document.createElement('div');
  const checkoutContentElemet = document.querySelector('.checkout__content__items');

  seatElement.innerHTML = '<svg class="seat" onclick="toggleSeat()" id="seat" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="800" height="800" viewBox="0 0 512 512"><path d="M406.069 388.414H105.931v-52.966c0-19.5 15.81-35.31 35.31-35.31h229.517c19.5 0 35.31 15.81 35.31 35.31v52.966zM129.472 211.862H61.79c-4.873 0-8.828 3.955-8.828 8.828v17.655c0 4.873 3.955 8.828 8.828 8.828h65.721l1.961-35.311zM382.528 211.862l1.96 35.31h65.721c4.873 0 8.828-3.955 8.828-8.828V220.69c0-4.873-3.955-8.828-8.828-8.828h-67.681z" /><path d="M105.931 335.448c0-13.33 7.477-24.806 18.388-30.808l3.187-57.468H70.621v105.931c0 9.754 7.901 17.655 17.655 17.655h17.655v-35.31zM384.49 247.172l3.196 57.468c10.902 6.003 18.379 17.479 18.379 30.808v35.31h17.655c9.754 0 17.655-7.901 17.655-17.655V247.172H384.49z" /><path d="M141.241 300.138h229.517c6.171 0 11.882 1.721 16.922 4.502L374.29 63.629C372.312 27.93 342.784 0 307.032 0H204.968c-35.752 0-65.28 27.93-67.257 63.629L124.319 304.64c5.04-2.781 10.752-4.502 16.922-4.502" /><path d="M339.026 74.414a8.82 8.82 0 0 1-8.801-8.342c-.68-12.297-10.876-21.937-23.19-21.937H204.962c-12.314 0-22.502 9.64-23.181 21.937-.274 4.864-4.378 8.527-9.304 8.333-4.864-.274-8.598-4.44-8.324-9.304 1.201-21.654 19.121-38.621 40.81-38.621h102.073c21.689 0 39.609 16.967 40.81 38.621.274 4.864-3.46 9.031-8.316 9.304-.177.009-.336.009-.504.009" /><path d="M353.103 512c-9.754 0-17.655-7.901-17.655-17.655V388.414h35.31v105.931c.001 9.754-7.9 17.655-17.655 17.655M176.552 494.345V388.414h-35.31v105.931c0 9.754 7.901 17.655 17.655 17.655 9.754 0 17.655-7.901 17.655-17.655" /></svg>';


  // ADDING A CLICK EVENT LISTENER TO THE SCHEDULE AND RETRIEVE THE HALL ID 
  const scheduleItemElements = document.querySelectorAll('.schedule-item');
  scheduleItemElements.forEach(function(item) {
    item.addEventListener('click', function() {
      console.log('Schedule item clicked');
      const scheduleID = item.getAttribute('data-schedule-id');
      console.log('Schedule ID:', scheduleID);
      // Send the selected schedule ID to the server
      const formData = new FormData();
      formData.append('selected_schedule', scheduleID);
      console.log(formData.get('selected_schedule')); // Add this line to check the form 
      fetch('booking.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(data => {
          console.log(data); // You can remove this line
        })
        .catch(error => {
          console.error('Error:', error);
        });

      if (item.getAttribute('data-hall-id') == 1) {
        middleSeatElement.style.display = "none";
      } else {
        middleSeatElement.style.display = "grid";
      }
      console.log(<?php echo $hall_id ?>);
      console.log(<?php echo $_SESSION['schedule_id'] ?>);
      seatGeneration();
    });
  });





  // GET AND DISPLAY THE MOVIE POSTER 
  const moviePosterElement = document.querySelector(".movie__poster");
  <?php
  if (mysqli_num_rows($Movie_result) > 0) {
    $Movie_row = mysqli_fetch_assoc($Movie_result);
  ?>
    moviePosterElement.style.background ="url('../Assets/ScheduleAssets/Images/<?php echo $Movie_row['Image'] ?> ') 0% / contain no-repeat";
  <?php
  }
  ?>

  function seatGeneration() {
    // Clear existing seats
    leftSeatElement.innerHTML = '';
    middleSeatElement.innerHTML = '';
    rightSeatElement.innerHTML = '';
    VIPSeatElement.innerHTML = '';

    // PHP CODE TO RETURN THE SEATS BASED ON HALL
    <?php
    $Seat_query = "SELECT * FROM seats WHERE Hall = $hall_id";
    $bookings = "SELECT * FROM bookings";
    $Seat_result = mysqli_query($getConnection, $Seat_query);
    $bookresult = mysqli_query($getConnection, $bookings);
    echo $hall_id;
    if (mysqli_num_rows($Seat_result) > 0) {
      while ($Seat_row = mysqli_fetch_assoc($Seat_result)) {
        $seatId = $Seat_row['Id'];
        $side = $Seat_row['Side'];


    ?>
       

        // Create a new seat SVG element
        seatSvg = document.createElement('svg');
        seatSvg.innerHTML = seatElement.innerHTML;
        seatSvg.setAttribute('data-seat-id', '<?php echo $seatId ?>');

        seatSvg.setAttribute('selected', 'false');






        // Append the seat SVG element to the appropriate seat section
        <?php
        switch ($side) {
          case 'L': ?>
            leftSeatElement.appendChild(seatSvg);
          <?php break;
          case 'M': ?>
            middleSeatElement.appendChild(seatSvg);
          <?php break;
          case 'R': ?>
            rightSeatElement.appendChild(seatSvg);
          <?php break;
          default: ?>
            VIPSeatElement.appendChild(seatSvg);
        <?php
        }

        ?>
    <?php
      }
    }
    
    ?>
    
  }
</script>


<script>
  let selectedSeats = [];

  function toggleSeat() {
    const seatElements = document.querySelectorAll('.seat');

    seatElements.forEach(seat => {
      if (!seat.hasAttribute('data-selected')) {
        seat.setAttribute('data-selected', 'false');
      }

      seat.addEventListener('click', function() {
        if (seat.getAttribute('data-selected') === 'false') {
          seat.setAttribute('data-selected', 'true');
          seat.classList.add('selected-seat');

          const seatId = seat.parentElement.getAttribute('data-seat-id');
          selectedSeats.push(seatId);
          // Update the hidden input field with the selected seats
          var selectedSeatsInput = document.querySelector('input[name="selectedSeatsInput"]');
          if (selectedSeatsInput) {
            selectedSeatsInput.value = selectedSeats.join(','); // Comma-separated seat IDs
            console.log(selectedSeatsInput);
            console.log('Selected Seats:', selectedSeats);
          }
          seat.style.pointerEvents = 'none';
        }


      });
    });
  }

  document.addEventListener('DOMContentLoaded', toggleSeat);

  document.addEventListener('DOMContentLoaded', function() {
    const submitButton = document.querySelector('.checkout__content__button');
    if (submitButton) {
      submitButton.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission
        // Submit the form to selected.php
        document.getElementById('bookingForm').submit();
      });
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
    const submitButton = document.querySelector('.checkout__content__button');
    if (submitButton) {
      submitButton.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get the selected seat IDs
        const selectedSeatsInput = document.querySelector('input[name="selectedSeats"]');

        console.log('Selected Seats:', selectedSeats);
        // Create a FormData object and append the selected seat IDs
        const formData = new FormData();


        // Before Fetch API call
        console.log('Form Data:', formData);

        fetch('selected.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.text())
          .then(data => {
            console.log(data); // Handle the response from selected.php
          })
          .catch(error => {
            console.error('Error:', error);
          });
      });
    }
  });
</script>



<script src="/JS/main.js"></script>
<script src="/JS/bookingScript.js"></script>