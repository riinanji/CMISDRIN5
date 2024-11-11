<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <style>
        /* CSS to position the footer at the bottom */
        body, html {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1; /* Pushes the footer to the bottom */
        }
        .site-footer {
            background-color: #918e8e; /* Updated color */
            color: #fff;
            text-align: center;
            padding: 10px;
        }
        .go-below {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="content">
        <!-- Your main content goes here -->
    </div>

    <!-- Footer section -->
    <footer class="site-footer">
        <div class="text-center">
            &copy; 2024 CMS All rights reserved.
            <a href="#" class="go-below">
                <i class="fa fa-angle-down"></i>
            </a>
        </div>
    </footer>

    <!-- JavaScript for smooth scroll down functionality -->
    <script>
        document.querySelector('.go-below').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>
