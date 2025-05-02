<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/Membership/public">Membership Admin</a>
            <div class="navbar-nav">
                <?php if (isset($_SESSION['user_role'])): ?>
                    <?php if ($_SESSION['user_role'] === 'secretary'): ?>
                        <a class="nav-link" href="/Membership/public/families">Families</a>
                        <a class="nav-link" href="/Membership/public/members/create">Add Member</a>
                    <?php endif; ?>

                    <?php if ($_SESSION['user_role'] === 'treasurer'): ?>
                        <a class="nav-link" href="/Membership/public/contributions/calculate">Calculate Contributions</a>
                    <?php endif; ?>

                    <a class="nav-link" href="/Membership/public/logout">Logout</a>
                <?php else: ?>
                    <a class="nav-link" href="/Membership/public/login">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Page content goes here -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
