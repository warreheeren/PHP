<?php


if (empty($naam)) {
    $foutmeldingen['naam'] = 'Naam is verplicht in te vullen.';
}

if (empty($beschrijving)) {
    $foutmeldingen['beschrijving'] = 'Beschrijving is verplicht in te vullen.';
}

if (empty($stock)) {
    $foutmeldingen['stock'] = 'stock is verplicht in te vullen.';
}

if (empty($price)) {
    $foutmeldingen['price'] = 'prijs is verplicht in te vullen.';
}

if (empty($brouwerij)) {
    $foutmeldingen['brouwerij'] = 'brouwerij is verplicht te kiezen.';
}