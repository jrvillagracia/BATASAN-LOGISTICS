// Get the current URL
const url = new URL(window.location.href);

// Extract the access_token parameter
const accessToken = url.searchParams.get("access_token");

let logoutButton = document.getElementById("logout-button")

// If the access token is found
if (accessToken) {
    // Store the access token in localStorage
    localStorage.setItem("token", accessToken);

    let url = "http://192.168.2.42:8000/admin_dashboard";
    window.location.href = url;
}


logoutButton.addEventListener(function(){
    localStorage.removeItem('token');
});



