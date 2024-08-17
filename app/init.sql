CREATE TABLE users (
                       id SERIAL PRIMARY KEY,
                       github_username VARCHAR(255) NOT NULL
);

CREATE TABLE repositories (
                              id SERIAL PRIMARY KEY,
                              user_id INTEGER,
                              name VARCHAR(255) NOT NULL,
                              updated_at TIMESTAMP NOT NULL,
                              FOREIGN KEY (user_id) REFERENCES users(id)
);

ALTER TABLE repositories
    ADD CONSTRAINT unique_user_id_name UNIQUE (user_id, name);

INSERT INTO users (github_username) VALUES
                                        ('NixOS'),
                                        ('apache'),
                                        ('kubernetes');