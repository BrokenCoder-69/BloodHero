<?php

namespace App\Http\Controllers;

use App\Models\BloodDonation;
use Illuminate\Http\Request;

class BloodDonationController extends Controller
{
    public function store(Request $request)
    {
        try {
            $user = $request->user();
            $data = $request->only(['blood_type', 'location', 'urgency', 'donation_date', 'hospital_name','description']);
            $data['user_id'] = $user->id;
            $post = BloodDonation::create($data);
            return response()->json([
                'message' => 'Blood donation post created successfully',
                'post' => $post,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create blood donation post',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
