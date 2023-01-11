function delete_verify() {
    if (confirm('Are you sure you want to delete?') == true) {
        document.getElementById("delete_link").click();
        alert("Deletion finished.")
    } else {
        alert("Deletion Cancelled.")
    }
}