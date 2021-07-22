<div class="message<?= (!empty($containerClass) ? " {$containerClass}" : '') ?>">
    <?php // var_dump($message) ?>

    <?php if (!empty($message->type) && (!empty($message->text) || !empty($message->before) || !empty($message->after))): ?>
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
</div>
