@extends('layouts.metrologi.admin')

@section('content')
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }

    /* Tambahan untuk mencegah list terpotong */
    .ck-content ol,
    .ck-content ul {
        padding-left: 1.5rem !important;
    }
</style>

<div class="p-6 bg-gray-100 min-h-screen">
    <div class="relative h-[150px] w-full bg-cover bg-[center_87%]" style="background-image: url('/assets/img/background/user_metrologi.png');">
        <div class="absolute bottom-[-30px] w-full px-8">
            <div class="flex flex-wrap items-center justify-between p-4 rounded-xl">
                <div class="relative flex-grow mt-2 md:mt-0">
                    <p class="pl-10 text-center justify-center pr-4 py-2 rounded-full bg-white shadow text-sm w-full">FORM SURAT BALASAN</p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
        <form enctype="multipart/form-data" class="mt-6 bg-white p-6 rounded-xl shadow-lg w-full max-w-3xl" action="{{ route('proces-surat-balasan', $id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="">
                        <label for="nomor_surat" class="block font-medium mb-1">Nomor Surat</label>
                        <input type="text" name="id_surat_balasan" class="border px-4 py-2 w-full rounded-lg" value="{{ $draft->id_surat_balasan ?? '' }}" required>
                    </div>
                    <input type="hidden" name="tanggal_pembuatan_surat" value="{{ date('Y-m-d') }}">
                    <div class="form-group row">
                        <label for="nama_yang_dituju" class="block font-medium mb-1">Penerima</label>
                        <input type="text" name="nama_yang_dituju" class="border px-4 py-2 w-full rounded-lg" value="{{ $draft->nama_yang_dituju ?? $surat->user->nama ?? '' }}" required>
                    </div>
                    <div class="form-group row md:col-span-2">
                        <label for="isi_surat" class="block font-medium mb-1">Isi Surat</label>
                        <textarea id="editor" name="isi_surat" class="form-control">{{ $draft->isi_surat ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">
                <div class="flex justify-center gap-4">
                    <button type="submit" name="action" value="submit" class="bg-blue-900 text-white px-6 py-2 rounded-lg mt-4 font-semibold">Buat Surat Balasan</button>
                    <button type="submit" name="action" value="draft" class="bg-gray-500 text-white px-6 py-2 rounded-lg mt-4 font-semibold">Simpan Draft</button>
                </div>
            </div>
        </form>
    </div>
        
</div>
<script>
    let editorInstance;

    document.addEventListener("DOMContentLoaded", function () {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editorInstance = editor;

                // Sinkronisasi isi CKEditor saat submit
                const form = document.querySelector('form');
                form.addEventListener('submit', function (e) {
                    const editorData = editor.getData();
                    const action = document.querySelector('button[type="submit"]:focus').value;

                    if (action === 'submit' && (!editorData || editorData.trim() === '')) {
                        alert('Isi surat tidak boleh kosong!');
                        e.preventDefault();
                        return;
                    }

                    // Set data ke textarea secara eksplisit agar bisa dikirim
                    document.querySelector('#editor').value = editorData;
                });
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>



@endsection
