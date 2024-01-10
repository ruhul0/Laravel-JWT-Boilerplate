<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        $this->createInfluencerDataTable();
        $this->createInfluencerSocialMediaTable();
        $this->createRemunerationTable();
        $this->createAudiencePercentageTable();
        $this->createInsightTable();
        $this->createAffinityTable();
        $this->createCreatedByTable();
        $this->createUpdatedByTable();
        $this->createSavedInfluencerDataTable();
    }

    private function createInfluencerDataTable(): void {
        Schema::create('influencer_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('formal_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('tier');
            $table->string('origin');
            $table->string('category');
            $table->integer('age_group_from');
            $table->integer('age_group_to');
            $table->timestamps();
        });
    }

    private function createInfluencerSocialMediaTable(): void {
        Schema::create('influencer_social_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_data')->onDelete('cascade');
            $table->string('platform');
            $table->string('username');
            $table->string('url');
            $table->integer('followers');
            $table->timestamps();
        });
    }

    private function createRemunerationTable(): void {
        Schema::create('remuneration', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_data')->onDelete('cascade');
            $table->string('type');
            $table->integer('amount'); // Changed data type to decimal for monetary values
            $table->string('description');
            $table->timestamps();
        });
    }

    private function createAudiencePercentageTable(): void {
        Schema::create('audience_percentage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_data')->onDelete('cascade');
            $table->string('age_group');
            $table->string('type');
            $table->integer('value');
            $table->timestamps();
        });
    }

    private function createInsightTable(): void {
        Schema::create('insight', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_data')->onDelete('cascade');
            $table->string('type');
            $table->integer('value');
            $table->timestamps();
        });
    }

    private function createAffinityTable(): void {
        Schema::create('affinity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_data')->onDelete('cascade');
            $table->string('brand_affinity_type');
            $table->string('brand_exclusivity');
            $table->string('affinity_date');
            $table->timestamps();
        });
    }

    private function createCreatedByTable(): void {
        Schema::create('created_by', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_data')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });
    }

    private function createUpdatedByTable(): void {
        Schema::create('updated_by', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_data')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });
    }

    private function createSavedInfluencerDataTable(): void {
        Schema::create('saved_influencer_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_data')->onDelete('cascade');
            $table->foreignId('remuneration_id')->constrained('remuneration')->onDelete('cascade');
            $table->integer("vat");
            $table->integer("tax");
            $table->integer("service_fee");
            $table->integer("total");
            $table->string('created_date');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('saved_influencer_data');
        Schema::dropIfExists('updated_by');
        Schema::dropIfExists('created_by');
        Schema::dropIfExists('affinity');
        Schema::dropIfExists('insight');
        Schema::dropIfExists('audience_percentage');
        Schema::dropIfExists('remuneration');
        Schema::dropIfExists('influencer_social_media');
        Schema::dropIfExists('influencer_data');
    }
};
