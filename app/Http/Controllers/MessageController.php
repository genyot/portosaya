<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Menampilkan daftar pesan masuk (Inbox)
     */
    public function index(Request $request)
    {
        $query = Message::query();

        // Filter: semua / belum dibaca / sudah dibaca
        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        // Filter pencarian (nama / email / subjek / isi)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->latest()->paginate(10)->withQueryString();

        // Statistik untuk header
        $unreadCount = Message::where('is_read', false)->count();
        $totalCount  = Message::count();

        return view('messages.index', compact('messages', 'unreadCount', 'totalCount'));
    }

    /**
     * Menampilkan detail pesan + tandai sudah dibaca
     */
    public function show(string $id)
    {
        $message = Message::findOrFail($id);

        // Tandai sudah dibaca saat dibuka
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('messages.show', compact('message'));
    }

    /**
     * Hapus pesan
     */
    public function destroy(string $id)
    {
        $message = Message::findOrFail($id);

        $message->delete();

        return redirect()->route('messages.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}
