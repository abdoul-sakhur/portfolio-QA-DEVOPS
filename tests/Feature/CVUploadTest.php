<?php

namespace Tests\Feature;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CVUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_upload_and_download_and_delete_cv()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin);

        $file = UploadedFile::fake()->create('cv.pdf', 100, 'application/pdf');

        $response = $this->post(route('admin.cv.store'), [
            'title' => 'Mon CV Test',
            'file' => $file,
        ]);

        $response->assertRedirect(route('admin.cv.index'));

        $this->assertDatabaseHas('portfolios', [
            'title' => 'Mon CV Test',
            'is_cv' => 1,
        ]);

        $portfolio = Portfolio::where('is_cv', true)->first();

        // File stored
        Storage::disk('public')->assertExists('portfolios/' . $portfolio->filename);

        // Download
        $download = $this->get(route('admin.cv.download', $portfolio));
        $download->assertStatus(200);

        // Delete
        $del = $this->delete(route('admin.cv.destroy', $portfolio));
        $del->assertRedirect(route('admin.cv.index'));

        $this->assertDatabaseMissing('portfolios', [
            'id' => $portfolio->id,
        ]);

        Storage::disk('public')->assertMissing('portfolios/' . $portfolio->filename);
    }
}
