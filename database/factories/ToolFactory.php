<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Enums\Tool\Pricing as ToolPricing;
use App\Enums\Tool\Status as ToolStatus;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tool>
 */
class ToolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company,
            'slug' => Str::uuid(),
            'photo' => 'tools/placeholder.png',
            'website' => $this->faker->url,
            'headline' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'pricing' => $this->faker->randomElement(['FREE', 'PAID', 'FREEMIUM']),
            'twitter' => $this->faker->url,
            'facebook' => $this->faker->url,
            'instagram' => $this->faker->url,
            'youtube' => $this->faker->url,
            'linkedin' => $this->faker->url,
            'github' => $this->faker->url,
            'support_email' => $this->faker->email,
            'apple_store_link' => $this->faker->url,
            'google_store_link' => $this->faker->url,
            'status' => ToolStatus::STATUS_DRAFT,
            'submitted_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'queue_priority' => false,
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ToolStatus::STATUS_DRAFT
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ToolStatus::STATUS_PENDING
        ]);
    }

    public function inReview(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ToolStatus::STATUS_IN_REVIEW
        ]);
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ToolStatus::STATUS_PUBLISHED
        ]);
    }

    public function hasQueuePriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'queue_priority' => true
        ]);
    }
}
