document.addEventListener('DOMContentLoaded', () => {

   const btns = document.querySelectorAll('.btn');
    btns.forEach((btn) => {
        btn.addEventListener('click', () => {
            if (btn.classList.contains('btnM')) {
                window.location.href = 'Movies/Create.php?page=btnM';

            } else if (btn.classList.contains('btnEm')) {
                window.location.href = 'Movies/Update.php?page=btnEm';

            } else if (btn.classList.contains('btnDm')) {
                window.location.href = 'Movies/Delete.php?page=btnDm';

            } else if (btn.classList.contains('btnS')) {
                window.location.href = 'Schedules/Create.php?page=btnS';

            } else if (btn.classList.contains('btnEs')) {
                window.location.href = 'Schedules/Update.php?page=btnEs';

            } else if (btn.classList.contains('btnDs')) {
                window.location.href = 'Schedules/Delete.php?page=btnDs';

            } else if (btn.classList.contains('btnT')) {
                window.location.href = 'Tickets/Read.php?page=btnT';

            } else if (btn.classList.contains('btnCt')) {
                window.location.href = 'Tickets/Delete.php?page=btnCt';

            } else if (btn.classList.contains('btnU')) {
                window.location.href = 'Users/Read.php?page=btnU';

            } else if (btn.classList.contains('btnEu')) {
                window.location.href = 'Users/Update.php?page=btnEu';

            } else if (btn.classList.contains('btnDu')) {
                window.location.href = 'Users/Delete.php?page=btnDu';

            }
        })


    })

});




