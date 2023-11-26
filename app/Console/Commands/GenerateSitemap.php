<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

use App\Models\Tool;
use App\Models\Category;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // modify this to your own needs
        $sitemap = SitemapGenerator::create(config('app.url'))->getSitemap();

        // adding tools
        $query = Tool::published();
        foreach ($query->lazy() as $tool) {
             $sitemap->add(Url::create(route('tools.show', $tool->slug))
                ->setLastModificationDate($tool->updated_at)
                ->setPriority(0.7)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
        }

        // categories
        $categories = Category::all();
        foreach ($categories as $category) {
            $sitemap->add(Url::create(route('categories.show', $category->slug))
            ->setLastModificationDate(now())
            ->setPriority(0.6)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
        }


        // generate your sitemap
        $sitemap->writeToFile(public_path('sitemap.xml'));

    }
}
