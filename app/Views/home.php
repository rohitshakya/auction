<?php
//print_r($products);die;
?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Get Your Deal</h1>
                    <p class="lead fw-normal text-white-50 mb-0">The Auction Platform</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php 
                
                if(!empty($products))
                {
                    foreach($products as $item)
                    {?>
                        <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?=$item['status']?></div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?=$item['name']??''?></h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <!--<span class="text-muted text-decoration-line-through">$20.00</span>-->
                                    <?= $item['starting_price']?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="/getProduct?id=<?=$item['id'];?>">Bid</a></div>
                            </div>
                        </div>
                    </div>
                        <?php
                    }
                }
                
                ?>
                </div>
            </div>
        </section>
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
                        <li class="page-item active" aria-current="page"><a class="page-link" href="#!"><?= $i ?></a></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($currentPage == $totalPages) : ?>
                    <li class="page-item disabled"><a class="page-link" href="#!" tabindex="-1" aria-disabled="true">Older</a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $currentPage + 1 ?>">Older</a></li>
                <?php endif; ?>
            </ul>
        </nav>

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