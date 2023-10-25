CREATE TABLE students (
    student_id INT PRIMARY KEY,
    class_id INT,
    name VARCHAR(50),
    surname VARCHAR(50),
    FOREIGN KEY (class_id) REFERENCES classes(class_id)
);
