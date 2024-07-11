const rows = document.querySelectorAll('#tbl tbody tr');
const Id = document.querySelector("[name='id']");
const Fname = document.querySelector("[name='fname']");
const Lname = document.querySelector("[name='lname']");
const Email = document.querySelector("[name='email']");
const Profile = document.querySelector("[name='image']");
const Password = document.querySelector("[name='password']");
const Role = document.querySelector("[name='role']");



rows.forEach((row) => {
    row.addEventListener('click', () => {
        const cells = row.getElementsByTagName('td');
        Id.value = cells[0].innerText;
        Fname.value = cells[1].innerText;
        Lname.value = cells[2].innerText;
        Email.value = cells[3].innerText;
      

       
      
        // Image and video inputs should not be pre-filled with existing values
        Image.value = '';
        Video.value = '';
    });
}
)