<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * Path where file containing secret santa participants is located
     * @var string
     */
    protected $path = __DIR__ . "/../../resources/data/secret-santa.txt";


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function check_that_participants_list_exists()
    {
        $this->assertFileExists($this->path, "File does not exist");
    }

    /** @test */
    public function ensure_that_participants_list_is_not_empty()
    {
        $this->assertStringNotEqualsFile($this->path, "");
    }

    /**
     * allocate_santa_to_participants
     *
     * @return void
     */
    /** @test */
    public function allocate_santa_to_participants()
    {
//        Load file containing all participants
        $participants = array_filter(explode("\n", file_get_contents($this->path)));

        foreach ($participants as $participant) {
            preg_match_all('/\S+/', preg_replace('\/', '', $participant), $santas);
//           preg_match_all('/\S+/', $participant, $santas);

            foreach ($santas as list($firstname, $lastname, $email)) {

                dd($firstname . " " . $lastname . " " . $email);
            }
        }
    }
}
