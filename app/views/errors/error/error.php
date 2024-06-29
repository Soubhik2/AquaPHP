<?php $errors = json_decode($this->errorJson) ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="<?= url('public/asset/aqua.png') ?>">
    <link rel="stylesheet" href="<?= url('public/style/error.css') ?>">
</head>
<body>
    <div class="container">
        <h1><?= $errors->type ?></h1>
        
        <h3 style="color: red;">TypeError : <span style="margin: 10px;"><?= $errors->message ?></span></h3>
        <h3>Source</h3>
        <div class="source-box">
            <div class="source-head">
                <h4><?php echo $errors->file ?> (<?php echo $errors->line ?>)</h4>
            </div>
            <hr>
            <div class="source-body">
                <h3>
                    <pre white-space: pre-wrap;>
                        <?php //echo $this->trace ?>
                        <?php echo $this->codeSnippet ?>
                    </pre>
                </h3>
            </div>
        </div>
    </div>
</body>
</html>