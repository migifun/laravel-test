<?php

namespace App\Http\Controllers;

use App\Models\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReceptionController extends Controller
{
    public function form()
    {
        return view('reception.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'purpose' => 'required|in:meeting,interview,delivery,other',
        ]);

        $reception = Reception::create($validated);

        $webhookUrl = config('services.slack.webhook_url');
        if ($webhookUrl) {
            $purposes = [
                'meeting' => '打ち合わせ',
                'interview' => '面接',
                'delivery' => '納品・受取',
                'other' => 'その他',
            ];
            $purposeLabel = $purposes[$reception->purpose] ?? $reception->purpose;

            Http::post($webhookUrl, [
                'text' => "【受付通知】{$reception->name} 様（{$reception->company}）が来訪されました\n用件：{$purposeLabel}",
            ]);
        }

        return redirect()->route('reception.calling', $reception);
    }

    public function calling(Reception $reception)
    {
        return view('reception.calling', compact('reception'));
    }

    public function index()
    {
        $receptions = Reception::latest()->get();
        return view('reception.index', compact('receptions'));
    }

    public function destroy(Reception $reception)
    {
        $reception->delete();

        return redirect()->route('reception.index');
    }
}
