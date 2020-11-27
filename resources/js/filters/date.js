export const simpleDate = (value) => {
    if (!value) return ''
    return new Date(value).toLocaleString()
}
