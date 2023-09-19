CREATE DATABASE IF NOT EXISTS Tales;

USE Tales;

CREATE TABLE Users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(100) NOT NULL
);

CREATE TABLE Roles (
  role_id INT AUTO_INCREMENT PRIMARY KEY,
  role_name ENUM('storyseeker', 'storyteller', 'administrator') NOT NULL
);

INSERT INTO Roles (role_name) VALUES ('storyseeker'), ('storyteller'), ('administrator');

CREATE TABLE User_Roles (
  user_id INT NOT NULL,
  role_id INT NOT NULL,
  PRIMARY KEY (user_id, role_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
  FOREIGN KEY (role_id) REFERENCES Roles(role_id) ON DELETE CASCADE
);

CREATE TABLE Stories (
  story_id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  content TEXT NOT NULL,
  location VARCHAR(100) NOT NULL,
  category VARCHAR(100) NOT NULL,
  author_id INT NOT NULL,
  popularity INT DEFAULT 0,
  date_submitted DATETIME NOT NULL,
  FOREIGN KEY (author_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

CREATE TABLE Images (
  image_id INT AUTO_INCREMENT PRIMARY KEY,
  story_id INT NOT NULL,
  image_path VARCHAR(200) NOT NULL,
  date_uploaded DATETIME NOT NULL,
  FOREIGN KEY (story_id) REFERENCES Stories(story_id) ON DELETE CASCADE
);
