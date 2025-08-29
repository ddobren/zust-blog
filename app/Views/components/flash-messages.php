<?php if (!empty(ErrorHandlerSys::get())): ?>
    <div class="alert alert-danger">
        <?php foreach (ErrorHandlerSys::get() as $error): ?>
            <div><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty(ErrorHandlerSys::getSuccess())): ?>
    <div class="alert alert-success">
        <?php foreach (ErrorHandlerSys::getSuccess() as $msg): ?>
            <div><?= htmlspecialchars($msg) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php
ErrorHandlerSys::clear();
?>
