$(document).ready(function(){
    $('#checkoutBtn').click(function(){
        $.ajax({
            url: 'logout.php',
            type: 'POST',
            success: function(response){
                // Rediriger vers la page de connexion ou une autre page
                window.location.href = 'login.php';
            }
        });
    });
});