<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sideData = $this->getSideData();
        $contacts = Contact::where('user_id', auth()->user()->id)->get();
        return view('web.dashboard.student.contact.index', $sideData, compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.student.contact.create', $sideData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->route('dashboard.student.contact.index')->with('success', 'Send Contact Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.student.contact.edit', $sideData, compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
        return redirect()->route('dashboard.student.contact.index')->with('success', 'Uodated Contact Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('dashboard.student.contact.index')->with('success', 'Deleted Contact Successfully!');
    }
}
