<!-- Codice HTML per visualizzare i libri disponibili -->
<?php
$query = "SELECT * FROM libri";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<h3>Libri disponibili:</h3>"; 
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li><strong>Titolo:</strong> {$row['titolo']}, <strong>Autore:</strong> {$row['autore']}, <strong>Anno di pubblicazione:</strong> {$row['anno_pubblicazione']}, <strong>Genere:</strong> {$row['genere']} 
            <a href='modifica_libro.php?id={$row['id']}' class='btn btn-info btn-sm'>Modifica</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nessun libro disponibile.</p>";
    }
} else {
    echo "<div class='alert alert-danger'>Errore nella query: " . mysqli_error($conn) . "</div>";
}

mysqli_close($conn);
?>
