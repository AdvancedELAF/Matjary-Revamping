<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $email_title; ?></title>
        <style>
            .mail-wrap {
                width: 400px;
                border-top: 5px solid #E63A7B;
                border-bottom: 5px solid #E63A7B;
                padding: 1.5rem;
                background-color: #FFFFFF;
            }

            @media (max-width: 400px){
                .mail-wrap {
                    width: 200px;
                }
            }
        </style>
    </head>
    <body style="list-style: none; text-decoration: none; padding: 0; margin: 0; background-color: #FAFAFA; display: grid; place-content: center; min-height: 100vh;">
        <div class="mail-wrap" style="width: 98%; padding: 1%;background-color: #FFFFFF;">
            <div>
                <img src="https://ds3jdc9r5jgje.cloudfront.net/matjary/matjary-logo.png" style="width: auto; height: 80px; object-fit: contain; margin-bottom: 1rem;">
            </div>
            <div style="font-family: sans-serif;">