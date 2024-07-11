<!DOCTYPE html>
<html>
<head>
    <title>Change File Input by Clicking an Image in Table Cell</title>
</head>
<body>
    <form id="myForm">
        <input type="file" name="image" id="image">
    </form>

    <table id="myTable">
        <tr>
            <td><img src="./img.jpg" alt="Image 1" width="50" height="50"></td>
        </tr>
        <!-- Add more rows if needed -->
    </table>

    <script>
        const table = document.getElementById('myTable');
        const fileInput = document.getElementById('image');

        table.addEventListener('click', (event) => {
            const clickedCell = event.target.closest('td');
            if (clickedCell) {
                const imageUrl = clickedCell.querySelector('img').src;
                fileInput.value = imageUrl; // Set the file input value
            }
        });
    </script>
</body>
</html>
