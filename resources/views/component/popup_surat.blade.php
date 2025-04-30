<div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-lg shadow-2xl p-6 w-full max-w-2xl relative">
    <!-- Tombol Close -->
    <button onclick="toggleModal(false)" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
    
    <h2 class="text-xl font-bold mb-4">Sertifikat</h2>
    
    <img id="sertifikat-image" src="" class="w-full rounded border">
  </div>
</div>

<script>
  function toggleModal(show, imageUrl = '', ) {
    const modal = document.getElementById('modal');
    const img = document.getElementById('sertifikat-image');
    if (show) {
      modal.classList.remove('hidden');
      if (imageUrl) img.src = imageUrl;
    } else {
      modal.classList.add('hidden');
      img.src = '';
    }
  }
</script>
