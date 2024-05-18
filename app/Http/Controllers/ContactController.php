<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $contacts = $this->contactFilter($request);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $contact = new Contact($request->all());
        $phones = new Phone($request->all());
        $email = new Email($request->all());
        $address = new Address($request->all());

        Auth::user()->contacts()->save($contact);
        $this->saveContactPhone($contact, $phones);
        $this->saveContactEmail($contact, $email);
        $this->saveContactAddress($contact, $address);

        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact): View
    {
        $contact->load(['phones', 'emails','addresses']);

        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact): View
    {
        $contact->load(['phones', 'emails','addresses']);

        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $contact->delete();

        $contact = new Contact($request->all());
        $phones = new Phone($request->all());
        $email = new Email($request->all());
        $address = new Address($request->all());

        Auth::user()->contacts()->save($contact);
        $this->saveContactPhone($contact, $phones);
        $this->saveContactEmail($contact, $email);
        $this->saveContactAddress($contact, $address);

        return redirect()->route('contacts.index')
            ->with('success', 'Contact update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully!');
    }

    private function saveContactPhone($contact, $phones): void
    {
        foreach ($phones->phone as $phone) {
            if (!empty($phone)) {
                $contact->phones()->create([
                    'phone' => $phone,
                ]);
            }
        }
    }

    private function saveContactEmail($contact, $emails): void
    {
        foreach ($emails->email as $email) {
            if (!empty($email)) {
                $contact->emails()->create([
                    'email' => $email,
                ]);
            }
        }
    }

    private function saveContactAddress($contact, $address): void
    {
        foreach ($address->address as $address) {
            if (!empty($address)) {
                $contact->addresses()->create([
                    'address' => $address,
                ]);
            }
        }
    }

    private function contactFilter(Request $request): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->search;
            $column = $request->column;

            if ($column === 'phone') {
                $contacts = Contact::query()->whereHas('phones', function($q) use ($search) {
                    $q->where('phone', 'LIKE', "%$search%");
                });
            } elseif ($column === 'email') {
                $contacts = Contact::query()->whereHas('emails', function($q) use ($search) {
                    $q->where('email', 'LIKE', "%$search%");
                });
            } elseif ($column === 'address') {
                $contacts = Contact::query()->whereHas('addresses', function($q) use ($search) {
                    $q->where('address', 'LIKE', "%$search%");
                });
            } else {
                $contacts = Contact::query()->where($column, 'LIKE', "%$search%");
            }
        } else {
            $contacts = Contact::query();
        }

        return $contacts->where('user_id', Auth::id())->orderBy('first_name')->paginate(20);
    }
}
