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
        //:end-bindings:
    }
}
