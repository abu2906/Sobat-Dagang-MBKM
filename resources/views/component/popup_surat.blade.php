<div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
  <div class="relative w-full max-w-2xl p-6 bg-white rounded-lg shadow-2xl">
    <!-- Tombol Close -->
    <button onclick="toggleModal(false)" class="absolute text-2xl text-gray-500 top-2 right-2 hover:text-gray-800">&times;</button>

    <h2 class="mb-4 text-xl font-bold"></h2>

    <img id="image" src="" class="w-full border rounded">
  </div>
</div>

<script>
  function toggleModal(show, imageUrl = '', ) {
    const modal = document.getElementById('modal');
    const img = document.getElementById('image');
    if (show) {
      modal.classList.remove('hidden');
      if (imageUrl) img.src = imageUrl;
    } 
    else {
      modal.classList.add('hidden');
      img.src = '';
    }
  }
</script>