// Get the current URL
const url = new URL(window.location.href);

// Extract the access_token parameter
const accessToken = url.searchParams.get("access_token");

// If the access token is found
if (accessToken) {
    // Store the access token in localStorage
    localStorage.setItem("token", accessToken);

    // Remove the access_token parameter from the URL
    url.searchParams.delete("access_token");

    // Update the URL without reloading the page
    window.history.replaceState({}, '', url.toString());
}

// Replace `faculty_code` with the actual faculty code you're trying to retrieve
const facultyCode = "BHNHS-2024-0007"; // Example faculty code
const apiUrl = `http://192.168.2.237/api/retrieve?faculty=${facultyCode}`;

$(document).ready(function() {
    $.ajax({
        url: apiUrl,
        method: "GET",
        success: function(data) {
            // Extract full name from the response
            const fullName = `${data.first_name} ${data.middle_name} ${data.last_name}`.trim();
            const role = data.roles[0]; // Assuming only one role here
            
            // Update the full name in the HTML
            $("#userFullName").text(fullName);
            
            // Optionally, update the role text
            $(".text-xs").text(role);
        },
        error: function(error) {
            console.error("Error fetching data:", error);
        }
    });
});








