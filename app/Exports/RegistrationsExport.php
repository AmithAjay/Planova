<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RegistrationsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Registration::with(['user', 'event'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Email',
            'Event Title',
            'Gender',
            'Phone Number',
            'Participating Events / Extra Data',
            'Status',
            'Registered At',
        ];
    }

    /**
     * @var Registration $registration
     */
    public function map($registration): array
    {
        return [
            $registration->id,
            $registration->user->name,
            $registration->user->email,
            $registration->event->title,
            $registration->gender,
            $registration->phone_number,
            json_encode($registration->responses),
            $registration->status,
            $registration->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
