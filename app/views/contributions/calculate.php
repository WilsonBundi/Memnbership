<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Calculate Contributions</h2>
    <form method="POST" action="/Membership/public/contributions/calculate">
        <div class="form-group">
            <label>Financial Year:</label>
            <select name="year_id" class="form-control" required>
                <?php foreach($years as $year): ?>
                <option value="<?= $year['id'] ?>"><?= $year['year'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Calculate</button>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>