<?php
require_once "ConnexionBD.php";

// Use session_start() to start or resume a session
session_start();

// Check if the form fields are set
if(isset($_POST['uname']) && isset($_POST['password'])) {
    // Function to validate input data
    function validate($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Get username and password from the form
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    // Check if username is empty
    if(empty($uname)) {
        header("Location: indexAdmin.php?error=Username is required");
        exit();
    } elseif (empty($pass)) { // Check if password is empty
        header("Location: indexAdmin.php?error=Password is required");
        exit();
    } else {
        // Establish database connection using ConnexionBD class
        $pdo = ConnexionBD::getInstance();

        // Prepare SQL query to fetch user based on username and password
        $sql = "SELECT * FROM admins WHERE username=? AND userpassword=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uname, $pass]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists
        if($user) {
            // Set session variables
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['id'] = $user['id'];
            header("Location:indexDashboard.php");
            exit();
        } else {
            // Redirect with error message if user doesn't exist
            header("Location: indexAdmin.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    // Redirect if form fields are not set to indexAdmin.php
    header("Location: indexAdmin.php");
    exit();
}
?>
