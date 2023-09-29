<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => User::USER_ROLE,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a Company.
     */
    public function withCompany(callable $callback = null): static
    {
        return $this->has(
            Company::factory()
                ->state(fn () => [
                    'name' => $this->faker->unique()->company(),
                ])
                ->when(is_callable($callback), $callback),
            'companies'
        );
    }

    public function withcurrentCompany(callable $callback = null): static
    {
        return $this->for(
            Company::factory()
                ->state(fn () => [
                    'name' => $this->faker->unique()->company(),
                ])
                ->when(is_callable($callback), $callback),
            'currentCompany'
        );
    }
}
