public function definition()
{
    return [
        'name' => $this->faker->sentence(3), 
        'description' => $this->faker->paragraph, 
        'deadline' => $this->faker->date(), 
        'user_id' => User::factory(), 
    ];
}
