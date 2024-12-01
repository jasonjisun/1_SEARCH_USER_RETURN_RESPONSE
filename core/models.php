<?php
$host = 'localhost';
$dbname = 'job_application_system';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function createApplicant($pdo, $firstName, $lastName, $email, $subjects, $experience, $education, $skills) {
    try {
        $stmt = $pdo->prepare("INSERT INTO applicants (first_name, last_name, email, subjects, years_of_experience, education, skills) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $email, $subjects, $experience, $education, $skills]);
        
        return [
            'message' => 'Applicant added successfully!',
            'statusCode' => 200
        ];
    } catch (PDOException $e) {
        return [
            'message' => 'Failed to add applicant: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}

function getAllApplicants($pdo) {
    $stmt = $pdo->query("SELECT * FROM applicants");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchApplicants($pdo, $query) {
    $stmt = $pdo->prepare("SELECT * FROM applicants WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR subjects LIKE ? OR education LIKE ? OR skills LIKE ?");
    $stmt->execute(['%' . $query . '%', '%' . $query . '%', '%' . $query . '%', '%' . $query . '%', '%' . $query . '%', '%' . $query . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteApplicant($pdo, $id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM applicants WHERE id = ?");
        $stmt->execute([$id]);
        return [
            'message' => 'Applicant deleted successfully!',
            'statusCode' => 200
        ];
    } catch (PDOException $e) {
        return [
            'message' => 'Failed to delete applicant: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}

function updateApplicant($pdo, $id, $firstName, $lastName, $email, $subjects, $experience, $education, $skills) {
    try {
        $stmt = $pdo->prepare("UPDATE applicants SET first_name = ?, last_name = ?, email = ?, subjects = ?, years_of_experience = ?, education = ?, skills = ? WHERE id = ?");
        $stmt->execute([$firstName, $lastName, $email, $subjects, $experience, $education, $skills, $id]);
        
        return [
            'message' => 'Applicant updated successfully!',
            'statusCode' => 200
        ];
    } catch (PDOException $e) {
        return [
            'message' => 'Failed to update applicant: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}
?>
