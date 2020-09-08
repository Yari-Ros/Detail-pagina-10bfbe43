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
        $serie = $pdo->prepare('SELECT * FROM series WHERE id = :id');
        $serie->bindParam(':id', $id);
        $serie->execute();

        $serie = $serie->fetch(PDO::FETCH_OBJ);
         
        function getTitle() {
            global $serie;
            return $serie->title;
        }
        
        function getRating() {
            global $serie;
            return $serie->rating;
        }
        
        function getAward() {
            global $serie;
            return $serie->has_won_awards;
        }
        
        function hasWonAward() {
            if(getAward()) {
                return 'ja';
            }
            return 'nee';
        }
        
        function getSeasons() {
            global $serie;
            return $serie->seasons;
        }
        
        function getCountry() {
            global $serie;
            return $serie->country;
        }
        
        function getLanguage() {
            global $serie;
            return $serie->language;
        }
        
        function getDescription() {
            global $serie;
            return $serie->description;
        }
?>

<h1><?php echo getTitle(); echo ' - ' . getRating();?></h1>;
<table>
    <tr>
        <th>Awards won</th>
        <td><?php echo hasWonAward(); ?></td>
    </tr>
    <tr>
        <th>Seasons</th>
        <td><?php echo getSeasons(); ?></td>
    </tr>
    <tr>
        <th>Country</th>
        <td><?php echo getCountry(); ?></td>
    </tr>
    <tr>
        <th>Language</th>
        <td><?php echo getLanguage(); ?></td>
    </tr>
</table>

<p><?php echo getDescription(); ?></p>



















