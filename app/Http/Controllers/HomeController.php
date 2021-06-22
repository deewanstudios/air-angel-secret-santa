<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        return view('add-santa-form');
    }

    public function processForm(Request $request)
    {

        $new_santa = [];
        if ($this->validateRequest()) {
            $new_santa['name'] = $request->request->get('fullname');
            $new_santa['email'] = $request->request->get('email');
        }
        return redirect()->back()->with('success_message', 'You have been successfully added!');
//        return redirect('/secret-santa/add')->with('newSanta', $new_santa);
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate(
            [
                'fullname' => 'required',
                'email' => 'required'
            ]
        );
    }

}
