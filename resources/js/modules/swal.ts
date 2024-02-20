import Swal from 'sweetalert2'

export default Swal.mixin({
    customClass: {
        confirmButton: 'px-5 py-2 text-white ml-4 rounded elevation-1 alert-button-width',
        cancelButton: 'px-5 py-2 text-blue-grey-darken-2 bg-blue-grey-lighten-5 rounded elevation-1 alert-button-width'
    },
    confirmButtonColor: 'teal',
    cancelButtonColor: 'gray',
    // buttonsStyling: false,
    reverseButtons: true,
    showCancelButton: true,
    confirmButtonText: 'Ha',
    cancelButtonText: 'Yoq',
})