<?php
require_once 'core/dbconfig.php';
require_once 'core/models.php';

$searchQuery = '';
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];
    $applicants = searchApplicants($pdo, $searchQuery);
} else {
    $applicants = getAllApplicants($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Job Applicants</h1>

        <form method="POST" class="form-inline mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search applicants" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit" class="btn btn-primary ml-2">Search</button>
        </form>

        <a href="insert.php" class="btn btn-success mb-3">Add New Applicant</a>

        <a href="index.php" class="btn btn-secondary mb-3">Refresh Table</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Years of Experience</th>
                    <th>Skills</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($applicants): ?>
                    <?php foreach ($applicants as $applicant): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($applicant['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($applicant['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($applicant['email']); ?></td>
                            <td><?php echo htmlspecialchars($applicant['years_of_experience']); ?></td>
                            <td><?php echo htmlspecialchars($applicant['skills']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $applicant['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?php echo $applicant['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No applicants found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
