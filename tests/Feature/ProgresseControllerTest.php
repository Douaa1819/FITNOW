<?php

use App\Models\Progresse;
use App\Models\User;
use Laravel\Prompts\Progress;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;

//show
it('see myprogress',function(){
$user=User::factory()->create();
    $progress = Progresse::factory()->count(3)->create([
        'user_id' => $user->id,
    ]);
    $this->actingAs($user)
    ->getJson('/api/progress/my-progress')
    ->assertStatus(200)
    ->assertJsonCount(3,'progress')
    ->assertJson(['message'=>'yes']);

});

//updateStatus
it('update status', function(){
$user=User::factory()->create();
$progress=Progresse::factory()->create(['user_id'=>$user->id]);
$progressId=$progress->id;
$status=[
    'status'=>'Terminé'
];
$this->actingAs($user)
->patchJson('/api/progress/'.$progressId.'/status',
    $status
)
->assertStatus(200)

->assertJson(['message'=>'Statut de la progression mis à jour avec succès']);
});
//store

it('creates new progress', function () {
    $user = User::factory()->create();
    $progressData = [
        'title' => 'Nouvelle progression',
        'weight' => 70,
        'measurements' => json_encode(['height' => 175]),
        'performance' => 'Test Performance',
    ];
    $this->actingAs($user)
        ->postJson('/api/progress', $progressData)
        ->assertStatus(200)
        ->assertJson(['message' => 'Progression enregistrée avec succès']);
    $this->assertDatabaseHas('progresses', [
        'title' => 'Nouvelle progression'
    ]);
});


//update

it('update new progress', function () {
    $user = User::factory()->create();
    $progressEntry = Progresse::factory()->create([
        'user_id' => $user->id,
    ]);
    $progress = [
        'title' => 'update',
        'measurements' => json_encode(['height' => 170]),
        'performence' => 'course a pied',
        'weight' => 19,

    ];
    $this->actingAs($user)
        ->putJson('/api/progress/' . $progressEntry->id, $progress)
        ->assertStatus(200)
        ->assertJson(['message' => 'Progression mise à jour avec succès']);
    $this->assertDatabaseHas('progresses', [
        'title' => 'update',
        'id' => $progressEntry->id
    ]);
});


it('delete progress', function () {
    $user = User::factory()->create();
    $progresses = Progresse::factory()->create([
        'user_id' => $user->id
    ]);
    $progressId = $progresses->id;
    $this->actingAs($user)->deleteJson('/api/progress/' . $progressId)
        ->assertStatus(200)
        ->assertJson(['message' => 'Entrée supprimée avec succès']);
});
