<?php include '../layouts/header.php'; ?>

<h2>Add Family Member</h2>
<form method="POST" action="/members/store">
    <input type="hidden" name="family_id" value="<?= $_GET['family_id'] ?>">
    
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" required class="form-control">
    </div>

    <div class="form-group">
        <label>Date of Birth:</label>
        <input type="date" name="dob" required class="form-control">
    </div>

    <div class="form-group">
        <label>Member Type:</label>
        <select name="member_type" class="form-control">
            <?php foreach($memberTypes as $type): ?>
            <option value="<?= $type['id'] ?>"><?= $type['description'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Add Member</button>
</form>

<?php include '../layouts/footer.php'; ?>