CREATE TABLE classes (
    class_id INT PRIMARY KEY,
    class_name VARCHAR(50),
    student_id INT,
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);
