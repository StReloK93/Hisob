function getPositionAtCenter(element) {
    const { top, left, width, height } = element.getBoundingClientRect();
    return {
        x: left + width / 2,
        y: top + height / 2
    };
}

export function getDistanceBetweenElements(a, b) {
    const aPosition = getPositionAtCenter(a);
    const bPosition = getPositionAtCenter(b);

    return Math.hypot(aPosition.x - bPosition.x, aPosition.y - bPosition.y);
}

export function getIssets(all, issets, name_id){
    const isset = issets.map((organization) => organization[name_id])
    
    all.forEach((item) => {
        item.isset = isset.includes(+item.id)
    })
    return all
}