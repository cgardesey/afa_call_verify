<?php

namespace App\Exports;

use App\Models\CallLog;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CallLogsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return CallLog::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.call-log.columns.id'),
            trans('admin.call-log.columns.caller_phonenumber'),
            trans('admin.call-log.columns.callee_phonenumber'),
            trans('admin.call-log.columns.call_id'),
            trans('admin.call-log.columns.user_id'),
        ];
    }

    /**
     * @param CallLog $callLog
     * @return array
     *
     */
    public function map($callLog): array
    {
        return [
            $callLog->id,
            $callLog->caller_phonenumber,
            $callLog->callee_phonenumber,
            $callLog->call_id,
            $callLog->user_id,
        ];
    }
}
