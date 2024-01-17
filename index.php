<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();
include('../configs/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= stripslashes($site_settings["site_title"]); ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
    html,
    body {
    height: 100%;
    }

    .form-signin {
    max-width: 330px;
    padding: 1rem;
    }

    .form-signin .form-floating:focus-within {
    z-index: 2;
    }

    .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    }
    </style>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <?php
        if ($_POST) {
            $username   = $_POST["username"];
            $password   = $_POST["password"];

            $panel_url  = $site_settings["xtream_api_url"];

            $post_data = array( 
                'username' => $username, 
                'password' => $password 
            );
            
            $opts = array( 
                'http' => array( 
                    'method' => 'POST', 
                    'header' => 'Content-type: application/x-www-form-urlencoded', 
                    'content' => http_build_query($post_data) 
                    ) 
                );

            $context = stream_context_create($opts); 
            @$api_result = json_decode(file_get_contents($panel_url."rapi.php?action=user&sub=info", false, $context), true);

            if ($api_result["result"] == 1) {
                
                if ($api_result["user_info"]["exp_date"] > time()) {
                    $_SESSION["login"]      = true;
                    $_SESSION["user_data"]  = $api_result["user_info"];
                    echo '<div class="alert alert-success mb-5" role="alert">Giriş işlemi başarıyla gerçekleşti.</div>';
                    header('Refresh:1; url=dashboard.php');
                } else {
                    echo '<div class="alert alert-danger mb-5" role="alert">Üyelik süreniz dolmuştur.</div>';
                }

            } else {
                echo '<div class="alert alert-danger mb-5" role="alert">Üyelik bilgileri bulunamadı.</div>';
            }
        }
        ?>
        <form method="POST" name="login" id="login">
            <center><img class="mb-4 justify-content-center" src="../kredi-karti/assets/img/logo.png" alt=""></center>

            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı adı giriniz.">
                <label for="username">Kullanıcı Adınız</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Şifre giriniz.">
                <label for="password">Şifreniz</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Giriş Yap</button>
            <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2024</p>
        </form>
    </main>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
<? ob_end_flush(); ?>