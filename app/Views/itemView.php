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
<!-- Section-->

<?php 
if(!empty($product))
{?>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
        <iframe id="pdfViewer" style="width: 100%; height: 500px;" frameborder="0"></iframe></div>
            <div class="col-md-6">
                <!-- <div class="small mb-1">SKU: BST-498</div>-->
                <h1 class="display-5 fw-bolder"><?= $product['title']??''?></h1>
                <div class="fs-5 mb-5">
                    <!--<span class="text-decoration-line-through"><?= $product['budget']??''?></span>-->
                    <span><?= $product['budget']??''?></span>
                </div>
                <p class="lead"><?= $product['description']??''?></p>
                <div id="bidTimer" class="text-center mb-4"></div>
                <!-- Bid Input Field -->
                <div class="mb-3">
                    <label for="bidAmount" class="form-label">Bid Amount</label>
                    <input type="number" class="form-control" id="bidAmount" name="bidAmount" placeholder="Enter your bid amount" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="placeBid" class="btn btn-primary">Place Bid</button>

                <!-- Bid Listing Table -->
                <table class="table table-striped mt-4" id="bidTable">
                    <thead>
                        <tr>
                            <th scope="col">Bidder</th>
                            <th scope="col">Email</th>
                            <th scope="col">Bid Amount</th>
                            <th scope="col">Bid Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>

    <?php } 
?>


<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Auction 2023</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../assets/js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
<script>

    // Set the target bid time (in seconds)
    //const targetBidTime = <//$targetBidTime ?>; // Replace $targetBidTime with your actual bid time in seconds
    const targetBidTime = 10000000000; 
    // Function to update the bid timer
    function updateBidTimer() {
        const timerElement = document.getElementById('bidTimer');
        const currentTime = Math.floor(Date.now() / 1000); // Get current time in seconds

        const remainingTime = targetBidTime - currentTime;

        if (remainingTime > 0) {
            const minutes = Math.floor(remainingTime / 60);
            const seconds = remainingTime % 60;

            timerElement.innerHTML = `Time left: ${minutes}m ${seconds}s`;
        } else {
            timerElement.innerHTML = 'Bidding closed';
            // Optionally, you can disable the bid input field and submit button here
        }
    }

    // Update the bid timer every second
    setInterval(updateBidTimer, 1000);

    // Initial update of the bid timer
    updateBidTimer();
</script>
<script>
$(document).ready(function(){
   
    $("#placeBid").click(function(){
        let bidAmount = $("#bidAmount").val();
        let productId = "<?=$product['id'];?>";
        $.ajax({
            url: "/createBid",
            type: "POST", 
            dataType: "json", 
            data: { "user_id": 2,"product_id": productId,"amount": bidAmount},
            success: function(response) {
                getBids(productId);
            },
            error: function(xhr, status, error) {
                console.error(status);
                console.error(error);
            }
        });
    });
});

function getBids()
{
    let productId = "<?=$product['id'];?>";
    $.ajax({
        url: "/getBidsByProduct",
        type: "GET", 
        dataType: "json", 
        data: { "id": productId},
        success: function(response) {
            $('#bidTable tbody').empty();
            $.each(response, function(index, item) {
                $('#bidTable tbody').append(
                    '<tr>' +
                    '<td>' + item.user_id + '</td>' +
                    '<td>' + item.product_id + '</td>' +
                    '<td>' + item.amount + '</td>' +
                    '<td>' + item.created_at + '</td>' +
                    '</tr>'
                );
            });
        },
        error: function(xhr, status, error) {
            
            console.error("AJAX request failed");
            console.error(status);
            console.error(error);
        }
    });

}
getBids();
</script>

<script>
var pdfData="<?php echo 'data:application/pdf;base64,'.$product['media'];?>";
$("#pdfViewer").attr("src", pdfData);
</script>