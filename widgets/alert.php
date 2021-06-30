<?php if (!empty($message->text) && !empty($message->type)): ?>
    <?php
        $alertType = [
            'success' => 'alert-success',
            'info'    => 'alert-primary',
            'warning' => 'alert-warning',
            'error'   => 'alert-danger'
        ];

        $message->type = (isset($alertType[$message->type]) ? $alertType[$message->type] : $alertType['info']);
        $message->before = (!empty($message->before) ? "<strong>{$message->before}</strong>": '');
        $message->after = (!empty($message->after) ? "<strong>{$message->after}</strong>": '');
    ?>

    <div class="alert <?= $message->type ?>" role="alert">
        <?= "{$message->before}{$message->text}{$message->after}" ?>
    </div>
<?php endif ?>
