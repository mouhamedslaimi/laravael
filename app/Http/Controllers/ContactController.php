<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
class ContactController extends Controller
{
    public function newContact()
    {
        $newContact = new Contact();
        $newContact->name ="mohamed salimi";
        $newContact->email ="mohamedsalimi@gmail.com";
        $newContact->message ="bonjour voici un naouveau contact";
        $newContact->save();
    }
    public function listeContacts()
    {
        $contacts =Contact::all();
        return view('contacts',['contacts'=>$contacts]);
    }
}
