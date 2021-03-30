<?php

namespace App\Http\Controllers;

use App\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function form(Request $request, Kernel $kernel)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'text' => 'required|min:4|max:255',
            'date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $hashSum = Hash::make(implode($request->all()));

        $reqArray = ['input_data' => $request->all(), 'hash_sum' => $hashSum];

        $myRequest = Request::create('api/test/formnew', 'POST', $reqArray);

        $result = $kernel->handle($myRequest);

        return response()->json(['message' => $result->getOriginalContent()]);
    }

    public function formNew(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'hash_sum' => 'required|min:1',
            'input_data' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $hashSum = Hash::make(implode($request->input_data));

        if (Hash::check($hashSum, $request->hash_sum)) {
            return response()->json(['errors' => 'Hashes not compare!']);
        }
        return response()->json('Hashes are compare!');
    }
}
