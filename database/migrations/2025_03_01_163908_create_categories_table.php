<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Auto-incremental ID
            $table->string('name'); // Category Name
            $table->text('description')->nullable(); // Category Description
            $table->timestamps(); // Created_at & Updated_at timestamps
        });

        // Insert default categories
        \DB::table('categories')->insert([
            ['name' => 'Hostel Issues', 'description' => 'Complaints related to hostel facilities, food, or ...'],
            ['name' => 'Cafeteria Issues', 'description' => 'Complaints related to food.'],
            ['name' => 'Academic Issues', 'description' => 'Complaints regarding exams, syllabus, grading, etc...'],
            ['name' => 'Infrastructure Issues', 'description' => 'Issues with classrooms, library, internet, or camp...'],
            ['name' => 'Faculty Misconduct', 'description' => 'Complaints regarding inappropriate behavior by fac..'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
