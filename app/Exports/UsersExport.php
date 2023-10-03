<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return User::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            trans('admin.user.columns.id'),
            trans('admin.user.columns.name'),
            trans('admin.user.columns.email'),
        ];
    }

    /**
     * @param User $user
     * @return array
     *
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
        ];
    }
}
