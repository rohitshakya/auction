<?php

?>

<div class="container mt-4">
    <h2>Create User</h2>
    <p>Fill in the details to create a new user.</p>

    <!-- User Form -->
    <div class="card">
        <div class="card-header">
            User Details
        </div>
        <div class="card-body">
            <form id="createUserForm">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role">
                        <option value="buyer">Buyer</option>
                        <option value="partner">Partner</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top:10px">Create User</button>
            </form>
        </div>
    </div>
</div>

<!-- Include your Bootstrap and jQuery here -->


       
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../assets/js/scripts.js"></script>
</body>
</html>
<script>
$(document).ready(function(){
    $("#createUserForm").submit(function(e){
        e.preventDefault(); // Prevent the default form submission

        let username = $("#username").val();
        let email = $("#email").val();
        let password = $("#password").val();
        let role = $("#role").val();

        $.ajax({
            url: "/addUser",
            type: "POST",
            dataType: "json",
            data: {
                username: username,
                email: email,
                password: password,
                role: role
            },
            success: function(response) {
                showFlashMessage("User has been created Successfully");
            },
            error: function(xhr, status, error) {
                showFlashMessage("Error");
                console.error(status);
                console.error(error);
            }
        });
    });
});
</script>
