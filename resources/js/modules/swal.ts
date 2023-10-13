import Swal from 'sweetalert2'

export default Swal.mixin({
    customClass: {
        confirmButton: 'px-5 py-2 text-white ml-4',
        cancelButton: 'px-5 py-2 text-white'
    },
    confirmButtonColor: 'teal',
    cancelButtonColor: 'gray',
    // buttonsStyling: false,
    reverseButtons: true,
    showCancelButton: true,
    confirmButtonText: 'Ha',
    cancelButtonText: 'Yoq',
})