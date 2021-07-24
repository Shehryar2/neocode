<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NEOCODE</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Styles -->
</head>
<body class="antialiased">

<div class="container" style="margin-top: 100px;">
    <div class="card">
        <div class="card-header">
            <h4>Zoom OAuth</h4>
        </div>
        <div class="card-body">
            <div class="text-center p-5">
                <i class="fa fa-handshake-o" aria-hidden="true"></i>
                <a class="btn btn-primary" style="font-size: 40px; border-radius: 5px;" href="<?php echo $url = "https://zoom.us/oauth/authorize?response_type=code&client_id=" . env('ZOOM_CLIENT_KEY') . "&redirect_uri=" . env('REDIRECT_URI'); ?>">Login with Zoom</a>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        let url_string = window.location.href
        let url = new URL(url_string);
        let code = url.searchParams.get("code");
        if (code) {
            console.log(code);
            let redirect_url = "{{url('zoom/list', '')}}" + "/" + code;
            window.location.href = redirect_url;
        }
    });
</script>

</body>
</html>
