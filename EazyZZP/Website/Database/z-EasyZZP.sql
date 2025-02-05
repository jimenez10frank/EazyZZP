CREATE DATABASE eazyzzp; 

USE eazyzzp;

-- Table structure for table 'Account/Users'-- Table structure for table 'Account/Users'
CREATE TABLE `account` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `surname` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phonenumber` VARCHAR(20) NOT NULL,
  `password` VARCHAR(255) NOT NULL
);

-- Table structure for table `Projects`
CREATE TABLE `project` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `account_id` INT NOT NULL,
  `projectname` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `startdate` DATE NOT NULL,
  `enddate` DATE NOT NULL,
  `status` VARCHAR(255) NULL,
  `total_cost` FLOAT NOT NULL,
  FOREIGN KEY (account_id) REFERENCES account(id)
);

SELECT * FROM project WHERE account = :account_id, ['id'=> 10] 


-- Table structure for table `task`
CREATE TABLE `task` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `project_id` INT NOT NULL,
  `task_name` VARCHAR(255) NOT NULL,
  `rate_per_hour` float NOT NULL,
  `description` text NOT NULL,
  `status` varchar(25) NOT NULL,
  FOREIGN KEY (project_id) REFERENCES project(id)
);




--  Random user(concept) voor de presentatie
INSERT INTO project (account_id, projectname, description, startdate, enddate, status, total_cost) 
VALUES (1, 'Website Development', 'This project focuses on developing a modern, robust e-commerce platform aimed at providing an exceptional and seamless shopping experience for users. The platform will be built with a user-centric design,
 ensuring that customers can navigate easily and enjoy an intuitive interface. Advanced features will include secure payment gateways to ensure safe transactions,
  mobile responsiveness to allow users to shop on any device, and a visually appealing design that is optimized for engagement. Additionally
   the platform will be scalable, allowing for future growth and the addition of new features as the business evolves.
    The primary goal is to create an e-commerce platform that not only attracts new customers but also fosters loyalty
     through a streamlined and enjoyable shopping journey.', '2025-01-10', '2025-06-15', 'In Progress', 15000.00);
INSERT INTO project (account_id, projectname, description, startdate, enddate, status, total_cost) 
VALUES (1, 'Mobile App Development', 'This project involves the development of a cross-platform mobile application designed to provide users with a personalized fitness tracking experience. The app will feature real-time activity monitoring, workout suggestions, progress reports, and integration with wearable devices. The app will focus on user engagement by offering personalized plans, challenges, and community features. The design will prioritize ease of use, with a sleek and intuitive interface. The app will also include social sharing capabilities, allowing users to track and share their fitness journey with friends. The primary goal is to motivate users to lead healthier lives through a user-friendly and engaging mobile platform.', '2025-02-01', '2025-08-30', 'Planning', 12000.00);



INSERT INTO task (project_id, task_name, rate_per_hour, description, status) 
VALUES 
(1, 'Frontend Design', 50.0, 'Designing the user interface and experience.', 'Pending'),
(1, 'Backend API Development', 60.0, 'Creating RESTful APIs for the platform.', 'In Progress'),
(1, 'Testing', 40.0, 'Performing QA and usability testing.', 'Not Started');
SELECT * FROM account;
SELECT * FROM project;