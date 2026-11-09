<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /** POST /api/contact-messages */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'message' => 'required|string|max:2000',
        ]);

        $message = ContactMessage::create($data);

        // Data pengirim tidak dikembalikan; cukup konfirmasi.
        return response()->json([
            'message' => 'Terima kasih! Pesanmu sudah terkirim.',
            'id' => $message->id,
        ], 201);
    }
}
