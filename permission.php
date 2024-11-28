<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permission required</title>
    <!-- // Head file >>>>> -->
    <?php include("partials/head.php"); ?>
    <!-- // JS >>>> -->
</head>

<body>
    <div class="popup-area" id="popupComponent">
        <div class="popup">
            <div class="popup-content" style="min-height : auto;">
                <h1 class="font-size-big font-weight-medium" style="text-align: center; color: red;">You do not have permission to visit this page.</h1>
                <div class="center" style="display: flex; flex-wrap:wrap; justify-content: center; column-gap : 20px;">
                    <a href="./"><button class="primary-btn tgpx20">Go to dashboard</button></a>
                    <a href="./log-out.php"><button class="secondary-btn tgpx20">Log out</button></a>
                </div>
            </div>
        </div>
        <script>
            $("#popupComponent").fadeIn();
        </script>
    </div>
    <!-- // Footer file >>>> -->
    <?php include("partials/footer.php"); ?>
</body>

</html>