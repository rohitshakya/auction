<?php
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Auction</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../assets/css/styles.css" rel="stylesheet" />
        
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Auction</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                        <i class="bi bi-box-arrow-in-right me-1"></i> <!-- Login symbol -->
                            Account
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Get Your Contract</h1>
                    <p class="lead fw-normal text-white-50 mb-0">The Auction Platform</p>
                </div>
            </div>
        </header>
        <!-- Section-->

        <?php 
        if(!empty($contract))
        {?>

        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..."></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h1 class="display-5 fw-bolder"><?= $contract['title']??''?></h1>
                        <div class="fs-5 mb-5">
                            <!--<span class="text-decoration-line-through"><?= $contract['budget']??''?></span>-->
                            <span><?= $contract['budget']??''?></span>
                        </div>
                        <p class="lead"><?= $contract['description']??''?></p>
                        <div id="bidTimer" class="text-center mb-4"></div>
                        <!-- Bid Input Field -->
                        <div class="mb-3">
                            <label for="bidAmount" class="form-label">Bid Amount</label>
                            <input type="number" class="form-control" id="bidAmount" name="bidAmount" placeholder="Enter your bid amount" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Place Bid</button>

                        <!-- Bid Listing Table -->
                        <table class="table table-striped mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Bidder</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Bid Amount</th>
                                    <th scope="col">Bid Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>aa</td>
                                <td>aa</td>
                                <td>aaa</td>
                                <td>sss</td>
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