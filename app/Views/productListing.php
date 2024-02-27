<?php
?>
<div class="container mt-4">
    <h2>All Products</h2>
    <p>Here are all the products available:</p>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <!-- Product name -->
                    <td>
                        <?= $product['name'] ?>
                    </td>
                    <!-- Product description -->
                    <td>
                        <?= $product['description'] ?>
                    </td>
                    <!-- Product price -->
                    <td>
                        <?= $product['starting_price'] ?>
                    </td>
                    <!-- View details button -->
                    <td><a href="#<?= $product['id'] ?>" class="btn btn-primary">View Details</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<nav aria-label="Pagination">
    <hr class="my-0">
    <ul class="pagination justify-content-center my-4">
        <?php if ($currentPage == 1) : ?>
        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
        <?php else : ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $currentPage - 1 ?>">Newer</a></li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
        <?php if ($i == $currentPage) : ?>
        <li class="page-item active" aria-current="page">
            <a class="page-link" href="#!">
                <?= $i ?>
            </a>
        </li>
        <?php else : ?>
        <li class="page-item">
            <a class="page-link" href="?page=<?= $i ?>">
                <?= $i ?>
            </a>
        </li>
        <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage == $totalPages) : ?>
        <li class="page-item disabled"><a class="page-link" href="#!" tabindex="-1" aria-disabled="true">Older</a></li>
        <?php else : ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $currentPage + 1 ?>">Older</a></li>
        <?php endif; ?>
    </ul>
</nav>


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