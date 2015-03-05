CREATE TABLE actor
(
    id INT PRIMARY KEY NOT NULL,
    name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL
);
CREATE TABLE actor_id_seq
(
    sequence_name VARCHAR NOT NULL,
    last_value BIGINT NOT NULL,
    start_value BIGINT NOT NULL,
    increment_by BIGINT NOT NULL,
    max_value BIGINT NOT NULL,
    min_value BIGINT NOT NULL,
    cache_value BIGINT NOT NULL,
    log_cnt BIGINT NOT NULL,
    is_cycled BOOL NOT NULL,
    is_called BOOL NOT NULL
);
CREATE TABLE genre
(
    id INT PRIMARY KEY NOT NULL,
    name VARCHAR(100) NOT NULL
);
CREATE TABLE genre_id_seq
(
    sequence_name VARCHAR NOT NULL,
    last_value BIGINT NOT NULL,
    start_value BIGINT NOT NULL,
    increment_by BIGINT NOT NULL,
    max_value BIGINT NOT NULL,
    min_value BIGINT NOT NULL,
    cache_value BIGINT NOT NULL,
    log_cnt BIGINT NOT NULL,
    is_cycled BOOL NOT NULL,
    is_called BOOL NOT NULL
);
CREATE TABLE movie
(
    id INT PRIMARY KEY NOT NULL,
    genre_id INT,
    title VARCHAR(255) NOT NULL,
    description VARCHAR NOT NULL,
    price NUMERIC(10) NOT NULL,
    pathtocover VARCHAR(255) NOT NULL
);
CREATE TABLE movie_id_seq
(
    sequence_name VARCHAR NOT NULL,
    last_value BIGINT NOT NULL,
    start_value BIGINT NOT NULL,
    increment_by BIGINT NOT NULL,
    max_value BIGINT NOT NULL,
    min_value BIGINT NOT NULL,
    cache_value BIGINT NOT NULL,
    log_cnt BIGINT NOT NULL,
    is_cycled BOOL NOT NULL,
    is_called BOOL NOT NULL
);
CREATE TABLE movies_actors
(
    movie_id INT NOT NULL,
    actor_id INT NOT NULL,
    PRIMARY KEY (movie_id, actor_id)
);
CREATE TABLE mu_order
(
    id INT PRIMARY KEY NOT NULL,
    user_id INT,
    number VARCHAR(30),
    created_at TIMESTAMP NOT NULL,
    completed_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    status_id INT
);
CREATE TABLE mu_order_id_seq
(
    sequence_name VARCHAR NOT NULL,
    last_value BIGINT NOT NULL,
    start_value BIGINT NOT NULL,
    increment_by BIGINT NOT NULL,
    max_value BIGINT NOT NULL,
    min_value BIGINT NOT NULL,
    cache_value BIGINT NOT NULL,
    log_cnt BIGINT NOT NULL,
    is_cycled BOOL NOT NULL,
    is_called BOOL NOT NULL
);
CREATE TABLE mu_user
(
    id INT PRIMARY KEY NOT NULL,
    username VARCHAR(255) NOT NULL,
    username_canonical VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    email_canonical VARCHAR(255) NOT NULL,
    enabled BOOL NOT NULL,
    salt VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    last_login TIMESTAMP DEFAULT NULL,
    locked BOOL NOT NULL,
    expired BOOL NOT NULL,
    expires_at TIMESTAMP DEFAULT NULL,
    confirmation_token VARCHAR(255) DEFAULT NULL,
    password_requested_at TIMESTAMP DEFAULT NULL,
    roles VARCHAR NOT NULL,
    credentials_expired BOOL NOT NULL,
    credentials_expire_at TIMESTAMP DEFAULT NULL,
    name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL
);
CREATE TABLE mu_user_id_seq
(
    sequence_name VARCHAR NOT NULL,
    last_value BIGINT NOT NULL,
    start_value BIGINT NOT NULL,
    increment_by BIGINT NOT NULL,
    max_value BIGINT NOT NULL,
    min_value BIGINT NOT NULL,
    cache_value BIGINT NOT NULL,
    log_cnt BIGINT NOT NULL,
    is_cycled BOOL NOT NULL,
    is_called BOOL NOT NULL
);
CREATE TABLE orderitem
(
    id INT PRIMARY KEY NOT NULL,
    movie_id INT,
    order_id INT,
    price NUMERIC(10) NOT NULL
);
CREATE TABLE orderitem_id_seq
(
    sequence_name VARCHAR NOT NULL,
    last_value BIGINT NOT NULL,
    start_value BIGINT NOT NULL,
    increment_by BIGINT NOT NULL,
    max_value BIGINT NOT NULL,
    min_value BIGINT NOT NULL,
    cache_value BIGINT NOT NULL,
    log_cnt BIGINT NOT NULL,
    is_cycled BOOL NOT NULL,
    is_called BOOL NOT NULL
);
CREATE TABLE orderstatus
(
    id INT PRIMARY KEY NOT NULL,
    status VARCHAR(20) NOT NULL
);
CREATE TABLE orderstatus_id_seq
(
    sequence_name VARCHAR NOT NULL,
    last_value BIGINT NOT NULL,
    start_value BIGINT NOT NULL,
    increment_by BIGINT NOT NULL,
    max_value BIGINT NOT NULL,
    min_value BIGINT NOT NULL,
    cache_value BIGINT NOT NULL,
    log_cnt BIGINT NOT NULL,
    is_cycled BOOL NOT NULL,
    is_called BOOL NOT NULL
);
CREATE TABLE review
(
    id INT PRIMARY KEY NOT NULL,
    movie_id INT,
    reviewcontent VARCHAR NOT NULL
);
CREATE TABLE review_id_seq
(
    sequence_name VARCHAR NOT NULL,
    last_value BIGINT NOT NULL,
    start_value BIGINT NOT NULL,
    increment_by BIGINT NOT NULL,
    max_value BIGINT NOT NULL,
    min_value BIGINT NOT NULL,
    cache_value BIGINT NOT NULL,
    log_cnt BIGINT NOT NULL,
    is_cycled BOOL NOT NULL,
    is_called BOOL NOT NULL
);
ALTER TABLE movie ADD FOREIGN KEY (genre_id) REFERENCES genre (id);
CREATE INDEX idx_dc9fdd6b4296d31f ON movie (genre_id);
ALTER TABLE movies_actors ADD FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE;
ALTER TABLE movies_actors ADD FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE;
CREATE INDEX idx_a857225110daf24a ON movies_actors (actor_id);
CREATE INDEX idx_a85722518f93b6fc ON movies_actors (movie_id);
ALTER TABLE mu_order ADD FOREIGN KEY (user_id) REFERENCES mu_user (id);
ALTER TABLE mu_order ADD FOREIGN KEY (status_id) REFERENCES orderstatus (id);
CREATE INDEX idx_5e4f4b286bf700bd ON mu_order (status_id);
CREATE INDEX idx_5e4f4b28a76ed395 ON mu_order (user_id);
CREATE UNIQUE INDEX uniq_3a763f6692fc23a8 ON mu_user (username_canonical);
CREATE UNIQUE INDEX uniq_3a763f66a0d96fbf ON mu_user (email_canonical);
ALTER TABLE orderitem ADD FOREIGN KEY (movie_id) REFERENCES movie (id);
ALTER TABLE orderitem ADD FOREIGN KEY (order_id) REFERENCES mu_order (id);
CREATE INDEX idx_33e85e198d9f6d38 ON orderitem (order_id);
CREATE INDEX idx_33e85e198f93b6fc ON orderitem (movie_id);
ALTER TABLE review ADD FOREIGN KEY (movie_id) REFERENCES movie (id);
CREATE INDEX idx_7eef84f08f93b6fc ON review (movie_id);
