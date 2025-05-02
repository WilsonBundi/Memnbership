<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Contribution Results</h2>
    
    <?php if (empty($_SESSION['contributions'])): ?>
        <div class="alert alert-warning">No contributions calculated</div>
    <?php else: ?>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Member</th>
                    <th>Base Amount</th>
                    <th>Discount</th>
                    <th>Final Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($_SESSION['contributions'] as $contribution): ?>
                <tr>
                    <td><?= htmlspecialchars($contribution['member_name']) ?></td>
                    <td>€<?= number_format($contribution['base_amount'], 2) ?></td>
                    <td><?= $contribution['discount'] ?>%</td>
                    <td>€<?= number_format($contribution['final_amount'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <a href="/Membership/public/contributions/calculate" class="btn btn-primary">
        Recalculate
    </a>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>