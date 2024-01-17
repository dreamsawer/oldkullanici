<?php
ob_start();
include('../configs/functions.php');
if ($_SESSION["login"] != true AND empty($_SESSION["user_data"])) {
    header('Location: index.php');
} else { 
    @$get_player_api = json_decode(file_get_contents($site_settings["playlist_url"].'/player_api.php?username='.$_SESSION["user_data"]["username"].'&password='.$_SESSION["user_data"]["password"].''), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= stripslashes($site_settings["site_title"]); ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container" style="margin-top: 50px;margin-bottom: 50px;">
        <div class="card mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <a href="logout.php"><button class="btn btn-danger mb-3 float-end">Çıkış Yap</button></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="font-size:14px">
                        <tbody>
                            <tr>
                                <td style="width: 30%; font-weight: bold">Güncel Host Url:</td>
                                <td style="width: 70%"><?= $site_settings["playlist_url"]; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; font-weight: bold">Güncel Port:</td>
                                <td style="width: 70%"><?= substr($site_settings["playlist_url"], -4); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; font-weight: bold">Güncel Url:</td>
                                <td style="width: 70%"><?= str_replace(':8080', '', str_replace('http://', '', $site_settings["playlist_url"])); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; font-weight: bold">Kullanıcı Adı:</td>
                                <td style="width: 70%"><?= $get_player_api["user_info"]["username"]; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; font-weight: bold">Şifre:</td>
                                <td style="width: 70%"><?= $get_player_api["user_info"]["password"]; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; font-weight: bold">Bitiş Tarihi:</td>
                                <td style="width: 70%"><?= date('d.m.Y H:i:s', $get_player_api["user_info"]["exp_date"]); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; font-weight: bold">Toplam Kullanıcı:</td>
                                <td style="width: 70%"><?= $get_player_api["user_info"]["max_connections"]; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; font-weight: bold">Aktif Kullanıcı:</td>
                                <td style="width: 70%"><?= $get_player_api["user_info"]["active_cons"]; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; font-weight: bold">M3U MPEGTS Playlist:</td>
                                <td style="width: 70%"><a href="<?= $site_settings["playlist_url"]; ?>/get.php?username=<?= $get_player_api["user_info"]["username"]; ?>&password=<?= $get_player_api["user_info"]["password"]; ?>&type=m3u&output=mpegts"><?= $site_settings["playlist_url"]; ?>/get.php?username=<?= $get_player_api["user_info"]["username"]; ?>&password=<?= $get_player_api["user_info"]["password"]; ?>&type=m3u&output=mpegts</a></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; font-weight: bold">M3U Kategorili MPEGTS Playlist:</td>
                                <td style="width: 70%"><a href="<?= $site_settings["playlist_url"]; ?>/get.php?username=<?= $get_player_api["user_info"]["username"]; ?>&password=<?= $get_player_api["user_info"]["password"]; ?>&type=m3u_plus&output=mpegts"><?= $site_settings["playlist_url"]; ?>/get.php?username=<?= $get_player_api["user_info"]["username"]; ?>&password=<?= $get_player_api["user_info"]["password"]; ?>&type=m3u_plus&output=mpegts</a></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; font-weight: bold">M3U HLS Playlist:</td>
                                <td style="width: 70%"><a href="<?= $site_settings["playlist_url"]; ?>/get.php?username=<?= $get_player_api["user_info"]["username"]; ?>&password=<?= $get_player_api["user_info"]["password"]; ?>&type=m3u&output=m3u8"><?= $site_settings["playlist_url"]; ?>/get.php?username=<?= $get_player_api["user_info"]["username"]; ?>&password=<?= $get_player_api["user_info"]["password"]; ?>&type=m3u&output=m3u8</a></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; font-weight: bold">M3U HLS Kategorili Playlist:</td>
                                <td style="width: 70%"><a href="<?= $site_settings["playlist_url"]; ?>/get.php?username=<?= $get_player_api["user_info"]["username"]; ?>&password=<?= $get_player_api["user_info"]["password"]; ?>&type=m3u_plus&output=m3u8"><?= $site_settings["playlist_url"]; ?>/get.php?username=<?= $get_player_api["user_info"]["username"]; ?>&password=<?= $get_player_api["user_info"]["password"]; ?>&type=m3u_plus&output=m3u8</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card" style="margin-bottom: 50px">
            <div class="card-body">
                <ul class="list-group text-center">
                    <li class="list-group-item"><a href="">Android Telefon ve Tablet İçin Güncel Uygulamalar</a></li>
                    <li class="list-group-item list-group-item-secondary"><a href="">Android Tv / Android Box / Güncel Uygulamalar</a></li>
                    <li class="list-group-item"><a href="">Smart Tv İçin Güncel Uygulamalar</a></li>
                    <li class="list-group-item list-group-item-secondary"><a href="">Apple Ios İçin Güncel Uygulamalar</a></li>
                    <li class="list-group-item"><a href="">Apple Tv İçin Güncel Uygulamalar</a></li>
                    <li class="list-group-item list-group-item-secondary"><a href="">Mac Os İçin Güncel Uygulamalar</a></li>
                    <li class="list-group-item"><a href="">Windows İçin Güncel Uygulamalar</a></li>
                </ul>
            </div>
        </div>
    </main>
</body>
</html>
<? } ?>