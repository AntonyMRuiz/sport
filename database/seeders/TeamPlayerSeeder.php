<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamPlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $team = Team::create(['name' => 'SoccerLab']);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Alex',
            'number'     => '10',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'A. Rios',
            'number'     => '17',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Gabo',
            'number'     => '89',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Chuy',
            'number'     => '1',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Kike',
            'number'     => '88',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Guerra',
            'number'     => '14',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Oscar',
            'number'     => '100',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Giraldo',
            'number'     => '77',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'W. Ríos',
            'number'     => '12',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Dani',
            'number'     => '7',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Mejía',
            'number'     => '22',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Jhonma',
            'number'     => '8',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Edwin',
            'number'     => '11',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Jheison',
            'number'     => '19',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Mario',
            'number'     => '9',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'Jhon Elder',
            'number'     => '20',
            'position_x' => null,
            'position_y' => null,
        ]);

        Player::create([
            'team_id'    => $team->id,
            'name'       => 'SoccerLab',
            'number'     => '00',
            'position_x' => null,
            'position_y' => null,
        ]);

    }
}
