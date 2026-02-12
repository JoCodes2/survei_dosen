<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Dosen - STMIK Adhi Guna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Public Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f5f5f9] min-h-screen pb-12">

    <div class="max-w-3xl mx-auto pt-10 px-4">
        
        <div class="bg-white rounded-t-2xl p-6 border-b border-slate-100 shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="bg-slate-50 p-2 rounded-lg">
                    <img src="{{ asset('assets/assets/stmik.png') }}" alt="Logo STMIK" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <h1 class="text-xl font-bold text-slate-800 leading-tight">Survei Penilaian Dosen</h1>
                    <p class="text-sm text-slate-500">STMIK Adhi Guna</p>
                </div>
            </div>
            <div class="hidden sm:block text-right">
                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-wider">Tahun Akademik 2025/2026</span>
            </div>
        </div>

        <form class="space-y-4 mt-4">
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="relative group">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-1">Nama Mahasiswa</label>
                        <input type="text" placeholder="Input nama lengkap" 
                            class="w-full bg-transparent border-b border-slate-300 py-2 focus:border-blue-500 focus:outline-none transition-all text-slate-700 font-medium">
                    </div>
                    <div class="relative group">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-1">Nomor Induk Mahasiswa (NIM)</label>
                        <input type="text" placeholder="Contoh: 201011000" 
                            class="w-full bg-transparent border-b border-slate-300 py-2 focus:border-blue-500 focus:outline-none transition-all text-slate-700 font-medium">
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 transition-all hover:shadow-md">
                    <p class="text-[16px] font-semibold text-slate-800 mb-6">
                        Bagaimana kemampuan dosen dalam menjelaskan materi agar mudah dipahami?
                    </p>
                    <div class="flex flex-col space-y-3">
                        <div class="flex items-center justify-between bg-slate-50 p-1.5 rounded-xl border border-slate-100">
                            <label class="flex-1 group cursor-pointer">
                                <input type="radio" name="q1" value="1" class="peer hidden">
                                <div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white peer-checked:shadow-md transition-all text-slate-500 font-bold hover:bg-white">1</div>
                            </label>
                            <label class="flex-1 group cursor-pointer">
                                <input type="radio" name="q1" value="2" class="peer hidden">
                                <div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white peer-checked:shadow-md transition-all text-slate-500 font-bold hover:bg-white">2</div>
                            </label>
                            <label class="flex-1 group cursor-pointer">
                                <input type="radio" name="q1" value="3" class="peer hidden">
                                <div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white peer-checked:shadow-md transition-all text-slate-500 font-bold hover:bg-white">3</div>
                            </label>
                            <label class="flex-1 group cursor-pointer">
                                <input type="radio" name="q1" value="4" class="peer hidden">
                                <div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white peer-checked:shadow-md transition-all text-slate-500 font-bold hover:bg-white">4</div>
                            </label>
                            <label class="flex-1 group cursor-pointer">
                                <input type="radio" name="q1" value="5" class="peer hidden">
                                <div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white peer-checked:shadow-md transition-all text-slate-500 font-bold hover:bg-white">5</div>
                            </label>
                        </div>
                        <div class="flex justify-between px-2">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Sangat Kurang</span>
                            <span class="text-[10px] font-bold text-blue-500 uppercase tracking-tighter">Sangat Baik</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 transition-all hover:shadow-md">
                    <p class="text-[16px] font-semibold text-slate-800 mb-6">
                        Ketepatan waktu dosen dalam memulai dan mengakhiri perkuliahan.
                    </p>
                    <div class="flex flex-col space-y-3">
                        <div class="flex items-center justify-between bg-slate-50 p-1.5 rounded-xl border border-slate-100">
                            <label class="flex-1 cursor-pointer"><input type="radio" name="q2" value="1" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500 hover:bg-white transition-all">1</div></label>
                            <label class="flex-1 cursor-pointer"><input type="radio" name="q2" value="2" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500 hover:bg-white transition-all">2</div></label>
                            <label class="flex-1 cursor-pointer"><input type="radio" name="q2" value="3" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500 hover:bg-white transition-all">3</div></label>
                            <label class="flex-1 cursor-pointer"><input type="radio" name="q2" value="4" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500 hover:bg-white transition-all">4</div></label>
                            <label class="flex-1 cursor-pointer"><input type="radio" name="q2" value="5" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500 hover:bg-white transition-all">5</div></label>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-[16px] font-semibold text-slate-800 mb-6">Kemampuan dosen dalam menjawab pertanyaan dan memicu diskusi kelas.</p>
                    <div class="flex items-center justify-between bg-slate-50 p-1.5 rounded-xl border border-slate-100">
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q3" value="1" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">1</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q3" value="2" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">2</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q3" value="3" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">3</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q3" value="4" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">4</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q3" value="5" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">5</div></label>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-[16px] font-semibold text-slate-800 mb-6">Kesesuaian tugas/ujian yang diberikan dengan materi yang diajarkan.</p>
                    <div class="flex items-center justify-between bg-slate-50 p-1.5 rounded-xl border border-slate-100">
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q4" value="1" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">1</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q4" value="2" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">2</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q4" value="3" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">3</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q4" value="4" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">4</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q4" value="5" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">5</div></label>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-[16px] font-semibold text-slate-800 mb-6">Dosen bersikap objektif dan adil dalam memberikan nilai kepada mahasiswa.</p>
                    <div class="flex items-center justify-between bg-slate-50 p-1.5 rounded-xl border border-slate-100">
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q5" value="1" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">1</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q5" value="2" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">2</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q5" value="3" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">3</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q5" value="4" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">4</div></label>
                        <label class="flex-1 cursor-pointer"><input type="radio" name="q5" value="5" class="peer hidden"><div class="py-3 text-center rounded-lg peer-checked:bg-blue-600 peer-checked:text-white font-bold text-slate-500">5</div></label>
                    </div>
                </div>

            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="bg-[#696cff] hover:bg-[#5f61e6] text-white px-10 py-3 rounded-xl font-bold shadow-md shadow-indigo-200 transition-all flex items-center gap-2">
                    Kirim Penilaian
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </form>

        <footer class="mt-12 text-center text-slate-400 text-xs">
            &copy; 2026 STMIK Adhi Guna. All rights reserved.
        </footer>
    </div>

</body>
</html>