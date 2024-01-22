CREATE DATABASE IF NOT EXISTS portfolio;

USE portfolio;

CREATE TABLE IF NOT EXISTS user (
                                    id INTEGER PRIMARY KEY AUTO_INCREMENT,
                                    username TEXT NOT NULL,
                                    first_name TEXT NOT NULL,
                                    last_name TEXT NOT NULL,
                                    password TEXT NOT NULL,
                                    email TEXT NOT NULL,
                                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS category (
                                        id INTEGER PRIMARY KEY AUTO_INCREMENT,
                                        name TEXT NOT NULL,
                                        status INTEGER DEFAULT 1,
                                        created_by INTEGER NOT NULL,
                                        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                                        updated_by INTEGER DEFAULT NULL,
                                        updated_at DATETIME DEFAULT NULL,
                                        FOREIGN KEY (updated_by) REFERENCES user(id),
    FOREIGN KEY (created_by) REFERENCES user(id)
    );

CREATE TABLE IF NOT EXISTS post (
                                    id INTEGER PRIMARY KEY AUTO_INCREMENT,
                                    title TEXT NOT NULL,
                                    body TEXT,
                                    status INTEGER DEFAULT 1,
                                    category_id INTEGER NOT NULL,
                                    created_by INTEGER NOT NULL,
                                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                                    updated_by INTEGER DEFAULT NULL,
                                    updated_at DATETIME DEFAULT NULL,
                                    FOREIGN KEY (category_id) REFERENCES category(id),
    FOREIGN KEY (updated_by) REFERENCES user(id),
    FOREIGN KEY (created_by) REFERENCES user(id)
    );
