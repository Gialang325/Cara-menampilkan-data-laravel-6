<?php

namespace App\Http\Controllers;

use App\Models\Projek; 
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProjekController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $query = Projek::query();

        if ($search) {
            $query->where('nama', 'LIKE', "%{$search}%")
                ->orWhere('kelas', 'LIKE', "%{$search}%")
                ->orWhere('jurusan', 'LIKE', "%{$search}%");
        }

        $projek = $query->orderBy('nama', 'asc')->paginate(10);
        if ($projek->isEmpty() && $search) {
            session()->flash('error', 'Data tidak ditemukan.');
        }

        if ($request->fullUrl() != session('previous_url')) {
            session(['previous_url' => url()->previous()]);
        }

        return view('projek.index', compact('projek'));
    }

    public function create(): View
    {
        return view('projek.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'foto'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'         => 'required|string|max:255',
            'kelas'        => 'required|numeric',
            'jurusan'      => 'required|string|max:255'
        ]);

        $image = $request->file('foto');
        $image->storeAs('public/images/projek', $image->hashName());

        Projek::create([
            'foto'          => $image->hashName(),
            'nama'          => $request->nama,
            'kelas'         => $request->kelas,
            'jurusan'       => $request->jurusan,
        ]);

        return redirect()->route('projek.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $projek = Projek::findOrFail($id);

        return view('projek.show', compact('projek'));
    }

    public function edit(string $id): View
    {
        $projek = Projek::findOrFail($id);

        return view('projek.edit', compact('projek'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'foto'         => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama'         => 'required|string|max:255',
            'kelas'        => 'required|numeric',
            'jurusan'      => 'required|string|max:255'
        ]);

        $projek = Projek::findOrFail($id);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $image->storeAs('public/images/projek', $image->hashName());

            Storage::delete('public/images/projek/' . $projek->foto);

            $projek->update([
                'foto'          => $image->hashName(),
                'nama'          => $request->nama,
                'kelas'         => $request->kelas,
                'jurusan'       => $request->jurusan,
            ]);
        } else {
            $projek->update([
                'nama'          => $request->nama,
                'kelas'         => $request->kelas,
                'jurusan'       => $request->jurusan,
            ]);
        }

        return redirect()->route('projek.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id): RedirectResponse
    {
        $projek = Projek::findOrFail($id);

        Storage::delete('public/images/projek/' . $projek->foto);

        $projek->delete();

        return redirect()->route('projek.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
