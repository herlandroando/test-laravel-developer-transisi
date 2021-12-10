<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CompanyImport implements ToModel, WithValidation, WithBatchInserts, WithChunkReading, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Company([
            'name' => $row['name'],
            'email' => $row['email'],
            'website' => $row['website']
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ["required", "max:255", "string"],
            'email' => ["required", "max:255", "email"],
            'website' => ["required", "max:255", "url"],
        ];
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 10;
    }

}
