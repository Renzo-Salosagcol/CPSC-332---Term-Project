-- create
CREATE TABLE PROFESSORS (
  SSN VARCHAR(11) PRIMARY KEY,
  ProfessorName VARCHAR(255),
  ProfessorAddress VARCHAR(20),
  City VARCHAR(20),
  Zipcode CHAR(5),
  Telephone VARCHAR(10),
  Sex VARCHAR(2),
  Title VARCHAR(255),
  Salary INTEGER,
  CollegeDegree VARCHAR(255)
);

CREATE TABLE DEPARTMENTS (
  DepartmentNumber INT PRIMARY KEY,
  DepartmentName VARCHAR(255),
  Telephone VARCHAR(10),
  OfficeLocation VARCHAR(255),
  ChairpersonSSN VARCHAR(11),
  FOREIGN KEY (ChairpersonSSN) REFERENCES PROFESSORS(SSN)
);

CREATE TABLE COURSES (
    CourseNumber INT PRIMARY KEY,
    Title VARCHAR(100),
    Textbook VARCHAR(255),
    Units INT,
    DepartmentNumber INT,
    FOREIGN KEY (DepartmentNumber) REFERENCES DEPARTMENTS(DepartmentNumber)
);

CREATE TABLE SECTIONS (
    SectionNumber INT UNIQUE,
    Classroom VARCHAR(100),
    Seats INT,
    MeetingDays VARCHAR(20),
    StartTime TIME,
    EndTime TIME,
    ProfessorSSN VARCHAR(11),
    CourseNumber INT,
    PRIMARY KEY (SectionNumber, CourseNumber),
    FOREIGN KEY (CourseNumber) REFERENCES COURSES(CourseNumber),
    FOREIGN KEY (ProfessorSSN) REFERENCES PROFESSORS(SSN)
);

CREATE TABLE STUDENT (
  CWID INT PRIMARY KEY ,
  StudentName VARCHAR(255), 
  StudentAddress VARCHAR(255),
  StudentTelephone VARCHAR(20),
  MajorDepartment INT,
  MinorDepartment INT,
  FOREIGN KEY (MajorDepartment) REFERENCES DEPARTMENTS(DepartmentNumber),
  FOREIGN KEY (MinorDepartment) REFERENCES DEPARTMENTS(DepartmentNumber)
);

CREATE TABLE ENROLLMENT_RECORDS (
  CWID INT,
  SectionNumber INT,
  CourseNumber INT,
  Grade INT,
  PRIMARY KEY (CWID, SectionNumber, CourseNumber),
  FOREIGN KEY (CWID) REFERENCES STUDENT(CWID),
  FOREIGN KEY (SectionNumber) REFERENCES SECTIONS(SectionNumber),
  FOREIGN KEY (CourseNumber) REFERENCES COURSES(CourseNumber)
);

--below are queries for testing
-- insert 3 professors
INSERT INTO PROFESSORS (SSN, ProfessorName, ProfessorAddress, City, Zipcode, Telephone, Sex, Title, Salary, CollegeDegree) 
VALUES
('123-45-6789', 'Dr. James Smith', '123 Main St', 'Anytown', '12345', '555-1234', 'M', 'Professor', 120000, 'Ph.D. Computer Science'),
('987-65-4321', 'Dr. Jennifer Johnson', '456 Elm St', 'Othertown', '54321', '555-5678', 'F', 'Associate Professor', 80000, 'Ph.D. Physics'),
('246-81-3579', 'Dr. Michael Williams', '789 Oak St', 'Somewhere', '67890', '555-9012', 'M', 'Assistant Professor', 70000, 'Ph.D. Biology');

--insert 2 departments
INSERT INTO DEPARTMENTS (DepartmentNumber, DepartmentName, Telephone, OfficeLocation, ChairpersonSSN) 
VALUES
(101, 'Computer Science Department', '101', 'Smith Hall, Room 101', '123-45-6789'),
(102, 'Physics Department', '102', 'Johnson Building, Room 202', '987-65-4321');

-- insert 8 students
INSERT INTO STUDENT (CWID, StudentName, StudentAddress, StudentTelephone, MajorDepartment, MinorDepartment) 
VALUES
(0001, 'John Doe', '123 Fake St, Faketown, USA', '555-1234', 101, 102),
(0002, 'Jane Smith', '456 Mock Ave, Mockville, USA', '555-5678', 101, 102),
(0003, 'Alice Johnson', '789 Pretend Rd, Fantasyland, USA', '555-9012', 101, NULL),
(0004, 'Bob Brown', '321 Imaginary Blvd, Dreamland, USA', '555-3456', 102, 101),
(0005, 'Emily Davis', '654 Fictitious Ln, Makebelieve City, USA', '555-7890', 102, NULL),
(0006, 'Michael Wilson', '987 Unreal Ave, Wonderland, USA', '555-2345', 102, 101),
(0007, 'Sarah Taylor', '246 Illusion St, Neverland, USA', '555-6789', 101, NULL),
(0008, 'David Martinez', '135 Mirage Rd, Enchanted Forest, USA', '555-0123', 102, NULL);

