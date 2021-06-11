<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\Review;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;



class ReviewsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Review::from('reviews as r')
                  ->join('books as b', 'b.id', '=', 'r.book_id')
                  ->where('b.user_id', '=', Auth::id())
                  ->get();
    }
	public function headings():array
	{
		return [
                'title',
                'category',
				'review',
				's_page',
				'e_page'
			];
	}
}
