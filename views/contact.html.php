<h1>Contact</h1>
<form action="/contact" method="post" class="form-group">
    <?php if (flash('error')): ?>
        <div class="alert alert-danger"><?= html(flash('error')) ?></div>
    <?php endif; ?>

    <?php if (flash('success')): ?>
        <div class="alert alert-success"><?= html(flash('success')) ?></div>
    <?php endif; ?>

    <div class="form-group">
        <label for="email">Your email address</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" />
        <?php if (flash('error-email')): ?>
            <br /><div class="alert alert-danger"><?= html(flash('error-email')) ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="message">Your message</label>
        <textarea class="form-control" id="message" name="message" rows="6"><?= $message ?></textarea>
        <?php if (flash('error-message')): ?>
            <br /><div class="alert alert-danger"><?= html(flash('error-message')) ?></div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Send</button>
</form>
