USE simple_blog_db;
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hidden BOOLEAN NOT NULL DEFAULT FALSE CHECK (hidden IN (0, 1)),
    name VARCHAR(128),
    index (name)
);