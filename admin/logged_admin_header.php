
<head>
    <title> CPSC 471 PROJECT </title>

     <!-- Compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <style type="text/css">
        .brand{
            background: #296d98 !important;
        }

        .brand-text{
            color: #296d98 !important;
        }

        form{
            max-width: 800px;
            margin: 20px auto;
            padding: 20px

        }

        #hover_table td:hover {
            cursor: pointer;
        }
    </style>


    <script >
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems, options);
        });
    </script>
</head>

<html>
</html>

<body class = "blue lighten-5">
    <nav class = "blue lighten-3 z-depth-0">
        <div class= "container"> 
            <a href="admin_home.php" class="center brand-logo brand-text"> PROJECT 471</a>

            <ul id="nav-mobile" class = "right hide-on-small-and-down"> 
            
                <li> <a href="../index.php" class= "btn brand z-depth-0"> Logout </a> </li>
            </ul>
        </div>
    </nav>