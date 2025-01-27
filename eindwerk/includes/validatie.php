<?php

if (empty($_POST['naam'])) {
    $foutmeldingen['naam'] = 'Naam is verplicht in te vullen.';
}

if (empty($_POST['beschrijving'])) {
    $foutmeldingen['beschrijving'] = 'Beschrijving is verplicht in te vullen.';
}

if (empty($_POST['stock'])) {
    $foutmeldingen['stock'] = 'stock is verplicht in te vullen.';
}

if (empty($_POST['price'])) {
    $foutmeldingen['price'] = 'prijs is verplicht in te vullen.';
}

if (empty($_POST['brouwerij'])) {
    $foutmeldingen['brouwerij'] = 'brouwerij is verplicht te kiezen.';
}