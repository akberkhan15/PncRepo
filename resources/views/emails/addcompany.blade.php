<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Add Company</title>
</head>
<body>
<div>
    <h2>Hi <?php echo !empty($name) ? $name:''?>,</h2>
    <p>This <?php echo !empty($name) ? $name:''?> is added.</p>
    <p>You can also contact us by phone call : <?php echo SUPPORT_PHONE; ?> or by email : <?php echo SUPPORT_EMAIL; ?> for any help 24x7</p>                                
    <p>Thanks,</p>
    <p>Testing Team.</p>
</div>
</body>
</html>