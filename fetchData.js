document.addEventListener("DOMContentLoaded", function() {
    // ----------------------------------------
    fetch('fetchContacts.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error fetching data: ' + response.status);
            }
            return response.text(); 
        })
        .then(data => {
           
            document.getElementById("ContactForm").innerHTML = data;
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            document.getElementById("contactsTable").innerHTML = '<p>Error loading data. Please try again later.</p>';
        });
});
