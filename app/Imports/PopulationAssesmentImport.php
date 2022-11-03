<?php

namespace App\Imports;

use App\Models\Account;
use App\Models\Period;
use App\Models\Population;
use App\Models\SubCriteria;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PopulationAssesmentImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public function chunkSize(): int
    {
        return 50;
    }


    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        try {
            DB::beginTransaction();

            foreach ($collection as $key => $value) {
                // find population by nik
                $population = Population::where('card_id_number', $value['nik'])->first();

                if ($population == null) {
                    $user = $this->savePopulation($value);
                    $population = Population::where('user_id', $user->id)->first();
                }

                $this->savePopulationAssesment($population, $value);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }

    private function savePopulationAssesment($population, $value)
    {
        $last_periode = Period::orderBy('id', 'desc')->where('status', 'ongoing')->first();

        if (empty($last_periode)) {
            throw new Exception("Periode belum dibuat");
        }

        $populationAssesmnet = $population->population_assesments()->create([
            'date' => now(),
            'is_process' => false,
            'period_id' => $last_periode->id,
        ]);

        foreach (range(1, 5) as $key => $value_id) {
            $person_value = null;
            if ($value_id == 1) {
                $person_value = $value['pekerjaan'];
            } elseif ($value_id == 2) {
                $person_value = $value['penghasilan'];
            } elseif ($value_id == 3) {
                $person_value = $value['usia'];
            } elseif ($value_id == 4) {
                $person_value = $value['jumlah_tanggungan'];
            } elseif ($value_id == 5) {
                $person_value = $value['kesehatan'];
            }

            $sub_criteria = SubCriteria::where('criteria_id', $value_id);

            if ($value_id == 1) {
                $sub_criteria = $sub_criteria->where('name', $person_value);
            } elseif ($value_id == 2) {
                $sub_id = null;
                foreach ($sub_criteria->get() as $key => $sub) {
                    if ($person_value >= $sub->min && $sub->max == null) {
                        $sub_id = $sub->id;
                        break;
                    } else if ($person_value < $sub->max && $sub->min == null) {
                        $sub_id = $sub->id;
                        break;
                    } else if ($person_value >= $sub->min && $person_value <= $sub->max) {
                        $sub_id = $sub->id;
                        break;
                    }
                }
                $sub_criteria = $sub_criteria->where('id', $sub_id);
            } elseif ($value_id == 3) {
                $sub_id = null;
                foreach ($sub_criteria->get() as $key => $sub) {
                    if ($person_value >= $sub->min && $sub->max == null) {
                        $sub_id = $sub->id;
                        break;
                    } else if ($person_value < $sub->max && $sub->min == null) {
                        $sub_id = $sub->id;
                        break;
                    } else if ($person_value >= $sub->min && $person_value <= $sub->max) {
                        $sub_id = $sub->id;
                        break;
                    }
                }

                $sub_criteria = $sub_criteria->where('id', $sub_id);
            } elseif ($value_id == 4) {
                if ($person_value >= 5) {
                    $sub_criteria = $sub_criteria->whereCode("SC20");
                } else {
                    $sub_criteria = $sub_criteria->where('name', $person_value);
                }
            } elseif ($value_id == 5) {
                $sub_criteria = $sub_criteria->where('name', $person_value);
            }

            $sub_criteria = $sub_criteria->first();

            if (!empty($sub_criteria)) {
                $populationAssesmnet->populationAssesmentDetail()->create([
                    'sub_criteria_id' => $sub_criteria->id,
                    'value' => $sub_criteria->weight,
                ]);
            } else {
                dd($value_id, $person_value, "Sub Criteria Not Found");
            }
        }
    }

    private function savePopulation($value): User
    {
        $user = new User();
        $user->name = $value['nama_penerima_bantuan'];
        $user->email = $value['nik'];
        $user->password = bcrypt($value['nkk']);
        $user->save();

        $user->assignRole('receiver');

        $population = new Population();
        $population->user_id = $user->id;
        $population->family_card_id = $value['nkk'];
        $population->name = $value['nama_penerima_bantuan'];
        $population->card_id_number = $value['nik'];
        $population->address = $value['alamat'];
        $fullAddress = $this->searchFullAddress($value);
        $population->village_id = $fullAddress['village_id'];
        $population->zip_code = $fullAddress['zip_code'];
        $population->created_by = auth()->user()->id;
        $population->save();

        // create account
        $account = new Account();
        $account->user_id = $user->id;
        $account->full_name = $value['nama_penerima_bantuan'];
        $account->address = $value['alamat'];
        $account->village_id = $fullAddress['village_id'];
        $account->save();

        return $user;
    }

    private function searchFullAddress($value): array
    {
        $data = [
            'village_id' => null,
            'zip_code' => null,
        ];

        // Malang City ID
        $city_id = 259;

        $village = \Indonesia::findCity($city_id)->districts()->search($value['kecamatan'])->first()->villages()->where('name', '=', $value['kelurahan'])->first();

        $meta = $village->meta;

        $data['village_id'] = $village->id;
        $data['zip_code'] = $meta['pos'];

        return $data;
    }
}
