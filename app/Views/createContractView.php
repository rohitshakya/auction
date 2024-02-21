<?php

?>

<!-- Main Content -->
<div class="container mt-4">
<h2>Post Contract for Bidding</h2>
<p>Provide the details of the contract you want to post for bidding.</p>

<!-- Contract Form -->
<div class="card">
<div class="card-header">
Contract Details
</div>
<div class="card-body">
<form>
<div class="form-group">
    <label for="contractTitle">Contract Title</label>
    <input type="text" class="form-control" id="contractTitle" placeholder="Enter contract title">
</div>
<div class="form-group">
    <label for="contractDescription">Contract Description</label>
    <textarea class="form-control" id="contractDescription" rows="3" placeholder="Enter contract description"></textarea>
</div>
<div class="form-group">
    <label for="budget">Budget</label>
    <input type="text" class="form-control" id="budget" placeholder="Enter budget">
</div>
<button type="submit" class="btn btn-primary" style="margin-top:10px">Post Contract</button>
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