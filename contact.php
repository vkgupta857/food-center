<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact - FoodShala</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>

    <?php include('includes/header.php'); ?>

    <section class="py-3 bg-light">
        <div class="container   ">
            <h4>Contact</h4>
            <p class="small">Get in touch with us</p>
        </div>
    </section>

    <section class="container">
        <div class="row">
            <div class="col-lg-6 py-4">
                <h5 class="text-primary">Address</h5>
                <p>
                    <i class="fa fa-map-marker"></i>
                    ABC, Madhya Pradesh, India
                </p>

                <h5 class="text-primary">Email</h5>
                <p>
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:vkgupta857@gmail.com" title="Click to Mail"
                        class="text-dark">vkgupta857@gmail.com</a>
                </p>

                <h5 class="text-primary">Mobile</h5>
                <p>
                    <i class="fa fa-phone"></i>
                    <a href="tel:+91-9479475120" class="text-dark">+91-9479475120</a>
                </p>
            </div>
            <div class="col-lg-6 py-4" id="contact">
                <h5 class="text-primary">Send Your Query</h5>
                <form method="post">
                    <div class="form-group">
                        <input id="name" class="form-control" name="name" placeholder="Enter your name" type="text"
                            required>
                    </div>
                    <div class="form-group">
                        <input id="mobile" class="form-control" name="mobile" placeholder="Enter mobile" type="text"
                            required>
                    </div>
                    <div class="form-group">
                        <input id="email" class="form-control" name="email" placeholder="Enter email address"
                            pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" type="email" required>
                    </div>
                    <div class="form-group">
                        <textarea id="message" class="form-control" name="message" placeholder="Enter messege"
                            required=""></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" id="submit_button" name="submit">Send <i
                                class="fa fa-send"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <br class="my-4">
    </section>

    <?php include('includes/footer.php'); ?>
    <!-- JS files are included in footer-->

</body>

</html>