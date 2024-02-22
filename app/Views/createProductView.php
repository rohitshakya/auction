<?php

?>

<!-- Main Content -->
<div class="container mt-4">
<h2>Post Product for Bidding</h2>
<p>Provide the details of the product you want to post for bidding.</p>

<!-- Contract Form -->
<div class="card">
<div class="card-header">
Product Details
</div>
<div class="card-body">
<form>
<div class="form-group">
    <label for="productTitle">Product Title</label>
    <input type="text" class="form-control" id="productTitle" placeholder="Enter Product title">
</div>
<div class="form-group">
    <label for="productDescription">Product Description</label>
    <textarea class="form-control" id="productDescription" rows="3" placeholder="Enter Product description"></textarea>
</div>
<div class="form-group">
    <label for="budget">Budget</label>
    <input type="text" class="form-control" id="budget" placeholder="Enter budget">
</div>
<div class="form-group">
<label for="categoryId">Category</label>
<input type="text" class="form-control" id="categoryId" placeholder="Enter category ID">
</div>
<div class="form-group row">
    <div class="col">
        <label for="startTime">Start Time</label>
        <input type="datetime-local" class="form-control" id="startTime">
    </div>
    <div class="col">
        <label for="endTime">End Time</label>
        <input type="datetime-local" class="form-control" id="endTime">
    </div>
</div>
<button id="createProduct" class="btn btn-primary" style="margin-top:10px">Post Product</button>
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
   
    $("#createProduct").click(function(){
        let productTitle = $("#productTitle").val();
        let productDescription = $("#productDescription").val();
        let budget = $("#budget").val();
        let startTime = $("#startTime").val();
        let endTime = $("#endTime").val();
        $.ajax({
            url: "/createProduct",
            type: "POST", 
            dataType: "json", 
            data: { "name": productTitle,"description": productDescription,"starting_price": budget,"start_datetime":startTime,"end_datetime":endTime},
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