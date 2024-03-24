DROP DATABASE IF EXISTS Degree_Audit_DB;

CREATE DATABASE Degree_Audit_DB;
Use Degree_Audit_DB;

/* The Students table will have to turn into a Users table where all
of the entites are the same except for the 'studentType'. 
The entity will be swapped with 'roles'. Roles values include
'admin', 'student', and 'faculty'. */


CREATE TABLE Students (
studentID INT,
fname VARCHAR(25),
lname VARCHAR(25),
telephone BIGINT, 
email VARCHAR (33),
studentType VARCHAR(25),
PRIMARY KEY (studentID));

CREATE TABLE Users (
userID INT,
userRole VARCHAR(25),
userPass VARCHAR(25),
FOREIGN KEY (userID) references Students(studentID) /* The refereneces will change after adding more users and user roles into DB */
);

CREATE TABLE Courses (
courseID INT,
courseSubject VARCHAR(4),
courseNUm INT,
title VARCHAR(50),
credits DECIMAL(2,1),
semesterAvail VARCHAR(10),
PRIMARY KEY (courseID));

#SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE Majors (
majorID INT,
majorName VARCHAR(25),
PRIMARY KEY (majorID));

CREATE TABLE Transcripts (
transcriptID INT,
studentID INT,
courseID INT,
grade CHAR(2),
yearTaken INT,
creditsEarned DECIMAL(2,1), 
currStatus VARCHAR(10), /* Selecions -'Done', "WIP", "Withdrawn", "Review" */
majorID INT,
PRIMARY KEY (transcriptID),
FOREIGN KEY (studentID) references Students(studentID),
FOREIGN KEY (courseID) references Courses(courseID),
FOREIGN KEY (majorID) references Majors(majorID));

CREATE TABLE Programs (
programID INT,
majorID INT,
degreeLevel VARCHAR(25),
requiredCredits INT,
degreeType VARCHAR(25),
PRIMARY KEY (programID),
FOREIGN KEY (majorID) references Majors(majorID));

CREATE TABLE Enrollments (
enrollmentID INT,
studentID INT,
programID INT,
semester VARCHAR(25),
yearEnrolled INT,
PRIMARY KEY (enrollmentID),
FOREIGN KEY (studentID) references Students(studentID),
FOREIGN KEY (programID) references Programs(programID));

CREATE TABLE Requirements ( /* this will be used for the future for responsive comparisons between student transcript and requirements needed for completion */
reqID INT,
programID INT, /* each programID will have multiple courses (from courseID) */
courseID INT,
PRIMARY KEY (reqID),
FOREIGN KEY (programID) references Programs(programID),
FOREIGN KEY (courseID) references Courses(courseID)
);


INSERT INTO Students (studentID, fname, lname, telephone, email, studentType) VALUES 
(1001, 'Jason', 'Scott', 1234567890, 'jscott@ncat.edu', 'Transfer'),
(1002, 'Kimberly', 'Hart', 2345678901, 'khart@ncat.edu', 'Continuing'),
(1003, 'Trini', 'Kwan', 4567890123, 'tkwan@ncat.edu', 'Alumni'),
(1004, 'Tommy', 'Oliver', 6789012345, 'toliver@ncat.edu', 'New');

INSERT INTO Users (userID, userRole, userPass) VALUES
(1001, 'Student', "jscott123"),
(1002, 'Student', "khart123"),
(1003, 'Student', "tkwan123"),
(1004, 'Student', "toliver123");

INSERT INTO Courses (courseID, courseSubject, courseNum, title, credits, semesterAvail) VALUES 
(3001, 'PE', 101, 'Intro to Physical Education', 3, 'Fall'),
(3002, 'MA', 110, 'Martial Arts Training', 3, 'Fall'),
(3003, 'PE', 201, 'Fitness and Conditioning', 3, 'Spring'),
(3004, 'LDR', 210, 'Leadership and Team Building', 3, 'Fall'),
(3005, 'MA', 220, 'Advanced Martial Arts Techniquest', 3, 'Fall'),
(3006, 'COM', 110, 'Introduction to Communcation', 3, 'Fall'),
(3007, 'PSY', 200, 'Psychology 101', 3, 'Fall'),
(3008, 'COM', 200, 'Interpersonal Communication', 3, 'Spring'),
(3009, 'COM', 320, 'Mass Media and Society', 3, 'Fall'),
(3010, 'PSY', 310, 'Social Psychology', 3, 'Fall'),
(3011, 'ENV', 101, 'Introduction to Environmental Science', 3, 'Fall'),
(3012, 'BIO', 220, 'Environmental Biology', 3, 'Spring'),
(3014, 'ENV', 230, 'Conservation Practices', 3, 'Spring'),
(3015, 'ENV', 310, 'Ecology and Sustainability', 3, 'Fall'),
(3016, 'ARC', 110, 'Introduction to Archaeology', 3, 'Fall'),
(3017, 'ARC', 210, 'Archaeological Fieldwork', 3, 'Fall'),
(3018, 'HIS', 320, 'Historical Analysis', 3, 'Fall'),
(3019, 'SSM', 350, 'Sports and Society', 3, 'Fall'),
(3020, 'PSY', 240, 'Sports Psychology', 3, 'Fall'),
(3021, 'IT', 101, 'Introduction to Information Technology', 3, 'Fall'),
(3022, 'IT', 201, 'Database Management Systems', 4, 'Spring'),
(3023, 'IT', 301, 'Web Development Fundamentals', 3, 'Fall'),
(3024, 'IT', 401, 'Network Administration', 4, 'Spring'),
(3025, 'IT', 501, 'Cybersecurity Basics', 3, 'Fall'),
(3026, 'IT', 601, 'Software Engineering Principles', 3, 'Spring')
;

