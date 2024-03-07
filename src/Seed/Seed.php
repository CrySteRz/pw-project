<?php

$host = "localhost";
$path = "sqlite:../../db/database.db";
$db = new PDO($path);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


// Drop tables
$dropDisciplineTable = "DROP TABLE IF EXISTS Discipline";
$dropDisciplineTypeTable = "DROP TABLE IF EXISTS DisciplineType";
$dropExamTable = "DROP TABLE IF EXISTS Exam";
$dropRoleTable = "DROP TABLE IF EXISTS Role";
$dropUserTable = "DROP TABLE IF EXISTS User";
$dropGradeTable = "DROP TABLE IF EXISTS Grade";
$dropUsersHasDisciplinesTable = "DROP TABLE IF EXISTS users_has_disciplines";
$db->exec($dropDisciplineTable);
$db->exec($dropDisciplineTypeTable);
$db->exec($dropExamTable);
$db->exec($dropRoleTable);
$db->exec($dropUserTable);
$db->exec($dropGradeTable);
$db->exec($dropUsersHasDisciplinesTable);

// Create tables
$createDisciplineTypeTable = "CREATE TABLE IF NOT EXISTS DisciplineType (
                                id INTEGER PRIMARY KEY AUTOINCREMENT,
                                type TEXT
                              )";

$createDisciplineTable = "CREATE TABLE IF NOT EXISTS Discipline (
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            name TEXT,
                            idDiscipline INTEGER,
                            credits INTEGER,
                            FOREIGN KEY (idDiscipline) REFERENCES DisciplineType(id)
                          )";

$createRoleTable = "CREATE TABLE IF NOT EXISTS Role (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    type TEXT
)";

$createUserTable = "CREATE TABLE IF NOT EXISTS User (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT,
    roleId INTEGER,
    name TEXT,
    surname TEXT,
    birthDate DATE,
    country TEXT,
    state TEXT,
    city TEXT,
    address TEXT,
    sex INTEGER,
    CNP TEXT,
    FOREIGN KEY (roleId) REFERENCES Role(id)
)";

$createUsersHasDisciplinesTable = "CREATE TABLE IF NOT EXISTS users_has_disciplines (
    id_user INTEGER,
    id_discipline INTEGER,
    FOREIGN KEY (id_user) REFERENCES User(id),
    FOREIGN KEY (id_discipline) REFERENCES Discipline(id)
  )";


$createExamTable = "CREATE TABLE IF NOT EXISTS Exam (
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        idDiscipline INTEGER,
                        examDate DATE,
                        FOREIGN KEY (idDiscipline) REFERENCES Discipline(id)
                    )";



$createGradeTable = "CREATE TABLE IF NOT EXISTS Grade (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idExam INTEGER,
    idUser INTEGER,
    value INTEGER,
    FOREIGN KEY (idExam) REFERENCES Exam(id),
    FOREIGN KEY (idUser) REFERENCES User(id)
)";



$db->exec($createDisciplineTypeTable);
$db->exec($createDisciplineTable);
$db->exec($createRoleTable);
$db->exec($createUserTable);
$db->exec($createUsersHasDisciplinesTable);
$db->exec($createExamTable);
$db->exec($createGradeTable);


# insert roles
$insertRoleAdmin = "INSERT INTO Role (type) VALUES ('Admin')";
$insertRoleTeacher = "INSERT INTO Role (type) VALUES ('Teacher')";
$insertRoleStudent = "INSERT INTO Role (type) VALUES ('Student')";

$db->exec($insertRoleAdmin);
$db->exec($insertRoleTeacher);
$db->exec($insertRoleStudent);


// Inserting users with different roles
$insertUser1 = "INSERT INTO User (email, roleId, name, surname, birthDate, country, state, city, address, sex, CNP) VALUES ('user1@example.com', 1, 'John', 'Doe', '1990-01-01', 'USA', 'California', 'Los Angeles', '123 Main St', 1, '1234567890123')";
$insertUser2 = "INSERT INTO User (email, roleId, name, surname, birthDate, country, state, city, address, sex, CNP) VALUES ('user2@example.com', 2, 'Jane', 'Smith', '1995-05-15', 'UK', 'England', 'London', '456 Oak St', 0, '9876543210987')";
$insertUser3 = "INSERT INTO User (email, roleId, name, surname, birthDate, country, state, city, address, sex, CNP) VALUES ('user3@example.com', 3, 'Alice', 'Johnson', '1988-09-20', 'Canada', 'Ontario', 'Toronto', '789 Elm St', 1, '4567890123456')";

