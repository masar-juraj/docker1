USE guestbook;
CREATE TABLE messages (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	text TEXT NOT NULL,
	datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);
INSERT INTO messages(name,text) VALUES('Juraj','Ahojte');
