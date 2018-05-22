<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\ClientRepository::class, \App\Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EmployerRepository::class, \App\Repositories\EmployerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DepartamentRepository::class, \App\Repositories\DepartamentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GamificationRepository::class, \App\Repositories\GamificationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PolicyRepository::class, \App\Repositories\PolicyRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InsuranceTypeRepository::class, \App\Repositories\InsuranceTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CoverageRepository::class, \App\Repositories\CoverageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AutoInsuranceRepository::class, \App\Repositories\AutoInsuranceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ResidentialInsuranceRepository::class, \App\Repositories\ResidentialInsuranceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EOInsuranceRepository::class, \App\Repositories\EOInsuranceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\IndividualLifeInsuranceRepository::class, \App\Repositories\IndividualLifeInsuranceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LeaseBoundInsuranceRepository::class, \App\Repositories\LeaseBoundInsuranceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\NotificationRepository::class, \App\Repositories\NotificationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AlertRepository::class, \App\Repositories\AlertRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SmsRepository::class, \App\Repositories\SmsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MailerRepository::class, \App\Repositories\MailerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InsurerRepository::class, \App\Repositories\InsurerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BrokerRepository::class, \App\Repositories\BrokerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FiendRepository::class, \App\Repositories\FiendRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ResidentialCoverageRepository::class, \App\Repositories\ResidentialCoverageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EOCoverageRepository::class, \App\Repositories\EOCoverageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LifeCoverageRepository::class, \App\Repositories\LifeCoverageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LeaseBoundCoverageRepository::class, \App\Repositories\LeaseBoundCoverageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TemplatingRepository::class, \App\Repositories\TemplatingRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MessageRepository::class, \App\Repositories\MessageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MessageReplyRepository::class, \App\Repositories\MessageReplyRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DefaultsTemplatingRepository::class, \App\Repositories\DefaultsTemplatingRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ConversationRepository::class, \App\Repositories\ConversationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ChatsRepository::class, \App\Repositories\ChatsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PushNotificationRepository::class, \App\Repositories\PushNotificationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MailerTemplateRepository::class, \App\Repositories\MailerTemplateRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MailerListRepository::class, \App\Repositories\MailerListRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SMSTemplateRepository::class, \App\Repositories\SMSTemplateRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SMSListRepository::class, \App\Repositories\SMSListRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MailerListParticipantRepository::class, \App\Repositories\MailerListParticipantRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MetaRepository::class, \App\Repositories\MetaRepositoryEloquent::class);
        //:end-bindings:
    }
}
