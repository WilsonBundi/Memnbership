<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Add New Family</h2>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="/Membership/public/families/store" method="POST">
        <div class="form-group">
            <label>Family Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Address:</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Family</button>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>