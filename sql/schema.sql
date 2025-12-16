CREATE DATABASE lasuradiofm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lasuradiofm;

-- For multiple cities (Lagos/Abuja/PH)
CREATE TABLE stations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  slug VARCHAR(50) NOT NULL UNIQUE,   -- 'lagos','abuja','ph'
  frequency VARCHAR(50) NULL,
  city VARCHAR(100) NOT NULL
);

INSERT INTO stations (name, slug, frequency, city) VALUES
('Nigeria Info, Let''s Talk! Lagos', 'lagos', '99.3 MHz', 'Lagos'),
('Nigeria Info, Let''s Talk! Abuja', 'abuja', '95.1 MHz', 'Abuja'),
('Nigeria Info, Let''s Talk! Port-Harcourt', 'ph', '92.3 MHz', 'Port Harcourt');

-- Shows (Morning Crossfire, Hard Facts, etc.)
CREATE TABLE shows (
  id INT AUTO_INCREMENT PRIMARY KEY,
  station_id INT NOT NULL,
  title VARCHAR(150) NOT NULL,
  slug VARCHAR(150) NOT NULL UNIQUE,
  description TEXT,
  schedule VARCHAR(255),
  image VARCHAR(255),
  is_top_show TINYINT(1) DEFAULT 0,
  FOREIGN KEY (station_id) REFERENCES stations(id) ON DELETE CASCADE
);

-- Presenters
CREATE TABLE presenters (
  id INT AUTO_INCREMENT PRIMARY KEY,
  station_id INT NOT NULL,
  name VARCHAR(150) NOT NULL,
  slug VARCHAR(150) NOT NULL UNIQUE,
  bio TEXT,
  image VARCHAR(255),
  twitter_handle VARCHAR(255),
  FOREIGN KEY (station_id) REFERENCES stations(id) ON DELETE CASCADE
);

-- News / Talk / Sports articles
CREATE TABLE articles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  station_id INT NOT NULL,
  category ENUM('news','talk','sports') DEFAULT 'news',
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  excerpt TEXT,
  body LONGTEXT,
  image VARCHAR(255),
  author VARCHAR(150),
  published_at DATETIME,
  FOREIGN KEY (station_id) REFERENCES stations(id) ON DELETE CASCADE,
  INDEX (category),
  INDEX (published_at)
);

-- Podcasts (Listen Again)
CREATE TABLE podcasts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  station_id INT NOT NULL,
  show_id INT NULL,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  description TEXT,
  audio_url VARCHAR(255),
  published_at DATETIME,
  duration VARCHAR(50),
  image VARCHAR(255),
  FOREIGN KEY (station_id) REFERENCES stations(id) ON DELETE CASCADE,
  FOREIGN KEY (show_id) REFERENCES shows(id) ON DELETE SET NULL
);

-- Simple show schedule for "Now Playing"
CREATE TABLE schedule (
  id INT AUTO_INCREMENT PRIMARY KEY,
  station_id INT NOT NULL,
  show_id INT NOT NULL,
  day_of_week ENUM('sun','mon','tue','wed','thu','fri','sat') NOT NULL,
  start_time TIME NOT NULL,
  end_time TIME NOT NULL,
  FOREIGN KEY (station_id) REFERENCES stations(id) ON DELETE CASCADE,
  FOREIGN KEY (show_id) REFERENCES shows(id) ON DELETE CASCADE,
  INDEX (day_of_week, start_time)
);

-- Basic admin user
CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL
);
