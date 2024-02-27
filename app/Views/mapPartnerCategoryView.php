<?php

?>

<!-- Main Content -->
<div class="container mt-4">

<div class="d-flex justify-content-end">
    <a id="viewProducts" href="/viewProducts" class="btn btn-primary">View Products</a>
</div>
<h2>Post Product for Bidding</h2>
<p>Provide the details of the product you want to post for bidding.</p>

<!-- Contract Form -->
<div class="card">
<div class="card-header">
Product Details
</div>
<div class="card-body">
<form>




<button id="mapPartnercategory" class="btn btn-primary" style="margin-top:10px">Map</button>
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
   
    $("#mapPartnercategory").click(function(){
        

        $.ajax({
            url: "/createProduct..",
            type: "POST", 
            dataType: "json",
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting content type
            data: formData, // Use FormData object
            success: function(response) {
                FlashMessage("Auction has been created");
            },
            error: function(xhr, status, error) {
                FlashMessage("Error");
                console.error(status);
                console.error(error);
            }
        });
        return false;
    });
});
</script>