$db->exec($insertUser1);
$db->exec($insertUser2);
$db->exec($insertUser3);

// Inserting discipline types
$insertDisciplineType1 = "INSERT INTO DisciplineType (type) VALUES ('Optionala')";
$insertDisciplineType2 = "INSERT INTO DisciplineType (type) VALUES ('Facultativa')";
$insertDisciplineType3 = "INSERT INTO DisciplineType (type) VALUES ('Obligatorie')";

$db->exec($insertDisciplineType1);
$db->exec($insertDisciplineType2);
$db->exec($insertDisciplineType3);

// Inserting computer science disciplines
$insertDiscipline1 = "INSERT INTO Discipline (name, idDiscipline, credits) VALUES ('Introduction to Computer Science', 1, 3)";
$insertDiscipline2 = "INSERT INTO Discipline (name, idDiscipline, credits) VALUES ('Data Structures and Algorithms', 2, 4)";
$insertDiscipline3 = "INSERT INTO Discipline (name, idDiscipline, credits) VALUES ('Database Management Systems', 3, 4)";

$db->exec($insertDiscipline1);
$db->exec($insertDiscipline2);
$db->exec($insertDiscipline3);


// Inserting exam entries
$insertExam1 = "INSERT INTO Exam (idDiscipline, examDate) VALUES (1, '2024-02-10')";
$insertExam2 = "INSERT INTO Exam (idDiscipline, examDate) VALUES (2, '2024-02-15')";
$insertExam3 = "INSERT INTO Exam (idDiscipline, examDate) VALUES (3, '2024-02-20')";

$db->exec($insertExam1);
$db->exec($insertExam2);
$db->exec($insertExam3);

// Inserting grade entries
$insertGrade1 = "INSERT INTO Grade (idUser, idExam, value) VALUES (1, 1, 7)";
$insertGrade2 = "INSERT INTO Grade (idUser, idExam, value) VALUES (2, 1, 6)";
$insertGrade3 = "INSERT INTO Grade (idUser, idExam, value) VALUES (3, 1, 8)";
$insertGrade4 = "INSERT INTO Grade (idUser, idExam, value) VALUES (1, 2, 9)";
$insertGrade5 = "INSERT INTO Grade (idUser, idExam, value) VALUES (2, 2, 8)";
$insertGrade6 = "INSERT INTO Grade (idUser, idExam, value) VALUES (3, 2, 7)";
$insertGrade7 = "INSERT INTO Grade (idUser, idExam, value) VALUES (1, 3, 6)";
$insertGrade8 = "INSERT INTO Grade (idUser, idExam, value) VALUES (2, 3, 7)";
$insertGrade9 = "INSERT INTO Grade (idUser, idExam, value) VALUES (3, 3, 8)";

$db->exec($insertGrade1);
$db->exec($insertGrade2);
$db->exec($insertGrade3);
$db->exec($insertGrade4);
$db->exec($insertGrade5);
$db->exec($insertGrade6);
$db->exec($insertGrade7);
$db->exec($insertGrade8);
$db->exec($insertGrade9);

// Inserting user-discipline relationships
$insertUserDiscipline1 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (1, 1)";
$insertUserDiscipline2 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (2, 1)";
$insertUserDiscipline3 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (3, 1)";
$insertUserDiscipline4 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (1, 2)";
$insertUserDiscipline5 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (2, 2)";
$insertUserDiscipline6 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (3, 2)";
$insertUserDiscipline7 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (1, 3)";
$insertUserDiscipline8 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (2, 3)";
$insertUserDiscipline9 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (3, 3)";

$db->exec($insertUserDiscipline1);
$db->exec($insertUserDiscipline2);
$db->exec($insertUserDiscipline3);
$db->exec($insertUserDiscipline4);
$db->exec($insertUserDiscipline5);
$db->exec($insertUserDiscipline6);
$db->exec($insertUserDiscipline7);
$db->exec($insertUserDiscipline8);
$db->exec($insertUserDiscipline9);



?>