<?php
//open data.csv file

if ($_POST["action"] == "sign-up") {
    $file = fopen('data.csv', 'a');
    $implode = implode(';', $_POST);
    fwrite($file, "\n".$implode);
    fclose($file);
    
    echo <<<HTML
    <html lang="it">
        <head>
        <title>Sign Up</title>
        </head>
        <body>
            <h1>Sign Up</h1>
            <p>Thank you for signing up!</p>
            <p><a href="index.html">Back to Home</a></p>
        </body>
    </html>
    HTML;

}


if ($_POST["action"] == "login") {
    $data = [];

    $file = fopen('data.csv', 'r');
    $found = false;
    while (!feof($file)) {
        $line = fgets($file);
        $data = explode(';', $line);

        $_email = $data[5];
        $_pwd = $data[6];

        if ($_email == $_POST["l_email"] && $_pwd == $_POST["l_pwd"]) {
            $found = true;
            break;
        }
    }

    if ($found) {
        echo <<<HTML
        <html lang="it">
            <head>
            <title>Login</title>
            </head>
            <body>
                <h1>Login</h1>
                <p>Benvenuto!</p>
                <p><a href="index.html">Back to Home</a></p>
                
                <p>
                    Dati personali:
                    <ul>
                        <li>Nome: $data[1]</li>
                        <li>Cognome: $data[2]</li>
                        <li>Data di nascita: $data[3]</li>
                        <li>Sesso: $data[4]</li>
                        <li>Email: $data[5]</li>
                        <li>Password: $data[6]</li>
                    </ul>
                </p>
            </body>
        </html>
        HTML;
    } else {
        echo <<<HTML
        <html lang="it">
            <head>
            <title>Login</title>
            </head>
            <body>
                <h1>Login</h1>
                <p>Invalid email or password!</p>
                <p><a href="index.html">Back to Home</a></p>
            </body>
        </html>
        HTML;
    }
}
