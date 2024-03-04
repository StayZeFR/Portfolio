CREATE DATABASE IF NOT EXISTS portfolio;

USE portfolio;

CREATE TABLE IF NOT EXISTS user (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) DEFAULT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    password TEXT NOT NULL,
    email VARCHAR(100) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS permission (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL,
    description TEXT DEFAULT NULL,
    status INTEGER DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_by INTEGER DEFAULT NULL,
    FOREIGN KEY (created_by) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS role (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL,
    status INTEGER DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_by INTEGER DEFAULT NULL,
    FOREIGN KEY (created_by) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS user_role (
    user_id INTEGER NOT NULL,
    role_id INTEGER NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_by INTEGER DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (role_id) REFERENCES role(id),
    FOREIGN KEY (created_by) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS role_permission (
    role_id INTEGER NOT NULL,
    permission_id INTEGER NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_by INTEGER DEFAULT NULL,
    FOREIGN KEY (role_id) REFERENCES role(id),
    FOREIGN KEY (permission_id) REFERENCES permission(id),
    FOREIGN KEY (created_by) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS user_permission (
    user_id INTEGER NOT NULL,
    permission_id INTEGER NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_by INTEGER DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (permission_id) REFERENCES permission(id),
    FOREIGN KEY (created_by) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS category (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    name VARCHAR(255) NOT NULL,
    status INTEGER DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS profile (
    user_id INTEGER PRIMARY KEY,
    body TEXT,
    logo_path VARCHAR(255) DEFAULT '',
    cv_path VARCHAR(255) DEFAULT '',
    ts_path VARCHAR(255) DEFAULT '',
    status INTEGER DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS project (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    title TEXT NOT NULL,
    status INTEGER DEFAULT 1,
    description VARCHAR(255) DEFAULT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
    category_id INTEGER NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (category_id) REFERENCES category(id)
);

CREATE TABLE IF NOT EXISTS project_file (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    project_id INTEGER NOT NULL,
    name VARCHAR(255) NOT NULL,
    file_path TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES project(id)
);

CREATE TABLE IF NOT EXISTS technology_watch (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    description VARCHAR(255) DEFAULT '',
    updated_at DATETIME DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS technology_watch_link (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    technology_watch_id INTEGER NOT NULL,
    link TEXT NOT NULL,
    status INTEGER DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (technology_watch_id) REFERENCES technology_watch(id)
);


DELIMITER //
CREATE TRIGGER before_insert_user
    BEFORE INSERT
    ON user FOR EACH ROW
BEGIN
    SET NEW.username = CONCAT(NEW.first_name, '.', NEW.last_name);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_insert_user
    AFTER INSERT
    ON user FOR EACH ROW
BEGIN
    INSERT INTO profile (user_id, body, logo_path, cv_path) VALUES (NEW.id, '', '', '');
    INSERT INTO technology_watch (user_id) VALUES (NEW.id);
END //
DELIMITER ;

INSERT INTO user (first_name, last_name, password, email) VALUES ('ilann', 'blandin', '$2y$10$7u3VRpBZVxVXI1.j1jOC4uDAIrTqX/oTKLcBfJXYTh41Zp/2WLHZi', 'blandin.ilann@gmail.com');
INSERT INTO role (name, created_by) VALUES ('admin', 1);
INSERT INTO permission (name, description, created_by) VALUES ('admin', 'admin permission', 1);
INSERT INTO role_permission (role_id, permission_id, created_by) VALUES (1, 1, 1);
INSERT INTO user_role (user_id, role_id, created_by) VALUES (1, 1, 1);