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
        <style>
            .flash-message-container {
            position: fixed;
            z-index: 1050;
            }
            .flash-message {
            padding: 10px 20px;
            margin-bottom: 10px;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #fff;
            background-color: #007bff; /* Bootstrap primary color */
            border-color: #007bff;
            }

        </style>
        
    </head>

    <body>
            
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="/">Auction</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    
                    <?php 
                    $role = session()->get('role');
                    if(session()->get('token')): 
                    ?>
                        <?php if ($role === 'admin'): ?>

                            <li class="nav-item"><a class="nav-link" href="/addProduct">Products</a></li>
                            <li class="nav-item"><a class="nav-link" href="/createUsers">Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="/createCategories">Categories</a></li>
                            <li class="nav-item"><a class="nav-link" href="/mapPartner">Map Partner</a></li>
                        <?php elseif ($role === 'buyer'): ?>
                            <li class="nav-item"><a class="nav-link" href="/addProduct">Products</a></li>
                        <?php elseif ($role === 'partner'): ?>
                            <li class="nav-item"><a class="nav-link" href="/viewProducts">Products</a></li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li> -->
                    </ul>
                    <form class="d-flex">
                        <?php if (session()->has('token')) : ?>
                            <a href="/logout" class="btn">Logout</a>
                        <?php else : ?>
                            <a href="/login" class="btn">Login</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            <div id="flash-msg-container" class="flash-message-container">
            </div>
        </nav>
        

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function FlashMessage(message) {
  var flashMsgContainer = $('#flash-msg-container');
  var flashMsg = $('<div class="flash-message">' + message + '</div>');

  flashMsgContainer.append(flashMsg);

  flashMsg.delay(5000).fadeOut('slow', function() {
    $(this).remove();
  });
}
</script>