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
                            categoryId INTEGER,
                            credits INTEGER
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
?>