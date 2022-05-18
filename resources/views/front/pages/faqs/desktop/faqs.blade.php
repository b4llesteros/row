@extends('front.layout.master')   

@section('content')

   

    <div class="desktop-one-column">
        <div class="column">
             <div class="faqs-title">
                @include('front.components.desktop.title')             
                <svg  viewBox="0 0 24 24">
                    <path  d="M17,12V3A1,1 0 0,0 16,2H3A1,1 0 0,0 2,3V17L6,13H16A1,1 0 0,0 17,12M21,6H19V15H6V17A1,1 0 0,0 7,18H18L22,22V7A1,1 0 0,0 21,6Z" />
                </svg>                 
             </div>
        </div>       
    </div>  
    
    @include('front.components.desktop.faqs')

@endsection