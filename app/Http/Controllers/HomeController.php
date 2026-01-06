<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $featuredEvents = Event::where('featured', true)
            ->latest()
            ->take(3)
            ->get();
            
        $categories = Category::all();
        
        $testimonials = Testimonial::latest()
            ->take(4)
            ->get();

        return view('home', compact('featuredEvents', 'categories', 'testimonials'));
    }
}