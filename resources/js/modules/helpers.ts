import axios from "axios"

export function increment(object) {
    object.count++
}

export function decrement(object) {
    if (object.count > 1) {
        object.count--
    }
}

export const rules = [(value) => [null, ""].includes(value) ? "To'ldiring" : true]

export function downloadExcel(url, name) {
    axios.get(url, { responseType: 'blob' }).then((response) => {
        const url = window.URL.createObjectURL(new Blob([response.data]));

        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', name);  // Указываем имя файла
        document.body.appendChild(link);
        link.click();
        window.URL.revokeObjectURL(url);

        document.body.removeChild(link);
    })
}