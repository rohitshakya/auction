<?php
?>
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Get Your Product</h1>
            <p class="lead fw-normal text-white-50 mb-0">The Auction Platform</p>
        </div>
    </div>
</header>
<style>

.modal-body {
    padding: 0;
}

#pdfIframe {
    width: 100%;
    height: calc(100vh - 120px);
    border: none;
}

.modal-dialog {
    max-width: 90%; 
}

.modal-content {
    height: 90vh;
}
</style>
<!-- Section-->
<div class="modal" id="pdfModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PDF Viewer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="pdfIframe" src="" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<?php 
if(!empty($product)) {?>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <?php if(!empty($product)) {?>
            <div class="col-md-6">
                <iframe id="pdfViewer" style="width: 100%; height: 500px;" frameborder="0"></iframe>
            </div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">
                    <?= $product['title'] ?? ''?>
                </h1>
                <div class="fs-5 mb-5">
                    <span><?= $product['budget'] ?? ''?></span>
                </div>
                <p class="lead">Product Description:
                    <?= $product['description'] ?? ''?>
                </p>
                <div id="bidTimer" class="text-center mb-4"></div>
                <?php if(session('role')=='partner'){?>
                <div class="mb-3">
                    <label for="bidAmount" class="form-label">Bid Amount</label>
                    <input type="number" class="form-control" id="bidAmount" name="bidAmount" placeholder="Enter your bid amount" required>
                </div>
                <div class="form-group mb-3">
                    <label for="pdf_file">PDF File</label>
                    <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept=".pdf">
                </div>

                <button type="submit" id="placeBid" class="btn btn-primary">Place Bid</button>
                <?php }?>
                <table class="table table-striped mt-4" id="bidTable">
                    <thead>
                        <tr>
                            <th scope="col">Bid Amount</th>
                            <th scope="col">Bid Time</th>
                            <th scope="col">View Doc</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <?php } else {?>
            <div class="col-md-12 text-center">
                <p>No product found.</p>
            </div>
            <?php }?>
        </div>
    </div>
</section>

<?php } ?>

<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Auction 2023</p>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../assets/js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
<script>
    var targetBidTime = new Date('+<?= $product['end_datetime ']??"" ?>').getTime() / 1000;

    function updateBidTimer() {
        const timerElement = document.getElementById('bidTimer');
        const currentTime = Math.floor(Date.now() / 1000);
        const remainingTime = Math.max(0, Math.floor((targetBidTime - currentTime)));
        if (remainingTime > 0) {
            const days = Math.floor(remainingTime / (60 * 60 * 24));
            const hours = Math.floor((remainingTime % (60 * 60 * 24)) / (60 * 60));
            const minutes = Math.floor((remainingTime % (60 * 60)) / 60);
            const seconds = remainingTime % 60;

            timerElement.innerHTML = `Time left: ${days}d ${hours}h ${minutes}m ${seconds}s`;
        } else {
            timerElement.innerHTML = 'Bidding closed';
        }
    }

    setInterval(updateBidTimer, 1000);
    updateBidTimer();
</script>
<script>
    $(document).ready(function() {

        $("#placeBid").click(function() {
            let bidAmount = $("#bidAmount").val();
            let productId = "<?=$product['id']??0;?>";
            let partnerId = "<?=session('user_id');?>";
            let pdfFile = $("#pdf_file")[0].files[0]; // Get the selected PDF file

            // Create a FormData object to send the form data including the PDF file
            let formData = new FormData();

            formData.append('partnerId', partnerId);
            formData.append('bidAmount', bidAmount);
            formData.append('productId', productId);
            formData.append('pdf_file', pdfFile);

            $.ajax({
                url: "/createBid",
                type: "POST",
                dataType: "json",
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting content type
                data: formData, // Use FormData object
                success: function(response) {
                    FlashMessage("Bid has been posted");
                    getBids();
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

    function getBids() {
        let productId = "<?=$product['id']?>";
        $.ajax({
            url: "/getBidsByProduct",
            type: "GET",
            dataType: "json",
            data: {
                "id": productId
            },
            success: function(response) {
                $('#bidTable tbody').empty();
                $.each(response, function(index, item) {
                    $('#bidTable tbody').append(
                        '<tr>' +
                        '<td>' + item.amount + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + " <i class='bi bi-eye openPdf' aria-hidden='true'></i>" + '</td>' +
                        '</tr>'
                    );
                });
            },
            error: function(xhr, status, error) {
                FlashMessage("Bid not found");
                console.error(status);
                console.error(error);
            }
        });

    }
    getBids();
</script>

<script>
    var pdfData = "<?php echo 'data:application/pdf;base64,'.($product['media']??'');?>";
    $("#pdfViewer").attr("src", pdfData);

    $(document).ready(function(){
        $("body").on("click", ".openPdf", function(){
        let bidId = 1;
        $.ajax({
            url: "/getBidPdf",
            type: "GET",
            dataType: "json",
            data: {
                "bidId": bidId
            },
            success: function(response) {
            var pdfUrl = 'data:application/pdf;base64,'+response.media;
            $("#pdfIframe").attr("src", pdfUrl);
            $("#pdfModal").modal("show");
            },
            error: function(xhr, status, error) {
                FlashMessage("Bid not found");
                console.error(status);
                console.error(error);
            }
        });
            
    });
    $(".close").click(function(){
        $("#pdfModal").modal("hide");
    });
    
});


</script>

