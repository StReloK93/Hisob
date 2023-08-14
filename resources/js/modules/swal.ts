import Swal from 'sweetalert2'

export default Swal.mixin({
    customClass: {
        confirmButton: 'w-32 bg-pink-500 text-white rounded-sm shadow py-1 hover:bg-pink-600',
        cancelButton: 'w-32 bg-gray-200 rounded-sm shadow py-1 hover:bg-gray-300 mr-2'
    },
    buttonsStyling: false,
    reverseButtons: true,
    showCancelButton: true,
    confirmButtonText: 'Ha',
    cancelButtonText: 'Yoq',
})