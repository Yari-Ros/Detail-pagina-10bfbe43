<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <?php
        $id = $_GET['id'];
        $host = '127.0.0.1';
        $db   = 'netland';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            echo 'Failed to connect.';
        }
        
        echo "<a href='index.php'> Go back! </a> ";
        $film = $pdo->prepare('SELECT * FROM movies WHERE id = :id');
        $film->bindParam(':id', $id);
        $film->execute();

        $film = $film->fetch(PDO::FETCH_OBJ);
         
        function getTitle() {
            global $film;
            return $film->title;
        }
        
        function getDuration() {
            global $film;
            return $film->duur;
        }
        
        function getDatum() {
            global $film;
            return $film->datum_van_uitkomst;
        }
        
        function getCountry() {
            global $film;
            return $film->land_van_uitkomst;
        }
        
        function getDescription() {
            global $film;
            return $film->description;
        }
        
        function getTrailerID() {
            global $film;
            return $film->youtube_trailer_id;
        }
?>

<h2><?php echo getTitle(); echo ' - ' . getDuration();?></h2>

<table>
    <tr>
        <th>Datum van uitkomst</th>
        <td><?php echo getDatum(); ?></td>
    </tr>
    <tr>
        <th>Land</th>
        <td><?php echo getCountry(); ?></td>
    </tr>
</table>

<p><?php echo getDescription(); ?></p>

<iframe width="420" height="345" src=<?php echo "https://www.youtube.com/embed/" . getTrailerID();?>>
</iframe>

<p><?php echo getDescription(); ?></p>



















