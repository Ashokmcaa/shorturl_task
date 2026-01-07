<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ShortUrlController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $urls = ShortUrl::with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('short_urls.index', compact('urls'));
    }

    public function create()
    {
        return view('short_urls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
            'code' => 'nullable|unique:short_urls,code|alpha_dash',
        ]);

        $code = $request->code ?? Str::random(6);

        ShortUrl::create([
            'original_url' => $request->original_url,
            'code' => $code,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('short_urls.index')
            ->with('success', 'Short URL created successfully!');
    }

    public function edit(ShortUrl $short_url)
    {
        return view('short_urls.edit', compact('short_url'));
    }

    public function update(Request $request, ShortUrl $short_url)
    {
        $request->validate([
            'original_url' => 'required|url',
            'code' => 'required|alpha_dash|unique:short_urls,code,' . $short_url->id,
        ]);

        $short_url->update([
            'original_url' => $request->original_url,
            'code' => $request->code,
        ]);

        return redirect()->route('short_urls.index')
            ->with('success', 'Short URL updated successfully!');
    }

    public function destroy(ShortUrl $short_url)
    {
        $short_url->delete();
        return redirect()->route('short_urls.index')
            ->with('success', 'Short URL deleted successfully!');
    }

    public function redirect($code)
    {
        $shortUrl = ShortUrl::where('code', $code)->firstOrFail();
        return redirect()->to($shortUrl->original_url);
    }
}
