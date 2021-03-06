<?php

namespace Kizi\Core\Console\Commands\Create;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use Kizi\Core\Models\Districts;
use Kizi\Core\Models\DistrictTranslations;
use Kizi\Core\Models\Provinces;
use Kizi\Core\Models\ProvinceTranslations;
use Kizi\Core\Models\Wards;
use Kizi\Core\Models\WardTranslations;

class ProvinceCreateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'general:province';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Province';

    /**
     * Install directory.
     *
     * @var string
     */
    protected $directory = '';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Provinces::truncate();
        ProvinceTranslations::truncate();
        Wards::truncate();
        WardTranslations::truncate();
        Districts::truncate();
        DistrictTranslations::truncate();
        $filename = __DIR__.'/../../../Database/file/vietnam-zone.csv';
        LazyCollection::make(
            function () use ($filename) {
                $file = fopen($filename, 'r');
                while ($data = fgetcsv($file)) {
                    yield $data;
                }
            }
        )
                      ->skip(1)
                      ->chunk(10)
                      ->each(
                          function ($lines) {
                              foreach ($lines as $data) {
                                  $condition = [
                                      'position'   => 1,
                                      'is_active'  => true,
                                      'is_default' => false,
                                  ];
                                  try {
                                      $province  = $this->province($data[2], $condition);
//                                      $condition = array_merge($condition, ['province_id' => $province->id]);
//                                      $district  = $this->district($data[1], $condition);
//                                      $condition = array_merge($condition, ['district_id' => $district->id]);
//                                      $this->ward($data[0], $condition);
                                      $this->info(
                                          'memory using : '.number_format(memory_get_peak_usage() / 1048576, 2).' MB'
                                      );
                                  } catch (\Exception $e) {
                                      Log::error('migrate province error', $data);
                                  }
                              }
                          }
                      );
    }

    private function pregMatch($search, $item, &$result, array $type)
    {
        $search = mb_strtolower($search, 'UTF-8');
        if (preg_match("/{$search}/i", $item)) {
            $name   = preg_replace("/{$search}/", "", mb_strtolower($item, 'UTF-8'));
            $name   = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
            $result = [
                'en' => [
                    'name' => convert_vi_to_en($name),
                    'type' => $type['en'],
                ],
                'vi' => [
                    'name' => $name,
                    'type' => $type['vi'],
                ],
            ];
        }
    }

    private function province($province, $data)
    {
        if ($province === 'Th??nh ph??? H??? Ch?? Minh') {
            $data['is_default'] = true;
        }
        $search = [
            [
                'key'   => 'Th??nh ph??? ',
                'value' => [
                    'vi' => 'Th??nh ph???',
                    'en' => 'City',
                ],
            ],
            [
                'key'   => 'T???nh ',
                'value' => [
                    'vi' => 'T???nh',
                    'en' => 'Province',
                ],
            ],
        ];

        $i = 0;
        while (!isset($data['translations'])) {
            $this->pregMatch(
                $search[$i]['key'],
                $province,
                $data['translations'],
                $search[$i]['value']
            );
            $i++;
            if ($i === count($search)) {
                break;
            }
        }
        $province = Provinces::whereTranslation('name', $data['translations']['en']['name'], 'en')
                             ->whereTranslation('name', $data['translations']['vi']['name'], 'vi')
                             ->first();
        if (!isset($province->id)) {
            $province = Provinces::create($data);
        }

        return $province;
    }

    private function district($district, $data)
    {
        $search = [
            [
                'key'   => 'Th??nh ph??? ',
                'value' => [
                    'vi' => 'Th??nh ph???',
                    'en' => 'City',
                ],
            ],
            [
                'key'   => 'Qu???n ',
                'value' => [
                    'vi' => 'Qu???n',
                    'en' => 'District',
                ],
            ],
            [
                'key'   => 'Huy???n ',
                'value' => [
                    'vi' => 'Huy???n',
                    'en' => 'District',
                ],
            ],
            [
                'key'   => 'Th??? x?? ',
                'value' => [
                    'vi' => 'Th??? x??',
                    'en' => 'District',
                ],
            ],
        ];
        $i      = 0;
        while (!isset($data['translations'])) {
            $this->pregMatch(
                $search[$i]['key'],
                $district,
                $data['translations'],
                $search[$i]['value']
            );
            $i++;
            if ($i === count($search)) {
                break;
            }
        }
        $district = Districts::whereTranslation('name', $data['translations']['en']['name'], 'en')
                             ->whereTranslation('name', $data['translations']['vi']['name'], 'vi')
                             ->where('province_id', $data['province_id'])
                             ->first();
        if (!isset($district->id)) {
            $district = Districts::create($data);
        }

        return $district;
    }

    private function ward($ward, $data)
    {
        $search = [
            [
                'key'   => 'Ph?????ng ',
                'value' => [
                    'vi' => 'Ph?????ng',
                    'en' => 'Ward',
                ],
            ],
            [
                'key'   => 'Th??? tr???n ',
                'value' => [
                    'vi' => 'Th??? tr???n',
                    'en' => 'Town',
                ],
            ],
            [
                'key'   => 'X?? ',
                'value' => [
                    'vi' => 'X??',
                    'en' => "Commune",
                ],
            ],
        ];
        $i      = 0;
        while (!isset($data['translations'])) {
            $this->pregMatch(
                $search[$i]['key'],
                $ward,
                $data['translations'],
                $search[$i]['value']
            );
            $i++;
            if ($i === count($search)) {
                break;
            }
        }
        $ward = Wards::whereTranslation('name', $data['translations']['en']['name'], 'en')
                     ->whereTranslation('name', $data['translations']['vi']['name'], 'vi')
                     ->where('province_id', $data['province_id'])
                     ->where('district_id', $data['district_id'])
                     ->first();
        if (!isset($district->id)) {
            $ward = Wards::create($data);
        }

        return $ward;

    }
}
