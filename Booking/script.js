document.getElementById('load-seats').addEventListener('click', function () {
    const hallId = document.getElementById('hall').value;
    fetch(`get_hall_data.php?hall_id=${hallId}`)
        .then(response => response.json())
        .then(data => {
            displaySeats(data);
        })
        .catch(error => console.error('Error fetching hall data:', error));
});

function displaySeats(data) {
    const seatMap = document.getElementById('seat-map');
    seatMap.innerHTML = '';

    if (!data || !data.seating_arrangement) {
        seatMap.innerHTML = '<p>No seat data available.</p>';
        return;
    }

    const rows = data.seating_arrangement.split('\n');
    rows.forEach((row, rowIndex) => {
        const rowDiv = document.createElement('div');
        rowDiv.classList.add('row');

        const seats = row.split('');
        seats.forEach((seat, seatIndex) => {
            const seatDiv = document.createElement('div');
            seatDiv.classList.add('seat');
            if (seat === '1') {
                seatDiv.classList.add('available');
                seatDiv.addEventListener('click', () => selectSeat(rowIndex, seatIndex));
            } else {
                seatDiv.classList.add('unavailable');
            }
            rowDiv.appendChild(seatDiv);
        });

        seatMap.appendChild(rowDiv);
    });
}

function selectSeat(rowIndex, seatIndex) {
    const selectedSeats = document.getElementById('selected-seats');
    const seatInfo = `Row: ${rowIndex + 1}, Seat: ${seatIndex + 1}`;
    selectedSeats.innerHTML += `<p>${seatInfo}</p>`;
}
