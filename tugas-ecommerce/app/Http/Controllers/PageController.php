<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    // Tampilkan semua halaman (untuk admin)
    public function index()
    {
        $pages = Page::latest()->get();

        return view('pages.index', compact('pages'));
    }

    // Form tambah halaman baru
    public function create()
    {
        return view('pages.create');
    }

    // Simpan halaman baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');

        Page::create($validated);

        return redirect()->route('pages.index')->with('success', 'Halaman berhasil dibuat.');
    }

    // Tampilkan satu halaman (untuk pengunjung, dicari lewat slug)
    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }

    // Form edit halaman
    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    // Update halaman
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        if ($validated['title'] !== $page->title) {
            $validated['slug'] = $this->generateUniqueSlug($validated['title'], $page->id);
        }

        $validated['is_published'] = $request->boolean('is_published');

        $page->update($validated);

        return redirect()->route('pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    // Hapus halaman
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('pages.index')->with('success', 'Halaman berhasil dihapus.');
    }

    // Buat slug unik dari judul, hindari duplikat dengan menambahkan angka di belakang
    private function generateUniqueSlug(string $title, $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;

        while (
            Page::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
