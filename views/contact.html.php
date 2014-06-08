<h1>Contact</h1>
<form action="/contact" method="post">
    <? if (flash('error')) ?>
        <p><?= html(flash('error')) ?></p>
    <? endif; ?>
    <? if (flash('success')) ?>
        <p><?= html(flash('success')) ?></p>
    <? endif; ?>
    <p>
        <label for="email">Your email address</label><br />
        <input type="text" id="email" name="email" />
    </p>
    <? if (flash('error-email')) ?>
        <p><?= html(flash('error-email')) ?></p>
    <? endif; ?>
    <p>
        <label for="message">Your message</label><br />
        <textarea id="message" name="message"></textarea>
    </p>
    <? if (flash('error-message')) ?>
        <p><?= html(flash('error-message')) ?></p>
    <? endif; ?>
    <p>
        <input type="submit" value="Send" />
    </p>
</form>