INSERT INTO  Majors (majorID, majorName) VALUES 
(6000, 'Information Technology'),
(6001, 'Archeology'),
(6002, 'Communications'),
(6003, 'Psychology'),
(6004, 'Physical Education');

/* Level = Bachelor, Associates, PHD ::: Type = Science, Arts */
INSERT INTO Programs (programID, majorID, degreeLevel, requiredCredits, degreeType) VALUES 
(5000, 6000, 'Associates', 60, 'Science'),
(5001, 6000, 'Bachelors', 120, 'Science'),
(5002, 6000, 'Masters', 180, 'Science'),
(5003, 6000, 'PHD', 240, 'Science'),
(5004, 6001, 'Associates', 60, 'Arts'),
(5005, 6001, 'Bachelors', 120, 'Arts'),
(5006, 6001, 'Masters', 180, 'Arts'),
(5007, 6001, 'PHD', 240, 'Arts'),
(5008, 6002, 'Associates',  60, 'Arts'),
(5009, 6002, 'Bachelors', 120, 'Arts'),
(5010, 6002, 'Masters', 180, 'Arts'),
(5011, 6002, 'PHD',  240, 'Arts'),
(5012, 6003, 'Associates', 60, 'Arts'),
(5013, 6003, 'Bachelors',  120, 'Arts'),
(5014, 6003, 'Masters', 180, 'Arts'),
(5015, 6003, 'PHD',  240, 'Arts'),
(5016, 6004, 'Associates', 60, 'Science'),
(5017, 6004, 'Bachelors', 120, 'Science'),
(5018, 6004, 'Masters', 180, 'Science'),
(5019, 6004, 'PHD', 240, 'Science');

INSERT INTO Enrollments (enrollmentID, studentID, programID, semester, yearEnrolled) VALUES 
(4001, 1001, 5017, 'Fall', 2021),
(4002, 1002, 5013, 'Fall', 2020),
(4003, 1003, 5010, 'Spring', 2008),
(4004, 1004, 5005, 'Fall', 2023),
(4005, 1002, 5000, 'Fall', 2023);

INSERT INTO Transcripts (transcriptID, studentID, courseID, grade, yearTaken, creditsEarned, currStatus, majorID) VALUES /* add entries for majorID */
(2001, 1001, 3001, 'B+', 2021, 3, "Done", 6004),
(2002, 1001, 3002, 'A-', 2021, 3, "Done", 6004),
(2003, 1001, 3003, '', 2023, 3, "WIP", 6004),
(2004, 1001, 3004, '', 2023, 3, "WIP", 6004),
(2005, 1001, 3005, '', 2023, 3, "WIP", 6004),
(2006, 1001, 3020, '', 2024, 3, "Review", 6004),
(2007, 1002, 3006, 'A-', 2020, 3, "Done", 6003),
(2008, 1002, 3007, 'B+', 2021, 3, "Done", 6003),
(2009, 1002, 3008, 'A', 2022, 3, "Done", 6003),
(2010, 1002, 3009, '', 2023, 3, "WIP", 6003),
(2011, 1002, 3010, '', 2024, 3, "Review", 6003),
(2012, 1003, 3011, 'B+', 2006, 3, "Done", 6002),
(2013, 1003, 3002, 'A-', 2004, 3, "Done", 6002),
(2014, 1003, 3012, 'B-', 2007, 3, "Done", 6002),
(2015, 1003, 3014, 'B', 2008, 3, "Done", 6002),
(2016, 1003, 3005, 'A', 2004, 3, "Done", 6002),
(2017, 1004, 3016, '', 2023, 3, "WIP", 6001),
(2018, 1004, 3001, '', 2023, 3, "WIP", 6001),
(2019, 1004, 3017, '', 2023, 3, "WIP", 6001),
(2020, 1004, 3002, '', 2024, 3, "Review", 6001),
(2021, 1004, 3018, '', 2025, 3, "Review", 6001),
(2022, 1003, 3015, 'A', 2005, 3, "Done", 6002),
(2023, 1004, 3019, '', 2025, 3, "Review", 6001),
(2024, 1002, 3021, 'A+', 2019, 3, "Done", 6000),
(2025, 1002, 3022, 'B', 2019, 4, "Done", 6000), 
(2026, 1002, 3023, 'A-', 2020, 3, "Done", 6000),
(2027, 1002, 3024, 'C+', 2021, 4, "Done", 6000),
(2028, 1002, 3025, 'B', 2022, 3, "Done", 6000),
(2029, 1002, 3026, 'D-', 2023, 1, "Done", 6000);


# SET FOREIGN_KEY_CHECKS=1;
