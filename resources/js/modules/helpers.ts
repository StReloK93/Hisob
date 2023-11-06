export function increment(object){
    object.count++
}

export function decrement(object){
    if(object.count > 1){
        object.count--
    }
}

export const rules = [(value) => [null, ""].includes(value) ? "To'ldiring" : true]