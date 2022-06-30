<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class PublisherExportExcel extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return (new FastExcel(Publisher::all()))->download('file.xlsx');
    }
}
