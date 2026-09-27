<?php

namespace Tests\Feature;

use Tests\TestCase;

class CleanTempImagesCommandTest extends TestCase
{
    public function test_clean_temp_images_command_executes_successfully(): void
    {
        $this->artisan('kedai:clean-temp')
            ->assertExitCode(0);
    }
}
