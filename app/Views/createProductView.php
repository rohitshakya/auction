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
<button type="submit" class="btn btn-primary" style="margin-top:10px">Post Product</button>
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