--insert 4 courses
INSERT INTO COURSES (CourseNumber, Title, Textbook, Units, DepartmentNumber) 
VALUES
(101, 'Introduction to Computer Science', 'Computer Science: An Overview', 3, 101),
(102, 'Data Structures and Algorithms', 'Introduction to Algorithms', 4, 101),
(103, 'Introduction to Physics', 'Physics for Beginners', 3, 102),
(104, 'Quantum Mechanics', 'Principles of Quantum Mechanics', 4, 102);

--insert 6 sections
INSERT INTO SECTIONS (SectionNumber, Classroom, Seats, MeetingDays, StartTime, EndTime, ProfessorSSN, CourseNumber) 
VALUES
(1, 'Room 501', 30, 'MWF', '08:00:00', '09:00:00', '123-45-6789', 101),
(2, 'Room 502', 25, 'TTH', '10:00:00', '11:30:00', '123-45-6789', 102),
(3, 'Room 503', 35, 'MW', '13:00:00', '14:30:00', '987-65-4321', 103),
(4, 'Room 504', 40, 'MWF', '11:00:00', '12:00:00', '987-65-4321', 104),
(5, 'Room 505', 20, 'TTH', '14:00:00', '15:30:00', '123-45-6789', 101),
(6, 'Room 506', 30, 'MW', '15:00:00', '16:30:00', '987-65-4321', 103);

--insert 20 enrollment records
INSERT INTO ENROLLMENT_RECORDS (CWID, SectionNumber, CourseNumber, Grade) 
VALUES
(0001, 1, 101, 85),
(0002, 2, 102, 78),
(0003, 2, 103, 92),
(0004, 3, 104, 80),
(0005, 4, 104, 75),
(0006, 5, 103, 88),
(0007, 6, 102, 90),
(0008, 3, 101, 83),
(0001, 5, 102, 87),
(0002, 6, 104, 79),
(0003, 3, 101, 95),
(0004, 5, 102, 82),
(0005, 1, 103, 74),
(0006, 4, 102, 91),
(0007, 1, 101, 88),
(0008, 3, 104, 82),
(0001, 3, 101, 90),
(0002, 6, 103, 76),
(0003, 3, 102, 94),
(0002, 3, 104, 85);

-- fetching 

--Given the social security number of a professor, list the titles, classrooms, meeting days and time of his/her classes.
/*SELECT Courses.Title AS Course_Title, Sections.Classroom, Sections.MeetingDays, Sections.StartTime, Sections.EndTime
--FROM Sections
--JOIN Courses ON Sections.CourseNumber = Courses.CourseNumber
--WHERE Sections.ProfessorSSN = '123-45-6789'; --insert whatever ProfessorSSN you want here
*/

--Given a course number and a section number, count how many students get each distinct grade, i.e. ‘A’, ‘A-’, ‘B+’, ‘B’, ‘B-’, etc.
/*SELECT 
    CASE 
        WHEN GRADE >= 90 THEN 'A'
        WHEN GRADE >= 85 THEN 'A-'
        WHEN GRADE >= 80 THEN 'B+'
        WHEN GRADE >= 75 THEN 'B'
        WHEN GRADE >= 70 THEN 'B-'
        WHEN GRADE >= 65 THEN 'C+'
        WHEN GRADE >= 60 THEN 'C'
        WHEN GRADE >= 55 THEN 'C-'
        WHEN GRADE >= 50 THEN 'D'
        ELSE 'F'
    END AS Letter_Grade,
    COUNT(*) AS Grade_Count
FROM ENROLLMENT_RECORDS ER
JOIN STUDENT S ON ER.CWID = S.CWID
WHERE ER.SectionNumber = 1 AND ER.CourseNumber = 101  -- Replace SectionNumber and CourseNumber with whatever class you'd like. There's not a lot of students in these classes. 
GROUP BY Letter_Grade;
*/

--Given a course number list the sections of the course, including the classrooms, the meeting days and time, and the number of students enrolled in each section.
/*
SELECT 
    Sections.SectionNumber,
    Sections.Classroom,
    Sections.MeetingDays,
    Sections.StartTime,
    Sections.EndTime,
    COUNT(ER.CWID) AS Students_Enrolled
FROM Sections
JOIN Courses ON Sections.CourseNumber = Courses.CourseNumber
LEFT JOIN ENROLLMENT_RECORDS ER ON Sections.SectionNumber = ER.SectionNumber AND Sections.CourseNumber = ER.CourseNumber
WHERE Courses.CourseNumber = 101 --insert your CourseNum here  
GROUP BY Sections.SectionNumber, Sections.Classroom, Sections.MeetingDays, Sections.StartTime, Sections.EndTime;
*/

--Given the campus wide ID of a student, list all courses the student took and the grades.
/*
SELECT 
    Courses.CourseNumber,
    Courses.Title,
    ENROLLMENT_RECORDS.GRADE
FROM ENROLLMENT_RECORDS
JOIN Courses ON ENROLLMENT_RECORDS.CourseNumber = Courses.CourseNumber
WHERE ENROLLMENT_RECORDS.CWID = 0002; --insert student CWID here 
*/
