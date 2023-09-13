export function increment(object){
    object.count++
}

export function decrement(object){
    if(object.count > 1){
        object.count--
    }
}