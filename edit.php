<?php
require_once 'core/models.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM applicants WHERE id = ?");
    $stmt->execute([$id]);
    $applicant = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $subjects = $_POST['subjects'];
    $experience = $_POST['years_of_experience'];
    $education = $_POST['education'];
    $skills = $_POST['skills'];

    $response = updateApplicant($pdo, $id, $firstName, $lastName, $email, $subjects, $experience, $education, $skills);
    $message = $response['message'];
    $statusCode = $response['statusCode'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Applicant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Edit Applicant</h1>
        
        <?php if (isset($message)): ?>
            <div class="alert alert-<?= $statusCode == 200 ? 'success' : 'danger' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?= $applicant['first_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?= $applicant['last_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= $applicant['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="subjects" class="form-label">Subjects</label>
                <input type="text" name="subjects" class="form-control" value="<?= $applicant['subjects']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="years_of_experience" class="form-label">Years of Experience</label>
                <input type="number" name="years_of_experience" class="form-control" value="<?= $applicant['years_of_experience']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="education" class="form-label">Education</label>
                <input type="text" name="education" class="form-control" value="<?= $applicant['education']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="skills" class="form-label">Skills</label>
                <input type="text" name="skills" class="form-control" value="<?= $applicant['skills']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <a href="index.php" class="btn btn-secondary mt-3">Back to Home</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>