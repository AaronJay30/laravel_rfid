<?php

namespace App\Exports;

use App\Models\LivestockRegistration;
use App\Models\MilkRegistration;
use App\Models\Progress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class livestockExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    protected $invoices;
    protected $columnName;

    public function __construct(array $invoices)
    {
        $this->invoices = DB::table('livestock_reg')
            ->leftJoin('livestock_info', 'livestock_reg.IID', '=', 'livestock_info.IID')
            ->leftJoin('livestock_char', 'livestock_reg.CID', '=', 'livestock_char.CID')
            ->leftJoin('livestock_birthinfo', 'livestock_reg.BID', '=', 'livestock_birthinfo.BID')
            ->whereIn('livestock_reg.IID', $invoices)
            ->get();
    }

    public function headings(): array
    {
        return [
            "RFID_TAG", "IID", "CID", "BID", "created_at", "updated_at", "given_name", "farm_name", "sex", "breed", "sire", "dam", "birth_date", "death_date", "sold_date", "jaw", "ear", "body", "teat", "horn", "birth_season", "birth_type", "milk_type", "birth_image"
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->invoices;
    }
}
