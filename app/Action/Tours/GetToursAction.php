<?php

namespace App\Action\Tours;

use App\Models\Tour;
use Illuminate\Http\Request;

class GetToursAction
{

    public function __invoke(Request $request)
    {



        $perPage = $request->input('perPage', 10);
        $page = $request->input('page', 1);
        $sortBy = $request->input('sortBy', 'newness');



        $query = Tour::query();

        $query = $this->makeSort($query,$sortBy);
        $paginator =  $query->paginate($perPage,$this->returnModel(),'page',$page);

        $data = [
            'data' => $paginator->items()->map(function ($tour) {
                $tour->header_image = $this->resizeImage($tour->header_image);
                return $tour;
            }),
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'per_page' => $paginator->perPage(),
            'total' => $paginator->total(),
        ];

        return collect($data);
    }


    private  function makeSort($query,$sortBy)
    {
        switch ($sortBy) {
            case 'rating':
            case 'popularity':
                $query->orderBy('rating', 'desc');
                break;
            case 'price_asc':
                // Sort by price from low to high
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                // Sort by price from high to low
                $query->orderBy('price', 'desc');
                break;
            case 'newness':
            default:
                $query->orderBy('created_at', 'desc');
                break;

        }
        return $query;

    }

    private function resizeImage($image): string
    {
        $filenameWithoutExt = pathinfo($image, PATHINFO_FILENAME);
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        return "tours/{$filenameWithoutExt}_800x533.{$extension}";

    }

    private function returnModel()
    {
        return ['*'];
    }

}
