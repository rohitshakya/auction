<?php

?>

<!-- Main Content -->
<div class="container mt-4">

    <div class="d-flex justify-content-end">
        <a id="viewCategories" href="/viewCategories" class="btn btn-primary">View Categories</a>
    </div>
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
    $(document).ready(function() {

        $("#createCategory").click(function() {
            let categoryTitle = $("#categoryTitle").val();

            $.ajax({
                url: "/addCategory",
                type: "POST",
                dataType: "json",
                data: {
                    "categoryTitle": categoryTitle
                },
                success: function(response) {
                    FlashMessage("Category created!");
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