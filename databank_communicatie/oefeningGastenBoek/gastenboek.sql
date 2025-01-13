CREATE TABLE gastenboek (
    id INT NOT NULL AUTO_INCREMENT,
    naam VARCHAR(255) NOT NULL,
    score INT NOT NULL,
    beschrijving TEXT NOT NULL,
    hotel_id INT NOT NULL,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id)
);  

CREATE TABLE hotels (
    id INT NOT NULL AUTO_INCREMENT,
    naam VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO hotels (naam) VALUES 
('Het Centrum'), ('In De Boogstraat'), ("Aan't Station");

INSERT INTO gastenboek (naam, score, beschrijving, hotel_id) VALUES
('Bert Lempens', 4, 'Heel mooi gelegen en super service!', 2),
('Danny Drijvers', 3, 'Mooi gebouw, lekker ontbijt, maar de room service was iets minder.', 1),
('Stef Hermans', 1, 'Zeer slechte service. Niet aan te raden.', 1),
('Bert Lempens', 2, "Niet aan te raden. Room service was heel erg slecht.", 1),
('Danny Drijvers', 4, "Alles was tiptop in orde!", 3);