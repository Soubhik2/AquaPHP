<h1>ERROR</h1>
<?php $errors = json_decode($this->errorJson) ?>
<h3>Message: <?php echo $errors->message ?></h3>
<h3>File: <?php echo $errors->file ?> line: (<?php echo $errors->line ?>)</h3>
<h3>
    <pre>
        <?php echo $this->trace ?>
    </pre>
</h3>