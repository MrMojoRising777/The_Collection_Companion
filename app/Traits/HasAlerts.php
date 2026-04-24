<?php

declare(strict_types=1);

namespace App\Traits;

use Jantinnerezo\LivewireAlert\LivewireAlert;

trait HasAlerts
{
    /**
     * @param string[] $options
     */
    public function alert(
        string $message,
        string $type = 'success',
        array $options = [],
    ): void {
        $alert = new LivewireAlert($this);

        match ($type) {
            'success' => $alert->success(),
            'error' => $alert->error(),
            'warning' => $alert->warning(),
            'question' => $alert->question(),
            default => $alert->info(),
        };

        $alert->title($message);

        $toast = $options['toast'] ?? true;
        $timer = $options['timer'] ?? 3000;
        $position = $options['position'] ?? 'top-end';

        if ($toast) {
            $alert->toast();
        }

        $alert->timer($timer);
        $alert->position($position);

        if (isset($options['html'])) {
            $alert->html($options['html']);
        }

        if (isset($options['confirmButton'])) {
            $alert->withConfirmButton($options['confirmButton']);
        }

        if (isset($options['cancelButton'])) {
            $alert->withCancelButton($options['cancelButton']);
        }

        $alert->show();
    }
}
