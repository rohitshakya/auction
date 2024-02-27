<?php 

?>

<!-- Main Content -->
<div class="container mt-4">

    <!-- Button to view products -->
    <div class="d-flex justify-content-end mb-3">
        <a id="viewMappings" href="/viewMappings" class="btn btn-primary">View Mappings</a>
    </div>

    <h2>Map Partner to Category</h2>
    <p>Select a partner and a category to map.</p>

    <!-- Form to map partner to category -->
    <div class="card">
        <div class="card-header">
            Partner & Category Mapping
        </div>
        <div class="card-body">
            <form id="partnerCategoryForm">
                <div class="mb-3">
                    <label for="partnerSelect" class="form-label">Select Partner</label>
                    <select class="form-select" id="partnerSelect" name="partner_id">
                        <option value="">Select Partner</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="categorySelect" class="form-label">Select Category</label>
                    <select class="form-select" id="categorySelect" name="category_id">
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Map</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../assets/js/scripts.js"></script>
<script>
    $(document).ready(function(){
    $("#partnerCategoryForm").submit(function(e){
        e.preventDefault(); // Prevent the default form submission

        let partner_id = $("#partnerSelect").val();
        let category_id = $("#categorySelect").val();

        $.ajax({
            url: "/mapPartnerCategory",
            type: "POST",
            dataType: "json",
            data: {
                "partner_id": partner_id,
                "category_id": category_id,
            },
            success: function(response) {
                FlashMessage("Partner has been mapped.");
            },
            error: function(xhr, status, error) {
                FlashMessage("Error");
                console.error(status);
                console.error(error);
            }
        });
    });
});
    
</script>
