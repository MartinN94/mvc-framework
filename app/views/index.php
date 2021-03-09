<?php
/* This is how you echo out database information on the screen
foreach ($data['users'] as $user) {
    echo "Information: " . $user->user_name . $user->user_email;
    echo "<br>";
}
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php SITENAME ?></title>
</head>
<body>
<h1>Hellooooo!</h1>
<script type="text/javascript">
    var text = <?php echo json_encode($data); ?>;
    console.log(text);
</script>
</body>
</html>

