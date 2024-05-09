<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class InvestigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {

            if ($index <= 5) {
                # code...
                $attributes = [
                    'for' => 'SINSP ' . $faker->firstName . ' ' . $faker->lastName . ' BFP Acting City Fire Marshal',
                    'subject' => 'FIRE INCIDENT REPORTS -MINIMAL DAMAGE FIRE INCIDENT (FIR-MDFI)',
                    'date' => $faker->date(),
                ];
                $reportID = DB::table('investigations')->insertGetId($attributes);
                $properties = ["House", "Vacant Lot", "Garbage", "Vehicle"];
                $time = ["1400", "1800", "1600", "0800"];
                $alarm = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
                $minimals = [
                    'investigation_id' => $reportID,
                    'dt_actual_occurence' => $faker->date(),
                    'dt_reported' => $faker->date(),
                    'incident_location' => $faker->city . " " . $faker->streetname,
                    'involved_property' => $properties[$faker->numberBetween(0, 3)],
                    'property_data' => $faker->firstName . ' ' . $faker->lastName,
                    'receiver' => $faker->numberBetween(1, 15),
                    'caller_name' => $faker->firstName . ' ' . $faker->lastName,
                    'caller_address' => $faker->city . " " . $faker->streetname,
                    'caller_number' => $faker->phoneNumber,
                    'notification_originator' => 'Chief Operation',
                    'first_responding_engine' => $faker->numberBetween(1, 4),
                    'first_responding_leader' => $faker->numberBetween(1, 10),
                    'time_arrival_on_scene' => $time[$faker->numberBetween(0, 3)] . "H",
                    'alarm_status_time' => $alarm[$faker->numberBetween(0, 4)],
                    'time_fire_out' => $time[$faker->numberBetween(0, 3)] . "H",
                    'property_owner' => $faker->firstName . ' ' . $faker->lastName,
                    'property_occupant' => $faker->firstName . ' ' . $faker->lastName,
                    'details' => $faker->paragraph(5),
                    'findings' => $faker->paragraph(5),
                    'recommendation' => $faker->paragraph(5),
                ];
                DB::table('minimals')->insertGetId($minimals);
            } else if ($index <= 10) {
                $attributes = [
                    'for' => 'SINSP ' . $faker->firstName . ' ' . $faker->lastName . ' BFP Acting City Fire Marshal',
                    'subject' => 'FIRE INCIDENT REPORTS -MINIMAL DAMAGE FIRE INCIDENT (FIR-MDFI)',
                    'date' => $faker->date(),
                ];
                $reportID = DB::table('investigations')->insertGetId($attributes);
                $alarm = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
                $time = ["1400", "1800", "1600", "0800"];
                $properties = ["House", "Vacant Lot", "Garbage", "Vehicle"];
                $spot = [
                    'investigation_id' => $reportID,
                    'date_occurence' => $faker->dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
                    'time_occurence' => $time[$faker->numberBetween(0, 3)] . "H",
                    'address_occurence' => $faker->city . " " . $faker->streetname,
                    'involved' => $properties[$faker->numberBetween(0, 3)],
                    'name_of_establishment' => "N/A",
                    'owner' => $faker->firstName . ' ' . $faker->lastName,
                    'occupant' => $faker->firstName . ' ' . $faker->lastName,
                    'estimate_damage' => $faker->numberBetween(10000, 100000),
                    'time_fire_start' => $time[$faker->numberBetween(0, 3)] . "H",
                    'time_fire_out' => $time[$faker->numberBetween(0, 3)] . "H",
                    'details' => $faker->paragraph(5),
                    'alarm' => 1,
                    'disposition' => $faker->sentence(10),
                ];
                $spotid = DB::table('spots')->insertGetId($spot);
            } else if ($index <= 15) {
                $attributes = [
                    'for' => 'SINSP ' . $faker->firstName . ' ' . $faker->lastName . ' BFP Acting City Fire Marshal',
                    'subject' => 'FIRE INCIDENT REPORTS -MINIMAL DAMAGE FIRE INCIDENT (FIR-MDFI)',
                    'date' => $faker->date(),
                ];
                $reportID = DB::table('investigations')->insertGetId($attributes);
                $i = 0;
                $spotID = [1, 2, 3, 4, 5];
                $progress = [
                    "spot_id" => $spotID[$i],
                    "investigation_id" => $reportID,
                    "authority" => $faker->paragraph(5),
                    "matters_investigated" => $faker->paragraph(5),
                    "facts_of_the_case" => $faker->paragraph(5),
                    "disposition" => $faker->paragraph(2),
                ];
                DB::table('progresses')->insertGetId($progress);
                $i++;
            } else if ($index <= 20) {
                $attributes = [
                    'for' => 'SINSP ' . $faker->firstName . ' ' . $faker->lastName . ' BFP Acting City Fire Marshal',
                    'subject' => 'FIRE INCIDENT REPORTS -MINIMAL DAMAGE FIRE INCIDENT (FIR-MDFI)',
                    'date' => $faker->date(),
                ];
                $reportID = DB::table('investigations')->insertGetId($attributes);
                $time = ["1400", "1800", "1600", "0800"];
                $i = 0;
                $spotID = [1,2,3,4,5];
                $properties = ["House", "Vacant Lot", "Garbage", "Vehicle"];

                $final = [
                    "spot_id" => $spotID[$i],
                    'investigation_id' => $reportID,
                    'intelligence_unit' => "Ligao City Fire Station, Ligao City Albay",
                    "place_of_fire" => $faker->city . " " . $faker->streetname,
                    "td_alarm" => $time[$faker->numberBetween(0, 3)] . "H " . $faker->dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
                    "establishment_burned" => $properties[$faker->numberBetween(0, 3)],
                    "damage_to_property" => $faker->numberBetween(10000, 100000),
                    "origin_of_fire" => $faker->sentence(10),
                    "cause_of_fire" => $faker->sentence(5),
                    "substantiating_documents" => $faker->paragraph(5),
                    "facts_of_the_case" => $faker->paragraph(5),
                    "discussion" => $faker->paragraph(5),
                    "findings" => $faker->paragraph(5),
                    "recommendation" => $faker->paragraph(5),
                ];
                $i++;
                DB::table('ifinals')->insertGetId($final);
            }
        }
    }
}
