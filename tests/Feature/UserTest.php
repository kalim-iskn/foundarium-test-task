<?php

namespace Tests\Feature;

use App\Models\Auto;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    private string $baseUrl = "api/user";

    public function testList()
    {
        $userCount = User::count();

        if ($userCount == 0) {
            $userCount = 5;
            User::factory($userCount)->create();
        }

        $resp = $this->get($this->baseUrl);
        $resp->assertOk();

        $resp->assertJsonStructure($this->getStructure(true));

        $data = json_decode($resp->content(), true)['data'];
        $this->assertCount($userCount, $data);
    }

    public function testSetAuto()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Auto $auto */
        $auto = Auto::factory()->create();

        $this->assertNull($user->auto);

        $resp = $this->put($this->baseUrl . "/" . $user->id . "/auto/" . $auto->id);
        $resp->assertOk();

        $resp->assertJsonStructure($this->getStructure(false));

        $data = json_decode($resp->content(), true)['data'];

        $this->assertNotNull($data['auto']);
        $this->assertEquals($auto->id, $data['auto']['id']);
        $this->assertEquals($auto->name, $data['auto']['name']);
    }

    public function testAutoAlreadyTaken()
    {
        /** @var Auto $auto */
        $auto = Auto::factory()->create();

        /** @var User $user */
        $user = User::factory()->create(["auto_id" => $auto->id]);

        $resp = $this->put($this->baseUrl . "/" . $user->id . "/auto/" . $auto->id);
        $resp->assertUnprocessable();
    }

    public function testFreeAuto()
    {
        /** @var Auto $auto */
        $auto = Auto::factory()->create();

        /** @var User $user */
        $user = User::factory()->create(["auto_id" => $auto->id]);

        $this->assertNotNull($user->auto);

        $resp = $this->delete($this->baseUrl . "/auto/" . $auto->id);
        $resp->assertOk();

        $user = User::find($user->id);

        $this->assertNull($user->auto);
    }

    public function testAutoAlreadyFree()
    {
        /** @var Auto $auto */
        $auto = Auto::factory()->create();

        $resp = $this->delete($this->baseUrl . "/auto/" . $auto->id);
        $resp->assertUnprocessable();
    }

    private function getStructure(bool $isMultiple): array
    {
        $structure = [
            "id",
            "name",
            "auto" => [
                "id",
                "name"
            ]
        ];

        if ($isMultiple) {
            $structure = [$structure];
        }

        return [
            "data" => $structure
        ];
    }
}
