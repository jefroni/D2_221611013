<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Pencarian Film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Web Pencarian Film</h1>
        <form method="post" action="index.php">
            <div class="form-group">
                <input type="text" name="judul" class="form-control" placeholder="Cari judul film">
                <button type="submit" class="btn btn-primary" name="cari">Cari</button>
            </div>
        </form>
        
        <?php
        if(isset($_POST['cari'])){
            $judul = $_POST['judul'];
            echo "<h2 class='subtitle'>Hasil Pencarian untuk '$judul'</h2>";
        
            $url = 'http://www.omdbapi.com/?apikey=202bed7d&s="'.$judul.'"';

           //Akses API dengan CURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);

            // var_dump($output);
            $data = json_decode($output, TRUE);
            // $data = $data['Search'];
            
            echo "<div class='movie-list'>";
            foreach ($data['Search'] as $movie) {
                echo "<div class='movie'>";
                echo "<img src= '".$movie['Poster']."' class='movie-poster'>";
                echo "<div class='movie-details'>";
                echo "<h3 class='movie-title'>".$movie['Title']."</h3>";
                echo "<p class='movie-year'>".$movie['Year']."</p>";
                echo "</div>";
                echo "</div>";
            }    
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
