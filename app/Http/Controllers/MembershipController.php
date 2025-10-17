<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipRequest;
use App\Mail\MembershipCardIssued;
use App\Models\Student;
use App\Models\UserActivityLog;
use App\Services\MembershipCardService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MembershipController extends Controller
{
    public function create(Student $student)
    {
        return view('memberships.create', compact('student'));
    }

    public function store(MembershipRequest $req, Student $student, MembershipCardService $membershipCardService)
    {
        // genrate membership card
        $membershipCard = $membershipCardService->generate($req->except('_token'), $student);

        // student member card status update 
        $student->update(['member_card_status' => 1]);

        // student card delivery dates create
        $student->cardDeliveryDates()->create(['name' => 'membership']);

        // Send Student Email for Membership Card Issued
        Mail::to($student->email)->send(new MembershipCardIssued($membershipCard, $student));

        // Send Centre Email for Membership Card Issued
        Mail::to($student->centre->email)->send(new MembershipCardIssued($membershipCard, $student));

        // Send Admin Email for Membership Card Issued
        // Mail::to('laptlondon@gmail.com')->send(new MembershipCardIssued($membershipCard, $student));

        return back()->with('message', 'Membership card generated successfully.');
    }

    public function delete(Student $student)
    {
        // remove membership card pdf file
        Storage::disk('public')->delete("certificates/{$student->id}_membership.pdf");

        // user activity log create
        UserActivityLog::create([
            'user_id' => auth()->id(),
            'module_name' => 'Students',
            'action_type' => 'Update',
            'action_details' => 'Updated member card status',
            'old_value' => ['member_card_status' => $student->member_card_status],
            'new_value' => ['member_card_status' => 0]
        ]);

        // student member card status update 
        $student->update(['member_card_status' => 0]);

        // student card delivery dates delete
        $student->cardDeliveryDates()->where(['name' => 'membership'])->delete();

        return back()->with('error', 'Membership card deleted successfully.');
    }
}