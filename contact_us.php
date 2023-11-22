<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>

    <div class="content-wrapper">
        <div class="container">

            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        
                    <h1 style="text-align: center; font-weight: bold;">Contact Us</h1>

                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f5f5f5;
                        }

                        .content-wrapper {
                            background-color: #ffffff;
                            padding: 20px;
                            margin-top: 20px;
                        }

                        h1 {
                            color: #333;
                        }

                        p {
                            color: #666;
                        }


                        .banner {
                            margin: 20px 0;
                            background: url('images/contact_us.jpg') center/cover no-repeat;
                            height: 200px;
                        }

                        .contact-form {
                            background-color: #f9f9f9;
                            padding: 20px;
                            margin-top: 20px;
                            border-radius: 5px;
                        }

                        .contact-form label {
                            font-weight: bold;
                        }

                        .contact-form input[type="text"],
                        .contact-form textarea {
                            width: 100%;
                            padding: 10px;
                            margin-bottom: 10px;
                            border-radius: 5px;
                            border: 1px solid #ccc;
                        }

                        .contact-form input[type="submit"] {
                            background-color: #3498db;
                            color: white;
                            border: none;
                            padding: 10px 20px;
                            cursor: pointer;
                            border-radius: 5px;
                        }

                        .contact-form input[type="submit"]:hover {
                            background-color: #2980b9;
                        }
                    </style>

                    <!-- Contact Form -->

                    <div class="banner"></div>
                    <div class="contact-form">
                        <form action="contact_process.php" method="post">
                            <label for="name">Name:</label><br>
                            <input type="text" id="name" name="name" required><br>
                            <label for="email">Email:</label><br>
                            <input type="text" id="email" name="email" required><br>
                            <label for="message">Message:</label><br>
                            <textarea id="message" name="message" rows="4" required></textarea><br>
                            <input type="submit" value="Submit">
                        </form>
                    </div>

                    </div>
                    
                </div>
            </section>

        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>