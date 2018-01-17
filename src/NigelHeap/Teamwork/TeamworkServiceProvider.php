<?php namespace NigelHeap\Teamwork;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\ServiceProvider;

class TeamworkServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('nigelheap.teamwork', function($app)
        {
            $client = new \NigelHeap\Teamwork\Client(new Guzzle,
                $app['config']->get('services.teamwork.key'),
                $app['config']->get('services.teamwork.url')
            );

            return new \NigelHeap\Teamwork\Factory($client);
        });

        $this->app->bind('NigelHeap\Teamwork\Factory', 'nigelheap.teamwork');
    }

}