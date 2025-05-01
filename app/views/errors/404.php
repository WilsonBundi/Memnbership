<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-5">
    <div class="alert alert-danger">
        <h1>404 - Page Not Found</h1>
        <p>The requested URL <strong><?= $_SERVER['REQUEST_URI'] ?></strong> was not found</p>
        <a href="/Membership/public/" class="btn btn-primary">Return Home</a>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>