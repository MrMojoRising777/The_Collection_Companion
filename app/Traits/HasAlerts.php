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

        // Tailwind-based custom classes — one set per alert type
        $typeClasses = match ($type) {
            'success' => [
                'popup' => 'swal-toast !bg-green-50 !border !border-green-400 !rounded-xl !shadow-none',
                'title' => '!text-green-800 !font-medium !text-sm',
                'timerProgressBar' => '!bg-green-400/40',
            ],
            'error' => [
                'popup' => 'swal-toast !bg-red-50 !border !border-red-400 !rounded-xl !shadow-none',
                'title' => '!text-red-800 !font-medium !text-sm',
                'timerProgressBar' => '!bg-red-400/40',
            ],
            'warning'  => [
                'popup' => 'swal-toast !bg-amber-50 !border !border-amber-400 !rounded-xl !shadow-none',
                'title' => '!text-amber-800 !font-medium !text-sm',
                'timerProgressBar' => '!bg-amber-400/40',
            ],
            'question' => [
                'popup' => 'swal-toast !bg-purple-50 !border !border-purple-400 !rounded-xl !shadow-none',
                'title' => '!text-purple-800 !font-medium !text-sm',
                'timerProgressBar' => '!bg-purple-400/40',
            ],
            default    => [
                'popup' => 'swal-toast !bg-blue-50 !border !border-blue-400 !rounded-xl !shadow-none',
                'title' => '!text-blue-800 !font-medium !text-sm',
                'timerProgressBar' => '!bg-blue-400/40',
            ],
        };

        // Allow callers to override or extend customClass entries
        $customClass = array_merge($typeClasses, $options['customClass'] ?? []);
        $alert->customClass($customClass);

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
