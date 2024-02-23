<?php

?>

<!-- Main Content -->
<div class="container mt-4">
<h2>Post Categories for Bidding</h2>
<p>Provide the details of the category you want to post for bidding.</p>

<!-- Contract Form -->
<div class="card">
<div class="card-header">
Category Details
</div>
<div class="card-body">
<form>
<div class="form-group">
    <label for="categoryTitle">Category Title</label>
    <input type="text" class="form-control" id="categoryTitle" placeholder="Enter Category title">
</div>
<button id="createCategory" class="btn btn-primary" style="margin-top:10px">Create Category</button>
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
   
    $("#createCategory").click(function(){
        let categoryTitle = $("#categoryTitle").val();

        $.ajax({
            url: "/createCategory",
            type: "POST", 
            dataType: "json",
            processData: false,
            contentType: false, 
            data: {"category":categoryTitle},
            success: function(response) {
                console.log(response);
                alert("Posted");
            },
            error: function(xhr, status, error) {
                console.error(status);
                console.error(error);
            }
        });
        return false;
    });
});
</script>