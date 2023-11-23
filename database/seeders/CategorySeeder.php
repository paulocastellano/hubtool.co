<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'A/B Testing', 'slug' => 'ab-testing', 'icon' => '📊', 'is_featured' => false]);
        Category::create(['name' => 'Accounting', 'slug' => 'accounting', 'icon' => '📑', 'is_featured' => false]);
        Category::create(['name' => 'Advertising', 'slug' => 'advertising', 'icon' => '📢', 'is_featured' => false]);
        Category::create(['name' => 'Tracking', 'slug' => 'tracking', 'icon' => '💰', 'is_featured' => false]);
        Category::create(['name' => 'Analytics', 'slug' => 'analytics', 'icon' => '📊', 'is_featured' => false]);
        Category::create(['name' => 'Watch', 'slug' => 'watch', 'icon' => '⌚', 'is_featured' => false]);
        Category::create(['name' => 'Artificial Intelligence', 'slug' => 'artificial-intelligence', 'icon' => '🤖', 'is_featured' => false]);
        Category::create(['name' => 'Audio', 'slug' => 'audio', 'icon' => '🔊', 'is_featured' => false]);
        Category::create(['name' => 'Blogging', 'slug' => 'blogging', 'icon' => '📝', 'is_featured' => false]);
        Category::create(['name' => 'Books', 'slug' => 'books', 'icon' => '📚', 'is_featured' => false]);
        Category::create(['name' => 'Branding', 'slug' => 'branding', 'icon' => '🏷️', 'is_featured' => false]);
        Category::create(['name' => 'Products', 'slug' => 'products', 'icon' => '🏗️', 'is_featured' => false]);
        Category::create(['name' => 'Busines', 'slug' => 'business', 'icon' => '🕵️', 'is_featured' => true]);
        Category::create(['name' => 'Busines Intelligence', 'slug' => 'business-intelligence', 'icon' => '🕵️', 'is_featured' => false]);
        Category::create(['name' => 'CMS', 'slug' => 'cms', 'icon' => '📄', 'is_featured' => false]);
        Category::create(['name' => 'Careers', 'slug' => 'careers', 'icon' => '💼', 'is_featured' => false]);
        Category::create(['name' => 'Chatbots', 'slug' => 'chatbots', 'icon' => '🤖', 'is_featured' => false]);
        Category::create(['name' => 'Extensions', 'slug' => 'extensions', 'icon' => '🔌', 'is_featured' => false]);
        Category::create(['name' => 'Computing', 'slug' => 'computing', 'icon' => '☁️', 'is_featured' => false]);
        Category::create(['name' => 'Infrastructure', 'slug' => 'infrastructure', 'icon' => '☁️', 'is_featured' => false]);
        Category::create(['name' => 'Collaboration', 'slug' => 'collaboration', 'icon' => '🤝', 'is_featured' => false]);
        Category::create(['name' => 'Communities', 'slug' => 'communities', 'icon' => '🏘️', 'is_featured' => false]);
        Category::create(['name' => 'Creators', 'slug' => 'creators', 'icon' => '✍️', 'is_featured' => false]);
        Category::create(['name' => 'Support', 'slug' => 'support', 'icon' => '🤝', 'is_featured' => false]);
        Category::create(['name' => 'Visualization', 'slug' => 'visualization', 'icon' => '📊', 'is_featured' => false]);
        Category::create(['name' => 'Databases', 'slug' => 'databases', 'icon' => '🔍', 'is_featured' => false]);
        Category::create(['name' => 'Design', 'slug' => 'design', 'icon' => '🎨', 'is_featured' => true]);
        Category::create(['name' => 'APIs', 'slug' => 'apis', 'icon' => '👩‍💻', 'is_featured' => false]);
        Category::create(['name' => 'Developer', 'slug' => 'developer', 'icon' => '💻', 'is_featured' => true]);
        Category::create(['name' => 'Commerce', 'slug' => 'commerce', 'icon' => '💳', 'is_featured' => false]);
        Category::create(['name' => 'Education', 'slug' => 'education', 'icon' => '🎓', 'is_featured' => false]);
        Category::create(['name' => 'Email', 'slug' => 'email', 'icon' => '✉️', 'is_featured' => false]);
        Category::create(['name' => 'Feedback', 'slug' => 'feedback', 'icon' => '📣', 'is_featured' => true]);
        Category::create(['name' => 'Finance', 'slug' => 'finance', 'icon' => '💰', 'is_featured' => false]);
        Category::create(['name' => 'Builders', 'slug' => 'builders', 'icon' => '📋', 'is_featured' => false]);
        Category::create(['name' => 'Freelancers', 'slug' => 'freelancers', 'icon' => '👩‍💻', 'is_featured' => false]);
        Category::create(['name' => 'Fundraising', 'slug' => 'fundraising', 'icon' => '💸', 'is_featured' => false]);
        Category::create(['name' => 'Cloud', 'slug' => 'cloud', 'icon' => '☁️', 'is_featured' => false]);
        Category::create(['name' => 'Inventory', 'slug' => 'inventory', 'icon' => '🏡', 'is_featured' => false]);
        Category::create(['name' => 'Image Recognition', 'slug' => 'image-recognition', 'icon' => '📷', 'is_featured' => false]);
        Category::create(['name' => 'Interior Design', 'slug' => 'interior-design', 'icon' => '🛋️', 'is_featured' => false]);
        Category::create(['name' => 'Jobs', 'slug' => 'jobs', 'icon' => '👨‍💼', 'is_featured' => false]);
        Category::create(['name' => 'Journaling', 'slug' => 'journaling', 'icon' => '📔', 'is_featured' => false]);
        Category::create(['name' => 'Journalism', 'slug' => 'journalism', 'icon' => '📰', 'is_featured' => false]);
        Category::create(['name' => 'Knowledge Management', 'slug' => 'knowledge-management', 'icon' => '📚', 'is_featured' => false]);
        Category::create(['name' => 'Language Learning', 'slug' => 'language-learning', 'icon' => '🗣️', 'is_featured' => false]);
        Category::create(['name' => 'Generation', 'slug' => 'generation', 'icon' => '📈', 'is_featured' => false]);
        Category::create(['name' => 'Mac', 'slug' => 'mac', 'icon' => '🍎', 'is_featured' => false]);
        Category::create(['name' => 'Machine Learning', 'slug' => 'machine-learning', 'icon' => '🤖', 'is_featured' => false]);
        Category::create(['name' => 'Research', 'slug' => 'research', 'icon' => '📊', 'is_featured' => false]);
        Category::create(['name' => 'Marketing', 'slug' => 'marketing', 'icon' => '📣', 'is_featured' => true]);
        Category::create(['name' => 'Marketplaces', 'slug' => 'marketplaces', 'icon' => '🛒', 'is_featured' => false]);
        Category::create(['name' => 'Health', 'slug' => 'health', 'icon' => '🧠', 'is_featured' => false]);
        Category::create(['name' => 'Motion Design', 'slug' => 'motion-design', 'icon' => '🎥', 'is_featured' => false]);
        Category::create(['name' => 'Music', 'slug' => 'music', 'icon' => '🎵', 'is_featured' => false]);
        Category::create(['name' => 'News', 'slug' => 'news', 'icon' => '📰', 'is_featured' => false]);
        Category::create(['name' => 'Code', 'slug' => 'code', 'icon' => '🚫', 'is_featured' => false]);
        Category::create(['name' => 'Taking', 'slug' => 'taking', 'icon' => '📝', 'is_featured' => false]);
        Category::create(['name' => 'Notion', 'slug' => 'notion', 'icon' => '📝', 'is_featured' => false]);
        Category::create(['name' => 'Source', 'slug' => 'source', 'icon' => '🐧', 'is_featured' => false]);
        Category::create(['name' => 'Optimization', 'slug' => 'optimization', 'icon' => '🔍', 'is_featured' => false]);
        Category::create(['name' => 'Parenting', 'slug' => 'parenting', 'icon' => '👨‍👩‍👧‍👦', 'is_featured' => false]);
        Category::create(['name' => 'Payments', 'slug' => 'payments', 'icon' => '💸', 'is_featured' => false]);
        Category::create(['name' => 'Monitoring', 'slug' => 'monitoring', 'icon' => '📈', 'is_featured' => false]);
        Category::create(['name' => 'Photography', 'slug' => 'photography', 'icon' => '📷', 'is_featured' => false]);
        Category::create(['name' => 'Podcasting', 'slug' => 'podcasting', 'icon' => '🎙️', 'is_featured' => false]);
        Category::create(['name' => 'Privacy', 'slug' => 'privacy', 'icon' => '🔒', 'is_featured' => false]);
        Category::create(['name' => 'Productivity', 'slug' => 'productivity', 'icon' => '📈', 'is_featured' => false]);
        Category::create(['name' => 'Services', 'slug' => 'services', 'icon' => '🛠️', 'is_featured' => false]);
        Category::create(['name' => 'Project Management', 'slug' => 'project-management', 'icon' => '📊', 'is_featured' => false]);
        Category::create(['name' => 'Reading', 'slug' => 'reading', 'icon' => '📚', 'is_featured' => false]);
        Category::create(['name' => 'Recruiting', 'slug' => 'recruiting', 'icon' => '👥', 'is_featured' => false]);
        Category::create(['name' => 'Costs', 'slug' => 'costs', 'icon' => '🤑', 'is_featured' => false]);
        Category::create(['name' => 'Work', 'slug' => 'work', 'icon' => '🏡', 'is_featured' => false]);
        Category::create(['name' => 'SEO', 'slug' => 'seo', 'icon' => '🔍', 'is_featured' => false]);
        Category::create(['name' => 'Boilerplates', 'slug' => 'boilerplates', 'icon' => '💻', 'is_featured' => false]);
        Category::create(['name' => 'Sales', 'slug' => 'sales', 'icon' => '💰', 'is_featured' => false]);
        Category::create(['name' => 'Scrapers', 'slug' => 'scrapers', 'icon' => '🔨', 'is_featured' => false]);
        Category::create(['name' => 'Screenshots', 'slug' => 'screenshots', 'icon' => '📸', 'is_featured' => false]);
        Category::create(['name' => 'Search', 'slug' => 'search', 'icon' => '🔍', 'is_featured' => false]);
        Category::create(['name' => 'Security', 'slug' => 'security', 'icon' => '🔒', 'is_featured' => false]);
        Category::create(['name' => 'Fast', 'slug' => 'fast', 'icon' => '🚀', 'is_featured' => false]);
        Category::create(['name' => 'Media', 'slug' => 'media', 'icon' => '📱', 'is_featured' => false]);
        Category::create(['name' => 'Recognition', 'slug' => 'recognition', 'icon' => '🗣️', 'is_featured' => false]);
        Category::create(['name' => 'Diffusion', 'slug' => 'fiffusion', 'icon' => '🖼️', 'is_featured' => false]);
        Category::create(['name' => 'Storage', 'slug' => 'storage', 'icon' => '🗄️', 'is_featured' => false]);
        Category::create(['name' => 'Task Management', 'slug' => 'task-management', 'icon' => '📋', 'is_featured' => false]);
        Category::create(['name' => 'Testimonials', 'slug' => 'testimonials', 'icon' => '🌟', 'is_featured' => false]);
        Category::create(['name' => 'Lists', 'slug' => 'lists', 'icon' => '📝', 'is_featured' => false]);
        Category::create(['name' => 'Tourism', 'slug' => 'tourism', 'icon' => '🌍', 'is_featured' => false]);
        Category::create(['name' => 'Trading', 'slug' => 'trading', 'icon' => '💱', 'is_featured' => false]);
        Category::create(['name' => 'Translation', 'slug' => 'translation', 'icon' => '🌍', 'is_featured' => false]);
        Category::create(['name' => 'Venture Capital', 'slug' => 'venture-capital', 'icon' => '💰', 'is_featured' => false]);
        Category::create(['name' => 'Video', 'slug' => 'video', 'icon' => '🎬', 'is_featured' => false]);
        Category::create(['name' => 'Editing', 'slug' => 'editing', 'icon' => '🎥', 'is_featured' => false]);
        Category::create(['name' => 'Voice', 'slug' => 'voice', 'icon' => '🗣️', 'is_featured' => false]);
        Category::create(['name' => 'Hosting', 'slug' => 'hosting', 'icon' => '🌐', 'is_featured' => false]);
        Category::create(['name' => 'Writing', 'slug' => 'writing', 'icon' => '✍️', 'is_featured' => false]);
        Category::create(['name' => 'iOS', 'slug' => 'ios', 'icon' => '📱', 'is_featured' => false]);
        Category::create(['name' => 'Personal Life', 'slug' => 'personal-life', 'icon' => '🏡', 'is_featured' => true]);
    }
}
