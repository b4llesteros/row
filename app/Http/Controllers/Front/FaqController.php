<?php

namespace App\Http\Controllers\Front;


use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
//Llamar al modelo
use App\Models\Faq;
use App\Http\Requests\Front\FaqRequest;



class FaqController extends Controller
{     //Crear la propiedad Faq
      protected $faq;

      //Asignar a la propiedad Faq el modelo Faq
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    
    public function index()
    {
        
        $view = View::make('front.pages.faqs.index')

            ->with('faqs', $this->faq->where('active', 1)->where('visible', 1)->get());

            if(request()->ajax()) {     

                $sections = $view->renderSections();
    
                return response()->json([
                    'content' => $sections['content'],
                ]);
    
            }

        return $view;
    }    
   
}
