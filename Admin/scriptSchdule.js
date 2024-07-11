const rows = document.querySelectorAll('#tbl tbody');
const Id = document.querySelector("[name='id']");
const Moveid = document.querySelector("[name='movid']");
const Date = document.querySelector("[name='date']");
const Time = document.querySelector("[name='time']");
const Hall = document.querySelector("[name='hall']");





document.querySelector('#tbl').addEventListener('click', function (event) {
    const row = event.target.closest('tr');
    if (row) {
        const cells = row.getElementsByTagName('td');
        Id.value = cells[0].innerText;
        Moveid.value = cells[1].innerText;
        Date.value = cells[2].innerText;
        Time.value = cells[3].innerText;
        Hall.value = cells[4].innerText;
    }  
    });

