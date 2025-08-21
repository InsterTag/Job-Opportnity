<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\JobApplication;

class StatusChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $application;
    public function __construct(JobApplication $application)
    {
        $this->application = $application;
    }
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Estado de tu postulación actualizado')
            ->greeting('Hola ' . $notifiable->name)
            ->line('El estado de tu postulación a la oferta "' . $this->application->jobOffer->title . '" ha sido actualizado a: ' . $this->application->status_label)
            ->action('Ver postulación', url('/job-applications/unemployed'))
            ->line('¡Gracias por usar Job Opportunity!');
    }
    public function toArray($notifiable)
    {
        return [
            'job_offer_title' => $this->application->jobOffer->title,
            'status' => $this->application->status,
            'status_label' => $this->application->status_label,
            'application_id' => $this->application->id,
        ];
    }
}
