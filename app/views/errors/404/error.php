<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 | This page could not found</title>
    <link rel="icon" type="image/x-icon" href="<?= url('public/asset/aqua.png') ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');

        body {
            padding: 0;
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: whitesmoke;
            font-family: "Ubuntu", sans-serif;
        }

        p{
            font-size: 25px;
            display: flex;
            justify-content:center ;
            align-items: center;
        }

        p span{
            color: #00abff;
            font-size: 50px;
            font-weight: 800;
            border-right: 2px solid black;
            margin-right: 30px;
            padding-right: 30px;
        }

    </style>
</head>
<body>
    <p><span>404</span> This page could not found</p>
</body>
</html>