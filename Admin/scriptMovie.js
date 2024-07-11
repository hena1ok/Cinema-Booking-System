$(document).ready(function () {
    $('#search').on('keyup', function () {
        var search = $(this).val();
        $.ajax({
            url: 'search.php',
            method: 'GET',
            data: { search: search },
            success: function (data) {
                $('#movieData').html(data);
            }
        });
    });

    // Initial load
    $.ajax({
        url: 'search.php',
        method: 'GET',
        success: function (data) {
            $('#movieData').html(data);
        }
    });

    const Id = document.querySelector("[name='id']");
    const Title = document.querySelector("[name='title']");
    const Release_date = document.querySelector("[name='release_date']");
    const Category = document.querySelector("[name='category']");
    const Run_time = document.querySelector("[name='runtime']");
    const Country = document.querySelector("[name='country']");
    const Image = document.querySelector("[name='image']");
    const Video = document.querySelector("[name='video']");

    // Use event delegation to handle click events on table cells
    document.querySelector('#tbl').addEventListener('click', function (event) {
        const row = event.target.closest('tr');
        if (row) {
            const cells = row.getElementsByTagName('td');
            Id.value = cells[0].innerText;
            Title.value = cells[1].innerText;
            Release_date.value = cells[2].innerText;
            Category.value = cells[3].innerText;
            Run_time.value = cells[4].innerText;
            Country.value = cells[5].innerText;
            // Image and video inputs should not be pre-filled with existing values
            Image.value = '';
            Video.value = '';
        }
    });
});
