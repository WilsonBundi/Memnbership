<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <h1>Families</h1>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <a href="/Membership/public/families/create" class="btn btn-success mb-3">Add New Family</a>

    <?php if (!empty($families)): ?>
        <table class="table">
            <!-- Table content remains same -->
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No families found</div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>