<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Contact;
use App\Models\ContactReply;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactReplyRequest;

class ContactReplyController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sideData = $this->getSideData();
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        $contact_replies = ContactReply::get();
        return view('web.dashboard.admin.contacts.index', $sideData, compact('contacts', 'contact_replies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createReply(Contact $contact)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.contacts.reply', $sideData, compact('contact'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactReplyRequest $request)
    {
        ContactReply::create($request->validated());
        return redirect()->route('dashboard.admin.contacts.index')->with('success', 'Send Reply Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $sideData = $this->getSideData();
        $contact_reply = ContactReply::where('contact_id', $contact->id)->pluck('reply_message');

        $contact_reply = $contact_reply->isEmpty() ? null : $contact_reply->implode('');

        return view('web.dashboard.admin.contacts.show', $sideData, compact('contact', 'contact_reply'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function editReply(Contact $contact)
    {
        $sideData = $this->getSideData();

        $contact_reply = ContactReply::where('contact_id', $contact->id)->first();

        return view('web.dashboard.admin.contacts.edit_reply', $sideData, compact('contact_reply', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactReplyRequest $request, contactReply $contactReply)
    {
        $contactReply->update($request->validated());

        return redirect()->route('dashboard.admin.contacts.index')->with('success', 'Updated Reply Successfully!');
    }

}
