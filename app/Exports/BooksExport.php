<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;

class BooksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::whereHas('themes', function($query){
            $query->where('user_id', '=', Auth::id());
        })->get();
    }

	public function headings():array
	{
		return [
				'#',
				'name',
				'title',
				'publisher',
				'year',
			];
	}
}
