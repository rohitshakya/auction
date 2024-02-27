<?php
?>

<style>
body {
    background-color: #f8f9fa;
}
.login-form {
    width: 360px;
    margin: 50px auto;
    padding: 30px;
    border: 1px solid #ddd;
    background-color: #fff;
    border-radius: 5px;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form class="login-form">
                <h2 class="text-center">Login</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control" placeholder="Enter your username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" class="form-control" placeholder="Enter your password">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button id="loginButton" style="margin-top: 10px" class="btn btn-primary btn-block">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../assets/js/scripts.js"></script>
</body>
</html>

<script>
$(document).ready(function(){
   
    $("#loginButton").click(function(){
       
        let email = $("#username").val();
        let password = $("#password").val();;
        $.ajax({
            url: "/auth",
            type: "POST", 
            dataType: "json", 
            data: { "email": email,"password": password},
            success: function(response) {
                if (response.token) {
                    window.location.href = "/";
                }else
                {
                    FlashMessage("Incorrect email or password.");
                }
            },
            error: function(xhr, status, error) {
                FlashMessage("Incorrect email or password.");
                console.error(status);
                console.error(error);
            }
        });
        return false;
    });
});
</script>
<script>
    // JavaScript to toggle password visibility
    document.getElementById("togglePassword").addEventListener("click", function() {
        var passwordField = document.getElementById("password");
        var icon = document.getElementById("toggleIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });
</script>