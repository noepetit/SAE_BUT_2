--Création de notre table reset_password avec notre clé primaire et
CREATE TABLE reset_password (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token_hash CHAR(64) NOT NULL,
    expires_at DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES utilisateur(id) ON DELETE CASCADE, --Si l'attribut id de la table utilisateur est supprimer alors tout attribut concernant l'id en question dans la table reset_password sera également supprimé.
    INDEX (token_hash) --Index fonctione comme l'index d'un livre, cad MySql ne va pas chercher ligne par ligne le bon token_hash mais va directement au bon.
);
