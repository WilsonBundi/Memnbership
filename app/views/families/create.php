<?php include '/../app/views/layouts/header.php'; ?>

<div class="container">
    <h2>Add New Family</h2>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="/families/store" method="POST">
        <div class="form-group">
            <label>Family Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Address:</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Family</button>
    </form>
</div>

<?php include '/../app/views/layouts/footer.php'; ?>