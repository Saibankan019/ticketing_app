<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\PaymentType; 

class EventController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load(['tikets', 'kategori', 'user']);
        
        
        $paymentTypes = PaymentType::all();
        
        return view('events.show', compact('event', 'paymentTypes'));
    }
}