<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationBell extends Component
{
    public $notificationsCount;
    public $notifications;

    public function mount()
    {
        // Retrieve only unread notifications
        $this->notifications = auth()->user()->unreadNotifications;
        $this->notificationsCount = $this->notifications->count();
    }

    public function markNotificationsAsRead()
    {
        // Mark all unread notifications as read
        auth()->user()->unreadNotifications->markAsRead();
        $this->notificationsCount = 0; // Reset the count to 0
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
