<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    private $siswa = [
        ['id'=> 1, 'nama'=> 'Ahmad','kelas'=> 'VII-A'],
        ['id'=> 2, 'nama'=> 'Budi','kelas'=> 'VII-B'],
    ];

    public function index()
    {
        if(!session::has('siswa')) {
            session::put('siswa', $this->siswa);
        }
        $data = session::get('siswa',[]);
        $data2 = 'halo';
        return view('siswa.index', compact('data'));
    }

    public function create()
    {
        return view('siswa.create');
    }
    public function store(Request $request)
    {
       $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
        ]);
        $datasiswa = session::get('siswa');
        $datasiswa[] = [
            'id' => count($datasiswa) + 1,
            'nama' => $request->nama,
            'kelas' => $request->kelas
        ];
        session::put('siswa', $datasiswa);
        return redirect()->route('siswa.index');
    }
}