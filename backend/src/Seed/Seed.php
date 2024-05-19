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
    google_id TEXT,
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
$insertUser1 = "INSERT INTO User (id, email, roleId, name, surname, birthDate, country, state, city, address, sex, CNP) VALUES(1, 'ionut.blidaru02@e-uvt.ro', 3, 'Ionut', 'Blidaru', '1990-01-01T00:00:00+01:00', 'Romania', 'Timis', 'Timisoara', 'Oak Street 432', 0, '202035675542')";
$insertUser2 = "INSERT INTO User (id, email, roleId, name, surname, birthDate, country, state, city, address, sex, CNP) VALUES(2, 'cristian.gusatu02@e-uvt.ro', 3, 'Cristian', 'Gusatu', '1990-01-01T00:00:00+01:00', 'Romania', 'Timis', 'Timisoara', 'Daliei 2', 0, '074242422222')";
$insertUser3 = "INSERT INTO User (id, email, roleId, name, surname, birthDate, country, state, city, address, sex, CNP) VALUES(3, 'user3@example.com', 1, 'User', 'Three', '1990-01-01T00:00:00+01:00', 'Country', 'State', 'City', 'Street 123', 0, '1234567890123')";
$insertUser5 = "INSERT INTO User (id, email, roleId, name, surname, birthDate, country, state, city, address, sex, CNP) VALUES(4, 'bbub2242@gmail.com', 2, 'User', 'Five', '1990-01-01T00:00:00+01:00', 'Country', 'State', 'City', 'Street 123', 0, '1234567890125')";
$insertUser4 = "INSERT INTO User (id, email, roleId, name, surname, birthDate, country, state, city, address, sex, CNP) VALUES(5, 'user4@example.com', 2, 'User', 'Four', '1990-01-01T00:00:00+01:00', 'Country', 'State', 'City', 'Street 123', 0, '1234567890124')";

$db->exec($insertUser1);
$db->exec($insertUser2);
$db->exec($insertUser3);
$db->exec($insertUser4);
$db->exec($insertUser5);

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
$insertDiscipline4 = "INSERT INTO Discipline (name, idDiscipline, credits) VALUES ('Software Engineering', 4, 5)";
$insertDiscipline5 = "INSERT INTO Discipline (name, idDiscipline, credits) VALUES ('Computer Networks', 5, 4)";



$db->exec($insertDiscipline1);
$db->exec($insertDiscipline2);
$db->exec($insertDiscipline3);
$db->exec($insertDiscipline4);
$db->exec($insertDiscipline5);


// Inserting exam entries
$insertExam1 = "INSERT INTO Exam (idDiscipline, examDate) VALUES (1, '2024-02-10')";
$insertExam2 = "INSERT INTO Exam (idDiscipline, examDate) VALUES (2, '2024-02-15')";
$insertExam3 = "INSERT INTO Exam (idDiscipline, examDate) VALUES (3, '2024-02-20')";
$insertExam4 = "INSERT INTO Exam (idDiscipline, examDate) VALUES (4, '2024-02-25')";
$insertExam5 = "INSERT INTO Exam (idDiscipline, examDate) VALUES (5, '2024-02-30')";


$db->exec($insertExam1);
$db->exec($insertExam2);
$db->exec($insertExam3);
$db->exec($insertExam4);
$db->exec($insertExam5);

// Inserting grade entries
$insertGrade11 = "INSERT INTO Grade (idUser, idExam, value) VALUES (1, 1, 7)";
$insertGrade12 = "INSERT INTO Grade (idUser, idExam, value) VALUES (2, 1, 6)";
$insertGrade21 = "INSERT INTO Grade (idUser, idExam, value) VALUES (1, 2, 5)";
$insertGrade22 = "INSERT INTO Grade (idUser, idExam, value) VALUES (2, 2, 6)";
$insertGrade31 = "INSERT INTO Grade (idUser, idExam, value) VALUES (1, 3, 7)";
$insertGrade32 = "INSERT INTO Grade (idUser, idExam, value) VALUES (2, 3, 8)";
$insertGrade41 = "INSERT INTO Grade (idUser, idExam, value) VALUES (1, 4, 9)";
$insertGrade42 = "INSERT INTO Grade (idUser, idExam, value) VALUES (2, 4, 10)";
$insertGrade51 = "INSERT INTO Grade (idUser, idExam, value) VALUES (1, 5, 7)";
$insertGrade52 = "INSERT INTO Grade (idUser, idExam, value) VALUES (2, 5, 8)";
$db->exec($insertGrade11);
$db->exec($insertGrade12);
$db->exec($insertGrade21);
$db->exec($insertGrade22);
$db->exec($insertGrade31);
$db->exec($insertGrade32);
$db->exec($insertGrade41);
$db->exec($insertGrade42);
$db->exec($insertGrade51);
$db->exec($insertGrade52);

// Inserting user-discipline relationships
$insertUserDiscipline1 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (1, 1)";
$insertUserDiscipline2 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (2, 1)";
$insertUserDiscipline3 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (1, 2)";
$insertUserDiscipline4 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (2, 2)";
$insertUserDiscipline5 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (1, 3)";
$insertUserDiscipline6 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (2, 3)";
$insertUserDiscipline7 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (1, 4)";
$insertUserDiscipline8 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (2, 4)";

$insertUserDiscipline9 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (4, 1)";
$insertUserDiscipline10 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (4, 2)";
$insertUserDiscipline11 = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (4, 5)";


$db->exec($insertUserDiscipline1);
$db->exec($insertUserDiscipline2);
$db->exec($insertUserDiscipline3);
$db->exec($insertUserDiscipline4);
$db->exec($insertUserDiscipline5);
$db->exec($insertUserDiscipline6);
$db->exec($insertUserDiscipline7);
$db->exec($insertUserDiscipline8);

$db->exec($insertUserDiscipline8);
$db->exec($insertUserDiscipline9);
$db->exec($insertUserDiscipline10);
$db->exec($insertUserDiscipline11);



?>