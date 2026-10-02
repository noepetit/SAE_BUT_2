<?php
    function start_page(string $title): void
    {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>

    </style>
</head>
<body>
<?php
}

function end_page(): void
{
?>
</body>
</html>
<?php
}