<?php

namespace Tests\Feature\Porto;

use App\Models\Porto;
use App\Models\Tag;
use App\Models\TagPorto;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Tests\Trait\TestTrait;

class ApiPortoTest extends TestCase
{
    use RefreshDatabase, TestTrait;
    
    public function test_check_portos_table(){
        $table = (new Porto())->getTable();
        $tableExists = Schema::hasTable($table);
        
        $this->assertTrue($tableExists, "Table $table Not Exist");
    }
    
    public function test_list_porto(): void
    {
        
        $response = $this->actingAs($this->getUser(), 'api')->getJson('/api/list-porto');
        
        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->hasAll(['data','message'])
                    ->whereAllType(['data' => 'array','message' => 'string'])
        );
    }

    public function test_list_porto_exists():void
    {
        $this->seed(UserSeeder::class);
        Porto::create([
            'title' => 'coba',
            'short_desc' => 'short desc',
            'description' => 'description',
            'photo' => 'Photo',
            'link' => 'links',
            'user_id' => 1,
        ]);
        $response = $this->actingAs($this->getUser(), 'api')
            ->getJson('/api/list-porto');

        $this->assertDatabaseCount('portos', 1);
        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->hasAll(['data','message'])
                    ->whereAllType(['data' => 'array','message' => 'string'])
        );
    }

    public function test_create_porto():void
    {
        // Fake Input file and tags
        $file = UploadedFile::fake()->image('avatar.jpg');
        $tags = 'testing1, testing2, testing3';

        $response = $this->postJson('/api/create-porto',[
            'title' => 'Judul test',
            'short_desc' => 'testing',
            'description' => 'testing',
            'photo' => $file,
            'link' => 'link test',
            'tags_value' => $tags,
        ]);
        
        $response->assertStatus(200)
            ->assertJson(function(AssertableJson $json){
            return $json->hasAll(['message','data']);
        });
        $portoDat = $response->json()['data'];
        $portoId = $portoDat['id'];
        
        // Check if file uploaded Successfully
        $filePath = Storage::path("/porto/Porto-$portoId.jpg");
        $this->assertFileExists($filePath);

        //Check if data portos success created 
        $this->assertDatabaseHas((new Porto)->getTable(), [
            'id' => $portoDat['id'],
            'title' => $portoDat['title'],
            'short_desc' => $portoDat['short_desc'],
            'description' => $portoDat['description'],
            'photo' => $portoDat['photo'],
            'link' => $portoDat['link']
        ]);

        $tags = explode(',', $tags);

        // Check if data tags, and tag_portos table successfully
        foreach ($tags as $key => $value) {
            $this->assertDatabaseHas((new Tag())->getTable(),[
                'name' => $value,
            ]);
            $tag = Tag::where('name', $value)->first();
            $this->assertDatabaseHas((new TagPorto())->getTable(), [
                'porto_id' => $portoId,
                'tag_id' => $tag->id,
            ]);
        }

        
    }

    public function test_update_porto():void
    {

    }

    public function test_delete_porto():void
    {

    }
}
