<?php
//  USTAWIENIA 
$inputFile = "wejscie.txt";     
$outputFile = "wynik.txt";      
$searchString = "710, vgs_palm01"; 

// SPRAWDZENIE CZY PLIK ISTNIEJE 
if (!file_exists($inputFile)) {
    die("Plik wejściowy nie istnieje.");
}

// WCZYTANIE PLIKU
$lines = file($inputFile);

// TABLICE 
$matchedLines = [];   // linie do zapisania
$remainingLines = []; // linie które zostają w pliku wejściowym

// PRZETWARZANIE 
foreach ($lines as $line) {
    if (strpos($line, $searchString) !== false) {
        $matchedLines[] = $line;
    } else {
        $remainingLines[] = $line;
    }
}

// ZAPIS WYNIKU
file_put_contents($outputFile, implode("", $matchedLines));

// NADPISANIE PLIKU WEJŚCIOWEGO
file_put_contents($inputFile, implode("", $remainingLines));

echo "Przeniesiono " . count($matchedLines) . " linii do pliku wynikowego.";

?>